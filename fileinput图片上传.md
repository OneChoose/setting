# fileinput bootstrap 图片上传

# html代码

    <input type="file" id="image" multiple data-mix-file-count="1" />
    <input type="hidden" id="image_action"/>
  
# 引入js和css

    <link rel="stylesheet" href="/Public/admin/fileinput/fileinput.min.css">
    <script src="/Public/admin/fileinput/fileinput.min.js"></script>
  
# js代码
 
        $("#image").fileinput({
            overwriteInitial: true,
            dropZoneEnabled: false,
            uploadUrl: '/admin/upload/index/"',
            language: 'zh',
            showRemove: false,
            mixFileCount: 1,
            browseClass: 'btn btn-primary btn-docup',
            showPreview: true,
            uploadClass: 'btn btn-default btn-docup',
            allowedFileTypes: ["image"],
            browseLabel: "添加图片",
            uploadLabel: "上传图片",

        }).on("fileuploaded", function (event, data, previewId, index) {
            var response = data.response;
            if (data.jqXHR.status == 200) {
                // ajax 成功返回数据写入
                $('.file-preview-frame').eq(index).append("<input class='abc' type='hidden' name='cat_name[]' value='"+response+"'>");
            }
        });
        $("#image").on('filecleared', function(event) {
            $("#image_action").val(1);
        });
