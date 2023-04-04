@extends('admin.layouts.app')
@section('title', 'Перевозчики')
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
        th {
            font-size: 11px;
            word-break: break-all;
        }
        tr {
            font-size: 11px;
            word-break: break-all;
        }

        .id {
            width: 60px;
        }

        .ati {
            width: 80px;
        }

        .name, .tel, .email, .trans {
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
                    <div class="d-flex align-items-center flex-wrap mb-3">
                    <h1 class="h2">Перевозчики</h1>
                    <button type="button" class="btn btn-success btn-sm mx-3" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-person-plus"></i> Добавить нового перевозчика</button>
                        <form action="{{route('excelPerevozchik')}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm mx-3"><i class="bi bi-file-earmark-excel"></i> Выгрузить всех перевозчиков</button>
                        </form>
                    </div>
                    <table class="table table-bordered border-primary table-hover pt-3 mb-3" id="table">
                    <thead>
                        <tr>
                        <th scope="col" class="id">Номер</th>
                        <th scope="col" class="ati">Код АТИ</th>
                        <th scope="col" class="name">ООО/ИП перевозчика</th>
                        <th scope="col" class="tel">Телефон диспетчера</th>
                        <th scope="col" class="email">Почта диспетчера</th>
                        <th scope="col" class="trans">Тип транспорта</th>
                        <th scope="col" class="trans">Транспортное стредство</th>

                        <th scope="col" class="trans">Водитель</th>
                        <th scope="col" class="trans">Паспорт водителя</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $perevozchiki as $perevozchik )
                            <tr class="item" id="{{ $perevozchik->id }}" onclick="window.location.href='/admin/perevozchik/{{ $perevozchik->id }}'">
                                <th scope="row">{{ $perevozchik->id }}</th>
                                <td>{{ $perevozchik->code_ATI }}</td>
                                <td>{{ $perevozchik->perevozchik_name }}</td>
                                <td>{{ $perevozchik->perevozchik_tel }}</td>
                                <td>{{ $perevozchik->perevozchik_email }}</td>
                                <td>{{ $perevozchik->type_transport }}</td>
                                <td>{{ $perevozchik->perevozchik_ts }}</td>

                                <td>{{ $perevozchik->perevozchik_voditel }}</td>
                                <td>{{ $perevozchik->pasport_voditel }}</td>
                            </tr>
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
            <h5 class="modal-title" id="exampleModalLabel">Новый перевозчик</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('perevozchikAdd') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 per mb-2">
                        <div class="mb-1">
                            <input type="text" class="form-control form-control-sm" name="code_ATI" id="code_ATI" placeholder="Код АТИ" required>
                        </div>
                    </div>
                    <div class="col-md-12 per mb-2">
                        <div class="mb-1">
                            <input type="text" class="form-control form-control-sm" name="perevozchik_name" id="perevozchik_name" placeholder="ООО/ИП перевозчика" required>
                        </div>
                    </div>
                    <div class="col-md-12 per mb-2">
                        <div class="mb-1">
                            <input type="tel" class="tel form-control form-control-sm" name="perevozchik_tel" id="perevozchik_tel" placeholder="Телефон диспетчера" required>
                        </div>
                    </div>
                    <div class="col-md-12 per mb-2">
                        <div class="mb-1">
                            <input type="email" class="form-control form-control-sm" name="perevozchik_email" id="perevozchik_email" placeholder="Почта диспетчера" required>
                        </div>
                    </div>
                    <div class="col-md-12 per mb-2">
                        <div class="mb-1">
                            <input type="text" class="form-control form-control-sm" name="type_transport" id="type_transport" placeholder="Тип транспорта" required>
                        </div>
                    </div>
                    <div class="col-md-12 per mb-2">
                        <div class="mb-1">
                            <input type="text" class="form-control form-control-sm" name="perevozchik_ts" id="perevozchik_ts" placeholder="Транспортное стредство" required>
                        </div>
                    </div>
                    <div class="col-md-12 per mb-2">
                        <div class="mb-1">
                            <input type="text" class="form-control form-control-sm" name="perevozchik_voditel" id="perevozchik_voditel" placeholder="Водитель" required>
                        </div>
                    </div>
                    <div class="col-md-12 per mb-2">
                        <div class="mb-1">
                            <input type="tel" class="tel form-control form-control-sm" name="perevozchik_voditel_tel" id="perevozchik_voditel_tel" placeholder="Телефон водителя" required>
                        </div>
                    </div>
                    <div class="col-md-12 per mb-2">
                        <div class="mb-1">
                            <input type="text" class="form-control form-control-sm" name="pasport_voditel" id="pasport_voditel" placeholder="Паспорт водителя" required>
                        </div>
                    </div>
                    <div class="col-md-12 per mb-2">
                        <div class="mb-1">
                            <input type="text" class="form-control form-control-sm" name="home_region" id="home_region" placeholder="Домашний регион">
                        </div>
                    </div>
                    <div class="col-md-12 per mb-2">
                        <div class="mb-1">
                            <input type="text" class="form-control form-control-sm" name="name_director" id="name_director" placeholder="ФИО директора" required>
                        </div>
                    </div>
                    <div class="col-md-12 per mb-2">
                        <div class="mb-1">
                            <input type="text" class="form-control form-control-sm" name="karta_sber" id="karta_sber" placeholder="Карта сбербанка">
                        </div>
                    </div>
                    <div class="col-md-12 per mb-2">
                        <div class="mb-1">
                            <textarea  class="form-control form-control-sm" name="contacts" id="contacts" placeholder="Реквизиты" required></textarea>
                        </div>
                    </div>
                </div> 
                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Добавить перевозчика</button>
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