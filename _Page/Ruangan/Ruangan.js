$('#MenampilkanTabelRuangan').html("Loading...");
$('#MenampilkanTabelRuangan').load("_Page/Ruangan/TabelRuangan.php");
$('#batas').change(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelRuangan').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Ruangan/TabelRuangan.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelRuangan').html(data);
        }
    });
});
$('#ProsesBatas').submit(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelRuangan').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Ruangan/TabelRuangan.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelRuangan').html(data);
        }
    });
});
$('#ProsesFilterRuangan').submit(function(){
    var batas = $('#FilterBatas').val();
    var OrderBy = $('#OrderBy').val();
    var ShortBy = $('#ShortBy').val();
    var KeywordBy = $('#KeywordBy').val();
    var FilterKeyword = $('#FilterKeyword').val();
    $('#MenampilkanTabelRuangan').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Ruangan/TabelRuangan.php',
        data 	    :  {batas: batas, OrderBy: OrderBy, ShortBy: ShortBy, keyword_by: KeywordBy, keyword: FilterKeyword},
        success     : function(data){
            $('#MenampilkanTabelRuangan').html(data);
            $('#ModalFilterRuangan').modal('hide');
        }
    });
});
$('#KeywordBy').change(function(){
    var KeywordBy = $('#KeywordBy').val();
    $('#FormKeyword').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Ruangan/FormKeyword.php',
        data 	    :  {KeywordBy: KeywordBy},
        success     : function(data){
            $('#FormKeyword').html(data);
        }
    });
});
//Tabel Kunjungan
$('#ProsesBatasKunjungan').submit(function(){
    var ProsesBatasKunjungan = $('#ProsesBatasKunjungan').serialize();
    $('#MenampilkanTabelKunjungan').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Ruangan/TabelKunjungan.php',
        data 	    :  ProsesBatasKunjungan,
        success     : function(data){
            $('#MenampilkanTabelKunjungan').html(data);
        }
    });
});
//Tambah Ruangan
$('#ModalTambahRuangan').on('show.bs.modal', function (e) {
    $('#FormTambahRuangan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Ruangan/FormTambahRuangan.php',
        success     : function(data){
            $('#FormTambahRuangan').html(data);
            //Proses Tambah Ruangan
            $('#ProsesTambahRuangan').submit(function(){
                $('#NotifikasiTambahRuangan').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesTambahRuangan')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Ruangan/ProsesTambahRuangan.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiTambahRuangan').html(data);
                        var NotifikasiTambahRuanganBerhasil=$('#NotifikasiTambahRuanganBerhasil').html();
                        if(NotifikasiTambahRuanganBerhasil=="Success"){
                            location.reload();
                        }
                    }
                });
            });
        }
    });
});
//Edit Ruangan
$('#ModalEditRuangan').on('show.bs.modal', function (e) {
    var id_ruangan = $(e.relatedTarget).data('id');
    $('#FormEditRuangan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Ruangan/FormEditRuangan.php',
        data        : {id_ruangan: id_ruangan},
        success     : function(data){
            $('#FormEditRuangan').html(data);
            //Proses Tambah Ruangan
            $('#ProsesEditRuangan').submit(function(){
                $('#NotifikasiEditRuangan').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesEditRuangan')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Ruangan/ProsesEditRuangan.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiEditRuangan').html(data);
                        var NotifikasiEditRuanganBerhasil=$('#NotifikasiEditRuanganBerhasil').html();
                        if(NotifikasiEditRuanganBerhasil=="Success"){
                            $('#ModalEditRuangan').modal('hide');
                            var ProsesBatas = $('#ProsesBatas').serialize();
                            $('#MenampilkanTabelRuangan').html('Loading...');
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/Ruangan/TabelRuangan.php',
                                data 	    :  ProsesBatas,
                                success     : function(data){
                                    $('#MenampilkanTabelRuangan').html(data);
                                    //Notifikasi
                                    swal("Success!", "Edit Ruangan Berhasil", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
//Detail Riwayat Kerja
$('#ModalDetailRuangan').on('show.bs.modal', function (e) {
    var id_ruangan = $(e.relatedTarget).data('id');
    $('#FormDetailRuangan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Ruangan/FormDetailRuangan.php',
        data        : {id_ruangan: id_ruangan},
        success     : function(data){
            $('#FormDetailRuangan').html(data);
        }
    });
});
//Generate Qr
$('#ModalRegenerateQr').on('show.bs.modal', function (e) {
    var id_ruangan = $(e.relatedTarget).data('id');
    $('#FormGenerateQr').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Ruangan/FormGenerateQr.php',
        data        : {id_ruangan: id_ruangan},
        success     : function(data){
            $('#FormGenerateQr').html(data);
        }
    });
});
//Hapus Riwayat Kerja
$('#ModalDeleteRuangan').on('show.bs.modal', function (e) {
    var id_ruangan = $(e.relatedTarget).data('id');
    $('#FormDeleteRuangan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Ruangan/FormDeleteRuangan.php',
        data        : {id_ruangan: id_ruangan},
        success     : function(data){
            $('#FormDeleteRuangan').html(data);
            //Konfirmasi Hapus akses
            $('#KonfirmasiHapusRuangan').click(function(){
                $('#NotifikasiHapusRuangan').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Ruangan/ProsesHapusRuangan.php',
                    data        : {id_ruangan: id_ruangan},
                    success     : function(data){
                        $('#NotifikasiHapusRuangan').html(data);
                        var NotifikasiHapusRuanganBerhasil=$('#NotifikasiHapusRuanganBerhasil').html();
                        if(NotifikasiHapusRuanganBerhasil=="Success"){
                            $('#ModalDeleteRuangan').modal('hide');
                            var ProsesBatas = $('#ProsesBatas').serialize();
                            $('#MenampilkanTabelRuangan').html('Loading...');
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/Ruangan/TabelRuangan.php',
                                data 	    :  ProsesBatas,
                                success     : function(data){
                                    $('#MenampilkanTabelRuangan').html(data);
                                    //Notifikasi
                                    swal("Success!", "Hapus Ruangan Berhasil", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
//Detail Kunjungan
$('#ModalDetailKunjungan').on('show.bs.modal', function (e) {
    var id_kunjungan = $(e.relatedTarget).data('id');
    $('#FormDetailKunjungan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Ruangan/FormDetailKunjungan.php',
        data        : {id_kunjungan: id_kunjungan},
        success     : function(data){
            $('#FormDetailKunjungan').html(data);
        }
    });
});
//Generate Kunjungan
$('#ModalGenerateKunjungan').on('show.bs.modal', function (e) {
    var id_ruangan = $(e.relatedTarget).data('id');
    $('#FormGenerateKunjungan').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Ruangan/FormGenerateKunjungan.php',
        data        : {id_ruangan: id_ruangan},
        success     : function(data){
            $('#FormGenerateKunjungan').html(data);
            $('#ProsesGenerateKunjungan').submit(function(){
                $('#HasilGenerate').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesGenerateKunjungan')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/Ruangan/ProsesGenerateKunjungan.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#HasilGenerate').html(data);
                    }
                });
            });
        }
    });
});
//Proses Tampilkan Grafik
$('#TampilkanGrafikKunjungan').click(function(){
    $('#GrafikKunjungan').html('Loading...');
    var id_ruangan =$('#IdRuangan').val();
    var PeriodeTahun =$('#PeriodeTahun').val();
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/Ruangan/ProsesTampilkanGrapik.php',
        data 	    :  {PeriodeTahun: PeriodeTahun, id_ruangan: id_ruangan},
        success     : function(data){
            // $('#reportsChart').html(data);
            var NamaData="Laporan Kunjungan Ruangan";
            var options = {
                chart: {
                    height: 400,
                    type: 'area',
                },
                dataLabels: {
                    enabled: false
                },
                series: [],
                title: {
                    text: NamaData,
                },
                noData: {
                    text: 'Loading...'
                }
            }
            
            var chart = new ApexCharts(
                document.querySelector("#GrafikKunjungan"),
                options
            );
            var url = '_Page/Ruangan/Laporan.json';
            $.getJSON(url, function(response) {
                chart.updateSeries([{
                    name: NamaData,
                    data: response
                }])
            });
            chart.render();
        }
    });
});