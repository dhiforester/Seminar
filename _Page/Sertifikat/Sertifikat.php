<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info alert-dismissible fade show" role="alert"> 
                <small>
                    Halaman peserta ini berfungsi untuk mengelola sertifikat peserta berdasarkan penyelenggaraan event. 
                    <ul>
                        <li>
                            <code>Setting</code> digunakan untuk mengatur tampilan cetakan sertifikat.
                        </li>
                        <li>
                            <code>Generate Token</code> digunakan untuk membentuk kode unik masing-masing peserta untuk memperoleh sertifikat.
                        </li>
                    </ul>
                </small>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="bi bi-gear"></i> Group Setting
                    </h4>
                </div>
                <div class="card-body">
                    <form action="javascript:void(0);" id="ProsesGroupList">
                        <div class="row mb-4">
                            <div class="col-md-9 mb-2">
                                <select name="id_event_setting" id="GroupListByEvent" class="form-control">
                                    <option value="">Pilih Event</option>
                                    <?php
                                        //list event
                                        $QryEvent = mysqli_query($Conn, "SELECT*FROM event_setting ORDER BY id_event_setting DESC");
                                        while ($DataEvent = mysqli_fetch_array($QryEvent)) {
                                            $id_event_setting= $DataEvent['id_event_setting'];
                                            $nama_event= $DataEvent['nama_event'];
                                            echo '<option value="'.$id_event_setting.'">'.$nama_event.'</option>';
                                        }
                                    ?>
                                </select>
                                <small>Pilih event terlebih dulu</small>
                            </div>
                            <div class="col-md-3 mb-2">
                                <button type="button" class="btn btn-md btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#ModalTambahGroupSetting">
                                    <i class="bi bi-plus"></i> Group
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12" id="ListGroupSetting">
                            <!-- Menampilkan Data Group Setting -->
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <small class="text text-grayish">
                        Buat group setting sertifikat disini
                    </small>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <i class="bi bi-arrow-clockwise"></i> Generate Sertifikat
                    </h4>
                </div>
                <div class="card-body">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    A. Panitia
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <form action="javascript:void(0);" id="ProsesGenerateTokenPanitia">
                                        <div id="TabelPanitia">
                                            <!-- Menampilkan Tabel Panitia -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo" id="TampilkanJadwalAcara">
                                    B. Pengisi Acara
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <form action="javascript:void(0);" id="ProsesGenerateTokenPengisiAcara">
                                        <div id="TabelPengisiAcara">
                                            <!-- Menampilkan Tabel Pengisi Acara -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree" id="SubPagePanitia">
                                    C. Sponsor & Lainnya
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <form action="javascript:void(0);" id="ProsesGenerateTokenSponsor">
                                        <div id="TabelSponsor">
                                            <!-- Menampilkan Tabel Sponsor -->
                                        </div>
                                    </form>
                                </div>
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
                                    <form action="javascript:void(0);" id="ProsesBatasPeserta">
                                        <input type="hidden" name="id_event_setting" id="PutIdEventSetingForPesertaList" class="form-control">
                                        <div class="row mt-3">
                                            <div class="col-md-3 mb-3">
                                                <select name="BatasPeserta" id="BatasPeserta" class="form-control">
                                                    <option value="5">5</option>
                                                    <option selected value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                                <small>Batas Data</small>
                                            </div>
                                            <div class="col-md-9 mb-3">
                                                <div class="input-group">
                                                    <input type="text" name="KeywordPeserta" id="KeywordPeserta" class="form-control" placeholder="Kata Kunci">
                                                    <button type="submit" class="btn btn-md btn-grayish">
                                                        <i class="bi bi-search"></i> Cari
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <form action="javascript:void(0);" id="ProsesGenerateSertifikat">
                                        <div class="row mb-4" id="TabelPeserta">
                                            <!-- Menampilkan List Peserta -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <small class="text text-grayish">
                        Buat kode unik sertifikat disini
                    </small>
                </div>
            </div>
        </div>
    </div>
</section>