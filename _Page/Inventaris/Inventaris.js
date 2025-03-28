$('#MenampilkanTabelInventaris').html("Loading...");
$('#MenampilkanTabelInventaris').load("_Page/Inventaris/TabelInventaris.php");
$('#batas').change(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelInventaris').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Inventaris/TabelInventaris.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelInventaris').html(data);
        }
    });
});
$('#ProsesBatas').submit(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelInventaris').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Inventaris/TabelInventaris.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelInventaris').html(data);
        }
    });
});
$('#KeywordBy').change(function(){
    var KeywordBy = $('#KeywordBy').val();
    $('#FormFilterKeyword').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Inventaris/ListFilterKeyword.php',
        data 	    :  {KeywordBy: KeywordBy},
        success     : function(data){
            $('#FormFilterKeyword').html(data);
        }
    });
});
$('#ProsesFilterInventaris').submit(function(){
    var batas = $('#FilterBatas').val();
    var OrderBy = $('#OrderBy').val();
    var ShortBy = $('#ShortBy').val();
    var KeywordBy = $('#KeywordBy').val();
    var FilterKeyword = $('#FilterKeyword').val();
    $('#MenampilkanTabelInventaris').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Inventaris/TabelInventaris.php',
        data 	    :  {batas: batas, OrderBy: OrderBy, ShortBy: ShortBy, KeywordBy: KeywordBy, keyword: FilterKeyword},
        success     : function(data){
            $('#MenampilkanTabelInventaris').html(data);
            $('#ModalFilterInventaris').modal('hide');
        }
    });
});
//Tambah Inventaris
$('#ModalTambahInventaris').on('show.bs.modal', function (e) {
    $('#FormTambahInventaris').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Inventaris/FormTambahInventaris.php',
        success     : function(data){
            $('#FormTambahInventaris').html(data);
            //Proses Tambah Inventaris
            $('#ProsesTambahInventaris').submit(function(){
                $('#NotifikasiTambahInventaris').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesTambahInventaris')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Inventaris/ProsesTambahInventaris.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiTambahInventaris').html(data);
                        var NotifikasiTambahInventarisBerhasil=$('#NotifikasiTambahInventarisBerhasil').html();
                        if(NotifikasiTambahInventarisBerhasil=="Success"){
                            location.reload();
                        }
                    }
                });
            });
        }
    });
});

//Detail Inventaris
$('#ModalDetailInventaris').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    var pecah = GetData.split(",");
    var id_inventaris = pecah[0];
    $('#FormDetailInventaris').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Inventaris/FormDetailInventaris.php',
        data        : {id_inventaris: id_inventaris},
        success     : function(data){
            $('#FormDetailInventaris').html(data);
        }
    });
});
//Edit Inventaris
$('#ModalEditInventaris').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    var pecah = GetData.split(",");
    var id_inventaris = pecah[0];
    var keyword = pecah[1];
    var batas = pecah[2];
    var ShortBy = pecah[3];
    var OrderBy = pecah[4];
    var page = pecah[5];
    var posisi = pecah[6];
    var keyword_by = pecah[7];
    $('#FormEditInventaris').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Inventaris/FormEditInventaris.php',
        data        : {id_inventaris: id_inventaris},
        success     : function(data){
            $('#FormEditInventaris').html(data);
            //Proses Tambah Inventaris
            $('#ProsesEditInventaris').submit(function(){
                $('#NotifikasiEditInventaris').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesEditInventaris')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Inventaris/ProsesEditInventaris.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiEditInventaris').html(data);
                        var NotifikasiEditInventarisBerhasil=$('#NotifikasiEditInventarisBerhasil').html();
                        if(NotifikasiEditInventarisBerhasil=="Success"){
                            $('#MenampilkanTabelInventaris').html("Loading...");
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/Inventaris/TabelInventaris.php',
                                data 	    :  {keyword: keyword, batas: batas, ShortBy: ShortBy, OrderBy: OrderBy, page: page, posisi: posisi, keyword_by: keyword_by},
                                success     : function(data){
                                    $('#MenampilkanTabelInventaris').html(data);
                                    $('#ModalEditInventaris').modal('hide');
                                    swal("Good Job!", "Edit Inventaris Berhasil!", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
//Hapus Inventaris
$('#ModalDeleteInventaris').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    var pecah = GetData.split(",");
    var id_inventaris = pecah[0];
    var keyword = pecah[1];
    var batas = pecah[2];
    var ShortBy = pecah[3];
    var OrderBy = pecah[4];
    var page = pecah[5];
    var posisi = pecah[6];
    var keyword_by = pecah[7];
    $('#FormDeleteInventaris').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Inventaris/FormDeleteInventaris.php',
        data        : {id_inventaris: id_inventaris},
        success     : function(data){
            $('#FormDeleteInventaris').html(data);
            //Konfirmasi Hapus Inventaris
            $('#KonfirmasiHapusInventaris').click(function(){
                $('#NotifikasiHapusInventaris').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Inventaris/ProsesHapusInventaris.php',
                    data        : {id_inventaris: id_inventaris},
                    success     : function(data){
                        $('#NotifikasiHapusInventaris').html(data);
                        var NotifikasiHapusInventarisBerhasil=$('#NotifikasiHapusInventarisBerhasil').html();
                        if(NotifikasiHapusInventarisBerhasil=="Success"){
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/Inventaris/TabelInventaris.php',
                                data 	    :  {keyword: keyword, batas: batas, ShortBy: ShortBy, OrderBy: OrderBy, page: page, posisi: posisi, keyword_by: keyword_by},
                                success     : function(data){
                                    $('#MenampilkanTabelInventaris').html(data);
                                    $('#ModalDeleteInventaris').modal('hide');
                                    swal("Good Job!", "Delete Inventory Success!", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
//Modal Cetak Inventaris
$('#ModalCetakInventaris').on('show.bs.modal', function (e) {
    $('#FormCetakkInventaris').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Inventaris/FormCetakkInventaris.php',
        success     : function(data){
            $('#FormCetakkInventaris').html(data);
        }
    });
});