<!DOCTYPE html>
<html>
<head>
  <title>Ana Sayfa</title>
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
	  
			<a class="nav-link active" aria-current="page" href="#"><b>Ana Sayfa</b></a>
			
			<a class="nav-link" href="koleksiyon.php"><b>Bitki Koleksiyonu</b></a>
			
			<a class="nav-link" href="sergi.php"><b>Sergiler</b></a>
			
			<a class="nav-link" href="etkinlik.php"><b>Etkinlikler</b></a>
			
			
		</div>
		<div class="ms-auto">
			<?php if (isset($_SESSION['username'])): ?>
				<div class="navbar-nav">
				<?php if ($_SESSION['yonetici_mi']==1): ?>
					<a class="nav-link" href="uyeDuzenle.php"><b>Üye Düzenle</b></a>
					<a class="nav-link" href="uyeEkle.php"><b>Üye Ekle</b></a>
					<?php endif; ?>
					<a class="nav-link "href="anaSayfa.php?cikis=1"><b>Çıkış Yap</b></a>
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
  
  
 <!-- carousel başlangıcı --> 

	<div id="carouselExampleAutoplaying" class="carousel slide w-75 mx-auto" data-bs-ride="carousel">
	  <div class="carousel-inner">
		<div class="carousel-item active">
		  <img src="./anaSayfa/rsm1.png" class="d-block w-100" alt="...">
		</div>
		<div class="carousel-item">
		  <img src="./anaSayfa/rsm2.png" class="d-block w-100" alt="...">
		</div>
		<div class="carousel-item">
		  <img src="./anaSayfa/rsm3.png" class="d-block w-100" alt="...">
		</div>
	  </div>
	  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Previous</span>
	  </button>
	  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Next</span>
	  </button>
	</div>
 <!-- carousel bitişi --> 
 

 
<!-- taşıyıcı bitişi -->
</div>
 
</body>
</html>