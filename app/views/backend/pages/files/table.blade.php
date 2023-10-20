<section class="content-header">

    <h1>

        Файл

        <a href="/admin/files/create" class="btn btn-success">
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
                            <th style="width: 10px;">№</th>
                            <th>Гарчиг</th>
                            <th>Файлын нэр</th>
                            <th style="width: 40px;">Үйлдэл</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($items as $key => $value)
                            <tr>
                                <td>
                                    {{ $items->getFrom() + $key }}
                                </td>
                                <td>
                                    <a href="/admin/files/{{ $value->id }}/edit">
                                        {{ $value->title }}
                                    </a>
                                </td>
                                <td>
                                    {{ url('backend/files/' . $value->filename) }}
                                </td>
                                <td class="method">
                                    <a href="/admin/files/{{ $value->id }}/edit">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </a>
                                    <a href="javascript:soft_drop('{{ $value->id }}', 'files')">
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
