<?php 

session_start();

if ($_SESSION['yonetici_mi'] != 1){ 
		
		header("Location: index.php"); 
   
   }
   require ('vtbaglan.php'); 
   
   
   
   
    $baglanti = sqlBaglan();
   
   if (isset($_POST['username']) && isset($_POST['password'])){ 
   $yonetici = $_POST['yonetici'] ?? 0;
   
    extract($_POST); 
   
    // sifre metni SHA256 ile şifreleniyor. 
   
    $password = hash('sha256', $password); 
   
   $sql = $baglanti->prepare ("SELECT * FROM `uye` WHERE uye_ad=?");
		$sql->bind_param("s", $username);
	   
		$cevap=$sql->execute();
   
    
   
   //eger cevap FALSE ise hata yazdiriyoruz.       
   
   if(!$cevap ){ 
   
       echo '<br>Hata:' . mysqli_error($baglanti); 
   
   } 
   
   //veritabanindan dönen satır sayısını bul 
   
	$say = $sql->get_result();
	$say = $say->num_rows;
   
   
   if ($say == 0){ 
   
		$sql->close();

		$sql = $baglanti->prepare ("INSERT INTO `uye` (uye_ad, uye_sifre, uye_yonetici_mi) VALUES (?, ?, ?)");
		$sql->bind_param("sss", $username, $password, $yonetici);
	   
		$cevap=$sql->execute();	
	   
		    
	   
		   if ($cevap){
				$mesaj = "<h1>Kullanıcı başarıyla oluşturuldu!</h1>";			   
				
			   
	   
		   }else{ 
	   
			   $mesaj = "<h1>Kullanıcı oluşturulamadı!</h1>"; 
	   
		   } 
	   
	   } 
	   else{
		   $mesaj = "<h1>Kullanıcı adı zaten kullanılıyor</h1>";
	   }
   }
   ?> 
<html>
	<head>
	   <!-- türkçe karakter desteği ayarı --> 
	   <meta http-equiv="Content-Type" content="text/html;  
		  charset=UTF-8" />
		  <meta charset="utf-8">
		  <meta name="viewport" content="width=device-width, initial-scale=1">
		  <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
		  
		  
		  <style>
        
        html, body {
            height: 100%;
            margin: 0;
            
        }
        
        .full-screen-container {
            min-height: 50vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
        }
        .login-container {
            width: 100%;
            max-width: 450px;
        }
		
		body {
			background: #333333 url('./arkaplan/bg1.png')  center center / cover fixed;
		}
    </style>
	</head>
   <body>
   
     <div class="full-screen-container">
        <div class="login-container">
            <?php 
         //mesaj varsa ekrana yazdır. 
         
         if (isset($mesaj)) echo $mesaj; ?> 
            <div class="p-5 bg-white border rounded-3 shadow">
                <h2 class="text-center mb-4 fw-bold text-success">Kayıt Ol</h2>
                
                <form action="<?php $_PHP_SELF ?>" method="POST">
					<!-- Kullanıcı Adı -->
					<div class="mb-3">
						<label for="username" class="form-label">Kullanıcı Adı</label>
						<input type="text" class="form-control" name="username" placeholder="Kullanıcı adı" required>
					</div>
					
					<!-- Şifre -->
					<div class="mb-4">
						<label for="password" class="form-label">Şifre</label>
						<input type="password" class="form-control" name="password" placeholder="Şifre" required>
					</div>
					
					<div class="form-check">
					  <input class="form-check-input" type="checkbox" value="1" name="yonetici">
					  <label class="form-check-label" for="checkDefault">
						Yönetici
					  </label>
					</div>
					
					<!--Buton -->
					<div class="d-flex justify-content-between align-items-center">
						<button type="submit" class="btn btn-primary px-4 py-2 fw-semibold">Kayıt Ol</button>
					</div>
					<div class="mb-3">
						<a href='index.php'>Geri dön</a>
					</div>
				</form>
            </div>

        </div>
    </div>
   </body>
</html>