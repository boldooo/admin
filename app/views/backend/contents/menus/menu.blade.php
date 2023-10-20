<?php $key = Request::segment(2) ?>
@if (Input::get('key_name') != '')
    <?php $key .= '?key_name=' . Input::get('key_name') ?>
@endif
<?php $selected = false ?>
<ul class="sidebar-menu">
    <li class="{{ ($key == 'dashboard') ? 'active' : '' }} treeview">
        <a href="/admin/dashboard">
            <i class="fa fa-dashboard"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <?php $have = ['posts', 'category?key_name=posts', 'category?key_name=logo'] ?>
    <li class="{{ in_array($key, $have) ? 'active' : '' }} treeview">
        <a href="#">
            <i class="fa fa-folder"></i>
            <span>Агуулга</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="{{ ($key == 'posts') ? 'active' : '' }}">
                <a href="/admin/posts">
                    <i class="fa fa-circle-o"></i>
                    Нийтлэл
                </a>
            </li>
            <li class="{{ ($key == 'category?key_name=posts') ? 'active' : '' }}">
                <a href="/admin/category?key_name=posts">
                    <i class="fa fa-circle-o"></i>
                    Ангилал
                </a>
            </li>
            <li class="{{ ($key == 'category?key_name=logo') ? 'active' : '' }}">
                <a href="/admin/category?key_name=logo">
                    <i class="fa fa-circle-o"></i>
                    Лого
                </a>
            </li>
        </ul>
    </li>
    <li class="{{ ($key == 'category?key_name=banner') ? 'active' : '' }} treeview">
        <a href="/admin/category?key_name=banner">
            <i class="fa fa-tv"></i>
            <span>Баннер</span>
        </a>
    </li>
    <li class="{{ ($key == 'category?key_name=slider') ? 'active' : '' }} treeview">
        <a href="/admin/category?key_name=slider">
            <i class="fa fa-caret-square-o-right"></i>
            <span>Слайдер</span>
        </a>
    </li>
    <li class="{{ ($key == 'files') ? 'active' : '' }} treeview">
        <a href="/admin/files">
            <i class="fa fa-file"></i>
            <span>Файл</span>
        </a>
    </li>
    <li class="{{ ($key == 'videos') ? 'active' : '' }} treeview">
        <a href="/admin/videos">
            <i class="fa fa-file-video-o"></i>
            <span>Видео</span>
        </a>
    </li>
    <?php $have = ['menu', 'menu_item'] ?>
    <li class="{{ in_array($key, $have) ? 'active' : '' }} treeview">
        <a href="/admin/menu">
            <i class="fa fa-navicon"></i>
            <span>Цэс</span>
        </a>
    </li>
    <li class="treeview {{ ($key == 'category?key_name=partners') ? 'active' : '' }}">
        <a href="/admin/category?key_name=partners">
            <i class="fa fa-folder"></i>
            <span>Борлуулах цэг</span>
        </a>
    </li>
    <li class="{{ ($key == 'users') ? 'active' : '' }} treeview">
        <a href="/admin/users">
            <i class="fa fa-user"></i>
            <span>Хэрэглэгч</span>
        </a>
    </li>
    <li class="{{ ($key == 'contact') ? 'active' : '' }} treeview">
        <a href="/admin/contact">
            <i class="fa fa-phone"></i>
            <span>Хаяг</span>
        </a>
    </li>
    <li class="{{ ($key == 'lang') ? 'active' : '' }} treeview">
        <a href="/admin/lang">
            <i class="fa fa-globe"></i>
            <span>Хэл</span>
        </a>
    </li>
    <li class="{{ ($key == 'category') ? 'active' : '' }} treeview">
        <a href="/admin/category">
            <i class="fa fa-cog"></i>
            <span>Тохиргоо</span>
        </a>
    </li>
</ul>