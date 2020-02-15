<div class="sidebar">
    <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">
                K
            </a>
            <a href="#" class="simple-text logo-normal">
               KONTENA
            </a>
        </div>
        <ul class="nav">
            <li class="@yield('menu_dashboard')">
                <a href="{{ route('backend.dashboard') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="@yield('menu_promotion')">
                <a href="{{ route('backend.promotion.index') }}">
                    <i class="tim-icons icon-spaceship"></i>
                    <p>Promotion</p>
                </a>
            </li>
            <li class="@yield('menu_blog')">
                <a href="{{ route('backend.blog.index') }}">
                    <i class="tim-icons icon-single-copy-04"></i>
                    <p>Articles</p>
                </a>
            </li>
        </ul>
    </div>
</div>
