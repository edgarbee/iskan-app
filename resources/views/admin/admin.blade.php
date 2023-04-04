@extends('admin.layouts.app')
@section('title', 'Админ-панель')
@section('content')
    @push('styles')
    <style>
        body {
        font-size: .875rem;
        }

        .feather {
        width: 16px;
        height: 16px;
        vertical-align: text-bottom;
        }

        /*
        * Sidebar
        */

        .sidebar {
        position: fixed;
        top: 0;
        /* rtl:raw:
        right: 0;
        */
        bottom: 0;
        /* rtl:remove */
        left: 0;
        z-index: 100; /* Behind the navbar */
        padding: 48px 0 0; /* Height of navbar */
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }

        @media (max-width: 767.98px) {
        .sidebar {
            top: 5rem;
        }
        }

        .sidebar-sticky {
        position: relative;
        top: 0;
        height: calc(100vh - 48px);
        padding-top: .5rem;
        overflow-x: hidden;
        overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
        }

        .sidebar .nav-link {
        font-weight: 500;
        color: #333;
        }

        .sidebar .nav-link .feather {
        margin-right: 4px;
        color: #727272;
        }

        .sidebar .nav-link.active {
        color: #007bff;
        }

        .sidebar .nav-link:hover .feather,
        .sidebar .nav-link.active .feather {
        color: inherit;
        }

        .sidebar-heading {
        font-size: .75rem;
        text-transform: uppercase;
        }

        /*
        * Navbar
        */

        .navbar-brand {
        padding-top: .75rem;
        padding-bottom: .75rem;
        font-size: 1rem;
        background-color: rgba(0, 0, 0, .25);
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
        }

        .navbar .navbar-toggler {
        top: .25rem;
        right: 1rem;
        }

        .navbar .form-control {
        padding: .75rem 1rem;
        border-width: 0;
        border-radius: 0;
        }

        .form-control-dark {
        color: #fff;
        background-color: rgba(255, 255, 255, .1);
        border-color: rgba(255, 255, 255, .1);
        }

        .form-control-dark:focus {
        border-color: transparent;
        box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
        }
    </style>
    @endpush
    @include("admin.includes.header")
    <div class="container-fluid">
        <div class="row">
            @include("admin.includes.sidebar")
            
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <h3 class="mt-4 mb-5">Панель администратора</h3>

                <div class="list-group">

                    <a href="{{ route('clients_index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        Клиенты
                        <span class="badge bg-primary rounded-pill">{{App\Models\Clients::get()->count()}}</span>
                    </a>
                    <a href="{{ route('perevozchik_index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        Перевозчики
                        <span class="badge bg-primary rounded-pill">{{App\Models\Carrier::where('data_proverki', '!=', '')->get()->count()}}</span>
                    </a>
                    <a href="{{ route('company_index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        Компании
                        <span class="badge bg-primary rounded-pill">{{App\Models\Company::get()->count()}}</span>
                    </a>
                    <a href="{{ route('users_index') }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        Пользователи
                        <span class="badge bg-primary rounded-pill">{{App\Models\User::get()->count()-1}}</span>
                    </a>
                </div>
            </main>

        </div>
    </div>


    @include("admin.includes.footer")

    @push('scripts')
    @endpush
@endsection