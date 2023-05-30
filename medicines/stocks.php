<?php
require_once "../includes/initiate.php";


if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = staff_info('branch');
}

if (isset($_GET['delete']) && display_permission("update_stock") == true) {
    delete_single_stock($_GET['delete']);
    print "<script>";
    print "self.location='?deleted';";
    print "</script>";
}

sns_header('Stock Obat');
?>

</div>


<div class="content-page">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Stock Obat</h4>
                        </div>
                    </div>
                    <div class="card-body">

                        <!-- <div class="row"> -->

                        <?php if (isset($_GET['deleted'])) {
                            $deleted = $_GET['deleted']; ?>
                        <div class="alert alert-success" role="alert">Stock berhasil dihapus!</div>
                        <?php } ?>


                        <?php if (display_permission("consumed_stock_global") == true) { ?>
                        <p class="pull-right">
                            <?php
                                $sql = mysqli_query($con, "select * from p_branches_dir order by last_update desc limit 2000") or die(mysqli_error());
                                while ($branches_dir = mysqli_fetch_array($sql)) {
                                ?>
                            <a class="btn btn-link btn-sm <?php if ($id == $branches_dir['id']) echo "theme-medicines"; ?>"
                                role="button"
                                href="?id=<?php echo $branches_dir['id']; ?>"><?php echo substr($branches_dir['name'], 0, 30); ?></a>
                            <?php } ?>
                        </p>
                        <br><br>
                        <?php } ?>


                        <h3 class="subtitle">Stok tersedia di klinik <?php echo branch_info("name", "$id"); ?>:</h3>

                        <!-- <div class="col-lg-4"></div> -->


                        <?php $med_count = 0;
                            $sql = mysqli_query($con, "select * from p_stock where branch='$id' order by code asc limit 20000") or die(mysqli_error());
                            while ($stocks = mysqli_fetch_array($sql)) {
                                $med_count++;
                                ?>

                        <div class="col-lg-4">
                            <div class="card">

                                <div class="card-body">
                                    <h5 class="mb-3"><?php echo $stocks['code'] ?></h5>
                                    <p class="mb-3"><i class="las la-calendar-check mr-2"></i><span class="gray">
                                            Terakhir isi ulang:</span>
                                        <br><?php echo display_time($stocks['last_update']); ?>
                                        <br>

                                    </p>
                                    <div class="iq-progress-bar bg-secondary-light mb-4">
                                        <span class="bg-secondary iq-progress progress-1"
                                            style="width: <?php echo percentage("$stocks[remaining]", "$stocks[total]") ?>%;"><?php echo percentage("$stocks[remaining]", "$stocks[total]") ?></span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="iq-media-group">
                                            <?php echo $stocks['remaining'] ?><span>/<?php echo $stocks['total'] ?>
                                        </div>
                                        <div>
                                            <a href="?delete=<?php echo $stocks['id'] ?>"
                                                class="btn bg-secondary-light">Hapus Stock</a>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                        <?php } ?>



                        <?php if ($med_count == 0) {
                            echo "<h3 class='subtitle text-center'>No medicine available at this branch!</h3>";
                        } ?>


                    </div>
                </div> <!-- panel panel-default -->
            </div> <!-- container -->

        </div>
    </div>
</div>
<!-- </div> -->

<?php sns_footer(); ?>