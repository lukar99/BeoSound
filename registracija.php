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
  <link rel="stylesheet" href="css/style.css">
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
          <li><a href="#">Kontakt</a></li>
        </ul>
       
        <ul class="nav navbar-nav navbar-right">

          
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav> <!-- kraj nav menija -->

  <div class="container mt-4">
    <div class="row">
      <div class="col-lg-4 offset-lg-4" id="alert">
        <div class="alert alert-success">
          <strong id="result"></strong>
        </div>
      </div>
    </div>
  </div>

  <div class="main">

    <!-- Sign up form -->
    <section class="signup">
      <div class="container">
        <div class="signup-content">
          <div class="signup-form">
            <h2 class="form-title">Registruj se</h2>
            <form method="POST" action="code.php" class="register-form" id="register-form">
              <div class="form-group">
                <input type="text" name="name" id="name" placeholder="Ime i prezime" required  />
              </div>
              <div class="form-group">
                <input type="text" name="address" id="address" placeholder="Adresa" required  />
              </div>

              <div class="form-group">
                <input type="email" name="email" id="email" placeholder="Email" required/>
              </div>
              <div class="form-group">
                <input type="text" name="username" id="username" placeholder="Username" required/>
              </div>
              <div class="form-group">
                <input type="password" name="pass" id="pass" placeholder="Password" minlength="6" required/>
              </div>
              <div class="form-group">
                <input type="password" name="cpass" id="cpass" placeholder="Potvrdite password" required/>
              </div>
              
              <div class="form-group form-button">
                <input type="submit" name="register" id="register" class="form-submit" value="Registruj se"/>
              </div>

              <h5 class="text-danger text-center"><b><?php if(isset($_SESSION['msg'])){echo $_SESSION['msg']; unset($_SESSION['msg']);}  ?></b></h5>
            </form>

          </div>
          <div class="signup-image">
            <figure><img src="img/signup-image.jpg" alt="sing up image"></figure>
            <a href="login.php" class="signup-image-link">Već imate nalog?</a>
          </div>
        </div>
      </div>
    </section>

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
              <li><a href="onama.php">O nama</a></li>
              <li><a href="instrumenti.php">Proizvodi</a></li>
              <li><a href="">Kontakt</a></li>
            </ul>
          </div>
          <div class="col-md-6">
            <p class="text-right">Copyright &copy; 2020 Beosound</p>
          </div>
        </div> 
      </div><!-- kraj donjeg dela footera-->
    </footer> <!-- kraj footera -->
    

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $("#register-form").validate({
          rules:{
            cpass:{
              equalTo:"#pass",
            }
          }
        });

        
      });
    </script>
    <script type="text/javascript">
      jQuery.extend(jQuery.validator.messages, {
        required: "Ovo polje je obavezno",
        remote: "Please fix this field.",
        email: "Unesite validnu email adresu.",
        url: "Please enter a valid URL.",
        date: "Please enter a valid date.",
        dateISO: "Please enter a valid date (ISO).",
        number: "Please enter a valid number.",
        digits: "Please enter only digits.",
        creditcard: "Please enter a valid credit card number.",
        equalTo: "Šifre se moraju poklapati",
        accept: "Please enter a value with a valid extension.",
        maxlength: jQuery.validator.format("Ne možete uneti više od {0} karaktera."),
        minlength: jQuery.validator.format("Morate uneti najmanje {0} karaktera."),
        rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
        range: jQuery.validator.format("Please enter a value between {0} and {1}."),
        max: jQuery.validator.format("Ne možete uneti više od {0} karaktera."),
        min: jQuery.validator.format("Morate uneti najmanje {0} karaktera.")
      });
    </script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <?php
    if(isset($_SESSION['status']) && $_SESSION['status']!='')
    {
      ?>
      <script>
        swal({
          title: "<?php echo $_SESSION['status']; ?>",
          
          icon: "<?php echo $_SESSION['status_code']; ?>",
          button: "Ok",
        }).then(function() {
          window.location = "login.php";
        });
      </script>

      <?php
      unset($_SESSION['status']);
    }

    ?>
  </body>
  </html>
