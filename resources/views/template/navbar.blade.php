    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{ asset('NiceAdmin/assets/img/profile-img.jpg') }}" alt="Profile"
                        class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->name }}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ Auth::user()->name }}</h6>
                        <span>{{ Auth::user()->role }}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    @if (Auth::user()->role == 'admin')
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ url('/admin-profile') }}">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <hr class="dropdown-divider">
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ url('/admin-kritiksaran') }}">
                                <i class="bi bi-person"></i>
                                <span>Critics and Suggestions</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                    @endif
                    <hr class="dropdown-divider">
            </li>
            <li>
                <form action="{{ url('logout') }}" method="POST" class="dropdown-item d-flex align-items-center">
                    @csrf
                    <button type="submit" class="btn btn-link d-flex align-items-center p-0"
                        style="text-decoration: none; color: inherit;">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Sign Out</span>
                    </button>
                </form>
            </li>
        </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->
        </ul>
    </nav><!-- End Icons Navigation -->
