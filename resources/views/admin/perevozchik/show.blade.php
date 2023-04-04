@extends('admin.layouts.app')
@section('title', 'Перевозчик - '.$perevozchik->perevozchik_name.'')
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
                <div class="row">
                    <div class="d-flex align-items-center justify-content-between mt-4 mb-3">
                        <div>
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary mt-2"><i class="bi bi-arrow-bar-left"></i> Вернуться назад</a>
                        </div>
                        <div>
                            <form action="{{ route('perevozchikDelete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $perevozchik->id }}">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Вы точно хотите удалить перевозчика?')"><i class="bi bi-trash3"></i> Удалить</button>
                            </form>
                        </div>
                    </div>
                </div> 
                <form action="{{ route('perevozchikEdit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 12px; font-weight: 700">Код АТИ</label>
                        <input type="text" class="form-control form-control-sm" name="code_ATI"  value="{{ $perevozchik->code_ATI }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 12px; font-weight: 700">ООО/ИП перевозчика</label>
                        <input type="text" class="form-control form-control-sm" name="perevozchik_name"  value="{{ $perevozchik->perevozchik_name }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 12px; font-weight: 700">Телефон диспетчера</label>
                        <input type="tel" class="form-control form-control-sm tel" name="perevozchik_tel"  value="{{ $perevozchik->perevozchik_tel }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 12px; font-weight: 700">Почта диспетчера</label>
                        <input type="email" class="form-control form-control-sm" name="perevozchik_email"  value="{{ $perevozchik->perevozchik_email }}">
                    </div> 
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 12px; font-weight: 700">Тип транспорта</label>
                        <input type="text" class="form-control form-control-sm" name="type_transport"  value="{{ $perevozchik->type_transport }}">
                    </div> 
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 12px; font-weight: 700">Транспортное средство</label>
                        <input type="text" class="form-control form-control-sm" name="perevozchik_ts"  value="{{ $perevozchik->perevozchik_ts }}">
                    </div> 
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 12px; font-weight: 700">Водитель</label>
                        <input type="text" class="form-control form-control-sm" name="perevozchik_voditel"  value="{{ $perevozchik->perevozchik_voditel }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 12px; font-weight: 700">Паспорт водителя</label>
                        <input type="text" class="form-control form-control-sm" name="pasport_voditel"  value="{{ $perevozchik->pasport_voditel }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 12px; font-weight: 700">Домашний регион</label>
                        <input type="text" class="form-control form-control-sm" name="home_region"  value="{{ $perevozchik->home_region }}">
                    </div> 
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 12px; font-weight: 700">ФИО директора</label>
                        <input type="text" class="form-control form-control-sm" name="name_director"  value="{{ $perevozchik->name_director }}">
                    </div> 
                    <div class="mb-3">
                        <label class="form-label" style="font-size: 12px; font-weight: 700">Карта сбербанка</label>
                        <input type="text" class="form-control form-control-sm" name="name_director"  value="{{ $perevozchik->karta_sber }}">
                    </div> 

                    <div class="mb-3">
                        <label class="form-label" style="font-size: 12px; font-weight: 700">Реквизиты</label>
                        <textarea  class="form-control form-control-sm" rows="3" name="contacts" value="$perevozchik->contacts">{{$perevozchik->contacts}}</textarea>
                    </div>
                    <input type="hidden" name="id" value="{{ $perevozchik->id }}">

                    <button type="submit" class="btn btn-sm btn-success mb-3"><i class="bi bi-pencil-square"></i> Изменить</button>
                </form>
            </main>

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