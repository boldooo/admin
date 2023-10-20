<section class="content-header">
    <h1>
        Цэс
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div id="nestable_list_menu">

                        <button type="button" class="btn btn-primary" data-action="expand-all">
                            Бүгдийг нээх
                        </button>

                        <button type="button" class="btn btn-primary" data-action="collapse-all">
                            Бүгдийг хаах
                        </button>

                    </div>
                </div>
                <div class="box-body">

                    <div class="tools">

                        <button type="button" class="btn btn-success"
                                onclick="show_modal('menu_item', 'menu_id={{ Input::get('menu_id') }}')">
                            Шинээр нэмэх
                        </button>

                        <button type="button" class="btn btn-danger" onclick="save_level('menu_item_level', 0)">
                            Хадгалах
                        </button>

                        <div class="loading">
                            <img src="/backend/img/loading.gif" alt="Хадгалж байна...">
                            <span class="red">Хадгалж байна...</span>
                        </div>

                    </div>

                    <div class="dd" id="nestable_list_1">

                        <ol class="dd-list">

                            @foreach ($items as $key => $value)

                                <li class="dd-item" data-id="{{ $value->id }}">

                                    <i class="icon-note glyphicon glyphicon-edit green"
                                       onclick="realtime_edit('{{ $value->id }}', 'menu_item')" title="Засах"></i>

                                    <i class="icon-note glyphicon glyphicon-remove-sign red"
                                       onclick="realtime_remove(this, '{{ $value->id }}', 'menu_item')"
                                       title="Устгах"></i>

                                    <div class="dd-handle" id="{{ $value->id }}">

                                        {{ $value->title }}

                                    </div>

                                    @if ($value->hasChildren($value->id))

                                        {{ getSubs($value) }}

                                    @endif

                                </li>

                            @endforeach

                        </ol>

                    </div>

                    <?php

                    function getSubs($parent)
                    {

                    ?>

                    <ol class="dd-list">

                        @foreach ($parent->getChildren($parent->id) as $parent_value)

                            <li class="dd-item" data-id="{{ $parent_value->id }}">

                                <i class="icon-note glyphicon glyphicon-edit green"
                                   onclick="realtime_edit('{{ $parent_value->id }}', 'menu_item')" title="Засах"></i>

                                <i class="icon-note glyphicon glyphicon-remove-sign red"
                                   onclick="realtime_remove(this, '{{ $parent_value->id }}', 'menu_item')"
                                   title="Устгах"></i>

                                <div class="dd-handle" id="{{ $parent_value->id }}">

                                    {{ $parent_value->title }}

                                </div>

                                @if ($parent_value->hasChildren($parent_value->id))

                                    {{ getSubs($parent_value) }}

                                @endif

                            </li>

                        @endforeach

                    </ol>

                    <?php

                    }

                    ?>

                </div>
            </div>
        </div>
    </div>
</section>