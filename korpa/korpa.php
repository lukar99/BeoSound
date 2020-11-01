<?php 
session_start();
if($_SESSION['start']!="yes" || $_SESSION['role']!="korisnik"){
  header("location:../login.php");
  die();
}
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
      <div class="row justify-content-center">
        <div class="col-lg-12">
          <div class="table-responsive mt-2">
            <table class="table table-bordered table-striped text-center">
             <thead>
              <tr>
                <td colspan="9">
                  <h4 class="text-center text-info m-0">Proizvodi u korpi</h4>
                </td>
              </tr>
              <tr>
                <th>ID</th>
                <th></th>
                <th>Naziv proizvoda</th>
                <th>Brend</th>
                <th>Tip proizvoda</th>
                <th>Cena proizvoda</th>
                <th>Količina</th>
                <th>Ukupna cena</th>
                <th>
                  <a href="../insert-korpa.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Da li ste sigurni da želite da izbacite sve proizvode?');"><i class="fas fa-trash"></i>&nbsp;&nbsp;Isprazni korpu</a>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php 
              require '../config.php';
              $stmt = $conn->prepare("SELECT * FROM korpa WHERE korisnik='".$_SESSION['username']."' ");
              $stmt->execute();
              $result = $stmt->get_result();
              $grand_total = 0;
              while($row = $result->fetch_assoc()):
               ?>
               <tr>
                 <td  style="padding-top: 20px;"><?= $row['id'] ?></td>
                 <input type="hidden" class="pid" value="<?= $row['id']?>">
                 <td><img src="<?= $row['image'] ?>" width="60"></td>
                 <td  style="padding-top: 20px;"><?= $row['naziv_proizvoda'] ?></td>
                 <td  style="padding-top: 20px;"><?= $row['brend'] ?></td>
                 <td  style="padding-top: 20px;"><?= $row['tip_proizvoda'] ?></td>
                 <td  style="padding-top: 20px;"><?= number_format($row['cena_proizvoda'],2); ?> rsd</td>
                 <input type="hidden" class="pprice" value="<?= $row['cena_proizvoda'] ?>">
                 <td  style="padding-top: 10px;">
                  <input type="number" class="form-control itemQty" value="<?= $row['kolicina']?>" style="width:75px;">
                </td>
                <td  style="padding-top: 20px;"><?= number_format($row['ukupna_cena'],2); ?> rsd</td>
                <td>
                 <a href="../insert-korpa.php?remove=<?= $row['id'] ?>" class="text-danger lead" onclick="return confirm('Da li ste sigurni da želite da izbrišete ovaj proizvod?');"><i class="fas fa-trash-alt text-center" style="padding-top: 20px;"></i></a>
               </td>
             </tr>
             <?php $grand_total +=$row['ukupna_cena']; ?>
           <?php endwhile; ?>
           <tr>
            <td colspan="4">
              <a href="../instrumenti.php" class="btn btn-primary btn-block"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp; Nastavi sa kupovinom</a>
            </td>
            <td colspan="3">
              <b>Ukupan račun</b>
            </td>
            <td><b><?= number_format($grand_total,2) ?> rsd</b></td>
            <td>
              <a href="checkout.php" class="btn btn-info <?= ($grand_total>1)?"":"disabled"; ?>"><i class="far fa-credit-card"></i>&nbsp;&nbsp; Poruči</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>



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
          <li><a href="">Kontakt</a></li>
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

    $(".itemQty").on('change', function(){
      var $el = $(this).closest('tr');

      var pid = $el.find(".pid").val();
      var pprice = $el.find(".pprice").val();
      var qty = $el.find(".itemQty").val();
      location.reload(true);

      $.ajax({
        url:'../insert-korpa.php',
        method: 'post',
        cache: false,
        data: {qty:qty, pid:pid, pprice:pprice},
        success: function(response){
          console.log(response);
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
