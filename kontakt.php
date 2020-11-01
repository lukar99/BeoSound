<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap</title>
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

<h2 class="page-header">
  Gde se nalazimo
</h2>
<div class="col-md-6">

  <p><i class="fas fa-map-marker" aria-hidden="true"></i> Vojvode Bogdana 7, Beograd 11075 </p>
  <p><i class="fas fa-phone" aria-hidden="true"></i> +381 2223331</p>
  <p><i class="fas fa-envelope" aria-hidden="true"></i> beosound@gmail.com</p>
  <hr>
  <br>
  <p>
    <h4 class="text-center"><b>Kontaktirajte nas putem mejla:</b></h3>
      <form> <!-- pocetak forme -->
        <div class="form-group">
          <label for="inputName">Vaše ime i prezime</label>
          <input type="text" class="form-control" id="inputName" placeholder="Upišite Vaše ime i prezime" required>
        </div>
        <div class="form-group">
          <label for="inputEmail">Vaš e-mail</label>
          <input type="email" class="form-control" id="inputEmail" placeholder="Upišite Vaš e-mail" required>
        </div>
        <div class="form-group">
          <label for="inputTel">Vaš telefonski broj</label>
          <input type="tel" class="form-control" id="inputTel" placeholder="Upišite Vaš telefonski broj" required>
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Pošaljite</button>
      </form> <!-- kraj forme -->
    </p>
  </div>
  <div class="col-md-6">
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2830.8539553703376!2d20.4810092!3d44.8041649!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a7a9c165ab241%3A0x7583bb260401d3c3!2z0JLQvtGY0LLQvtC00LUg0JHQvtCz0LTQsNC90LAgNywg0JHQtdC-0LPRgNCw0LQgMTEwNTA!5e0!3m2!1ssr!2srs!4v1599778622174!5m2!1ssr!2srs" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
  </div>
  <div class="col-md-6"></div><div class="col-md-6"></div><div class="col-md-6"></div>

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
