<?php 
session_start();
if($_SESSION['start']!="yes" || $_SESSION['role']!="korisnik"){

	die();
}
require 'config.php';

if(isset($_POST['pid'])){
	$pid = $_POST['pid'];
	$pnaziv = $_POST['pnaziv'];
	$pbrend = $_POST['pbrend'];
	$ptip = $_POST['ptip'];
	$pcena = $_POST['pcena'];
	$pimage ="../". $_POST['pimage'];
	$pkolicina = 1;
	$pusername = $_POST['pusername'];
	

	$stmte = $conn->prepare("SELECT naziv_proizvoda FROM korpa WHERE naziv_proizvoda=? AND korisnik=?");
	$stmte->bind_param("ss", $pnaziv, $pusername);
	$stmte->execute();
	$res = $stmte->get_result();
	$r = $res->fetch_assoc();
	$code = $r['naziv_proizvoda'];

	if(!$code){
		$query= $conn->prepare("INSERT INTO korpa (naziv_proizvoda, brend, tip_proizvoda, cena_proizvoda, image, kolicina, ukupna_cena, korisnik) VALUES (?,?,?,?,?,?,?,?) ");
		$query->bind_param("sssdsids", $pnaziv, $pbrend, $ptip, $pcena, $pimage, $pkolicina, $pcena, $pusername);

		$query->execute();

		echo '<div class="alert alert-success alert-dismissible mt-2">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Proizvod dodat u korpu</strong>';
	}
	else
	{
		echo '<div class="alert alert-danger alert-dismissible mt-2">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Proizvod je već u korpi</strong>';
	}


}


if(isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item')
{
	$stmt = $conn->prepare("SELECT * FROM korpa WHERE korisnik= '".$_SESSION['username']."'");
	$stmt->execute();
	$stmt->store_result();
	$rows = $stmt->num_rows;

	echo $rows;
}

if(isset($_GET['remove']))
{
	$id = $_GET['remove'];

	$stmt=$conn->prepare("DELETE FROM korpa WHERE id='$id'");
	$stmt->execute();

	$_SESSION['showAlert']='block';
	$_SESSION['message']= 'Proizvod je izbačen iz korpe!';
	header('location:korpa/korpa.php');
}

if(isset($_GET['clear']))
{
	$stmt = $conn->prepare("DELETE FROM korpa");
	$stmt->execute();
	$_SESSION['showAlert']='block';
	$_SESSION['message']= 'Svi proizvodi su izbačeni iz korpe!';
	header('location:korpa/korpa.php');
}

if(isset($_POST['qty'])){
	$qty = $_POST['qty'];
	$pid = $_POST['pid'];
	$pprice = $_POST['pprice'];

	$tprice = $qty*$pprice;

	$stmt = $conn->prepare("UPDATE korpa SET kolicina=?, ukupna_cena=? WHERE id=?");
	$stmt->bind_param("idi",$qty,$tprice,$pid);
	$stmt->execute();

}

if(isset($_POST['action']) && isset($_POST['action'])=='order'){
	$name = $_SESSION['name'];
	$email=$_SESSION['email'];
	$phone=$_POST['phone'];
	$address=$_SESSION['address'];
	$products=$_POST['products'];
	$grand_total=$_POST['grand_total'];
	$pmode =$_POST['pmode'];

	$data='';

	$stmt= $conn->prepare("INSERT INTO narudzbine (ime_prezime, adresa, email, broj_telefona, nacin_placanja, proizvodi, cena) VALUES (?,?,?,?,?,?,?)");
	$stmt->bind_param("ssssssd", $name,$address,$email,$phone,$pmode,$products,$grand_total);
	$stmt->execute();
	$data .='<div class="text-center">
	<h1 class="display-4 mt-2 text-primary">Hvala Vam!</h1>
	<h2 class="text-success">Uspešno ste naručili proizvode!</h2>
	<h4>Naručeni proizvodi: '.$products.'</h4>
	<h4>Ime : '.$name.'</h4>
	<h4>Email : '.$email.'</h4>
	<h4>Broj telefona : '.$phone.'</h4>
	<h4>Adresa : '.$address.'</h4>
	<h4>Ukupna cena narudžbine : '.number_format($grand_total,2).'</h4>
	<h4>Način plaćanja : '.$pmode.'</h4>
	</div>';

	echo $data;

	$stmt2 = $conn->prepare("DELETE FROM korpa WHERE korisnik= '".$_SESSION['username']."'");
	$stmt2->execute();

}
?>

