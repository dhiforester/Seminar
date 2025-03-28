<section class="section dashboard">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8 mb-2 mt-2">
                            <b class="card-title">Informasi Event</b>
                        </div>
                        <div class="col-md-4 mb-2 mt-2">
                            <a href="index.php?Page=Event" class="btn btn-md btn-dark w-100">
                                <i class="bi bi-arrow-left-circle"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php
                        if(empty($_GET['id_event_setting'])){
                            echo '<div class="row">';
                            echo '  <div class="col col-md-12 text-danger">ID Event Tidak Boleh Kosong</div>';
                            echo '</div>';
                        }else{
                            date_default_timezone_set('Asia/Jakarta');
                            $id_event_setting=$_GET['id_event_setting'];
                            //Buka data event
                            $QryEvent= mysqli_query($Conn,"SELECT * FROM event_setting WHERE id_event_setting='$id_event_setting'")or die(mysqli_error($Conn));
                            $DataEvent= mysqli_fetch_array($QryEvent);
                            $tanggal_mulai= $DataEvent['tanggal_mulai'];
                            $tanggal_selesai= $DataEvent['tanggal_selesai'];
                            $mulai_pendaftaran= $DataEvent['mulai_pendaftaran'];
                            $selesai_pendaftaran= $DataEvent['selesai_pendaftaran'];
                            $nama_event= $DataEvent['nama_event'];
                            $keterangan= $DataEvent['keterangan'];
                            $status= $DataEvent['status'];
                            //Routing Status
                            if($status=="Rencana"){
                                $LabelStatus='<span class="badge badge-danger">Rencana</span>';
                            }else{
                                if($status=="Berlangsung"){
                                    $LabelStatus='<span class="badge badge-warning">Berlangsung</span>';
                                }else{
                                    if($status=="Selesai"){
                                        $LabelStatus='<span class="badge badge-success">Selesai</span>';
                                    }else{
                                        $LabelStatus='<span class="badge badge-dark">None</span>';
                                    }
                                }
                            }
                            //strtotime
                            $strtotime1=strtotime($tanggal_mulai);
                            $strtotime2=strtotime($tanggal_selesai);
                            $strtotime3=strtotime($mulai_pendaftaran);
                            $strtotime4=strtotime($selesai_pendaftaran);
                            //Formated
                            $TanggalMulai=date('d/m/Y H:i T',$strtotime1);
                            $TanggalSelesai=date('d/m/Y H:i T',$strtotime2);
                            $MulaiPendaftaran=date('d/m/Y H:i T',$strtotime3);
                            $SelesaiPendaftaran=date('d/m/Y H:i T',$strtotime4);
                           //Type Event
                            $JumlahKategori = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_kategori WHERE id_event_setting='$id_event_setting'"));
                            if(empty($JumlahKategori)){
                                $LabelJumlahKategori='<span class="badge badge-danger">Belum Ada</span>';
                            }else{
                                $LabelJumlahKategori='<span class="badge badge-success">'.$JumlahKategori.' Record</span>';
                            }
                            //Peserta Event
                            $JumlahPeserta = mysqli_num_rows(mysqli_query($Conn, "SELECT*FROM event_peserta WHERE id_event_setting='$id_event_setting'"));
                            if(empty($JumlahPeserta)){
                                $LabelJumlahPeserta='<span class="badge badge-danger">Belum Ada</span>';
                            }else{
                                $LabelJumlahPeserta='<span class="badge badge-success">'.$JumlahPeserta.' Orang</span>';
                            }
                    ?>
                        <div class="row mb-3"> 
                            <div class="col-md-3"><b>ID.Event</b></div>
                            <div class="col-md-9" id="GetIdEvent"><?php echo "$id_event_setting"; ?></div>
                        </div>
                        <div class="row mb-3"> 
                            <div class="col-md-3"><b>Nama Event</b></div>
                            <div class="col-md-9"><?php echo "$nama_event"; ?></div>
                        </div>
                        <div class="row mb-3"> 
                            <div class="col-md-3"><b>Tanggal Event</b></div>
                            <div class="col-md-9"><small><?php echo "$TanggalMulai - $TanggalSelesai"; ?></small></div>
                        </div>
                        <div class="row mb-3"> 
                            <div class="col-md-3"><b>Pendaftaran</b></div>
                            <div class="col-md-9"><small><?php echo "$MulaiPendaftaran - $SelesaiPendaftaran"; ?></small></div>
                        </div>
                        <div class="row mb-3"> 
                            <div class="col-md-3"><b>Keterangan</b></div>
                            <div class="col-md-9"><small><?php echo "$keterangan"; ?></small></div>
                        </div>
                        <div class="row mb-3"> 
                            <div class="col-md-3"><b>Kategori</b></div>
                            <div class="col-md-9"><?php echo "$LabelJumlahKategori"; ?></div>
                        </div>
                        <div class="row mb-3"> 
                            <div class="col-md-3"><b>Peserta</b></div>
                            <div class="col-md-9"><?php echo "$LabelJumlahPeserta"; ?></div>
                        </div>
                    <?php } ?>
                </div>
                <div class="card-footer text-center">
                    <button type="button" class="btn btn-outline-dark btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalEditEvent" data-id="<?php echo "$id_event_setting"; ?>">
                        <i class="bi bi-pencil-square"></i> Edit Event
                    </button> 
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <b class="card-title">Lampiran Lainnya</b>
                </div>
                <div class="card-body">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    A. Kategori Event
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <button type="button" class="btn btn-sm btn-primary btn-block btn-rounded mb-2 mt-3" data-bs-toggle="modal" data-bs-target="#ModalTambahKategoriEvent" data-id="<?php echo $id_event_setting; ?>">
                                        <i class="bi bi-plus-lg"></i> Tambah Tipe/Kategori
                                    </button>
                                    <div class="list-group">
                                        <?php
                                            $no=1;
                                            //Menampilkan Kategori Event
                                            $query2 = mysqli_query($Conn, "SELECT*FROM event_kategori WHERE id_event_setting='$id_event_setting' ORDER BY  id_event_kategori ASC");
                                            while ($data2= mysqli_fetch_array($query2)) {
                                                $id_event_kategori= $data2['id_event_kategori'];
                                                $kategori= $data2['kategori'];
                                                $KeteranganKategori= $data2['keterangan'];
                                                $harga_tiket= $data2['harga_tiket'];
                                                $kuota= $data2['kuota'];
                                                $format_rupiah = "Rp. " . number_format($harga_tiket, 0, ',', '.');
                                        ?>
                                            <button type="button" class="list-group-item list-group-item-action" data-bs-toggle="modal" data-bs-target="#ModalDetailKategoriEvent" data-id="<?php echo "$id_event_kategori"; ?>">
                                                <?php echo "$no. $kategori"; ?>
                                            </button>
                                        <?php $no++;} ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo" id="TampilkanJadwalAcara">
                                    B. Jadwal Acara
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body" id="ListJadwalAcara">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree" id="SubPagePanitia">
                                    C. Panitia
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse4" aria-expanded="false" aria-controls="flush-collapse4" id="SubPagePeserta">
                                    D. Peserta
                                </button>
                            </h2>
                            <div id="flush-collapse4" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    Placeholder content for this accordion, 
                                    which is intended to demonstrate the 
                                    <code>.accordion-flush</code> 
                                    class. This is the third item's accordion body. 
                                    Nothing more exciting happening here in terms of content,
                                    but just filling up the space to make it look, 
                                    at least at first glance, a bit more representative of how this would look in a real-world application.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse5" aria-expanded="false" aria-controls="flush-collapse5" id="SubPageAbsensi">
                                    E. Absensi/Kehadiran
                                </button>
                            </h2>
                            <div id="flush-collapse5" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    Placeholder content for this accordion, which is intended to demonstrate the 
                                    <code>.accordion-flush</code> class. This is the third item's accordion body. 
                                    Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, 
                                    a bit more representative of how this would look in a real-world application.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse6" aria-expanded="false" aria-controls="flush-collapse6" id="SubPageKuponDiskon">
                                    F. Kupon/Dikon
                                </button>
                            </h2>
                            <div id="flush-collapse6" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse77" aria-expanded="false" aria-controls="flush-collapse77" id="SubPagePembicara">
                                    G. Pengisi Acara
                                </button>
                            </h2>
                            <div id="flush-collapse77" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <!-- Menampilkan halaman subpage pengisi acara -->
                            </div>
                        </div>
                        <!-- <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-heading78">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse78" aria-expanded="false" aria-controls="flush-collapse78" id="SubPageSertifikat">
                                    H. Sertifikat
                                </button>
                            </h2>
                            <div id="flush-collapse78" class="accordion-collapse collapse" aria-labelledby="flush-heading78" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



