<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <!-- Sidebar Header -->

        <!-- Sidebar Menu -->
        <div class="sidebar-menu">
            <ul class="menu">
                <!-- Dashboard -->
                <li class="sidebar-item active">
                    <a href="{{ route('dashboard') }}" class="sidebar-link">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <!-- Category -->
                <li class="sidebar-item">
                    <a href="{{ route('categories.index') }}" class="sidebar-link">
                        <i class="bi bi-diagram-2"></i>
                        <span>Category</span>
                    </a>
                </li>
                <!-- Product -->
                <li class="sidebar-item">
                    <a href="{{ route('products.index') }}" class="sidebar-link">
                        <i class="bi bi-tags"></i>
                        <span>Product</span>
                    </a>
                </li>
                <!-- Cart -->
                <li class="sidebar-item">
                    <a href="{{ route('carts.index') }}" class="sidebar-link">
                        <i class="bi bi-cart"></i>
                        <span>Cart</span>
                    </a>
                </li>
                <!-- Order -->
                <li class="sidebar-item">
                    <a href="{{ route('orders.index') }}" class="sidebar-link">
                        <i class="bi bi-bag-check"></i>
                        <span>Order</span>
                    </a>
                </li>
                <!-- Logout -->
                <li class="sidebar-item">
                    <a href="{{ route('logout') }}" class="sidebar-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>

        <!-- Sidebar Toggler -->
        <button class="sidebar-toggler btn x">
            <i data-feather="x"></i>
        </button>
    </div>
</div>
