<div class="modal fade" id="ModalTambahGroupSetting" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesTambahGroupSetting">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-gear"></i> Tambah Group Setting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="PutIdEventSetting">
                        <!-- Menampilkan ID dan Nama Event -->
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="group_name">Nama Setting Group</label>
                            <input type="text" id="group_name" name="group_name" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="text_align">Text Align</label>
                            <select name="text_align" id="text_align" class="form-control">
                                <option value="">Pilih</option>
                                <option value="left">Left</option>
                                <option value="right">Right</option>
                                <option value="center">Center</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="line_height">Line Height</label>
                            <input type="text" id="line_height" name="line_height" class="form-control">
                            <small>Ex: 175mm</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="margin_left">Margin Left</label>
                            <input type="text" id="margin_left" name="margin_left" class="form-control">
                            <small>Ex: 187px</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="font_name">Font Name</label>
                            <select name="font_name" id="font_name" class="form-control">
                                <option value="">Pilih</option>
                                <option value="dejavusanscondensed">dejavusanscondensed</option>
                                <option value="dejavusans">dejavusans</option>
                                <option value="dejavuserif">dejavuserif</option>
                                <option value="dejavusansmono">dejavusansmono</option>
                                <option value="freesans">freesans</option>
                                <option value="charm">charm</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="font_size">Font Size</label>
                            <input type="text" id="font_size" name="font_size" class="form-control">
                            <small>Ex: 52.5pt</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="font_color">Font Color</label>
                            <input type="text" id="font_color" name="font_color" class="form-control">
                            <small>Ex: #155B39</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="img_bg">Background Image</label>
                            <input type="file" id="img_bg" name="img_bg" class="form-control">
                            <small>Image Size: 1123 x 794 px</small>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12" id="NotifikasiTambahGroupSetting">
                            <small class="text-primary">Pastikan pengaturan sertifikat yang anda buat sudah benar</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalEditGroupSetting" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesEditGroupSetting">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-gear"></i> Edit Group Setting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="FormEditGroupSetting">
                        <!-- Menampilkan Form Edit Group Setting -->
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12" id="NotifikasiEditGroupSetting">
                            <small class="text-primary">Pastikan pengaturan sertifikat yang anda buat sudah benar</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalHapusGroupSetting" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesHapusGroupSetting">
                <input type="hidden" id="PutIdSettingSertifikatForDelete" name="id_setting_sertifikat">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">
                        <i class="bi bi-trash"></i> Hapus Group Setting
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <img src="assets/img/question.gif" alt="Konfirmasi Hapus" width="80%">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center" id="NotifikasiHapusGroupSetting">
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success btn-rounded">
                        <i class="bi bi-check"></i> Ya, Hapus
                    </button>
                    <button type="button" class="btn btn-sm btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalSettingSertifikat" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesSimpanSettingSertifikat">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-light"><i class="bi bi-gear"></i> Setting Sertifikat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="FormSettingSertifikat">
                    
                </div>
                <div class="modal-footer bg-primary">
                    <button type="submit" class="btn btn-success btn-rounded">
                        <i class="bi bi-sace"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalTambahSponsor" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesTambahSponsor">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-plus"></i> Tambah Sponsor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="FormTambahSponsor">
                        <!-- Menampilkan ID dan Nama Event -->
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12" id="NotifikasiTambahSponsor">
                            <small class="text-primary">Pastikan informasi sponsor & partisipan yang anda buat sudah benar</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalEditSponsor" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesEditSponsor">
                <div class="modal-header">
                    <h5 class="modal-title text-dark"><i class="bi bi-pencil"></i> Edit Sponsor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="FormEditSponsor">
                        <!-- Menampilkan Form Edit Sponsor -->
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12" id="NotifikasiEditSponsor">
                            <small class="text-primary">Pastikan informasi sponsor & partisipan yang anda buat sudah benar</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-rounded">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalHapusSponsor" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form action="javascript:void(0);" id="ProsesHapusSponsor">
                <input type="hidden" id="PutIdEventSertifikatForDelete" name="id_event_sertifikat">
                <div class="modal-header">
                    <h5 class="modal-title text-dark">
                        <i class="bi bi-trash"></i> Hapus Sertifikat Sponsor
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <img src="assets/img/question.gif" alt="Konfirmasi Hapus" width="80%">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center" id="NotifikasiHapusSponsor">
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success btn-rounded">
                        <i class="bi bi-check"></i> Ya, Hapus
                    </button>
                    <button type="button" class="btn btn-sm btn-dark btn-rounded" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>