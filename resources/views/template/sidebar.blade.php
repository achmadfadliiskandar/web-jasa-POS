<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link" style="{{ request()->is('dashboard') ? 'color: #4154f1;background: #f6f9ff;' : '' }}"
                href="{{ url('/dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        {{-- akses admin dan member --}}
        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'member')
            <li class="nav-item">
                <a class="nav-link {{ Request::is('barang*') ? '' : 'collapsed' }}" data-bs-target="#components-nav"
                    data-bs-toggle="collapse" href="#"
                    style="{{ request()->is('barang') || request()->is('barang-create') ? 'color: #4154f1;background: #f6f9ff;' : '' }}">
                    <i class="bi bi-menu-button-wide"></i><span>Barang</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse {{ Request::is('barang*') ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('/barang') }}" class="{{ Request::is('barang') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>List Barang</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/barang-create') }}"
                            class="{{ Request::is('barang-create') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Tambah Barang</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        {{-- akses untuk admin --}}
        @if (Auth::user()->role == 'admin')
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#"
                    style="{{ request()->is('admin-paketmember') || request()->is('admintambah-paketmember') ? 'color: #4154f1;background: #f6f9ff;' : '' }}">
                    <i class="bi bi-journal-text"></i><span>Paket Member</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav"
                    class="nav-content collapse {{ request()->is('admin-paketmember') || request()->is('admintambah-paketmember') ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('admin-paketmember') }}"
                            class="{{ request()->is('admin-paketmember') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>List Paket Member</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('admintambah-paketmember') }}"
                            class="{{ request()->is('admintambah-paketmember') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Tambah Paket Member</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed"
                    style="{{ request()->is('admin-datauser') || request()->is('admin-adduser') ? 'color: #4154f1;background: #f6f9ff;' : '' }}"
                    data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Pengguna</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav"
                    class="nav-content collapse {{ request()->is('admin-datauser') || request()->is('admin-adduser') ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('admin-datauser') }}"
                            class="{{ request()->is('admin-datauser') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>List Pengguna</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('admin-adduser') }}"
                            class="{{ request()->is('admin-adduser') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Tambah Pengguna</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        {{-- bagian khusus member --}}
        <li class="nav-heading">Pages</li>
        <!-- Member -->
        @if (Auth::user()->role == 'admin')
            <li class="nav-item">
                <a class="nav-link collapsed"
                    style="{{ request()->is('admin-datamember') ? 'color: #4154f1;background: #f6f9ff;' : '' }}"
                    href="{{ url('admin-datamember') }}">
                    <i class="bi bi-card-list"></i>
                    <span>Member</span>
                </a>
            </li>
            <!-- Member -->
            <!-- End Profile Page Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed"
                    style="{{ request()->is('admin-faq') ? 'color: #4154f1;background: #f6f9ff;' : '' }}"
                    href="{{ url('admin-faq') }}">
                    <i class="bi bi-question-circle"></i>
                    <span>F.A.Q</span>
                </a>
            </li>
            <!-- End F.A.Q Page Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed"
                    style="{{ request()->is('admin-datatransaksi') ? 'color: #4154f1;background: #f6f9ff;' : '' }}"
                    href="{{ url('admin-datatransaksi') }}">
                    <i class="bi bi-envelope"></i>
                    <span>Transaksi</span>
                </a>
            </li>
        @endif
        @if (Auth::user()->role == 'member')
            <li class="nav-item">
                <a class="nav-link collapsed" style="{{ request()->is('keranjang') ? 'color: #4154f1;background: #f6f9ff;' : '' }}" href="{{ url('/keranjang') }}">
                    <i class="bi bi-cart"></i>
                    <span>Cart</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" style="{{ request()->is('transaksi') ? 'color: #4154f1;background: #f6f9ff;' : '' }}" href="{{ url('/transaksi') }}">
                    <i class="bi bi-envelope"></i>
                    <span>Transaksi</span>
                </a>
            </li>
        @endif
    </ul>
    {{-- end bagian khusus member --}}
</aside>
