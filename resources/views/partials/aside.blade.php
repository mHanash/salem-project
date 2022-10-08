<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" style="overflow:auto">
        <!-- Sidebar navigation-->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4">
                    <a href="{{ route('home') }}"
                        class="{{ '/' == request()->path() ? 'active' : '' }} list-group-item list-group-item-action py-2 ripple"
                        aria-current="true">
                        <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Tableau de bord</span>
                    </a>
                    <a href="{{ route('repportings.home') }}" class="{{ str_contains(request()->path(), 'repporting') ? 'active' : '' }} list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-chart-area fa-fw me-3"></i><span>Rapport</span>
                    </a>
                    <a href="{{ route('transactions.home') }}"
                        class="{{ str_contains(request()->path(), 'transaction') ? 'active' : '' }}  list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-exchange-alt me-3"></i><span>Journal</span>
                    </a>
                    <a href="{{ route('plannings.home') }}"
                        class="{{ str_contains(request()->path(), 'planning') ? 'active' : '' }} list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-chart-area fa-fw me-3"></i><span>Prévision</span>
                    </a>
                    <a href="{{ route('accounts') }}"
                        class="{{ str_contains(request()->path(), 'accounts') ? 'active' : '' }} list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-chart-area fa-fw me-3"></i><span>Compte</span>
                    </a>
                    <a href="#" class="list-group list-group-item-action py-2 ripple">
                        <span>Parametre</span>
                        <a href="{{ route('budgetings') }}"
                            class="{{ str_contains(request()->path(), 'budgeting') ? 'active' : '' }} list-group-item list-group-item-action py-2 ripple">
                            <i class="fas fa-chart-area fa-fw me-3"></i><span>Budget</span>
                        </a>
                        <a href="{{ route('beneficiaries') }}"
                            class="{{ str_contains(request()->path(), 'beneficiaries') ? 'active' : '' }} list-group-item list-group-item-action py-2 ripple">
                            <i class="fas fa-chart-area fa-fw me-3"></i><span>Agents</span>
                        </a>
                        <a href="{{ route('typeBeneficiaries') }}"
                            class="{{ str_contains(request()->path(), 'type_beneficiary') ? 'active' : '' }} list-group-item list-group-item-action py-2 ripple">
                            <i class="fas fa-chart-area fa-fw me-3"></i><span>Type agents</span>
                        </a>
                        <a href="{{ route('currencies') }}"
                            class="{{ str_contains(request()->path(), 'currency') ? 'active' : '' }} list-group-item list-group-item-action py-2 ripple">
                            <i class="fas fa-money-bill me-3"></i><span>Devise</span>
                        </a>
                        <a href="{{ route('jobs') }}"
                            class="{{ str_contains(request()->path(), 'job') ? 'active' : '' }} list-group-item list-group-item-action py-2 ripple">
                            <i class="fas fa-chart-area fa-fw me-3"></i><span>Postes</span>
                        </a>
                        <a href="{{ route('typeAccounts') }}"
                            class="{{ str_contains(request()->path(), 'type_account') ? 'active' : '' }} list-group-item list-group-item-action py-2 ripple">
                            <i class="fas fa-chart-area fa-fw me-3"></i><span>Type de compte</span>
                        </a>
                        <a href="{{ route('years') }}" class="{{ str_contains(request()->path(), 'years') ? 'active' : '' }} list-group-item list-group-item-action py-2 ripple">
                            <i class=" fas fa-chart-area fa-fw me-3"></i><span>Année</span>
                        </a>
                        <a href="{{ route('status') }}"
                            class="{{ str_contains(request()->path(), 'status') ? 'active' : '' }} list-group-item list-group-item-action py-2 ripple">
                            <i class="fas fa-chart-area fa-fw me-3"></i><span>Status</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action py-2 ripple">
                            <i class="fas fa-chart-area fa-fw me-3"></i><span>Utilisateurs</span>
                        </a>
                    </a>
                </div>
            </div>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
