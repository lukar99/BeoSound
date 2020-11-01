<?php
session_start();
if($_SESSION['start']!="yes" || $_SESSION['role']!="admin"){
	header('location:../login.php');
	die();
}
require '../config.php';

$total_pages = $conn->query('SELECT * FROM proizvodi')->num_rows;

// Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

// Number of results to show on each page.
$num_results_on_page = 5;

if ($stmt = $conn->prepare('SELECT * FROM proizvodi ORDER BY id LIMIT ?,?')) {
	// Calculate the page to get the results we need from our table.
	$calc_page = ($page - 1) * $num_results_on_page;
	$stmt->bind_param('ii', $calc_page, $num_results_on_page);
	$stmt->execute(); 
	// Get the results...
	$result = $stmt->get_result();
	?>

	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Admin Panel</title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/stil.css">
		<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		<script>
			$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});
</script>
</head>

<body>
	<div class="page-header">
		<?php

		
		echo '<div class="float-right"><a href="../logout.php">&nbsp&nbspLogout</a></div>';
		?>
	</div>
	<div class="container-xl">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-sm-6">
							<h2>Upravljanje proizvodima</h2>
						</div>
						<div class="col-sm-6">
							<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Dodaj novi proizvod</span></a>
						</div>
					</div>
				</div>
				<?php
				$query="SELECT * FROM proizvodi";
				$query_run=mysqli_query($conn, $query);
				?>
				<table id="datatable" class="table table-striped table-hover">
					<thead>
						<tr>
							<th>Id</th>
							<th>Brend</th>
							<th>Naziv proizvoda</th>
							<th>Tip proizvoda</th>
							<th>Cena proizvoda</th>
							<th>Slika</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
						if(mysqli_num_rows($query_run)>0)
						{
							while ($row = $result->fetch_assoc()):
								?>

								<tr>

									<td><?php echo $row['id']; ?></td>
									<td><?php echo $row['brend']; ?></td>
									<td><?php echo $row['naziv_proizvoda']; ?></td>
									<td><?php echo $row['tip_proizvoda']; ?></td>
									<td><?php echo $row['cena_proizvoda']; ?> rsd</td>
									<td><?php echo $row['image']; ?></td>
									<td>
										<a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
										<a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
									</td>
								</tr>

								<?php
							endwhile;
						}
						else{
							echo "Nema pronađenih proizvoda";
						}
						?>
					</tbody>
				</table>
				<div class="clearfix">

					<?php if (ceil($total_pages / $num_results_on_page) > 0): ?>
						<ul class="pagination">
							<?php if ($page > 1): ?>
								<li class="prev"><a href="adminpanel.php?page=<?php echo $page-1 ?>">Prethodna</a></li>
							<?php endif; ?>

							<?php if ($page > 3): ?>
								<li class="start"><a href="adminpanel.php?page=1">1</a></li>
								<li class="dots">...</li>
							<?php endif; ?>

							<?php if ($page-2 > 0): ?><li class="page"><a href="adminpanel.php?page=<?php echo $page-2 ?>"><?php echo $page-2 ?></a></li><?php endif; ?>
							<?php if ($page-1 > 0): ?><li class="page"><a href="adminpanel.php?page=<?php echo $page-1 ?>"><?php echo $page-1 ?></a></li><?php endif; ?>

							<li class="currentpage"><a href="adminpanel.php?page=<?php echo $page ?>"><?php echo $page ?></a></li>

							<?php if ($page+1 < ceil($total_pages / $num_results_on_page)+1): ?><li class="page"><a href="adminpanel.php?page=<?php echo $page+1 ?>"><?php echo $page+1 ?></a></li><?php endif; ?>
							<?php if ($page+2 < ceil($total_pages / $num_results_on_page)+1): ?><li class="page"><a href="adminpanel.php?page=<?php echo $page+2 ?>"><?php echo $page+2 ?></a></li><?php endif; ?>

							<?php if ($page < ceil($total_pages / $num_results_on_page)-2): ?>
								<li class="dots">...</li>
								<li class="end"><a href="adminpanel.php?page=<?php echo ceil($total_pages / $num_results_on_page) ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a></li>
							<?php endif; ?>

							<?php if ($page < ceil($total_pages / $num_results_on_page)): ?>
								<li class="next"><a href="adminpanel.php?page=<?php echo $page+1 ?>">Sledeća</a></li>
							<?php endif; ?>
						</ul>
					<?php endif; ?>
					<!-- <ul class="pagination">
						<li class="page-item disabled"><a href="#">Prethodna</a></li>
						<li class="page-item"><a href="#" class="page-link">1</a></li>
						<li class="page-item"><a href="#" class="page-link">2</a></li>
						<li class="page-item active"><a href="#" class="page-link">3</a></li>
						<li class="page-item"><a href="#" class="page-link">4</a></li>
						<li class="page-item"><a href="#" class="page-link">5</a></li>
						<li class="page-item"><a href="#" class="page-link">Sledeća</a></li>
					</ul> -->
				</div>
			</div>
		</div>        
	</div>
	<!-- ADD Modal HTML -->
	<div id="addEmployeeModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="insertcode.php" method="POST" enctype="multipart/form-data">

					<div class="modal-header">						
						<h4 class="modal-title">Dodaj novi instrument</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Brend</label>
							<input id="brend" name="brend" type="text" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Naziv proizvoda</label>
							<input id="naziv" name="naziv" type="text" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Tip proizvoda</label>
							<input id="tip" name="tip" type="text" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Cena proizvoda</label>
							<input id="cena" name="cena" type="text" class="form-control" required>
						</div>		
						<div class="form-group">
							<label>Unesite sliku:</label>
							<input type="file" id="slika" name="slika" required><br>
						</div>				
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Otkaži">
						<button type="submit" class="btn btn-success" name="insertdata">Dodaj proizvod</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="editmodal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="updatecode.php" method="POST" enctype="multipart/form-data">
					<div class="modal-header">						
						<h4 class="modal-title">Edit Employee</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">	
						<input type="hidden" name="fid" id="fid">				
						<div class="form-group">
							<label>Brend</label>
							<input id="fbrend" name="fbrend" type="text" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Naziv proizvoda</label>
							<input id="fnaziv" name="fnaziv" type="text" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Tip proizvoda</label>
							<input id="ftip" name="ftip" type="text" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Cena proizvoda</label>
							<input id="fcena" name="fcena" type="text" class="form-control" required>
						</div>		
						<div class="form-group">
							<label>Unesite sliku:</label>
							<input type="file" id="fslika" name="fslika"><br>
						</div>				
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="submit" class="btn btn-info" name="updatedata">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deletemodal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="deletecode.php" method="POST">
					<div class="modal-header">						
						<h4 class="modal-title">Izbriši proizvod</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<input type="hidden" name="delete_id" id="delete_id">									
						<p>Da li ste sigurni da želite da izbrišete ovaj proizvod?</p>
						<p class="text-warning"><small>Ova akcija se ne može obustaviti nakon izvršenja.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Otkaži">
						<input type="submit" class="btn btn-danger" name="deletedata" value="Izbriši">
					</div>
				</form>
			</div>
		</div>
	</div>




	<!--Javascript funkcija za prikazivanje forme za izmenu podataka-->
	<script type="text/javascript">

		$(document).ready(function() {
			$('.edit').on('click', function(){
				$('#editmodal').modal('show');

				$tr = $(this).closest('tr');

				var data = $tr.children("td").map(function(){
					return $(this).text();
				}).get();

				console.log(data);

				$('#fid').val(data[0]);
				$('#fbrend').val(data[1]);
				$('#fnaziv').val(data[2]);
				$('#ftip').val(data[3]);
				$('#fcena').val(data[4]);
				$('#fslika').val(data[5]);
			});
		});
	</script>

	<!--Javascript funkcija za prikazivanje forme za brisanje podataka-->
	<script type="text/javascript">

		$(document).ready(function() {
			$('.delete').on('click', function(){
				$('#deletemodal').modal('show');

				$tr = $(this).closest('tr');

				var data = $tr.children("td").map(function(){
					return $(this).text();
				}).get();

				console.log(data);

				$('#delete_id').val(data[0]);

			});
		});
	</script>

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<?php
	if(isset($_SESSION['status']) && $_SESSION['status']!='')
	{
		?>
		<script>
			swal({
				title: "<?php echo $_SESSION['status']; ?>",
				
				icon: "<?php echo $_SESSION['status_code']; ?>",
				button: "Ok!",
			});
		</script>

		<?php
		unset($_SESSION['status']);
	}

	?>

</body>
</html>
<?php
$stmt->close();
}
?>