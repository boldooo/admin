<section class="content-header">

    <h1>
        Нийтлэл

        <a href="/admin/posts/create" class="btn btn-success">
            Шинэ
        </a>

    </h1>

</section>

<section class="content">

    <div class="row">

        <div class="col-md-12">

            <div class="box">

                <div class="box-body">

                    <form action="" class="form-inline margin-bottom pull-right">

                        <div class="form-group not-inline">

                            <select class="form-control" onchange="_category_children(this)">

                                <option value="">---</option>

                                @foreach ($categories as $value)

                                    <option value="{{ $value->id }}">
                                        {{ $value->title }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <input type="hidden" value="{{ Request::get('category_id') }}" name="category_id"
                               id="category_id">

                        <input type="text" value="{{ Request::get('title') }}" class="form-control" name="title"
                               placeholder="хайх">

                        <input type="submit" value="Хайх" class="btn btn-primary">

                    </form>

                    <table class="table table-bordered table-hover">

                        <thead>
                        <tr>
                            <th style="width: 10px;">№</th>
                            <th>Гарчиг</th>
                            <th>Ангилал</th>
                            <th>Хуваалцах</th>
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
                                    <a href="/admin/posts/{{ $value->id }}/edit">
                                        {{ $value->title }}
                                    </a>
                                </td>
                                <td>
                                    @foreach ($value->posts_in_category() as $val)
                                        <span class="label label-primary">{{ $val->title }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <ul class="follow-buttons">
                                        <li>
                                            <div class="fb-share-button"
                                                 data-href="/{{ $value->id }}.html"
                                                 data-layout="button_count">
                                            </div>
                                        </li>
                                        <li>
                                            <a class="twitter-share-button"
                                               href="https://twitter.com/leovit_edem?text={{ $value->title }}&url={{ url($value->id) }}.html">
                                                Tweet
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                                <td class="method">
                                    <a href="/admin/posts/{{ $value->id }}/edit">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </a>
                                    <a href="javascript:soft_drop('{{ $value->id }}', 'posts')">
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
