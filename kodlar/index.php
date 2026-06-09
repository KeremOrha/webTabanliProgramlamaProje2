<!DOCTYPE html>
<html>
<head>
  <title>Giriş Yap</title>
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
<?php 
   session_start(); 
   
   require('vtbaglan.php'); 
   
	
   
    $baglanti = sqlBaglan();
   
   if (isset($_POST['username']) and isset($_POST['password'])){ 
   
   extract($_POST); 
   
    
   $password = hash('sha256', $password); 
   
   $sql = "SELECT * FROM `uye` WHERE "; 
   

   $sql= $sql . "uye_ad='$username'"; 

   $cevap = mysqli_query($baglanti, $sql); 

   if(!$cevap ){ 
   
       echo '<br>Hata:' . mysqli_error($baglanti); 
   
   } 
   $say = mysqli_num_rows($cevap); 
   
   if ($say == 1){ 
   
        
		mysqli_close($baglanti);
		$baglanti = sqlBaglan();
		
		//sifre kontrolü
	
	$sql2 = "SELECT * FROM `uye` WHERE "; 
   
	$sql2= $sql2 . "uye_sifre='$password' AND uye_ad='$username'"; 
 
   $cevap2 = mysqli_query($baglanti, $sql2); 
   

   if(!$cevap2 ){ 
   
       echo '<br>Hata:' . mysqli_error($baglanti); 
   
   } 
   

   $say2 = mysqli_num_rows($cevap2); 
   
   if ($say2 == 1){ 
   
       $_SESSION['username'] = $username; 
	   $_SESSION['yonetici_mi']=mysqli_fetch_assoc($cevap2)['uye_yonetici_mi'];
	  
    }else{ 
   
   $mesaj = "<h1> Hatalı Şifre!</h1>"; 
   
    }
    }else{ 
   
   $mesaj = "<h1> Hatalı Kullanıcı adı</h1>"; 
   
   
    } 

   } 
   
	if (isset($_SESSION['username'])){ 
		mysqli_close($baglanti);
		header("Location: anaSayfa.php"); 
   
   } 
   
   
   
   ?> 


    <div class="full-screen-container">
        <div class="login-container">
               <?php 
			//mesaj varsa ekrana yazdır. 
         
			if (isset($mesaj)) echo $mesaj; ?> 
            <div class="p-5 bg-white border rounded-3 shadow">
                <h2 class="text-center mb-4 fw-bold text-success">Giriş Yap</h2>
                
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
					
					<!--Butonlar -->
					<div class="d-flex justify-content-between align-items-center">
						<button type="submit" class="btn btn-success px-4 py-2 fw-semibold">Giriş Yap</button>
						<button type="button" onclick="window.location.href='anaSayfa.php'" class="btn btn-outline-success px-4 py-2 fw-semibold">Ziyaretçi Girişi</button>
						
					</div>
				</form>
            </div>

        </div>
    </div>

</body>
</html>
