<?php
require 'config.php';
session_start();
if(isset($_POST['register']))
{
	$username = $_POST['name'];
	$address = $_POST['address'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['pass'];
	$cpassword = $_POST['cpass'];
	$tip = 'korisnik';

	$user = mysqli_query($conn, "SELECT username FROM korisnici WHERE username ='$username' ");
	$result = mysqli_num_rows($user);
	if($result>0)
	{
		$_SESSION['msg'] = "Korisnik sa ovim username-om već postoji. Molimo vas izaberite novi.";
		header('Location: registracija.php');
	}
	else
	{
		unset($_SESSION['msg']);
		if($password === $cpassword)
		{
			$hashed = password_hash($password, PASSWORD_DEFAULT);
			$query = "INSERT INTO korisnici (ime_prezime, adresa, email, username, pass, tip) VALUES ('$username', '$address', '$email', '$username', '$hashed', '$tip')";
			$query_run = mysqli_query($conn, $query);

			if($query_run)
			{
				$_SESSION['status']="Uspešno ste se registrovali.";
				$_SESSION['status_code'] = "success";
				echo '<script> alert(""); </script>';
				header('Location: registracija.php');
			}
			else
			{
				
				$_SESSION['status']="Došlo je do greške.";
				$_SESSION['status_code'] = "error";
				echo '<script> alert("Niste uspeli da se registrujete"); </script>';
				header('Location: registracija.php');

			}


		}
		else
		{
			$_SESSION['status']="Šifre se ne poklapaju.";
			$_SESSION['status_code'] = "warning";
			echo '<script> alert("Unete šifre moraju biti identične"); </script>';
			header('Location: registracija.php');
		}

	}

	
	

}


?>