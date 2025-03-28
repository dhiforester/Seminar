$('#MenampilkanTabelPartnership').html("Loading...");
$('#MenampilkanTabelPartnership').load("_Page/RencanaKirim/TabelPartnership.php");
$('#batas').change(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelPartnership').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RencanaKirim/TabelPartnership.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelPartnership').html(data);
        }
    });
});
$('#ProsesBatas').submit(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelPartnership').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RencanaKirim/TabelPartnership.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelPartnership').html(data);
        }
    });
});
//Menampilkan tabel rencana kirim by mitra
var IdMitra=$('#GetIdMitra').val();
$('#MenampilkanTabelRencanaKirim').html('Loading...');
$.ajax({
    type 	    : 'POST',
    url 	    : '_Page/RencanaKirim/TabelRencanaKirim.php',
    data 	    :  {GetIdMitra: IdMitra},
    success     : function(data){
        $('#MenampilkanTabelRencanaKirim').html(data);
    }
});
$('#BatasRencanaKirim').change(function(){
    var ProsesBatasRencanaKirim = $('#ProsesBatasRencanaKirim').serialize();
    $('#MenampilkanTabelRencanaKirim').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RencanaKirim/TabelRencanaKirim.php',
        data 	    :  ProsesBatasRencanaKirim,
        success     : function(data){
            $('#MenampilkanTabelRencanaKirim').html(data);
        }
    });
});
$('#ProsesBatasRencanaKirim').submit(function(){
    var ProsesBatasRencanaKirim = $('#ProsesBatasRencanaKirim').serialize();
    $('#MenampilkanTabelRencanaKirim').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RencanaKirim/TabelRencanaKirim.php',
        data 	    :  ProsesBatasRencanaKirim,
        success     : function(data){
            $('#MenampilkanTabelRencanaKirim').html(data);
        }
    });
});
//Menampilkan modal tambah rencana kirim pesan
$('#ModalTambahRencanaKirimPesan').on('show.bs.modal', function (e) {
    var GetIdMitra = $(e.relatedTarget).data('id');
    $('#FormTambahRencanaKirimPesan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RencanaKirim/FormTambahRencanaKirimPesan.php',
        data        : {id_mitra: GetIdMitra},
        success     : function(data){
            $('#FormTambahRencanaKirimPesan').html(data);
            //Proses Tambah Akses
            $('#ProsesTambahRencanaKirimPesan').submit(function(){
                $('#NotifikasiTambahRencanaKirimPesan').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesTambahRencanaKirimPesan')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/RencanaKirim/ProsesTambahRencanaKirimPesan.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiTambahRencanaKirimPesan').html(data);
                        var NotifikasiTambahRencanaKirimPesanBerhasil=$('#NotifikasiTambahRencanaKirimPesanBerhasil').html();
                        if(NotifikasiTambahRencanaKirimPesanBerhasil=="Success"){
                            //Reload halaman
                            location.reload();
                        }
                    }
                });
            });
        }
    });
});
//Modal Konfirmasi Hapus Rencana Kirim
$('#ModalHapusRencanaKirim').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    var pecah = GetData.split(",");
    var id_rencana_kirim = pecah[0];
    var keyword = pecah[1];
    var batas = pecah[2];
    var ShortBy = pecah[3];
    var OrderBy = pecah[4];
    var page = pecah[5];
    var posisi = pecah[6];
    var id_mitra = pecah[7];
    $('#FormHapusRencanaKirimPesan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RencanaKirim/FormHapusRencanaKirimPesan.php',
        data        : {id_rencana_kirim: id_rencana_kirim},
        success     : function(data){
            $('#FormHapusRencanaKirimPesan').html(data);
            //Konfirmasi Hapus rencana kirim pesan
            $('#KonfirmasiHapusRencanaKirimPesan').click(function(){
                $('#NotifikasiHapusRencanaKirimPesan').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/RencanaKirim/ProsesHapusRencanaKirimPesan.php',
                    data        : {id_rencana_kirim: id_rencana_kirim},
                    success     : function(data){
                        $('#NotifikasiHapusRencanaKirimPesan').html(data);
                        var NotifikasiHapusRencanaKirimPesanBerhasil=$('#NotifikasiHapusRencanaKirimPesanBerhasil').html();
                        if(NotifikasiHapusRencanaKirimPesanBerhasil=="Success"){
                            $('#MenampilkanTabelRencanaKirim').html('Loading...');
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/RencanaKirim/TabelRencanaKirim.php',
                                data 	    :  {GetIdMitra: IdMitra, KeywordRencanaKirim: keyword, BatasRencanaKirim: batas, ShortBy: ShortBy, OrderBy: OrderBy, page: page, posisi: posisi},
                                success     : function(data){
                                    $('#MenampilkanTabelRencanaKirim').html(data);
                                    $('#ModalHapusRencanaKirim').modal('hide');
                                    swal("Good Job!", "Hapus Rencana Kirim Pesan Berhasil", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
//Menampilkan modal edit rencana kirim pesan
$('#ModalEditRencanaKirim').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    var pecah = GetData.split(",");
    var id_rencana_kirim = pecah[0];
    var keyword = pecah[1];
    var batas = pecah[2];
    var ShortBy = pecah[3];
    var OrderBy = pecah[4];
    var page = pecah[5];
    var posisi = pecah[6];
    var id_mitra = pecah[7];
    $('#FormEditRencanaKirimPesan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RencanaKirim/FormEditRencanaKirimPesan.php',
        data        : {id_rencana_kirim: id_rencana_kirim},
        success     : function(data){
            $('#FormEditRencanaKirimPesan').html(data);
            //Proses Edit Rencana Kirim Pesan
            $('#ProsesEditRencanaKirim').submit(function(){
                $('#NotifikasiEditRencanaKirimPesan').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesEditRencanaKirim')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/RencanaKirim/ProsesEditRencanaKirim.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiEditRencanaKirimPesan').html(data);
                        var NotifikasiEditRencanaKirimPesanBerhasil=$('#NotifikasiEditRencanaKirimPesanBerhasil').html();
                        if(NotifikasiEditRencanaKirimPesanBerhasil=="Success"){
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/RencanaKirim/TabelRencanaKirim.php',
                                data 	    :  {GetIdMitra: IdMitra, KeywordRencanaKirim: keyword, BatasRencanaKirim: batas, ShortBy: ShortBy, OrderBy: OrderBy, page: page, posisi: posisi},
                                success     : function(data){
                                    $('#MenampilkanTabelRencanaKirim').html(data);
                                    $('#ModalEditRencanaKirim').modal('hide');
                                    swal("Good Job!", "Edit Rencana Kirim Pesan Berhasil", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
