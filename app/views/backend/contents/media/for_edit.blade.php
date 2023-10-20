<div class="form-group">

    {{ Form::label('picture', 'Нүүрэнд гарах зураг') }}

    <div class="clearfix"></div>

    <img src="{{ PostImage::_src('pictures', $item->picture) }}" alt="{{ PostImage::_alt('picture', $item->picture) }}"
         class="input-picture picture">

    <input type="hidden" name="picture" value="{{ ($item->picture != '') ? $item->picture : '' }}" id="picture">

    <div class="clearfix"></div>

    <button class="btn btn-primary" type="button" onclick="upload_images('picture')">

        Энд дарж сонгоно уу

    </button>

    <button class="btn btn-danger" type="button" onclick="clear_pic('picture')" id="clear_pictures">

        Зургийн арилгах

    </button>

</div>

<div class="form-group">

    {{ Form::label('_picture', 'Туслах зураг') }}

    <div class="clearfix"></div>

    <img src="{{ PostImage::_src('pictures', $item->_picture) }}" alt="{{ PostImage::_alt('picture', $item->_picture) }}"
         class="input-picture _picture">

    <input type="hidden" name="_picture" value="{{ ($item->_picture != '') ? $item->_picture : '' }}" id="_picture">

    <div class="clearfix"></div>

    <button class="btn btn-primary" type="button" onclick="upload_images('_picture')">

        Энд дарж сонгоно уу

    </button>

    <button class="btn btn-danger" type="button" onclick="clear_pic('_picture')" id="clear_pictures">

        Зургийн арилгах

    </button>

</div>