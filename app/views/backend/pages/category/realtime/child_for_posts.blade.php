@if ($category->count() > 0)
    <ul>
        @foreach ($category as $value)
            <li id="{{ $value->id }}">
                <span>
                    <i class="fa fa-plus-circle pointer" onclick="get_child('{{ $value->id }}')"></i>
                    <input type="checkbox" value="{{ $value->id }}"
                           {{ in_array($value->id, $has_posts_in_category) ? 'checked' : '' }}
                           name="category_id[]" class="flat-red">
                    {{ $value->title }}
                </span>
            </li>
        @endforeach
    </ul>
@endif