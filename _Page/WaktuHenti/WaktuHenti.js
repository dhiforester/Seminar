$('#MenampilkanTabelWaktuHenti').html("Loading...");
$('#MenampilkanTabelWaktuHenti').load("_Page/WaktuHenti/TabelWaktuHenti.php");
$('#batas').change(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelWaktuHenti').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WaktuHenti/TabelWaktuHenti.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelWaktuHenti').html(data);
        }
    });
});
$('#ProsesBatas').submit(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelWaktuHenti').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WaktuHenti/TabelWaktuHenti.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelWaktuHenti').html(data);
        }
    });
});
$('#ProsesFilterWaktuHenti').submit(function(){
    var batas = $('#FilterBatas').val();
    var OrderBy = $('#OrderBy').val();
    var ShortBy = $('#ShortBy').val();
    var KeywordBy = $('#KeywordBy').val();
    var FilterKeyword = $('#FilterKeyword').val();
    $('#MenampilkanTabelWaktuHenti').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WaktuHenti/TabelWaktuHenti.php',
        data 	    :  {batas: batas, OrderBy: OrderBy, ShortBy: ShortBy, KeywordBy: KeywordBy, keyword: FilterKeyword},
        success     : function(data){
            $('#MenampilkanTabelWaktuHenti').html(data);
            $('#ModalFilterWaktuHenti').modal('hide');
        }
    });
});
//Tambah Waktu Henti
$('#ModalTambahWaktuHenti').on('show.bs.modal', function (e) {
    $('#FormTambahWaktuHenti').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WaktuHenti/FormTambahWaktuHenti.php',
        success     : function(data){
            $('#FormTambahWaktuHenti').html(data);
            //Proses Tambah WaktuHenti
            $('#ProsesTambahWaktuHenti').submit(function(){
                $('#NotifikasiTambahWaktuHenti').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesTambahWaktuHenti')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/WaktuHenti/ProsesTambahWaktuHenti.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiTambahWaktuHenti').html(data);
                        var NotifikasiTambahWaktuHentiBerhasil=$('#NotifikasiTambahWaktuHentiBerhasil').html();
                        if(NotifikasiTambahWaktuHentiBerhasil=="Success"){
                            location.reload();
                        }
                    }
                });
            });
        }
    });
});
//ModalDetailWaktuHenti
$('#ModalDetailWaktuHenti').on('show.bs.modal', function (e) {
    var id_waktu_henti = $(e.relatedTarget).data('id');
    $('#FormDetailWaktuHenti').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WaktuHenti/FormDetailWaktuHenti.php',
        data        : {id_waktu_henti: id_waktu_henti},
        success     : function(data){
            $('#FormDetailWaktuHenti').html(data);
        }
    });
});
//Edit WaktuHenti
$('#ModalEditWaktuHenti').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    var pecah = GetData.split(",");
    var id_waktu_henti = pecah[0];
    var keyword = pecah[1];
    var batas = pecah[2];
    var ShortBy = pecah[3];
    var OrderBy = pecah[4];
    var page = pecah[5];
    var posisi = pecah[6];
    var keyword_by = pecah[7];
    $('#FormEditWaktuHenti').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WaktuHenti/FormEditWaktuHenti.php',
        data        : {id_waktu_henti: id_waktu_henti},
        success     : function(data){
            $('#FormEditWaktuHenti').html(data);
            //Proses Tambah WaktuHenti
            $('#ProsesEditWaktuHenti').submit(function(){
                $('#NotifikasiEditWaktuHenti').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesEditWaktuHenti')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/WaktuHenti/ProsesEditWaktuHenti.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiEditWaktuHenti').html(data);
                        var NotifikasiEditWaktuHentiBerhasil=$('#NotifikasiEditWaktuHentiBerhasil').html();
                        if(NotifikasiEditWaktuHentiBerhasil=="Success"){
                            $('#MenampilkanTabelWaktuHenti').html("Loading...");
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/WaktuHenti/TabelWaktuHenti.php',
                                data 	    :  {keyword: keyword, batas: batas, ShortBy: ShortBy, OrderBy: OrderBy, page: page, posisi: posisi, keyword_by: keyword_by},
                                success     : function(data){
                                    $('#MenampilkanTabelWaktuHenti').html(data);
                                    $('#ModalEditWaktuHenti').modal('hide');
                                    swal("Good Job!", "Edit Waktu Henti Berhasil!", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
//Hapus WaktuHenti
$('#ModalDeleteWaktuHenti').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    var pecah = GetData.split(",");
    var id_waktu_henti = pecah[0];
    var keyword = pecah[1];
    var batas = pecah[2];
    var ShortBy = pecah[3];
    var OrderBy = pecah[4];
    var page = pecah[5];
    var posisi = pecah[6];
    var keyword_by = pecah[7];
    $('#FormDeleteWaktuHenti').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WaktuHenti/FormDeleteWaktuHenti.php',
        data        : {id_waktu_henti: id_waktu_henti},
        success     : function(data){
            $('#FormDeleteWaktuHenti').html(data);
            //Konfirmasi Hapus WaktuHenti
            $('#KonfirmasiHapusWaktuHenti').click(function(){
                $('#NotifikasiHapusWaktuHenti').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/WaktuHenti/ProsesHapusWaktuHenti.php',
                    data        : {id_waktu_henti: id_waktu_henti},
                    success     : function(data){
                        $('#NotifikasiHapusWaktuHenti').html(data);
                        var NotifikasiHapusWaktuHentiBerhasil=$('#NotifikasiHapusWaktuHentiBerhasil').html();
                        if(NotifikasiHapusWaktuHentiBerhasil=="Success"){
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/WaktuHenti/TabelWaktuHenti.php',
                                data 	    :  {keyword: keyword, batas: batas, ShortBy: ShortBy, OrderBy: OrderBy, page: page, posisi: posisi, keyword_by: keyword_by},
                                success     : function(data){
                                    $('#MenampilkanTabelWaktuHenti').html(data);
                                    $('#ModalDeleteWaktuHenti').modal('hide');
                                    swal("Good Job!", "Delete Access Success!", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
var periode_laporan = $('#periode_laporan').val();

$('#periode_laporan').change(function(){
    var periode_laporan = $('#periode_laporan').val();
    if(periode_laporan=="Tahunan"){
        $('#FormBulan').html("Loading...");
        $('#FormBulan').html('<input type="text" readonly name="tanggal" id="tanggal" class="form-control">');
    }
    if(periode_laporan=="Bulanan"){
        $('#FormBulan').html("Loading..");
        $('#FormBulan').load('_Page/WaktuHenti/FormPeriode.php');
    }
});
//Modal Cetak Waktu Henti
$('#ModalCetakWaktuHenti').on('show.bs.modal', function (e) {
    var bentuk_laporan = $('#bentuk_laporan').val();
    var periode_laporan = $('#periode_laporan').val();
    var tahun = $('#tahun').val();
    var bulan = $('#bulan').val();
    $('#FormCetakWaktuHenti').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WaktuHenti/FormCetakWaktuHenti.php',
        data        : {bentuk_laporan: bentuk_laporan, periode_laporan: periode_laporan, tahun: tahun, bulan: bulan,},
        success     : function(data){
            $('#FormCetakWaktuHenti').html(data);
        }
    });
});