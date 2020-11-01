<?php 
$_SESSION['start']="";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Beosound</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/all.min.css" rel="stylesheet">
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

     session_start();
     if(isset($_SESSION['start'])){
      if($_SESSION['start']!="yes"){
        echo '<div class="float-right"><a href="registracija.php">&nbsp&nbspRegistruj se</a></div>
        <div class="float-right">  |  </div>

        <div class="float-right"><a href="login.php">Login&nbsp&nbsp</a></div>';
      }
      else{
        echo '
        <div class="float-right"><a href="logout.php">&nbsp&nbspLogout</a></div>
        <div class="float-right"><a href="profil/nalog.php">'. $_SESSION['username'].'</a>  |  </div>';
      }
    }
    else
    {
      echo '<div class="float-right"><a href="registracija.php">&nbsp&nbspRegistruj se</a></div>
      <div class="float-right">  |  </div>

      <div class="float-right"><a href="login.php">Login&nbsp&nbsp</a></div>';
    }


    ?>

    <h1><a href="index.php"><img src="img/logo.png"></a></h1>
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
        <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Početna strana</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="instrumenti.php"><i class="fas fa-guitar"></i> Instrumenti</a></li>
          <li><a href="onama.php">O nama</a></li>
          <li><a href="kontakt.php">Kontakt</a></li>
        </ul>
        
        <ul class="nav navbar-nav navbar-right">
          <?php if(isset($_SESSION['start'])) {
            if(isset($_SESSION['role']) && $_SESSION['role']=="korisnik")
            {
              ?>
              <li><a href="korpa/korpa.php"><i class="fas fa-shopping-cart"> <span id="" class="badge badge-danger"></span></i></a></li>
              <?php
            }
            else
            {
            }
          }?>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav> <!-- kraj nav menija -->

  <div class="row"> <!-- ovo je pocetak reda -->
    <div class="col-md-6"> <!-- pocetak leve strane -->
      <div class="jumbotron">
        <h2 class="text-center">Instrumenti</h2>
        <p class="text-center">Veliki asortiman novih instrumenata svih poznatih svetskih brendova muzičke industrije!</p>
        <p class="text-center"><a class="btn btn-primary btn-lg " href="instrumenti.php" role="button">Detaljnije</a></p>
      </div>
    </div><!-- kraj leve strane -->
    <div class="col-md-6"><!-- pocetak desne strane -->
      <div class="jumbotron">
        <h2 class="text-center">Prijavi se!</h2>
        <p class="text-center">Postani član našeg sajta kako bi mogao da naručiš neke od naših proizvoda!</p>
        <p class="text-center"><a class="btn btn-primary btn-lg " href="login.php" role="button">Detaljnije</a></p>
      </div>
    </div><!-- kraj desne strane -->
  </div><!-- ovo je kraj reda -->


  <div class="row"> <!-- pocetak reda thumbnail -->

    <div class="col-sm-6 col-md-4"> <!-- pocetak prvog -->
      <div class="thumbnail">
        <img src="img/vintage.jpg" alt="...">
        <div class="caption">
          <h3 class="text-center">Ibanez Bass</h3>
          <hr>
          <p class="text-center"><a href="instrumenti.php" class="btn btn-primary" role="button">Pogledajte</a></p>
        </div>
      </div>
    </div> <!-- kraj prvog -->

    <div class="col-sm-6 col-md-4"> <!-- pocetak drugog -->
      <div class="thumbnail">
        <img src="img/bubnjevi.jpg" alt="...">
        <div class="caption">
          <h3 class="text-center">Bubnjevi</h3>
          <hr>
          <p class="text-center"><a href="instrumenti.php" class="btn btn-primary" role="button">Pogledajte</a></p>
        </div>
      </div>
    </div> <!-- kraj drugog -->

    <div class="col-sm-6 col-md-4"> <!-- pocetak treceg -->
      <div class="thumbnail">
        <img src="img/gitara.jpg" alt="...">
        <div class="caption">
          <h3 class="text-center">Električna gitara</h3>
          <hr>
          <p class="text-center"><a href="instrumenti.php" class="btn btn-primary" role="button">Pogledajte</a></p>
        </div>
      </div>
    </div> <!-- kraj treceg -->

  </div> <!-- kraj reda thumbnail -->

  <footer> <!-- pocetak footera -->

    <div class="row"> <!-- pocetak gornjeg dela footera -->
      <div class="col-md-4">
        <div class="page-header">
          <h4>O nama</h4>
        </div>
        <p>Beosound je preduzeće koje se bavi prodajom muzičkih instrumenata svih vrsta i kategorija kao i prateće opreme.</p>
      </div>
      <div class="col-md-4">
        <div class="page-header">
          <h4>Kontakt podaci</h4>
        </div>
        <p><i class="fas fa-map-marker" aria-hidden="true"></i> Vojvode Bogdana 7, Beograd 11075 </p>
        <p><i class="fas fa-phone" aria-hidden="true"></i> +381 2223331</p>
        <p><i class="fas fa-envelope" aria-hidden="true"></i> beosound@gmail.com</p>
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
           <li><a href="onama.php">O nama</a></li>
           <li><a href="instrumenti.php">Proizvodi</a></li>
           <li><a href="kontakt.php">Kontakt</a></li>
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
  
</script>
</body>
</html>
