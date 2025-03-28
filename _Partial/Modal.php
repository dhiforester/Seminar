<?php
    include "_Page/Logout/ModalLogout.php";
    if(empty($_GET['Page'])){
        $Page="";
    }else{
        $Page=$_GET['Page'];
    }
    if($Page=="Akses"){
        include "_Page/Akses/ModalAkses.php";
    }else{
        if($Page=="SettingGeneral"){
            include "_Page/SettingGeneral/ModalSettingGeneral.php";
        }else{
            if($Page=="ApiKey"){
                include "_Page/ApiKey/ModalApiKey.php";
            }else{
                if($Page=="SettingWhatsapp"||$Page=="SettingPayment"||$Page=="SettingEmail"){
                    include "_Page/SettingService/ModalSettingService.php";
                }else{
                    if($Page=="ApiDoc"){
                        include "_Page/ApiDoc/ModalApiDoc.php";
                    }else{
                        if($Page=="Dukungan"){
                            include "_Page/Dukungan/ModalDukungan.php";
                        }else{
                            if($Page=="UnitKerja"){
                                include "_Page/UnitKerja/ModalUnitKerja.php";
                            }else{
                                if($Page=="Peserta"){
                                    include "_Page/Peserta/ModalPeserta.php";
                                }else{
                                    if($Page=="MyProfile"){
                                        include "_Page/MyProfile/ModalMyProfile.php";
                                    }else{
                                        if($Page=="Help"){
                                            include "_Page/Help/ModalHelp.php";
                                        }else{
                                            if($Page=="Dukungan"){
                                                include "_Page/Dukungan/ModalDukungan.php";
                                            }else{
                                                if($Page=="Agenda"){
                                                    include "_Page/Agenda/ModalAgenda.php";
                                                }else{
                                                    if($Page=="Event"){
                                                        include "_Page/Event/ModalEvent.php";
                                                    }else{
                                                        if($Page=="RiwayatKerja"){
                                                            include "_Page/RiwayatKerja/ModalRiwayatKerja.php";
                                                        }else{
                                                            if($Page=="WaktuHenti"){
                                                                include "_Page/WaktuHenti/ModalWaktuHenti.php";
                                                            }else{
                                                                if($Page=="Inventaris"){
                                                                    include "_Page/Inventaris/ModalInventaris.php";
                                                                }else{
                                                                    if($Page=="Barang"){
                                                                        include "_Page/Barang/ModalBarang.php";
                                                                    }else{
                                                                        if($Page=="Sertifikat"){
                                                                            include "_Page/Sertifikat/ModalSertifikat.php";
                                                                        }else{
                                                                            if($Page=="Pembayaran"){
                                                                                include "_Page/Pembayaran/ModalPembayaran.php";
                                                                            }else{
                                                                                if($Page=="Aktivitas"){
                                                                                    include "_Page/Aktivitas/ModalAktivitas.php";
                                                                                }else{
                                                                                    if($Page=="AkunPerkiraan"){
                                                                                        include "_Page/AkunPerkiraan/ModalAkunPerkiraan.php";
                                                                                    }else{
                                                                                        if($Page=="WhatsappGateway"){
                                                                                            include "_Page/WhatsappGateway/ModalWhatsappGateway.php";
                                                                                        }else{
                                                                                            if($Page=="BarangExpired"){
                                                                                                include "_Page/BarangExpired/ModalBarangExpired.php";
                                                                                            }else{
                                                                                                if($Page=="Jurnal"){
                                                                                                    include "_Page/Jurnal/ModalJurnal.php";
                                                                                                }else{
                                                                                                    if($Page=="BukuBesar"){
                                                                                                        include "_Page/BukuBesar/ModalBukuBesar.php";
                                                                                                    }else{
                                                                                                        if($Page=="NeracaSaldo"){
                                                                                                            include "_Page/NeracaSaldo/ModalNeracaSaldo.php";
                                                                                                        }else{
                                                                                                            if($Page=="LabaRugi"){
                                                                                                                include "_Page/LabaRugi/ModalLabaRugi.php";
                                                                                                            }else{
                                                                                                                if($Page=="RekapitulasiTransaksi"){
                                                                                                                    include "_Page/RekapitulasiTransaksi/ModalRekapitulasiTransaksi.php";
                                                                                                                }else{
                                                                                                                    if($Page=="Komisi"){
                                                                                                                        include "_Page/Komisi/ModalKomisi.php";
                                                                                                                    }else{
                                                                                                                        if($Page=="BagiHasil"){
                                                                                                                            include "_Page/BagiHasil/ModalBagiHasil.php";
                                                                                                                        }else{
                                                                                                                            if($Page=="TamplateWa"){
                                                                                                                                include "_Page/TamplateWa/ModalTamplateWa.php";
                                                                                                                            }else{
                                                                                                                                if($Page=="RencanaKirim"){
                                                                                                                                    include "_Page/RencanaKirim/ModalRencanaKirim.php";
                                                                                                                                }else{
                                                                                                                                    if($Page=="WhatsappChatBox"){
                                                                                                                                        include "_Page/WhatsappChatBox/ModalWhatsappChatBox.php";
                                                                                                                                    }else{
                                                                                                                                        if($Page=="SettingForm"){
                                                                                                                                            include "_Page/SettingForm/ModalSettingForm.php";
                                                                                                                                        }else{
                                                                                                                                            if($Page=="Ruangan"){
                                                                                                                                                include "_Page/Ruangan/ModalRuangan.php";
                                                                                                                                            }else{
                                                                                                                                                if($Page=="Kunjungan"){
                                                                                                                                                    include "_Page/Kunjungan/ModalKunjungan.php";
                                                                                                                                                }else{
                                                                                                                                                    include "_Partial/ModalUniversal.php";
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