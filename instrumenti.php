<?php
require 'config.php';

//paginacija
$total_pages = $conn->query('SELECT * FROM proizvodi')->num_rows;

//broj stranice
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

//broj proizvoda po stranici
$num_results_on_page = 6;

if ($stmt = $conn->prepare('SELECT * FROM proizvodi ORDER BY id LIMIT ?,?')) {
	// Calculate the page to get the results we need from our table.
	$calc_page = ($page - 1) * $num_results_on_page;
	$stmt->bind_param('ii', $calc_page, $num_results_on_page);
	$stmt->execute(); 
	$results = $stmt->get_result();
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
		
		<link href="https://fonts.googleapis.com/css2?family=Baloo+Tamma+2:wght@500&family=Lato&display=swap" rel="stylesheet">

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
								<li><a href="korpa/korpa.php"><i class="fas fa-shopping-cart"> <span id="cart-item" class="badge badge-danger"></span></i></a></li>
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


		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-3">
					<h5 class="text-info">Filteri</h5>
					<hr>
					<h5 class="text-info"><b>Izaberite tip proizvoda</b></h5>
					<ul class="list-group">
						<?php
						$sql="SELECT DISTINCT tip_proizvoda FROM proizvodi ORDER BY tip_proizvoda";
						$result=$conn->query($sql);
						while($row=$result->fetch_assoc()){
							?>
							<li class="list-group-item">
								<div class="form-check">
									<label class="form-check-label">
										<input type="checkbox" class="form-check-input product_check" value="<?= $row['tip_proizvoda']; ?>" id="tip_proizvoda"><?= $row['tip_proizvoda']; ?>
									</label>
								</div>
							</li>
							<?php } ?>
						</ul>

						<h5 class="text-info"><b>Izaberite brend proizvoda</b></h5>
						<ul class="list-group">
							<?php
							$sql="SELECT DISTINCT brend FROM proizvodi ORDER BY brend";
							$result=$conn->query($sql);
							while($row=$result->fetch_assoc()){
								?>
								<li class="list-group-item">
									<div class="form-check">
										<label class="form-check-label">
											<input type="checkbox" class="form-check-input product_check" value="<?= $row['brend']; ?>" id="brend"><?= $row['brend']; ?>
										</label>
									</div>
								</li>
								<?php } ?>
							</ul>
						</div>
						<div class="col-lg-9">
							<h5 class="text-center text-info" id="textChange">Svi proizvodi</h5>
							<hr>
							<div id="message"></div>

							<div class="text-center">

							</div>
							<div class="row" id="result">
								<?php 
								while ($row = $results->fetch_assoc()):
									?>
									<div class="line">
										<div class="col-sm-6 col-md-4">
											<div class="thumbnail">
												<img src="<?php echo $row['image'];?>" alt="...">
												<div class="caption">
													<h5 class="text-center"><?php echo $row['naziv_proizvoda']; ?></h5>
													<hr>
													<h4 class="card-title text-danger">Cena: <?php echo number_format($row['cena_proizvoda']); ?> rsd</h4>
													<hr>
													<p>
														Brend : <?php echo $row['brend']; ?><br>
														Tip proizvoda : <?php echo $row['tip_proizvoda']; ?><br>
													</p>
													<?php 	if(isset($_SESSION['role']) && $_SESSION['role']=="korisnik")
													{ 
														?>
														<form action="" class="form-submit">
															<input type="hidden" class="pid" value="<?= $row['id'] ?>">
															<input type="hidden" class="pnaziv" value="<?= $row['naziv_proizvoda'] ?>">
															<input type="hidden" class="pbrend" value="<?= $row['brend'] ?>">
															<input type="hidden" class="ptip" value="<?= $row['tip_proizvoda'] ?>">
															<input type="hidden" class="pcena" value="<?= $row['cena_proizvoda'] ?>">
															<input type="hidden" class="pimage" value="<?= $row['image'] ?>">
															<input type="hidden" class="pusername" value="<?= $_SESSION['username'] ?>">
															<button class="btn btn-primary btn-block addItemBtn">Dodaj u korpu</button>
														</form>
														<?php
													}
													else
													{
														echo '<a type="submit" href="login.php" class="btn btn-primary btn-block">Dodaj u korpu</a>';
													}
													?>
													
												</div>
											</div>
										</div>
									</div>


								<?php endwhile; ?>
							</div>
						</div>
					</div>
					<?php if (ceil($total_pages / $num_results_on_page) > 0): ?>
						<ul class="pagination">
							<?php if ($page > 1): ?>
								<li class="prev"><a href="instrumenti.php?page=<?php echo $page-1 ?>">Prethodna</a></li>
							<?php endif; ?>

							<?php if ($page > 3): ?>
								<li class="start"><a href="instrumenti.php?page=1">1</a></li>
								<li class="dots">...</li>
							<?php endif; ?>

							<?php if ($page-2 > 0): ?><li class="page"><a href="instrumenti.php?page=<?php echo $page-2 ?>"><?php echo $page-2 ?></a></li><?php endif; ?>
							<?php if ($page-1 > 0): ?><li class="page"><a href="instrumenti.php?page=<?php echo $page-1 ?>"><?php echo $page-1 ?></a></li><?php endif; ?>

							<li class="currentpage"><a href="instrumenti.php?page=<?php echo $page ?>"><?php echo $page ?></a></li>

							<?php if ($page+1 < ceil($total_pages / $num_results_on_page)+1): ?><li class="page"><a href="instrumenti.php?page=<?php echo $page+1 ?>"><?php echo $page+1 ?></a></li><?php endif; ?>
							<?php if ($page+2 < ceil($total_pages / $num_results_on_page)+1): ?><li class="page"><a href="instrumenti.php?page=<?php echo $page+2 ?>"><?php echo $page+2 ?></a></li><?php endif; ?>

							<?php if ($page < ceil($total_pages / $num_results_on_page)-2): ?>
								<li class="dots">...</li>
								<li class="end"><a href="instrumenti.php?page=<?php echo ceil($total_pages / $num_results_on_page) ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a></li>
							<?php endif; ?>

							<?php if ($page < ceil($total_pages / $num_results_on_page)): ?>
								<li class="next"><a href="instrumenti.php?page=<?php echo $page+1 ?>">Sledeća</a></li>
							<?php endif; ?>
						</ul>
					<?php endif; ?>
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
				$(document).ready(function(){

					$(".product_check").click(function(){
						$("#loader").show();

						var action = 'data';
						var brend = get_filter_text('brend');
						var tip_proizvoda = get_filter_text('tip_proizvoda');

						$.ajax({
							url:'action.php',
							method:'POST',
							data:{action:action,brend:brend,tip_proizvoda:tip_proizvoda},
							success:function(response){
								$("#result").html(response);
								$("#loader").hide();
								$("#textChange").text("Traženi Proizvodi");
							}
						});
					});

					function get_filter_text(text_id){
						var filterData = [];
						$('#'+text_id+':checked').each(function(){
							filterData.push($(this).val());
						});
						return filterData;
					}

				})
			</script>

			<script type="text/javascript">
				$(document).ready(function(){
					$(".addItemBtn").click(function(e){
						e.preventDefault();
						var $form =  $(this).closest(".form-submit");
						var pid = $form.find(".pid").val();
						var pnaziv = $form.find(".pnaziv").val();
						var pbrend = $form.find(".pbrend").val();
						var ptip = $form.find(".ptip").val();
						var pcena = $form.find(".pcena").val();
						var pimage = $form.find(".pimage").val();
						var pusername = $form.find(".pusername").val();

						$.ajax({
							url: 'insert-korpa.php',
							method: 'POST',
							data: {pid:pid, pnaziv:pnaziv, pbrend:pbrend, ptip:ptip, pcena:pcena, pimage:pimage, pusername:pusername},
							success:function(response){
								$("#message").html(response);
								window.scrollTo(0,0);
								load_cart_item_number();
							}
						});
					});

					load_cart_item_number();

					function load_cart_item_number(){
						$.ajax({
							url: 'insert-korpa.php',
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
		<?php
		$stmt->close();
	}
	?>