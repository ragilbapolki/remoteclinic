<?php
require_once "../includes/initiate.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$patient_id = report_info("patient", $id);
sns_header('Patient Report');
?>

</div>


<div class="content-page">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Reports</h4>
                        </div>
                    </div>
                    <div class="card-body">

                        <?php

                        /* Disabled by default
		
		if(display_permission("prescribe_patient")==true){

			$patient_id=report_info("patient",$id);
			$engaged_status=report_info("engaged_by",$id);
			$signed_status=report_info("signed_by",$id);	
			
			$get_composer_branch=staff_info("branch",report_info("composed_by",$id));
			
			if($engaged_status==""&&$signed_status==""){
			echo"<div class='alert alert-info' role='alert'>This report is now assigned to you!</div>";
			}else if($engaged_status!=""&&$signed_status==""){
			$engaged_by=report_info("engaged_by",$id);
			$engaged_by_name= staff_info("full_name",$engaged_by);
			echo"<div class='alert alert-warning' role='alert'>This report was assigned to $engaged_by_name (ID# $engaged_by) but hasn’t been signed yet!</div>";
			}else if($signed_status!=""){
			$signed_by_id=report_info("signed_by",$id);	
			$signed_by=staff_info("full_name",$signed_by_id);
			echo"<div class='alert alert-success' role='alert'>Signed by <a class='staff' href='../staff/profile$extension?id=$signed_by_id'>$signed_by</a> (ID# $signed_by_id)!</div>";
			}else{
			echo"";
			}
			$engaged_by=engage_the_report($id);
		}

		*/
                        ?>

                        <table class="table table-striped link-patients link-patients">
                            <tbody>
                                <tr>
                                    <td>Report ID:</td>
                                    <td><?php echo $id; ?></td>
                                </tr>
                                <tr>
                                    <td>Last Update:</td>
                                    <td><?php echo display_time(report_info("last_update", $id)); ?></td>
                                </tr>
                                <!-- <tr>
                                    <td>Pemeriksaan Charge:</td>
                                    <td><?php echo charge_mode(report_info("charge", $id)); ?>
                                        <?php echo "$global_permission->currency" ?></td>
                                </tr> -->
                                <?php if (report_info("checkout_charges", $id) != "") {  ?>
                                <tr>
                                    <td>Total Bayar :</td>
                                    <td class="checkout"><?php echo report_info("checkout_charges", $id); ?>
                                        <?php echo "$global_permission->currency" ?> (Sudah Termasuk biaya pemeriksaan!)
                                    </td>
                                </tr>
                                <?php } else { ?>
                                <tr>
                                    <td>Total Bayar :</td>
                                    <td>N/A</td>
                                </tr>
                                <?php } ?>
                                <?php if (report_info("signed_by", $id) != "") { ?><tr>
                                    <td>Signed by:</td>
                                    <td><?php echo staff_info('full_name', report_info("signed_by", $id)); ?></td>
                                </tr><?php } ?>

                                <?php if (report_attachment("exist", $id) == true) { ?><tr>
                                    <td>Reports:</td>
                                    <td><a href="../media/reports/<?php echo "$id" ?>.zip">Download attachments</a>
                                        </li>
                                        <li>
                                    </td>
                                </tr><?php } ?>


                                <?php
                                $sql = mysqli_query($con, "select p_med_record.*, p_medicine_dir.name from p_med_record,p_medicine_dir where report_id='$id' AND p_medicine_dir.code = p_med_record.medicine order by last_update desc limit 9000") or die(mysqli_error());
                                while ($medicines = mysqli_fetch_array($sql)) {
                                ?>
                                <tr>
                                    <td>- <?php echo $medicines['name'] ?></td>
                                    <td>Jumlah obat : <?php echo $medicines['doses'] ?>

                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <?php if (display_permission("prescribe_patient") == true) {; ?>
                        <a class="btn btn-default formbutton theme-patients"
                            href="prescribe.php?id=<?php echo "$id"; ?>">Edit</a>
                        <?php } ?>

                        <div class="panel panel-default push_low">
                            <div class="panel-heading _theme-patients">About Patient</div>
                            <div class="panel-body">

                                <table class="table table-striped link-patients  link-patients">
                                    <tbody>
                                        <tr>
                                            <td>Patient:</td>
                                            <td><a href="../patients/profile.php?id=<?php echo $patient_id; ?>"
                                                    class="patient"><?php echo patient_info("name", $patient_id); ?></a>
                                                |
                                                <?php echo patient_info("serial", $patient_id); ?>-<?php echo patient_info("id", $patient_id); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Registered At:</td>
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

                    </div>
                </div> <!-- panel panel-default -->
            </div> <!-- container -->
        </div>
    </div>
</div>

<?php sns_footer(); ?>