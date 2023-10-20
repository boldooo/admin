<section class="content-header">
    <h1>

        Цэс

        <a href="/admin/menu/create" class="btn btn-success">
            Шинэ
        </a>

    </h1>

</section>

<section class="content">

    <div class="row">

        <div class="col-md-12">

            <div class="box">

                <div class="box-body">

                    <table class="table table-bordered table-hover">

                        <thead>
                            <tr>
                                <th>№</th>
                                <th>Нэр</th>
                                <th>Түлхүүр үг</th>
                                <th>Үйлдэл</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($items as $key => $value)
                                <tr>
                                    <td>
                                        {{ $items->getFrom() + $key }}
                                    </td>
                                    <td>
                                        <a href="/admin/menu/{{ $value->id }}/edit">
                                            {{ $value->title }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $value->key_name }}
                                    </td>
                                    <td class="method">
                                        <a href="/admin/menu_item?menu_id={{ $value->id }}" title="Цааш үзэх">
                                            <i class="fa fa-info-circle"></i>
                                        </a>
                                        <a href="/admin/menu/{{ $value->id }}/edit" title="Засах">
                                            <i class="fa fa-pencil-square-o"></i>
                                        </a>
                                        <a href="javascript:soft_drop('{{ $value->id }}', 'menu')" title="Устгах">
                                            <i class="glyphicon glyphicon-remove-circle pointer"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>

                <div class="box-footer clearfix">

                    {{ $items->appends(Input::all())->links() }}
                    {{ ($items->count() == 0) ? 'Үр дүн олдсонгүй' : '' }}

                </div>
            </div>

        </div>

    </div>

</section>