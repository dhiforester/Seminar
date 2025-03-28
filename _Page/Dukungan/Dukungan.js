$('#MenampilkanTabelDukungan').html("Loading...");
$('#MenampilkanTabelDukungan').load("_Page/Dukungan/TabelDukungan.php");
$('#batas').change(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelDukungan').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Dukungan/TabelDukungan.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelDukungan').html(data);
        }
    });
});
$('#ProsesBatas').submit(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelDukungan').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Dukungan/TabelDukungan.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelDukungan').html(data);
        }
    });
});
$('#KeywordBy').change(function(){
    var KeywordBy = $('#KeywordBy').val();
    $('#FormKeywordFilter').html('Loading..');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Dukungan/FormKeywordFilter.php',
        data 	    :  {KeywordBy: KeywordBy},
        success     : function(data){
            $('#FormKeywordFilter').html(data);
        }
    });
});
$('#ProsesFilterDukungan').submit(function(){
    var batas = $('#FilterBatas').val();
    var OrderBy = $('#OrderBy').val();
    var ShortBy = $('#ShortBy').val();
    var KeywordBy = $('#KeywordBy').val();
    var FilterKeyword = $('#FilterKeyword').val();
    $('#MenampilkanTabelDukungan').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Dukungan/TabelDukungan.php',
        data 	    :  {batas: batas, OrderBy: OrderBy, ShortBy: ShortBy, KeywordBy: KeywordBy, keyword: FilterKeyword},
        success     : function(data){
            $('#MenampilkanTabelDukungan').html(data);
            $('#ModalFilterDukungan').modal('hide');
        }
    });
});
//Tambah Dukungan
$('#ModalTambahDukungan').on('show.bs.modal', function (e) {
    $('#FormTambahDukungan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Dukungan/FormTambahDukungan.php',
        success     : function(data){
            $('#FormTambahDukungan').html(data);
            //Proses Tambah Dukungan
            $('#ProsesTambahDukungan').submit(function(){
                $('#NotifikasiTambahDukungan').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesTambahDukungan')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Dukungan/ProsesTambahDukungan.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiTambahDukungan').html(data);
                        var NotifikasiTambahDukunganBerhasil=$('#NotifikasiTambahDukunganBerhasil').html();
                        if(NotifikasiTambahDukunganBerhasil=="Success"){
                            location.reload();
                        }
                    }
                });
            });
        }
    });
});
//Detail Dukungan
$('#ModalDetailDukungan').on('show.bs.modal', function (e) {
    var id_dukungan = $(e.relatedTarget).data('id');
    $('#FormDetailDukungan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Dukungan/FormDetailDukungan.php',
        data        : {id_dukungan: id_dukungan},
        success     : function(data){
            $('#FormDetailDukungan').html(data);
        }
    });
});
var GetIdDukungan = $('#GetIdDukungan').html();
$('#MenampilkanTabelRiwayatDukungan').html('Loading...');
$.ajax({
    type 	    : 'POST',
    url 	    : '_Page/Dukungan/TabelRiwayatDukungan.php',
    data 	    :  {GetIdDukungan: GetIdDukungan},
    success     : function(data){
        $('#MenampilkanTabelRiwayatDukungan').html(data);
    }
});
//Tambah Riwayat Dukungan
$('#ModalTambahRiwayatDukungan').on('show.bs.modal', function (e) {
    var id_dukungan = $(e.relatedTarget).data('id');
    $('#FormTambahRiwayatDukungan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Dukungan/FormTambahRiwayatDukungan.php',
        data        : {id_dukungan: id_dukungan},
        success     : function(data){
            $('#FormTambahRiwayatDukungan').html(data);
            //Proses Tambah Riwayat Kerja
            $('#ProsesTambahRiwayatDukungan').submit(function(){
                $('#NotifikasiSimpanRiwayatKerja').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesTambahRiwayatDukungan')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Dukungan/ProsesTambahRiwayatDukungan.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiSimpanRiwayatKerja').html(data);
                        var NotifikasiSimpanRiwayatKerjaBerhasil=$('#NotifikasiSimpanRiwayatKerjaBerhasil').html();
                        if(NotifikasiSimpanRiwayatKerjaBerhasil=="Success"){
                            location.reload();
                        }
                    }
                });
            });
        }
    });
});
//Detail Riwayat Kerja
$('#ModalDetailRiwayatKerja').on('show.bs.modal', function (e) {
    var id_riwayat_kerja = $(e.relatedTarget).data('id');
    $('#FormDetailRiwayatKerja').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Dukungan/FormDetailRiwayatKerja.php',
        data        : {id_riwayat_kerja: id_riwayat_kerja},
        success     : function(data){
            $('#FormDetailRiwayatKerja').html(data);
        }
    });
});
//Hapus Riwayat Kerja
$('#ModalDeleteRiwayatKerja').on('show.bs.modal', function (e) {
    var id_riwayat_kerja = $(e.relatedTarget).data('id');
    $('#FormDeleteRiwayatKerja').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Dukungan/FormDeleteRiwayatKerja.php',
        data        : {id_riwayat_kerja: id_riwayat_kerja},
        success     : function(data){
            $('#FormDeleteRiwayatKerja').html(data);
            //Konfirmasi Hapus akses
            $('#KonfirmasiHapusRiwayatKerja').click(function(){
                $('#NotifikasiHapusRiwayatKerja').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Dukungan/ProsesHapusRiwayatKerja.php',
                    data        : {id_riwayat_kerja: id_riwayat_kerja},
                    success     : function(data){
                        $('#NotifikasiHapusRiwayatKerja').html(data);
                        var NotifikasiHapusRiwayatKerjaBerhasil=$('#NotifikasiHapusRiwayatKerjaBerhasil').html();
                        if(NotifikasiHapusRiwayatKerjaBerhasil=="Success"){
                            location.reload();
                        }
                    }
                });
            });
        }
    });
});
//Modal Dukungan Selesai
$('#ModalDukunganSelesai').on('show.bs.modal', function (e) {
    $('#FormSelesaiDukungan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Dukungan/FormSelesaiDukungan.php',
        data        : {GetIdDukungan: GetIdDukungan},
        success     : function(data){
            $('#FormSelesaiDukungan').html(data);
            //Konfirmasi Hapus akses
            $('#KonfirmasiDukunganSelesai').click(function(){
                var tanggal=$('#GetTanggal').val();
                var jam=$('#GetJam').val();
                $('#NotifikasiDukunganSelesai').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Dukungan/ProsesKonfirmasiDukunganSelesai.php',
                    data        : {tanggal: tanggal, jam: jam, GetIdDukungan: GetIdDukungan},
                    success     : function(data){
                        $('#NotifikasiDukunganSelesai').html(data);
                        var NotifikasiDukunganSelesaiBerhasil=$('#NotifikasiDukunganSelesaiBerhasil').html();
                        if(NotifikasiDukunganSelesaiBerhasil=="Success"){
                            location.reload();
                        }
                    }
                });
            });
        }
    });
});
//Hapus Riwayat Kerja
$('#ModalDeleteDukungan').on('show.bs.modal', function (e) {
    $('#FormDeleteDukungan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Dukungan/FormDeleteDukungan.php',
        data        : {GetIdDukungan: GetIdDukungan},
        success     : function(data){
            $('#FormDeleteDukungan').html(data);
            //Konfirmasi Hapus dukungan
            $('#KonfirmasiHapusDukungan').click(function(){
                $('#NotifikasiHapusDukungan').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Dukungan/ProsesHapusDukungan.php',
                    data        : {GetIdDukungan: GetIdDukungan},
                    success     : function(data){
                        $('#NotifikasiHapusDukungan').html(data);
                        var NotifikasiHapusDukunganBerhasil=$('#NotifikasiHapusDukunganBerhasil').html();
                        if(NotifikasiHapusDukunganBerhasil=="Success"){
                            window.location.href = "index.php?Page=Dukungan";
                        }
                    }
                });
            });
        }
    });
});
//Edit Dukungan
$('#ModalEditDukungan').on('show.bs.modal', function (e) {
    $('#FormEditDukungan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Dukungan/FormEditDukungan.php',
        data        : {GetIdDukungan: GetIdDukungan},
        success     : function(data){
            $('#FormEditDukungan').html(data);
            //Proses Simpan Edit Dukungan
            $('#ProsesEditDukungan').submit(function(){
                $('#NotifikasiEditDukungan').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesEditDukungan')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Dukungan/ProsesEditDukungan.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiEditDukungan').html(data);
                        var NotifikasiEditDukunganBerhasil=$('#NotifikasiEditDukunganBerhasil').html();
                        if(NotifikasiEditDukunganBerhasil=="Success"){
                            location.reload();
                        }
                    }
                });
            });
        }
    });
});