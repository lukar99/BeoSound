<?php
session_start();
$connection = mysqli_connect("localhost","root","","beosound");
$db=mysqli_select_db($connection,"phpcrud");

if(isset($_POST['deletedata']))
{
	$id= $_POST['delete_id'];

	$query = "DELETE FROM proizvodi WHERE id='$id'";
	$query_run = mysqli_query($connection, $query);

	if($query_run)
	{
		$_SESSION['status']="Uspešno ste izbrisali proizvod.";
		$_SESSION['status_code'] = "success";
		echo '<script> alert("Izbrisano");</script>';
		header("location:adminpanel.php");
	}
	else
	{
		$_SESSION['status']="Neuspešno brisanje proizvoda.";
		$_SESSION['status_code'] = "error";
		echo '<script> alert("Niste uspeli da izbrišete podatke"); </script>';
	}
}
?>