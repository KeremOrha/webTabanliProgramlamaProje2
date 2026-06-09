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
			background: #333333 url('./arkaplan/bg2.png')  center center / cover fixed;
	
		}
	h1{
		color: #D61071;
	}
    </style>
</head>
<body>



<?php   
session_start();
if(isset($_GET['cikis'])){
	session_destroy();
	header("Location: ".$_SERVER['PHP_SELF']);
}

require('vtbaglan.php'); 
   
	
   
    $baglanti = sqlBaglan();
?>
<!-- taşıyıcı başlangıcı -->
<div class="container">
  <h1>Botanik Bahçesi</h1>
  
<!-- navbar başlangıcı --> 
<nav class="navbar navbar-expand-lg bg-transparent">
  <div class="container-fluid">
    <a class="navbar-brand"><img src="./logo.png" alt="Bootstrap" width="90" height="72"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
		<div class="navbar-nav">
	  
			<a class="nav-link"  href="anaSayfa.php"><b>Ana Sayfa</b></a>
			
			<a class="nav-link active" aria-current="page" href="#"><b>Bitki Koleksiyonu</b></a>
			
			<a class="nav-link" href="sergi.php"><b>Sergiler</b></a>
			
			<a class="nav-link" href="etkinlik.php"><b>Etkinlikler</b></a>
			
			
		</div>
		<div class="ms-auto">
			<?php if (isset($_SESSION['username'])): ?>
				<div class="navbar-nav">
					<a class="nav-link" href="bitkiDuzenle.php"><b>Bitki Düzenle</b></a>
					<a class="nav-link" href="bitkiEkle.php"><b>Bitki Ekle</b></a>
					<a class="nav-link" href="koleksiyon.php?cikis=1"><b>Çıkış Yap</b></a>
				</div>
			<?php else:?>
				<div class="navbar-nav">
				<a class="nav-link" href="index.php"><b>Giriş Yap</b></a>
				</div>
			<?php endif; ?>
		</div>
    </div>
  </div>
</nav>
<!-- navbar bitişi --> 
  
  <!--kart başlangıcı -->
  <?php 
  $sql = "SELECT * FROM bitki";
  $cevap = mysqli_query($baglanti, $sql);
  
  
  
  ?>
  <div class="row g-3">
  
  
  <?php 
	while($bitki = mysqli_fetch_assoc($cevap)):
	
  
  ?>
  <div class="col-lg-3 col-sm-3 mb-3 mb-sm-0">
    <div class="card" h-100">
	<img src="./koleksiyon/<?php echo $bitki['bitki_foto_adi']; ?>" class="card-img-top" style="height:250px; object-fit:cover;" alt="rsm<?php echo $bitki['bitki_id']; ?>">
      <div class="card-body">
        <h5 class="card-title"><?php echo $bitki['bitki_ad']; ?></h5>
        <p class="card-text"><?php echo $bitki['bitki_aciklama']; ?></p>
        <a href="<?php echo $bitki['bitki_link']; ?>" target="_blank" class="btn btn-success">Daha fazla bilgi al</a>
		
      </div>
    </div>
  </div>
  

  <?php endwhile;  mysqli_close($baglanti);?>
  </div>
 


 
 </div>
 <!-- kart bitişi -->



 
<!-- taşıyıcı bitişi -->
</div>
 
</body>
</html>