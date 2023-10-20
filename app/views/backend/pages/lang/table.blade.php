<section class="content-header">
    <h1>

        Хэл

        <a href="/admin/lang/create" class="btn btn-success">
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
                                        <a href="/admin/lang/{{ $value->id }}/edit">
                                            {{ $value->title }}
                                        </a>
                                    </td>
                                    <td>

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
