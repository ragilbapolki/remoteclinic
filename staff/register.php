<?php
require_once "../includes/initiate.php";
page_permission("add_staff");
sns_header('Staff Baru');
?>

</div>


<div class="content-page">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Staff Baru</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
						if (isset($_POST['submit'])) {

							$title = $_POST['title'];
							$first_name = friendly($_POST['first_name']);
							$last_name = friendly($_POST['last_name']);
							$userid = friendly($_POST['userid']);
							$passkey = friendly($_POST['passkey']);
							$contact = friendly($_POST['contact']);
							$mobile = friendly($_POST['mobile']);
							$skype = friendly($_POST['skype']);
							$address = friendly($_POST['address']);
							$access_level = friendly($_POST['access_level']);
							$status = friendly($_POST['status']);
							$branch = friendly($_POST['branch']);

							$result = register_staff($title, $first_name, $last_name, $userid, $passkey, $contact, $mobile, $skype, $address, $access_level, $branch, $status);

							if ($result != "") {
								echo "<div class='alert alert-success' role='alert'>Profile successfully created!</div>";
								write_log("$_SESSION[id]", "registered new staff member $title $first_name $last_name", "staff", "50");

								if (isset($_FILES["image"]["tmp_name"]) && $_FILES["image"]["tmp_name"] != "") {
									$dest = "../media/staff/$result" . ".png";
									copy($_FILES["image"]["tmp_name"], $dest);
								}
							} else {
								echo "<div class='alert alert-danger' role='alert'>Please fill out all required fields!</div>";
								echo "<input class='btn btn-default formbutton theme-staff' value='Try Again' onclick='window.history.back()'/>";
							}
						} else {

						?>
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="form-group"><label>Title:</label><select class="form-control" name='title'
                                    id='title' size='1' tabindex='1'>
                                    <option value='Dr.'>Dr.</option>
                                    <option value='Mr.'>Mr.</option>
                                    <option value='Miss.'>Miss.</option>
                                    <option value='Mrs.'>Mrs. </option>
                                    <option value='Nurse.'>Nurse. </option>
                                </select></div>

                            <div class="form-group"><label>Nama Awal:</label><input class="form-control"
                                    name="first_name" type="text" /></div>
                            <div class="form-group"><label>Nama Akhir:</label><input class="form-control"
                                    name="last_name" type="text" /></div>
                            <div class="form-group"><label>User ID:</label><input class="form-control" name="userid"
                                    type="text" /><i>Recommended to use an email address - Can’t be changed</i></div>
                            <div class="form-group"><label>Password:</label><input class="form-control" name="passkey"
                                    type="text" /></div>
                            <div class="form-group"><label>Kontak Nomor:</label><input class="form-control"
                                    name="contact" type="text" /></div>
                            <div class="form-group"><label>Nomor Telp/WA:</label><input class="form-control"
                                    name="mobile" type="text"><i>Hidden from the staff with access level less than 4</i>
                            </div>
                            <div class="form-group"><label>Chat:</label><input class="form-control" name="skype"
                                    type="text" /></div>
                            <div class="form-group"><label>Alamat Pribadi:</label><input class="form-control"
                                    name="address" type="text" /><i>Hidden from the staff with access level less than
                                    4</i></div>
                            <div class="form-group"><label>Akses Level:</label><select class="form-control"
                                    name='access_level' id='access_level' size='1' tabindex='1'>
                                    <option value='1'>1 - <?php echo access_level2rank(1); ?></option>
                                    <option value='2'>2 - <?php echo access_level2rank(2); ?></option>
                                    <option value='3'>3 - <?php echo access_level2rank(3); ?></option>
                                    <option value='4'>4 - <?php echo access_level2rank(4); ?></option>
                                    <option value='5'>5 - <?php echo access_level2rank(5); ?></option>
                                </select></div>
                            <div class="form-group"><label>Status:</label><select class="form-control" name='status'
                                    id='status' size='1' tabindex='1'>
                                    <option value='active'>active</option>
                                    <option value='blocked'>blocked</option>

                                </select></div>
                            <div class="form-group"><label>Cabang:</label>
                                <select class="form-control" name='branch' id='branch' size='1' tabindex='1'>
                                    <?php
										$sql = mysqli_query($con, "select * from p_branches_dir order by last_update desc limit 2000") or die(mysqli_error());
										while ($branches_dir = mysqli_fetch_array($sql)) {
										?>
                                    <option value='<?php echo $branches_dir['id'] ?>'>
                                        <?php echo "$global_permission->guardian_short_name";
												echo $branches_dir['id'] ?>
                                        - <?php echo $branches_dir['name'] ?></option>
                                    <?php } ?>
                                </select>
                                <i>Assign headquarter for the staff responsible to handle global quires</i>
                            </div>
                            <div class="form-group mb-3 custom-file-small"><label>Foto Profil:</label>
                                <div class="custom-file">
                                    <input class="custom-file-input" id="inputGroupFile02" name="image" type="file" />
                                    <label class="custom-file-label" for="inputGroupFile02">Pilih file</label>
                                </div>
                            </div>

                            <input name="submit" class="btn btn-default formbutton theme-staff" type="submit"
                                value="Daftar">

                        </form>
                        <?php } ?>

                    </div>
                </div> <!-- panel panel-default -->
            </div> <!-- container -->
        </div>
    </div>
</div>
</div>


<?php sns_footer(); ?>