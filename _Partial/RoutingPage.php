<?php
    if(empty($_GET['Page'])){
        include "_Page/Dashboard/Dashboard.php";
    }else{
        $Page=$_GET['Page'];
        if($Page=="Akses"){
            include "_Page/Akses/Akses.php";
        }else{
            if($Page=="SettingGeneral"){
                include "_Page/SettingGeneral/SettingGeneral.php";
            }else{
                if($Page=="ApiKey"){
                    include "_Page/ApiKey/ApiKey.php";
                }else{
                    if($Page=="SettingWhatsapp"||$Page=="SettingPayment"||$Page=="SettingEmail"){
                        include "_Page/SettingService/SettingService.php";
                    }else{
                        if($Page=="ApiDoc"){
                            include "_Page/ApiDoc/ApiDoc.php";
                        }else{
                            if($Page=="Sertifikat"){
                                include "_Page/Sertifikat/Sertifikat.php";
                            }else{
                                if($Page=="UnitKerja"){
                                    include "_Page/UnitKerja/UnitKerja.php";
                                }else{
                                    if($Page=="SettingForm"){
                                        include "_Page/SettingForm/SettingForm.php";
                                    }else{
                                        if($Page=="MyProfile"){
                                            include "_Page/MyProfile/MyProfile.php";
                                        }else{
                                            if($Page=="Help"){
                                                include "_Page/Help/Help.php";
                                            }else{
                                                if($Page=="Dukungan"){
                                                    include "_Page/Dukungan/Dukungan.php";
                                                }else{
                                                    if($Page=="Agenda"){
                                                        include "_Page/Agenda/Agenda.php";
                                                    }else{
                                                        if($Page=="Event"){
                                                            include "_Page/Event/Event.php";
                                                        }else{
                                                            if($Page=="ProfilEvent"){
                                                                include "_Page/ProfilEvent/ProfilEvent.php";
                                                            }else{
                                                                if($Page=="Peserta"){
                                                                    include "_Page/Peserta/Peserta.php";
                                                                }else{
                                                                    if($Page=="Error"){
                                                                        include "_Page/Error/Error.php";
                                                                    }else{
                                                                        if($Page=="Inventaris"){
                                                                            include "_Page/Inventaris/Inventaris.php";
                                                                        }else{
                                                                            if($Page=="Barang"){
                                                                                include "_Page/Barang/Barang.php";
                                                                            }else{
                                                                                if($Page=="Transaksi"){
                                                                                    include "_Page/Transaksi/Transaksi.php";
                                                                                }else{
                                                                                    if($Page=="Pembayaran"){
                                                                                        include "_Page/Pembayaran/Pembayaran.php";
                                                                                    }else{
                                                                                        if($Page=="Aktivitas"){
                                                                                            include "_Page/Aktivitas/Aktivitas.php";
                                                                                        }else{
                                                                                            if($Page=="AkunPerkiraan"){
                                                                                                include "_Page/AkunPerkiraan/AkunPerkiraan.php";
                                                                                            }else{
                                                                                                if($Page=="BarangExpired"){
                                                                                                    include "_Page/BarangExpired/BarangExpired.php";
                                                                                                }else{
                                                                                                    if($Page=="WhatsappGateway"){
                                                                                                        include "_Page/WhatsappGateway/WhatsappGateway.php";
                                                                                                    }else{
                                                                                                        if($Page=="Jurnal"){
                                                                                                            include "_Page/Jurnal/Jurnal.php";
                                                                                                        }else{
                                                                                                            if($Page=="BukuBesar"){
                                                                                                                include "_Page/BukuBesar/BukuBesar.php";
                                                                                                            }else{
                                                                                                                if($Page=="NeracaSaldo"){
                                                                                                                    include "_Page/NeracaSaldo/NeracaSaldo.php";
                                                                                                                }else{
                                                                                                                    if($Page=="LabaRugi"){
                                                                                                                        include "_Page/LabaRugi/LabaRugi.php";
                                                                                                                    }else{
                                                                                                                        if($Page=="RekapitulasiTransaksi"){
                                                                                                                            include "_Page/RekapitulasiTransaksi/RekapitulasiTransaksi.php";
                                                                                                                        }else{
                                                                                                                            if($Page=="Komisi"){
                                                                                                                                include "_Page/Komisi/Komisi.php";
                                                                                                                            }else{
                                                                                                                                if($Page=="BagiHasil"){
                                                                                                                                    include "_Page/BagiHasil/BagiHasil.php";
                                                                                                                                }else{
                                                                                                                                    if($Page=="TamplateWa"){
                                                                                                                                        include "_Page/TamplateWa/TamplateWa.php";
                                                                                                                                    }else{
                                                                                                                                        if($Page=="RencanaKirim"){
                                                                                                                                            include "_Page/RencanaKirim/RencanaKirim.php";
                                                                                                                                        }else{
                                                                                                                                            if($Page=="WhatsappChatBox"){
                                                                                                                                                include "_Page/WhatsappChatBox/WhatsappChatBox.php";
                                                                                                                                            }else{
                                                                                                                                                if($Page=="CetakInvoice"){
                                                                                                                                                    include "_Page/CetakInvoice/CetakInvoice.php";
                                                                                                                                                }else{
                                                                                                                                                    if($Page=="SettingForm"){
                                                                                                                                                        include "_Page/SettingForm/SettingForm.php";
                                                                                                                                                    }else{
                                                                                                                                                        if($Page=="CronJob"){
                                                                                                                                                            include "_Page/CronJob/CronJob.php";
                                                                                                                                                        }else{
                                                                                                                                                            if($Page=="Ruangan"){
                                                                                                                                                                include "_Page/Ruangan/Ruangan.php";
                                                                                                                                                            }else{
                                                                                                                                                                if($Page=="Kunjungan"){
                                                                                                                                                                    include "_Page/Kunjungan/Kunjungan.php";
                                                                                                                                                                }else{
                                                                                                                                                                    include "_Page/Dashboard/Dashboard.php";
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
?>