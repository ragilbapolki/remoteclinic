<div class="iq-sidebar  sidebar-default ">
    <div class="iq-sidebar-logo d-flex align-items-center m-3">
        <h3> <img src="../theme/new/images/logocobra.png" class="img-fluid image-right" alt=""></h3>

        <div class="iq-menu-bt-sidebar ml-0">
            <i class="las la-bars wrapper-menu"></i>
        </div>
    </div>
    <div class="data-scrollbar" data-scroll="1">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                <li class="<?php echo (basename($_SERVER['PHP_SELF']) == "index.php") ?  "active" : "" ?>"
                    href="../dashboard/">
                    <a href="../dashboard/" class="svg-icon">
                        <svg class="svg-icon" width="25" height="25" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span class="ml-4">Dashboards</span>
                    </a>
                </li>

                <li class=" ">
                    <a href="#patient" class="collapsed" data-toggle="collapse" aria-expanded="false">

                        <i class="fas fa-fw fa-duotone fa-hospital-user"></i><span class="ml-4"> Pasien</span>
                        <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                        <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                    </a>

                    <ul id="patient" class="iq-submenu collapse" data-parent="#patient">
                        <li class="<?php echo (basename($_SERVER['PHP_SELF']) == "register-patient.php") ? "active" : "" ?>"
                            href="../patients/register-patient.php">
                            <a href="../patients/register-patient.php">
                                <i class="las la-minus"></i><span>Pasien Baru</span>
                            </a>
                        </li>
                        <li class="<?php
                                    echo (basename($_SERVER['PHP_SELF']) ==  "index.php") ? "" : "" ?>"
                            href="../patients/">
                            <a href="../patients/">
                                <i class="las la-minus"></i><span>Pasien</span>
                            </a>
                        </li>
                        <li class="<?php echo (basename($_SERVER['PHP_SELF']) == "recent-activity.php") ? "active" : "" ?>"
                            href="../patients/recent-activity.php">
                            <a href="../patients/recent-activity.php">
                                <i class="las la-minus"></i><span>List Aktivitas</span>
                            </a>
                        </li>
                        <li class="<?php echo (basename($_SERVER['PHP_SELF']) == "pending-reports.php") ? "active" : "" ?>"
                            href="../patients/pending-reports.php">
                            <a href="../patients/pending-reports.php">
                                <i class="las la-minus"></i><span>Laporan Tertunda</span>
                            </a>
                        </li>
                    </ul>


                </li>

                <li class=" ">
                    <a href="#clinic" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <i class="fas fa-fw fa-duotone fa-hospital"></i><span class="ml-4">Klinik</span>
                        <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                        <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                    </a>

                    <ul id="clinic" class="iq-submenu collapse" data-parent="#clinic">
                        <li class="<?php echo (basename($_SERVER['PHP_SELF']) == "register.php") ? "active" : "" ?>"
                            href="../clinics/register.php">
                            <a href="../clinics/register.php">
                                <i class="las la-minus"></i><span>Klinik Baru</span>
                            </a>
                        </li>
                        <li class="<?php echo (basename($_SERVER['PHP_SELF']) == "index.php") ? "" : "" ?>"
                            href="../clinics/">
                            <a href="../clinics/">
                                <i class="las la-minus"></i><span>Klinik</span>
                            </a>
                        </li>
                        <li class="<?php echo (basename($_SERVER['PHP_SELF']) == "settings.php") ? "active" : "" ?>"
                            href="../clinics/settings.php">
                            <a href="../clinics/settings.php">
                                <i class="las la-minus"></i><span>Pengaturan Klinik</span>
                            </a>
                        </li>

                    </ul>


                </li>

                <li class=" ">
                    <a href="#staff" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <i class="fa-solid fa-user"></i><span class="ml-4"> Staff</span>
                        <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                        <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                    </a>

                    <ul id="staff" class="iq-submenu collapse" data-parent="#staff">
                        <li class="<?php echo (basename($_SERVER['PHP_SELF']) == "register.php") ? "active" : "" ?>"
                            href="../staff/register.php">
                            <a href="../staff/register.php">
                                <i class="las la-minus"></i><span>Staff Baru</span>
                            </a>
                        </li>
                        <li class="<?php echo (basename($_SERVER['PHP_SELF']) == "index.php") ? "" : "" ?>"
                            href="../staff/">
                            <a href="../staff/">
                                <i class="las la-minus"></i><span>Staff</span>
                            </a>
                        </li>

                    </ul>


                </li>

                <li class=" ">
                    <a href="#medicine" class="collapsed" data-toggle="collapse" aria-expanded="false">

                        <i class="fa-solid fa-capsules"></i><span class="ml-4">Obat</span>
                        <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                        <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                    </a>

                    <ul id="medicine" class="iq-submenu collapse" data-parent="#medicine">
                        <li class="<?php echo (basename($_SERVER['PHP_SELF']) == "new.php") ? "active" : "" ?>"
                            href="../medicines/new.php">
                            <a href="../medicines/new.php">
                                <i class="las la-minus"></i><span>Obat Baru</span>
                            </a>
                        </li>
                        <li class="<?php echo (basename($_SERVER['PHP_SELF']) == "update-stock.php") ? "active" : "" ?>"
                            href="../medicines/update-stock.php">
                            <a href="../medicines/update-stock.php">
                                <i class="las la-minus"></i><span>Update Stock</span>
                            </a>
                        </li>
                        <li class="<?php echo (basename($_SERVER['PHP_SELF']) == "stocks.php") ? "active" : "" ?>"
                            href="../medicines/stocks.php">
                            <a href="../medicines/stocks.php">
                                <i class="las la-minus"></i><span>Local Stock</span>
                            </a>
                        </li>
                        <li class="<?php echo (basename($_SERVER['PHP_SELF']) == "index.php") ? "" : "" ?>"
                            href="../medicines/">
                            <a href="../medicines/">
                                <i class="las la-minus"></i><span>Daftar Obat</span>
                            </a>
                        </li>

                    </ul>


                </li>

                <li class=" ">
                    <a href="#sell" class="collapsed" data-toggle="collapse" aria-expanded="false">

                        <i class="fa-solid fa-tag"></i><span class="ml-4">Sale</span>
                        <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                        <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
                    </a>

                    <ul id="sell" class="iq-submenu collapse" data-parent="#medicine">

                        <li class="">
                            <a href="https://cobradental.co.id">
                                <i class="las la-minus"></i><span>Promo Website</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="https://app.cobradental.co.id:1780/sales-dev">
                                <i class="las la-minus"></i><span>Order Stock</span>
                            </a>
                        </li>
                    </ul>



            </ul>
        </nav>



        <div class="pt-5 pb-2"></div>
    </div>
</div>


</body>

</html>