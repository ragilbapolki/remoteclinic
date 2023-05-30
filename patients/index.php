<?php
require_once "../includes/initiate.php";
page_permission("patients_directory");
if (isset($_GET['start'])) {
	$start = $_GET['start'];
} else {
	$start = 0;
}

$limit = 100;

$total_items = mysqli_query($con, "select * from p_patients_dir ");
$total_items = mysqli_num_rows($total_items);


?>

<?php sns_header('Patient'); ?>


</div>


<div class="content-page">

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-lg-12 col-md-12">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<div class="header-title">
							<h4 class="card-title">Patient</h4>
						</div>
					</div>
					<div class="card-body">

						<?php if (isset($_GET['deleted'])) {
							$deleted = $_GET['deleted']; ?>
							<div class="alert alert-success" role="alert">Patient's record has been successfully removed!
							</div>
						<?php } ?>

						<h4 class="patients-dir-total" align="right">Total: <?php echo $total_items; ?> patients
							<?php if ($start != 0) { ?> <a href="?start=<?php echo $start - $limit; ?>">previous
									page</a>
								<?php } ?><?php if ($total_items >= $start + $limit) { ?><a href="?start=<?php echo $start + $limit; ?>">next page</a><?php } ?></h4>



						<table class="table table-striped table-patients-dir">
							<tbody>
								<tr>
									<?php
									$refresh = 1;
									$sql = mysqli_query($con, "select * from p_patients_dir order by id asc limit $start, $limit") or die(mysqli_error());
									while ($patients = mysqli_fetch_array($sql)) {
									?>
										<td><a href="profile.php?id=<?php echo $patients['id'] ?>">
												<span class="branchspan"><?php echo $patients['serial'] ?></span> -
												<?php echo $patients['name'] ?> <span class="meta">(<?php echo substr($patients['gender'], 0, 1); ?>/<?php echo $patients['age'] ?>)</span>
											</a></td>
									<?php if ($refresh % 5 == 0) echo "</tr><tr>";
										$refresh++;
									}
									?>
								</tr>
							</tbody>
						</table>



					</div>
				</div> <!-- panel panel-default -->
			</div> <!-- container -->
		</div>
	</div>
</div>
</div>

<?php sns_footer(); ?>