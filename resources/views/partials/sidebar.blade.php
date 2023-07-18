<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand"
                    href="../../../starter-kit/ltr/vertical-menu-template/"><span class="brand-logo">
                        <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                            <defs>
                                <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%"
                                    y2="89.4879456%">
                                    <stop stop-color="#000000" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                                <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%"
                                    y2="100%">
                                    <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                    <stop stop-color="#FFFFFF" offset="100%"></stop>
                                </lineargradient>
                            </defs>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                    <g id="Group" transform="translate(400.000000, 178.000000)">
                                        <path class="text-primary" id="Path"
                                            d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z"
                                            style="fill:currentColor"></path>
                                        <path id="Path1"
                                            d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z"
                                            fill="url(#linearGradient-1)" opacity="0.2"></path>
                                        <polygon id="Path-2" fill="#000000" opacity="0.049999997"
                                            points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325">
                                        </polygon>
                                        <polygon id="Path-21" fill="#000000" opacity="0.099999994"
                                            points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338">
                                        </polygon>
                                        <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994"
                                            points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288">
                                        </polygon>
                                    </g>
                                </g>
                            </g>
                        </svg></span>
                    <h2 class="brand-text">Vuexy</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @canany(['dashboard.index'])
                <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"><a class="d-flex align-items-center"
                        href="{{ route('dashboard') }}"><i data-feather="home"></i><span class="menu-title text-truncate"
                            data-i18n="Home">Dashboard</span></a>
                </li>
            @endcanany
            @canany(['product.index'])
                <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="layout"></i><span
                            class="menu-title text-truncate" data-i18n="Page Layouts">Product</span></a>
                    <ul class="menu-content">
                        <li class="{{ request()->routeIs('product.*') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('product.index') }}"><i data-feather="circle"></i><span
                                    class="menu-item text-truncate" data-i18n="Collapsed Menu">List</span></a>
                        </li>
                        <li class="{{ request()->routeIs('category.*') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('category.index') }}"><i data-feather="circle"></i><span
                                    class="menu-item text-truncate" data-i18n="Collapsed Menu">Category</span></a>
                        </li>
                        <li class="{{ request()->routeIs('coupons.*') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('coupons.index') }}"><i data-feather="circle"></i><span
                                    class="menu-item text-truncate" data-i18n="Collapsed Menu">Coupon</span></a>
                        </li>
                    </ul>
                </li>
            @endcanany
            @canany(['items.index'])
                <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="layout"></i><span
                            class="menu-title text-truncate" data-i18n="Page Layouts">Stock</span></a>
                    <ul class="menu-content">
                        <li class="{{ request()->routeIs('items.*') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('product.index') }}"><i data-feather="circle"></i><span
                                    class="menu-item text-truncate" data-i18n="Collapsed Menu">List</span></a>
                        </li>
                    </ul>
                </li>
            @endcanany
            @canany(['order.index'])
                <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="message-square"></i><span
                            class="menu-title text-truncate" data-i18n="Page Layouts">Order</span></a>
                    <ul class="menu-content">
                        <li class="{{ request()->routeIs('orders.*') && !request()->routeIs('orders.shouldSend') ? 'active' : '' }}"><a class="d-flex align-items-center"
                                href="{{ route('orders.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                                    data-i18n="Collapsed Menu">List</span></a>
                        </li>
                        <li class="{{ request()->routeIs('orders.shouldSend') ? 'active' : '' }}"><a class="d-flex align-items-center"
                                href="{{ route('orders.shouldSend') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                                    data-i18n="Collapsed Menu">Harus dikirim</span></a>
                        </li>
                    </ul>
                </li>
            @endcanany
            @canany(['order.index'])
                <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='credit-card'></i><span
                            class="menu-title text-truncate" data-i18n="Page Layouts">Transaction</span></a>
                    <ul class="menu-content">
                        <li class="{{ request()->routeIs('transactions.*') && !request()->has('type') ? 'active' : '' }}"><a class="d-flex align-items-center"
                                href="{{ route('transactions.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                                    data-i18n="Collapsed Menu">List</span></a>
                        </li>
                        <li class="{{ request()->routeIs('transactions.*') && request()->query('type') == 'in' ? 'active' : '' }}"><a class="d-flex align-items-center"
                                href="{{ route('transactions.index', ['type' => 'in']) }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                                    data-i18n="Collapsed Menu">In</span></a>
                        </li>
                        <li class="{{ request()->routeIs('transactions.*') && request()->query('type') == 'out' ? 'active' : '' }}"><a class="d-flex align-items-center"
                                href="{{ route('transactions.index', ['type' => 'out']) }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                                    data-i18n="Collapsed Menu">Out</span></a>
                        </li>
                    </ul>
                </li>
            @endcanany
            @canany(['order.index'])
                <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='credit-card'></i><span
                            class="menu-title text-truncate" data-i18n="Page Layouts">Warehouses</span></a>
                    <ul class="menu-content">
                        <li class="{{ request()->routeIs('warehouses.*') ? 'active' : '' }}"><a class="d-flex align-items-center"
                                href="{{ route('warehouses.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                                    data-i18n="Collapsed Menu">List</span></a>
                        </li>
                    </ul>
                </li>
            @endcanany
            @canany(['chat.index'])
                <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="message-square"></i><span
                            class="menu-title text-truncate" data-i18n="Page Layouts">Message</span></a>
                    <ul class="menu-content">
                        <li class="{{ request()->routeIs('chats.*') ? 'active' : '' }}"><a class="d-flex align-items-center"
                                href="{{ route('chats.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                                    data-i18n="Collapsed Menu">Chat Guest</span></a>
                        </li>
                        <li class="{{ request()->routeIs('chats.*') ? 'active' : '' }}"><a class="d-flex align-items-center"
                                href="{{ route('chats.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                                    data-i18n="Collapsed Menu">Chat Users</span></a>
                        </li>
                        <li class="{{ request()->routeIs('message_forms.*') ? 'active' : '' }}"><a class="d-flex align-items-center"
                                href="{{ route('message_forms.index') }}"><i data-feather="circle"></i><span
                                    class="menu-item text-truncate" data-i18n="Collapsed Menu">Form</span></a>
                        </li>
                    </ul>
                </li>
            @endcanany
            @canany(['post.index', 'category_post.index', 'tag.index'])
                <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="layout"></i><span
                            class="menu-title text-truncate" data-i18n="Page Layouts">Artikel</span></a>
                    <ul class="menu-content">
                        @can('post.index')
                            <li class="{{ request()->routeIs('post.*') ? 'active' : '' }}"><a class="d-flex align-items-center"
                                    href="{{ route('post.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                                        data-i18n="Collapsed Menu">List</span></a>
                            </li>
                        @endcan
                        @can('category_post.index')
                            <li class="{{ request()->routeIs('category_post.*') ? 'active' : '' }}"><a class="d-flex align-items-center"
                                    href="{{ route('category_post.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                                        data-i18n="Collapsed Menu">Category</span></a>
                            </li>
                        @endcan
                        @can('tag.index')
                            <li class="{{ request()->routeIs('tags.*') ? 'active' : '' }}"><a class="d-flex align-items-center"
                                    href="{{ route('tags.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                                        data-i18n="Collapsed Menu">Tag</span></a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            @canany(['slider.index'])
                <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="layout"></i><span
                            class="menu-title text-truncate" data-i18n="Page Layouts">Slider</span></a>
                    <ul class="menu-content">
                        @can('slider.index')
                            <li class="{{ request()->routeIs('sliders.*') ? 'active' : '' }}"><a class="d-flex align-items-center"
                                    href="{{ route('sliders.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                                        data-i18n="Collapsed Menu">List</span></a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            @canany(['user.index', 'role.index', 'permission.index'])
                <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='users'></i><span
                            class="menu-title text-truncate" data-i18n="Page Layouts">Users</span></a>
                    <ul class="menu-content">
                        @can('user.index')
                            <li class="{{ request()->routeIs('users.*') ? 'active' : '' }}"><a class="d-flex align-items-center"
                                    href="{{ route('users.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                                        data-i18n="Collapsed Menu">List</span></a>
                            </li>
                        @endcan
                        @can('role.index')
                            <li class="{{ request()->routeIs('roles.*') ? 'active' : '' }}"><a class="d-flex align-items-center"
                                    href="{{ route('roles.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                                        data-i18n="Collapsed Menu">Role</span></a>
                            </li>
                            
                        @endcan
                        @can('permission.index')
                            <li class="{{ request()->routeIs('permissions.*') ? 'active' : '' }}"><a class="d-flex align-items-center"
                                    href="{{ route('permissions.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                                    data-i18n="Collapsed Menu">Permission</span></a>
                            </li>
                        @endcan
                        {{-- <li class="{{ request()->routeIs('category.*') ? 'active' : '' }}"><a class="d-flex align-items-center"
                                href="{{ route('category.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate"
                                    data-i18n="Collapsed Menu">Category</span></a>
                        </li> --}}
                    </ul>
                </li>
            @endcanany
            {{-- <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="layout"></i><span
                        class="menu-title text-truncate" data-i18n="Page Layouts">Page Layouts</span><span
                        class="badge badge-light-danger badge-pill ml-auto mr-1">2</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center" href="layout-collapsed-menu.html"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                data-i18n="Collapsed Menu">Collapsed Menu</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="layout-full.html"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Layout Full">Layout Full</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="layout-without-menu.html"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                data-i18n="Without Menu">Without Menu</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="layout-empty.html"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Layout Empty">Layout Empty</span></a>
                    </li>
                    <li><a class="d-flex align-items-center" href="layout-blank.html"><i data-feather="circle"></i><span
                                class="menu-item text-truncate" data-i18n="Layout Blank">Layout Blank</span></a>
                    </li>
                </ul>
            </li> --}}
            <li class="nav-item"><a class="d-flex align-items-center" href="#"><i data-feather='settings'></i><span
                        class="menu-title text-truncate" data-i18n="Page Layouts">Setting</span></a>
                <ul class="menu-content">
                    <li class="{{ request()->routeIs('setting.api.index') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('setting.api.index') }}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                data-i18n="Collapsed Menu">API</span></a>
                    </li>
                    <li class="{{ request()->routeIs('setting.web') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('setting.web') }}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                data-i18n="Collapsed Menu">Web</span></a>
                    </li>
                    <li class="{{ request()->routeIs('setting.store') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('setting.store') }}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                data-i18n="Collapsed Menu">Toko</span></a>
                    </li>
                    <li class="{{ request()->routeIs('myAccount') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('myAccount') }}"><i
                                data-feather="circle"></i><span class="menu-item text-truncate"
                                data-i18n="Collapsed Menu">My Account</span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>