<div class="modal-header">

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

        <span aria-hidden="true">&times;</span>

    </button>

    <h4 class="modal-title">Зургийн сан</h4>

</div>
<div class="modal-body">
    <form id="fileupload" action="/admin/media/pictures" method="POST" enctype="multipart/form-data">
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="col-lg-12">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="fa fa-plus"></i>
                    <span>
                        Зураг нэмэх...
                    </span>
                    <input type="file" name="files[]" multiple="">
                </span>
                <button type="submit" class="btn btn-info start">
                    <i class="fa fa-upload"></i>
                    <span>Хуулах</span>
                </button>
                <button type="button" class="btn btn-primary" onclick="writeFiles('{{ $editor or 0 }}')">
                    <i class="fa fa-check-square-o"></i>
                    <span>Сонгох</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="fa fa-ban"></i>
                    <span>Цуцлах</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="fa fa-trash"></i>
                    <span>Устгах</span>
                </button>

                <div class="clearfix"></div>

                <span class="red">
                    Заавар:
                    <br>
                    1. Зураг нэмэх
                    <br>
                    2. Хуулах
                    <br>
                    3. Оруулах зурагны урд байрлах хэсгийг чагтаад "Сонгох" товчийг дарна
                </span>

                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>
            <!-- The global progress information -->
            <div class="col-lg-12 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;">
                    </div>
                </div>
                <!-- The extended global progress information -->
                <div class="progress-extended">
                    &nbsp;
                </div>
            </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped clearfix">
            <thead>
            <tr>
                <td>
                    {{--<div class="fileupload-buttonbar">--}}
                        {{--<input type="checkbox" class="toggle custom-checkbox custom-position" id="all" onchange="custom_check(this)"/>--}}
                        {{--<label for="all" class="custom-position"></label>--}}
                    {{--</div>--}}
                    <div class="fileupload-buttonbar">
                        <input type="checkbox" class="toggle custom-checkbox custom-position" id="check-all">
                        <label for="check-all" class="custom-position"></label>
                    </div>
                </td>
                <td>Зураг</td>
                <td>Гарчиг</td>
                <td>Файлын нэр</td>
                <td>Багтаамж</td>
                <td>Үйлдэл</td>
            </tr>
            </thead>
            <tbody class="files">
            </tbody>
        </table>
    </form>

    <!-- The blueimp Gallery widget -->
    <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
        <div class="slides">
        </div>
        <h3 class="title"></h3>
        <a class="prev">
            ‹ </a>
        <a class="next">
            › </a>
        <a class="close white">
        </a>
        <a class="play-pause">
        </a>
        <ol class="indicator">
        </ol>
    </div>
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
</div>
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td></td>
        <td class="background-gray">
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.title%}</p>
            <strong class="error text-danger label label-danger"></strong>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger label label-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
            </div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-info start" disabled>
                    <i class="fa fa-upload"></i>
                    <span>Хуулах</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="fa fa-ban"></i>
                    <span>Цуцлах</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}


</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-download fade">
            <td>
                {% if (file.deleteUrl) { %}
                    <input type="checkbox" name="delete" value="1" class="toggle custom-checkbox" id="{%=file.name%}">
                    <label for="{%=file.name%}"></label>
                {% } %}
            </td>
            <td class="background-gray">
                <span class="preview">
                    {% if (file.thumbnailUrl) { %}
                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                    {% } %}
                </span>
            </td>
            <td>
                <p class="name">
                    {% if (file.url) { %}
                        <a href="{%=file.url%}" title="{%=file.title%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.title%}</a>
                    {% } else { %}
                        <span>{%=file.name%}</span>
                    {% } %}
                </p>
                {% if (file.error) { %}
                    <div><span class="label label-danger">Алдаа</span> {%=file.error%}</div>
                {% } %}
            </td>
            <td>
                <p class="name">
                    {% if (file.url) { %}
                        <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                    {% } else { %}
                        <span>{%=file.name%}</span>
                    {% } %}
                </p>
                {% if (file.error) { %}
                    <div><span class="label label-danger">Алдаа</span> {%=file.error%}</div>
                {% } %}
            </td>
            <td>
                <span class="size">{%=o.formatFileSize(file.size)%}</span>
            </td>
            <td>
                {% if (file.deleteUrl) { %}
                    <button class="btn btn-danger delete btn-sm" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                        <i class="fa fa-trash-o"></i>
                        <span>Устгах</span>
                    </button>
                {% } else { %}
                    <button class="btn btn-warning cancel btn-sm">
                        <i class="fa fa-ban"></i>
                        <span>Цуцлах</span>
                    </button>
                {% } %}
            </td>
        </tr>
    {% } %}
</script>

<div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
        Хаах
    </button>
</div>