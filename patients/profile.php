<?php
require_once "../includes/initiate.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (isset($_GET['delete']) && display_permission("edit_patient") == true) {
    delete_single_patient($id);
    print "<script>";
    print "self.location='../patients/?deleted';";
    print "</script>";
}

sns_header(patient_info("name", $id));
?>

</div>


<div class="content-page">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Profil Pasien</h4>
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table table-striped link-patients">
                            <tbody>
                                <tr>
                                    <td>Pasien Nama</td>
                                    <td><?php echo patient_info("name", $id); ?></td>
                                </tr>
                                <tr>
                                    <td>Pasien ID</td>
                                    <td><?php echo patient_info("serial", $id); ?>-<?php echo patient_info("id", $id); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Klinik</td>
                                    <td><?php echo "$global_permission->guardian_short_name";
                                        echo patient_info("branch", $id); ?>
                                        - <?php echo branch_name(patient_info("branch", $id)); ?></td>
                                </tr>
                                <tr>
                                    <td>Didaftarkan Oleh</td>
                                    <td><a class="staff"
                                            href="../staff/profile.php?id=<?php echo patient_info("physician", $id); ?>"><?php echo staff_info("full_name", patient_info("physician", $id)); ?></a>
                                    </td>
                                </tr>

                                <?php if (patient_info("contact", $id) && display_permission('patient_contact') == true) : ?>
                                <tr>
                                    <td>No. Telp/WA</td>
                                    <td><?php echo patient_info("contact", $id); ?></td>
                                </tr>
                                <?php endif; ?>

                                <?php if (patient_info("email", $id) && display_permission('patient_email') == true) : ?>
                                <tr>
                                    <td>Email</td>
                                    <td><?php echo patient_info("email", $id); ?></td>
                                </tr>
                                <?php endif; ?>







                                <tr>
                                    <td>Pembaruan Terakhir</td>
                                    <td><?php echo display_time(patient_info("last_update", $id)); ?></td>
                                </tr>
                                <?php if (display_permission("register_patient") == true) {
                                ?><tr>
                                    <td>Aksi</td>
                                    <td><a class="patient"
                                            href="../patients/register-report.php?id=<?php echo $id; ?>">Pemeriksaan
                                            Baru</a>
                                    </td>
                                </tr><?php } ?>
                                <tr>
                                    <td></td>
                                    <td><?php if (display_permission("edit_patient") == true) { ?><a
                                            href="edit-patient.php?id=<?php echo $id; ?>">Edit Profil</a><?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><?php if (display_permission("edit_patient") == true) { ?><a
                                            href="?id=<?php echo $id; ?>&delete=1">Hapus seluruh data pasien
                                            ini!</a><?php } ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <?php
                        $getting_total = mysqli_query($con, "select * from p_reports where patient='$id'") or die(mysqli_error());
                        $getting_total = mysqli_num_rows($getting_total);
                        if ($getting_total != 0) {

                        ?>
                        <h4>Pasien History</h4>
                        <table class="table table-striped link-patients table-reports">
                            <tbody>
                                <thead>
                                    <tr>
                                        <td>ID</td>
                                        <td width="60%">List Pemeriksaan</td>
                                        <td>Status</td>
                                        <td>Update</td>
                                    </tr>
                                </thead>
                                <?php
                                    $sql = mysqli_query($con, "select * from p_reports where patient='$id' order by last_update desc limit 1000") or die(mysqli_error());
                                    while ($reports = mysqli_fetch_array($sql)) {
                                    ?>

                                <tr>
                                    <td><?php echo $reports['id'] ?></td>
                                    <td class="symptoms"><a
                                            href="../patients/reports<?php echo $extension; ?>?id=<?php echo $reports['id'] ?>"><?php echo substr($reports['symptoms'], 0, 80); ?>...</a>
                                    </td>
                                    <td class="status"><?php if ($reports['signed_by'] != "") { ?><span
                                            class="s"><?php echo staff_info("full_name", $reports['signed_by']); ?></span><?php } ?><?php if ($reports['signed_by'] == "" && $reports['engaged_by'] != "") { ?><span
                                            class="e">(Tertanda)</span><?php } ?><?php if ($reports['signed_by'] == "" && $reports['engaged_by'] == "") { ?><span
                                            class="p">(PENDING)</span><?php } ?></td>
                                    <td class="date"><?php echo display_time($reports['last_update']); ?></td>

                                    <?php } ?>
                                    <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div> <!-- panel panel-default -->
            </div> <!-- container -->
        </div>
    </div>
</div>

<?php sns_footer(); ?>