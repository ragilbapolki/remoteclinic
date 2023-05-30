<?php
require_once "../includes/initiate.php";
page_permission("introduce_medicine");
sns_header('Obat Baru');
?>

</div>


<div class="content-page">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Obat Baru</h4>
                        </div>
                    </div>
                    <div class="card-body">

                        <?php
						if (isset($_POST['submit'])) {

							$category = $_POST['category'];
							$code = friendly(strtoupper($_POST['code']));
							$name = friendly($_POST['name']);
							$price = friendly($_POST['price']);
							$price = preg_replace("/[^0-9\s]/", "", $price);
							$added_by = $_SESSION['id'];

							if (introduce_medicine($category, $code, $name, $price, $added_by) == true) {
								write_log("$_SESSION[id]", "introduced new Obat with the name of $name and code $code", "medicine", "30");
								echo "<div class='alert alert-success' role='alert'>$name has been successfully registered. (Code: $code)</div>";
								echo "<a class='btn btn-default formbutton theme-medicines' href=../medicines/>Show All</a>";
							} else {
								echo "<div class='alert alert-danger' role='alert'>Please fill out all required fields!</div>";
								echo "<a class='btn btn-default formbutton theme-medicines' href=../medicines/new.php>try again</a>";
							}
						} else {

						?>
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="form-group"><label>Jenis Obat:</label><select class="form-control"
                                    name='category' id='category' size='1' tabindex='1'>
                                    <option value='Bottle'>Botol</option>
                                    <option value='Syrup'>Sirup</option>
                                    <option value='Tablets'>Tablet</option>
                                    <option value='Tablets'>Pemeriksaan</option>
                                </select></div>
                            <div class="form-group"><label>Obat Code:</label><input class="form-control" name="code"
                                    type="text" maxlength="10" /></div>
                            <div class="form-group"><label>Obat Nama:</label><input class="form-control" name="name"
                                    type="text" maxlength="30" /></div>
                            <div class="form-group"><label>Harga per obat (Rp.):</label><input class="form-control"
                                    name="price" type="text" maxlength="10" /><i>e.g: RS.5 Per tablet</i></div>
                            <input name="submit" class="btn btn-default formbutton theme-medicines" type="submit"
                                value="Tambah">
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