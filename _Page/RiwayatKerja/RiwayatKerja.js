$('#MenampilkanTabelRiwayatKerja').html("Loading...");
$('#MenampilkanTabelRiwayatKerja').load("_Page/RiwayatKerja/TabelRiwayatKerja.php");
$('#batas').change(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelRiwayatKerja').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RiwayatKerja/TabelRiwayatKerja.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelRiwayatKerja').html(data);
        }
    });
});
$('#ProsesBatas').submit(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelRiwayatKerja').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RiwayatKerja/TabelRiwayatKerja.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelRiwayatKerja').html(data);
        }
    });
});
$('#ProsesFilterRiwayatKerja').submit(function(){
    var batas = $('#FilterBatas').val();
    var OrderBy = $('#OrderBy').val();
    var ShortBy = $('#ShortBy').val();
    var KeywordBy = $('#KeywordBy').val();
    var FilterKeyword = $('#FilterKeyword').val();
    $('#MenampilkanTabelRiwayatKerja').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RiwayatKerja/TabelRiwayatKerja.php',
        data 	    :  {batas: batas, OrderBy: OrderBy, ShortBy: ShortBy, keyword_by: KeywordBy, keyword: FilterKeyword},
        success     : function(data){
            $('#MenampilkanTabelRiwayatKerja').html(data);
            $('#ModalFilterRiwayatKerja').modal('hide');
        }
    });
});
$('#KeywordBy').change(function(){
    var KeywordBy = $('#KeywordBy').val();
    $('#FormKeyword').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RiwayatKerja/FormKeyword.php',
        data 	    :  {KeywordBy: KeywordBy},
        success     : function(data){
            $('#FormKeyword').html(data);
        }
    });
});
//Tambah RiwayatKerja
$('#ModalTambahRiwayatKerja').on('show.bs.modal', function (e) {
    $('#FormTambahRiwayatKerja').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/RiwayatKerja/FormTambahRiwayatKerja.php',
        success     : function(data){
            $('#FormTambahRiwayatKerja').html(data);
            //Proses Tambah RiwayatKerja
            $('#ProsesTambahRiwayatKerja').submit(function(){
                $('#NotifikasiTambahRiwayatKerja').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesTambahRiwayatKerja')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/RiwayatKerja/ProsesTambahRiwayatKerja.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiTambahRiwayatKerja').html(data);
                        var NotifikasiTambahRiwayatKerjaBerhasil=$('#NotifikasiTambahRiwayatKerjaBerhasil').html();
                        if(NotifikasiTambahRiwayatKerjaBerhasil=="Success"){
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
                    url 	    : '_Page/RiwayatKerja/ProsesHapusRiwayatKerja.php',
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