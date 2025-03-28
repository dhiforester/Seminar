$('#MenampilkanTabelApiKey').html("Loading...");
$('#MenampilkanTabelApiKey').load("_Page/ApiKey/TabelApiKey.php");
$('#batas').change(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelApiKey').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/ApiKey/TabelApiKey.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelApiKey').html(data);
        }
    });
});
$('#ProsesBatas').submit(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelApiKey').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/ApiKey/TabelApiKey.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelApiKey').html(data);
        }
    });
});
$('#ProsesFilterApiKey').submit(function(){
    var batas = $('#FilterBatas').val();
    var OrderBy = $('#OrderBy').val();
    var ShortBy = $('#ShortBy').val();
    var KeywordBy = $('#KeywordBy').val();
    var FilterKeyword = $('#FilterKeyword').val();
    $('#MenampilkanTabelApiKey').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/ApiKey/TabelApiKey.php',
        data 	    :  {batas: batas, OrderBy: OrderBy, ShortBy: ShortBy, KeywordBy: KeywordBy, keyword: FilterKeyword},
        success     : function(data){
            $('#MenampilkanTabelApiKey').html(data);
            $('#ModalFilterApiKey').modal('hide');
        }
    });
});
//Tambah ApiKey
$('#ModalTambahApiKey').on('show.bs.modal', function (e) {
    $('#FormTambahApiKey').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/ApiKey/FormTambahApiKey.php',
        success     : function(data){
            $('#FormTambahApiKey').html(data);
            //Kondisi generate apikey
            $('#GenerateApiKey').click(function(){
                $('#GenerateApiKey').html('Generating..');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/ApiKey/ProsesGenerateApiKey.php',
                    success     : function(data){
                        $('#GenerateApiKey').html(data);
                        var NotifikasiGenerateApiKey=$('#NotifikasiGenerateApiKey').html();
                        var ApiKeyIs=$('#ApiKeyIs').html();
                        if(NotifikasiGenerateApiKey=="Generate Success!"){
                            var ApiKeyIsPure= ApiKeyIs.replace(/[^\w\s]/gi, '');
                            $('#GenerateApiKey').html('<a href="javascript:void(0);" id="GenerateApiKey">Click here to re-generate</a>');
                            $('#api_key').val(ApiKeyIsPure);
                        }
                    }
                });
            });
            //Proses Tambah ApiKey
            $('#ProsesTambahApiKey').submit(function(){
                $('#NotifikasiTambahApiKey').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesTambahApiKey')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/ApiKey/ProsesTambahApiKey.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiTambahApiKey').html(data);
                        var NotifikasiTambahApiKeyBerhasil=$('#NotifikasiTambahApiKeyBerhasil').html();
                        if(NotifikasiTambahApiKeyBerhasil=="Success"){
                            $('#ModalTambahApiKey').modal('toggle');
                            $('#MenampilkanTabelApiKey').load("_Page/ApiKey/TabelApiKey.php");
                            swal("Good Job!", "Add API Key Success!", "success");
                        }
                    }
                });
            });
        }
    });
});
//Detail ApiKey
$('#ModalDetailApiKey').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    var pecah = GetData.split(",");
    var id_ApiKey = pecah[0];
    $('#FormDetailApiKey').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/ApiKey/FormDetailApiKey.php',
        data        : {id_ApiKey: id_ApiKey},
        success     : function(data){
            $('#FormDetailApiKey').html(data);
        }
    });
});
//Edit ApiKey
$('#ModalEditApiKey').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    var pecah = GetData.split(",");
    var id_setting_api_key = pecah[0];
    var keyword = pecah[1];
    var batas = pecah[2];
    var ShortBy = pecah[3];
    var OrderBy = pecah[4];
    var page = pecah[5];
    var posisi = pecah[6];
    var keyword_by = pecah[7];
    $('#FormEditApiKey').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/ApiKey/FormEditApiKey.php',
        data        : {id_setting_api_key: id_setting_api_key},
        success     : function(data){
            $('#FormEditApiKey').html(data);
            //Kondisi generate apikey
            $('#GenerateApiKeyEdit').click(function(){
                $('#GenerateApiKeyEdit').html('Generating..');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/ApiKey/ProsesGenerateApiKey.php',
                    success     : function(data){
                        $('#GenerateApiKeyEdit').html(data);
                        var NotifikasiGenerateApiKeyEdit=$('#NotifikasiGenerateApiKey').html();
                        var ApiKeyIsEdit=$('#ApiKeyIs').html();
                        if(NotifikasiGenerateApiKeyEdit=="Generate Success!"){
                            var ApiKeyIsPure= ApiKeyIsEdit.replace(/[^\w\s]/gi, '');
                            $('#GenerateApiKeyEdit').html('<a href="javascript:void(0);" id="GenerateApiKeyEdit">Click here to re-generate</a>');
                            $('#api_key_edit').val(ApiKeyIsEdit);
                        }
                    }
                });
            });
            //Proses Tambah ApiKey
            $('#ProsesEditApiKey').submit(function(){
                $('#NotifikasiEditApiKey').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                var form = $('#ProsesEditApiKey')[0];
                var data = new FormData(form);
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/ApiKey/ProsesEditApiKey.php',
                    data 	    :  data,
                    cache       : false,
                    processData : false,
                    contentType : false,
                    enctype     : 'multipart/form-data',
                    success     : function(data){
                        $('#NotifikasiEditApiKey').html(data);
                        var NotifikasiEditApiKeyBerhasil=$('#NotifikasiEditApiKeyBerhasil').html();
                        if(NotifikasiEditApiKeyBerhasil=="Success"){
                            $('#MenampilkanTabelApiKey').html("Loading...");
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/ApiKey/TabelApiKey.php',
                                data 	    :  {keyword: keyword, batas: batas, ShortBy: ShortBy, OrderBy: OrderBy, page: page, posisi: posisi, keyword_by: keyword_by},
                                success     : function(data){
                                    $('#MenampilkanTabelApiKey').html(data);
                                    $('#ModalEditApiKey').modal('hide');
                                    swal("Good Job!", "Edit Api Key Success!", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});
//Hapus ApiKey
$('#ModalDeleteApiKey').on('show.bs.modal', function (e) {
    var GetData = $(e.relatedTarget).data('id');
    var pecah = GetData.split(",");
    var id_setting_api_key = pecah[0];
    var keyword = pecah[1];
    var batas = pecah[2];
    var ShortBy = pecah[3];
    var OrderBy = pecah[4];
    var page = pecah[5];
    var posisi = pecah[6];
    var keyword_by = pecah[7];
    $('#FormDeleteApiKey').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/ApiKey/FormDeleteApiKey.php',
        data        : {id_setting_api_key: id_setting_api_key},
        success     : function(data){
            $('#FormDeleteApiKey').html(data);
            //Konfirmasi Hapus ApiKey
            $('#KonfirmasiHapusApiKey').click(function(){
                $('#NotifikasiHapusApiKey').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/ApiKey/ProsesHapusApiKey.php',
                    data        : {id_setting_api_key: id_setting_api_key},
                    success     : function(data){
                        $('#NotifikasiHapusApiKey').html(data);
                        var NotifikasiHapusApiKeyBerhasil=$('#NotifikasiHapusApiKeyBerhasil').html();
                        if(NotifikasiHapusApiKeyBerhasil=="Success"){
                            $.ajax({
                                type 	    : 'POST',
                                url 	    : '_Page/ApiKey/TabelApiKey.php',
                                data 	    :  {keyword: keyword, batas: batas, ShortBy: ShortBy, OrderBy: OrderBy, page: page, posisi: posisi, keyword_by: keyword_by},
                                success     : function(data){
                                    $('#MenampilkanTabelApiKey').html(data);
                                    $('#ModalDeleteApiKey').modal('hide');
                                    swal("Good Job!", "Delete API Key Success!", "success");
                                }
                            });
                        }
                    }
                });
            });
        }
    });
});