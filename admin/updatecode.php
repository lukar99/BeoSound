<?php
session_start();
$connection = mysqli_connect("localhost","root","","beosound");
$db=mysqli_select_db($connection,"phpcrud");

	if(isset($_POST['updatedata'])){
		$id = $_POST['fid'];
		$fbrend = $_POST['fbrend'];
		$fnaziv = $_POST['fnaziv'];
		$ftip = $_POST['ftip'];
		$fcena = $_POST['fcena'];
		$fslika = "img/" . $_FILES["fslika"]['name'];

		if($fslika=="img/")
		{
			$query = "UPDATE proizvodi SET brend='$fbrend', naziv_proizvoda='$fnaziv', tip_proizvoda='$ftip', cena_proizvoda='$fcena' WHERE id='$id' ";
		}
		else
		{
			$query = "UPDATE proizvodi SET brend='$fbrend', naziv_proizvoda='$fnaziv', tip_proizvoda='$ftip', cena_proizvoda='$fcena', image='$fslika' WHERE id='$id' ";
		}
		
		$query_run = mysqli_query($connection, $query);

		if($query_run)
		{
			$_SESSION['status']="Uspešno ste ažurirali proizvod.";
			$_SESSION['status_code'] = "success";
			echo '<script> alert("Podaci su izmenjeni"); </script>';
			header("location:adminpanel.php");
		}
		else
		{
			$_SESSION['status']="Neuspešno ažuriranje proizvoda.";
			$_SESSION['status_code'] = "error";
			echo '<script> alert("Podaci nisu izmenjeni"); </script>';
		}
	}
?>