<section class="content-header">
    <h1>
        Хаяг
    </h1>
</section>

<section class="content">

    <div class="row">

        <div class="col-md-6">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title">Шинээр нэмэх</h3>

                    {{ Form::open(['method' => 'post', 'url' => '/admin/contact', 'files' => true]) }}

                    <div class="box-body">

                        <div class="form-group {{ $errors->has('lang_id') ? 'has-error' : '' }}">

                            {{ Form::label('lang_id', 'Хэл') }}

                            {{ Form::select('lang_id', ['1' => 'Монгол'], 1, ['class' => 'form-control']) }}

                            <span class="help-block">

                                {{ $errors->has('lang_id') ? $errors->first('lang_id') : '' }}

                            </span>

                        </div>

                        <div class="form-group {{ $errors->has('facebook') ? 'has-error' : '' }}">

                            {{ Form::label('facebook', 'Facebook') }}

                            {{ Form::text('facebook', Input::get('facebook'), ['class' => 'form-control', 'placeholder' => 'Facebook']) }}

                            <span class="help-block">

                                {{ $errors->has('facebook') ? $errors->first('facebook') : '' }}

                            </span>

                        </div>

                        <div class="form-group {{ $errors->has('twitter') ? 'has-error' : '' }}">

                            {{ Form::label('twitter', 'Twitter') }}

                            {{ Form::text('twitter', Input::get('twitter'), ['class' => 'form-control', 'placeholder' => 'Twitter']) }}

                            <span class="help-block">

                                {{ $errors->has('twitter') ? $errors->first('twitter') : '' }}

                            </span>

                        </div>

                        <div class="form-group {{ $errors->has('youtube') ? 'has-error' : '' }}">

                            {{ Form::label('youtube', 'Youtube') }}

                            {{ Form::text('youtube', Input::get('youtube'), ['class' => 'form-control', 'placeholder' => 'Youtube']) }}

                            <span class="help-block">

                                {{ $errors->has('youtube') ? $errors->first('youtube') : '' }}

                            </span>

                        </div>

                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">

                            {{ Form::label('phone', 'Утас') }}

                            {{ Form::text('phone', Input::get('phone'), ['class' => 'form-control', 'placeholder' => 'Утас']) }}

                            <span class="help-block">

                                {{ $errors->has('phone') ? $errors->first('phone') : '' }}

                            </span>

                        </div>

                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">

                            {{ Form::label('email', 'И-мэйл') }}

                            {{ Form::email('email', Input::get('email'), ['class' => 'form-control', 'placeholder' => 'И-мэйл']) }}

                            <span class="help-block">

                                {{ $errors->has('email') ? $errors->first('email') : '' }}

                            </span>

                        </div>

                        <div class="form-group {{ $errors->has('website') ? 'has-error' : '' }}">

                            {{ Form::label('website', 'Вэб сайт') }}

                            {{ Form::text('website', Input::get('website'), ['class' => 'form-control', 'placeholder' => 'Вэб сайт']) }}

                            <span class="help-block">

                                {{ $errors->has('website') ? $errors->first('website') : '' }}

                            </span>

                        </div>

                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">

                            {{ Form::label('address', 'Дэлгэрэнгүй мэдээлэл') }}

                            <textarea name="address" id="address" class="ckeditor" cols="30"
                                      rows="10"></textarea>

                            <span class="help-block">

                                {{ $errors->has('address') ? $errors->first('address') : '' }}

                            </span>

                        </div>

                        <div class="form-group">

                            {{ Form::submit('Хадгалах', ['class' => 'btn btn-primary']) }}

                        </div>

                    </div>

                    {{ Form::close() }}

                </div>

            </div>

        </div>

    </div>

</section>