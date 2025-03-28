$('#MenampilkanTabelChatBox').html("Loading...");
$('#MenampilkanTabelChatBox').load("_Page/WhatsappChatBox/TabelChatBox.php");
$('#batas').change(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelChatBox').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WhatsappChatBox/TabelChatBox.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelChatBox').html(data);
        }
    });
});
$('#ProsesBatas').submit(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelChatBox').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WhatsappChatBox/TabelChatBox.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelChatBox').html(data);
        }
    });
});

//Modal Detail Chat Box
$('#ModalDetailChatBox').on('show.bs.modal', function (e) {
    var data_id=$(e.relatedTarget).data('id');
    var explode= data_id.split(',');
    var my_number=explode[0];
    var you_number=explode[1];
    var Loading='<div class="modal-body"><div class="row"><div class="col col-md-12 text-center"><div class="spinner-border text-secondary" role="status"><span class="sr-only">Loading...</span></div></div></div></div>';
    $('#FormDetailChatBox').html(Loading);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WhatsappChatBox/FormDetailChatBox.php',
        data        : {my_number: my_number, you_number: you_number},
        success     : function(data){
            $('#FormDetailChatBox').html(data);
            //Mengirim pesan
            $('#ProsesKirimPesan').submit(function(){
                $('#NotifikasiKirimPesan').html('Sedang Mengirim...');
                var form = $('#ProsesKirimPesan')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/WhatsappChatBox/ProsesKirimPesan.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiKirimPesan').html(data);
                        var NotifikasiKirimPesanBerhasil=$('#NotifikasiKirimPesanBerhasil').html();
                        if(NotifikasiKirimPesanBerhasil=="Pesan Berhasil Terkirim!"){
                            $('#FormDetailChatBox').html(Loading);
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/WhatsappChatBox/FormDetailChatBox.php',
                                data        : {my_number: my_number, you_number: you_number},
                                success     : function(data){
                                    $('#FormDetailChatBox').html(data);
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
//Modal Hapus Chat Box
$('#ModalHapusChatBox').on('show.bs.modal', function (e) {
    var GetData=$(e.relatedTarget).data('id');
    var pecah = GetData.split(",");
    var my_number = pecah[0];
    var you_number = pecah[1];
    var Loading='<div class="modal-body"><div class="row"><div class="col col-md-12 text-center"><div class="spinner-border text-secondary" role="status"><span class="sr-only">Loading...</span></div></div></div></div>';
    $('#FormHapusChatBox').html(Loading);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WhatsappChatBox/FormHapusChatBox.php',
        data 	    :  {my_number: my_number, you_number: you_number},
        success     : function(data){
            $('#FormHapusChatBox').html(data);
            //Konfirmasi Hapus Chat Box You And Me
            $('#KonfirmasiHapusChatBox').click(function(){
                $('#NotifikasiHapusChatBox').html('Loading...');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/WhatsappChatBox/ProsesHapusChatBox.php',
                    data 	    :  {my_number: my_number, you_number: you_number},
                    success     : function(data){
                        $('#NotifikasiHapusChatBox').html(data);
                        var NotifikasiHapusChatBoxBerhasil=$('#NotifikasiHapusChatBoxBerhasil').html();
                        if(NotifikasiHapusChatBoxBerhasil=="Berhasil"){
                            location.reload();
                        }
                    }
                });
            });
        }
    });
});
//Modal Kirim Pesan
$('#ModalKirimPesan').on('show.bs.modal', function (e) {
    var GetDetailNomor=$(e.relatedTarget).data('id');
    var Loading='<div class="modal-body"><div class="row"><div class="col col-md-12 text-center"><div class="spinner-border text-secondary" role="status"><span class="sr-only">Loading...</span></div></div></div></div>';
    $('#FormKirimPesan').html(Loading);
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/WhatsappChatBox/FormKirimPesan.php',
        data        : {GetDetailNomor: GetDetailNomor},
        success     : function(data){
            $('#FormKirimPesan').html(data);
            //Mengirim pesan
            $('#ProsesKirimPesan2').submit(function(){
                $('#NotifikasiKirimPesan2').html('Sedang Mengirim...');
                var form = $('#ProsesKirimPesan2')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/WhatsappChatBox/ProsesKirimPesan2.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiKirimPesan2').html(data);
                        var NotifikasiKirimPesan2Berhasil=$('#NotifikasiKirimPesan2Berhasil').html();
                        if(NotifikasiKirimPesan2Berhasil=="Pesan Berhasil Terkirim!"){
                            location.reload();
                        }
                    }
                });
            });
        }
    });
});