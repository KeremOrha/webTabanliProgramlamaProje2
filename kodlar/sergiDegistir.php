<!DOCTYPE html>
<html>
<head>
  <title>Sergi Değiştir</title>
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
   if (!isset($_SESSION['username'])){ 
		
		header("Location: index.php"); 
   
   } 	
   
   require('vtbaglan.php'); 
   
	
   
    $baglanti = sqlBaglan();
	
	
	$id = $_GET['id'];
	$sql2 = "SELECT * FROM sergi WHERE sergi_id = '$id'";
	$cevap2 = mysqli_query($baglanti,$sql2);
	
	$sergi = mysqli_fetch_assoc($cevap2);
   if (isset($_POST['name']) && isset($_POST['desc'])){ 
   
   extract($_POST); 
   
 
	$sql = $baglanti->prepare("UPDATE sergi SET sergi_ad=?, sergi_aciklama=? WHERE sergi_id = ?");

	$sql->bind_param( "ssi", $name, $desc, $id);

	$cevap = $sql->execute();
   

   if(!$cevap ){ 
   
       echo '<br>Hata:' . mysqli_error($baglanti); 
   
   } 
      if(isset($_POST['name'])){
	  
	  header("Location: sergiDuzenle.php");
		exit;
  }
   
   } 
	 
   ?> 


    <div class="full-screen-container">
        <div class="login-container">
               <?php 
			//mesaj varsa ekrana yazdır. 
         
			if (isset($mesaj)) echo $mesaj; ?> 
            <div class="p-5 bg-white border rounded-3 shadow">
                <h2 class="text-center mb-4 fw-bold text-success">Değiştir</h2>
                
                <form action="<?php $_PHP_SELF ?>" method="POST">
					
					<!-- Sergi Adı -->
					<div class="mb-3">
						<label for="name" class="form-label">Sergi adı</label>
						<input type="text" class="form-control" value="<?php echo $sergi['sergi_ad']; ?>"name="name" placeholder="sergi Adı" required>
					</div>
					
					<!-- Açıklama -->
					<div class="mb-4">
						<label for="desc" class="form-label">Sergi Açıklaması</label>
						
						<textarea class="form-control" name="desc" placeholder="Açıklama" required ><?php echo $sergi['sergi_aciklama']; ?></textarea>
					</div>
					
					
					
					<!--Butonlar -->
					<div class="d-flex justify-content-between align-items-center">
						<button type="submit" class="btn btn-success px-4 py-2 fw-semibold">Kaydet</button>
					</div>
					<div class="mb-3">
						<a href='sergiDuzenle.php'>Düzenlemeye geri dön</a>
					</div>
				</form>
            </div>

        </div>
    </div>

</body>
</html>
