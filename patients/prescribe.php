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

<?php sns_header('Resep Pasien'); ?>

</div>


<div class="content-page">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Pasien</h4>
                        </div>

                        <a class="btn bg-dark-light" href="../dashboard">
                            <i class="fa-solid fa-xmark" style="color:#616982 !important"></i>Close
                        </a>
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
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                            $report_id = $id;
                            $blood              = !empty($_POST['blood'])? $_POST['blood'] : '';
                            $tensi              = !empty($_POST['tensi'])? $_POST['tensi'] : '';
                            $is_hipertensi      = !empty($_POST['is_hipertensi'])? $_POST['is_hipertensi'] : '';
                            $is_diabetes        = !empty($_POST['is_diabetes'])? $_POST['is_diabetes'] : '';
                            $is_hemophilia      = !empty($_POST['is_hemophilia'])? $_POST['is_hemophilia'] : '';  
                            $other_diseases     = !empty($_POST['other_diseases'])? $_POST['other_diseases'] : '';   
                            $indication         = !empty($_POST['indication'])? $_POST['indication'] : '';  
                            $diagnosis          = !empty($_POST['diagnosis'])? $_POST['diagnosis'] : '';  
                            $is_hepatitis       = !empty($_POST['is_hepatitis'])? $_POST['is_hepatitis'] : '';  
                            $result_pemeriksaan = pemeriksaan($report_id, $blood, $tensi, $is_hipertensi, $is_diabetes, $is_hemophilia, $other_diseases, $indication, $diagnosis,$is_hepatitis);
                            // $medicine = $_POST['medicine'];
                            // $doses = $_POST['doses'];
                            // $price_set = $_POST['price_set'];
                            // $medicine_charge = $_POST['medicine_charge'];
                            $jml_data = count($_POST['atrs']);
                            for ($count = 0; $count < $jml_data; $count++) {
                                $doses          = $_POST['atrs'][$count]['doses'];
                                $price_set      = $_POST['atrs'][$count]['price_set'];
                                $medicine       = $_POST['atrs'][$count]['medicine'];
                                $medicine_charge= $_POST['atrs'][$count]['medicine_charge'];
                                $result = prescribe($report_id, $medicine, $doses, $medicine_charge, $price_set);
                            }
                            

                            if (!empty($doses)) {
                                for ($a = 0; $a < count($doses); $a++) {
                                    if (!empty($doses[$a])) {
                                        $doses = $doses[$a];
                                        $price_set = $price_set[$a];
                                        $medicine = $medicine[$a];
                                        $medicine_charge = $medicine_charge[$a];
                                    }
                                }
                            }


                            if ($result != false) {
                                echo "<div class='alert alert-success' role='alert'>Resep berhasil diperbarui!</div>";
                            } else {
                                echo "<div class='alert alert-danger' role='alert'>Maaf, obat yang dipilih habis. Silahkan tambah stok Obat!</div>";
                            }
                        }
                        ?>

                        <div class="panel panel-default push_low card">
                            <div class="panel-heading _theme-patients card-header"><strong>Data Pasien</strong></div>
                            <div class="panel-body card-body">
                                <table class="table table-striped link-patients link-patients">
                                    <tbody>
                                        <tr>
                                            <td>Pasien:</td>
                                            <td><a href="../patients/profile.php?id=<?php echo patient_info("id", $patient_id); ?>"
                                                    class="patient"><?php echo patient_info("name", $patient_id); ?></a>
                                                |
                                                <?php echo patient_info("serial", $patient_id); ?>-<?php echo patient_info("id", $patient_id); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Klinik :</td>
                                            <td><?php echo $global_permission->guardian_short_name;
                                                echo patient_info("branch", $patient_id); ?>
                                                - <?php echo branch_name(patient_info("branch", $patient_id)); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Didaftarkan Oleh :</td>
                                            <td><a class="staff"
                                                    href="../staff/profile.php?id=<?php echo patient_info("physician", $patient_id); ?>"><?php echo staff_info("full_name", patient_info("physician", $patient_id)); ?></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Pembaruan Terakhir :</td>
                                            <td><?php echo display_time(patient_info("last_update", $patient_id)); ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <table class="table table-striped link-patients link-patients">
                                    <tbody>
                                        <!-- <tr>
                                            <td>Token Charge:</td>
                                            <td><?php echo "$global_permission->currency" ?>
                                                <?php echo charge_mode(report_info("charge", $id)); ?></td>
                                        </tr> -->

                                        <?php if (report_info("checkout_charges", $id) != "") {  ?>
                                        <tr>
                                            <td colspan="2">Report ID :</td>
                                            <td colspan="2"><?php echo $id; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Total Pembayaran :</td>
                                            <td colspan="2"><?php echo "$global_permission->currency" ?>
                                                <?php echo report_info("checkout_charges", $id); ?></td>
                                        </tr>
                                        <?php } else { ?>
                                        <!-- <tr>
                                            <td>Total Payment :</td>
                                            <td>0</td>
                                        </tr> -->
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
                                            <td>Reports :</td>
                                            <td><a href="../media/reports/<?php echo "$id" ?>.zip">Download
                                                    attachments</a></td>
                                        </tr><?php } ?>
                                        <!-- <tr>
                                            <td>Symptoms:</td>
                                            <td><textarea readonly class="form-textarea"><?php echo report_info("symptoms", $id); ?></textarea>
                                            </td>
                                        </tr> -->
                                        <?php
                                        $sql_pemeriksaan = mysqli_query($con, "select  p_diagnosis_record.* from p_diagnosis_record where report_id='$id' 
                                        order by last_update desc limit 1") or die(mysqli_error());
                                        $data_pemeriksaan = mysqli_fetch_array($sql_pemeriksaan);
                                        if (!empty($data_pemeriksaan)) {
                                            $darah_tinggi     = $data_pemeriksaan['is_hipertensi'] == 1 ? 'Ada' : 'Tidak Ada'; 
                                            $gula_dara        = $data_pemeriksaan['is_diabetes'] == 1 ? 'Ada' : 'Tidak Ada'; 
                                            $hempohilia       = $data_pemeriksaan['is_hemophilia'] == 1 ? 'Ada' : 'Tidak Ada'; 
                                            $hepatitis        = $data_pemeriksaan['is_hepatitis'] == 1 ? 'Ada' : 'Tidak Ada'; 
                                            ?>
                                            <tr>
                                                <strong>Hasil Pemeriksaan</strong>
                                            </tr>
                                            <tr>
                                                <td>Golongan Darah</td>
                                                <td> <?php echo $data_pemeriksaan['blood'] ?></td>
                                                <td>Penyakit Jantung</td>
                                                <td> <?php echo $darah_tinggi ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tekanan Darah</td>
                                                <td> <?php echo $data_pemeriksaan['tensi'] ?></td>
                                                <td>Diabetes</td>
                                                <td> <?php echo $gula_dara  ?></td>
                                            </tr>
                                            <tr>
                                                <td>Alergi Obat</td>
                                                <td> <?php echo $data_pemeriksaan['medicine_allergy'] ?></td>
                                                <td>Hemopilia</td>
                                                <td> <?php echo $hempohilia ?></td>
                                            </tr>
                                            <tr>
                                                <td>Penyakit Lainnya</td>
                                                <td> <?php echo $data_pemeriksaan['other_diseases'] ?></td>
                                                <td>Hemopilia</td>
                                                <td> <?php echo $hepatitis ?></td>
                                            </tr>
                                            <tr>
                                                <td>Gejala</td>
                                                <td> <?php echo $data_pemeriksaan['indication'] ?></td>
                                                <td>Diagnosis</td>
                                                <td> <?php echo $data_pemeriksaan['diagnosis']  ?></td>
                                            </tr>
                                        <?php
                                        }
                                        $sql = mysqli_query($con, "select  p_med_record.*, p_medicine_dir.name from p_med_record,p_medicine_dir where report_id='$id' AND p_medicine_dir.code = p_med_record.medicine
                                        order by last_update desc limit 9000") or die(mysqli_error());
                                        while ($list_med = mysqli_fetch_array($sql)) {
                                        ?>
                                        <tr>
                                            <td colspan="2">- <?php echo $list_med['name'] ?></td>
                                            <td colspan="2">Jumlah Obat : <?php echo $list_med['doses'] ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="card">
                                <div class="panel-heading _theme-patients card-header"><strong>Pemeriksaan</strong></div>
                                <br>
                                <div class="panel-body card-body">
                                    <div class="row form-group">
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="input-group" style="position: absolute;top:21%">
                                                        <label for="tensi">
                                                            Golongan Darah
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <select name="blood" id="blood" class="form-control" style="width: 50%;">
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="AB">AB</option>
                                                        <option value="O">O</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="input-group" style="position: absolute;top:21%">
                                                        <label for="tensi">
                                                            Penyakit Jantung
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_hipertensi" id="is_hipertensi" value="1">
                                                    <label class="form-check-label" for="is_hipertensi">
                                                        Ada
                                                    </label>
                                                    </div>
                                                    <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_hipertensi" id="is_hipertensi" value="0">
                                                    <label class="form-check-label" for="is_hipertensi">
                                                        Tidak Ada
                                                    </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="input-group" style="position: absolute;top:21%">
                                                        <label for="tensi">
                                                            Tekanan Darah
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <input style="width: 50%;" type="text" class="form-control" data-key="tensi" id="tensi" name="tensi" size='1' tabindex='1' placeholder="Tekanan Darah" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="input-group" style="position: absolute;top:21%">
                                                        <label for="tensi">
                                                            Diabetes
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_diabetes" id="is_diabetes" value="1">
                                                    <label class="form-check-label" for="is_diabetes">
                                                        Ada
                                                    </label>
                                                    </div>
                                                    <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_diabetes" id="is_diabetes" value="0">
                                                    <label class="form-check-label" for="is_diabetes">
                                                        Tidak Ada
                                                    </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="input-group" style="position: absolute;top:21%">
                                                        <label for="tensi">
                                                            Alergi Obat
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <input style="width: 50%;" type="text" class="form-control" data-key="medicine_allergy" id="medicine_allergy" name="medicine_allergy" size='1' tabindex='1' placeholder="Alergy Obat" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="input-group" style="position: absolute;top:21%">
                                                        <label for="tensi">
                                                            Hemopilia
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_hemophilia" id="is_hemophilia" value="1">
                                                    <label class="form-check-label" for="is_hemophilia">
                                                        Ada
                                                    </label>
                                                    </div>
                                                    <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_hemophilia" id="is_hemophilia" value="0">
                                                    <label class="form-check-label" for="is_hemophilia">
                                                        Tidak Ada
                                                    </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="input-group" style="position: absolute;top:21%">
                                                        <label for="tensi">
                                                            Penyakit Lainnya
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <input style="width: 50%;" type="text" class="form-control" data-key="other_diseases" id="other_diseases" name="other_diseases" size='1' tabindex='1' placeholder="Penyakit Lainnya" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="input-group" style="position: absolute;top:21%">
                                                        <label for="tensi">
                                                            Hepatitis
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_hepatitis" id="is_hepatitis" value="1">
                                                    <label class="form-check-label" for="is_hepatitis">
                                                        Ada
                                                    </label>
                                                    </div>
                                                    <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="is_hepatitis" id="is_hepatitis" value="0">
                                                    <label class="form-check-label" for="is_hepatitis">
                                                        Tidak Ada
                                                    </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="input-group" style="position: absolute;top:21%">
                                                        <label for="tensi">
                                                            Gejala
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <textarea name="indication" id="indication" cols="30" rows="2" class="form-control" placeholder="Gejala"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="input-group" style="position: absolute;top:21%">
                                                        <label for="tensi">
                                                            Diagnosis
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-9">
                                                    <textarea name="diagnosis" id="diagnosis" cols="30" rows="2" class="form-control" placeholder="Diagnosis"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default push_low">
                                <div class="class="card-header d-flex justify-content-between"">
                                <strong>Resep </strong>
                                    <a class="btn bg-warning-light addMore" style="float: right;"> <i class="fa-solid fa-plus"
                                            style="color:#cf9700 !important"></i>Tambah Obat </a>
                                </div>
                            </div>
                            <hr>
                                <div class="rangeComponent">
                                    <div class="form-group fieldGroup">
                                        <div class="input-group">
                                            <div class="col-2">
                                                <select class="form-control" name='atrs[0][medicine]'
                                                    id='atrs[0][medicine]'>
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
                                                <input type="text" class="form-control doses" data-key="doses"
                                                    id="atrs[0][doses]" name="atrs[0][doses]" size='1' tabindex='1'
                                                    placeholder="Jumlah Obat" />
                                            </div>
                                            <div class="col-2">
                                                <input type="text" class="form-control price_set" data-key="price_set"
                                                    id="atrs[0][price_set]" name="atrs[0][price_set]" size='1' tabindex='1'
                                                    placeholder="Harga" />
                                            </div> =
                                            <input type="hidden" id="atrs[0][medicine_charge]"
                                                name="atrs[0][medicine_charge]" value="yes" />

                                            <div class="col-2">
                                                <input type="text" id="atrs[0][txt3]" class="form-control total"
                                                    name="atrs[0][txt3]" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="input-group">
                                        <div class="col-2">
                                        </div>
                                        <div class="col-2">
                                        </div>
                                        <div class="col-2" style="text-align: right;">
                                            <strong>Grand Total</strong>
                                        </div> =
                                        <div class="col-2">
                                            <input type="text" id="grand_total" class="form-control grand_total"
                                                name="grand_total" readonly />
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="patient" value="<?php echo report_info("patient", $id); ?>"
                                class="inputOne" cols="9" rows="4" />

                                <div style="text-align: center;">
                                    <a class="btn bg-success-light">
                                        <i class="fa-solid fa-floppy-disk " style="color:#2f8f81 !important"></i>
                                        <input name="submit" name="submit"
                                            style="border: none;background-color: transparent;color:#2f8f81 !important"
                                            class="formbutton patient" type="submit" value="Simpan"></a>
                                </div>
                        </form>
                    </div>
                    <br>
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
    var arr_sum = {};

    //melakukan proses multiple input 
    $(".addMore").click(function() {
        var index = $('.fieldGroup').length;
        if (index < maxGroup) {
            appendAtrs(index)
        } else {
            toastr.error('Sorry', 'Maximum ' + maxGroup + ' groups are allowed.');
        }
    });

    //remove fields group
    $("body").on('click', '.deleteAtrs', function() {
        $(this).parent().parent().remove()
        var elemntId = this.name
        var arr_p = {};
        arr_p['idx'] = $('.fieldGroup').length
        arr_p['id'] = elemntId.substring(5, 6)
        removeAtrs(arr_p)
    })

    $("body").on('keyup', '.doses,.price_set', function() {
        console.log($(this).val())
        var index = $('.fieldGroup').length;
        var elemntId = this.id
        var arr_p = {};
        arr_p['val'] = $(this).val()
        arr_p['idx'] = elemntId.substring(5, 6)
        arr_p['key'] = $(this).data('key')
        sumAtrs(arr_p)
    });
    sumAtrs = (param) => {
        var val_doses = parseInt(0)
        var val_price = parseInt(0)
        var key = param.key
        var index = param.idx
        if (key == 'doses') {
            var val_doses = param.val
            var val_price = $(`[name="atrs[${index}][price_set]"]`).val()
        } else if (key == 'price_set') {
            var val_doses = $(`[name="atrs[${index}][doses]"]`).val()
            var val_price = param.val
        }
        var result = parseInt(val_doses) * parseInt(val_price);
        arr_sum['total' + index + ''] = result
        console.log(arr_sum);
        if (!isNaN(result)) {
            $(`[name="atrs[${index}][txt3]"]`).val(result)
        }
        var arr = $(".total");
        var tot = 0;
        for (var i = 0; i < arr.length; i++) {
            if (parseInt(arr[i].value))
                tot += parseInt(arr[i].value);
        }
        $(".grand_total").val(tot)
        arr_sum['total' + index + ''] = result
    }

    removeAtrs = (param) => {
        var id = param.id
        var index = param.idx
        var key = 'total' + index + ''
        delete arr_sum.key;

        if (index > 0) {
            $(".fieldGroup").each(function(index) {
                var prefix = "atrs[" + index + "]";
                $(this).find("textarea, input, select, .deleteAtrs").each(function() {
                    this.name = this.name.replace(/atrs\[\d+\]/, prefix);
                    this.id = this.id.replace(/atrs\[\d+\]/, prefix);
                });
                $(this).find('.index').html(index + 1)
            });
        }
        if (index == 1) {
            $(".fieldGroup").find(".deleteAtrs").remove();
        }
        console.log(arr_sum);
    }
});

appendAtrs = (index) => {
    if (index == 1 && $(".deleteAtrs").length == 0) {
        $(".fieldGroup").find(".input-group").append(
            `<a class="btn bg-danger-light deleteAtrs" name="atrs[0][deleteAtrs]"> <i class="fa fa-trash" style="color:#6e3434 !important"></i>Delete </a>`
        )
    }
    $(".rangeComponent").append(`
                <div class="form-group fieldGroup">
                    <div class="input-group">
                        <div class="col-2">
                            <select class="form-control" name='atrs[${index}][medicine]' id='atrs[${index}][medicine]'>
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
                            <input type="text" class="form-control doses" id="atrs[${index}][doses]" data-key="doses" name="atrs[${index}][doses]" size='1'
                                tabindex='1' placeholder="Jumlah Obat" />
                        </div>
                        <div class="col-2">
                            <input type="text" class="form-control price_set" id="atrs[${index}][price_set]" data-key="price_set" name="atrs[${index}][price_set]"
                                size='1' tabindex='1' placeholder="Harga" />
                        </div> =
                        <input type="hidden" id="atrs[${index}][medicine_charge]" name="atrs[${index}][medicine_charge]" value="yes"/>
                        <div class="col-2">
                            <input type="text" id="atrs[${index}]" class="form-control total" name="atrs[${index}][txt3]" readonly />
                        </div> 
                        <a class="btn bg-danger-light deleteAtrs" name="atrs[${index}][deleteAtrs]"> <i class="fa fa-trash" style="color:#6e3434 !important"></i>Delete </a>
                    </div>
                </div>
            `)

}
</script>

<?php sns_footer(); ?>