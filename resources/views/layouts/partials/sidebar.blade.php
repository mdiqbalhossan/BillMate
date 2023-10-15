<div class="sidebar-wrapper">
    <div class="sidebar sidebar-collapse" id="sidebar">
        <div class="sidebar__menu-group">
            <ul class="sidebar_nav">
                <li>
                    <a href="{{ auth()->user()->is_admin == 1 ? route('admin.dashboard') : route('dashboard') }}" class="">
                        <span class="nav-icon uil uil-create-dashboard"></span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.client.index') }}" class="">
                        <span class="nav-icon uil uil-user-circle"></span>
                        <span class="menu-text">Client</span>
                    </a>
                </li>
                <li class="has-child">
                    <a href="#" class="">
                        <span class="nav-icon uil uil-bag"></span>
                        <span class="menu-text text-initial">eCommerce</span>
                        <span class="toggle-icon"></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('admin.product.index') }}" class="">Products List</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.category.index') }}" class="">Categories</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
