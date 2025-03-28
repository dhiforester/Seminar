//Menampilkan Group Setting Pertama Kali
var ProsesGroupList = $('#ProsesGroupList').serialize();
var GroupListByEvent = $('#GroupListByEvent').val();
$('#ListGroupSetting').html('Loading...');
$.ajax({
    type 	    : 'POST',
    url 	    : '_Page/Sertifikat/ListGroupSetting.php',
    data 	    :  ProsesGroupList,
    success     : function(data){
        $('#ListGroupSetting').html(data);
    }
});
$('#PutIdEventSetingForPesertaList').val(GroupListByEvent);
var ProsesBatasPeserta = $('#ProsesBatasPeserta').serialize();
//Menampilkan Tabel Panitia Pertama Kali
$('#TabelPanitia').html('Loading...');
$.ajax({
    type 	    : 'POST',
    url 	    : '_Page/Sertifikat/TabelPanitia.php',
    data 	    :  {id_setting_event: GroupListByEvent},
    success     : function(data){
        $('#TabelPanitia').html(data);
    }
});
//Menampilkan Tabel Pengisi Acara Pertama Kali
$('#TabelPengisiAcara').html('Loading...');
$.ajax({
    type 	    : 'POST',
    url 	    : '_Page/Sertifikat/TabelPengisiAcara.php',
    data 	    :  {id_setting_event: GroupListByEvent},
    success     : function(data){
        $('#TabelPengisiAcara').html(data);
    }
});
//Menampilkan Tabel Sponsor Pertama Kali
$('#TabelSponsor').html('Loading...');
$.ajax({
    type 	    : 'POST',
    url 	    : '_Page/Sertifikat/TabelSponsor.php',
    data 	    :  {id_setting_event: GroupListByEvent},
    success     : function(data){
        $('#TabelSponsor').html(data);
    }
});
//Menampilkan Tabel Peserta Pertama Kali
$('#TabelPeserta').html('Loading...');
$.ajax({
    type 	    : 'POST',
    url 	    : '_Page/Sertifikat/TabelPeserta.php',
    data 	    :  ProsesBatasPeserta,
    success     : function(data){
        $('#TabelPeserta').html(data);
    }
});
//Kondisi Ketika GroupListByEvent Diubah
$('#GroupListByEvent').change(function(){
    var GroupListByEvent = $('#GroupListByEvent').val();
    var ProsesGroupList = $('#ProsesGroupList').serialize();
    $('#ListGroupSetting').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Sertifikat/ListGroupSetting.php',
        data 	    :  ProsesGroupList,
        success     : function(data){
            $('#ListGroupSetting').html(data);
        }
    });
    $('#PutIdEventSetingForPesertaList').val(GroupListByEvent);
    var ProsesBatasPeserta = $('#ProsesBatasPeserta').serialize();
    //Menampilkan Tabel Panitia
    $('#TabelPanitia').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Sertifikat/TabelPanitia.php',
        data 	    :  {id_setting_event: GroupListByEvent},
        success     : function(data){
            $('#TabelPanitia').html(data);
        }
    });
    //Menampilkan Tabel Pengisi Acara Pertama Kali
    $('#TabelPengisiAcara').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Sertifikat/TabelPengisiAcara.php',
        data 	    :  {id_setting_event: GroupListByEvent},
        success     : function(data){
            $('#TabelPengisiAcara').html(data);
        }
    });
    //Menampilkan Tabel Sponsor Pertama Kali
    $('#TabelSponsor').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Sertifikat/TabelSponsor.php',
        data 	    :  {id_setting_event: GroupListByEvent},
        success     : function(data){
            $('#TabelSponsor').html(data);
        }
    });
    //Menampilkan Peserta
    $('#TabelPeserta').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Sertifikat/TabelPeserta.php',
        data 	    :  ProsesBatasPeserta,
        success     : function(data){
            $('#TabelPeserta').html(data);
        }
    });
});
//Ketika Modal ModalTambahGroupSetting Muncul
$('#ModalTambahGroupSetting').on('show.bs.modal', function (e) {
    var id_event_setting =$('#GroupListByEvent').val();
    $('#NotifikasiTambahGroupSetting').html('<small class="text-primary">Pastikan pengaturan sertifikat yang anda buat sudah benar</small>');
    $('#PutIdEventSetting').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Sertifikat/PutIdEventSetting.php',
        data        : {id_event_setting: id_event_setting},
        success     : function(data){
            $('#PutIdEventSetting').html(data);
        }
    });
});
//ketika Proses ProsesTambahGroupSetting Dimulai
$('#ProsesTambahGroupSetting').submit(function(){
    $('#NotifikasiTambahGroupSetting').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahGroupSetting')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Sertifikat/ProsesTambahGroupSetting.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahGroupSetting').html(data);
            var NotifikasiTambahGroupSettingBerhasil=$('#NotifikasiTambahGroupSettingBerhasil').html();
            if(NotifikasiTambahGroupSettingBerhasil=="Success"){
                $('#ModalTambahGroupSetting').modal('hide');
                $('#ProsesTambahGroupSetting')[0].reset();
                var ProsesGroupList = $('#ProsesGroupList').serialize();
                $('#ListGroupSetting').html('Loading...');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Sertifikat/ListGroupSetting.php',
                    data 	    :  ProsesGroupList,
                    success     : function(data){
                        $('#ListGroupSetting').html(data);
                    }
                });
                swal("Good Job!", "Tambah Group Setting Berhasil!", "success");
            }
        }
    });
});
//Ketika Modal ModalEditGroupSetting Muncul
$('#ModalEditGroupSetting').on('show.bs.modal', function (e) {
    var id_setting_sertifikat=$(e.relatedTarget).data('id');
    $('#NotifikasiEditGroupSetting').html('<small class="text-primary">Pastikan pengaturan sertifikat yang anda buat sudah benar</small>');
    $('#FormEditGroupSetting').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Sertifikat/FormEditGroupSetting.php',
        data        : {id_setting_sertifikat: id_setting_sertifikat},
        success     : function(data){
            $('#FormEditGroupSetting').html(data);
        }
    });
});
//Ketika ProsesEditGroupSetting dimulai
$('#ProsesEditGroupSetting').submit(function(){
    $('#NotifikasiEditGroupSetting').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditGroupSetting')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Sertifikat/ProsesEditGroupSetting.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditGroupSetting').html(data);
            var NotifikasiEditGroupSettingBerhasil=$('#NotifikasiEditGroupSettingBerhasil').html();
            if(NotifikasiEditGroupSettingBerhasil=="Success"){
                $('#ModalEditGroupSetting').modal('hide');
                var ProsesGroupList = $('#ProsesGroupList').serialize();
                $('#ListGroupSetting').html('Loading...');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Sertifikat/ListGroupSetting.php',
                    data 	    :  ProsesGroupList,
                    success     : function(data){
                        $('#ListGroupSetting').html(data);
                    }
                });
                swal("Good Job!", "Edit Group Setting Berhasil!", "success");
            }
        }
    });
});
//Ketika Modal ModalHapusGroupSetting Muncul
$('#ModalHapusGroupSetting').on('show.bs.modal', function (e) {
    var id_setting_sertifikat=$(e.relatedTarget).data('id');
    $('#NotifikasiHapusGroupSetting').html('<small class="text-primary">Apakah anda yakin akan menghapus data group setting ini?</small>');
    $('#PutIdSettingSertifikatForDelete').val(id_setting_sertifikat);
});
//Ketika ProsesHapusGroupSetting Dimulai
$('#ProsesHapusGroupSetting').submit(function(){
    $('#NotifikasiHapusGroupSetting').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapusGroupSetting')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Sertifikat/ProsesHapusGroupSetting.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusGroupSetting').html(data);
            var NotifikasiHapusGroupSettingBerhasil=$('#NotifikasiHapusGroupSettingBerhasil').html();
            if(NotifikasiHapusGroupSettingBerhasil=="Success"){
                $('#ModalHapusGroupSetting').modal('hide');
                $('#ProsesHapusGroupSetting')[0].reset();
                var ProsesGroupList = $('#ProsesGroupList').serialize();
                $('#ListGroupSetting').html('Loading...');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Sertifikat/ListGroupSetting.php',
                    data 	    :  ProsesGroupList,
                    success     : function(data){
                        $('#ListGroupSetting').html(data);
                    }
                });
                swal("Good Job!", "Hapus Group Setting Berhasil!", "success");
            }
        }
    });
});
//Ketika Batas Diubah
$('#BatasPeserta').change(function(){
    var ProsesBatasPeserta = $('#ProsesBatasPeserta').serialize();
    $('#TabelPeserta').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Sertifikat/TabelPeserta.php',
        data 	    :  ProsesBatasPeserta,
        success     : function(data){
            $('#TabelPeserta').html(data);
        }
    });
});
//Ketika Proses Pencarian Peserta
$('#ProsesBatasPeserta').submit(function(){
    var ProsesBatasPeserta = $('#ProsesBatasPeserta').serialize();
    $('#TabelPeserta').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Sertifikat/TabelPeserta.php',
        data 	    :  ProsesBatasPeserta,
        success     : function(data){
            $('#TabelPeserta').html(data);
        }
    });
});
//Melakukan Generate Token Peserta
$('#ProsesGenerateSertifikat').submit(function(){
    var ProsesGenerateSertifikat = $('#ProsesGenerateSertifikat').serialize();
    var PutPage = $('#PutPage').val();
    var PutBatas = $('#PutBatas').val();
    var id_event_setting = $('#id_event_setting').val();
    var keyword = $('#keyword').val();
    $('#NotifikasiGenerateToken').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Sertifikat/ProsesGenerateSertifikat.php',
        data 	    :  ProsesGenerateSertifikat,
        success     : function(data){
            $('#NotifikasiGenerateToken').html(data);
            var NotifikasiGenerateTokenBerhasil=$('#NotifikasiGenerateTokenBerhasil').html();
            if(NotifikasiGenerateTokenBerhasil=="Success"){
                var ProsesBatasPeserta = $('#ProsesBatasPeserta').serialize();
                $('#TabelPeserta').html('Loading...');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Sertifikat/TabelPeserta.php',
                    data 	    :  ProsesBatasPeserta,
                    success     : function(data){
                        $('#TabelPeserta').html(data);
                    }
                });
                swal("Good Job!", "Generate Token Berhasil!", "success");
            }
        }
    });
});
//Melakukan Generate Token Panitia
$('#ProsesGenerateTokenPanitia').submit(function(){
    var ProsesGenerateTokenPanitia = $('#ProsesGenerateTokenPanitia').serialize();
    $('#NotifikasiGenerateTokenPanitia').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Sertifikat/ProsesGenerateSertifikat.php',
        data 	    :  ProsesGenerateTokenPanitia,
        success     : function(data){
            $('#NotifikasiGenerateTokenPanitia').html(data);
            var NotifikasiGenerateTokenBerhasil=$('#NotifikasiGenerateTokenBerhasil').html();
            if(NotifikasiGenerateTokenBerhasil=="Success"){
                var GroupListByEvent = $('#GroupListByEvent').val();
                $('#TabelPanitia').html('Loading...');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Sertifikat/TabelPanitia.php',
                    data 	    :  {id_setting_event: GroupListByEvent},
                    success     : function(data){
                        $('#TabelPanitia').html(data);
                    }
                });
                swal("Good Job!", "Generate Token Berhasil!", "success");
            }
        }
    });
});
//Melakukan Generate Token Panitia
$('#ProsesGenerateTokenPengisiAcara').submit(function(){
    var ProsesGenerateTokenPengisiAcara = $('#ProsesGenerateTokenPengisiAcara').serialize();
    $('#NotifikasiGenerateTokenPengisiAcara').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Sertifikat/ProsesGenerateSertifikat.php',
        data 	    :  ProsesGenerateTokenPengisiAcara,
        success     : function(data){
            $('#NotifikasiGenerateTokenPengisiAcara').html(data);
            var NotifikasiGenerateTokenBerhasil=$('#NotifikasiGenerateTokenBerhasil').html();
            if(NotifikasiGenerateTokenBerhasil=="Success"){
                var GroupListByEvent = $('#GroupListByEvent').val();
                //Menampilkan Tabel Pengisi Acara Pertama Kali
                $('#TabelPengisiAcara').html('Loading...');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Sertifikat/TabelPengisiAcara.php',
                    data 	    :  {id_setting_event: GroupListByEvent},
                    success     : function(data){
                        $('#TabelPengisiAcara').html(data);
                    }
                });
                swal("Good Job!", "Generate Token Berhasil!", "success");
            }
        }
    });
});
//Ketika Modal Tambah Sponsor Tampil
$('#ModalTambahSponsor').on('show.bs.modal', function (e) {
    var id_event_setting=$(e.relatedTarget).data('id');
    $('#NotifikasiTambahSponsor').html('<small class="text-primary">Pastikan informasi sponsor & partisipan yang anda buat sudah benar</small>');
    $('#FormTambahSponsor').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Sertifikat/FormTambahSponsor.php',
        data 	    :  {id_event_setting: id_event_setting},
        success     : function(data){
            $('#FormTambahSponsor').html(data);
        }
    });
});
//Melakukan Proses Simpan Sponsor
$('#ProsesTambahSponsor').submit(function(){
    var ProsesTambahSponsor = $('#ProsesTambahSponsor').serialize();
    $('#NotifikasiTambahSponsor').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Sertifikat/ProsesTambahSponsor.php',
        data 	    :  ProsesTambahSponsor,
        success     : function(data){
            $('#NotifikasiTambahSponsor').html(data);
            var NotifikasiTambahSponsorBerhasil=$('#NotifikasiTambahSponsorBerhasil').html();
            if(NotifikasiTambahSponsorBerhasil=="Success"){
                $('#ModalTambahSponsor').modal('hide');
                var GroupListByEvent = $('#GroupListByEvent').val();
                //Menampilkan Tabel Sponsor Pertama Kali
                $('#TabelSponsor').html('Loading...');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Sertifikat/TabelSponsor.php',
                    data 	    :  {id_setting_event: GroupListByEvent},
                    success     : function(data){
                        $('#TabelSponsor').html(data);
                    }
                });
                swal("Good Job!", "Tambah Sponsor Berhasil!", "success");
            }
        }
    });
});
//Ketika Modal Edit Sponsor Tampil
$('#ModalEditSponsor').on('show.bs.modal', function (e) {
    var id_event_sertifikat=$(e.relatedTarget).data('id');
    $('#NotifikasiEditSponsor').html('<small class="text-primary">Pastikan informasi sponsor & partisipan yang anda buat sudah benar</small>');
    $('#FormEditSponsor').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Sertifikat/FormEditSponsor.php',
        data 	    :  {id_event_sertifikat: id_event_sertifikat},
        success     : function(data){
            $('#FormEditSponsor').html(data);
        }
    });
});
//Melakukan Proses Simpan Edit Sponsor
$('#ProsesEditSponsor').submit(function(){
    var ProsesEditSponsor = $('#ProsesEditSponsor').serialize();
    $('#NotifikasiEditSponsor').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Sertifikat/ProsesEditSponsor.php',
        data 	    :  ProsesEditSponsor,
        success     : function(data){
            $('#NotifikasiEditSponsor').html(data);
            var NotifikasiEditSponsorBerhasil=$('#NotifikasiEditSponsorBerhasil').html();
            if(NotifikasiEditSponsorBerhasil=="Success"){
                $('#ModalEditSponsor').modal('hide');
                var GroupListByEvent = $('#GroupListByEvent').val();
                //Menampilkan Tabel Sponsor Pertama Kali
                $('#TabelSponsor').html('Loading...');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Sertifikat/TabelSponsor.php',
                    data 	    :  {id_setting_event: GroupListByEvent},
                    success     : function(data){
                        $('#TabelSponsor').html(data);
                    }
                });
                swal("Good Job!", "Edit Sponsor Berhasil!", "success");
            }
        }
    });
});
//Ketika ModalHapusSponsor Muncul
$('#ModalHapusSponsor').on('show.bs.modal', function (e) {
    var id_event_sertifikat=$(e.relatedTarget).data('id');
    $('#NotifikasiHapusSponsor').html('<small class="text-primary">Apakah anda yakin akan menghapus data sertifikat ini?</small>');
    $('#PutIdEventSertifikatForDelete').val(id_event_sertifikat);
});
//Ketika ProsesHapusSponsor Dimulai
$('#ProsesHapusSponsor').submit(function(){
    $('#NotifikasiHapusSponsor').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapusSponsor')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Sertifikat/ProsesHapusSponsor.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusSponsor').html(data);
            var NotifikasiHapusSponsorBerhasil=$('#NotifikasiHapusSponsorBerhasil').html();
            if(NotifikasiHapusSponsorBerhasil=="Success"){
                $('#ModalHapusSponsor').modal('hide');
                $('#ProsesHapusSponsor')[0].reset();
                var GroupListByEvent = $('#GroupListByEvent').val();
                //Menampilkan Tabel Sponsor Pertama Kali
                $('#TabelSponsor').html('Loading...');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Sertifikat/TabelSponsor.php',
                    data 	    :  {id_setting_event: GroupListByEvent},
                    success     : function(data){
                        $('#TabelSponsor').html(data);
                    }
                });
                swal("Good Job!", "Hapus Sertifikat Sponsor Berhasil!", "success");
            }
        }
    });
});