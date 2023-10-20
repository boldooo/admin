<section class="content-header">
    <h1>
        Хэрэглэгч
    </h1>
</section>

<section class="content">

    <div class="row">

        <div class="col-md-6">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title">Засах</h3>

                    {{ Form::open(['method' => 'put', 'url' => '/admin/users/' . $item->id, 'files' => true]) }}

                    <div class="box-body">

                        <div class="form-group {{ $errors->has('lang_id') ? 'has-error' : '' }}">

                            {{ Form::label('lang_id', 'Хэл') }}

                            {{ Form::select('lang_id', ['1' => 'Монгол'], 1, ['class' => 'form-control']) }}

                            <span class="help-block">

                                {{ $errors->has('lang_id') ? $errors->first('lang_id') : '' }}

                            </span>

                        </div>

                        <div class="form-group {{ $errors->has('firstname') ? 'has-error' : '' }}">

                            {{ Form::label('firstname', 'Өөрийн нэр') }}

                            {{ Form::text('firstname', $item->firstname, ['class' => 'form-control', 'placeholder' => 'Өөрийн нэр']) }}

                            <span class="help-block">

                                {{ $errors->has('firstname') ? $errors->first('firstname') : '' }}

                            </span>

                        </div>

                        <div class="form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">

                            {{ Form::label('lastname', 'Овог') }}

                            {{ Form::text('lastname', $item->lastname, ['class' => 'form-control', 'placeholder' => 'Овог']) }}

                            <span class="help-block">

                                {{ $errors->has('lastname') ? $errors->first('lastname') : '' }}

                            </span>

                        </div>

                        <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">

                            {{ Form::label('username', 'Нэвтрэх нэр') }}

                            {{ Form::text('username', $item->username, ['class' => 'form-control', 'placeholder' => 'Нэвтрэх нэр']) }}

                            <span class="help-block">

                                {{ $errors->has('username') ? $errors->first('username') : '' }}

                            </span>

                        </div>

                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">

                            {{ Form::label('phone', 'Утас') }}

                            {{ Form::text('phone', $item->phone, ['class' => 'form-control', 'placeholder' => 'Утас']) }}

                            <span class="help-block">

                                {{ $errors->has('phone') ? $errors->first('phone') : '' }}

                            </span>

                        </div>

                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">

                            {{ Form::label('email', 'И-мэйл') }}

                            {{ Form::email('email', $item->email, ['class' => 'form-control', 'placeholder' => 'И-мэйл']) }}

                            <span class="help-block">

                                {{ $errors->has('email') ? $errors->first('email') : '' }}

                            </span>

                        </div>

                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">

                            {{ Form::label('password', 'Нууц үг') }}

                            {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Нууц үг']) }}

                            <span class="help-block">

                                {{ $errors->has('password') ? $errors->first('password') : '' }}

                            </span>

                        </div>

                        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">

                            {{ Form::label('password_confirmation', 'Нууц үгээ дахин оруулна уу') }}

                            {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Нууц үгээ дахин оруулна уу']) }}

                            <span class="help-block">

                                {{ $errors->has('password_confirmation') ? $errors->first('password_confirmation') : '' }}

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