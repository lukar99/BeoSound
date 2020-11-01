<?php   
require '../config.php';
$customer_session = $_SESSION['username'];

$get_customer = "SELECT * FROM korisnici WHERE username='$customer_session'";

$run_customer = mysqli_query($conn, $get_customer);

$row = mysqli_fetch_array($run_customer);

$id = $row['id'];

$name = $row['ime_prezime'];

$email = $row['email'];

$address = $row['adresa'];

$username= $row['username'];


?>

<h1 align="center">Izmenite Vaše podatke</h1>
<hr>
<form action="" method="post" enctype="multipart/form-data"> <!-- forma početak -->

        <div class="form-group">

                <label>Vaše Ime: </label>

                <input type="text" value="<?php echo $name; ?>" name="vase_ime" class="form-control" required>

        </div>
        
        <div class="form-group">

                <label>Vaš Username: </label>

                <input type="text" value="<?php echo $username; ?>" name="vas_username" class="form-control" required>


        </div>

        <div class="form-group">

                <label>Vaš E-mail: </label>

                <input type="text" value="<?php echo $email; ?>" name="vase_email" class="form-control" required>

        </div>

        <div class="form-group">

                <label>Vaša Adresa: </label>

                <input type="text" value="<?php echo $address; ?>" name="vasa_adresa" class="form-control" required>

        </div>

        <div class="text-center">

                <button name="izmenite" class="btn btn-primary">Izmenite</button>

        </div>

</form> <!-- forma kraj -->

<?php

if(isset($_POST['izmenite']))
{
        $update_id = $id;

        $c_name = $_POST['vase_ime'];

        $c_username = $_POST['vas_username'];

        $c_email = $_POST['vase_email'];

        $c_address = $_POST['vasa_adresa'];

        $update_customer = "UPDATE korisnici SET ime_prezime='$c_name', email='$c_email', adresa='$c_address', username='$c_username' WHERE id='$update_id'";

        $run_customer = mysqli_query($conn, $update_customer);

        if($run_customer)
        {
                echo "<script>alert('Vaš nalog je uspešno ažuriran.')</script>";
                echo "<meta http-equiv='refresh' content='0'>";
        }

}

?>