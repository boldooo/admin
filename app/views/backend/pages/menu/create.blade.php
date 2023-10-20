<section class="content-header">
    <h1>
        Цэс
    </h1>
</section>

<section class="content">

    <div class="row">

        <div class="col-md-6">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title">Шинээр нэмэх</h3>

                    {{ Form::open(['method' => 'post', 'url' => '/admin/menu', 'files' => true]) }}

                    <div class="box-body">

                        <div class="form-group {{ $errors->has('lang_id') ? 'has-error' : '' }}">

                            {{ Form::label('lang_id', 'Хэл') }}

                            {{ Form::select('lang_id', ['1' => 'Монгол'], 1, ['class' => 'form-control']) }}

                            <span class="help-block">

                                {{ $errors->has('lang_id') ? $errors->first('lang_id') : '' }}

                            </span>

                        </div>

                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">

                            {{ Form::label('title', 'Нэр') }}

                            {{ Form::text('title', Input::get('title'), ['class' => 'form-control', 'placeholder' => 'Нэр', 'required']) }}

                            <span class="help-block">

                                {{ $errors->has('title') ? $errors->first('title') : '' }}

                            </span>

                        </div>

                        <div class="form-group {{ $errors->has('key_name') ? 'has-error' : '' }}">

                            {{ Form::label('key_name', 'Түлхүүр үг') }}

                            {{ Form::text('key_name', Input::get('key_name'), ['class' => 'form-control', 'placeholder' => 'Түлхүүр үг', 'required']) }}

                            <span class="help-block">

                                {{ $errors->has('key_name') ? $errors->first('key_name') : '' }}

                            </span>

                        </div>

                        <div class="form-group">

                            {{ Form::submit('Хадгалах', ['class' => 'btn btn-primary']) }}

                            <a href="{{ URL::previous() }}" class="btn btn-danger">Буцах</a>

                        </div>

                    </div>

                    {{ Form::close() }}

                </div>

            </div>

        </div>

    </div>

</section>