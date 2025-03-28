<?php
    if(empty($_GET['Page'])){
        $PageMenu="";
    }else{
        $PageMenu=$_GET['Page'];
    }
    if(empty($_GET['Sub'])){
        $SubMenu="";
    }else{
        $SubMenu=$_GET['Sub'];
    }
?>
<aside id="sidebar" class="sidebar menu_background">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link <?php if($PageMenu==""){echo "";}else{echo "collapsed";} ?>" href="index.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($PageMenu!=="Akses"){echo "collapsed";} ?>" href="index.php?Page=Akses">
                <i class="bi bi-key"></i>
                <span>Akses</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($PageMenu!=="Event"){echo "collapsed";} ?>" href="index.php?Page=Event">
                <i class="bi bi-calendar"></i>
                <span>Event</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($PageMenu!=="Peserta"){echo "collapsed";} ?>" href="index.php?Page=Peserta">
                <i class="bi bi-people"></i>
                <span>Peserta</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($PageMenu=="SettingGeneral"||$PageMenu=="ApiKey"||$PageMenu=="SettingWhatsapp"||$PageMenu=="SettingPayment"||$PageMenu=="SettingEmail"){echo "";}else{echo "collapsed";} ?>" data-bs-target="#components-nav" data-bs-toggle="collapse" href="javascript:void(0);">
                <i class="bi bi-gear"></i>
                    <span>Pengaturan</span><i class="bi bi-chevron-down ms-auto">
                </i>
            </a>
            <ul id="components-nav" class="nav-content collapse <?php if($PageMenu=="SettingGeneral"||$PageMenu=="ApiKey"||$PageMenu=="SettingWhatsapp"||$PageMenu=="SettingPayment"||$PageMenu=="SettingEmail"){echo "show";} ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="index.php?Page=SettingGeneral" class="<?php if($PageMenu=="SettingGeneral"){echo "active";} ?>">
                        <i class="bi bi-circle"></i><span>Umum</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?Page=ApiKey" class="<?php if($PageMenu=="ApiKey"){echo "active";} ?>">
                        <i class="bi bi-circle"></i><span>Api Key</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?Page=SettingEmail" class="<?php if($PageMenu=="SettingEmail"){echo "active";} ?>">
                        <i class="bi bi-circle"></i><span>Email</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?Page=SettingPayment" class="<?php if($PageMenu=="SettingPayment"){echo "active";} ?>">
                        <i class="bi bi-circle"></i><span>Payment gateway</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($PageMenu=="Aktivitas"){echo "";}else{echo "collapsed";} ?>" data-bs-target="#catatan-aktivitas" data-bs-toggle="collapse" href="javascript:void(0);">
                <i class="bi bi-record-btn"></i><span>Aktivitas</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="catatan-aktivitas" class="nav-content collapse <?php if($PageMenu=="Aktivitas"){echo "show";} ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="index.php?Page=Aktivitas&Sub=AktivitasUmum" class="<?php if($SubMenu=="AktivitasUmum"){echo "active";} ?>">
                    <i class="bi bi-circle"></i><span>Aktivitas Umum</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?Page=Aktivitas&Sub=Email" class="<?php if($SubMenu=="Email"){echo "active";} ?>">
                    <i class="bi bi-circle"></i><span>Email</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?Page=Aktivitas&Sub=Payment" class="<?php if($SubMenu=="Payment"){echo "active";} ?>">
                        <i class="bi bi-circle"></i><span>Payment</span>
                    </a>
                </li>
                <li>
                    <a href="index.php?Page=Aktivitas&Sub=APIs" class="<?php if($SubMenu=="APIs"){echo "active";} ?>">
                    <i class="bi bi-circle"></i><span>APIs</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($PageMenu!=="Sertifikat"){echo "collapsed";} ?>" href="index.php?Page=Sertifikat">
                <i class="bi bi-mortarboard"></i>
                <span>Sertifikat</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($PageMenu!=="Help"){echo "collapsed";} ?>" href="index.php?Page=Help&Sub=HelpData">
                <i class="bi bi-question"></i>
                <span>Bantuan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php if($PageMenu!=="ApiDoc"){echo "collapsed";} ?>" href="index.php?Page=ApiDoc">
                <i class="bi bi-file-code"></i>
                <span>Dokumentasi APIs</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ModalLogout">
                <i class="bi bi-box-arrow-in-left"></i>
                <span>Keluar</span>
            </a>
        </li>
    </ul>
</aside>  
