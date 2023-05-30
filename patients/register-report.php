<?php
require_once "../includes/initiate.php";
page_permission("register_patient");

$success = false;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if (isset($_GET['success'])) {
    $success = true;
}

?>

<?php sns_header('Pasien Baru'); ?>


</div>


<div class="content-page">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Pasien Baru</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php

                        if (isset($_POST['submit'])) {

                            $patient = $_POST['patient'];
                            $charge = $_POST['charge'];
                            $fever = friendly($_POST['fever']);
                            $blood_pressure = friendly($_POST['blood_pressure']);
                            $symptoms = friendly($_POST['symptoms']);
                            $engaged_by = $_POST['engaged_by'];
                            $result = compose_report($patient, $charge, $fever, $blood_pressure, $symptoms, $engaged_by);

                            if ($result != false) {

                                if (isset($_FILES["file"]["tmp_name"]) && $_FILES["file"]["tmp_name"] != "") {
                                    $dest = "../media/reports/$result" . ".zip";
                                    copy($_FILES["file"]["tmp_name"], $dest);
                                }

                                echo "<div class='alert alert-success' role='alert'>Pasien Sukses Didaftarkan!</div>";

                                if (display_permission("prescribe_patient") == true) {
                                    echo "<a class='btn btn-default formbutton theme-patients' href=../patients/prescribe.php?id=$result>Membuat Resep</a>";
                                } else {
                                    echo "<a class='btn btn-default formbutton theme-patients' href=../patients/register-patient.php?id=$id>Pasien Baru</a>";
                                }
                            } else {
                                echo "<div class='alert alert-danger' role='alert'>Please fill out all required fields!</div>";
                                echo "<input class='btn btn-default formbutton theme-patients' value='Try Again' onclick='window.history.back()'/>";
                            }
                        } else {
                        ?>
                        <?php if ($success == true) { ?>
                        <div class="alert alert-success" role="alert">Pasien sukses didaftarkan.</div>
                        <?php } ?>

                        <table class="table table-striped link-patients">
                            <tbody>
                                <tr>
                                    <td>Pasien Nama :</td>
                                    <td><a href="../patients/profile.php?id=<?php echo patient_info("id", $id); ?>"
                                            class="patient"><?php echo patient_info("name", $id); ?></a></td>
                                </tr>
                                <tr>
                                    <td>Pasien ID :</td>
                                    <td><?php echo patient_info("serial", $id); ?>-<?php echo patient_info("id", $id); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Klinik :</td>
                                    <td><?php echo $global_permission->guardian_short_name;
                                            echo patient_info("branch", $id); ?>
                                        - <?php echo branch_name(patient_info("branch", $id)); ?></td>
                                </tr>
                                <tr>
                                    <td>Didaftarkan Oleh :</td>
                                    <td><a class="staff"
                                            href="../staff/profile<?php echo $extension; ?>?id=<?php echo patient_info("physician", $id); ?>"><?php echo staff_info("full_name", patient_info("physician", $id)); ?></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pembaharuan Terakhir :</td>
                                    <td><?php echo display_time(patient_info("last_update", $id)); ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <form method="post" action="" enctype="multipart/form-data">


                            <input type="hidden" id="charge" name="charge" value="0" class="inputOne" cols="9"
                                rows="4" />

                            <!-- <div class="form-group"><label>Symptoms:</label><textarea class="form-control"
                                    name="symptoms" id="symptoms" class="inputOne" cols="9" rows="4"></textarea></div>
                            <div class="form-group"><label>Fever:</label><input class="form-control" name="fever"
                                    type="text" /><i>&deg;F</i></div>
                            <div class="form-group"><label>Blood Pressure:</label><input class="form-control"
                                    name="blood_pressure" type="text" /><i>Systolic BP mmHg / Diastolic BP mmHg</i>
                            </div> -->

                            <input type="hidden" id="symptoms" name="symptoms" value="Pemeriksaan" class="inputOne"
                                cols="9" rows="4" />
                            <input type="hidden" id="fever" name="fever" value="Kosong" class="inputOne" cols="9"
                                rows="4" />
                            <input type="hidden" id="blood_pressure" name="blood_pressure" value="Kosong"
                                class="inputOne" cols="9" rows="4" />

                            <!--
	<div class="form-group"><label>Upload(s):</label><input class="form-control" class="file" name="file" type="file" /><i>*zipped files only</i></div>
	-->
                            <div class="form-group"><label>Ditugaskan Kepada :</label><select class="form-control"
                                    name='engaged_by' id='engaged_by' size='1' tabindex='1'>
                                    <?php if (display_permission('prescribe_patient', staff_info('id')) == true) { ?>
                                    <option value="<?php echo staff_info('id'); ?>">Diri Sendiri</option>
                                    <?php } ?>
                                    <option value="">Open Ticket</option>
                                    <?php
                                        $my_branch = staff_info("branch");
                                        $sql = mysqli_query($con, "select * from p_staff_dir where branch=$my_branch and status='active' order by first_name desc limit 2000") or die(mysqli_error());
                                        while ($staff_dir = mysqli_fetch_array($sql)) {
                                            if (display_permission('prescribe_patient', $staff_dir['id']) == false) continue;
                                            if ($staff_dir['id'] == staff_info('id')) continue;
                                        ?>
                                    <option value='<?php echo $staff_dir['id']; ?>'>
                                        <?php echo $staff_dir['full_name']; ?>
                                        (<?php echo branch_info('name', staff_info('branch', $staff_dir['id'])); ?>)
                                    </option>
                                    <?php } ?>
                                </select></div>


                            <div class="widget-border">&nbsp;</div>
                            <input type="hidden" name="patient" value="<?php echo $id; ?>" />
                            <input name="submit" class="btn btn-default formbutton theme-patients" name="submit"
                                class="formbutton patient" type="submit" value="Daftar">
                        </form>
                        <?php } ?>
                    </div>


                </div>
            </div> <!-- panel panel-default -->
        </div> <!-- container -->
    </div>
</div>

<?php sns_footer(); ?>