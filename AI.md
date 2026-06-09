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