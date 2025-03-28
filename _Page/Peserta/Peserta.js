var ProsesBatas = $('#ProsesBatas').serialize();
$('#MenampilkanTabelPeserta').html('Loading...');
$.ajax({
    type 	    : 'POST',
    url 	    : '_Page/Peserta/TabelPeserta.php',
    data 	    :  ProsesBatas,
    success     : function(data){
        $('#MenampilkanTabelPeserta').html(data);
    }
});
$('#MenampilkanTabelPeserta').load("_Page/Peserta/TabelPeserta.php");
$('#batas').change(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelPeserta').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Peserta/TabelPeserta.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelPeserta').html(data);
        }
    });
});
$('#ProsesBatas').submit(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelPeserta').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Peserta/TabelPeserta.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelPeserta').html(data);
        }
    });
});
$('#ProsesFilterPeserta').submit(function(){
    var batas = $('#FilterBatas').val();
    var OrderBy = $('#OrderBy').val();
    var ShortBy = $('#ShortBy').val();
    var KeywordBy = $('#KeywordBy').val();
    var FilterKeyword = $('#FilterKeyword').val();
    $('#MenampilkanTabelPeserta').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Peserta/TabelPeserta.php',
        data 	    :  {batas: batas, OrderBy: OrderBy, ShortBy: ShortBy, KeywordBy: KeywordBy, keyword: FilterKeyword},
        success     : function(data){
            $('#MenampilkanTabelPeserta').html(data);
            $('#ModalFilterPeserta').modal('hide');
        }
    });
});
//Tambah Peserta
$('#ModalTambahPeserta').on('show.bs.modal', function (e) {
    $('#FormTambahPeserta').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Peserta/FormTambahPeserta.php',
        success     : function(data){
            $('#FormTambahPeserta').html(data);
            //Kondisi saat tampilkan password
            $('.form-check-input').click(function(){
                if($(this).is(':checked')){
                    $('#password1').attr('type','text');
                    $('#password2').attr('type','text');
                }else{
                    $('#password1').attr('type','password');
                    $('#password2').attr('type','password');
                }
            });
            //Kondisi id_event_setting dipilih
            $('#id_event_setting').change(function(){
                var id_event_setting = $('#id_event_setting').val();
                if(id_event_setting!==""){
                    $('#id_event_kategori').html('<option value="">Pilih</option><option value="">Loading...</option>');
                    $.ajax({
                        type 	    : 'POST',
                        url 	    : '_Page/Peserta/OptionListKategoriEvent.php',
                        data        : {id_event_setting: id_event_setting},
                        success     : function(data){
                            $('#id_event_kategori').html(data);
                        }
                    });
                }
            });
            //Proses Tambah Peserta
            $('#ProsesTambahPeserta').submit(function(){
                $('#NotifikasiTambahPeserta').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesTambahPeserta')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Peserta/ProsesTambahPeserta.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiTambahPeserta').html(data);
                        var NotifikasiTambahPesertaBerhasil=$('#NotifikasiTambahPesertaBerhasil').html();
                        if(NotifikasiTambahPesertaBerhasil=="Success"){
                            location.reload();
                        }
                    }
                });
            });
        }
    });
});
//Detail Peserta
$('#ModalDetailPeserta').on('show.bs.modal', function (e) {
    var id_peserta = $(e.relatedTarget).data('id');
    $('#FormDetailPeserta').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Peserta/FormDetailPeserta.php',
        data        : {id_peserta: id_peserta},
        success     : function(data){
            $('#FormDetailPeserta').html(data);
        }
    });
});
//Edit Password
$('#ModalEditPassword').on('show.bs.modal', function (e) {
    var id_peserta = $(e.relatedTarget).data('id');
    $('#FormEditPassword').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Peserta/FormEditPassword.php',
        data        : {id_peserta: id_peserta},
        success     : function(data){
            $('#FormEditPassword').html(data);
            //Kondisi saat tampilkan password
            $('#TampilkanPassword2').click(function(){
                if($(this).is(':checked')){
                    $('#password1_edit').attr('type','text');
                    $('#password2_edit').attr('type','text');
                }else{
                    $('#password1_edit').attr('type','password');
                    $('#password2_edit').attr('type','password');
                }
            });
        }
    });
});
//Proses Edit Peserta
$('#ProsesEditPassword').submit(function(){
    $('#NotifikasiUbahPassword').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditPassword')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Peserta/ProsesEditPassword.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiUbahPassword').html(data);
            var NotifikasiUbahPasswordBerhasil=$('#NotifikasiUbahPasswordBerhasil').html();
            if(NotifikasiUbahPasswordBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Edit Peserta
$('#ModalEditPeserta').on('show.bs.modal', function (e) {
    var id_peserta = $(e.relatedTarget).data('id');
    $('#FormEditPeserta').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Peserta/FormEditPeserta.php',
        data        : {id_peserta: id_peserta},
        success     : function(data){
            $('#FormEditPeserta').html(data);
            //Kondisi id_event_setting dipilih
            $('#id_event_setting').change(function(){
                var id_event_setting = $('#id_event_setting').val();
                if(id_event_setting!==""){
                    $('#id_event_kategori').html('<option value="">Pilih</option><option value="">Loading...</option>');
                    $.ajax({
                        type 	    : 'POST',
                        url 	    : '_Page/Peserta/OptionListKategoriEvent.php',
                        data        : {id_event_setting: id_event_setting},
                        success     : function(data){
                            $('#id_event_kategori').html(data);
                        }
                    });
                }
            });
        }
    });
});
//Proses Tambah Peserta
$('#ProsesEditPeserta').submit(function(){
    $('#NotifikasiEditPeserta').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditPeserta')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Peserta/ProsesEditPeserta.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditPeserta').html(data);
            var NotifikasiEditPesertaBerhasil=$('#NotifikasiEditPesertaBerhasil').html();
            if(NotifikasiEditPesertaBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Update Status Peserta
$('#ModalPembayaranPeserta').on('show.bs.modal', function (e) {
    var id_peserta = $(e.relatedTarget).data('id');
    $('#FormPembayaranPeserta').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Peserta/FormPembayaranPeserta.php',
        data        : {id_peserta: id_peserta},
        success     : function(data){
            $('#FormPembayaranPeserta').html(data);
            //Menerapkan Kode Promo
            $('#TerapkanKupon').click(function(){
                $('#NotifikasiMenerapkanKodePromo').html('<div class="row"><div class="col-md-4"></div><div class="col-md-8">Loading..</div></div>');
                var form = $('#ProsesPembayaranPeserta')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Peserta/ProsesTerapkanKodePromo.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiMenerapkanKodePromo').html(data);
                        var ValidasiDiskon=$('#ValidasiDiskon').val();
                        var NilaiDikon=$('#NilaiDikon').val();
                        var NilaiTagihan=$('#NilaiTagihan').val();
                        if(ValidasiDiskon=="Valid"){
                            $('#diskon').val(NilaiDikon);
                            $('#tagihan').val(NilaiTagihan);
                        }
                    }
                });
            });
        }
    });
});

//Proses Pembayaran Peserta
$('#ProsesPembayaranPeserta').submit(function(){
    $('#NotifikasiPembayaranPeserta').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesPembayaranPeserta')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Peserta/ProsesPembayaranPeserta.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiPembayaranPeserta').html(data);
            var NotifikasiPembayaranPesertaBerhasil=$('#NotifikasiPembayaranPesertaBerhasil').html();
            if(NotifikasiPembayaranPesertaBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Modal Hapus Pembayaran
$('#ModalHapusPembayaran').on('show.bs.modal', function (e) {
    var id_peserta = $(e.relatedTarget).data('id');
    $('#FormHapusPembayaran').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Peserta/FormHapusPembayaran.php',
        data        : {id_peserta: id_peserta},
        success     : function(data){
            $('#FormHapusPembayaran').html(data);
        }
    });
});
//Proses Hapus Pembayaran
$('#ProsesHpuasPembayaran').submit(function(){
    var form = $('#ProsesHpuasPembayaran')[0];
    var data = new FormData(form);
    $('#NotifikasiHapusPembayaran').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Peserta/ProsesHpuasPembayaran.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusPembayaran').html(data);
            var NotifikasiHapusPembayaranBerhasil=$('#NotifikasiHapusPembayaranBerhasil').html();
            if(NotifikasiHapusPembayaranBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Hapus Peserta
$('#ModalDeletePeserta').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    var pecah = GetData.split(",");
    var id_peserta = pecah[0];
    var keyword = pecah[1];
    var batas = pecah[2];
    var ShortBy = pecah[3];
    var OrderBy = pecah[4];
    var page = pecah[5];
    var posisi = pecah[6];
    var keyword_by = pecah[7];
    $('#FormDeletePeserta').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Peserta/FormDeletePeserta.php',
        data        : {id_peserta: id_peserta},
        success     : function(data){
            $('#FormDeletePeserta').html(data);
        }
    });
    //Konfirmasi Hapus Peserta
    $('#ProsesHapusPeserta').submit(function(){
        var form = $('#ProsesHapusPeserta')[0];
        var data = new FormData(form);
        $('#NotifikasiHapusPeserta').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/Peserta/ProsesHapusPeserta.php',
            data 	    :  data,
            cache       : false,
            processData : false,
            contentType : false,
            enctype     : 'multipart/form-data',
            success     : function(data){
                $('#NotifikasiHapusPeserta').html(data);
                var NotifikasiHapusPesertaBerhasil=$('#NotifikasiHapusPesertaBerhasil').html();
                if(NotifikasiHapusPesertaBerhasil=="Success"){
                    $.ajax({
                        type 	    : 'POST',
                        url 	    : '_Page/Peserta/TabelPeserta.php',
                        data 	    :  {keyword: keyword, batas: batas, ShortBy: ShortBy, OrderBy: OrderBy, page: page, posisi: posisi, keyword_by: keyword_by},
                        success     : function(data){
                            $('#MenampilkanTabelPeserta').html(data);
                            $('#ModalDeletePeserta').modal('hide');
                            swal("Good Job!", "Hapus Peserta Berhasil!", "success");
                        }
                    });
                }
            }
        });
    });
});
//Edit Password
$('#ModalTambahKehadiran').on('show.bs.modal', function (e) {
    var id_peserta = $(e.relatedTarget).data('id');
    $('#FormTambahKehadiran').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Peserta/FormTambahKehadiran.php',
        data        : {id_peserta: id_peserta},
        success     : function(data){
            $('#FormTambahKehadiran').html(data);
        }
    });
});
//Tambah Data Kehadiran Peserta
$('#ProsesTambahKehadiran').submit(function(){
    var form = $('#ProsesTambahKehadiran')[0];
    var data = new FormData(form);
    $('#NotifikasiTambahKehadiran').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Peserta/ProsesTambahKehadiran.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahKehadiran').html(data);
            var NotifikasiTambahKehadiranBerhasil=$('#NotifikasiTambahKehadiranBerhasil').html();
            if(NotifikasiTambahKehadiranBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Modal Hapus Kehadiran Peserta
$('#ModalHapusKehadiran').on('show.bs.modal', function (e) {
    var id_event_absen = $(e.relatedTarget).data('id');
    $('#FormHapusKehadiran').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Peserta/FormHapusKehadiran.php',
        data        : {id_event_absen: id_event_absen},
        success     : function(data){
            $('#FormHapusKehadiran').html(data);
        }
    });
});
//Proses Hapus Kehadiran
$('#ProsesHapusKehadiran').submit(function(){
    var form = $('#ProsesHapusKehadiran')[0];
    var data = new FormData(form);
    $('#NotifikasiHapusKehadiran').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Peserta/ProsesHapusKehadiran.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusKehadiran').html(data);
            var NotifikasiHapusKehadiranBerhasil=$('#NotifikasiHapusKehadiranBerhasil').html();
            if(NotifikasiHapusKehadiranBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Modal Hapus Kehadiran Peserta
$('#ModalPaymentGateway').on('show.bs.modal', function (e) {
    var id_event_pembayaran = $(e.relatedTarget).data('id');
    $('#FormPaymentGateway').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Peserta/FormPaymentGateway.php',
        data        : {id_event_pembayaran: id_event_pembayaran},
        success     : function(data){
            $('#FormPaymentGateway').html(data);
        }
    });
});
//Modal Riwayat Pembayaran
$('#ModalRiwayatPembayaran').on('show.bs.modal', function (e) {
    var id_event_pembayaran = $(e.relatedTarget).data('id');
    $('#FormRiwayatPembayaran').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Peserta/FormRiwayatPembayaran.php',
        data        : {id_event_pembayaran: id_event_pembayaran},
        success     : function(data){
            $('#FormRiwayatPembayaran').html(data);
        }
    });
});