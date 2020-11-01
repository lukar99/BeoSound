<?php 
	require 'config.php';
	//filter podataka
	if(isset($_POST['action'])){
		$sql = "SELECT * FROM proizvodi WHERE brend !=''";

		if(isset($_POST['brend'])){
			$brend = implode("','", $_POST['brend']);
			$sql .="AND brend IN('".$brend."')";
		}
		if(isset($_POST['tip_proizvoda'])){
			$tip_proizvoda = implode("','", $_POST['tip_proizvoda']);
			$sql .="AND tip_proizvoda IN('".$tip_proizvoda."')";
		}

		$result = $conn->query($sql);
		$output ='';

		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				$output .='<div class="line">
										<div class="col-sm-6 col-md-4">
											<div class="thumbnail">
												<img src="'.$row['image'].'" alt="...">
												<div class="caption">
													<h5 class="text-center">'.$row['naziv_proizvoda'].'</h5>
													<hr>
													<h4 class="card-title text-danger">Cena: '.number_format($row['cena_proizvoda']).'rsd</h4>
													<hr>
													<p>
														Brend : '.$row['brend'].'<br>
														Tip proizvoda : '.$row['tip_proizvoda'].'<br>
													</p>
													<a href="" class="btn btn-primary btn-block" id="btn">Dodaj u korpu</a>
												</div>
											</div>
										</div>
									</div>';
			}
		}
		else{
			$output = "<h3>Nema traženih proizvoda!</h3>";
		}
		echo $output;
	}
?>