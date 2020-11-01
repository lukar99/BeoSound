<?php
session_start();
$connection = mysqli_connect("localhost","root","","beosound");
$db=mysqli_select_db($connection,"phpcrud");

	if(isset($_POST['insertdata']))
	{
		$fbrend = $_POST['brend'];
		$fnaziv = $_POST['naziv'];
		$ftip = $_POST['tip'];
		$fcena = $_POST['cena'];
		$fslika = "img/" . $_FILES["slika"]['name'];
	

		
		$query = " INSERT INTO `proizvodi`(`brend`, `naziv_proizvoda`, `tip_proizvoda`, `cena_proizvoda`, `image`) VALUES ('$fbrend', '$fnaziv', '$ftip', '$fcena', '$fslika') ";


		$query_run = mysqli_query($connection, $query);

		if($query_run)
		{
			$_SESSION['status']="Uspešno ste dodali novi proizvod.";
			$_SESSION['status_code'] = "success";
			echo '<script> alert("Podaci su uneti"); </script>';
			header("location:adminpanel.php");
		}
		else
		{
			$_SESSION['status']="Novi proizvod nije dodat.";
			$_SESSION['status_code'] = "error";
			echo '<script> alert("Podaci nisu uneti"); </script>';
		}
	}
?>