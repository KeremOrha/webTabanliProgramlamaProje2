<?php 
session_start();

if (!isset($_SESSION['username'])){ 
		
		header("Location: index.php"); 
   
   } 

   require ('vtbaglan.php'); 
   
 
    $baglanti = sqlBaglan();
   
   if (isset($_POST['name']) && isset($_POST['desc']) && isset($_POST['date'])){ 
   
    extract($_POST); 
   
    $sql = $baglanti->prepare ("SELECT * FROM etkinlik WHERE etkinlik_ad=?");
	$sql->bind_param("s", $name);
	   
	$cevap=$sql->execute();
         
   
   if(!$cevap ){ 
   
       echo '<br>Hata:' . mysqli_error($baglanti); 
   
   } 
   
   
	$say = $sql->get_result();
	$say = $say->num_rows;
   
   if ($say == 0){ 
   
		
		$sql->close();
	   
		$sql = $baglanti->prepare ("INSERT INTO etkinlik (etkinlik_ad, etkinlik_aciklama, etkinlik_tarih) VALUES (?, ?, ?)");
		$sql->bind_param("sss", $name, $desc, $date);
	   
		$cevap=$sql->execute();  
	   
		   if ($cevap){ 
				$mesaj = "<h1>Etkinlik eklendi</h1>"; 
		
		   }else{ 
	   
			   $mesaj = "<h1>Etkinlik Eklenemedi!</h1>"; 
	   
		   } 
	   
	   } 
	   else{
		   $mesaj = "<h1>Etkinlik zaten var</h1>";
	   }
   }
   mysqli_close($baglanti);
   ?> 
<html>
	<head>
	 
	   <meta http-equiv="Content-Type" content="text/html;  
		  charset=UTF-8" />
		  <meta charset="utf-8">
		  <title>Etkinlik Ekle</title>
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
                <h2 class="text-center mb-4 fw-bold text-success">Etkinlik Ekle</h2>
                
                <form action="<?php $_PHP_SELF ?>" method="POST">
					<!-- Etkinlik Adı -->
					<div class="mb-3">
						<label for="name" class="form-label">Etkinlik Adı</label>
						<input type="text" class="form-control" name="name" placeholder="Etkinlik adı" required>
					</div>
					
					<!-- Etkinlik Açıklaması -->
					<div class="mb-4">
						<label for="desc" class="form-label">Açıklama</label>
						<textarea class="form-control" name="desc" placeholder="Açıklama" required></textarea>
					</div>
					<!-- Tarih -->
					<div class="mb-3">
						<label for="date" class="form-label">Etkinlik Tarihi</label>
						<input type="date" class="form-control" name="date" placeholder="Tarih" required>
					</div>
					
					<!--Buton -->
					<div class="d-flex justify-content-between align-items-center">
						<button type="submit" class="btn btn-primary px-4 py-2 fw-semibold">Ekle</button>
					</div>
					<div class="mb-3">
						<a href='etkinlik.php'>Etkinliklere geri dön</a>
					</div>
				</form>
            </div>

        </div>
    </div>
   </body>
</html>
