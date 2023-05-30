<?php
require_once "../includes/initiate.php";
page_permission("medicine_directory");
sns_header('Daftar Obat');
?>

</div>


<div class="content-page">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Daftar Obat</h4>
                        </div>
                    </div>
                    <div class="card-body">

                        <?php if (isset($_GET['deleted'])) {
							$deleted = $_GET['deleted']; ?>
                        <div class='alert alert-success' role='alert'>Berhasil dihapus!</div>
                        <?php } ?>

                        <div class="row">

                            <?php if (display_permission("medicine_profile") == true) { ?>

                            <?php
								$sql = mysqli_query($con, "select * from p_medicine_dir where category='Bottle' OR category='Box' order by code asc limit 9000") or die(mysqli_error());
								while ($medicines = mysqli_fetch_array($sql)) {
								?>
                            <div class="col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <?php echo $medicines['code'] ?>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title"><?php echo $medicines['name'] ?></h4>
                                        <p class="card-text"><strong><?php echo $medicines['category'] ?></strong> |
                                            <?php echo $medicines['price'] ?>
                                            <?php echo "$global_permission->currency" ?></p>
                                        <a href="profile.php?id=<?php echo $medicines['id'] ?>"
                                            class="btn btn-primary">Tampilkan</a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>

                            <?php } else { ?>

                        </div>

                        <div class="row">

                            <?php
								$sql = mysqli_query($con, "select * from p_medicine_dir where category='Bottle' OR category='Box' order by code asc limit 9000") or die(mysqli_error());
								while ($medicines = mysqli_fetch_array($sql)) {
							?>
                            <div class="panel panel-default profile-card profile-medicines">
                                <div class="panel-heading _theme-medicines"><?php echo $medicines['code'] ?></div>
                                <div class="panel-body">
                                    <strong><?php echo $medicines['category'] ?></strong> |
                                    <?php echo $medicines['price'] ?>
                                    <?php echo "$global_permission->currency" ?>
                                </div>
                            </div>
                            <?php } ?>

                            <?php } ?>

                            <hr />

                            <!-- <div class="row"> -->

                            <?php if (display_permission("medicine_profile") == true) { ?>

                            <?php
							$sql = mysqli_query($con, "select * from p_medicine_dir where category='Tablets' order by code asc limit 9000") or die(mysqli_error());
							while ($medicines = mysqli_fetch_array($sql)) {
							?>
                            <div class="col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <?php echo $medicines['code'] ?>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title"><?php echo $medicines['name'] ?></h4>
                                        <p class="card-text"><strong><?php echo $medicines['category'] ?></strong> |
                                            <?php echo $medicines['price'] ?>
                                            <?php echo "$global_permission->currency" ?></p>
                                        <a href="profile.php?id=<?php echo $medicines['id'] ?>"
                                            class="btn btn-primary">Tampilkan</a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>

                            <?php } else { ?>

                        </div>

                        <div class="row">

                            <?php
							$sql = mysqli_query($con, "select * from p_medicine_dir where category='Tablets' order by code asc limit 9000") or die(mysqli_error());
							while ($medicines = mysqli_fetch_array($sql)) {
							?>
                            <div class="panel panel-default profile-card profile-medicines">
                                <div class="panel-heading _theme-medicines"><?php echo $medicines['code'] ?></div>
                                <div class="panel-body">
                                    <strong><?php echo $medicines['category'] ?></strong> |
                                    <?php echo $medicines['price'] ?>
                                    <?php echo "$global_permission->currency" ?>
                                </div>
                            </div>
                            <?php } ?>

                            <?php } ?>
                            <hr />

                            <!-- <div class="row"> -->

                            <?php if (display_permission("medicine_profile") == true) { ?>

                            <?php
							$sql = mysqli_query($con, "select * from p_medicine_dir where category='Syrup' order by code asc limit 9000") or die(mysqli_error());
							while ($medicines = mysqli_fetch_array($sql)) {
							?>
                            <div class="col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <?php echo $medicines['code'] ?>
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title"><?php echo $medicines['name'] ?></h4>
                                        <p class="card-text"><strong><?php echo $medicines['category'] ?></strong> |
                                            <?php echo $medicines['price'] ?>
                                            <?php echo "$global_permission->currency" ?></p>
                                        <a href="profile.php?id=<?php echo $medicines['id'] ?>"
                                            class="btn btn-primary">Tampilkan</a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>

                            <?php } else { ?>


                            <?php
							$sql = mysqli_query($con, "select * from p_medicine_dir where category='Syrup' order by code asc limit 9000") or die(mysqli_error());
							while ($medicines = mysqli_fetch_array($sql)) {
							?>
                            <div class="panel panel-default profile-card profile-medicines">
                                <div class="panel-heading _theme-medicines"><?php echo $medicines['code'] ?></div>
                                <div class="panel-body">
                                    <strong><?php echo $medicines['category'] ?></strong> |
                                    <?php echo $medicines['price'] ?>
                                    <?php echo "$global_permission->currency" ?>
                                </div>
                            </div>
                            <?php } ?>

                            <?php } ?>
                            <br><br>
                        </div>
                    </div>
                </div> <!-- panel panel-default -->
            </div> <!-- container -->
        </div>
    </div>
</div>

<?php sns_footer(); ?>