@php
$admin = false;
$finan = false;
@endphp
@foreach (Auth::user()->roles as $role)
    @if ($role->name == 'ADMIN')
        @php
            $admin = true;
        @endphp
    @endif
    @if ($role->name == 'FINANCIAL')
        @php
            $finan = true;
        @endphp
    @endif
@endforeach
<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" style="overflow:auto">
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
            <div class="position-sticky" style="bottom:15px;height:85vh;overflow:scroll">
                <div class="list-group list-group-flush mx-3 mt-4">
                    <a href="{{ route('home') }}"
                        class="{{ '/' == request()->path() ? 'active' : '' }} list-group-item list-group-item-action py-2 ripple"
                        aria-current="true">
                        <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Tableau de bord</span>
                    </a>
                    <a href="{{ route('repportings.home') }}"
                        class="{{ str_contains(request()->path(), 'repporting') ? 'active' : '' }} list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-chart-area fa-fw me-3"></i><span>Rapport</span>
                    </a>
                    <a href="{{ route('transactions.home') }}"
                        class="{{ str_contains(request()->path(), 'transaction') ? 'active' : '' }}  list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-book-open me-3"></i></i><span>Journal</span>
                    </a>
                    @if ($admin)
                        <a href="{{ route('plannings.home') }}"
                            class="{{ str_contains(request()->path(), 'planning') ? 'active' : '' }} list-group-item list-group-item-action py-2 ripple">
                            <i class="fas fa-calendar-alt me-3"></i></i><span>Prévision</span>
                        </a>
                        <a href="{{ route('accounts') }}"
                            class="{{ str_contains(request()->path(), 'accounts') ? 'active' : '' }} list-group-item list-group-item-action py-2 ripple">
                            <i class="fas fa-calculator me-3"></i></i><span>Compte</span>
                        </a>
                    @endif
                    @if ($admin)
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" style="padding-left: 15px" href="#"
                                    id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown"
                                    aria-expanded="false"><i class="fas fa-cog me-3"></i><span>Parametres</span> </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li>
                                        <a href="{{ route('budgetings') }}"
                                            class="{{ str_contains(request()->path(), 'budgeting') ? 'active' : '' }} dropdown-item">
                                            <i class="fas fa-money-bill me-3"></i></i><span>Budget</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('beneficiaries') }}"
                                            class="{{ str_contains(request()->path(), 'beneficiaries') ? 'active' : '' }} dropdown-item">
                                            <i class="fas fa-handshake me-3"></i></i></i><span>Agents</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('typeBeneficiaries') }}"
                                            class="{{ str_contains(request()->path(), 'type_beneficiary') ? 'active' : '' }} dropdown-item">
                                            <i class="far fa-handshake me-3"></i></i><span>Type agents</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('currencies') }}"
                                            class="{{ str_contains(request()->path(), 'currency') ? 'active' : '' }} dropdown-item">
                                            <i class="fas fa-hand-holding-usd me-3"></i></i><span>Devise</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('jobs') }}"
                                            class="{{ str_contains(request()->path(), 'job') ? 'active' : '' }} dropdown-item">
                                            <i class="fas fa-network-wired me-3"></i></i><span>Postes</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('typeAccounts') }}"
                                            class="{{ str_contains(request()->path(), 'type_account') ? 'active' : '' }} dropdown-item">
                                            <i class="fas fa-calculator me-3"></i></i><span>Type de compte</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('years') }}"
                                            class="{{ str_contains(request()->path(), 'years') ? 'active' : '' }} dropdown-item">
                                            <i class="fas fa-calendar me-3"></i></i><span>Année</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('status') }}"
                                            class="{{ str_contains(request()->path(), 'status') ? 'active' : '' }} dropdown-item">
                                            <i class="fas fa-star me-3"></i></i></i><span>Status</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('users') }}"
                                            class="{{ str_contains(request()->path(), 'user') ? 'active' : '' }} dropdown-item">
                                            <i class="fas fa-users me-3"></i><span>Utilisateurs</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('roles') }}"
                                            class="{{ str_contains(request()->path(), 'role') ? 'active' : '' }} dropdown-item">
                                            <i class="fas fa-users-cog me-3"></i><span>Roles utilisateurs</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    @endif
                </div>
            </div>
            <div style="background-color:white; right:0px;font-size:13px;bottom: 0px; left:0px;position:absolute">
                <p class="d-flex">
                    Powered By <a href="https://web.facebook.com/zenasmomonzo.zenas" target="_blank"
                        class="nav-link text-primary"> <i class="far fa-copyright"></i></i>Zén's Hanash</a>
                </p>
            </div>
        </nav>
    </div>
    <!-- End Sidebar scroll-->
</aside>
