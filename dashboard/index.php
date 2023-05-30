<?php
require_once "../includes/initiate.php";

$denied = false;
if (isset($_GET['denied'])) {
    $denied = true;
}


$total_items = mysqli_query($con, "select * from p_patients_dir ");
$total_items = mysqli_num_rows($total_items);
?>

<?php sns_header('Dashboard'); ?>


</div>


<div class="content-page">

    <div class="container-fluid">
        <div class="row">

            <div class="col-xl-8">
                <div class="card-transparent card-block card-stretch card-height">
                    <div class="card-body p-0">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title"><i class="fas fa-fw fa-duotone fa-hospital-user"></i>
                                        Pasien
                                    </h4>
                                </div>
                            </div>
                            <div class="card-body">


                                <div class="patients-activity-frame fb-pull">
                                    <div class="patients-activity-content">
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between">


                                    <div>
                                        <a href="../patients/register-patient.php" class="btn bg-warning-light">
                                            <i class="fa-solid fa-plus"></i>Pasien Baru
                                        </a>
                                    </div>

                                    <div>
                                        <a href="../patients/" class="btn bg-warning-light">
                                            <i class="fas fa-fw fa-duotone fa-hospital-user"></i>Pasien (<span
                                                class="counter"><?php echo $total_items; ?></span>)
                                        </a>
                                    </div>
                                    <div>
                                        <a href="../patients/recent-activity.php" class="btn bg-warning-light">
                                            <i class="fas fa-fw fa-file"></i>
                                            Aktivitas Terbaru
                                        </a>
                                    </div>

                                    <div>
                                        <a href="../patients/pending-reports.php" class="btn bg-warning-light">
                                            <i class="fa-solid fa-flag"></i>Laporan Tertunda
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">

                                    <div class="card-header d-flex justify-content-between">
                                        <div class="header-title">
                                            <h4 class="card-title"> <i class="fas fa-fw fa-duotone fa-hospital"></i>
                                                Klinik</h4>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <!-- <div class="row"> -->


                                        <div class="panel panel-default">


                                            <div class="panel-body panel-desktop-branches branches-dpanel-hadjust">


                                                <div class="branches-activity-frame fb-pull">
                                                    <div class="branches-activity-content">
                                                    </div>
                                                </div>


                                                <div class="d-flex align-items-center justify-content-between mt-5">


                                                    <div>
                                                        <a href="../clinics/register.php" class="btn bg-success-light">
                                                            <i class="fa-solid fa-plus"></i> Klinik Baru
                                                        </a>
                                                    </div>

                                                    <div>
                                                        <a href="../clinics/" class="btn bg-success-light">
                                                            <i class="fas fa-fw fa-duotone fa-hospital"></i>Kliniks

                                                        </a>
                                                    </div>
                                                    <div>
                                                        <a href="../clinics/settings.php" class="btn bg-success-light">
                                                            <i class="fas fa-fw fa-gears"></i>
                                                            Klinik Setting
                                                        </a>
                                                    </div>


                                                </div>
                                            </div>

                                        </div>

                                        <!-- </div> -->

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>


            <div class="col-xl-4">
                <div class="card card-block card-stretch card-height">
                    <div class="card-body">
                        <div class="card border-bottom">
                            <div class="card-body text-center inln-date flet-datepickr">
                                <input type="text" id="inline-date" class="date-input basicFlatpickr d-none"
                                    readonly="readonly">
                            </div>
                        </div>

                        <div class="header-title">
                            <h4 class="card-title"><i class="fa-solid fa-user"></i> Staff</h4>
                        </div>

                        <div class="card-body">


                            <div class="staff-activity-frame fb-pull staff-dpanel-hadjust">
                                <div class="staff-activity-content">
                                </div>
                                <div class="end-panel"></div>
                            </div>

                        </div>

                        <div>
                            <a href="../staff/register.php" class="btn bg-info-light">
                                <i class="fa-solid fa-plus"></i>Staff Baru
                            </a>
                            <a href="../staff/" class="btn bg-info-light">
                                <i class="fa-solid fa-user"></i>Anggota Staff
                            </a>
                        </div>



                    </div>
                </div>
            </div>



            <div class="col-xl-4">
                <div class="card-transparent card-block card-stretch card-height">
                    <div class="card-body text-center p-0">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title"> <i class="fa-solid fa-capsules"></i> Obat</h4>
                                </div>
                            </div>
                            <div class="card-body">


                                <div class="panel-body panel-med-stats">
                                    <?php if (display_permission("consumed_stock_local") == true) : ?>

                                    <div class="odr-img">
                                        <div class="fb-pull medicine-dpanel-hadjust">
                                            <div class="desktop-meds-cel">

                                                <div class="consumed-activity-frame">
                                                    <div class="consumed-activity-content">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <div class="mt-4">
                                        <div>
                                            <a href="../medicines/new.php" class="btn bg-info-light">
                                                <i class="fa-solid fa-plus"></i>Obat Baru
                                            </a>
                                            <a href="../medicines/update-stock.php" class="btn bg-info-light">
                                                <i class="fa-solid fa-edit"></i>Update Stock
                                            </a>
                                        </div>
                                        <div class="mt-2">
                                            <a href="../medicines/stocks.php" class="btn bg-info-light">
                                                <i class="fa-solid fa-signal"></i>Local Stock
                                            </a>

                                            <a href="../medicines/" class="btn bg-info-light">
                                                <i class="fa-solid fa-folder"></i>Directory
                                            </a>
                                        </div>
                                        <div class="mt-2">
                                            <a href="https://app.cobradental.co.id:1780/sales-dev"
                                                class="btn bg-info-light">
                                                <i class="fa-solid fa-note-sticky"></i>Order Stock
                                            </a>
                                            <a href="https://cobradental.co.id" class="btn bg-info-light">
                                                <i class="fa-solid fa-tag"></i>Promo Website
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- End Obat -->

            <div class="col-xl-4">
                <div class="card-transparent card-block card-stretch card-height">
                    <div class="card-body text-center p-0">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title"><i class="fa-solid fa-prescription-bottle-medical"></i>
                                        Refill Update</h4>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="panel panel-default">
                                    <!-- <div class="panel-heading theme-medicines"><span
                                            class="inlineicon medicine-mini">Refill Updates
                                            (<?php echo branch_name(staff_info('branch')); ?>)</span></div> -->
                                    <div class="panel-body panel-med-stats">
                                        <?php if (display_permission("consumed_stock_local") == true) : ?>
                                        <div class="fb-pull medicine-dpanel-hadjust ">
                                            <div class="desktop-meds-cel med-refills">
                                                <?php include('refill-updates-static.php'); ?>
                                            </div> <!-- desktop-meds-cel -->
                                        </div>
                                        <?php endif; ?>

                                    </div>
                                    <div class="mt-2">

                                    </div>
                                </div> <!-- panel -->


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card-transparent card-block card-stretch card-height">
                    <div class="card-body text-center p-0">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title"><i class="fa-solid fa-network-wired"></i> Most Active
                                        (Network)
                                    </h4>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="panel panel-default">
                                    <!-- <div class="panel-heading theme-medicines"><span
                                            class="inlineicon medicine-mini">Most Active
                                            (Network)</span></div> -->
                                    <div class="panel-body panel-med-stats">
                                        <div class="fb-pull medicine-dpanel-hadjust">
                                            <div class="desktop-meds-cel">
                                                <?php include('active-medicines-static.php'); ?>
                                            </div> <!-- desktop-meds-cel -->
                                        </div>

                                    </div>

                                    <div class="mt-2">

                                    </div>

                                </div> <!-- panel -->


                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Wrapper End-->

<?php sns_footer(); ?>