<section class="content-header">

    <h1>

        Хаяг

        <a href="/admin/contact/create" class="btn btn-success">
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
                            <th>Хаяг</th>
                            <th>Холбоо барих утас</th>
                            <th>Facebook</th>
                            <th>Email</th>
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
                                    <a href="/admin/contact/{{ $value->id }}/edit">
                                        {{ $value->address }}
                                    </a>
                                </td>
                                <td>
                                    {{ $value->phone }}
                                </td>
                                <td>
                                    {{ $value->facebook }}
                                </td>
                                <td>
                                    {{ $value->email }}
                                </td>
                                <td class="method">
                                    <a href="/admin/contact/{{ $value->id }}/edit">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </a>
                                    <a href="javascript:soft_drop('{{ $value->id }}', 'contact')">
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
