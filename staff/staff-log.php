<?php
require_once "../includes/initiate.php";
page_permission("staff_profile");

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	// action
} else {
	$id = $_SESSION['id'];
}
sns_header('Staff Log');
?>

</div>


<div class="content-page">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Staff Log</h4>
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table table-striped">
                            <tbody>
                                <?php
								$sql = mysqli_query($con, "select * from p_logs where user='$id' order by id desc limit 500") or die(mysqli_error());
								while ($display_log = mysqli_fetch_array($sql)) {
								?>
                                <tr>
                                    <td><?php echo display_time($display_log['at']); ?><span
                                            class="priority_<?php echo priority_level($display_log['priority']); ?>">:
                                            <?php echo $display_log['action'] ?></span></td>
                                </tr>
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