@extends('admin.layouts.app')
@section('title', 'Компания - '.$company->company_name.'')
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
                            <form action="{{ route('companyDelete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $company->id }}">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Вы точно хотите удалить компанию?')"><i class="bi bi-trash3"></i> Удалить</button>
                            </form>
                        </div>
                    </div>
                </div> 
                <form action="{{ route('companyEdit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">ООО/ИП клиента</label>
                        <input type="text" class="form-control form-control-sm" name="company_name" value="{{ $company->company_name }}">
                    </div> 
                    <div class="mb-3">
                        <label class="form-label">ФИО директора в родительном падеже</label>
                        <input type="text" class="form-control form-control-sm" name="name_director_1" value="{{ $company->name_director_1 }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ФИО директора сокращенно</label>
                        <input type="text" class="form-control form-control-sm" name="name_director_2" value="{{ $company->name_director_2 }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ИНН + адрес</label>
                        <input type="text" class="form-control form-control-sm" name="inn" value="{{ $company->inn }}">
                    </div> 
                    <div class="mb-3">
                        <label class="form-label">Реквизиты</label>
                        <textarea class="form-control" rows="6" name="rekvizity" value="{{ $company->rekvizity }}" style="font-size:12px">{{ $company->rekvizity }}</textarea>
                    </div>

                    <div class="row">

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Печать для ДЗ</label>
                            <input class="form-control form-control-sm" type="file" name="stamp" placeholder="Выбрать изображение" id="stamp_1">
                        </div>

                        <div class="col-md-12 mb-5">
                            <img id="preview-image-before-upload-1" src="{{ asset('public/img/'.$company->stamp) }}"
                                alt="preview image" style="max-width: 200px;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Печать для Доверенности</label>
                            <input class="form-control form-control-sm" type="file" name="stamp_1" placeholder="Выбрать изображение" id="stamp_2">
                        </div>

                        <div class="col-md-12 mb-5">
                            <img id="preview-image-before-upload-2" src="{{ asset('public/img/'.$company->stamp_1) }}"
                                alt="preview image" style="max-width: 200px;">
                        </div>
                    </div>

                    </div>

                    <input type="hidden" name="id" value="{{ $company->id }}">

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
    @endpush
@endsection