$(document).ready(function() {
    tinymce.init({
        selector: "#mytextarea",
        image_dimensions: false,
        relative_urls: false,
        paste_data_images: true,
        image_title: true,
        language: 'ar',
        height : "480",
        automatic_uploads: true,
        fontsize_formats: "8pt 10pt 12pt 14pt 15pt 16pt 17pt 18pt 24pt 36pt",
        images_upload_url: "/post/image/upload",
        file_picker_types: "image",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        image_class_list: [
            {title: 'None', value: ''},
            {title: 'img-fluid', value: 'img-fluid'},
        ],
        toolbar1:
            "insertfile undo redo | styleselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        toolbar2: "print preview media | forecolor backcolor emoticons",
        // override default upload handler to simulate successful upload

        file_picker_callback: function(cb, value, meta) {
            var input = document.createElement("input");

            input.setAttribute("type", "file");
            input.setAttribute("accept", "image/*");
            input.onchange = function() {
                var file = this.files[0];

                var reader = new FileReader();

                reader.readAsDataURL(file);
                reader.onload = function() {
                    var id = "blobid" + new Date().getTime();
                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(",")[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);
                    cb(blobInfo.blobUri(), { title: file.name });
                };
            };
            input.click();
        }
    });
});
