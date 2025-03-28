<?php
    $SessionWaktuDaftarDatetime=$SessionWaktuDaftar;
    $SessionWaktuUpdateDatetime=$SessionWaktuUpdate;
?>
<div class="card mt-5">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3 text-center">
                <img src="assets/img/User/<?php echo "$SessionGambar"; ?>" alt="" width="70%" class="rounded-circle">
            </div>
            <div class="col-md-9">
                <div class="row mt-2"> 
                    <div class="col-md-3"><dt>Nama Lengkap</dt></div>
                    <div class="col-md-9"><?php echo "$SessionNama"; ?></div>
                </div>
                <div class="row mt-2"> 
                    <div class="col-md-3"><dt>Email Akses</dt></div>
                    <div class="col-md-9"><?php echo "$SessionEmail"; ?></div>
                </div>
                <div class="row mt-2"> 
                    <div class="col-md-3"><dt>Kontak Akses</dt></div>
                    <div class="col-md-9"><?php echo "$SessionKontak"; ?></div>
                </div>
                <div class="row mt-2"> 
                    <div class="col-md-3"><dt>Status Akses</dt></div>
                    <div class="col-md-9"><?php echo "$SessionStatus"; ?></div>
                </div>
                <div class="row mt-2"> 
                    <div class="col-md-3"><dt>Level Akses</dt></div>
                    <div class="col-md-9 text-primary"><?php echo "$SessionAkses"; ?></div>
                </div>
                <div class="row mt-2"> 
                    <div class="col-md-3"><dt>Tanggal Daftar</dt></div>
                    <div class="col-md-9"><?php echo "$SessionWaktuDaftarDatetime"; ?></div>
                </div>
                <div class="row mt-2"> 
                    <div class="col-md-3"><dt>Update Terakhir</dt></div>
                    <div class="col-md-9"><?php echo $SessionWaktuUpdateDatetime; ?></div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="card-footer">
        <small class="credit">
            <a href="index.php?Page=MyProfile&Sub=EditProfile&id_akses=<?php echo "$SessionIdAkses"; ?>" class="btn btn-sm btn-success mt-2 mb-2">
                <i class="bi bi-pencil-square"></i> Ubah Akses
            </a>
            <a href="index.php?Page=MyProfile&Sub=ChangePassword&id_akses=<?php echo "$SessionIdAkses"; ?>" class="btn btn-sm btn-success mt-2 mb-2">
                <i class="bi bi-person-check"></i> Ganti Password
            </a>
        </small>
    </div>
</div>