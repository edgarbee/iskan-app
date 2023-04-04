@extends('admin.layouts.app')
@section('title', 'Клиенты')
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
                        <h1 class="h2">Клиенты</h1>
                        <button type="button" class="btn btn-success btn-sm mx-3" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-person-plus"></i> Добавить нового клиента</button>

                        <form action="{{route('excelClients')}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm mx-3"><i class="bi bi-file-earmark-excel"></i> Выгрузить всех клиентов</button>
                        </form>
                    </div>
                    <table class="table table-bordered border-primary table-hover pt-3 mb-3" id="table">
                    <thead>
                        <tr>
                            <th scope="col" class="id">Номер</th>
                            <th scope="col" class="id">Отдел</th>
                            <th scope="col" class="name">ООО/ИП клиента</th>
                            <th scope="col" class="name">Директор</th>
                            <th scope="col" class="contacts">Реквизиты</th>
                            <th scope="col" class="id">Мин. рентабельность</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $clients as $client )
                            <tr class="item" onclick="window.location.href='/admin/clients/{{ $client->id }}'">
                                <th scope="row">{{ $client->id }}</th>
                                <td>{{ $client->otdel }}</td>
                                <td>{{ $client->client_name }}</td>
                                <td>{{ $client->name_director_1 }}</td>
                                <td>{{ $client->rekvizity }}</td>
                                <td>@if(!empty($client->rent)) {{ $client->rent }} % @endif</td>
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
            <h5 class="modal-title" id="exampleModalLabel">Новый клиент</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('clientsAdd') }}" method="POST">
            @csrf
            <div class="modal-body">
            <div class="mb-3">
                <label class="form-label">ООО/ИП клиента</label>
                    <input type="text" class="form-control form-control-sm" name="client_name" required>
                </div> 
                <div class="mb-3">
                    <label class="form-label">Груз</label>
                    <input type="text" class="form-control form-control-sm" name="gruz" required>
                </div> 
                <div class="mb-3">
                    <label class="form-label">Адрес загрузки + контакт</label>
                    <input type="text" class="form-control form-control-sm" name="address_zagruzki_contact" required>
                </div> 
                <div class="mb-3">
                    <label class="form-label">Адрес разгрузки + контакт</label>
                    <input type="text" class="form-control form-control-sm" name="address_vigruzki_contact" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Документы</label>
                    <input type="text" class="form-control form-control-sm" name="document" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Доп. условия к ДЗ из основного договора</label>
                    <input type="text" class="form-control form-control-sm" name="dop_uslovia">
                </div>
                <div class="mb-3">
                    <label class="form-label">ФИО директора в родительном падеже</label>
                    <input type="text" class="form-control form-control-sm" name="name_director_1" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">ФИО директора сокращенно</label>
                    <input type="text" class="form-control form-control-sm" name="name_director_2" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Реквизиты</label>
                    <textarea class="form-control" rows="3" name="rekvizity" style="font-size:12px"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Требуется проверка СБ для нового перевозчика?</label>
                    <select class="form-select form-select-sm" name="likvidnost" required>
                            <option value="" selected>Выберите вариант</option>
                            <option value="0">Да</option>
                            <option value="1">Нет</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Минимальная рентабельность</label>
                    <input type="number" class="form-control form-control-sm" name="rent" min="0.1" step="0.1" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Отдел</label>
                    <select class="form-select form-select-sm" name="otdel" required>
                        <option value="">Отдел не выбран</option>
                        <option value="H1">H1</option>
                        <option value="К2">К2</option>
                        <option value="Z">Z</option>
                        <option value="R">R</option>
                        <option value="A">A</option>
                        <option value="M">M</option>
                        <option value="C">C</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Добавить клиента</button>
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
    @endpush
@endsection