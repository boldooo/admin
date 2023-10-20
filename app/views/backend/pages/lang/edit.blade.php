<section class="content-header">
    <h1>
        Хэл
    </h1>
</section>

<section class="content">

    <div class="row">

        <div class="col-md-6">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title">Засах</h3>

                    {{ Form::open(['method' => 'put', 'url' => '/admin/lang/' . $item->id, 'files' => true]) }}

                    <div class="box-body">

                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">

                            {{ Form::label('title', 'Нэр') }}

                            {{ Form::text('title', $item->title, ['class' => 'form-control', 'id' => 'title', 'placeholder' => 'Нэр', 'required']) }}

                            <span class="help-block">

                                {{ $errors->has('title') ? $errors->first('title') : '' }}

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