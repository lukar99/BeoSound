<?php 
require '../config.php';


?>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-lg-9">
			<div class="table-responsive mt-2">
				<table class="table table-bordered table-striped text-center">
					<thead>
						<tr>
							<td colspan="9">
								<h4 class="text-center text-info m-0">Vaše porudžbine</h4>
							</td>
						</tr>
						<tr>
							<th class="text-center">Proizvodi</th>
							<th class="text-center">Cena</th>
							<th class="text-center">Način plaćanja</th>

						</th></tr>  
					</thead>
					<tbody>    
						<?php 
						$stmt = $conn->prepare("SELECT * FROM narudzbine WHERE email='".$_SESSION['email']."' ");
						$stmt->execute();
						$result = $stmt->get_result();
						$grand_total = 0;
						while($row = $result->fetch_assoc()):
							?>     
						<tr>
							<td  style="padding-top: 20px;"><?= $row['proizvodi']?></td>
							<td  style="padding-top: 20px;"><?= number_format($row['cena'],2)?> rsd</td>
							<td  style="padding-top: 20px;"><?= $row['nacin_placanja']?></td>
						</tr>	

						<?php endwhile; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>