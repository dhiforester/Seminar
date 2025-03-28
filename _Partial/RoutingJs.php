<?php 
    if(empty($_GET['Page'])){
        echo '<script type="text/javascript" src="_Page/Dashboard/Dashboard.js"></script>';
    }else{
        if($_GET['Page']=="Akses"){
            echo '<script type="text/javascript" src="_Page/Akses/Akses.js"></script>';
        }else{
            if($_GET['Page']=="SettingGeneral"){
                echo '<script type="text/javascript" src="_Page/SettingGeneral/SettingGeneral.js"></script>';
            }else{
                if($_GET['Page']=="ApiKey"){
                    echo '<script type="text/javascript" src="_Page/ApiKey/ApiKey.js"></script>';
                }else{
                    if($Page=="SettingWhatsapp"||$Page=="SettingPayment"||$Page=="SettingEmail"){
                        echo '<script type="text/javascript" src="_Page/SettingService/SettingService.js"></script>';
                    }else{
                        if($Page=="ApiDoc"){
                            echo '<script type="text/javascript" src="_Page/ApiDoc/ApiDoc.js"></script>';
                        }else{
                            if($Page=="RegionalData"){
                                echo '<script type="text/javascript" src="_Page/RegionalData/RegionalData.js"></script>';
                            }else{
                                if($Page=="UnitKerja"){
                                    echo '<script type="text/javascript" src="_Page/UnitKerja/UnitKerja.js"></script>';
                                }else{
                                    if($Page=="Medrek"){
                                        echo '<script type="text/javascript" src="_Page/Medrek/Medrek.js"></script>';
                                    }else{
                                        if($Page=="MyProfile"){
                                            echo '<script type="text/javascript" src="_Page/MyProfile/MyProfile.js"></script>';
                                        }else{
                                            if($Page=="Help"){
                                                echo '<script type="text/javascript" src="_Page/Help/Help.js"></script>';
                                            }else{
                                                if($Page=="Dukungan"){
                                                    echo '<script type="text/javascript" src="_Page/Dukungan/Dukungan.js"></script>';
                                                }else{
                                                    if($Page=="Agenda"){
                                                        echo '<script type="text/javascript" src="_Page/Agenda/Agenda.js"></script>';
                                                    }else{
                                                        if($Page=="Event"){
                                                            echo '<script type="text/javascript" src="_Page/Event/Event.js"></script>';
                                                        }else{
                                                            if($Page=="ProfilEvent"){
                                                                echo '<script type="text/javascript" src="_Page/ProfilEvent/ProfilEvent.js"></script>';
                                                            }else{
                                                                if($Page=="Peserta"){
                                                                    echo '<script type="text/javascript" src="_Page/Peserta/Peserta.js"></script>';
                                                                }else{
                                                                    if($Page=="Inventaris"){
                                                                        echo '<script type="text/javascript" src="_Page/Inventaris/Inventaris.js"></script>';
                                                                    }else{
                                                                        if($Page=="Barang"){
                                                                            echo '<script type="text/javascript" src="_Page/Barang/Barang.js"></script>';
                                                                        }else{
                                                                            if($Page=="Sertifikat"){
                                                                                echo '<script type="text/javascript" src="_Page/Sertifikat/Sertifikat.js"></script>';
                                                                            }else{
                                                                                if($Page=="Pembayaran"){
                                                                                    echo '<script type="text/javascript" src="_Page/Pembayaran/Pembayaran.js"></script>';
                                                                                }else{
                                                                                    if($Page=="Aktivitas"){
                                                                                        echo '<script type="text/javascript" src="_Page/Aktivitas/Aktivitas.js"></script>';
                                                                                    }else{
                                                                                        if($Page=="AkunPerkiraan"){
                                                                                            echo '<script type="text/javascript" src="_Page/AkunPerkiraan/AkunPerkiraan.js"></script>';
                                                                                        }else{
                                                                                            if($Page=="BarangExpired"){
                                                                                                echo '<script type="text/javascript" src="_Page/BarangExpired/BarangExpired.js"></script>';
                                                                                            }else{
                                                                                                if($Page=="WhatsappGateway"){
                                                                                                    echo '<script type="text/javascript" src="_Page/WhatsappGateway/WhatsappGateway.js"></script>';
                                                                                                }else{
                                                                                                    if($Page=="Jurnal"){
                                                                                                        echo '<script type="text/javascript" src="_Page/Jurnal/Jurnal.js"></script>';
                                                                                                    }else{
                                                                                                        if($Page=="BukuBesar"){
                                                                                                            echo '<script type="text/javascript" src="_Page/BukuBesar/BukuBesar.js"></script>';
                                                                                                        }else{
                                                                                                            if($Page=="NeracaSaldo"){
                                                                                                                echo '<script type="text/javascript" src="_Page/NeracaSaldo/NeracaSaldo.js"></script>';
                                                                                                            }else{
                                                                                                                if($Page=="LabaRugi"){
                                                                                                                    echo '<script type="text/javascript" src="_Page/LabaRugi/LabaRugi.js"></script>';
                                                                                                                }else{
                                                                                                                    if($Page=="RekapitulasiTransaksi"){
                                                                                                                        echo '<script type="text/javascript" src="_Page/RekapitulasiTransaksi/RekapitulasiTransaksi.js"></script>';
                                                                                                                    }else{
                                                                                                                        if($Page=="Komisi"){
                                                                                                                            echo '<script type="text/javascript" src="_Page/Komisi/Komisi.js"></script>';
                                                                                                                        }else{
                                                                                                                            if($Page=="BagiHasil"){
                                                                                                                                echo '<script type="text/javascript" src="_Page/BagiHasil/BagiHasil.js"></script>';
                                                                                                                            }else{
                                                                                                                                if($Page=="TamplateWa"){
                                                                                                                                    echo '<script type="text/javascript" src="_Page/TamplateWa/TamplateWa.js"></script>';
                                                                                                                                }else{
                                                                                                                                    if($Page=="RencanaKirim"){
                                                                                                                                        echo '<script type="text/javascript" src="_Page/RencanaKirim/RencanaKirim.js"></script>';
                                                                                                                                    }else{
                                                                                                                                        if($Page=="WhatsappChatBox"){
                                                                                                                                            echo '<script type="text/javascript" src="_Page/WhatsappChatBox/WhatsappChatBox.js"></script>';
                                                                                                                                        }else{
                                                                                                                                            if($Page=="SettingForm"){
                                                                                                                                                echo '<script type="text/javascript" src="_Page/SettingForm/SettingForm.js"></script>';
                                                                                                                                            }else{
                                                                                                                                                if($Page=="CronJob"){
                                                                                                                                                    echo '<script type="text/javascript" src="_Page/CronJob/CronJob.js"></script>';
                                                                                                                                                }else{
                                                                                                                                                    if($Page=="Pendaftaran"){
                                                                                                                                                        echo '<script type="text/javascript" src="_Page/Pendaftaran/Pendaftaran.js"></script>';
                                                                                                                                                    }else{
                                                                                                                                                        if($Page=="Ruangan"){
                                                                                                                                                            echo '<script type="text/javascript" src="_Page/Ruangan/Ruangan.js"></script>';
                                                                                                                                                        }else{
                                                                                                                                                            if($Page=="Kunjungan"){
                                                                                                                                                                echo '<script type="text/javascript" src="_Page/Kunjungan/Kunjungan.js"></script>';
                                                                                                                                                            }else{
                                                                                                                                                                echo '<script type="text/javascript" src="_Page/Dashboard/Dashboard.js"></script>';
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
    //default Login
    echo '<script type="text/javascript" src="_Page/Login/Login.js"></script>';
    echo '<script type="text/javascript" src="_Page/Pendaftaran/Pendaftaran.js"></script>';
    echo '<script type="text/javascript" src="_Page/ResetPassword/ResetPassword.js"></script>';
?>