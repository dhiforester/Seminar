$('#MenampilkanTabelUnitKerja').html("Loading...2");
$('#MenampilkanTabelUnitKerja').load("_Page/UnitKerja/TabelUnitKerja.php");
$('#batas').change(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelUnitKerja').html('Loading...2');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/UnitKerja/TabelUnitKerja.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelUnitKerja').html(data);
        }
    });
});
$('#ProsesBatas').submit(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelUnitKerja').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/UnitKerja/TabelUnitKerja.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelUnitKerja').html(data);
        }
    });
});
$('#KeywordBy').change(function(){
    var KeywordBy = $('#KeywordBy').val();
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/UnitKerja/ListFilterKeyword.php',
        data 	    :  {KeywordBy: KeywordBy},
        success     : function(data){
            $('#ListFilterKeyword').html(data);
        }
    });
});
$('#ProsesFilterUnitKerja').submit(function(){
    var batas = $('#FilterBatas').val();
    var OrderBy = $('#OrderBy').val();
    var ShortBy = $('#ShortBy').val();
    var KeywordBy = $('#KeywordBy').val();
    var FilterKeyword = $('#FilterKeyword').val();
    $('#MenampilkanTabelUnitKerja').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/UnitKerja/TabelUnitKerja.php',
        data 	    :  {batas: batas, OrderBy: OrderBy, ShortBy: ShortBy, KeywordBy: KeywordBy, keyword: FilterKeyword},
        success     : function(data){
            $('#MenampilkanTabelUnitKerja').html(data);
            $('#ModalFilterUnitKerja').modal('hide');
        }
    });
});
//Tambah UnitKerja
$('#ModalTambahUnitKerja').on('show.bs.modal', function (e) {
    $('#FormTambahUnitKerja').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/UnitKerja/FormTambahUnitKerja.php',
        success     : function(data){
            $('#FormTambahUnitKerja').html(data);
            //Proses Tambah UnitKerja
            $('#ProsesTambahUnitKerja').submit(function(){
                $('#NotifikasiTambahUnitKerja').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesTambahUnitKerja')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/UnitKerja/ProsesTambahUnitKerja.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiTambahUnitKerja').html(data);
                        var NotifikasiTambahUnitKerjaBerhasil=$('#NotifikasiTambahUnitKerjaBerhasil').html();
                        if(NotifikasiTambahUnitKerjaBerhasil=="Success"){
                            location.reload();
                        }
                    }
                });
            });
        }
    });
});
//Detail UnitKerja
$('#ModalDetailUnitKerja').on('show.bs.modal', function (e) {
    var id_unit_kerja= $(e.relatedTarget).data('id');
    $('#FormDetailUnitKerja').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/UnitKerja/FormDetailUnitKerja.php',
        data        : {id_unit_kerja: id_unit_kerja},
        success     : function(data){
            $('#FormDetailUnitKerja').html(data);
        }
    });
});
//Edit UnitKerja
$('#ModalEditUnitKerja').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    var pecah = GetData.split(",");
    var id_unit_kerja = pecah[0];
    var keyword = pecah[1];
    var batas = pecah[2];
    var ShortBy = pecah[3];
    var OrderBy = pecah[4];
    var page = pecah[5];
    var posisi = pecah[6];
    var keyword_by = pecah[7];
    $('#FormEditUnitKerja').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/UnitKerja/FormEditUnitKerja.php',
        data        : {id_unit_kerja: id_unit_kerja},
        success     : function(data){
            $('#FormEditUnitKerja').html(data);
            //Proses Edit UnitKerja
            $('#ProsesEditUnitKerja').submit(function(){
                $('#NotifikasiEditUnitKerja').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesEditUnitKerja')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/UnitKerja/ProsesEditUnitKerja.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiEditUnitKerja').html(data);
                        var NotifikasiEditUnitKerjaBerhasil=$('#NotifikasiEditUnitKerjaBerhasil').html();
                        if(NotifikasiEditUnitKerjaBerhasil=="Success"){
                            $('#MenampilkanTabelUnitKerja').html('Loading...');
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/UnitKerja/TabelUnitKerja.php',
                                data 	    :  {keyword: keyword, batas: batas, ShortBy: ShortBy, OrderBy: OrderBy, page: page, posisi: posisi, keyword_by: keyword_by},
                                success     : function(data){
                                    $('#MenampilkanTabelUnitKerja').html(data);
                                    $('#ModalEditUnitKerja').modal('hide');
                                    swal("Good Job!", "Edit Unit kerja Berhasil!", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
//Hapus UnitKerja
$('#ModalDeleteUnitKerja').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    var pecah = GetData.split(",");
    var id_unit_kerja = pecah[0];
    var keyword = pecah[1];
    var batas = pecah[2];
    var ShortBy = pecah[3];
    var OrderBy = pecah[4];
    var page = pecah[5];
    var posisi = pecah[6];
    var keyword_by = pecah[7];
    $('#FormDeleteUnitKerja').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/UnitKerja/FormDeleteUnitKerja.php',
        data        : {id_unit_kerja: id_unit_kerja},
        success     : function(data){
            $('#FormDeleteUnitKerja').html(data);
            //Konfirmasi Hapus UnitKerja
            $('#KonfirmasiHapusUnitKerja').click(function(){
                $('#NotifikasiHapusUnitKerja').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/UnitKerja/ProsesHapusUnitKerja.php',
                    data        : {id_unit_kerja: id_unit_kerja},
                    success     : function(data){
                        $('#NotifikasiHapusUnitKerja').html(data);
                        var NotifikasiHapusUnitKerjaBerhasil=$('#NotifikasiHapusUnitKerjaBerhasil').html();
                        if(NotifikasiHapusUnitKerjaBerhasil=="Success"){
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/UnitKerja/TabelUnitKerja.php',
                                data 	    :  {keyword: keyword, batas: batas, ShortBy: ShortBy, OrderBy: OrderBy, page: page, posisi: posisi, keyword_by: keyword_by},
                                success     : function(data){
                                    $('#MenampilkanTabelUnitKerja').html(data);
                                    $('#ModalDeleteUnitKerja').modal('hide');
                                    swal("Good Job!", "Hapus Unit Kerja Berhasil!", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
var GetIdUnitKerja = $('#GetIdUnitKerja').html();
$('#MenampilkanTabelAnggotaUnitKerja').html('Loading...');
$.ajax({
    type 	    : 'POST',
    url 	    : '_Page/UnitKerja/TabelAnggotaUnitKerja.php',
    data 	    :  {id_unit_kerja: GetIdUnitKerja},
    success     : function(data){
        $('#MenampilkanTabelAnggotaUnitKerja').html(data);
    }
});
//Tambah Anggota Unit Kerja
$('#ModalTambahAnggotaUnitKerja').on('show.bs.modal', function (e) {
    var pencarian_akses = $('#pencarian_akses').val();
    $('#FormTambahAnggotaUnitKerja').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/UnitKerja/FormTambahAnggotaUnitKerja.php',
        data 	    :  {id_unit_kerja: GetIdUnitKerja, pencarian_akses: pencarian_akses},
        success     : function(data){
            $('#FormTambahAnggotaUnitKerja').html(data);
        }
    });
    $('#MulaiCariAkses').submit(function(){
        $('#FormTambahAnggotaUnitKerja').html("Loading...");
        $.ajax({
            type 	    : 'POST',
            url 	    : '_Page/UnitKerja/FormTambahAnggotaUnitKerja.php',
            data 	    :  {id_unit_kerja: GetIdUnitKerja, pencarian_akses: pencarian_akses},
            success     : function(data){
                $('#FormTambahAnggotaUnitKerja').html(data);
            }
        });
    });
});
//Modal Pilih Anggota Unit Kerja
$('#ModalPilihAnggota').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    var pecah = GetData.split(",");
    var id_akses = pecah[0];
    var id_unit_kerja = pecah[1];
    $('#FormPilihAnggotaUnitKerja').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/UnitKerja/FormPilihAnggotaUnitKerja.php',
        data        : {id_akses: id_akses, id_unit_kerja: id_unit_kerja},
        success     : function(data){
            $('#FormPilihAnggotaUnitKerja').html(data);
            $('#ProsesPilihAnggotaUnitKerja').submit(function(){
                $('#NotifikasiTambahAnggotaUnitKerja').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesPilihAnggotaUnitKerja')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/UnitKerja/ProsesAnggotaTambahUnitKerja.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiTambahAnggotaUnitKerja').html(data);
                        var NotifikasiTambahAnggotaUnitKerjaBerhasil=$('#NotifikasiTambahAnggotaUnitKerjaBerhasil').html();
                        if(NotifikasiTambahAnggotaUnitKerjaBerhasil=="Success"){
                            location.reload();
                        }
                    }
                });
            });
        }
    });
});
//Hapus UnitKerja
$('#ModalDeleteAnggotaUnitKerja').on('show.bs.modal', function (e) {
    var id_unit_kerja_anggota = $(e.relatedTarget).data('id');
    $('#FormDeleteAnggotaUnitKerja').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/UnitKerja/FormDeleteAnggotaUnitKerja.php',
        data        : {id_unit_kerja_anggota: id_unit_kerja_anggota},
        success     : function(data){
            $('#FormDeleteAnggotaUnitKerja').html(data);
            //Konfirmasi Hapus Anggota Unit Kerja
            $('#KonfirmasiHapusAnggota').click(function(){
                $('#NotifikasiHapusAnggotaUnitKerja').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/UnitKerja/ProsesHapusAnggotaUnitKerja.php',
                    data        : {id_unit_kerja_anggota: id_unit_kerja_anggota},
                    success     : function(data){
                        $('#NotifikasiHapusAnggotaUnitKerja').html(data);
                        var NotifikasiHapusAnggotaUnitKerjaBerhasil=$('#NotifikasiHapusAnggotaUnitKerjaBerhasil').html();
                        if(NotifikasiHapusAnggotaUnitKerjaBerhasil=="Success"){
                            location.reload();
                        }
                    }
                });
            });
        }
    });
});
//Hapus UnitKerja
$('#ModalEditeAnggotaUnitKerja').on('show.bs.modal', function (e) {
    var id_unit_kerja_anggota = $(e.relatedTarget).data('id');
    $('#FormEditeAnggotaUnitKerja').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/UnitKerja/FormEditeAnggotaUnitKerja.php',
        data        : {id_unit_kerja_anggota: id_unit_kerja_anggota},
        success     : function(data){
            $('#FormEditeAnggotaUnitKerja').html(data);
            $('#ProsesEditAnggotaUnitKerja').submit(function(){
                $('#NotifikasiEditAnggotaUnitKerja').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesEditAnggotaUnitKerja')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/UnitKerja/ProsesEditAnggotaUnitKerja.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiEditAnggotaUnitKerja').html(data);
                        var NotifikasiEditAnggotaUnitKerjaBerhasil=$('#NotifikasiEditAnggotaUnitKerjaBerhasil').html();
                        if(NotifikasiEditAnggotaUnitKerjaBerhasil=="Success"){
                            location.reload();
                        }
                    }
                });
            });
        }
    });
});