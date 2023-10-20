<div class="modal-header">

    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

        <span aria-hidden="true">&times;</span>

    </button>

    <h4 class="modal-title">Шинээр нэмэх</h4>

</div>


{{ Form::open(['url' => '/admin/menu_item', 'method' => 'post', 'id' => 'menu_item']) }}

<div class="modal-body">

    <div class="form-body">

        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">

            {{ Form::label('title', 'Нэр') }}

            {{ Form::text('title', Input::get('title'), ['class' => 'form-control', 'placeholder' => 'Нэр']) }}

            <span class="help-block">

                {{ $errors->has('title') ? $errors->first('title') : '' }}

            </span>

        </div>

        @include('backend.contents.media.for_create')

        <div class="row">

            <div class="col-md-6">

                <div class="form-group">

                    <label for="">Ангилал</label>

                    <div class="category-item">

                        <select name="" id="" class="form-control from-category" data-parent="0"
                                onchange="category_event_checker(this)">
                            <option value="">---</option>
                        </select>

                    </div>

                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">

                    <label for="">Нийтлэл</label>

                    <select name="" id="" class="form-control from-posts" onchange="post_event_checker(this)">
                        <option value="">---</option>
                    </select>

                </div>

            </div>

        </div>

        <div class="form-group {{ $errors->has('link') ? 'has-error' : '' }}">

            {{ Form::label('link', 'Холбоос') }}

            {{ Form::text('link', Input::get('link'), ['class' => 'form-control', 'placeholder' => 'Холбоос']) }}

            <span class="help-block">

                {{ $errors->has('link') ? $errors->first('link') : '' }}

            </span>

            <p class="margin">

                Бүтэн холбоос
                <code>{{ url() }}</code>

            </p>

        </div>

        <input type="hidden" value="{{ $menu_id }}" name="menu_id">

        <input type="hidden" value="{{ url() }}" id="url">

    </div>

</div>

<div class="modal-footer">

    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">
        Хаах
    </button>

    <button type="button" class="btn btn-primary" onclick="custom_submit('menu_item')">
        Хадгалах
    </button>

</div>

{{ Form::close() }}