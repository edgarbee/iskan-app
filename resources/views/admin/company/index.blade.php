@extends('admin.layouts.app')
@section('title', 'Компании')
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
                    <div class="d-flex align-items-center flex-wrap mb-3">
                        <h1 class="h2">Компании</h1>
                        <button type="button" class="btn btn-success btn-sm mx-3" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-person-plus"></i> Добавить новую компанию</button>
                    </div>
                    <table class="table table-bordered border-primary table-hover pt-3 mb-3" id="table">
                    <thead>
                        <tr>
                            <th scope="col" class="id">Номер</th>
                            <th scope="col" class="name">Наименование компании</th>
                            <th scope="col" class="name">Имя директор в род. падеже</th>
                            <th scope="col" class="name">Имя директор сокращенно</th>
                            <th scope="col" class="contacts">ИНН + адрес</th>
                            <th scope="col" class="contacts">Реквизиты</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $companies as $company )
                            <tr class="item" onclick="window.location.href='/admin/company/{{ $company->id }}'">
                                <th scope="row">{{ $company->id }}</th>
                                <td>{{ $company->company_name }}</td>
                                <td>{{ $company->name_director_1 }}</td>
                                <td>{{ $company->name_director_2 }}</td>
                                <td>{{ $company->inn }}</td>
                                <td>{{ $company->rekvizity }}</td>
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
            <h5 class="modal-title" id="exampleModalLabel">Новая компания</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('companyAdd') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
            <div class="mb-3">
                <label class="form-label">Наименование компании</label>
                    <input type="text" class="form-control form-control-sm" name="company_name" required>
                </div> 
                <div class="mb-3">
                    <label class="form-label">Имя директор в род. падеже</label>
                    <input type="text" class="form-control form-control-sm" name="name_director_1" required>
                </div> 
                <div class="mb-3">
                    <label class="form-label">Имя директор сокращенно</label>
                    <input type="text" class="form-control form-control-sm" name="name_director_2" required>
                </div> 
                <div class="mb-3">
                    <label class="form-label">ИНН + адрес</label>
                    <input type="text" class="form-control form-control-sm" name="inn" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Реквизиты</label>
                    <textarea class="form-control" rows="3" name="rekvizity" style="font-size:12px"></textarea>
                </div>     
                <div class="mb-3">
                    <label class="form-label">Печать для ДЗ</label>
                    <input class="form-control form-control-sm" type="file" name="stamp" placeholder="Выбрать изображение" id="stamp_1" required>
                </div>

                <div class="col-md-12 mb-5">
                    <img id="preview-image-before-upload-1" src=""
                        alt="preview image" style="max-width: 200px;">
                </div>     
                <div class="mb-3">
                    <label class="form-label">Печать для Доверенности</label>
                    <input class="form-control form-control-sm" type="file" name="stamp_1" placeholder="Выбрать изображение" id="stamp_2" required>
                </div>

                <div class="col-md-12 mb-5">
                    <img id="preview-image-before-upload-2" src=""
                        alt="preview image" style="max-width: 200px;">
                </div>    
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Добавить компанию</button>
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