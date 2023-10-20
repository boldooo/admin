<section class="content-header">
    <h1>
        Нийтлэл
        <small>засах</small>
    </h1>
</section>

<section class="content">

    <div class="row">

        <div class="col-md-7">

            <div class="nav-tabs-custom">

                <ul class="nav nav-tabs">

                    <li class="active"><a href="#info" data-toggle="tab">Ерөнхий мэдээлэл</a></li>

                </ul>

                {{ Form::open(['method' => 'put', 'url' => '/admin/posts/' . $item->id, 'files' => true]) }}

                <div class="box-body">

                    <div class="tab-content">

                        <div class="tab-pane active" id="info">

                            <div class="form-group {{ $errors->has('lang_id') ? 'has-error' : '' }}">

                                {{ Form::label('lang_id', 'Хэл') }}

                                {{ Form::select('lang_id', ['1' => 'Монгол'], $item->lang_id, ['class' => 'form-control']) }}

                                <span class="help-block">

                                    {{ $errors->has('lang_id') ? $errors->first('lang_id') : '' }}

                                </span>

                            </div>

                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">

                                {{ Form::label('title', 'Гарчиг') }}

                                {{ Form::text('title', $item->title, ['class' => 'form-control', 'placeholder' => 'Нэр', 'required']) }}

                                <span class="help-block">

                                    {{ $errors->has('title') ? $errors->first('title') : '' }}

                                </span>

                            </div>

                            @include('backend.contents.media.for_edit')

                            <div class="form-group {{ $errors->has('short_content') ? 'has-error' : '' }}">

                                {{ Form::label('short_content', 'Товч мэдээлэл') }}

                                <textarea name="short_content" id="short_content" class="ckeditor" cols="30"
                                          rows="10">{{ $item->short_content }}</textarea>

                                <span class="help-block">

                                    {{ $errors->has('short_content') ? $errors->first('short_content') : '' }}

                                </span>

                            </div>

                            <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">

                                {{ Form::label('content', 'Дэлгэрэнгүй мэдээлэл') }}

                                <textarea name="content" id="content" class="ckeditor" cols="30"
                                          rows="10">{{ $item->content }}</textarea>

                                <span class="help-block">

                                    {{ $errors->has('content') ? $errors->first('content') : '' }}

                                </span>

                            </div>

                            <div class="form-group {{ $errors->has('custom_date') ? 'has-error' : '' }}">

                                {{ Form::label('custom_date', 'Нийтэлсэн огноо') }}

                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" value="{{ substr($item->custom_date, 0, 10) }}"
                                           name="custom_date"
                                           class="form-control pull-right" id="datepicker">
                                </div>

                                <span class="help-block">

                                    {{ $errors->has('custom_date') ? $errors->first('custom_date') : '' }}

                                </span>

                            </div>

                            <div class="form-group">

                                {{ Form::label('category', 'Ангилал') }}

                                <div class="row">

                                    <div class="col-md-6">

                                        <ul class="category_id">

                                            @foreach ($category as $value)

                                                <li id="{{ $value->id }}">

                                                    <?php $has = $value->hasChildren($value->id, $has_posts_in_category) ? true : false ?>

                                                    <span>

                                                        <i class="fa {{ ($has) ? 'fa-minus-circle' : 'fa-plus-circle' }} pointer"
                                                           onclick="get_child('{{ $value->id }}')"></i>

                                                        <input type="checkbox" value="{{ $value->id }}"
                                                               {{ in_array($value->id, $has_posts_in_category) ? 'checked' : '' }}
                                                               name="category_id[]" class="flat-red">

                                                        {{--<i class="fa fa-minus-circle"></i>--}}

                                                        {{ $value->title }}

                                                    </span>

                                                    @if ($has)

                                                        {{ get_child($value, $has_posts_in_category) }}

                                                    @endif

                                                </li>

                                            @endforeach

                                        </ul>

                                    </div>

                                </div>

                                <div class="have">
                                    @foreach ($has_posts_in_category as $value)
                                        <input type="hidden" name="have[]" value="{{ $value }}">
                                    @endforeach
                                </div>

                            </div>

                            <div class="form-group {{ $errors->has('link') ? 'has-error' : '' }}">

                                {{ Form::label('link', 'Холбоос') }}

                                {{ Form::text('link', ($item->link != '' ? '/' . $item->id . '.html' : $item->link), ['class' => 'form-control', 'placeholder' => 'Холбоос']) }}

                                <span class="help-block">

                                    {{ $errors->has('link') ? $errors->first('link') : '' }}

                                </span>

                            </div>

                            <div class="form-group">

                                {{ Form::label('active', 'Идэвхтэй') }}

                                <label>
                                    <input type="checkbox" value="1"
                                           {{ ($item->active == 1) ? 'checked' : '' }} name="active"
                                           class="flat-red">
                                </label>

                            </div>

                            <div class="form-group">

                                {{ Form::submit('Хадгалах', ['class' => 'btn btn-primary']) }}

                            </div>

                        </div>

                    </div>

                </div>

                {{ Form::close() }}

            </div>

        </div>

    </div>

</section>

<?php
function get_child($value, $has_posts_in_category)
{
?>

<ul>

    @foreach ($value->getChildren($value->id) as $v)

        <li id="{{ $v->id }}">

            <?php $has = $v->hasChildren($v->id, $has_posts_in_category) ? true : false ?>

            <span>

                <i class="fa {{ ($has) ? 'fa-minus-circle' : 'fa-plus-circle' }} pointer"
                   onclick="get_child('{{ $v->id }}')"></i>
                <input type="checkbox" value="{{ $v->id }}"
                       {{ in_array($v->id, $has_posts_in_category) ? 'checked' : '' }}
                       name="category_id[]" class="flat-red">
                {{ $v->title }}

            </span>

            @if ($has)

                {{ get_child($v, $has_posts_in_category) }}

            @endif

        </li>

    @endforeach

</ul>

<?php } ?>