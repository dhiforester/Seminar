var ProsesBatas = $('#ProsesBatas').serialize();
$('#MenampilkanTabelAkses').html('Loading...');
$.ajax({
    type 	    : 'POST',
    url 	    : '_Page/Akses/TabelAkses.php',
    data 	    :  ProsesBatas,
    success     : function(data){
        $('#MenampilkanTabelAkses').html(data);
    }
});
$('#MenampilkanTabelAkses').load("_Page/Akses/TabelAkses.php");
$('#batas').change(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelAkses').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Akses/TabelAkses.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelAkses').html(data);
        }
    });
});
$('#ProsesBatas').submit(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelAkses').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Akses/TabelAkses.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelAkses').html(data);
        }
    });
});
$('#ProsesFilterAkses').submit(function(){
    var batas = $('#FilterBatas').val();
    var OrderBy = $('#OrderBy').val();
    var ShortBy = $('#ShortBy').val();
    var KeywordBy = $('#KeywordBy').val();
    var FilterKeyword = $('#FilterKeyword').val();
    $('#MenampilkanTabelAkses').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Akses/TabelAkses.php',
        data 	    :  {batas: batas, OrderBy: OrderBy, ShortBy: ShortBy, KeywordBy: KeywordBy, keyword: FilterKeyword},
        success     : function(data){
            $('#MenampilkanTabelAkses').html(data);
            $('#ModalFilterAkses').modal('hide');
        }
    });
});
//Tambah Akses
$('#ModalTambahAkses').on('show.bs.modal', function (e) {
    $('#FormTambahAkses').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Akses/FormTambahAkses.php',
        success     : function(data){
            $('#FormTambahAkses').html(data);
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
            //Kondisi id_mitra dipilih
            $('#id_mitra').change(function(){
                var id_mitra = $('#id_mitra').val();
                if(id_mitra==""){
                    $('#akses').html('<option value="Admin">Admin</option><option value="">More Access Groups</option>');
                }else{
                    $("#grup_akses").val("");
                    $("#grup_akses").prop("disabled", true);
                    $('#akses').load('_Page/Akses/PilihAksesMitra.php');
                }
            });
            //Kondisi ketika akses dipilih
            $('#akses').change(function(){
                var akses = $('#akses').val();
                if(akses==""){
                    $("#grup_akses").prop("disabled", false);
                }else{
                    $("#grup_akses").prop("disabled", true);
                }
            });
            //Proses Tambah Akses
            $('#ProsesTambahAkses').submit(function(){
                $('#NotifikasiTambahAkses').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesTambahAkses')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Akses/ProsesTambahAkses.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiTambahAkses').html(data);
                        var NotifikasiTambahAksesBerhasil=$('#NotifikasiTambahAksesBerhasil').html();
                        if(NotifikasiTambahAksesBerhasil=="Success"){
                            location.reload();
                        }
                    }
                });
            });
        }
    });
});
//Kondisi ketika acc_dashboard1 checkd
$("#acc_dashboard1").click(function(){
    $('.dashboard_cehcked').not(this).prop('checked', this.checked);
});
//Kondisi ketika acc_akses1 checkd
$("#acc_akses1").click(function(){
    $('.akses_checked').not(this).prop('checked', this.checked);
});
//Kondisi ketika acc_akses1 checkd
$("#acc_mitra1").click(function(){
    $('.mitra_checked').not(this).prop('checked', this.checked);
});
//Proses Atur Ijin Akses
$('#ProsesAturIjinAkses').submit(function(){
    $('#NotifikasiAturIjinAkses').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesAturIjinAkses')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Akses/ProsesAturIjinAkses.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiAturIjinAkses').html(data);
            var NotifikasiAturIjinAksesBerhasil=$('#NotifikasiAturIjinAksesBerhasil').html();
            if(NotifikasiAturIjinAksesBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Detail Akses
$('#ModalDetailAkses').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    var pecah = GetData.split(",");
    var id_akses = pecah[0];
    $('#FormDetailAkses').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Akses/FormDetailAkses.php',
        data        : {id_akses: id_akses},
        success     : function(data){
            $('#FormDetailAkses').html(data);
        }
    });
});
//Edit Password
$('#ModalEditPassword').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    var pecah = GetData.split(",");
    var id_akses = pecah[0];
    var keyword = pecah[1];
    var batas = pecah[2];
    var ShortBy = pecah[3];
    var OrderBy = pecah[4];
    var page = pecah[5];
    var posisi = pecah[6];
    var keyword_by = pecah[7];
    $('#FormEditPassword').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Akses/FormEditPassword.php',
        data        : {id_akses: id_akses},
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
            //Proses Tambah Akses
            $('#ProsesEditPassword').submit(function(){
                $('#NotifikasiUbahPassword').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesEditPassword')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Akses/ProsesEditPassword.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiUbahPassword').html(data);
                        var NotifikasiUbahPasswordBerhasil=$('#NotifikasiUbahPasswordBerhasil').html();
                        if(NotifikasiUbahPasswordBerhasil=="Success"){
                            $('#MenampilkanTabelAkses').html("Loading...");
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/Akses/TabelAkses.php',
                                data 	    :  {keyword: keyword, batas: batas, ShortBy: ShortBy, OrderBy: OrderBy, page: page, posisi: posisi, keyword_by: keyword_by},
                                success     : function(data){
                                    $('#MenampilkanTabelAkses').html(data);
                                    $('#ModalEditPassword').modal('hide');
                                    swal("Good Job!", "Ubah Password Berhasil!", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
//Edit Akses
$('#ModalEditAkses').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    var pecah = GetData.split(",");
    var id_akses = pecah[0];
    var keyword = pecah[1];
    var batas = pecah[2];
    var ShortBy = pecah[3];
    var OrderBy = pecah[4];
    var page = pecah[5];
    var posisi = pecah[6];
    var keyword_by = pecah[7];
    $('#FormEditAkses').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Akses/FormEditAkses.php',
        data        : {id_akses: id_akses},
        success     : function(data){
            $('#FormEditAkses').html(data);
            //Kondisi ketika akses dipilih
            $('#akses_edit').change(function(){
                var akses_edit = $('#akses_edit').val();
                if(akses_edit==""){
                    $("#grup_akses_edit").prop("disabled", false);
                }else{
                    $("#grup_akses_edit").prop("disabled", true);
                }
            });
            //Proses Tambah Akses
            $('#ProsesEditAkses').submit(function(){
                $('#NotifikasiEditAkses').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesEditAkses')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Akses/ProsesEditAkses.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiEditAkses').html(data);
                        var NotifikasiEditAksesBerhasil=$('#NotifikasiEditAksesBerhasil').html();
                        if(NotifikasiEditAksesBerhasil=="Success"){
                            $('#MenampilkanTabelAkses').html("Loading...");
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/Akses/TabelAkses.php',
                                data 	    :  {keyword: keyword, batas: batas, ShortBy: ShortBy, OrderBy: OrderBy, page: page, posisi: posisi, keyword_by: keyword_by},
                                success     : function(data){
                                    $('#MenampilkanTabelAkses').html(data);
                                    $('#ModalEditAkses').modal('hide');
                                    swal("Good Job!", "Edit Access Success!", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
//Update Status Akses
$('#ModalUpdateStatusAkses').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    var pecah = GetData.split(",");
    var id_akses = pecah[0];
    var keyword = pecah[1];
    var batas = pecah[2];
    var ShortBy = pecah[3];
    var OrderBy = pecah[4];
    var page = pecah[5];
    var posisi = pecah[6];
    var keyword_by = pecah[7];
    $('#FormUpdateStatusAkses').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Akses/FormUpdateStatusAkses.php',
        data        : {id_akses: id_akses},
        success     : function(data){
            $('#FormUpdateStatusAkses').html(data);
            //Proses Tambah Akses
            $('#ProsesUpdateStatusAkses').submit(function(){
                $('#NotifikasiUpdateStatusAkses').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesUpdateStatusAkses')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Akses/ProsesUpdateStatusAkses.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiUpdateStatusAkses').html(data);
                        var NotifikasiUpdateStatusAksesBerhasil=$('#NotifikasiUpdateStatusAksesBerhasil').html();
                        if(NotifikasiUpdateStatusAksesBerhasil=="Success"){
                            $('#MenampilkanTabelAkses').html("Loading...");
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/Akses/TabelAkses.php',
                                data 	    :  {keyword: keyword, batas: batas, ShortBy: ShortBy, OrderBy: OrderBy, page: page, posisi: posisi, keyword_by: keyword_by},
                                success     : function(data){
                                    $('#MenampilkanTabelAkses').html(data);
                                    $('#ModalUpdateStatusAkses').modal('hide');
                                    swal("Good Job!", "Edit Access Success!", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
//Hapus Akses
$('#ModalDeleteAkses').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    var pecah = GetData.split(",");
    var id_akses = pecah[0];
    var keyword = pecah[1];
    var batas = pecah[2];
    var ShortBy = pecah[3];
    var OrderBy = pecah[4];
    var page = pecah[5];
    var posisi = pecah[6];
    var keyword_by = pecah[7];
    $('#FormDeleteAkses').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Akses/FormDeleteAkses.php',
        data        : {id_akses: id_akses},
        success     : function(data){
            $('#FormDeleteAkses').html(data);
            //Konfirmasi Hapus akses
            $('#KonfirmasiHapusAkses').click(function(){
                $('#NotifikasiHapusAkses').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Akses/ProsesHapusAkses.php',
                    data        : {id_akses: id_akses},
                    success     : function(data){
                        $('#NotifikasiHapusAkses').html(data);
                        var NotifikasiHapusAksesBerhasil=$('#NotifikasiHapusAksesBerhasil').html();
                        if(NotifikasiHapusAksesBerhasil=="Success"){
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/Akses/TabelAkses.php',
                                data 	    :  {keyword: keyword, batas: batas, ShortBy: ShortBy, OrderBy: OrderBy, page: page, posisi: posisi, keyword_by: keyword_by},
                                success     : function(data){
                                    $('#MenampilkanTabelAkses').html(data);
                                    $('#ModalDeleteAkses').modal('hide');
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
//ModalUnitKerjaAkses
$('#ModalUnitKerjaAkses').on('show.bs.modal', function (e) {
    var id_akses = $(e.relatedTarget).data('id');
    $('#DetailAksesUnitkerja').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Akses/DetailAksesUnitkerja.php',
        data        : {id_akses: id_akses},
        success     : function(data){
            $('#DetailAksesUnitkerja').html(data);
        }
    });
});
//ModalDukunganAkses
$('#ModalDukunganAkses').on('show.bs.modal', function (e) {
    var id_akses = $(e.relatedTarget).data('id');
    $('#DetailDukunganAkses').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Akses/DetailDukunganAkses.php',
        data        : {id_akses: id_akses},
        success     : function(data){
            $('#DetailDukunganAkses').html(data);
        }
    });
});