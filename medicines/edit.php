<?php
require_once "../includes/initiate.php";
page_permission("introduce_medicine");
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}
sns_header('Edit Obat');
?>

</div>


<div class="content-page">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Edit Obat</h4>
                        </div>
                    </div>
                    <div class="card-body">

                        <?php
						if (isset($_POST['submit'])) {

							$id = $_POST['id'];
							$category = $_POST['category'];
							$code = friendly(strtoupper($_POST['code']));
							$name = friendly($_POST['name']);
							$price = friendly($_POST['price']);
							$price = preg_replace("/[^0-9\s]/", "", $price);
							$added_by = staff_info('id');

							if (edit_medicine($id, $category, $code, $name, $price, $added_by) == true) {
								write_log(staff_info('id'), "edit profile for Obat $name with code $code", "medicine", "30");
								echo "<div class='alert alert-success' role='alert'>Profile Updated Successfully. The code given to this medicine is $code.</div>";
								echo "<a class='btn btn-default formbutton theme-medicines' href=../medicines/>Show All</a>";
							} else {
								echo "<div class='alert alert-danger' role='alert'>Please try different code.</div>";
								echo "<a class='btn btn-default formbutton theme-medicines' href=../medicines/new.php>try again</a>";
							}
						} else {

							$medicine = mysqli_fetch_object(mysqli_query($con, "select * from p_medicine_dir where id='$id' ")); ?>

                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="form-group"><label>Jenis Obat:</label><select class="form-control"
                                    name='category' id='category' size='1' tabindex='1'>
                                    <option value='<?php echo $medicine->category; ?>'>
                                        <?php echo $medicine->category; ?>
                                        (Current)</option>
                                    <option value='Bottle'>Botol</option>
                                    <option value='Syrup'>Sirup</option>
                                    <option value='Tablets'>Tablet</option>
                                </select></div>
                            <div class="form-group"><label>Obat Code:</label><input class="form-control" name="code"
                                    type="text" maxlength="10" value="<?php echo $medicine->code; ?>" /></div>
                            <div class="form-group"><label>Obat Nama:</label><input class="form-control" name="name"
                                    type="text" maxlength="30" value="<?php echo $medicine->name; ?>" /></div>
                            <div class="form-group"><label>Harga per obat(Rp.):</label><input class="form-control"
                                    name="price" type="text" maxlength="10"
                                    value="<?php echo $medicine->price; ?>" /><i>e.g: IDR
                                    10.000 Per tablet</i></div>
                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                            <input name="submit" class="btn btn-default formbutton theme-medicines" type="submit"
                                value="Update">
                        </form>
                        <?php } ?>

                    </div>
                </div> <!-- panel panel-default -->
            </div> <!-- container -->
        </div>
    </div>
</div>
<?php sns_footer(); ?>