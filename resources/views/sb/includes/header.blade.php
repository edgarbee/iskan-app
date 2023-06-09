<header class="p-3 bg-white text-dark pb-0 pt-0">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="{{ route('sb_index') }}" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
                <img src="{{ asset('public/img/logo_red.png')}}" alt="" width="40">
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{ route('sb_index') }}" class="nav-link px-2 text-dark fs-3 fw-bold">Проверка перевозчиков</a></li>
            </ul>

            <div class="text-end d-flex flex-wrap align-items-center">
            <div><a href="{{ route('sb_perevozchik_index') }}" class="nav-link text-dark pe-4">Перевозчики</a></div>
            <div><a href="{{ route('cancel') }}" class="nav-link text-dark pe-4">Отклоненные заявки</a></div>
                <div><a href="{{ route('my') }}" class="nav-link text-dark pe-4">Мои проверки</a></div>
                <div class="d-flex align-items-center text-dark text-decoration-none">
                    <img src="https://ui-avatars.com/api/?name={{ \Auth::user()->name }}" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong>{{ \Auth::user()->name }} {{ \Auth::user()->otdel }}</strong>

                    <a href="{{ route('logout') }}" class="btn btn-light ms-4 d-block"><i class="bi bi-box-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</header>
