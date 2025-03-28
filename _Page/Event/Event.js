$('#MenampilkanTabelEvent').html("Loading...");
var ProsesBatas = $('#ProsesBatas').serialize();
$('#MenampilkanTabelEvent').html('Loading...');
$.ajax({
    type 	    : 'POST',
    url 	    : '_Page/Event/TabelEvent.php',
    data 	    :  ProsesBatas,
    success     : function(data){
        $('#MenampilkanTabelEvent').html(data);
    }
});
$('#batas').change(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelEvent').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/TabelEvent.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelEvent').html(data);
        }
    });
});
$('#ProsesBatas').submit(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelEvent').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/TabelEvent.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelEvent').html(data);
        }
    });
});
$('#KeywordBy').change(function(){
    var KeywordBy = $('#KeywordBy').val();
    $('#FormKeywordFilter').html('Loading..');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormKeywordFilter.php',
        data 	    :  {KeywordBy: KeywordBy},
        success     : function(data){
            $('#FormKeywordFilter').html(data);
        }
    });
});
$('#ProsesFilterEvent').submit(function(){
    var batas = $('#FilterBatas').val();
    var OrderBy = $('#OrderBy').val();
    var ShortBy = $('#ShortBy').val();
    var KeywordBy = $('#KeywordBy').val();
    var FilterKeyword = $('#FilterKeyword').val();
    $('#MenampilkanTabelEvent').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/TabelEvent.php',
        data 	    :  {batas: batas, OrderBy: OrderBy, ShortBy: ShortBy, KeywordBy: KeywordBy, keyword: FilterKeyword},
        success     : function(data){
            $('#MenampilkanTabelEvent').html(data);
            $('#ModalFilterEvent').modal('hide');
        }
    });
});
//Tambah Event
$('#ModalTambahEvent').on('show.bs.modal', function (e) {
    $('#FormTambahEvent').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormTambahEvent.php',
        success     : function(data){
            $('#FormTambahEvent').html(data);
            //Proses Tambah Event
            $('#ProsesTambahEvent').submit(function(){
                $('#NotifikasiTambahEvent').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesTambahEvent')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/ProsesTambahEvent.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiTambahEvent').html(data);
                        var NotifikasiTambahEventBerhasil=$('#NotifikasiTambahEventBerhasil').html();
                        if(NotifikasiTambahEventBerhasil=="Success"){
                            location.reload();
                        }
                    }
                });
            });
        }
    });
});
//Edit Event
$('#ModalEditEvent').on('show.bs.modal', function (e) {
    var id_event_setting = $(e.relatedTarget).data('id');
    $('#FormEditEvent').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormEditEvent.php',
        data        : {id_event_setting: id_event_setting},
        success     : function(data){
            $('#FormEditEvent').html(data);
            //Proses Simpan Edit Event
            $('#ProsesEditEvent').submit(function(){
                $('#NotifikasiEditEvent').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesEditEvent')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/ProsesEditEvent.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiEditEvent').html(data);
                        var NotifikasiEditEventBerhasil=$('#NotifikasiEditEventBerhasil').html();
                        if(NotifikasiEditEventBerhasil=="Success"){
                            location.reload();
                        }
                    }
                });
            });
        }
    });
});
//Detail Event
$('#ModalDetailEvent').on('show.bs.modal', function (e) {
    var id_event_setting = $(e.relatedTarget).data('id');
    $('#FormDetailEvent').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormDetailEvent.php',
        data        : {id_event_setting: id_event_setting},
        success     : function(data){
            $('#FormDetailEvent').html(data);
        }
    });
});
//Hapus Event
$('#ModalHapusEvent').on('show.bs.modal', function (e) {
    var id_event_setting = $(e.relatedTarget).data('id');
    $('#FormHapusEvent').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormHapusEvent.php',
        data        : {id_event_setting: id_event_setting},
        success     : function(data){
            $('#FormHapusEvent').html(data);
            //Konfirmasi Hapus event
            $('#KonfirmasiHapusEvent').click(function(){
                $('#NotifikasiHapusEvent').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/ProsesHapusEvent.php',
                    data        : {id_event_setting: id_event_setting},
                    success     : function(data){
                        $('#NotifikasiHapusEvent').html(data);
                        var NotifikasiHapusEventBerhasil=$('#NotifikasiHapusEventBerhasil').html();
                        if(NotifikasiHapusEventBerhasil=="Success"){
                            location.reload();
                        }
                    }
                });
            });
        }
    });
});
//KATEGORI EVENT
//Modal Tambah Kategori Event
$('#ModalTambahKategoriEvent').on('show.bs.modal', function (e) {
    var id_event_setting = $(e.relatedTarget).data('id');
    $('#FormTambahKategoriEvent').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormTambahKategoriEvent.php',
        data        : {id_event_setting: id_event_setting},
        success     : function(data){
            $('#FormTambahKategoriEvent').html(data);
        }
    });
});
//Proses Tambah Kategori Event
$('#ProsesTambahKategoriEvent').submit(function(){
    $('#NotifikasiTambahKategoriEvent').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahKategoriEvent')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/ProsesTambahKategoriEvent.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahKategoriEvent').html(data);
            var NotifikasiTambahKategoriEventBerhasil=$('#NotifikasiTambahKategoriEventBerhasil').html();
            if(NotifikasiTambahKategoriEventBerhasil=="Success"){
                location.reload();
            }
        }
    });
});
//Detail Kategori Event
$('#ModalDetailKategoriEvent').on('show.bs.modal', function (e) {
    var id_event_kategori = $(e.relatedTarget).data('id');
    $('#FormDetailKategoriEvent').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormDetailKategoriEvent.php',
        data        : {id_event_kategori: id_event_kategori},
        success     : function(data){
            $('#FormDetailKategoriEvent').html(data);
        }
    });
});
//Edit KategoriEvent
$('#ModalEditKategoriEvent').on('show.bs.modal', function (e) {
    var id_event_kategori = $(e.relatedTarget).data('id');
    $('#FormEditKategoriEvent').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormEditKategoriEvent.php',
        data        : {id_event_kategori: id_event_kategori},
        success     : function(data){
            $('#FormEditKategoriEvent').html(data);
            //Proses Simpan Edit Event
            $('#ProsesEditKategoriEvent').submit(function(){
                $('#NotifikasiEditKategoriEvent').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesEditKategoriEvent')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/ProsesEditKategoriEvent.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiEditKategoriEvent').html(data);
                        var NotifikasiEditKategoriEventBerhasil=$('#NotifikasiEditKategoriEventBerhasil').html();
                        if(NotifikasiEditKategoriEventBerhasil=="Success"){
                            location.reload();
                        }
                    }
                });
            });
        }
    });
});
//Hapus Kategori Event
$('#ModalHapusKategoriEvent').on('show.bs.modal', function (e) {
    var id_event_kategori = $(e.relatedTarget).data('id');
    $('#FormHapusKategoriEvent').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormHapusKategoriEvent.php',
        data        : {id_event_kategori: id_event_kategori},
        success     : function(data){
            $('#FormHapusKategoriEvent').html(data);
            //Konfirmasi Hapus event
            $('#KonfirmasiHapusKategoriEvent').click(function(){
                $('#NotifikasiHapusKategoriEvent').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/ProsesHapusKategoriEvent.php',
                    data        : {id_event_kategori: id_event_kategori},
                    success     : function(data){
                        $('#NotifikasiHapusKategoriEvent').html(data);
                        var NotifikasiHapusEventKategoriBerhasil=$('#NotifikasiHapusEventKategoriBerhasil').html();
                        if(NotifikasiHapusEventKategoriBerhasil=="Success"){
                            location.reload();
                        }
                    }
                });
            });
        }
    });
});
//GET ID EVENT
var GetIdEvent=$('#GetIdEvent').html();
//KUPON
$('#SubPageKuponDiskon').click(function(){
    $('#flush-collapse6').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/SubPageKuponDiskon.php',
        data 	    :  {id_event_setting: GetIdEvent},
        success     : function(data){
            $('#flush-collapse6').html(data);
        }
    });
});
//Modal Tambah Kupon Multiple
$('#ModalTambahKuponMultiple').on('show.bs.modal', function (e) {
    var id_event_setting = $(e.relatedTarget).data('id');
    $('#IdEventSettingKupon').val(id_event_setting);
    $('#IdKategoriEventKupon').html('<option value="">Pilih</option><option value="">Loading...</option>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Peserta/OptionListKategoriEvent.php',
        data        : {id_event_setting: id_event_setting},
        success     : function(data){
            $('#IdKategoriEventKupon').html(data);
        }
    });
});
//Proses Tambah Kupon Multiple
$('#ProsesTambahKuponMultiple').submit(function(){
    $('#NotifikasiTambahKuponMultiple').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahKuponMultiple')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/ProsesTambahKuponMultiple.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahKuponMultiple').html(data);
            var NotifikasiTambahKuponMultipleBerhasil=$('#NotifikasiTambahKuponMultipleBerhasil').html();
            if(NotifikasiTambahKuponMultipleBerhasil=="Success"){
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/SubPageKuponDiskon.php',
                    data 	    :  {id_event_setting: GetIdEvent},
                    success     : function(data){
                        $('#flush-collapse6').html(data);
                    }
                });
                swal("Success!", "Tambah Kupon Berhasil", "success");
                $('#ModalTambahKuponMultiple').modal('hide');
            }
        }
    });
});
//Modal Detail Kupon
$('#ModalDetailKupon').on('show.bs.modal', function (e) {
    var id_kupon = $(e.relatedTarget).data('id');
    $('#FormDetailKupon').html('<option value="">Pilih</option><option value="">Loading...</option>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Kupon/FormDetailKupon.php',
        data        : {id_kupon: id_kupon},
        success     : function(data){
            $('#FormDetailKupon').html(data);
        }
    });
});
//Hapus Kupon
$('#ModalHapusKupon').on('show.bs.modal', function (e) {
    var id_kupon = $(e.relatedTarget).data('id');
    $('#FormHapusKupon').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormHapusKupon.php',
        data        : {id_kupon: id_kupon},
        success     : function(data){
            $('#FormHapusKupon').html(data);
        }
    });
});
//Konfirmasi Hapus Kupon
$('#KonfirmasiHapusKupon').click(function(){
    var form = $('#ProsesHapusKupon')[0];
    var data = new FormData(form);
    $('#FormHapusKupon').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Kupon/ProsesHapusKupon.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#FormHapusKupon').html(data);
            var NotifikasiHapusKuponBerhasil=$('#NotifikasiHapusKuponBerhasil').html();
            if(NotifikasiHapusKuponBerhasil=="Success"){
                $('#flush-collapse6').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/SubPageKuponDiskon.php',
                    data 	    :  {id_event_setting: GetIdEvent},
                    success     : function(data){
                        $('#flush-collapse6').html(data);
                        swal("Success!", "Hapus Kupon Berhasil", "success");
                        $('#ModalHapusKupon').modal('hide');
                    }
                });
            }
        }
    });
});
//PESERTA
//Membuka Sub Page Peserta
$('#SubPagePeserta').click(function(){
    $('#flush-collapse4').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/SubPagePeserta.php',
        data 	    :  {id_event_setting: GetIdEvent},
        success     : function(data){
            $('#flush-collapse4').html(data);
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
//JADWAL ACARA
//Membuka Sub Page Jadwal Acara
$('#TampilkanJadwalAcara').click(function(){
    $('#ListJadwalAcara').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/SubPageJadwalAcara.php',
        data 	    :  {id_event_setting: GetIdEvent},
        success     : function(data){
            $('#ListJadwalAcara').html(data);
        }
    });
});
//Tambah Jadwal
$('#ModalTambahJadwal').on('show.bs.modal', function (e) {
    var id_event_setting = $(e.relatedTarget).data('id');
    $('#FormTambahJadwal').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormTambahJadwal.php',
        data        : {id_event_setting: id_event_setting},
        success     : function(data){
            $('#FormTambahJadwal').html(data);
        }
    });
});
//Proses Tambah jadwal
$('#ProsesTambahJadwal').submit(function(){
    $('#NotifikasiTambahJadwal').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahJadwal')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/ProsesTambahJadwal.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahJadwal').html(data);
            var NotifikasiTambahJadwalBerhasil=$('#NotifikasiTambahJadwalBerhasil').html();
            if(NotifikasiTambahJadwalBerhasil=="Success"){
                $('#ListJadwalAcara').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/SubPageJadwalAcara.php',
                    data 	    :  {id_event_setting: GetIdEvent},
                    success     : function(data){
                        $('#ListJadwalAcara').html(data);
                    }
                });
                $('#ModalTambahJadwal').modal('hide');
                swal("Good Job!", "Tambah Jadwal Event Berhasil", "success");
            }
        }
    });
});
//Detail Jadwal Acara
$('#ModalDetailJadwal').on('show.bs.modal', function (e) {
    var id_event_jadwal = $(e.relatedTarget).data('id');
    $('#FormDetailJadwal').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormDetailJadwal.php',
        data        : {id_event_jadwal: id_event_jadwal},
        success     : function(data){
            $('#FormDetailJadwal').html(data);
        }
    });
});
//Hapus jadwal
$('#ModalHapusJadwal').on('show.bs.modal', function (e) {
    var id_event_jadwal = $(e.relatedTarget).data('id');
    $('#FormHapusJadwal').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormHapusJadwal.php',
        data        : {id_event_jadwal: id_event_jadwal},
        success     : function(data){
            $('#FormHapusJadwal').html(data);
        }
    });
});
//Konfirmasi Hapus jadwal
$('#ProsesHapusJadwal').submit(function(){
    $('#NotifikasiHapusJadwal').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesHapusJadwal')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/ProsesHapusJadwal.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusJadwal').html(data);
            var NotifikasiHapusJadwalBerhasil=$('#NotifikasiHapusJadwalBerhasil').html();
            if(NotifikasiHapusJadwalBerhasil=="Success"){
                $('#ListJadwalAcara').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/SubPageJadwalAcara.php',
                    data 	    :  {id_event_setting: GetIdEvent},
                    success     : function(data){
                        $('#ListJadwalAcara').html(data);
                    }
                });
                $('#ModalHapusJadwal').modal('hide');
                swal("Good Job!", "Hapus Jadwal Acara Berhasil", "success");
            }
        }
    });
});
//Edit Jadwal
$('#ModalEditJadwal').on('show.bs.modal', function (e) {
    var id_event_jadwal = $(e.relatedTarget).data('id');
    $('#FormEditJadwal').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormEditJadwal.php',
        data        : {id_event_jadwal: id_event_jadwal},
        success     : function(data){
            $('#FormEditJadwal').html(data);
        }
    });
});
//Proses Simpan Edit jadwal
$('#ProsesEditJadwal').submit(function(){
    $('#NotifikasiEditJadwal').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditJadwal')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/ProsesEditJadwal.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditJadwal').html(data);
            var NotifikasiEditJadwalBerhasil=$('#NotifikasiEditJadwalBerhasil').html();
            if(NotifikasiEditJadwalBerhasil=="Success"){
                $('#ListJadwalAcara').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/SubPageJadwalAcara.php',
                    data 	    :  {id_event_setting: GetIdEvent},
                    success     : function(data){
                        $('#ListJadwalAcara').html(data);
                    }
                });
                $('#ModalEditJadwal').modal('hide');
                swal("Good Job!", "Edit Jadwal Event Berhasil", "success");
            }
        }
    });
});
//PANITIA
$('#SubPagePanitia').click(function(){
    $('#flush-collapseThree').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/SubPagePanitia.php',
        data 	    :  {id_event_setting: GetIdEvent},
        success     : function(data){
            $('#flush-collapseThree').html(data);
        }
    });
});
//Tambah Panitia
$('#ModalTambahPanitia').on('show.bs.modal', function (e) {
    var id_event_setting = $(e.relatedTarget).data('id');
    $('#FormTambahPanitia').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormTambahPanitia.php',
        data        : {id_event_setting: id_event_setting},
        success     : function(data){
            $('#FormTambahPanitia').html(data);
        }
    });
});
//Proses Tambah Panitia
$('#ProsesTambahPanitia').submit(function(){
    $('#NotifikasiTambahPanitia').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesTambahPanitia')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/ProsesTambahPanitia.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahPanitia').html(data);
            var NotifikasiTambahPanitiaBerhasil=$('#NotifikasiTambahPanitiaBerhasil').html();
            if(NotifikasiTambahPanitiaBerhasil=="Success"){
                $('#flush-collapseThree').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/SubPagePanitia.php',
                    data 	    :  {id_event_setting: GetIdEvent},
                    success     : function(data){
                        $('#flush-collapseThree').html(data);
                    }
                });
                $('#ModalTambahPanitia').modal('hide');
                swal("Good Job!", "Tambah Panitia Event Berhasil", "success");
            }
        }
    });
});
//Detail Panitia
$('#ModalDetailPanitia').on('show.bs.modal', function (e) {
    var id_event_panitia = $(e.relatedTarget).data('id');
    $('#FormDetailPanitia').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormDetailPanitia.php',
        data        : {id_event_panitia: id_event_panitia},
        success     : function(data){
            $('#FormDetailPanitia').html(data);
        }
    });
});
//Hapus panitia
$('#ModalHapusPanitia').on('show.bs.modal', function (e) {
    var id_event_Panitia = $(e.relatedTarget).data('id');
    $('#FormHapusPanitia').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormHapusPanitia.php',
        data        : {id_event_Panitia: id_event_Panitia},
        success     : function(data){
            $('#FormHapusPanitia').html(data);
            //Konfirmasi Hapus Panitia
            $('#KonfirmasiHapusPanitia').click(function(){
                $('#NotifikasiHapusPanitia').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/ProsesHapusPanitia.php',
                    data        : {id_event_Panitia: id_event_Panitia},
                    success     : function(data){
                        $('#NotifikasiHapusPanitia').html(data);
                        var NotifikasiHapusPanitiaBerhasil=$('#NotifikasiHapusPanitiaBerhasil').html();
                        if(NotifikasiHapusPanitiaBerhasil=="Success"){
                            $('#flush-collapseThree').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/Event/SubPagePanitia.php',
                                data 	    :  {id_event_setting: GetIdEvent},
                                success     : function(data){
                                    $('#flush-collapseThree').html(data);
                                }
                            });
                            $('#ModalHapusPanitia').modal('hide');
                            swal("Good Job!", "Hapus Panitia Event Berhasil", "success");
                        }
                    }
                });
            });
        }
    });
});
//Edit Panitia
$('#ModalEditPanitia').on('show.bs.modal', function (e) {
    var id_event_panitia = $(e.relatedTarget).data('id');
    $('#FormEditPanitia').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormEditPanitia.php',
        data        : {id_event_panitia: id_event_panitia},
        success     : function(data){
            $('#FormEditPanitia').html(data);
        }
    });
});
//Proses Edit Panitia
$('#ProsesEditPanitia').submit(function(){
    $('#NotifikasiEditPanitia').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditPanitia')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/ProsesEditPanitia.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditPanitia').html(data);
            var NotifikasiEditPanitiaBerhasil=$('#NotifikasiEditPanitiaBerhasil').html();
            if(NotifikasiEditPanitiaBerhasil=="Success"){
                $('#flush-collapseThree').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/SubPagePanitia.php',
                    data 	    :  {id_event_setting: GetIdEvent},
                    success     : function(data){
                        $('#flush-collapseThree').html(data);
                    }
                });
                $('#ModalEditPanitia').modal('hide');
                swal("Good Job!", "Update Panitia Event Berhasil", "success");
            }
        }
    });
});
//ABSENSI
//Membuka Sub Page Absensi
$('#SubPageAbsensi').click(function(){
    $('#flush-collapse5').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/SubPageAbsensi.php',
        data 	    :  {id_event_setting: GetIdEvent},
        success     : function(data){
            $('#flush-collapse5').html(data);
        }
    });
});
//Modal Buat Sesi Absen
$('#ModalBuatSesiAbsen').on('show.bs.modal', function (e) {
    var id_event_setting = $(e.relatedTarget).data('id');
    $('#FormBuatSesiAbsen').html("Loading...");
    $('#NotifikasiTambahSesiAbsen').html('<small class="text-primary">Pastkan data yang anda input sudah benar</small>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormBuatSesiAbsen.php',
        data        : {id_event_setting: id_event_setting},
        success     : function(data){
            $('#FormBuatSesiAbsen').html(data);
        }
    });
});
//Proses Buat Sesi Absensi
$('#ProsesBuatSesiAbsen').submit(function(){
    $('#NotifikasiTambahSesiAbsen').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesBuatSesiAbsen')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/ProsesBuatSesiAbsen.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahSesiAbsen').html(data);
            var NotifikasiTambahSesiAbsenBerhasil=$('#NotifikasiTambahSesiAbsenBerhasil').html();
            if(NotifikasiTambahSesiAbsenBerhasil=="Success"){
                $('#flush-collapse5').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/SubPageAbsensi.php',
                    data 	    :  {id_event_setting: GetIdEvent},
                    success     : function(data){
                        $('#flush-collapse5').html(data);
                    }
                });
                swal("Success!", "Tambah Sesi Absensi Berhasil", "success");
                $('#ModalBuatSesiAbsen').modal('hide');
            }
        }
    });
});
//Modal Detail Sesi Absensi
$('#ModalDetailSesiAbsensi').on('show.bs.modal', function (e) {
    var id_event_sesi_absen = $(e.relatedTarget).data('id');
    $('#FormDetailSesiAbsensi').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormDetailSesiAbsensi.php',
        data        : {id_event_sesi_absen: id_event_sesi_absen},
        success     : function(data){
            $('#FormDetailSesiAbsensi').html(data);
        }
    });
});
//Modal Edit Sesi Absen
$('#ModalEditSesiAbsensi').on('show.bs.modal', function (e) {
    var id_event_sesi_absen = $(e.relatedTarget).data('id');
    $('#FormEditSesiAbsensi').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormEditSesiAbsensi.php',
        data        : {id_event_sesi_absen: id_event_sesi_absen},
        success     : function(data){
            $('#FormEditSesiAbsensi').html(data);
        }
    });
});
//Proses Simpan Edit Sesi Absensi
$('#ProsesEditSesiAbsensi').submit(function(){
    $('#NotifikasiEditSesiAbsen').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    var form = $('#ProsesEditSesiAbsensi')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/ProsesEditSesiAbsensi.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditSesiAbsen').html(data);
            var NotifikasiEditSesiAbsenBerhasil=$('#NotifikasiEditSesiAbsenBerhasil').html();
            if(NotifikasiEditSesiAbsenBerhasil=="Success"){
                $('#flush-collapse5').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/SubPageAbsensi.php',
                    data 	    :  {id_event_setting: GetIdEvent},
                    success     : function(data){
                        $('#flush-collapse5').html(data);
                    }
                });
                swal("Success!", "Edit Sesi Absensi Berhasil", "success");
                $('#ModalEditSesiAbsensi').modal('hide');
            }
        }
    });
});
//Modal Hapus Sesi Absensi
$('#ModalHapusSesiAbsensi').on('show.bs.modal', function (e) {
    var id_event_sesi_absen = $(e.relatedTarget).data('id');
    $('#FormHapusSesiAbsensi').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormHapusSesiAbsensi.php',
        data        : {id_event_sesi_absen: id_event_sesi_absen},
        success     : function(data){
            $('#FormHapusSesiAbsensi').html(data);
            //Konfirmasi Hapus Kupon
            $('#KonfirmasiHapusSesiAbsensi').click(function(){
                $('#NotifikasiHapusSesiAbsensi').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/ProsesHapusSesiAbsensi.php',
                    data        : {id_event_sesi_absen: id_event_sesi_absen},
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiHapusSesiAbsensi').html(data);
                        var NotifikasiHapusSesiAbsensiBerhasil=$('#NotifikasiHapusSesiAbsensiBerhasil').html();
                        if(NotifikasiHapusSesiAbsensiBerhasil=="Success"){
                            $('#flush-collapse5').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/Event/SubPageAbsensi.php',
                                data 	    :  {id_event_setting: GetIdEvent},
                                success     : function(data){
                                    $('#flush-collapse5').html(data);
                                }
                            });
                            swal("Success!", "Hapus Sesi Absensi Berhasil", "success");
                            $('#ModalHapusSesiAbsensi').modal('hide');
                        }
                    }
                });
            });
        }
    });
});


//Tambah Undangan
$('#ModalTambahUndangan').on('show.bs.modal', function (e) {
    var id_event = $(e.relatedTarget).data('id');
    $('#FormTambahUndangan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormTambahUndangan.php',
        data        : {id_event: id_event},
        success     : function(data){
            $('#FormTambahUndangan').html(data);
            $('#in_ex2').change(function(){
                var in_ex2=$('#in_ex2').val();
                if(in_ex2=="Internal"){
                    $('#nama_undangan').prop('readonly', true);
                    $('#unit_instansi').prop('readonly', true);
                    $('#jabatan_undangan').prop('readonly', true);
                    $('#email_undangan').prop('readonly', true);
                    $('#kontak_undangan').prop('readonly', true);
                    $('#FormIdAkses2').load('_Page/Event/FormIdAkses.php');
                }else{
                    $('#nama_undangan').prop('readonly', false);
                    $('#unit_instansi').prop('readonly', false);
                    $('#jabatan_undangan').prop('readonly', false);
                    $('#email_undangan').prop('readonly', false);
                    $('#kontak_undangan').prop('readonly', false);
                    $('#FormIdAkses2').load('_Page/Event/FormIdAksesReadonly.php');
                }
            });
            //Proses Tambah Undangan
            $('#ProsesTambahUndangan').submit(function(){
                $('#NotifikasiTambahUndangan').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesTambahUndangan')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/ProsesTambahUndangan.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiTambahUndangan').html(data);
                        var NotifikasiTambahUndanganBerhasil=$('#NotifikasiTambahUndanganBerhasil').html();
                        if(NotifikasiTambahUndanganBerhasil=="Success"){
                            $('#GetViewContent').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/Event/EventUndangan.php',
                                data 	    :  {GetIdEvent: GetIdEvent},
                                success     : function(data){
                                    $('#GetViewContent').html(data);
                                    $('#ModalTambahUndangan').modal('hide');
                                    swal("Good Job!", "Tambah Undangan Event Berhasil", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});

//Hapus UNDANGAN
$('#ModalHapusUndangan').on('show.bs.modal', function (e) {
    var id_event_undangan = $(e.relatedTarget).data('id');
    $('#FormHapusUndangan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormHapusUndangan.php',
        data        : {id_event_undangan: id_event_undangan},
        success     : function(data){
            $('#FormHapusUndangan').html(data);
            //Konfirmasi Hapus Undangan
            $('#KonfirmasiHapusUndangan').click(function(){
                $('#NotifikasiHapusUndangan').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/ProsesHapusUndangan.php',
                    data        : {id_event_undangan: id_event_undangan},
                    success     : function(data){
                        $('#NotifikasiHapusUndangan').html(data);
                        var NotifikasiHapusUndanganBerhasil=$('#NotifikasiHapusUndanganBerhasil').html();
                        if(NotifikasiHapusUndanganBerhasil=="Success"){
                            $('#GetViewContent').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/Event/EventUndangan.php',
                                data 	    :  {GetIdEvent: GetIdEvent},
                                success     : function(data){
                                    $('#GetViewContent').html(data);
                                    $('#ModalHapusUndangan').modal('hide');
                                    swal("Good Job!", "Hapus Undangan Event Berhasil", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
//Edit Undangan
$('#ModalEditUndangan').on('show.bs.modal', function (e) {
    var id_event_undangan = $(e.relatedTarget).data('id');
    $('#FormEditUndangan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormEditUndangan.php',
        data        : {id_event_undangan: id_event_undangan},
        success     : function(data){
            $('#FormEditUndangan').html(data);
            //Proses Simpan Edit Undangan
            $('#ProsesEditUndangan').submit(function(){
                $('#NotifikasiEditUndangan').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesEditUndangan')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/ProsesEditUndangan.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiEditUndangan').html(data);
                        var NotifikasiEditUndanganBerhasil=$('#NotifikasiEditUndanganBerhasil').html();
                        if(NotifikasiEditUndanganBerhasil=="Success"){
                            $('#GetViewContent').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/Event/EventUndangan.php',
                                data 	    :  {GetIdEvent: GetIdEvent},
                                success     : function(data){
                                    $('#GetViewContent').html(data);
                                    $('#ModalEditUndangan').modal('hide');
                                    swal("Good Job!", "Edit Undangan Event Berhasil", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
//Tambah Absen
$('#ModalTambahAbsen').on('show.bs.modal', function (e) {
    var id_event = $(e.relatedTarget).data('id');
    $('#FormTambahAbsen').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormTambahAbsen.php',
        data        : {id_event: id_event},
        success     : function(data){
            $('#FormTambahAbsen').html(data);
            $('#kategori_absen').change(function(){
                $('#FormTambahAbsen2').html('Loading...');
                var kategori_absen=$('#kategori_absen').val();
                if(kategori_absen=="Undangan"){
                    $.ajax({
                        type 	    : 'POST',
                        url 	    : '_Page/Event/FormTambahAbsenUndangan.php',
                        data 	    :  {id_event: id_event},
                        success     : function(data){
                            $('#FormTambahAbsen2').html(data);
                            //Melakukan pengecekan ID undangan
                            $('#CekIdUndangan').click(function(){
                                $('#HasilCekUndangan').html('Loading...');
                                var id_event_undangan =$('#id_event_undangan').val();
                                $.ajax({
                                    type 	    : 'POST',
                                    url 	    : '_Page/Event/ProsesCekIdUndangan.php',
                                    data 	    :  {id_event: id_event, id_event_undangan: id_event_undangan},
                                    success     : function(data){
                                        $('#HasilCekUndangan').html(data);
                                    }
                                });
                            });
                        }
                    });
                }
                if(kategori_absen=="Akses"){
                    $.ajax({
                        type 	    : 'POST',
                        url 	    : '_Page/Event/FormTambahAbsenAkses.php',
                        data 	    :  {id_event: id_event},
                        success     : function(data){
                            $('#FormTambahAbsen2').html(data);
                        }
                    });
                }
                if(kategori_absen=="Eksternal"){
                    $.ajax({
                        type 	    : 'POST',
                        url 	    : '_Page/Event/FormTambahAbsenEksternal.php',
                        data 	    :  {id_event: id_event},
                        success     : function(data){
                            $('#FormTambahAbsen2').html(data);
                        }
                    });
                }
                if(kategori_absen==""){
                    $('#FormTambahAbsen2').html('');
                }
            });
        }
    });
});

//Hapus Event
$('#ModalHapusAbsen').on('show.bs.modal', function (e) {
    var id_event_absen = $(e.relatedTarget).data('id');
    $('#FormHapusAbsen').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormHapusAbsen.php',
        data        : {id_event_absen: id_event_absen},
        success     : function(data){
            $('#FormHapusAbsen').html(data);
            //Konfirmasi Hapus Absen
            $('#KonfirmasiHapusAbsen').click(function(){
                $('#NotifikasiHapusAbsen').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/ProsesHapusAbsen.php',
                    data        : {id_event_absen: id_event_absen},
                    success     : function(data){
                        $('#NotifikasiHapusAbsen').html(data);
                        var NotifikasiHapusAbsenBerhasil=$('#NotifikasiHapusAbsenBerhasil').html();
                        if(NotifikasiHapusAbsenBerhasil=="Success"){
                            $('#GetViewContent').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/Event/EventAbsensi.php',
                                data 	    :  {GetIdEvent: GetIdEvent},
                                success     : function(data){
                                    $('#GetViewContent').html(data);
                                    $('#ModalHapusAbsen').modal('hide');
                                    swal("Good Job!", "Hapus Absen Event Berhasil", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
//Edit Absen
$('#ModalEditAbsen').on('show.bs.modal', function (e) {
    var id_event_absen = $(e.relatedTarget).data('id');
    $('#FormEditAbsen').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormEditAbsen.php',
        data        : {id_event_absen: id_event_absen},
        success     : function(data){
            $('#FormEditAbsen').html(data);
            //Proses Simpan Edit Absen
            $('#ProsesEditAbsen').submit(function(){
                $('#NotifikasiEditAbsen').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesEditAbsen')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/ProsesEditAbsen.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiEditAbsen').html(data);
                        var NotifikasiEditAbsenBerhasil=$('#NotifikasiEditAbsenBerhasil').html();
                        if(NotifikasiEditAbsenBerhasil=="Success"){
                            $('#GetViewContent').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/Event/EventAbsensi.php',
                                data 	    :  {GetIdEvent: GetIdEvent},
                                success     : function(data){
                                    $('#GetViewContent').html(data);
                                    $('#ModalEditAbsen').modal('hide');
                                    swal("Good Job!", "Edit Absen Event Berhasil", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
//Detail Absen
$('#ModalDetailAbsen').on('show.bs.modal', function (e) {
    var id_event_absen = $(e.relatedTarget).data('id');
    $('#FormDetailAbsen').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormDetailAbsen.php',
        data        : {id_event_absen: id_event_absen},
        success     : function(data){
            $('#FormDetailAbsen').html(data);
        }
    });
});
//Tambah File
$('#ModalTambahFile').on('show.bs.modal', function (e) {
    var id_event = $(e.relatedTarget).data('id');
    $('#FormTambahFile').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormTambahFile.php',
        data        : {id_event: id_event},
        success     : function(data){
            $('#FormTambahFile').html(data);
        }
    });
});

//Hapus Event
$('#ModalHapusFile').on('show.bs.modal', function (e) {
    var id_event_file = $(e.relatedTarget).data('id');
    $('#FormHapusFile').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormHapusFile.php',
        data        : {id_event_file: id_event_file},
        success     : function(data){
            $('#FormHapusFile').html(data);
            //Konfirmasi Hapus File
            $('#KonfirmasiHapusFile').click(function(){
                $('#NotifikasiHapusFile').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/ProsesHapusFile.php',
                    data        : {id_event_file: id_event_file},
                    success     : function(data){
                        $('#NotifikasiHapusFile').html(data);
                        var NotifikasiHapusFileBerhasil=$('#NotifikasiHapusFileBerhasil').html();
                        if(NotifikasiHapusFileBerhasil=="Success"){
                            $('#GetViewContent').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/Event/EventFile.php',
                                data 	    :  {GetIdEvent: GetIdEvent},
                                success     : function(data){
                                    $('#GetViewContent').html(data);
                                    $('#ModalHapusFile').modal('hide');
                                    swal("Good Job!", "Hapus File Event Berhasil", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
//Edit File
$('#ModalEditFile').on('show.bs.modal', function (e) {
    var id_event_file = $(e.relatedTarget).data('id');
    $('#FormEditFile').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormEditFile.php',
        data        : {id_event_file: id_event_file},
        success     : function(data){
            $('#FormEditFile').html(data);
            //Proses Simpan Edit File
            $('#ProsesEditFile').submit(function(){
                $('#NotifikasiEditFile').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesEditFile')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/ProsesEditFile.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiEditFile').html(data);
                        var NotifikasiEditFileBerhasil=$('#NotifikasiEditFileBerhasil').html();
                        if(NotifikasiEditFileBerhasil=="Success"){
                            $('#GetViewContent').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/Event/EventFile.php',
                                data 	    :  {GetIdEvent: GetIdEvent},
                                success     : function(data){
                                    $('#GetViewContent').html(data);
                                    $('#ModalEditFile').modal('hide');
                                    swal("Good Job!", "Edit File Event Berhasil", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});

//Tambah Riwayat
$('#ModalTambahRiwayat').on('show.bs.modal', function (e) {
    var id_event = $(e.relatedTarget).data('id');
    $('#FormTambahRiwayat').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormTambahRiwayat.php',
        data        : {id_event: id_event},
        success     : function(data){
            $('#FormTambahRiwayat').html(data);
        }
    });
});

//Hapus Event
$('#ModalHapusRiwayat').on('show.bs.modal', function (e) {
    var id_riwayat_kerja = $(e.relatedTarget).data('id');
    $('#FormHapusRiwayat').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormHapusRiwayat.php',
        data        : {id_riwayat_kerja: id_riwayat_kerja},
        success     : function(data){
            $('#FormHapusRiwayat').html(data);
            //Konfirmasi Hapus Riwayat
            $('#KonfirmasiHapusRiwayat').click(function(){
                $('#NotifikasiHapusRiwayat').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/ProsesHapusRiwayat.php',
                    data        : {id_riwayat_kerja: id_riwayat_kerja},
                    success     : function(data){
                        $('#NotifikasiHapusRiwayat').html(data);
                        var NotifikasiHapusRiwayatKerjaBerhasil=$('#NotifikasiHapusRiwayatKerjaBerhasil').html();
                        if(NotifikasiHapusRiwayatKerjaBerhasil=="Success"){
                            $('#GetViewContent').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/Event/EventRiwayat.php',
                                data 	    :  {GetIdEvent: GetIdEvent},
                                success     : function(data){
                                    $('#GetViewContent').html(data);
                                    $('#ModalHapusRiwayat').modal('hide');
                                    swal("Good Job!", "Hapus Riwayat Event Berhasil", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
//Edit Riwayat
$('#ModalEditRiwayat').on('show.bs.modal', function (e) {
    var id_riwayat_kerja = $(e.relatedTarget).data('id');
    $('#FormEditRiwayat').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormEditRiwayat.php',
        data        : {id_riwayat_kerja: id_riwayat_kerja},
        success     : function(data){
            $('#FormEditRiwayat').html(data);
            //Proses Simpan Edit Riwayat
            $('#ProsesEditRiwayat').submit(function(){
                $('#NotifikasiEditRiwayat').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesEditRiwayat')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/ProsesEditRiwayat.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiEditRiwayat').html(data);
                        var NotifikasiEditRiwayatBerhasil=$('#NotifikasiEditRiwayatBerhasil').html();
                        if(NotifikasiEditRiwayatBerhasil=="Success"){
                            $('#GetViewContent').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/Event/EventRiwayat.php',
                                data 	    :  {GetIdEvent: GetIdEvent},
                                success     : function(data){
                                    $('#GetViewContent').html(data);
                                    $('#ModalEditRiwayat').modal('hide');
                                    swal("Good Job!", "Edit Riwayat Event Berhasil", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
//Cetak Jadwal
$('#ModalCetakJadwal').on('show.bs.modal', function (e) {
    var id_event = $(e.relatedTarget).data('id');
    $('#FormCetakJadwal').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormCetakJadwal.php',
        data        : {id_event: id_event},
        success     : function(data){
            $('#FormCetakJadwal').html(data);
        }
    });
});
//Cetak Panitia
$('#ModalCetakPanitia').on('show.bs.modal', function (e) {
    var id_event = $(e.relatedTarget).data('id');
    $('#FormCetakPanitia').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormCetakPanitia.php',
        data        : {id_event: id_event},
        success     : function(data){
            $('#FormCetakPanitia').html(data);
        }
    });
});
//Cetak Undangan
$('#ModalCetakUndangan').on('show.bs.modal', function (e) {
    var id_event = $(e.relatedTarget).data('id');
    $('#FormCetakUndangan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormCetakUndangan.php',
        data        : {id_event: id_event},
        success     : function(data){
            $('#FormCetakUndangan').html(data);
        }
    });
});
//Cetak Absensi
$('#ModalCetakAbsensi').on('show.bs.modal', function (e) {
    var id_event = $(e.relatedTarget).data('id');
    $('#FormCetakAbsensi').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormCetakAbsensi.php',
        data        : {id_event: id_event},
        success     : function(data){
            $('#FormCetakAbsensi').html(data);
        }
    });
});
//Cetak Riwayat
$('#ModalCetakRiwayat').on('show.bs.modal', function (e) {
    var id_event = $(e.relatedTarget).data('id');
    $('#FormCetakRiwayat').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormCetakRiwayat.php',
        data        : {id_event: id_event},
        success     : function(data){
            $('#FormCetakRiwayat').html(data);
        }
    });
});
//Tamplate undangan event
$('#ModalPilihTamplate').on('show.bs.modal', function (e) {
    var id_event = $(e.relatedTarget).data('id');
    $('#FormPilihTamplate').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormPilihTamplate.php',
        data        : {id_event: id_event},
        success     : function(data){
            $('#FormPilihTamplate').html(data);
            $('#id_tamplate').change(function(){
                var id_tamplate =$('#id_tamplate').val();
                $('#PreviewTamplate').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/PreviewTamplate.php',
                    data        : {id_tamplate: id_tamplate},
                    success     : function(data){
                        $('#PreviewTamplate').html(data);
                    }
                });
            });
            $('#ProsesPilihTamplate').submit(function(){
                $('#NotifikasiSimpanTamplate').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesPilihTamplate')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/ProsesPilihTamplate.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiSimpanTamplate').html(data);
                        var NotifikasiSimpanTamplateBerhasil=$('#NotifikasiSimpanTamplateBerhasil').html();
                        if(NotifikasiSimpanTamplateBerhasil=="Success"){
                            $('#ModalPilihTamplate').modal('hide');
                            swal("Good Job!", "Simpan Tamplate Undangan", "success");
                        }
                    }
                });
            });
        }
    });
});
//Tamplate undangan event
$('#ModalDetailUndangan').on('show.bs.modal', function (e) {
    var id_event_undangan = $(e.relatedTarget).data('id');
    $('#FormDetailUndangan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormDetailUndangan.php',
        data        : {id_event_undangan: id_event_undangan},
        success     : function(data){
            $('#FormDetailUndangan').html(data);
        }
    });
});

//Ketika SubPagePembicara di click
$('#SubPagePembicara').click(function(){
    $('#flush-collapse77').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/SubPagePembicara.php',
        data 	    :  {id_event_setting: GetIdEvent},
        success     : function(data){
            $('#flush-collapse77').html(data);
        }
    });
});
//Ketika Muncul Tambah Pengisi Acara
$('#ModalTambahPengisiAcara').on('show.bs.modal', function (e) {
    var id_event_setting = $(e.relatedTarget).data('id');
    $('#NotifikasiTambahPengisiAcara').html('<small class="text-primary">Pastikan informasi pengisi acara sudah benar</small>');
    $('#FormTambahPengisiAcara').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormTambahPengisiAcara.php',
        data        : {id_event_setting: id_event_setting},
        success     : function(data){
            $('#FormTambahPengisiAcara').html(data);
        }
    });
});
//Proses Tambah Pengisi Acara
$('#ProsesTambahPengisiAcara').submit(function(){
    $('#NotifikasiTambahPengisiAcara').html('<small class="text-primary">Pastikan informasi pengisi acara sudah benar</small>');
    var form = $('#ProsesTambahPengisiAcara')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/ProsesTambahPengisiAcara.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiTambahPengisiAcara').html(data);
            var NotifikasiTambahPengisiAcaraBerhasil=$('#NotifikasiTambahPengisiAcaraBerhasil').html();
            if(NotifikasiTambahPengisiAcaraBerhasil=="Success"){
                $('#ModalTambahPengisiAcara').modal('hide');
                $('#flush-collapse77').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/SubPagePembicara.php',
                    data 	    :  {id_event_setting: GetIdEvent},
                    success     : function(data){
                        $('#flush-collapse77').html(data);
                    }
                });
                swal("Good Job!", "Simpan Pengisi Acara Berhasil", "success");
            }
        }
    });
});
//Ketika Muncul Modal Hapus Pengisi Acara
$('#ModalHapusPengisiAcara').on('show.bs.modal', function (e) {
    var id_event_pengisi_acara = $(e.relatedTarget).data('id');
    $('#NotifikasiHapusRiwayat').html('<small class="text-danger">Apakah anda yakin akan menghapus data pengisi acara ini?</small>');
    $('#PutIdEventSettingForDetelePengisiAcara').val(id_event_pengisi_acara);
});
//Proses Hapus Pengisi Acara
$('#ProsesHapusPengisiAcara').submit(function(){
    $('#NotifikasiHapusPengisiAcara').html('<small class="text-primary">Pastikan informasi pengisi acara sudah benar</small>');
    var form = $('#ProsesHapusPengisiAcara')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/ProsesHapusPengisiAcara.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiHapusPengisiAcara').html(data);
            var NotifikasiHapusPengisiAcaraBerhasil=$('#NotifikasiHapusPengisiAcaraBerhasil').html();
            if(NotifikasiHapusPengisiAcaraBerhasil=="Success"){
                $('#ModalHapusPengisiAcara').modal('hide');
                $('#flush-collapse77').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/SubPagePembicara.php',
                    data 	    :  {id_event_setting: GetIdEvent},
                    success     : function(data){
                        $('#flush-collapse77').html(data);
                    }
                });
                swal("Good Job!", "Hapus Pengisi Acara Berhasil", "success");
            }
        }
    });
});
//Ketika Muncul Detail Pengisi Acara
$('#ModalDetailPengisiAcara').on('show.bs.modal', function (e) {
    var id_event_pengisi_acara = $(e.relatedTarget).data('id');
    $('#FormDetailPengisiAcara').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormDetailPengisiAcara.php',
        data        : {id_event_pengisi_acara: id_event_pengisi_acara},
        success     : function(data){
            $('#FormDetailPengisiAcara').html(data);
        }
    });
});
//Ketika Muncul Edit Pengisi Acara
$('#ModalEditPengisiAcara').on('show.bs.modal', function (e) {
    var id_event_pengisi_acara = $(e.relatedTarget).data('id');
    $('#NotifikasiEditPengisiAcara').html('<small class="text-primary">Pastikan informasi pengisi acara sudah benar</small>');
    $('#FormEditPengisiAcara').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/FormEditPengisiAcara.php',
        data        : {id_event_pengisi_acara: id_event_pengisi_acara},
        success     : function(data){
            $('#FormEditPengisiAcara').html(data);
        }
    });
});
//Proses Edit Pengisi Acara
$('#ProsesEditPengisiAcara').submit(function(){
    $('#NotifikasiEditPengisiAcara').html('<small class="text-primary">Pastikan informasi pengisi acara sudah benar</small>');
    var form = $('#ProsesEditPengisiAcara')[0];
    var data = new FormData(form);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Event/ProsesEditPengisiAcara.php',
        data 	    :  data,
        cache       : false,
        processData : false,
        contentType : false,
        enctype     : 'multipart/form-data',
        success     : function(data){
            $('#NotifikasiEditPengisiAcara').html(data);
            var NotifikasiEditPengisiAcaraBerhasil=$('#NotifikasiEditPengisiAcaraBerhasil').html();
            if(NotifikasiEditPengisiAcaraBerhasil=="Success"){
                $('#ModalEditPengisiAcara').modal('hide');
                $('#flush-collapse77').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Event/SubPagePembicara.php',
                    data 	    :  {id_event_setting: GetIdEvent},
                    success     : function(data){
                        $('#flush-collapse77').html(data);
                    }
                });
                swal("Good Job!", "Edit Pengisi Acara Berhasil", "success");
            }
        }
    });
});