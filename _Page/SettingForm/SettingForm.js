$('#MenampilkanTabelSettingForm').html("Loading...");
$('#MenampilkanTabelSettingForm').load("_Page/SettingForm/TabelSettingForm.php");
$('#batas').change(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelSettingForm').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/SettingForm/TabelSettingForm.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelSettingForm').html(data);
        }
    });
});
$('#ProsesBatas').submit(function(){
    var ProsesBatas = $('#ProsesBatas').serialize();
    $('#MenampilkanTabelSettingForm').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/SettingForm/TabelSettingForm.php',
        data 	    :  ProsesBatas,
        success     : function(data){
            $('#MenampilkanTabelSettingForm').html(data);
        }
    });
});
$('#ProsesFilterTamplate').submit(function(){
    var batas = $('#FilterBatas').val();
    var OrderBy = $('#OrderBy').val();
    var ShortBy = $('#ShortBy').val();
    var KeywordBy = $('#KeywordBy').val();
    var FilterKeyword = $('#FilterKeyword').val();
    $('#MenampilkanTabelSettingForm').html('Loading...');
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/SettingForm/TabelSettingForm.php',
        data 	    :  {batas: batas, OrderBy: OrderBy, ShortBy: ShortBy, keyword_by: KeywordBy, keyword: FilterKeyword},
        success     : function(data){
            $('#MenampilkanTabelSettingForm').html(data);
            $('#ModalFilterTamplate').modal('hide');
        }
    });
});
//Detail Event
$('#ModalDetailTamplate').on('show.bs.modal', function (e) {
    var id_tamplate = $(e.relatedTarget).data('id');
    $('#FormDetailTamplate').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/SettingForm/FormDetailTamplate.php',
        data        : {id_tamplate: id_tamplate},
        success     : function(data){
            $('#FormDetailTamplate').html(data);
        }
    });
});
tinymce.init({
    selector: '#form_tamplate',
    plugins: [
        'advlist autolink link image lists charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
        'table emoticons template paste help'
    ],
    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
    'bullist numlist outdent indent | link image | print preview media fullscreen charmap | ' +
    'forecolor backcolor emoticons | help',
    menu: {
        favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons'}
    },
    menubar: 'favs file edit view insert format tools table help',
    content_css: 'assets/css/tinymce.css',
    images_upload_url: '_Page/PostAcceptor/PostAcceptor.php',
    images_upload_credentials: true,
    images_reuse_filename: true,
    image_title: true,
    /* enable automatic uploads of images represented by blob or data URIs*/
    automatic_uploads: true,
    /*
        URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
        images_upload_url: 'postAcceptor.php',
        here we add custom filepicker only to Image dialog
    */
    file_picker_types: 'image',
    /* and here's our custom image picker*/
    file_picker_callback: function (cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');

        /*
        Note: In modern browsers input[type="file"] is functional without
        even adding it to the DOM, but that might not be the case in some older
        or quirky browsers like IE, so you might want to add it to the DOM
        just in case, and visually hide it. And do not forget do remove it
        once you do not need it anymore.
        */

        input.onchange = function () {
        var file = this.files[0];

        var reader = new FileReader();
        reader.onload = function () {
            /*
            Note: Now we need to register the blob in TinyMCEs image blob
            registry. In the next release this part hopefully won't be
            necessary, as we are looking to handle it internally.
            */
            var id = 'blobid' + (new Date()).getTime();
            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
            var base64 = reader.result.split(',')[1];
            var blobInfo = blobCache.create(id, file, base64);
            blobCache.add(blobInfo);

            /* call the callback and populate the Title field with the file name */
            cb(blobInfo.blobUri(), { title: file.name });
        };
        reader.readAsDataURL(file);
        };

        input.click();
    },
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
    height : "480"
});
tinymce.init({
    selector: '#response_api',
    plugins: [
        'advlist autolink link image lists charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
        'table emoticons template paste help'
    ],
    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
    'bullist numlist outdent indent | link image | print preview media fullscreen charmap | ' +
    'forecolor backcolor emoticons | help',
    menu: {
        favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons'}
    },
    menubar: 'favs file edit view insert format tools table help',
    content_css: 'assets/css/tinymce.css',
    images_upload_url: '_Page/PostAcceptor/PostAcceptor.php',
    images_upload_credentials: true,
    images_reuse_filename: true,
    image_title: true,
    /* enable automatic uploads of images represented by blob or data URIs*/
    automatic_uploads: true,
    /*
        URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
        images_upload_url: 'postAcceptor.php',
        here we add custom filepicker only to Image dialog
    */
    file_picker_types: 'image',
    /* and here's our custom image picker*/
    file_picker_callback: function (cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');

        /*
        Note: In modern browsers input[type="file"] is functional without
        even adding it to the DOM, but that might not be the case in some older
        or quirky browsers like IE, so you might want to add it to the DOM
        just in case, and visually hide it. And do not forget do remove it
        once you do not need it anymore.
        */

        input.onchange = function () {
        var file = this.files[0];

        var reader = new FileReader();
        reader.onload = function () {
            /*
            Note: Now we need to register the blob in TinyMCEs image blob
            registry. In the next release this part hopefully won't be
            necessary, as we are looking to handle it internally.
            */
            var id = 'blobid' + (new Date()).getTime();
            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
            var base64 = reader.result.split(',')[1];
            var blobInfo = blobCache.create(id, file, base64);
            blobCache.add(blobInfo);

            /* call the callback and populate the Title field with the file name */
            cb(blobInfo.blobUri(), { title: file.name });
        };
        reader.readAsDataURL(file);
        };

        input.click();
    },
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
    height : "480"
});

//Kondisi pada saat halaman edit dibuka
var GetFormmedrek=$("#GetFormmedrek").html();
var GetResponseApiDoc=$("#GetResponseApiDoc").html();
tinymce.init({
    selector: '#get_setting_form',
    setup: function (editor) {
        editor.on('init', function (e) {
            editor.setContent(GetFormmedrek);
        });
    },
    plugins: [
        'advlist autolink link image lists charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
        'table emoticons template paste help'
    ],
    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
    'bullist numlist outdent indent | link image | print preview media fullscreen charmap | ' +
    'forecolor backcolor emoticons | help',
    menu: {
        favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons'}
    },
    menubar: 'favs file edit view insert format tools table help',
    content_css: 'assets/css/tinymce.css',
    images_upload_url: '_Page/PostAcceptor/PostAcceptor.php',
    images_upload_credentials: true,
    images_reuse_filename: true,
    image_title: true,
    /* enable automatic uploads of images represented by blob or data URIs*/
    automatic_uploads: true,
    /*
        URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
        images_upload_url: 'postAcceptor.php',
        here we add custom filepicker only to Image dialog
    */
    file_picker_types: 'image',
    /* and here's our custom image picker*/
    file_picker_callback: function (cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');

        /*
        Note: In modern browsers input[type="file"] is functional without
        even adding it to the DOM, but that might not be the case in some older
        or quirky browsers like IE, so you might want to add it to the DOM
        just in case, and visually hide it. And do not forget do remove it
        once you do not need it anymore.
        */

        input.onchange = function () {
        var file = this.files[0];

        var reader = new FileReader();
        reader.onload = function () {
            /*
            Note: Now we need to register the blob in TinyMCEs image blob
            registry. In the next release this part hopefully won't be
            necessary, as we are looking to handle it internally.
            */
            var id = 'blobid' + (new Date()).getTime();
            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
            var base64 = reader.result.split(',')[1];
            var blobInfo = blobCache.create(id, file, base64);
            blobCache.add(blobInfo);

            /* call the callback and populate the Title field with the file name */
            cb(blobInfo.blobUri(), { title: file.name });
        };
        reader.readAsDataURL(file);
        };

        input.click();
    },
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
    height : "480"
});
tinymce.init({
    selector: '#get_response_api',
    setup: function (editor) {
        editor.on('init', function (e) {
            editor.setContent(GetResponseApiDoc);
        });
    },
    plugins: [
        'advlist autolink link image lists charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
        'table emoticons template paste help'
    ],
    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
    'bullist numlist outdent indent | link image | print preview media fullscreen charmap | ' +
    'forecolor backcolor emoticons | help',
    menu: {
        favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons'}
    },
    menubar: 'favs file edit view insert format tools table help',
    content_css: 'assets/css/tinymce.css',
    images_upload_url: '_Page/PostAcceptor/PostAcceptor.php',
    images_upload_credentials: true,
    images_reuse_filename: true,
    image_title: true,
    /* enable automatic uploads of images represented by blob or data URIs*/
    automatic_uploads: true,
    /*
        URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
        images_upload_url: 'postAcceptor.php',
        here we add custom filepicker only to Image dialog
    */
    file_picker_types: 'image',
    /* and here's our custom image picker*/
    file_picker_callback: function (cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');

        /*
        Note: In modern browsers input[type="file"] is functional without
        even adding it to the DOM, but that might not be the case in some older
        or quirky browsers like IE, so you might want to add it to the DOM
        just in case, and visually hide it. And do not forget do remove it
        once you do not need it anymore.
        */

        input.onchange = function () {
        var file = this.files[0];

        var reader = new FileReader();
        reader.onload = function () {
            /*
            Note: Now we need to register the blob in TinyMCEs image blob
            registry. In the next release this part hopefully won't be
            necessary, as we are looking to handle it internally.
            */
            var id = 'blobid' + (new Date()).getTime();
            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
            var base64 = reader.result.split(',')[1];
            var blobInfo = blobCache.create(id, file, base64);
            blobCache.add(blobInfo);

            /* call the callback and populate the Title field with the file name */
            cb(blobInfo.blobUri(), { title: file.name });
        };
        reader.readAsDataURL(file);
        };

        input.click();
    },
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }',
    height : "480"
});
//Proses Simpan konten Dokumentasi
$('#ClickSimpanFormSetting').click(function(){
    $('#NotifikasiTambahSettingForm').html('<span class="text-primary">Loading..</span>');
    var nama_tamplate=$('#nama_tamplate').val();
    var kategori_tamplate=$('#kategori_tamplate').val();
    var deskripsi_tamplate=$('#deskripsi_tamplate').val();
    var form_tamplate = tinymce.get("form_tamplate").getContent();
    $.ajax({
        type    : 'POST',
        url     : "_Page/SettingForm/ProsesTambahSettingForm.php",
        data    : {nama_tamplate: nama_tamplate, kategori_tamplate: kategori_tamplate, deskripsi_tamplate: deskripsi_tamplate, form_tamplate: form_tamplate},
        success: function(data) {
            $('#NotifikasiTambahSettingForm').html(data);
            var NotifikasiTambahSettingFormBerhasil=$('#NotifikasiTambahSettingFormBerhasil').html();
            if(NotifikasiTambahSettingFormBerhasil=="Success"){
                window.location.href = "index.php?Page=SettingForm";
            }
        }
    });
});
//Proses Simpan konten Dokumentasi editor
$('#ClickEditFormSetting').click(function(){
    $('#NotifikasiEditSettingForm').html('Loading..');
    var id_tamplate=$('#id_tamplate').val();
    var nama_tamplate=$('#nama_tamplate').val();
    var kategori_tamplate=$('#kategori_tamplate').val();
    var deskripsi_tamplate=$('#deskripsi_tamplate').val();
    var get_setting_form = tinymce.get("get_setting_form").getContent();
    $.ajax({
        type    : 'POST',
        url     : "_Page/SettingForm/ProsesEditSettingForm.php",
        data    : {id_tamplate: id_tamplate, nama_tamplate: nama_tamplate, kategori_tamplate: kategori_tamplate, deskripsi_tamplate: deskripsi_tamplate, form_tamplate: get_setting_form},
        success: function(data) {
            $('#NotifikasiEditSettingForm').html(data);
            var NotifikasiEditSettingFormBerhasil=$('#NotifikasiEditSettingFormBerhasil').html();
            if(NotifikasiEditSettingFormBerhasil=="Success"){
                window.location.href = "index.php?Page=SettingForm";
            }
        }
    });
});
//Hapus SettingForm
$('#ModalDeleteSettingForm').on('show.bs.modal', function (e) {
    var id_tamplate = $(e.relatedTarget).data('id');
    $('#FormDeleteSettingForm').html("Loading...");
    $.ajax({
        type 	    : 'POST',
        url 	    : '_Page/SettingForm/FormDeleteSettingForm.php',
        data        : {id_tamplate: id_tamplate},
        success     : function(data){
            $('#FormDeleteSettingForm').html(data);
            //Konfirmasi Hapus SettingForm
            $('#KonfirmasiHapusSettingForm').click(function(){
                $('#NotifikasiHapusSettingForm').html('<div class="spinner-border text-secondary" role="status"><span class="sr-only"></span></div>');
                $.ajax({
                    type 	    : 'POST',
                    url 	    : '_Page/SettingForm/ProsesHapusSettingForm.php',
                    data        : {id_tamplate: id_tamplate},
                    success     : function(data){
                        $('#NotifikasiHapusSettingForm').html(data);
                        var NotifikasiHapusSettingFormBerhasil=$('#NotifikasiHapusSettingFormBerhasil').html();
                        if(NotifikasiHapusSettingFormBerhasil=="Success"){
                            window.location.href = "index.php?Page=SettingForm";
                        }
                    }
                });
            });
        }
    });
});