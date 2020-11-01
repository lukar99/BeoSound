<?php 
session_start();
if($_SESSION['start']!="yes" || $_SESSION['role']!="korisnik"){

	die();
}
require '../config.php';

$grand_total=0;
$allItems = '';
$items = array();

$sql = "SELECT CONCAT(naziv_proizvoda, '(',kolicina,')') AS ItemQty, ukupna_cena FROM korpa WHERE korisnik= '".$_SESSION['username']."'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while($row=$result->fetch_assoc())
{
	$grand_total += $row['ukupna_cena'];
	$items[] = $row['ItemQty'];
}

$allItems = implode(", ", $items);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Beosound</title>
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/custom.css">
  
  <link href="https://fonts.googleapis.com/css2?family=Lato&family=Montserrat+Alternates:wght@500&display=swap" rel="stylesheet">
  <style>
  body {
    font-family: 'Lato', sans-serif !important;
  }
  #alert{
    display: none;
  }
  .float-right{
    float: right;
    line-height: 50px;
    font-size: 15px;
  }
</style>
</head>
<body>
  <div class="container"> <!-- pocetak kontejnera -->
    <div class="page-header">
     <?php

     if(isset($_SESSION['start'])){
      if($_SESSION['start']!="yes"){
        echo '<div class="float-right"><a href="registracija.php">&nbsp&nbspRegistruj se</a></div>
        <div class="float-right">  |  </div>

        <div class="float-right"><a href="login.php">Login&nbsp&nbsp</a></div>';
      }
      else{
        echo '
        <div class="float-right"><a href="../logout.php">&nbsp&nbspLogout</a></div>
         <div class="float-right"><a href="../profil/nalog.php">'. $_SESSION['username'].'</a>  |  </div>';
      }
    }
    else
    {
      echo '<div class="float-right"><a href="registracija.php">&nbsp&nbspRegistruj se</a></div>
      <div class="float-right">  |  </div>

      <div class="float-right"><a href="login.php">Login&nbsp&nbsp</a></div>';
    }


    ?>

    <h1><a href="../index.php"><img src="../img/logo.png"></a></h1>
  </div>
  <nav class="navbar navbar-default"> <!-- pocetak navigacionog menija -->
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="../index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Početna strana</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="../instrumenti.php"><i class="fas fa-guitar"></i> Instrumenti</a></li>
          <li><a href="../onama.php">O nama</a></li>
          <li><a href="../kontakt.php">Kontakt</a></li>
        </ul>
        
        <ul class="nav navbar-nav navbar-right">
          <?php if(isset($_SESSION['start'])) {
            if($_SESSION['role']=="korisnik"){
             ?>
             <li><a href="korpa.php"><i class="fas fa-shopping-cart"> <span id="" class="badge badge-danger"></span></i></a></li>
             <?php }}?>
           </ul>
         </div><!-- /.navbar-collapse -->
       </div><!-- /.container-fluid -->
     </nav> <!-- kraj nav menija -->

     <div class="container">
       <div class="row justify-content-center" id="order">
        <div class="col-lg-12 px-2 pb-2">
         <h4 class="text-center text-info p-2">Potvrdite svoju porudžbinu</h4>
         <div class="jumbotron p-3 mb-2 text-center">
          <h6 class="lead"><b>Proizvodi : </b><?= $allItems; ?></h6>
          <h6 class="lead"><b>Cena isporuke :</b>Besplatno</h6>
          <h5 class="lead"><b>Ukupni troškovi : </b><?= number_format($grand_total,2) ?> rsd</h5>
        </div>

      </div>
      <div class="col-lg-6">
        <p><b>Dodatne informacije za isporuku:</b></p>

        <form action="" method="post" id="placeOrder">
          <input type="hidden" name="products" value="<?= $allItems; ?>">
          <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
          <input type="hidden" name="">
          <div>
           <input type="tel" name="phone" class="form-control" placeholder="Unesite broj telefona" required>
         </div><br>

         <p><b>Izaberite način plaćanja:</b><p>
          <div class="form-group">
           <select name="pmode" class="form-control">
            <option value="" selected disabled>-Način plaćanja-</option>
            <option value="Plaćanje pouzećem">Plaćanje pouzećem</option>
            <option value="Plaćanje karticom">Plaćanje karticom</option>
          </select>
        </div>
        <div class="form-group">
         <input type="submit" name="submit" value="Poruči" class="btn btn-primary btn-block">
       </div>
     </form>
   </div>
 </div>
</div>



<footer> <!-- pocetak footera -->

  <div class="row"> <!-- pocetak gornjeg dela footera -->
    <div class="col-md-4">
      <div class="page-header">
        <h4>O nama</h4>
      </div>
      <p>Beosound je preduzeće koje se bavi prodajom muzičkih instrumenata svih vrsta i kategorija kao i prateće opreme</p>
    </div>
    <div class="col-md-4">
      <div class="page-header">
        <h4>Kontakt podaci</h4>
      </div>
      <p><i class="fas fa-map-marker-alt"></i> Adresa</p>
      <p><i class="fas fa-phone"></i> Telefon</p>
      <p><i class="fas fa-envelope"></i> Mejl</p>
    </div>
    <div class="col-md-4">
      <div class="page-header">
        <h4>Pratite nas</h4>
      </div>
      <a href=""><i class="fab fa-facebook-f fa-3x"></i></a> &nbsp
      <a href=""><i class="fab fa-twitter fa-3x"></a></i>&nbsp
      <a href=""><i class="fab fa-instagram fa-3x"></a></i>&nbsp
      <a href=""><i class="fab fa-linkedin fa-3x"></a></i>&nbsp
    </div>
  </div><!-- kraj gornjeg dela footera -->

  <div class="panel-footer"><!--  pocetak donjeg dela footera -->
    <div class="row">
      <div class="col-md-6">
        <ul class="list-inline">
          <li><a href="../onama.php">O nama</a></li>
          <li><a href="../instrumenti.php">Proizvodi</a></li>
          <li><a href="../kontakt.php">Kontakt</a></li>
        </ul>
      </div>
      <div class="col-md-6">
        <p class="text-right">Copyright &copy; 2020 Beosound</p>
      </div>
    </div> 
  </div><!-- kraj donjeg dela footera-->
</footer> <!-- kraj footera -->

</div> <!-- kraj kontejnera -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){

  	$("#placeOrder").submit(function(e)
  	{
  		e.preventDefault();
  		$.ajax({
  			url: '../insert-korpa.php',
  			method: 'post',
  			data: $('form').serialize()+"&action=order",
  			success: function(response){
  				$("#order").html(response);
  			}
  		});
  	});



    load_cart_item_number();

    function load_cart_item_number(){
      $.ajax({
        url: 'korpa/korpa.php',
        method: 'get',
        data: {cartItem:"cart_item"},
        success:function(response){
          $("#cart-item").html(response);
        }
      });
    }
  });

</script>
</body>
</html>
