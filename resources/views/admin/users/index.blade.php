@extends('admin.layouts.app')
@section('title', 'Пользователи')
@section('content')
    @push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" />
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
        .alert {
            font-size: 12px; font-weight: 700;
            padding: 10px;
        }
        .table-bordered>:not(caption)>*>* {
            border-width: 1px 1px !important;
        }
        tr {
            font-size: 12px;
            word-break: break-all;
        }

        .id {
            width: 60px;
        }

        .name {
            width: 200px;
        }
    </style>
    @endpush

    @include("admin.includes.header")
    <div class="container-fluid">
        <div class="row">
            @include("admin.includes.sidebar")

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="table-responsive mt-5">
                    @if (\Session::has('success'))
                        <div class="alert alert-success mb-4">
                            {!! \Session::get('success') !!}
                        </div>
                    @endif

                    @error('email')
                        <div class="alert alert-danger mb-4">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="d-flex align-items-center flex-wrap mb-3">
                        <h1 class="h2">Пользователи</h1>
                        <button type="button" class="btn btn-success btn-sm mx-3" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-person-plus"></i> Добавить нового пользователя</button>
                    </div>
                    <table class="table table-bordered border-primary table-hover pt-3 mb-3" id="table">
                    <thead>
                        <tr>
                            <th scope="col">Имя</th>
                            <th scope="col" class="name">Телефон</th>
                            <th scope="col" class="name">Email</th>
                            <th scope="col" class="name">Роль</th>
                            <th scope="col" class="name">Отдел</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $users as $user )
                            @if($user->role != 0)
                                <tr class="item" onclick="window.location.href='/admin/users/{{ $user->id }}'">
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->tel }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->role == 1)
                                            Логист
                                        @else
                                            Сотрудник СБ
                                        @endif
                                    </td>
                                    <td>{{ $user->otdel }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </main>

        </div>
    </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Новый пользователь</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('usersAdd') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                <label class="form-label">Имя</label>
                    <input type="text" class="form-control form-control-sm" name="name" required value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Телефон</label>
                    <input type="tel" class="form-control form-control-sm tel" name="tel" required value="{{ old('tel') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control form-control-sm" name="email" required value="{{ old('email') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Пароль</label>
                    <input type="text" class="form-control form-control-sm" name="password" required value="{{ old('password') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Роль</label>
                    <select class="form-select form-select-sm" name="role" required>
                        <option value="">Выберите роль</option>
                        <option value="1">Логист</option>
                        <option value="2">Сотрудник СБ</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Отдел</label>
                    <select class="form-select form-select-sm" name="otdel" required>
                        <option value="">Выберите отдел</option>
                        <option value="H1">H1</option>
                        <option value="К2">К2</option>
                        <option value="Z">Z</option>
                        <option value="R">R</option>
                        <option value="A">A</option>
                        <option value="M">M</option>
                        <option value="C">C</option>
                        <option value="СБ">СБ</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Добавить пользователя</button>
            </div>
            </form>
        </div>
        </div>
    </div>

    @include("admin.includes.footer")

    @push('scripts')
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function () {
        $('#table').DataTable({
            order: [[0, 'desc']],
            language: {
                search: "Поиск: ",
                paginate: {
                    previous: "Назад",
                    next: "Вперед",
                },
                info: "Показано от _START_ до _END_ из _TOTAL_ записей",
                lengthMenu: "Показывать _MENU_ записей",
            }
        });
    });
    </script>
    <script>
        window.addEventListener("DOMContentLoaded", function() {
        [].forEach.call( document.getElementsByClassName("tel"), function(input) {
        var keyCode;
        function mask(event) {
            event.keyCode && (keyCode = event.keyCode);
            var pos = this.selectionStart;
            if (pos < 3) event.preventDefault();
            var matrix = "+7 (___) ___ ____",
                i = 0,
                def = matrix.replace(/\D/g, ""),
                val = this.value.replace(/\D/g, ""),
                new_value = matrix.replace(/[_\d]/g, function(a) {
                    return i < val.length ? val.charAt(i++) || def.charAt(i) : a
                });
            i = new_value.indexOf("_");
            if (i != -1) {
                i < 5 && (i = 3);
                new_value = new_value.slice(0, i)
            }
            var reg = matrix.substr(0, this.value.length).replace(/_+/g,
                function(a) {
                    return "\\d{1," + a.length + "}"
                }).replace(/[+()]/g, "\\$&");
            reg = new RegExp("^" + reg + "$");
            if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
            if (event.type == "blur" && this.value.length < 5)  this.value = ""
        }

        input.addEventListener("input", mask, false);
        input.addEventListener("focus", mask, false);
        input.addEventListener("blur", mask, false);
        input.addEventListener("keydown", mask, false)

      });

    });
    </script>
    @endpush
@endsection
