<!DOCTYPE html>
<html>
<head>
  <title>Etkinlikler</title>
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
	
	$sql = "SELECT * FROM etkinlik";
	
	
	$kategori = $_GET['kategori'] ?? '';
	
	switch($kategori){
		case "1":
			$sql = "SELECT * FROM etkinlik ORDER BY etkinlik_tarih DESC";
			break;
		case "2":
			$sql = "SELECT * FROM etkinlik ORDER BY etkinlik_tarih ASC";
			break;
		case "3":
			$sql = "SELECT * FROM etkinlik ORDER BY etkinlik_ad ASC";
			break;
		case "4":
			$sql = "SELECT * FROM etkinlik ORDER BY etkinlik_ad DESC";
			break;
		default:
			$sql = "SELECT * FROM etkinlik";
			break;
		
	}
	$cevap =  mysqli_query($baglanti, $sql);
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
			
			<a class="nav-link" href="koleksiyon.php"><b>Bitki Koleksiyonu</b></a>
			
			<a class="nav-link" href="sergi.php"><b>Sergiler</b></a>
			
			<a class="nav-link active" aria-current="page" href="#"><b>Etkinlikler</b></a>
			
			
		</div>
		<div class="ms-auto">
			<?php if (isset($_SESSION['username'])): ?>
				<div class="navbar-nav">
					<a class="nav-link" href="etkinlikDuzenle.php"><b>Etkinlik Düzenle</b></a>
					<a class="nav-link" href="etkinlikEkle.php"><b>Etkinlik Ekle</b></a>
					<a class="nav-link" href="etkinlik.php?cikis=1"><b>Çıkış Yap</b></a>
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
 <div class="row g-3">
 
	  <!-- select başlangıcı -->
	 <form method="GET">

    <select name="kategori"
            class="form-select"
            onchange="this.form.submit()">
		<option value="">Seçiniz</option>
		
        <option value="1"<?php if($kategori=="1") echo "selected"; ?>>En yeni</option>

        <option value="2"<?php if($kategori=="2") echo "selected"; ?>>En eski</option>

        <option value="3"<?php if($kategori=="3") echo "selected"; ?>>A-Z</option>

        <option value="4"<?php if($kategori=="4") echo "selected"; ?>>Z-A</option>

    </select>

</form>
	<!-- select bitişi -->
	  
	<!-- accordion başlangıcı -->

	<div class="accordion accordion-flush" id="accordionFlushExample">
	<?php while($etkinlik = mysqli_fetch_assoc($cevap)): ?>
	  <div class="accordion-item">
	  
		<h2 class="accordion-header id="heading<?php echo $etkinlik['etkinlik_id']; ?>">
		  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $etkinlik['etkinlik_id']; ?>" aria-expanded="false" aria-controls="collapse<?php echo $etkinlik['etkinlik_id']; ?>">
			<?php echo $etkinlik['etkinlik_ad']; ?>
		  </button>
		</h2>
		<div id="collapse<?php echo $etkinlik['etkinlik_id']; ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
		  <div class="accordion-body"><?php echo $etkinlik['etkinlik_tarih'];  echo"<br>";  echo $etkinlik['etkinlik_aciklama']; ?>
		  </div>
		</div>
	  </div>
	 <?php endwhile;  mysqli_close($baglanti);?>
	</div>

</div>

<!-- accordion bitişi-->
 
<!-- taşıyıcı bitişi -->
</div>
 
</body>
</html>