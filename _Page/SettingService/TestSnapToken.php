<?php
    //koneksi
    include "../../_Config/Connection.php";
    include "../../_Config/SettingPayment.php";
?>
<form action="javascript:void(0);" id="ProsesTestSnapToken">
    <div class="modal-body">
        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Server Key</label>
            </div>
            <div class="col-md-8">
                <input type="text" name="ServerKey" id="ServerKey" class="form-control" required value="<?php echo "$server_key"; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Is Production?</i></label>
            </div>
            <div class="col-md-8">
                <input type="text" readonly name="production" id="production" class="form-control" required value="<?php echo "$production"; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Kode Transaksi</label>
            </div>
            <div class="col-md-8">
                <input type="text" name="kode_transaksi" id="kode_transaksi" class="form-control" required>
                <small class="text-credit">Kode Transaksi Pada Database Lokal</small>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Order ID</label>
            </div>
            <div class="col-md-8">
                <input type="text" name="order_id" id="order_id" class="form-control" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Jumlah Tagihan</i></label>
            </div>
            <div class="col-md-8">
                <input type="text" name="gross_amount" id="gross_amount" class="form-control" required value="100000">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">First Name</label>
            </div>
            <div class="col-md-8">
                <input type="text" name="first_name" id="first_name" class="form-control" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Last Name</i></label>
            </div>
            <div class="col-md-8">
                <input type="text" name="last_name" id="last_name" class="form-control" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Email</label>
            </div>
            <div class="col-md-8">
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">No.HP</i></label>
            </div>
            <div class="col-md-8">
                <input type="text" name="phone" id="phone" class="form-control" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Snap Token</label>
            </div>
            <div class="col-md-8">
                <input type="text" name="snap_token" id="snap_token" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12 pt-3 text-info text-center">
                <span id="NotifikasiSnapToken">
                    <b>Keterangan</b>
                    <p>Pastikan bahwa pengaturan payment gateway sudah benar</p>
                </span>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <button type="submit" class="btn btn-md btn-info btn-block btn-rounded">
                    <i class="bi bi-arrow-repeat"></i> Generate Snap Token
                </button>
            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-md btn-primary btn-block btn-rounded" id="GenerateSnapButton">
                    <i class="bi bi-layers"></i> Snap Button
                </button>
            </div>
        </div>
    </div>
    <div class="modal-footer bg-info">
        <button type="button" class="btn btn-dark btn-rounded" data-bs-dismiss="modal">
            <i class="bi bi-x-circle"></i> Tutup
        </button>
    </div>
</form>