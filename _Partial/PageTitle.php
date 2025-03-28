<?php
    echo '<div class="pagetitle">';
    //Routing Page Title
    if(empty($_GET['Page'])){
        echo '<h1>Dashboard</h1>';
        echo '<nav>';
        echo '  <ol class="breadcrumb">';
        echo '      <li class="breadcrumb-item active">Dashboard</li>';
        echo '  </ol>';
        echo '</nav>';
    }else{
        if($_GET['Page']=="Akses"){
            if(empty($_GET['Sub'])){
                echo '<h1><i class="bi bi-person"></i> Akses</h1>';
                echo '<nav>';
                echo '  <ol class="breadcrumb">';
                echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                echo '      <li class="breadcrumb-item active">Akses</li>';
                echo '  </ol>';
                echo '</nav>';
            }else{
                if($_GET['Sub']=="DetailAkses"){
                    echo '<h1><i class="bi bi-person-badge"></i> Detail Akses</h1>';
                    echo '<nav>';
                    echo '  <ol class="breadcrumb">';
                    echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                    echo '      <li class="breadcrumb-item"><a href="index.php?Page=Akses">Akses</a></li>';
                    echo '      <li class="breadcrumb-item active">Detail Akses</li>';
                    echo '  </ol>';
                    echo '</nav>';
                }else{
                    if($_GET['Sub']=="AturIjinAkses"){
                        echo '<h1><i class="bi bi-person-badge"></i> Atur ijin Akses</h1>';
                        echo '<nav>';
                        echo '  <ol class="breadcrumb">';
                        echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                        echo '      <li class="breadcrumb-item"><a href="index.php?Page=Akses">Akses</a></li>';
                        echo '      <li class="breadcrumb-item active">Atur ijin Akses</li>';
                        echo '  </ol>';
                        echo '</nav>';
                    }
                }
            }
        }else{
            if($_GET['Page']=="SettingGeneral"){
                echo '<h1><i class="bi bi-gear"></i> Pengaturan Umum</h1>';
                echo '<nav>';
                echo '  <ol class="breadcrumb">';
                echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                echo '      <li class="breadcrumb-item active">Pengaturan Umum</li>';
                echo '  </ol>';
                echo '</nav>';
            }else{
                if($_GET['Page']=="ApiKey"){
                    echo '<h1><i class="bi bi-key"></i> Api Key</h1>';
                    echo '<nav>';
                    echo '  <ol class="breadcrumb">';
                    echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                    echo '      <li class="breadcrumb-item active">Api Key</li>';
                    echo '  </ol>';
                    echo '</nav>';
                }else{
                    if($_GET['Page']=="SettingWhatsapp"){
                        echo '<h1><i class="bi bi-whatsapp"></i> Pengaturan Whatsapp</h1>';
                        echo '<nav>';
                        echo '  <ol class="breadcrumb">';
                        echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                        echo '      <li class="breadcrumb-item active">Pengaturan Whatsapp</li>';
                        echo '  </ol>';
                        echo '</nav>';
                    }else{
                        if($_GET['Page']=="SettingPayment"){
                            echo '<h1><i class="bi bi-credit-card-2-back"></i> Pengaturan Payment</h1>';
                            echo '<nav>';
                            echo '  <ol class="breadcrumb">';
                            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                            echo '      <li class="breadcrumb-item active">Pengaturan Payment</li>';
                            echo '  </ol>';
                            echo '</nav>';
                        }else{
                            if($_GET['Page']=="SettingEmail"){
                                echo '<h1><i class="bi bi-envelope"></i> Pengaturan Email</h1>';
                                echo '<nav>';
                                echo '  <ol class="breadcrumb">';
                                echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                echo '      <li class="breadcrumb-item active">Pengaturan Email</li>';
                                echo '  </ol>';
                                echo '</nav>';
                            }else{
                                if($_GET['Page']=="ApiDoc"){
                                    echo '<h1><i class="bi bi-file-code"></i> Dokumentasi API</h1>';
                                    echo '<nav>';
                                    echo '  <ol class="breadcrumb">';
                                    echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                    echo '      <li class="breadcrumb-item active">Dokumentasi API</li>';
                                    echo '  </ol>';
                                    echo '</nav>';
                                }else{
                                    if($_GET['Page']=="Survey"){
                                        if(empty($_GET['Sub'])){
                                            echo '<h1><i class="bi bi-airplane"></i> Survey</h1>';
                                            echo '<nav>';
                                            echo '  <ol class="breadcrumb">';
                                            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                            echo '      <li class="breadcrumb-item active">Survey</li>';
                                            echo '  </ol>';
                                            echo '</nav>';
                                        }else{
                                            $Sub=$_GET['Sub'];
                                            if($Sub=="DetailSurvey"){
                                                echo '<h1><i class="bi bi-airplane"></i> Survey</h1>';
                                                echo '<nav>';
                                                echo '  <ol class="breadcrumb">';
                                                echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                echo '      <li class="breadcrumb-item"><a href="index.php?Page=Survey">Survey</a></li>';
                                                echo '      <li class="breadcrumb-item active">Detail Survey</li>';
                                                echo '  </ol>';
                                                echo '</nav>';
                                            }
                                        }
                                        
                                    }else{
                                        if($_GET['Page']=="UnitKerja"){
                                            if(empty($_GET['Sub'])){
                                                echo '<h1><i class="bi bi-building"></i> Unit Kerja</h1>';
                                                echo '<nav>';
                                                echo '  <ol class="breadcrumb">';
                                                echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                echo '      <li class="breadcrumb-item active">Unit Kerja</li>';
                                                echo '  </ol>';
                                                echo '</nav>';
                                            }else{
                                                if($_GET['Sub']=="DetailUnitKerja"){
                                                    echo '<h1><i class="bi bi-building"></i> Unit Kerja</h1>';
                                                    echo '<nav>';
                                                    echo '  <ol class="breadcrumb">';
                                                    echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                    echo '      <li class="breadcrumb-item"><a href="index.php?Page=UnitKerja">Unit Kerja</a></li>';
                                                    echo '      <li class="breadcrumb-item active">Detail Unit Kerja</li>';
                                                    echo '  </ol>';
                                                    echo '</nav>';
                                                }else{
                                                    
                                                }
                                            }
                                        }else{
                                            if($_GET['Page']=="Medrek"){
                                                if(empty($_GET['Sub'])){
                                                    echo '<h1><i class="bi bi-journal-medical"></i> Master Pasien</h1>';
                                                    echo '<nav>';
                                                    echo '  <ol class="breadcrumb">';
                                                    echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                    echo '      <li class="breadcrumb-item active">Master Pasien</li>';
                                                    echo '  </ol>';
                                                    echo '</nav>';
                                                }else{
                                                    $Sub=$_GET['Sub'];
                                                    if($Sub=="DetailMedrek"){
                                                        echo '<h1><i class="bi bi-journal-medical"></i> Detail Pasien</h1>';
                                                        echo '<nav>';
                                                        echo '  <ol class="breadcrumb">';
                                                        echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                        echo '      <li class="breadcrumb-item"><a href="index.php?Page=Medrek">Master Pasien</a></li>';
                                                        echo '      <li class="breadcrumb-item active">Detail Pasien</li>';
                                                        echo '  </ol>';
                                                        echo '</nav>';
                                                    }
                                                }
                                            }else{
                                                if($_GET['Page']=="MyProfile"){
                                                    echo '<h1><i class="bi bi-person-circle"></i> Profile Saya</h1>';
                                                    echo '<nav>';
                                                    echo '  <ol class="breadcrumb">';
                                                    echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                    echo '      <li class="breadcrumb-item active">Profile Saya</li>';
                                                    echo '  </ol>';
                                                    echo '</nav>';
                                                }else{
                                                    if($_GET['Page']=="Help"){
                                                        echo '<h1><i class="bi bi-person-circle"></i> Bantuan</h1>';
                                                        echo '<nav>';
                                                        echo '  <ol class="breadcrumb">';
                                                        echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                        echo '      <li class="breadcrumb-item active">Bantuan</li>';
                                                        echo '  </ol>';
                                                        echo '</nav>';
                                                    }else{
                                                        if($_GET['Page']=="Dukungan"){
                                                            echo '<h1><i class="bi bi-hammer"></i> Dukungan</h1>';
                                                            echo '<nav>';
                                                            echo '  <ol class="breadcrumb">';
                                                            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                            echo '      <li class="breadcrumb-item active">Dukungan</li>';
                                                            echo '  </ol>';
                                                            echo '</nav>';
                                                        }else{
                                                            if($_GET['Page']=="Agenda"){
                                                                if(empty($_GET['Sub'])){
                                                                    echo '<h1><i class="bi bi-calendar-check"></i> Agenda</h1>';
                                                                    echo '<nav>';
                                                                    echo '  <ol class="breadcrumb">';
                                                                    echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                    echo '      <li class="breadcrumb-item active">Agenda</li>';
                                                                    echo '  </ol>';
                                                                    echo '</nav>';
                                                                }else{
                                                                    $Sub=$_GET['Sub'];
                                                                    if($Sub=="DetailAgenda"){
                                                                        echo '<h1><i class="bi bi-calendar-check"></i> Detail Agenda</h1>';
                                                                        echo '<nav>';
                                                                        echo '  <ol class="breadcrumb">';
                                                                        echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                        echo '      <li class="breadcrumb-item"><a href="index.php?Page=Agenda">Agenda</a></li>';
                                                                        echo '      <li class="breadcrumb-item active">Detail Agenda</li>';
                                                                        echo '  </ol>';
                                                                        echo '</nav>';
                                                                    }
                                                                }
                                                            }else{
                                                                if($_GET['Page']=="Event"){
                                                                    echo '<h1><i class="bi bi-calendar-check"></i> Event & Kegiatan</h1>';
                                                                    echo '<nav>';
                                                                    echo '  <ol class="breadcrumb">';
                                                                    echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                    echo '      <li class="breadcrumb-item active">Event & Kegiatan</li>';
                                                                    echo '  </ol>';
                                                                    echo '</nav>';
                                                                }else{
                                                                    if($_GET['Page']=="ProfilEvent"){
                                                                        echo '<h1><i class="bi bi-calendar"></i> Profil Event</h1>';
                                                                        echo '<nav>';
                                                                        echo '  <ol class="breadcrumb">';
                                                                        echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                        echo '      <li class="breadcrumb-item active"> Profil Event</li>';
                                                                        echo '  </ol>';
                                                                        echo '</nav>';
                                                                    }else{
                                                                        if($_GET['Page']=="Peserta"){
                                                                            echo '<h1><i class="bi bi-people"></i> Peserta</h1>';
                                                                            echo '<nav>';
                                                                            echo '  <ol class="breadcrumb">';
                                                                            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                            echo '      <li class="breadcrumb-item active">Peserta</li>';
                                                                            echo '  </ol>';
                                                                            echo '</nav>';
                                                                        }else{
                                                                            if($_GET['Page']=="Inventaris"){
                                                                                echo '<h1><i class="bi bi-box"></i> Inventaris</h1>';
                                                                                echo '<nav>';
                                                                                echo '  <ol class="breadcrumb">';
                                                                                echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                echo '      <li class="breadcrumb-item active">Inventaris</li>';
                                                                                echo '  </ol>';
                                                                                echo '</nav>';
                                                                            }else{
                                                                                if($_GET['Page']=="Barang"){
                                                                                    echo '<h1><i class="bi bi-box-seam"></i> Barang</h1>';
                                                                                    echo '<nav>';
                                                                                    echo '  <ol class="breadcrumb">';
                                                                                    echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                    echo '      <li class="breadcrumb-item active">Barang</li>';
                                                                                    echo '  </ol>';
                                                                                    echo '</nav>';
                                                                                }else{
                                                                                    if($_GET['Page']=="Transaksi"){
                                                                                        if(empty($_GET['Sub'])){
                                                                                            echo '<h1><i class="bi bi-cart-check"></i> Transaksi</h1>';
                                                                                            echo '<nav>';
                                                                                            echo '  <ol class="breadcrumb">';
                                                                                            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                            echo '      <li class="breadcrumb-item active">Transaksi</li>';
                                                                                            echo '  </ol>';
                                                                                            echo '</nav>';
                                                                                        }else{
                                                                                            $Sub=$_GET['Sub'];
                                                                                            if($Sub=="TambahTransaksi"){
                                                                                                echo '<h1><i class="bi bi-cart-check"></i> Tambah Transaksi</h1>';
                                                                                                echo '<nav>';
                                                                                                echo '  <ol class="breadcrumb">';
                                                                                                echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                echo '      <li class="breadcrumb-item"><a href="index.php?Page=Transaksi">Transaksi</a></li>';
                                                                                                echo '      <li class="breadcrumb-item active">Tambah Transaksi</li>';
                                                                                                echo '  </ol>';
                                                                                                echo '</nav>';
                                                                                            }else{
                                                                                                if($Sub=="DetailTransaksi"){
                                                                                                    echo '<h1><i class="bi bi-cart-check"></i> Detail Transaksi</h1>';
                                                                                                    echo '<nav>';
                                                                                                    echo '  <ol class="breadcrumb">';
                                                                                                    echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                    echo '      <li class="breadcrumb-item"><a href="index.php?Page=Transaksi">Transaksi</a></li>';
                                                                                                    echo '      <li class="breadcrumb-item active">Detail Transaksi</li>';
                                                                                                    echo '  </ol>';
                                                                                                    echo '</nav>';
                                                                                                }else{
                                                                                                    if($Sub=="EditTransaksi"){
                                                                                                        echo '<h1><i class="bi bi-cart-check"></i> Edit Transaksi</h1>';
                                                                                                        echo '<nav>';
                                                                                                        echo '  <ol class="breadcrumb">';
                                                                                                        echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                        echo '      <li class="breadcrumb-item"><a href="index.php?Page=Transaksi">Transaksi</a></li>';
                                                                                                        echo '      <li class="breadcrumb-item active">Edit Transaksi</li>';
                                                                                                        echo '  </ol>';
                                                                                                        echo '</nav>';
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    }else{
                                                                                        if($_GET['Page']=="Pembayaran"){
                                                                                            if(!empty($_GET['Sub'])){
                                                                                                $Sub=$_GET['Sub'];
                                                                                            }else{
                                                                                                $Sub="";
                                                                                            }
                                                                                            if($Sub=="TambahPembayaran"){
                                                                                                echo '<h1><i class="bi bi-cash-coin"></i> Tambah Pembayaran</h1>';
                                                                                                echo '<nav>';
                                                                                                echo '  <ol class="breadcrumb">';
                                                                                                echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                echo '      <li class="breadcrumb-item"><a href="index.php?Page=Pembayaran">Pembayaran</a></li>';
                                                                                                echo '      <li class="breadcrumb-item active">Tambah Pembayaran</li>';
                                                                                                echo '  </ol>';
                                                                                                echo '</nav>';
                                                                                            }else{
                                                                                                echo '<h1><i class="bi bi-cash-coin"></i> Pembayaran</h1>';
                                                                                                echo '<nav>';
                                                                                                echo '  <ol class="breadcrumb">';
                                                                                                echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                echo '      <li class="breadcrumb-item active">Pembayaran</li>';
                                                                                                echo '  </ol>';
                                                                                                echo '</nav>';
                                                                                            }
                                                                                        }else{
                                                                                            if($_GET['Page']=="Aktivitas"){
                                                                                                if(empty($_GET['Sub'])){
                                                                                                    echo '<h1><i class="bi bi-record-btn"></i> Aktivitas Umum</h1>';
                                                                                                    echo '<nav>';
                                                                                                    echo '  <ol class="breadcrumb">';
                                                                                                    echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                    echo '      <li class="breadcrumb-item active">Aktivitas</li>';
                                                                                                    echo '  </ol>';
                                                                                                    echo '</nav>';
                                                                                                }else{
                                                                                                    if($_GET['Sub']=="AktivitasUmum"){
                                                                                                        echo '<h1><i class="bi bi-record-btn"></i> Aktivitas Umum</h1>';
                                                                                                        echo '<nav>';
                                                                                                        echo '  <ol class="breadcrumb">';
                                                                                                        echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                        echo '      <li class="breadcrumb-item active">Aktivitas</li>';
                                                                                                        echo '  </ol>';
                                                                                                        echo '</nav>';
                                                                                                    }else{
                                                                                                        if($_GET['Sub']=="Email"){
                                                                                                            echo '<h1><i class="bi bi-record-btn"></i> Aktivitas Email</h1>';
                                                                                                            echo '<nav>';
                                                                                                            echo '  <ol class="breadcrumb">';
                                                                                                            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                            echo '      <li class="breadcrumb-item active">Aktivitas</li>';
                                                                                                            echo '  </ol>';
                                                                                                            echo '</nav>';
                                                                                                        }else{
                                                                                                            if($_GET['Sub']=="APIs"){
                                                                                                                echo '<h1><i class="bi bi-record-btn"></i> Aktivitas APIs</h1>';
                                                                                                                echo '<nav>';
                                                                                                                echo '  <ol class="breadcrumb">';
                                                                                                                echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                                echo '      <li class="breadcrumb-item active">Aktivitas</li>';
                                                                                                                echo '  </ol>';
                                                                                                                echo '</nav>';
                                                                                                            }else{
                                                                                                                if($_GET['Sub']=="Payment"){
                                                                                                                    echo '<h1><i class="bi bi-record-btn"></i> Aktivitas Pembayaran</h1>';
                                                                                                                    echo '<nav>';
                                                                                                                    echo '  <ol class="breadcrumb">';
                                                                                                                    echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                                    echo '      <li class="breadcrumb-item"><a href="index.php?Page=Aktivitas">Aktivitas</a></li>';
                                                                                                                    echo '      <li class="breadcrumb-item active">Pembayaran</li>';
                                                                                                                    echo '  </ol>';
                                                                                                                    echo '</nav>';
                                                                                                                }else{
                                                                                                                    echo '<h1><i class="bi bi-record-btn"></i> Aktivitas Umum</h1>';
                                                                                                                    echo '<nav>';
                                                                                                                    echo '  <ol class="breadcrumb">';
                                                                                                                    echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                                    echo '      <li class="breadcrumb-item active">Aktivitas</li>';
                                                                                                                    echo '  </ol>';
                                                                                                                    echo '</nav>';
                                                                                                                }
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                            }else{
                                                                                                if($_GET['Page']=="Sertifikat"){
                                                                                                    echo '<h1><i class="bi bi-mortarboard"></i> Sertifikat</h1>';
                                                                                                    echo '<nav>';
                                                                                                    echo '  <ol class="breadcrumb">';
                                                                                                    echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                    echo '      <li class="breadcrumb-item active">Sertifikat</li>';
                                                                                                    echo '  </ol>';
                                                                                                    echo '</nav>';
                                                                                                }else{
                                                                                                    if($_GET['Page']=="BarangExpired"){
                                                                                                        echo '<h1><i class="bi bi-calendar-check"></i> Batch & Expired</h1>';
                                                                                                        echo '<nav>';
                                                                                                        echo '  <ol class="breadcrumb">';
                                                                                                        echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                        echo '      <li class="breadcrumb-item active">Batch & Expired</li>';
                                                                                                        echo '  </ol>';
                                                                                                        echo '</nav>';
                                                                                                    }else{
                                                                                                        if($_GET['Page']=="WhatsappGateway"){
                                                                                                            if($_GET['Sub']=="AkunWa"){
                                                                                                                echo '<h1><i class="bi bi-whatsapp"></i> Akun Whatsapp</h1>';
                                                                                                                echo '<nav>';
                                                                                                                echo '  <ol class="breadcrumb">';
                                                                                                                echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                                echo '      <li class="breadcrumb-item active">Akun Whatsapp</li>';
                                                                                                                echo '  </ol>';
                                                                                                                echo '</nav>';
                                                                                                            }else{
                                                                                                                echo '<h1><i class="bi bi-whatsapp"></i> Whatsapp Gateway</h1>';
                                                                                                                echo '<nav>';
                                                                                                                echo '  <ol class="breadcrumb">';
                                                                                                                echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                                echo '      <li class="breadcrumb-item active">Whatsapp Gateway</li>';
                                                                                                                echo '  </ol>';
                                                                                                                echo '</nav>';
                                                                                                            }
                                                                                                        }else{
                                                                                                            if($_GET['Page']=="Jurnal"){
                                                                                                                echo '<h1><i class="bi bi-file-ruled"></i> Jurnal</h1>';
                                                                                                                echo '<nav>';
                                                                                                                echo '  <ol class="breadcrumb">';
                                                                                                                echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                                echo '      <li class="breadcrumb-item active">Jurnal</li>';
                                                                                                                echo '  </ol>';
                                                                                                                echo '</nav>';
                                                                                                            }else{
                                                                                                                if($_GET['Page']=="BukuBesar"){
                                                                                                                    echo '<h1><i class="bi bi-file-ruled"></i> Buku Besar</h1>';
                                                                                                                    echo '<nav>';
                                                                                                                    echo '  <ol class="breadcrumb">';
                                                                                                                    echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                                    echo '      <li class="breadcrumb-item active">Buku Besar</li>';
                                                                                                                    echo '  </ol>';
                                                                                                                    echo '</nav>';
                                                                                                                }else{
                                                                                                                    if($_GET['Page']=="NeracaSaldo"){
                                                                                                                        echo '<h1><i class="bi bi-list"></i> Neraca Saldo</h1>';
                                                                                                                        echo '<nav>';
                                                                                                                        echo '  <ol class="breadcrumb">';
                                                                                                                        echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                                        echo '      <li class="breadcrumb-item active">Neraca Saldo</li>';
                                                                                                                        echo '  </ol>';
                                                                                                                        echo '</nav>';
                                                                                                                    }else{
                                                                                                                        if($_GET['Page']=="LabaRugi"){
                                                                                                                            echo '<h1><i class="bi bi-bxs-coin"></i> Laba-Rugi</h1>';
                                                                                                                            echo '<nav>';
                                                                                                                            echo '  <ol class="breadcrumb">';
                                                                                                                            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                                            echo '      <li class="breadcrumb-item active">Laba Rugi</li>';
                                                                                                                            echo '  </ol>';
                                                                                                                            echo '</nav>';
                                                                                                                        }else{
                                                                                                                            if($_GET['Page']=="RekapitulasiTransaksi"){
                                                                                                                                echo '<h1><i class="bi bi-coin"></i> Rekapitulasi Transaksi</h1>';
                                                                                                                                echo '<nav>';
                                                                                                                                echo '  <ol class="breadcrumb">';
                                                                                                                                echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                                                echo '      <li class="breadcrumb-item active">Rekapitulasi Transaksi</li>';
                                                                                                                                echo '  </ol>';
                                                                                                                                echo '</nav>';
                                                                                                                            }else{
                                                                                                                                if($_GET['Page']=="BagiHasil"){
                                                                                                                                    echo '<h1><i class="bi bi-coin"></i> Bagi Hasil</h1>';
                                                                                                                                    echo '<nav>';
                                                                                                                                    echo '  <ol class="breadcrumb">';
                                                                                                                                    echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                                                    echo '      <li class="breadcrumb-item active">Bagi Hasil</li>';
                                                                                                                                    echo '  </ol>';
                                                                                                                                    echo '</nav>';
                                                                                                                                }else{
                                                                                                                                    if($_GET['Page']=="Komisi"){
                                                                                                                                        echo '<h1><i class="bi bi-coin"></i> Komisi</h1>';
                                                                                                                                        echo '<nav>';
                                                                                                                                        echo '  <ol class="breadcrumb">';
                                                                                                                                        echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                                                        echo '      <li class="breadcrumb-item active">Komisi</li>';
                                                                                                                                        echo '  </ol>';
                                                                                                                                        echo '</nav>';
                                                                                                                                    }else{
                                                                                                                                        if($_GET['Page']=="TamplateWa"){
                                                                                                                                            echo '<h1><i class="bi bi-whatsapp"></i> Tamplate Whatsapp</h1>';
                                                                                                                                            echo '<nav>';
                                                                                                                                            echo '  <ol class="breadcrumb">';
                                                                                                                                            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                                                            echo '      <li class="breadcrumb-item active">Tamplate Whatsapp</li>';
                                                                                                                                            echo '  </ol>';
                                                                                                                                            echo '</nav>';
                                                                                                                                        }else{
                                                                                                                                            if($_GET['Page']=="RencanaKirim"){
                                                                                                                                                echo '<h1><i class="bi bi-calendar-check"></i> Rencana Kirim Pesan</h1>';
                                                                                                                                                echo '<nav>';
                                                                                                                                                echo '  <ol class="breadcrumb">';
                                                                                                                                                echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                                                                echo '      <li class="breadcrumb-item active">Rencana Kirim Pesan</li>';
                                                                                                                                                echo '  </ol>';
                                                                                                                                                echo '</nav>';
                                                                                                                                            }else{
                                                                                                                                                if($_GET['Page']=="WhatsappChatBox"){
                                                                                                                                                    echo '<h1><i class="bi bi-envelope"></i> Chat Box</h1>';
                                                                                                                                                    echo '<nav>';
                                                                                                                                                    echo '  <ol class="breadcrumb">';
                                                                                                                                                    echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                                                                    echo '      <li class="breadcrumb-item active">Chat Box</li>';
                                                                                                                                                    echo '  </ol>';
                                                                                                                                                    echo '</nav>';
                                                                                                                                                }else{
                                                                                                                                                    if($_GET['Page']=="Error"){
                                                                                                                                                        echo '<h1><i class="bi bi-emoji-angry"></i> Error</h1>';
                                                                                                                                                        echo '<nav>';
                                                                                                                                                        echo '  <ol class="breadcrumb">';
                                                                                                                                                        echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                                                                        echo '      <li class="breadcrumb-item active">Error</li>';
                                                                                                                                                        echo '  </ol>';
                                                                                                                                                        echo '</nav>';
                                                                                                                                                    }else{
                                                                                                                                                        if($_GET['Page']=="SettingForm"){
                                                                                                                                                            echo '<h1><i class="bi bi-window-desktop"></i> Tamplate</h1>';
                                                                                                                                                            echo '<nav>';
                                                                                                                                                            echo '  <ol class="breadcrumb">';
                                                                                                                                                            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                                                                            echo '      <li class="breadcrumb-item active">Tamplate</li>';
                                                                                                                                                            echo '  </ol>';
                                                                                                                                                            echo '</nav>';
                                                                                                                                                        }else{
                                                                                                                                                            if($_GET['Page']=="NeracaSaldo"){
                                                                                                                                                                echo '<h1><i class="bi bi-list-check"></i> Neraca Saldo</h1>';
                                                                                                                                                                echo '<nav>';
                                                                                                                                                                echo '  <ol class="breadcrumb">';
                                                                                                                                                                echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                                                                                echo '      <li class="breadcrumb-item active">Neraca Saldo</li>';
                                                                                                                                                                echo '  </ol>';
                                                                                                                                                                echo '</nav>';
                                                                                                                                                            }else{
                                                                                                                                                                if($_GET['Page']=="CronJob"){
                                                                                                                                                                    echo '<h1><i class="bi bi-arrow-repeat"></i> Cron Job</h1>';
                                                                                                                                                                    echo '<nav>';
                                                                                                                                                                    echo '  <ol class="breadcrumb">';
                                                                                                                                                                    echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                                                                                    echo '      <li class="breadcrumb-item active">Cron Job</li>';
                                                                                                                                                                    echo '  </ol>';
                                                                                                                                                                    echo '</nav>';
                                                                                                                                                                }else{
                                                                                                                                                                    if($_GET['Page']=="Ruangan"){
                                                                                                                                                                        if(empty($_GET['Sub'])){
                                                                                                                                                                            echo '<h1><i class="bi bi-bank"></i> Ruangan</h1>';
                                                                                                                                                                            echo '<nav>';
                                                                                                                                                                            echo '  <ol class="breadcrumb">';
                                                                                                                                                                            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                                                                                            echo '      <li class="breadcrumb-item active">Ruangan</li>';
                                                                                                                                                                            echo '  </ol>';
                                                                                                                                                                            echo '</nav>';
                                                                                                                                                                        }else{
                                                                                                                                                                            if($_GET['Sub']=="DetailRuangan"){
                                                                                                                                                                                echo '<h1><i class="bi bi-bank"></i> Ruangan</h1>';
                                                                                                                                                                                echo '<nav>';
                                                                                                                                                                                echo '  <ol class="breadcrumb">';
                                                                                                                                                                                echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                                                                                                echo '      <li class="breadcrumb-item"><a href="index.php?Page=Ruangan">Ruangan</a></li>';
                                                                                                                                                                                echo '      <li class="breadcrumb-item active">Detail Ruangan</li>';
                                                                                                                                                                                echo '  </ol>';
                                                                                                                                                                                echo '</nav>';
                                                                                                                                                                            }else{
                                                                                                                                                                                echo '<h1><i class="bi bi-bank"></i> Ruangan</h1>';
                                                                                                                                                                                echo '<nav>';
                                                                                                                                                                                echo '  <ol class="breadcrumb">';
                                                                                                                                                                                echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                                                                                                echo '      <li class="breadcrumb-item active">Ruangan</li>';
                                                                                                                                                                                echo '  </ol>';
                                                                                                                                                                                echo '</nav>';
                                                                                                                                                                            }
                                                                                                                                                                        }
                                                                                                                                                                    }else{
                                                                                                                                                                        if($_GET['Page']=="Kunjungan"){
                                                                                                                                                                            echo '<h1><i class="bi bi-person-bounding-box"></i> Kunjungan</h1>';
                                                                                                                                                                            echo '<nav>';
                                                                                                                                                                            echo '  <ol class="breadcrumb">';
                                                                                                                                                                            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                                                                                            echo '      <li class="breadcrumb-item active">Kunjungan</li>';
                                                                                                                                                                            echo '  </ol>';
                                                                                                                                                                            echo '</nav>';
                                                                                                                                                                        }else{
                                                                                                                                                                            echo '<h1><i class="bi bi-emoji-angry"></i> Error</h1>';
                                                                                                                                                                            echo '<nav>';
                                                                                                                                                                            echo '  <ol class="breadcrumb">';
                                                                                                                                                                            echo '      <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>';
                                                                                                                                                                            echo '      <li class="breadcrumb-item active">Error</li>';
                                                                                                                                                                            echo '  </ol>';
                                                                                                                                                                            echo '</nav>';
                                                                                                                                                                        }
                                                                                                                                                                    }
                                                                                                                                                                }
                                                                                                                                                            }
                                                                                                                                                        }
                                                                                                                                                    }
                                                                                                                                                }
                                                                                                                                            }
                                                                                                                                        }
                                                                                                                                    }
                                                                                                                                }
                                                                                                                            }
                                                                                                                        }
                                                                                                                    }
                                                                                                                }
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    echo '</div>';
?>
