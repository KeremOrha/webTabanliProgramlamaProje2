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
			
			<a class="nav-link" href="koleksiyon.php"><b>Bitki Koleksiyonu</b></a>
			
			<a class="nav-link active" aria-current="page" href="etkinlik.php"><b>Sergiler</b></a>
			
			<a class="nav-link" href="etkinlik.php"><b>Etkinlikler</b></a>
			
			
		</div>
		<div class="ms-auto">
			<?php if (isset($_SESSION['username'])): ?>
				<div class="navbar-nav">
					<a class="nav-link" href="sergiDuzenle.php"><b>Sergi Düzenle</b></a>
					<a class="nav-link" href="sergiEkle.php"><b>Sergi Ekle</b></a>
					<a class="nav-link" href="sergi.php?cikis=1"><b>Çıkış Yap</b></a>
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
  
 <!-- scrollspy başlangıç -->
 
  <?php 
  $sql = "SELECT * FROM sergi";
  $cevap = mysqli_query($baglanti, $sql);
  
  $sergiler = [];
	while($row = mysqli_fetch_assoc($cevap)){
		$sergiler[] = $row;
	}
  ?>
  

<div class="row">
 
  <div class="col-4">
    <div id="list-example" class="list-group">
		<?php foreach($sergiler as $s):?>		
		<a class="list-group-item list-group-item-action" href="#list-item-<?php echo $s['sergi_id']; ?>"><?php echo $s['sergi_ad']; ?></a>
     <?php endforeach; ?>
    </div>
	
  </div>

  <div class="col-8">
    <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-smooth-scroll="true" class="scrollspy-example overflow-auto" style="height:50vh; "tabindex="0">
		<?php foreach($sergiler as $s):?>
		<h4 id="list-item-<?php echo $s['sergi_id']; ?>"><?php echo $s['sergi_ad']; ?></h4>
		<p class="text-wrap"><?php echo $s['sergi_aciklama']; ?></p>  
		<?php endforeach; ?>
    </div>
	
	
  </div>
  
</div>

 <!-- scrollspy bitişi -->


<!-- taşıyıcı bitişi -->
</div>
 
</body>
</html>
