@if ($paginator->getLastPage() > 1)
    <div class="pagination">
        <ul class="pagination pagination-sm no-margin pull-right">
            <?php
            $start = $paginator->getCurrentPage() - 3;
            $end = $paginator->getCurrentPage() + 3;
            if ($start < 1) $start = 1;
            if ($end >= $paginator->getLastPage()) $end = $paginator->getLastPage();
            ?>
            <li class="pagination-left {{ ($paginator->getCurrentPage() == 1) ? ' disabled' : '' }}">
                <a href="{{ $paginator->getUrl(1) }}"><i class="icon left arrow"></i> <<
                </a>
            </li>
            @if($start > 1)
                <li>
                    <a href="{{ $paginator->getUrl(1) }}">{{ 1 }}</a>
                </li>
                <li>
                    <a>...</a>
                </li>
            @endif
            @for ($i = $start; $i <= $end; $i++)
                <li class="{{ ($paginator->getCurrentPage() == $i) ? 'active' : '' }}">
                    <a href="{{ $paginator->getUrl($i) }}">{{ $i }}</a>
                </li>
            @endfor
            @if($end<$paginator->getLastPage())
                <li>
                    <a>...</a>
                </li>
                <li>
                    <a href="{{ $paginator->getUrl($paginator->getLastPage()) }}">{{ $paginator->getLastPage() }}</a>
                </li>
            @endif
            <li class="pagination-right {{ ($paginator->getCurrentPage() == $paginator->getLastPage()) ? ' disabled' : '' }}">
                <a href="{{ $paginator->getUrl($paginator->getCurrentPage()+1) }}"> >> <i class="icon right arrow"></i>
                </a>
            </li>
        </ul>
    </div>
@endif