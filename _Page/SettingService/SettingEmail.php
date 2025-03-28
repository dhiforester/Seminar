<?php
    include "_Config/SettingEmail.php";
?>
<section class="section dashboard">
    <div class="row">
        <div class="col-lg-12">
            <form action="javascript:void(0);" id="ProsesSettingEmail">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="url_service" class="form-label">URL Email Gateway</i></label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="url_service" id="url_service" class="form-control" required value="<?php echo "$url_service"; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="url_provider" class="form-label">URL Provider SMTP</i></label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="url_provider" id="url_provider" class="form-control" required value="<?php echo "$url_provider"; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="email_gateway" class="form-label">Akun Webmail</i></label>
                            </div>
                            <div class="col-md-9">
                                <input type="email" name="email_gateway" id="email_gateway" class="form-control" required value="<?php echo "$email_gateway"; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="password_gateway" class="form-label">Password Email</i></label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="password_gateway" id="password_gateway" class="form-control" required value="<?php echo "$password_gateway"; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label  for="nama_pengirim" class="form-label">Nama Pengirim</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="nama_pengirim" id="nama_pengirim" class="form-control" required value="<?php echo "$nama_pengirim"; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label  for="port_gateway" class="form-label">PORT SMTP</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" name="port_gateway" id="port_gateway" class="form-control" required value="<?php echo "$port_gateway"; ?>">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label  for="validasi_email" class="form-label">Berlakukan Validasi Email?</label>
                            </div>
                            <div class="col-md-9">
                                <select name="validasi_email" id="validasi_email" class="form-control">
                                    <option <?php if($validasi_email=="Yes"){echo "selected";} ?> value="Yes">Yes</option>
                                    <option <?php if($validasi_email=="No"){echo "selected";} ?> value="No">No</option>
                                </select>
                                <small>
                                    <?php
                                        if($validasi_email=="Yes"){
                                            echo "Dengan validasi email maka setiap pendaftaran yang dilakukan pada service API akan diberlakukan validasi email.";
                                        }
                                    ?>
                                </small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 text-right" id="NotifikasiSimpanSettingEmail">
                                <small class="text-dark">Make sure the setting form is filled in correctly.</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-md btn-primary">
                            <i class="bi bi-save"></i> Save
                        </button>
                        <button type="button" class="btn btn-md btn-info" data-bs-toggle="modal" data-bs-target="#ModalTestSendEmail">
                            <i class="bi bi-send"></i> Test Send Email
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>