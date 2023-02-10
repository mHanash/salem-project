<header>
    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
                aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Brand -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo-banking.jpeg') }}" height="25" alt="" loading="lazy" />
                SALEM FIN
            </a>
            <!-- Search form -->
            @if (false)
                <form class="d-none d-md-flex input-group w-auto my-auto">
                    <input autocomplete="off" type="search" class="form-control rounded" placeholder='Recherche'
                        style="min-width: 225px" />
                    <span class="input-group-text border-0"><i class="fas fa-search"></i></span>
                </form>
            @endif

            <!-- Right links -->
            <ul class="navbar-nav ms-auto d-flex flex-row">
                <!-- Avatar -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
                        id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown"
                        aria-expanded="false">{{ Auth::user()->beneficiary->firstname }}
                        {{ Auth::user()->beneficiary->name }} <i style="margin-left: 5px"
                            class="fas fa-user-circle"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="{{ route('users.profile.show') }}">Mon profile</a></li>
                        <li>
                            <form onsubmit="return confirm('Voulez-vous vraiment vous déconnecter ?')"
                                action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button title="Supprimer" class="dropdown-item">Se
                                    déconnecter</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
</header>
