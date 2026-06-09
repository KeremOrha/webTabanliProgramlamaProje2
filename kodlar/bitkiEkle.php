<?php 
session_start();

if (!isset($_SESSION['username'])){ 
		
		header("Location: index.php"); 
   
   } 


   require ('vtbaglan.php'); 
   
   
   
   
    $baglanti = sqlBaglan();
   
   if (isset($_POST['name']) && isset($_POST['desc']) && isset($_POST['photo']) && isset($_POST['link'])){ 
   
    extract($_POST); 
   
    // sifre metni SHA256 ile şifreleniyor. 
   
     
    $sql = $baglanti->prepare ("SELECT * FROM bitki WHERE  bitki_ad=?");
	$sql->bind_param("s", $name);
	   
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
		  
	    $sql = $baglanti->prepare ("INSERT INTO bitki (bitki_ad, bitki_aciklama, bitki_foto_adi, bitki_link) VALUES (?, ?, ?, ?)");
		$sql->bind_param("ssss", $name, $desc, $photo, $link);
	   
		$cevap=$sql->execute();
	   
			
	   
		   
	   
		   if ($cevap){ 
				$mesaj = "<h1>Bitki eklendi</h1>"; 
			   
	   
		   }else{ 
	   
			   $mesaj = "<h1>Bitki Eklenemedi!</h1>"; 
	   
		   } 
	   
	   } 
	   else{
		   $mesaj = "<h1>Bitki zaten var</h1>";
	   }
   }
   mysqli_close($baglanti);
   ?> 
<html>
	<head>
	   <!-- türkçe karakter desteği ayarı --> 
	   <meta http-equiv="Content-Type" content="text/html;  
		  charset=UTF-8" />
		  <meta charset="utf-8">
		  <title>Bitki Ekle</title>
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
                <h2 class="text-center mb-4 fw-bold text-success">Bitki Ekle</h2>
                
                <form action="<?php $_PHP_SELF ?>" method="POST">
					<!-- Bitki Adı -->
					<div class="mb-3">
						<label for="name" class="form-label">Bitki Adı</label>
						<input type="text" class="form-control" name="name" placeholder="Bitki adı" required>
					</div>
					
					<!-- Bitki Açıklaması -->
					<div class="mb-4">
						<label for="desc" class="form-label">Açıklama</label>
						<textarea class="form-control" name="desc" placeholder="Açıklama" required></textarea>
					</div>
					
					<div class="mb-3">
						<label for="photo" class="form-label">Bitki Fotoğraf Adı</label>
						<input type="text" class="form-control" name="photo" placeholder="Foto adı" required>
					</div>
					<div class="mb-3">
						<label for="link" class="form-label">Daha fazla bilgi linki</label>
						<input type="text" class="form-control"  name="link" placeholder="Link" required>

					</div>
					
					<!--Buton -->
					<div class="d-flex justify-content-between align-items-center">
						<button type="submit" class="btn btn-primary px-4 py-2 fw-semibold">Ekle</button>
					</div>
					<div class="mb-3">
						<a href='koleksiyon.php'>Koleksiyona geri dön</a>
					</div>
				</form>
            </div>

        </div>
    </div>
   </body>
</html>