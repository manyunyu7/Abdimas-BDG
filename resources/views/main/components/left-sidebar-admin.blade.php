<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="{{ URL('/admin') }}"
                        aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                            class="hide-menu">Dashboard</span></a></li>
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">RT/RW</span></li>

                <li class="sidebar-item active">
                    <a class="sidebar-link" href="{{ URL('admin/rw/manage') }}" aria-expanded="false">
                        <i data-feather="tag" class="feather-icon"></i>
                        <span class="hide-menu">Manage RW
                        </span>
                    </a>
                </li>
                <li class="sidebar-item active">
                    <a class="sidebar-link" href="{{ URL('admin/rt/manage') }}" aria-expanded="false">
                        <i data-feather="tag" class="feather-icon"></i>
                        <span class="hide-menu">Manage RT
                        </span>
                    </a>
                </li>
                <li class="list-divider"></li>


                <li class="nav-small-cap"><span class="hide-menu">Surat Pengajuan</span></li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ url('/admin/surat-pengantar') }}"
                        aria-expanded="false">
                        <i data-feather="edit-3" class="feather-icon"></i><span class="hide-menu">Surat Pengantar</span></a>
                </li>
                <li class="list-divider"></li>

                
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="{{ url('/admin/ganti-password') }}"
                        aria-expanded="false">
                        <i data-feather="edit-3" class="feather-icon"></i><span class="hide-menu">Ganti
                            Password</span></a>
                </li>
                <li class="list-divider"></li>


                <li class="nav-small-cap"><span class="hide-menu">Extra</span></li>
                <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="../../docs/docs.html"
                        aria-expanded="false"><i data-feather="edit-3" class="feather-icon"></i><span
                            class="hide-menu">Documentation</span></a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

                <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();  document.getElementById('logout-form').submit();"
                        aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span
                            class="hide-menu">Logout</span></a></li>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
