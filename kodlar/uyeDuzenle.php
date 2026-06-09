<!DOCTYPE html>
<html>
<head>
  <title>Üye Duzenle</title>
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

if ($_SESSION['yonetici_mi'] != 1){ 
		
		header("Location: index.php"); 
   
   } 

require('vtbaglan.php'); 
   
	
?>
<!-- taşıyıcı başlangıcı -->
<div class="container">
 
<!-- tablo başlangıcı-->

 <?php 
	
   
    $baglanti = sqlBaglan();

  if(isset($_POST['del'])){
	$id = (int)$_POST['id'];
	  
	$sql = $baglanti->prepare("DELETE FROM uye WHERE uye_id=?");

	$sql->bind_param( "i", $id);

	$cevap = $sql->execute();
	 
	  header("Location: ".$_SERVER['PHP_SELF']);
		exit;
  }

    $cevap = mysqli_query($baglanti, "SELECT * FROM uye");
  ?>


<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Üye Adı</th>
      <th scope="col">Üye Yönetici mi</th>
	  <th scope="col">Değiştir</th>
      <th scope="col">Sil</th>
    </tr>
  </thead>
  <tbody>
	 <?php while($uye = mysqli_fetch_assoc($cevap)):?>
    <tr>
      <th scope="row"><?php echo $uye['uye_id']; ?></th>
      <td><?php echo $uye['uye_ad']; ?></td>
	  <td><?php echo ($uye['uye_yonetici_mi']==1)?'evet' : 'hayır' ; ?></td>
	  <td>    
		<a href="uyeDegistir.php?id=<?php echo $uye['uye_id'] ?>">
          <button type="button"name="chg" class="btn btn-secondary btn-sm" > Değiştir </button>
		</a>
        </td>
      <td>    <form method="POST" style="display:inline;">
          
          <input type="hidden" name="id"
                 value="<?php echo $uye['uye_id'] ?>">

          <button type="submit"name="del" class="btn btn-danger btn-sm" onclick="return confirm('Üye silinsin mi?')"> X </button>

        </form></td>
		
    </tr>
   
  </tbody>
  <?php endwhile;  mysqli_close($baglanti);?>
</table>
<div class="mb-3">
	<a href='anaSayfa.php'>Anasayfaya geri dön</a>
</div>



<!-- tablo bitişi -->


<!-- taşıyıcı bitişi -->
</div>
 
</body>
</html>
