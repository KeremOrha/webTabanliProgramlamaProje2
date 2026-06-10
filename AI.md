-bootstrap ile sayfanın ortasında duracak şekilde bir giriş sayfası nasıl olur

Web projelerinde kullanıcıyı karşılayan giriş sayfalarının hem şık olması hem de her ekran boyutunda tam ortalanmış (dikeyde ve yatayda) görünmesi çok önemlidir. Bunun için en pratik ve modern yöntem, Bootstrap'in Flexbox (Esnek Kutu) sınıflarını kullanmaktır.

Sizin için hem mobil uyumlu hem de masaüstünde harika görünen, arka plan görselleriyle de desteklenebilecek ideal bir giriş sayfası yapısı hazırladım.

İşte tam ekran ortalanmış, temiz ve modern bir giriş sayfası önerim:

HTML
```HTML
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Tam ekran yerleşimi ve arka plan ayarları */
        html, body {
            height: 100%;
            margin: 0;
        }
       
        /* Kartın ekranda dikey ve yatayda ortalanmasını sağlayan container */
        .full-screen-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
        }
        /* Giriş kartının maksimum genişlik sınırı */
        .login-container {
            width: 100%;
            max-width: 450px;
        }
    </style>
</head>
<body>

    <div class="full-screen-container">
        <div class="login-container">
                <div class="alert alert-info text-center mb-3" role="alert">    
                </div>
            <div class="p-5 bg-white border rounded-3 shadow">
                <h2 class="text-center mb-4 fw-bold text-success">Giriş Yap</h2>
                
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label fw-semibold">Kullanıcı Adı</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Kullanıcı adı" required>
                    </div>
                    
                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">Şifre</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Şifre" required>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center gap-2">
                        <button type="submit" class="btn btn-success px-4 py-2 fw-semibold w-50">Giriş Yap</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```
Bu Tasarımda Öne Çıkan Noktalar Nelerdir?
min-height: 100vh ve Flexbox Gücü: Sayfayı kaplayan ana taşıyıcıya (full-screen-container) verdiğimiz display: flex, align-items: center ve justify-content: center özellikleri sayesinde giriş kartı ekran boyutu ne olursa olsun (telefon, tablet, büyük monitör) tam ortada konumlanır.

Maksimum Genişlik (max-width: 450px): Kartın mobil cihazlarda ekranı düzgünce kaplamasını sağlarken, geniş ekranlarda gereksiz yere esneyip çirkin görünmesini engeller.

Görsel Derinlik: Bootstrap'in shadow (gölgelendirme) ve rounded-3 (yumuşatılmış köşeler) sınıfları, beyaz kartın arka plan görseli üzerinde havada duruyormuş gibi modern bir izlenim bırakmasını sağlar.

Esnek Buton Düzeni: d-flex ve justify-content-between yapısı butonları yan yana şık bir şekilde hizalar. İsteğe göre butonları tam eşit yapmak için w-50 (yüzde 50 genişlik) sınıflarını da ekledim.



-php mysql bağlantısı yaparken nasıl ' yazarım

PHP ile MySQL bağlantısı yaparken (veya SQL sorguları yazarken) tek tırnak (') işareti kullanmak bazen kafa karıştırıcı olabilir, çünkü PHP'nin kendisi de metinleri tanımlamak için tek tırnak kullanır.

Bu sorunu aşmanın ve tırnak işaretini güvenle yazmanın en yaygın ve doğru yolları şunlardır:

1. Çift Tırnak İçinde Tek Tırnak Kullanmak (En Pratik Yol)
PHP'de string (metin) tanımlarken dışarıda çift tırnak (") kullanırsanız, içeriye rahatlıkla tek tırnak (') yazabilirsiniz. PHP bunu hata olarak algılamaz.

```PHP
// PDO ile bağlantı örneği
$dsn = "mysql:host=localhost;dbname=test_db;charset=utf8mb4";
```
Sorgu yazarken de aynı mantık geçerlidir:

```PHP
// Dışarıda çift tırnak, içeride tek tırnak
$sorgu = "SELECT * FROM kullanicilar WHERE isim = 'Ahmet'";
```
2. Ters Slaş (\) ile Kaçış (Escape) Yapmak
Eğer PHP metnini de tek tırnakla açtıysanız ve içine yine tek tırnak yazmanız gerekiyorsa, PHP'ye "bu tırnak metni bitirmiyor, sadece bir karakter" demek için önüne ters slaş koymalısınız:

```PHP
$sorgu = 'SELECT * FROM kullanicilar WHERE isim = \'Ahmet\'';
```
⚠️ Çok Önemli Uyarı: SQL Injection Tehlikesi!
Eğer bir değişkenden gelen veriyi (örneğin kullanıcının formdan girdiği ismi) sorgunun içine tek tırnaklarla doğrudan eklemeye çalışıyorsanız, bu büyük bir güvenlik açığına (SQL Injection) yol açar.

Hatalı ve Tehlikeli Yöntem:
$sorgu = "SELECT * FROM kullanicilar WHERE isim = '$gelen_isim'";
(Eğer kullanıcı isme O'Brian yazarsa sorgu patlar, kötü niyetli bir kod yazarsa veritabanınız ele geçirilebilir).

Güvenli Yol: Hazırlanmış İfadeler (Prepared Statements)
Tırnak işaretleriyle hiç boğuşmamak ve %100 güvenli bağlantı/sorgu yapmak için PDO ve Parametre kullanmalısınız. Bu yöntemde tırnak işaretlerini PHP ve MySQL kendisi otomatik olarak güvenli bir şekilde yönetir:

```PHP
// 1. Veritabanı Bağlantısı (PDO)
try {
    $db = new PDO("mysql:host=localhost;dbname=test_db;charset=utf8mb4", "kullanici_adi", "sifre");
} catch (PDOException $e) {
    die("Bağlantı hatası: " . $e->getMessage());
}

// 2. Güvenli Sorgu Hazırlama (Tırnak kullanmak yerine ? veya :isim koyuyoruz)
$sorgu = $db->prepare("SELECT * FROM kullanicilar WHERE isim = :isim");

// 3. Çalıştırma (Tırnaklar otomatik halledilir, 'Ahmet' veya 'O'Brian' olması fark etmez)
$sorgu->execute([
    'isim' => "O'Brian" 
]);

$kullanicilar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
```
Özetle; düz metinlerde dışarıya çift, içeriye tek tırnak koyarak sorunu çözebilirsin. Ancak işin içine dinamik değişkenler giriyorsa mutlaka yukarıdaki PDO Prepared Statement yöntemini kullanmalısın.
