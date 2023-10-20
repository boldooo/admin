<li class="dd-item" data-id="{{ $item->id }}">

    <i class="icon-note glyphicon glyphicon-edit green" onclick="realtime_edit('{{ $item->id }}', 'menu_item')"
       title="Засах"></i>

    <i class="icon-note glyphicon glyphicon-remove-sign red"
       onclick="realtime_remove(this, '{{ $item->id }}', 'category')" title="Устгах"></i>

    <div class="dd-handle" id="{{ $item->id }}">

        {{ $item->title }}

    </div>

</li>