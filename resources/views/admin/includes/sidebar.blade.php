<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link @if(\Request::route()->getName() === 'admin_index') active @endif" href="{{ route('admin_index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home" aria-hidden="true">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    Главная
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(\Request::route()->getName() === 'clients_index') active @endif" href="{{ route('clients_index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    Клиенты
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(\Request::route()->getName() === 'perevozchik_index') active @endif" href="{{ route('perevozchik_index') }}">
                    <i class="bi bi-truck" style="margin-right: 6px;"></i>
                    Перевозчики
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(\Request::route()->getName() === 'company_index') active @endif" href="{{ route('company_index') }}">
                    <i class="bi bi-buildings" style="margin-right: 6px;"></i>
                    Компании
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link @if(\Request::route()->getName() === 'users_index') active @endif" href="{{ route('users_index') }}">
                    <i class="bi bi-person-circle" style="margin-right: 6px;"></i>
                    Пользователи
                </a>
            </li>
        </ul>
    </div>
</nav>