<div class="modal-header">

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

        <span aria-hidden="true">&times;</span>

    </button>

    <h4 class="modal-title">Шинээр нэмэх</h4>

</div>

{{ Form::open(['url' => '/admin/category', 'method' => 'post', 'id' => 'category']) }}

<input type="hidden" value="{{ $parent_id }}" name="parent_id">

<div class="modal-body">

    <div class="form-body">

        <div class="form-group {{ $errors->has('lang_id') ? 'has-error' : '' }}">

            {{ Form::label('lang_id', 'Хэл') }}

            {{ Form::select('lang_id', ['1' => 'Монгол'], null, ['class' => 'form-control']) }}

            <span class="help-block">

                {{ $errors->has('lang_id') ? $errors->first('lang_id') : '' }}

            </span>

        </div>

        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">

            {{ Form::label('title', 'Нэр') }}

            {{ Form::text('title', Input::get('title'), ['class' => 'form-control', 'placeholder' => 'Нэр']) }}

            <span class="help-block">

                {{ $errors->has('title') ? $errors->first('title') : '' }}

            </span>

        </div>

        @if (Auth::user()->username == 'shinee')

            <div class="form-group {{ $errors->has('key_name') ? 'has-error' : '' }}">

                {{ Form::label('key_name', 'Онцлох үг') }}

                {{ Form::text('key_name', Input::get('key_name'), ['class' => 'form-control', 'placeholder' => 'Онцлох үг']) }}

                <span class="help-block">

                    {{ $errors->has('key_name') ? $errors->first('key_name') : '' }}

                </span>

            </div>

        @endif

        <div class="form-group {{ $errors->has('short_content') ? 'has-error' : '' }}">

            {{ Form::label('short_content', 'Товч мэдээлэл') }}

            <textarea name="short_content" id="short_content" class="ckeditor" cols="30"
                      rows="10">{{ Input::get('short_content') }}</textarea>

            <span class="help-block">

                {{ $errors->has('short_content') ? $errors->first('short_content') : '' }}

            </span>

        </div>

        <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">

            {{ Form::label('content', 'Дэлгэрэнгүй мэдээлэл') }}

            <textarea name="content" id="content" class="ckeditor" cols="30"
                      rows="10">{{ Input::get('content') }}</textarea>

            <span class="help-block">

                {{ $errors->has('content') ? $errors->first('content') : '' }}

            </span>

        </div>

        <div class="form-group {{ $errors->has('link') ? 'has-error' : '' }}">

            {{ Form::label('link', 'Холбоос') }}

            {{ Form::text('link', Input::get('link'), ['class' => 'form-control', 'placeholder' => 'Холбоос']) }}

            <span class="help-block">

                {{ $errors->has('link') ? $errors->first('link') : '' }}

            </span>

        </div>

        @include('backend.contents.media.for_create')

        <div class="form-group">

            {{ Form::label('active', 'Идэвхтэй') }}

            <label>
                <input type="checkbox" value="1" {{ (Input::get('active') == 1) ? 'checked' : '' }} name="active"
                       class="flat-red">
            </label>

        </div>

    </div>

</div>

<div class="modal-footer">

    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
        Хаах
    </button>

    <button type="button" class="btn btn-primary" onclick="custom_submit('category')">
        Хадгалах
    </button>

</div>

{{ Form::close() }}