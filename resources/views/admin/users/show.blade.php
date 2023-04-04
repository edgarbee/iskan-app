@extends('admin.layouts.app')
@section('title', 'Пользователь - '.$user->company_name.'')
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
                            <form action="{{ route('usersDelete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Вы точно хотите удалить пользователя?')"><i class="bi bi-trash3"></i> Удалить</button>
                            </form>
                        </div>
                    </div>
                </div> 
                <form action="{{ route('usersEdit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                    <label class="form-label">Имя</label>
                        <input type="text" class="form-control form-control-sm" name="name" value="{{ $user->name }}">
                    </div> 
                    <div class="mb-3">
                        <label class="form-label">Телефон</label>
                        <input type="tel" class="form-control form-control-sm tel" name="tel" value="{{ $user->tel }}">
                    </div> 
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control form-control-sm" name="email" value="{{ $user->email }}">
                    </div> 
                    <div class="mb-3">
                        <label class="form-label">Новый пароль</label>
                        <input type="text" class="form-control form-control-sm" name="password" value="">
                    </div> 
                    <div class="mb-3">
                        <label class="form-label">Роль</label>
                        <select class="form-select form-select-sm" name="role" >
                            <option value="">Выберите роль</option>
                            <option value="1" @if($user->role == 1) selected @endif>Логист</option>
                            <option value="2" @if($user->role == 2) selected @endif>Сотрудник СБ</option>   
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Отдел</label>
                        <select class="form-select form-select-sm" name="otdel" >
                            <option value="">Выберите отдел</option>
                            <option value="H1" @if($user->otdel == "H1") selected @endif>H1</option>
                            <option value="К2" @if($user->otdel == "К2") selected @endif>К2</option>
                            <option value="Z" @if($user->otdel == "Z") selected @endif>Z</option>
                            <option value="R" @if($user->otdel == "R") selected @endif>R</option>
                            <option value="A" @if($user->otdel == "A") selected @endif>A</option>
                            <option value="M" @if($user->otdel == "M") selected @endif>M</option>
                            <option value="C" @if($user->otdel == "C") selected @endif>C</option>
                            <option value="СБ" @if($user->otdel == "СБ") selected @endif>СБ</option>
                        </select>
                    </div>        

                    <input type="hidden" name="id" value="{{ $user->id }}">

                    <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-pencil-square"></i> Изменить</button>
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
      $(document).ready(function (e) {
         $('#stamp_1').change(function(){         
          let reader = new FileReader(); 
          reader.onload = (e) => { 
            $('#preview-image-before-upload-1').attr('src', e.target.result); 
          }
          reader.readAsDataURL(this.files[0]);      
         }); 

         $('#stamp_2').change(function(){         
          let reader = new FileReader(); 
          reader.onload = (e) => { 
            $('#preview-image-before-upload-2').attr('src', e.target.result); 
          }
          reader.readAsDataURL(this.files[0]);      
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