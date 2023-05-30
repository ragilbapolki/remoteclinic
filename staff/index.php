<?php
require_once "../includes/initiate.php";
page_permission("staff_directory");
sns_header('Staff Members');
?>

</div>


<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Staff Members</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_GET['deleted'])) {
                            $deleted = $_GET['deleted']; ?>
                            <div class="alert alert-success" role="alert">Staff Profile has been deleted successfully!</div>
                        <?php } ?>


                        <script type="text/javascript">
                            google.charts.load('current', {
                                'packages': ['corechart']
                            });
                            google.charts.setOnLoadCallback(drawVisualization);

                            function drawVisualization() {
                                // Some raw data (not necessarily accurate)
                                var data = google.visualization.arrayToDataTable([
                                    ['Activity', '<?php echo access_level2rank(5); ?>(s)',
                                        '<?php echo access_level2rank(4); ?>(s)',
                                        '<?php echo access_level2rank(3); ?>(s)'
                                    ],
                                    <?php
                                    $sql = mysqli_query($con, "select * from p_branches_dir order by last_update desc limit 2000") or die(mysqli_error());
                                    while ($branches_dir = mysqli_fetch_array($sql)) {
                                    ?>['<?php echo branch_info("name", $branches_dir['id']); ?>',
                                            <?php echo staff_by_rank($branches_dir['id'], 5); ?>,
                                            <?php echo staff_by_rank($branches_dir['id'], 4); ?>,
                                            <?php echo staff_by_rank($branches_dir['id'], 3); ?>],
                                    <?php } ?>
                                ]);

                                var options = {
                                    seriesType: 'bars',
                                    fontSize: 11,
                                    fontName: 'Source Sans Pro',
                                    colors: ['#50D2C2', '#A8E9E1', '#D3F4F0'],
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
                    </div>
                </div>
            </div>

            <div class="col-lg-12">

                <?php if (display_permission("staff_profile") == true) { ?>
                    <h4 class="profile-ranks"><?php echo access_level2rank(5); ?>(s) <br></h4>
            </div>

            <?php
                    $sql = mysqli_query($con, "select * from p_staff_dir where access_level='5' order by first_name asc limit 2000") or die(mysqli_error());
                    while ($staff = mysqli_fetch_array($sql)) {
            ?>

                <a class="nohover" href="profile<?php echo $extension; ?>?id=<?php echo $staff['id'] ?>">
                    <div class="col-lg-4">
                        <div class="card-transparent card-block card-stretch card-height d-flex justify-content-between">
                            <div class="card-body text-center p-0">
                                <div class="odr-img">
                                    <?php echo staff_img("$staff[id]", "80px"); ?>

                                </div>
                                <div class="odr-content rounded">
                                    <h4 class="mb-2"><?php echo $staff['full_name'] ?></h4>
                                    <p>ID#
                                        <?php echo $staff['id'] ?> — <span class="small_level_icon"><?php echo "$global_permission->guardian_short_name";
                                                                                                    echo $staff['branch'] ?></span></p>

                                    <ul class="list-unstyled mb-3">
                                        <li class="bg-secondary-light rounded-circle iq-card-icon-small mr-4">
                                            <i class="ri-home-line m-0"></i>
                                        </li>

                                        <li class="bg-success-light rounded-circle iq-card-icon-small"><i class="ri-phone-line m-0"></i></li>
                                    </ul>
                                    <div class="pt-3 border-top">
                                        <a href="mailto:<?php echo $staff['userid'] ?>" class="btn btn-primary"><i class="ri-mail-open-line"></i></li>Email</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </a>

            <?php } ?>

            <hr />

            <div class="col-lg-12">
                <h4 class="profile-ranks"><?php echo access_level2rank(4); ?>(s)</h4>
            </div>
            <?php
                    $sql = mysqli_query($con, "select * from p_staff_dir where access_level='4' order by first_name asc limit 2000") or die(mysqli_error());
                    while ($staff = mysqli_fetch_array($sql)) {
            ?>
                <a class="nohover" href="profile<?php echo $extension; ?>?id=<?php echo $staff['id'] ?>">
                    <div class="col-lg-4">
                        <div class="card-transparent card-block card-stretch card-height d-flex justify-content-between">


                            <div class="card-body text-center p-0">
                                <div class="odr-img">
                                    <?php echo staff_img("$staff[id]", "80px"); ?>
                                </div>
                                <div class="odr-content rounded">
                                    <h4 class="mb-2"><?php echo $staff['full_name'] ?></h4>
                                    <p>ID#
                                        <?php echo $staff['id'] ?> — <span class="small_level_icon"><?php echo "$global_permission->guardian_short_name";
                                                                                                    echo $staff['branch'] ?></span></p>

                                    <ul class="list-unstyled mb-3">
                                        <li class="bg-secondary-light rounded-circle iq-card-icon-small mr-4">
                                            <i class="ri-home-line m-0"></i>
                                        </li>

                                        <li class="bg-success-light rounded-circle iq-card-icon-small"><i class="ri-phone-line m-0"></i></li>
                                    </ul>
                                    <div class="pt-3 border-top">
                                        <a href="mailto:<?php echo $staff['userid'] ?>" class="btn btn-primary"><i class="ri-mail-open-line"></i></li>Email</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </a>

            <?php } ?>
            <hr />
            <div class="col-lg-12">
                <h4 class="profile-ranks"><?php echo access_level2rank(3); ?>(s)</h4>
            </div>

            <?php
                    $sql = mysqli_query($con, "select * from p_staff_dir where access_level='3' order by first_name asc limit 2000") or die(mysqli_error());
                    while ($staff = mysqli_fetch_array($sql)) {
            ?>
                <a class="nohover" href="profile<?php echo $extension; ?>?id=<?php echo $staff['id'] ?>">
                    <div class="col-lg-4">
                        <div class="card-transparent card-block card-stretch card-height d-flex justify-content-between">


                            <div class="card-body text-center p-0">
                                <div class="odr-img">
                                    <?php echo staff_img("$staff[id]", "80px"); ?>
                                </div>
                                <div class="odr-content rounded">
                                    <h4 class="mb-2"><?php echo $staff['full_name'] ?></h4>
                                    <p>ID#
                                        <?php echo $staff['id'] ?> — <span class="small_level_icon"><?php echo "$global_permission->guardian_short_name";
                                                                                                    echo $staff['branch'] ?></span></p>

                                    <ul class="list-unstyled mb-3">
                                        <li class="bg-secondary-light rounded-circle iq-card-icon-small mr-4">
                                            <i class="ri-home-line m-0"></i>
                                        </li>

                                        <li class="bg-success-light rounded-circle iq-card-icon-small"><i class="ri-phone-line m-0"></i></li>
                                    </ul>
                                    <div class="pt-3 border-top">
                                        <a href="mailto:<?php echo $staff['userid'] ?>" class="btn btn-primary"><i class="ri-mail-open-line"></i></li>Email</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </a>

            <?php } ?>
        <?php } else { ?>
            <?php
                    $sql = mysqli_query($con, "select * from p_staff_dir where access_level='5' order by first_name asc limit 2000") or die(mysqli_error());
                    while ($staff = mysqli_fetch_array($sql)) {
            ?>
                <div class="panel panel-default profile-card profile-branch">
                    <div class="panel-heading _theme-staff"><?php echo $staff['full_name'] ?></div>
                    <div class="panel-body">
                        <div class="pull-right"><?php echo staff_img("$staff[id]", "80px"); ?></div>
                        <p><i class="glyphicon glyphicon-user"></i><span class="small_id_icon">ID#
                                <?php echo $staff['id'] ?>
                                — </span><span class="small_level_icon"><?php echo "$global_permission->guardian_short_name";
                                                                        echo $staff['branch'] ?></span>
                        </p>
                        <p><i class="glyphicon glyphicon-home"></i><?php echo $staff['address'] ?></p>
                        <p><i class="glyphicon glyphicon-earphone"></i>Call:
                            <?php echo $staff['contact'] ?></p>
                        <p><i class="glyphicon glyphicon-facetime-video"></i>Chat:
                            <?php echo $staff['skype'] ?>
                        </p>
                    </div>
                </div>

            <?php } ?>
            <hr />
            <h4 class="profile-ranks"><?php echo access_level2rank(4); ?>(s)</h4>
            <?php
                    $sql = mysqli_query($con, "select * from p_staff_dir where access_level='4' order by first_name asc limit 2000") or die(mysqli_error());
                    while ($staff = mysqli_fetch_array($sql)) {
            ?>
                <div class="panel panel-default profile-card profile-branch">
                    <div class="panel-heading _theme-staff"><?php echo $staff['full_name'] ?></div>
                    <div class="panel-body">
                        <div class="pull-right"><?php echo staff_img("$staff[id]", "80px"); ?></div>
                        <p><i class="glyphicon glyphicon-user"></i><span class="small_id_icon">ID#
                                <?php echo $staff['id'] ?>
                                — </span><span class="small_level_icon"><?php echo "$global_permission->guardian_short_name";
                                                                        echo $staff['branch'] ?></span>
                        </p>
                        <p><i class="glyphicon glyphicon-home"></i><?php echo $staff['address'] ?></p>
                        <p><i class="glyphicon glyphicon-earphone"></i>Call:
                            <?php echo $staff['contact'] ?></p>
                        <p><i class="glyphicon glyphicon-facetime-video"></i>Chat:
                            <?php echo $staff['skype'] ?>
                        </p>
                    </div>
                </div>

            <?php } ?>
            <hr />
            <h4 class="profile-ranks"><?php echo access_level2rank(3); ?>(s)</h4>
            <?php
                    $sql = mysqli_query($con, "select * from p_staff_dir where access_level='3' order by first_name asc limit 2000") or die(mysqli_error());
                    while ($staff = mysqli_fetch_array($sql)) {
            ?>
                <div class="panel panel-default profile-card profile-branch">
                    <div class="panel-heading _theme-staff"><?php echo $staff['full_name'] ?></div>
                    <div class="panel-body">
                        <div class="pull-right"><?php echo staff_img("$staff[id]", "80px"); ?></div>
                        <p><i class="glyphicon glyphicon-user"></i><span class="small_id_icon">ID#
                                <?php echo $staff['id'] ?>
                                — </span><span class="small_level_icon"><?php echo "$global_permission->guardian_short_name";
                                                                        echo $staff['branch'] ?></span>
                        </p>
                        <p><i class="glyphicon glyphicon-home"></i><?php echo $staff['address'] ?></p>
                        <p><i class="glyphicon glyphicon-earphone"></i>Call:
                            <?php echo $staff['contact'] ?></p>
                        <p><i class="glyphicon glyphicon-facetime-video"></i>Chat:
                            <?php echo $staff['skype'] ?>
                        </p>
                    </div>
                </div>

            <?php } ?>

        <?php } ?>
        <div class="details-clear">&nbsp;</div>

        </div>
    </div> <!-- panel panel-default -->
</div> <!-- container -->

<!-- </div> -->

<?php sns_footer(); ?>