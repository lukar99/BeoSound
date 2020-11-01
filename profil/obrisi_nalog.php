<center>
       
        <h1>Da li ste sigurni da želite da obrišete Vaš nalog?</h1>
 
        <form action="" method="post">
               
                <input type="submit" name="Da" value="Da, siguran sam" class="btn btn-danger">
 
                <input type="submit" name="Ne" value="Ne, nisam siguran" class="btn btn-success">
 
        </form>
 
</center>
 
<?php
        require '../config.php';
        $username = $_SESSION['username'];
 
        if(isset($_POST['Da']))
        {
                $delete_customer = "DELETE FROM korisnici where username = '$username'";
 
                $run_delete_customer = mysqli_query($conn, $delete_customer);
 
                if($run_delete_customer)
                {
                        session_destroy();
 
                        echo"<script>alert('Nalog uspešno obrisan!')</script>";
                        echo"<script>window.open('../index.php','_self')</script>";
                }
        }
 
        if(isset($_POST['Ne']))
        {
                echo"<script>window.open('nalog.php','_self')</script>";
        }
 
 ?>