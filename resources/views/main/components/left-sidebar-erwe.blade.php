<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="{{ URL('/rw') }}"
                        aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span
                            class="hide-menu">Dashboard</span></a></li>
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Rukun Tetangga</span></li>

                <li class="sidebar-item"><a class="sidebar-link"
                        href="{{ URL('rw/' . Auth::guard('erwe')->id() . '/rt-anggota') }}" aria-expanded="false"><i
                            data-feather="tag" class="feather-icon"></i><span class="hide-menu">Data RT
                        </span></a>
                </li>

                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Surat Pengantar</span></li>
           
                <li class="sidebar-item"><a class="sidebar-link"
                        href="{{ URL('rw/' . Auth::guard('erwe')->id() . '/surat-pengantar') }}" aria-expanded="false"><i
                            data-feather="tag" class="feather-icon"></i><span class="hide-menu">List Pengajuan
                        </span></a>
                </li>
      
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Extra</span></li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link"
                        href="{{ url('/rw' . '/' . Auth::guard('erwe')->id()) . '/ganti-password' }}" aria-expanded="false">
                        <i data-feather="edit-3" class="feather-icon"></i><span class="hide-menu">Ganti
                            Password</span></a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link"
                        href="{{ url('/keluarga' . '/' . Auth::guard('keluarga')->id()) . '/info' }}" aria-expanded="false">
                        <i data-feather="edit-3" class="feather-icon"></i><span class="hide-menu">Info</span></a>
                </li>

                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Tanda Tangan dan Cap</span></li>

                <li class="sidebar-item"><a class="sidebar-link" href="{{ URL('rw/'.Auth::guard('erwe')->id().'/manage-tanda-tangan') }}"
                        aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span class="hide-menu">Tanda Tangan
                        </span></a>
                </li>
                <li class="sidebar-item"><a class="sidebar-link" href="{{ URL('rw/'.Auth::guard('erwe')->id().'/manage-cap') }}"
                        aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span class="hide-menu">Stempel RW
                        </span></a>
                </li>

                {{-- <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                    <i data-feather="power" class="svg-icon mr-2 ml-1"></i>Logout</a> --}}
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
