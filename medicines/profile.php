<?php
require_once "../includes/initiate.php";
page_permission("medicine_profile");

if (isset($_GET['id'])) {
  $id = $_GET['id'];
}
if (isset($_GET['delete'])) {
  medicine_delete($id);
  print "<script>";
  print "self.location='../medicines/?deleted';";
  print "</script>";
}

sns_header('Profil Obat');
$medicine = mysqli_fetch_object(mysqli_query($con, "select * from p_medicine_dir where id='$id' "));
?>

</div>


<div class="content-page">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Profil Obat</h4>
                        </div>
                    </div>
                    <div class="card-body">


                        <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['corechart']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['-', '<?php echo $medicine->code; ?> Usage'],
                                <?php $get_diff = get_global('recent_hours') / 24;
                  for ($k = 0; $k < get_global('recent_hours'); $k++) {
                    $k = $k + $get_diff; ?>[
                                    '-', <?php echo prescribe_count($medicine->code, $k); ?>],
                                <?php } ?>
                            ]);

                            var options = {
                                curveType: 'function',
                                fontSize: 12,
                                fontName: 'Source Sans Pro',
                                colors: ['#D667CE'],
                                hAxis: {
                                    textStyle: {
                                        fontSize: 13,
                                        color: 'transparent',
                                    },
                                },
                                vAxis: {
                                    format: '0',
                                    baselineColor: '#fafafa',
                                    textStyle: {
                                        color: 'transparent',
                                    },
                                    gridlines: {
                                        color: 'transparent'
                                    }
                                },
                                legend: {
                                    position: 'bottom'
                                }
                            };

                            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
                            //var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));


                            chart.draw(data, options);
                        }
                        </script>
                        <div id="curve_chart" style="width: 100%; height: 300px;" class="center-chart"></div>
                        <div class="chart-note">*last <?php echo show_recent_hours(); ?></div>
                        <br>


                        <table class="table table-striped">
                            <tbody>

                                <tr>
                                    <td>ID:</td>
                                    <td><?php echo $medicine->id; ?></td>
                                </tr>
                                <tr>
                                    <td>Obat Code:</td>
                                    <td><?php echo $medicine->code; ?></td>
                                </tr>
                                <tr>
                                    <td>Jenis Obat:</td>
                                    <td><?php echo $medicine->category; ?></td>
                                </tr>
                                <tr>
                                    <td>Nama Obat:</td>
                                    <td><?php echo $medicine->name; ?></td>
                                </tr>
                                <tr>
                                    <td>Harga:</td>
                                    <td><?php echo $medicine->price . ' ' . get_global('currency'); ?></td>
                                </tr>
                                <tr>
                                    <td>Prescribed:</td>
                                    <td><?php echo prescribe_count($medicine->code, get_global('recent_hours')); ?>
                                        time(s) in last <?php echo show_recent_hours(); ?></td>
                                </tr>

                            </tbody>
                        </table><br>

                        <div class="edit-button"><a class="btn btn-default formbutton theme-medicines"
                                href="edit.php?id=<?php echo $medicine->id; ?>&delete=1">Edit Obat</a></div>
                        <div id="page-clear" align="center">
                            <div id="deleteButton"><a class="delete-me"
                                    href="?id=<?php echo $medicine->id; ?>&delete=1">Hapus Obat</a></div>
                        </div>

                    </div>
                </div> <!-- panel panel-default -->
            </div> <!-- container -->
        </div>
    </div>
</div>

<?php sns_footer(); ?>