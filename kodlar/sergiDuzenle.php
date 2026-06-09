<!DOCTYPE html>
<html>
<head>
  <title>Bitki Koleksiyonu</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
  
 
  

  
  <style>
	body {
			background: #333333 url('./arkaplan/bg1.png')  center center / cover fixed;
	
		}
	.custom-navbar {
		background-color: #D1CFC5;
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
   
	
?>
<!-- taşıyıcı başlangıcı -->
<div class="container">
 
<!-- tablo başlangıcı-->

 <?php 
	
   
    $baglanti = sqlBaglan();
  $sql = "SELECT * FROM sergi";
  $cevap = mysqli_query($baglanti, $sql);
  
  if(isset($_POST['del'])){
	  $id = (int)$_POST['id'];
	  mysqli_query($baglanti, "DELETE FROM sergi WHERE id='$id'");
	  header("Location: ".$_SERVER['PHP_SELF']);
		exit;
  }
  
   
   
    $cevap = mysqli_query($baglanti, "SELECT * FROM sergi");
  ?>


<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Sergi Adı</th>
      <th scope="col">Sergi Açıklaması</th>
	  <th scope="col">Değiştir</th>
      <th scope="col">Sil</th>
    </tr>
  </thead>
  <tbody>
	 <?php while($sergi = mysqli_fetch_assoc($cevap)):?>
    <tr>
      <th scope="row"><?php echo $sergi['sergi_id']; ?></th>
      <td><?php echo $sergi['sergi_ad']; ?></td>
      <td><?php echo $sergi['sergi_aciklama']; ?></td>
	 <td>    
		<a href="sergiDegistir.php?id=<?php echo $sergi['sergi_id'] ?>">
          <button type="button"name="chg" class="btn btn-secondary btn-sm" > Değiştir </button>
		</a>
        </td>
      <td>    <form method="POST" style="display:inline;">
          
          <input type="hidden" name="id"
                 value="<?php echo $sergi['sergi_id'] ?>">

          <button type="submit"name="del" class="btn btn-danger btn-sm" onclick="return confirm('Sergi kaydı silinsin mi?')"> X </button>

        </form></td>
		
    </tr>
   
  </tbody>
  <?php endwhile;  mysqli_close($baglanti);?>
</table>
<div class="mb-3">
	<a href='sergi.php'>Sergiye geri dön</a>
</div>



<!-- tablo bitişi -->


 
<!-- taşıyıcı bitişi -->
</div>
 
</body>
</html>