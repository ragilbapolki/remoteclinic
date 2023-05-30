<?php
	require_once "../includes/initiate.php";
	page_permission("add_branch");
	sns_header('Tambah Klinik Baru');
?>

</div>


<div class="content-page">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Tambah Klinik Baru</h4>
                        </div>
                    </div>
                    <div class="card-body">

                        <?php
if(isset($_POST['submit'])){
	
	$guardian="1";
	$name=friendly($_POST['name']);
	$address=friendly($_POST['address']);
	$location=friendly($_POST['location']);
	$contact=friendly($_POST['contact']);
	$type=$_POST['type'];
	
	$get_id=register_branch_profile($guardian,$name,$address,$location,$contact,$type);
	write_log("$_SESSION[id]","registered New Klinik Profile for $name ($get_id)","branch","50");
	
	echo"<div class='alert alert-success' role='alert'>New Profile has been registered. <strong>ID:</strong> $global_permission->guardian_short_name - $get_id </div>";
	echo"<a class='btn btn-default formbutton theme-branches' href=../clinics/>Kliniks Directory</a>";

	}else{
?>
                        <form method="post" action="" enctype="multipart/form-data">

                            <div class="form-group"><label hidden>Parent:</label><input class="form-control" name="name"
                                    value="<?php echo "$global_permission->guardian_name"?>" readonly="readonly"
                                    type="text" hidden /></div>

                            <div class="form-group"><label>Klinik Nama:</label><input class="form-control" name="name"
                                    type="text" /></div>
                            <div class="form-group"><label>Klinik Alamat:</label><input class="form-control"
                                    name="address" type="text" /></div>
                            <div class="form-group"><label>Klinik Kota:</label><input class="form-control"
                                    name="location" type="text" /></label></div>
                            <div class="form-group"><label>Klinik Kontak:</label><input class="form-control"
                                    name="contact" type="text" /></label></div>
                            <div class="form-group"><label>Klinik Rank:</label><select class="form-control" name='type'
                                    id='gender' size='1' tabindex='1'>
                                    <option value='Branch'>Klinik Baru</option>
                                    <option value='Head Office'>Head Office</option>
                                </select></div>
                            <input name="submit" class="btn btn-default formbutton theme-branches" type="submit"
                                value="Register">
                        </form>

                        <?php }?>

                    </div>
                </div> <!-- panel panel-default -->
            </div> <!-- container -->
        </div>
    </div>
</div>
</div>


<?php sns_footer();?>