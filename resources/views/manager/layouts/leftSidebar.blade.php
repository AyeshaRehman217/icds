<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <h5 class="mb-0">{{!empty(session('currentModule.0')) ? ucwords(session('currentModule.0')) : ''}}</h5>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('manager/dashboard') ? 'active' : '' }}"
               href="{{route('manager.dashboard')}}">
                <i class="nav-icon cil-speedometer"></i> Dashboard
            </a>
        </li>
        @canany(['manager_master-data_session-list'])
            <li class="nav-title">Transaction</li>
            @can('manager_master-data_session-list')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('manager/session*') ? 'active' : '' }}"
                       href="{{route('manager.session.index')}}">
                        <i class="nav-icon cil-cursor"></i> Session
                    </a>
                </li>
            @endcan
        @endcanany
        @canany(['manager_master-data_payment-type-list','manager_master-data_registration-type-list','manager_master-data_registration-fee-list','manager_master-data_registration-status-list'])
            <li class="nav-title">Master Data</li>
            @can('manager_master-data_payment-type-list')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('manager/payment-type*') ? 'active' : '' }}"
                       href="{{route('manager.payment-type.index')}}">
                        <i class="nav-icon cil-cursor"></i> Payment Type
                    </a>
                </li>
            @endcan
            @can('manager_master-data_registration-type-list')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('manager/registration-type*') ? 'active' : '' }}"
                       href="{{route('manager.registration-type.index')}}">
                        <i class="nav-icon cil-cursor"></i> Registration Type
                    </a>
                </li>
            @endcan
            @can('manager_master-data_registration-status-list')
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('manager/registration-status*') ? 'active' : '' }}"
                       href="{{route('manager.registration-status.index')}}">
                        <i class="nav-icon cil-cursor"></i> Registration Status
                    </a>
                </li>
            @endcan
        @endcanany
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
