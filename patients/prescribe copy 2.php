<?php
require_once "../includes/initiate.php";
page_permission("prescribe_patient");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$patient_id = report_info("patient", $id);
$engaged_status = report_info("engaged_by", $id);
$signed_status = report_info("signed_by", $id);

// $jml_data = count($_POST['doses'], $_POST['price_set'], $_POST['medicine']);

// echo $jml_data;

// for ($i = 0; $i <= $jml_data - 1; $i++) {
//     $medicine = $_POST['medicine'][$i];
//     $doses = $_POST['doses'][$i];
//     $price_set = $_POST['price_set'][$i];
// }

?>

<?php sns_header('Prescribe Patient'); ?>

</div>


<div class="content-page">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">New Patient</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php

                        $get_composer_branch = staff_info("branch", report_info("composed_by", $id));

                        if ($engaged_status == "" && $signed_status == "") {
                            echo "<div class='alert alert-info' role='alert'>This report is now assigned to you!</div>";
                        } else if ($engaged_status != "" && $signed_status == "") {
                            $engaged_by = report_info("engaged_by", $id);
                            $engaged_by_name = staff_info("full_name", $engaged_by);
                            echo "<div class='alert alert-warning' role='alert'>This report was assigned to $engaged_by_name (ID# $engaged_by) but hasn’t been signed yet!</div>";
                        } else if ($signed_status != "") {
                            $signed_by_id = report_info("signed_by", $id);
                            $signed_by = staff_info("full_name", $signed_by_id);
                            echo "<div class='alert alert-success' role='alert'>Signed by <a class='staff' href='../staff/profile.php?id=$signed_by_id'>$signed_by</a> (ID# $signed_by_id)!</div>";
                        } else {
                            echo "";
                        }
                        $engaged_by = engage_the_report($id);

                        ?>


                        <?php
                        if (isset($_POST['submit'])) {


                            $report_id = $id;
                            $medicine = $_POST['medicine'];
                            $doses = $_POST['doses'];
                            // $days = $_POST['days'];
                            $price_set = $_POST['price_set'];
                            $medicine_charge = $_POST['medicine_charge'];


                            $result = prescribe($report_id, $medicine, $doses, $medicine_charge, $price_set);

                            if ($result != false) {



                                echo "<div class='alert alert-success' role='alert'>Report has been successfully updated!</div>";
                            } else {
                                echo "<div class='alert alert-danger' role='alert'>Sorry, selected medicine is longer available in your stock~</div>";
                            }
                        }
                        ?>
                        <table class="table table-striped link-patients link-patients">
                            <tbody>
                                <tr>
                                    <td>Report ID:</td>
                                    <td><?php echo $id; ?></td>
                                </tr>
                                <tr>
                                    <td>Token Charge:</td>
                                    <td><?php echo "$global_permission->currency" ?>
                                        <?php echo charge_mode(report_info("charge", $id)); ?></td>
                                </tr>

                                <?php if (report_info("checkout_charges", $id) != "") {  ?>
                                <tr>
                                    <td>Medicine Charges:</td>
                                    <td><?php echo "$global_permission->currency" ?>
                                        <?php echo report_info("checkout_charges", $id); ?></td>
                                </tr>
                                <?php } else { ?>
                                <tr>
                                    <td>Medicine Charges:</td>
                                    <td>n/a</td>
                                </tr>
                                <?php } ?>

                                <!-- <?php if (report_info("fever", $id) != "") { ?><tr>
                                    <td>Fever:</td>
                                    <td><?php echo report_info("fever", $id); ?></td>
                                </tr><?php } ?> -->
                                <!-- <?php if (report_info("blood_pressure", $id) != "") { ?><tr>
                                    <td>Blood Pressure:</td>
                                    <td><?php echo report_info("blood_pressure", $id); ?></td>
                                </tr><?php } ?> -->
                                <?php if (report_attachment("exist", $id) == true) { ?><tr>
                                    <td>Reports:</td>
                                    <td><a href="../media/reports/<?php echo "$id" ?>.zip">Download attachments</a></td>
                                </tr><?php } ?>
                                <!-- <tr>
                                    <td>Symptoms:</td>
                                    <td><textarea readonly class="form-textarea"><?php echo report_info("symptoms", $id); ?></textarea>
                                    </td>
                                </tr> -->
                                <?php
                                $sql = mysqli_query($con, "select p_med_record.*, p_medicine_dir.name from p_med_record,p_medicine_dir where report_id='$id' AND p_medicine_dir.code = p_med_record.medicine
                                order by last_update desc limit 9000") or die(mysqli_error());
                                while ($list_med = mysqli_fetch_array($sql)) {
                                ?>
                                <tr>
                                    <td>- <?php echo $list_med['name'] ?></td>
                                    <td>Jumlah Obat : <?php echo $list_med['doses'] ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>



                        <form method="post" action="" enctype="multipart/form-data">

                            <!-- batasssssssssssssssssssssssssssssssssssssssssssssss -->
                            <!-- <div class="form-row"> -->
                            <div class="form-group fieldGroup">
                                <div class="input-group">

                                    <div class="col-2">
                                        <select class="form-control" name='medicine' id='medicine'>
                                            <?php
                                            $sql = mysqli_query($con, "select * from p_stock where branch='$get_composer_branch' order by code asc limit 9000") or die(mysqli_error());
                                            while ($medicines = mysqli_fetch_array($sql)) {
                                            ?>
                                            <option value='<?php echo $medicines['code'] ?>'> Rp.
                                                <?php echo medicine_by_code('price', $medicines['code']) ?>
                                                <?php if (display_permission("medicine_profile") == true) {
                                                        echo '- ' . medicine_by_code('name', $medicines['code']);
                                                    } ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <input type="text" class="form-control" id="doses" name="doses" size='1'
                                            tabindex='1' placeholder="Jumlah Obat" onkeyup="sum();" />
                                    </div>
                                    <div class="col-2">
                                        <input type="text" class="form-control" id="price_set" name="price_set" size='1'
                                            tabindex='1' placeholder="Harga" onkeyup="sum();" />
                                    </div> =
                                    <div class="col-2">
                                        <input type="text" id="txt3" class="form-control" name="txt3" readonly />
                                    </div>
                                    <div class="input-group-addon ml-3">
                                        <a href="javascript:void(0)" class="btn btn-success addMore"><i
                                                class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- </div> -->

                            <!-- </div> -->

                            <!-- batasssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss -->



                            <!-- <input type="hidden" id="days" name="days" value="0" class="inputOne" cols="9" rows="4" /> -->



                            <input type="hidden" id="medicine_charge" name="medicine_charge" value="yes"
                                class="inputOne" cols="9" rows="4" />

                            <div class="details-clear">&nbsp;</div>

                            <input type="hidden" name="patient" value="<?php echo report_info("patient", $id); ?>"
                                class="inputOne" cols="9" rows="4" />

                            <!-- -------------------------- -->

                            <input name="submit" class="btn btn-default formbutton theme-patients sign_rep_1"
                                name="submit" class="formbutton patient" type="submit" value="update">
                        </form>

                        <!-- contohhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh -->

                        <div class="form-group fieldGroupCopy" style="display: none;">
                            <div class="input-group">
                                <div class="col-2">
                                    <select class="form-control" name='medicine' id='medicine'>
                                        <?php
                                        $sql = mysqli_query($con, "select * from p_stock where branch='$get_composer_branch' order by code asc limit 9000") or die(mysqli_error());
                                        while ($medicines = mysqli_fetch_array($sql)) {
                                        ?>
                                        <option value='<?php echo $medicines['code'] ?>'> Rp.
                                            <?php echo medicine_by_code('price', $medicines['code']) ?>
                                            <?php if (display_permission("medicine_profile") == true) {
                                                    echo '- ' . medicine_by_code('name', $medicines['code']);
                                                } ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control" id="doses" name="doses" size='1'
                                        tabindex='1' placeholder="Jumlah Obat" onkeyup="sum();" />
                                </div>
                                <div class="col-2">
                                    <input type="text" class="form-control" id="price_set" name="price_set" size='1'
                                        tabindex='1' placeholder="Harga" onkeyup="sum();" />
                                </div> =
                                <div class="col-2">
                                    <input type="text" id="txt3" class="form-control" name="txt3" readonly />
                                </div>
                                <div class="input-group-addon ml-3">
                                    <a href="javascript:void(0)" class="btn btn-danger remove"><i
                                            class="fas fa-trash"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- </form> -->

                        <!-- contooooooooooooohhhhhhhhhhhhhhhhhhhhhhhhhhhh -->




                        <a class="btn btn-default formbutton theme-stsaff norm sign_rep_1"
                            href="../dashboard">Close!</a>

                        <div class="panel panel-default push_low">
                            <div class="panel-heading _theme-patients">About Patient</div>
                            <div class="panel-body">
                                <table class="table table-striped link-patients link-patients">
                                    <tbody>
                                        <tr>
                                            <td>Patient:</td>
                                            <td><a href="../patients/profile.php?id=<?php echo patient_info("id", $patient_id); ?>"
                                                    class="patient"><?php echo patient_info("name", $patient_id); ?></a>
                                                |
                                                <?php echo patient_info("serial", $patient_id); ?>-<?php echo patient_info("id", $patient_id); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Registered:</td>
                                            <td><?php echo $global_permission->guardian_short_name;
                                                echo patient_info("branch", $patient_id); ?>
                                                - <?php echo branch_name(patient_info("branch", $patient_id)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Registered By:</td>
                                            <td><a class="staff"
                                                    href="../staff/profile.php?id=<?php echo patient_info("physician", $patient_id); ?>"><?php echo staff_info("full_name", patient_info("physician", $patient_id)); ?></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Last Update:</td>
                                            <td><?php echo display_time(patient_info("last_update", $patient_id)); ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <!-- panel panel-default -->
                </div> <!-- container -->
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    // membatasi jumlah inputan
    var maxGroup = 10;

    //melakukan proses multiple input 
    $(".addMore").click(function() {
        if ($('body').find('.fieldGroup').length < maxGroup) {
            var fieldHTML = '<div class="form-group fieldGroup">' + $(".fieldGroupCopy").html() +
                '</div>';
            $('body').find('.fieldGroup:last').after(fieldHTML);
        } else {
            alert('Maximum ' + maxGroup + ' groups are allowed.');
        }
    });

    //remove fields group
    $("body").on("click", ".remove", function() {
        $(this).parents(".fieldGroup").remove();
    });
});
</script>

<script>
function sum() {
    var txtFirstNumberValue = document.getElementById('doses').value;
    var txtSecondNumberValue = document.getElementById('price_set').value;
    var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
    if (!isNaN(result)) {
        document.getElementById('txt3').value = result;
    }
}
</script>

<?php sns_footer(); ?>