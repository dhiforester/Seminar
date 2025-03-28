//Tambah Agenda
$('#ModalTambahAgenda').on('show.bs.modal', function (e) {
    var GetTanggal = $(e.relatedTarget).data('id');
    $('#FormTambahAgenda').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Agenda/FormTambahAgenda.php',
        data        : {tanggal: GetTanggal},
        success     : function(data){
            $('#FormTambahAgenda').html(data);
            //Proses Tambah Agenda
            $('#ProsesTambahAgenda').submit(function(){
                $('#NotifikasiTambahAgenda').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesTambahAgenda')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Agenda/ProsesTambahAgenda.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiTambahAgenda').html(data);
                        var NotifikasiTambahAgendaBerhasil=$('#NotifikasiTambahAgendaBerhasil').html();
                        if(NotifikasiTambahAgendaBerhasil=="Success"){
                            location.reload();
                        }
                    }
                });
            });
        }
    });
});
var ShowTgl = $('#ShowTgl').val();
var id_unit_kerja = $('#id').val();
$('#ListAgenda').html("Loading...");
$.ajax({
    type 	    : 'POST',
    url 	    : '_Page/Agenda/FormListAgenda.php',
    data        : {tanggal: ShowTgl, id_unit_kerja: id_unit_kerja},
    success     : function(data){
        $('#ListAgenda').html(data);
    }
});
//Edit Agenda
$('#ModalEditAgenda').on('show.bs.modal', function (e) {
    var id_agenda = $(e.relatedTarget).data('id');
    $('#FormEditAgenda').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Agenda/FormEditAgenda.php',
        data        : {id_agenda: id_agenda},
        success     : function(data){
            $('#FormEditAgenda').html(data);
            //Proses Tambah Agenda
            $('#ProsesEditAgenda').submit(function(){
                $('#NotifikasiEditAgenda').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesEditAgenda')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Agenda/ProsesEditAgenda.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiEditAgenda').html(data);
                        var NotifikasiEditAgendaBerhasil=$('#NotifikasiEditAgendaBerhasil').html();
                        if(NotifikasiEditAgendaBerhasil=="Success"){
                            location.reload();
                        }
                    }
                });
            });
        }
    });
});
//Detail Agenda
$('#ModalDetailAgenda').on('show.bs.modal', function (e) {
    var id_agenda = $(e.relatedTarget).data('id');
    $('#FormDetailAgenda').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Agenda/FormDetailAgenda.php',
        data        : {id_agenda: id_agenda},
        success     : function(data){
            $('#FormDetailAgenda').html(data);
        }
    });
});
//Hapus Agenda
$('#ModalDeleteAgenda').on('show.bs.modal', function (e) {
    var id_agenda = $(e.relatedTarget).data('id');
    $('#FormDeleteAgenda').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Agenda/FormDeleteAgenda.php',
        data        : {id_agenda: id_agenda},
        success     : function(data){
            $('#FormDeleteAgenda').html(data);
            //Konfirmasi Hapus Agenda
            $('#KonfirmasiHapusAgenda').click(function(){
                $('#NotifikasiHapusAgenda').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Agenda/ProsesHapusAgenda.php',
                    data        : {id_agenda: id_agenda},
                    success     : function(data){
                        $('#NotifikasiHapusAgenda').html(data);
                        var NotifikasiHapusAgendaBerhasil=$('#NotifikasiHapusAgendaBerhasil').html();
                        if(NotifikasiHapusAgendaBerhasil=="Success"){
                            location.reload();
                        }
                    }
                });
            });
        }
    });
});
//Tambah Riwayat Kerja
$('#ModalTambahRiwayatKerja').on('show.bs.modal', function (e) {
    var id_agenda = $(e.relatedTarget).data('id');
    $('#FormTambahRiwayatKerja').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Agenda/FormTambahRiwayatKerja.php',
        data        : {id_agenda: id_agenda},
        success     : function(data){
            $('#FormTambahRiwayatKerja').html(data);
            //Proses Tambah Riwayat Kerja
            $('#ProsesTambahRiwayatKerja').submit(function(){
                $('#NotifikasiSimpanRiwayatKerja').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesTambahRiwayatKerja')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Agenda/ProsesTambahRiwayatKerja.php',
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