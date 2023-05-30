<?php
require_once "../includes/initiate.php";
page_permission("branches_directory");
sns_header('Klinik');
?>

</div>



<div class="content-page">

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Klinik</h4>
                        </div>
                    </div>
                    <div class="card-body">

                        <?php if (isset($_GET['deleted'])) {
                            $deleted = $_GET['deleted']; ?>
                        <div class="alert alert-success" role="alert">Klinik Profile berhasil dihapus!!
                        </div>
                        <?php } ?>


                        <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['corechart']
                        });
                        google.charts.setOnLoadCallback(drawVisualization);

                        function drawVisualization() {
                            // Some raw data (not necessarily accurate)
                            var data = google.visualization.arrayToDataTable([
                                ['Activity', 'Patients', 'Reports', 'Active Staff'],
                                <?php
                                    $sql = mysqli_query($con, "select * from p_branches_dir order by last_update desc limit 2000") or die(mysqli_error());
                                    while ($clinics = mysqli_fetch_array($sql)) {
                                    ?>['<?php echo branch_info("name", $clinics['id']); ?>',
                                    <?php echo count_patients($clinics['id'], get_global('recent_hours')) ?>,
                                    <?php echo count_reports($clinics['id'], get_global('recent_hours')) ?>,
                                    <?php echo count_lstaff($clinics['id'], get_global('recent_hours')) ?>],
                                <?php } ?>
                            ]);

                            var options = {
                                seriesType: 'bars',
                                fontSize: 12,
                                fontName: 'Source Sans Pro',
                                colors: ['#BA77FF', '#DDBBFF', '#EEDDFF'],
                                hAxis: {
                                    textStyle: {
                                        fontSize: 13,
                                        color: '#1d1d1d',
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
                                series: {
                                    5: {
                                        type: 'line'
                                    }
                                }

                            };

                            var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
                            chart.draw(data, options);
                        }
                        </script>

                        <div id="chart_div" style="width: 100%; height: 300px;" class="center-chart"></div>
                        <div class="chart-note">*last <?php echo show_recent_hours(); ?></div>
                        <br>
                    </div>
                </div>
                <div class="row">

                    <?php
                    $sql = mysqli_query($con, "select * from p_branches_dir order by last_update desc limit 100") or die(mysqli_error());
                    while ($clinics = mysqli_fetch_array($sql)) {
                    ?>

                    <!-- <a class="nohover" href="profile.php?id=<?php echo $clinics['id'] ?>"> -->
                    <div class="col-sm-4 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo substr($clinics['name'], 0, 30); ?> -
                                    <?php echo "$global_permission->guardian_short_name";
                                        echo $clinics['id'] ?>
                                    <?php if ($clinics['type'] == "Head Office") {
                                            echo " (Head Office)";
                                        } else {
                                            echo "";
                                        } ?>
                                </h4>
                                <hr>
                                <p class="card-text"><i class="ri-map-pin-line m-0"></i>
                                    <?php echo substr($clinics['address'], 0, 16); ?>,
                                    <?php echo $clinics['location'] ?> <br> <i class="ri-phone-line">
                                    </i><?php echo $clinics['contact'] ?></p>

                            </div>
                        </div>
                    </div>
                    <!-- </a> -->

                    <?php } ?>

                </div>

                <!-- </a> -->

                <br>
            </div>
        </div> <!-- panel panel-default -->
    </div> <!-- container -->
</div>
<!-- </div> -->


<?php sns_footer(); ?>