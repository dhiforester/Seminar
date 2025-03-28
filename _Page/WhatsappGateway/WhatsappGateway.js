$('#MenampilkanTabelAkunWa').html("Loading...");
$('#MenampilkanTabelAkunWa').load("_Page/WhatsappGateway/TabelAkunWa.php");
$('#BatasAkunWa').change(function(){
    var ProsesBatasAkunWa = $('#ProsesBatasAkunWa').serialize();
    $('#MenampilkanTabelAkunWa').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WhatsappGateway/TabelAkunWa.php',
        data 	    :  ProsesBatasAkunWa,
        success     : function(data){
            $('#MenampilkanTabelAkunWa').html(data);
        }
    });
});
$('#ProsesBatasAkunWa').submit(function(){
    var ProsesBatasAkunWa = $('#ProsesBatasAkunWa').serialize();
    $('#MenampilkanTabelAkunWa').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WhatsappGateway/TabelAkunWa.php',
        data 	    :  ProsesBatasAkunWa,
        success     : function(data){
            $('#MenampilkanTabelAkunWa').html(data);
        }
    });
});

//Modal Tambah Akun WA
$('#ModalTambahAkunWa').on('show.bs.modal', function (e) {
    $('#FormTambahAkunWa').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WhatsappGateway/FormTambahAkunWa.php',
        success     : function(data){
            $('#FormTambahAkunWa').html(data);
            //Proses Tambah Akses
            $('#ProsesTambahAkunWa').submit(function(){
                $('#NotifikasiTambahAkunWa').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesTambahAkunWa')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/WhatsappGateway/ProsesTambahAkunWa.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiTambahAkunWa').html(data);
                        var NotifikasiTambahAkunWaBerhasil=$('#NotifikasiTambahAkunWaBerhasil').html();
                        if(NotifikasiTambahAkunWaBerhasil=="Success"){
                            $('#ModalTambahAkunWa').modal('toggle');
                            $('#MenampilkanTabelAkunWa').load("_Page/WhatsappGateway/TabelAkunWa.php");
                            swal("Good Job!", "Tambah Akun WA Berhasil!", "success");
                        }
                    }
                });
            });
        }
    });
});
//Modal Delete Akun Wa
$('#ModalDeleteAkunWa').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    var pecah = GetData.split(",");
    var clientId = pecah[0];
    var keyword = pecah[1];
    var batas = pecah[2];
    var ShortBy = pecah[3];
    var OrderBy = pecah[4];
    var page = pecah[5];
    var posisi = pecah[6];
    $('#FormDeleteAkunWa').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WhatsappGateway/FormDeleteAkunWa.php',
        data        : {id_whatsapp_client: clientId},
        success     : function(data){
            $('#FormDeleteAkunWa').html(data);
            //Konfirmasi Hapus akun WA
            $('#KonfirmasiHapusAkunWa').click(function(){
                $('#NotifikasiHapusAkunWa').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/WhatsappGateway/ProsesHapusAkunWa.php',
                    data        : {clientId: clientId},
                    success     : function(data){
                        $('#NotifikasiHapusAkunWa').html(data);
                        var NotifikasiHapusAkunWaBerhasil=$('#NotifikasiHapusAkunWaBerhasil').html();
                        if(NotifikasiHapusAkunWaBerhasil=="Success"){
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/WhatsappGateway/TabelAkunWa.php',
                                data 	    :  {KeywordAkunWa: keyword, BatasAkunWa: batas, ShortBy: ShortBy, OrderBy: OrderBy, page: page, posisi: posisi},
                                success     : function(data){
                                    $('#MenampilkanTabelAkunWa').html(data);
                                    $('#ModalDeleteAkunWa').modal('hide');
                                    swal("Good Job!", "Hapus Akun Wa Berhasil!", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});

//Modal Detail Akun Wa
$('#ModalDetailAkunWa').on('show.bs.modal', function (e) {
    var clientId = $(e.relatedTarget).data('id');
    $('#FormDetailAkunWa').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WhatsappGateway/FormDetailAkunWa.php',
        data        : {clientId: clientId},
        success     : function(data){
            $('#FormDetailAkunWa').html(data);
            //Update Akun Wa
            $('#ReloadDetailAkunWa').click(function(){
                $('#NotifikasiUpdateAkunWa').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/WhatsappGateway/ReloadAkunWa.php',
                    data        : {clientId: clientId},
                    success     : function(data){
                        $('#NotifikasiUpdateAkunWa').html(data);
                        var NotifikasiUpdateAkunWaBerhasil=$('#NotifikasiUpdateAkunWaBerhasil').html();
                        if(NotifikasiUpdateAkunWaBerhasil=="Success"){
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/WhatsappGateway/TabelAkunWa.php',
                                success     : function(data){
                                    $('#MenampilkanTabelAkunWa').html(data);
                                    $('#ModalDetailAkunWa').modal('hide');
                                    swal("Good Job!", "Update Akun Wa Berhasil!", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
