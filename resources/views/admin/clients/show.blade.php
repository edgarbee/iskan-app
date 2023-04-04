@extends('admin.layouts.app')
@section('title', 'Клиент - '.$client->client_name)
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
    <script>
        function resizeIframe(obj) {
            obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
        }
    </script>
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
                            <form action="{{ route('clientsDelete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $client->id }}">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Вы точно хотите удалить клиента?')"><i class="bi bi-trash3"></i> Удалить</button>
                            </form>
                        </div>
                    </div>
                </div> 
                <form action="{{ route('clientsEdit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">ООО/ИП клиента</label>
                        <input type="text" class="form-control form-control-sm" name="client_name" value="{{ $client->client_name }}">
                    </div> 
                    <div class="mb-3">
                        <label class="form-label">Груз</label>
                        <input type="text" class="form-control form-control-sm" name="gruz" value="{{ $client->gruz }}">
                    </div> 
                    <div class="mb-3">
                        <label class="form-label">Адрес загрузки + контакт</label>
                        <input type="text" class="form-control form-control-sm" name="address_zagruzki_contact" value="{{ $client->address_zagruzki_contact }}">
                    </div> 

                    <iframe frameborder="0" scrolling="no" onload="resizeIframe(this)" class="w-100" srcdoc='<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"><div><form action="{{ route('dopZagruzka') }}" method="POST" onsubmit="window.parent.postMessage(1);"> @csrf <div class="input-group mb-3 ps-5"> <input placeholder="Добавить дополнительны адрес загрузки" required type="text" class="form-control form-control-sm" name="dop_address_zagruzki_contact"> <input type="hidden" name="client_id" value="{{ $client->id }}"> <input class="btn btn-primary btn-sm" type="submit" name="action" value="Добавить"> </div> </form> <div class="ps-5"><hr></div>@if(!($client->dop_zagruzka)->isEmpty()) <div class="ps-5"> <label class="form-label">Дополнительные адреса загрузки + контакт</label> </div>@foreach($client->dop_zagruzka as $dop_zagruzka) <form action="{{ route('dopZagruzka') }}" method="POST" onsubmit="window.parent.postMessage(1);"> @csrf <div class="input-group mb-3 ps-5"> <input type="text" class="form-control form-control-sm" name="dop_address_zagruzki_contact" value="{{ $dop_zagruzka->dop_address_zagruzki_contact }}"> <input type="hidden" name="dop_zagruzka_id" value="{{ $dop_zagruzka->id }}"> <input class="btn btn-success btn-sm" type="submit" name="action" value="Изменить"> <input class="btn btn-danger btn-sm" type="submit" name="action" value="Удалить"> </div> </form> @endforeach @endif</div>'></iframe>

                    <div class="mb-3 mt-3">
                        <label class="form-label">Адрес разгрузки + контакт</label>
                        <input type="text" class="form-control form-control-sm" name="address_vigruzki_contact" value="{{ $client->address_vigruzki_contact }}">
                    </div>
                    

                    <iframe frameborder="0" scrolling="no" onload="resizeIframe(this)" class="w-100" srcdoc='<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"><div><form action="{{ route('dopVigruzka') }}" method="POST" onsubmit="window.parent.postMessage(1);"> @csrf <div class="input-group mb-3 ps-5"> <input placeholder="Добавить дополнительны адрес разгрузки" required type="text" class="form-control form-control-sm" name="dop_address_zagruzki_contact"> <input type="hidden" name="client_id" value="{{ $client->id }}"> <input class="btn btn-primary btn-sm" type="submit" name="action" value="Добавить"> </div> </form> <div class="ps-5"><hr></div>@if(!($client->dop_vigruzka)->isEmpty()) <div class="ps-5"> <label class="form-label">Дополнительные адреса разгрузки + контакт</label> </div>@foreach($client->dop_vigruzka as $dop_zagruzka) <form action="{{ route('dopVigruzka') }}" method="POST" onsubmit="window.parent.postMessage(1);"> @csrf <div class="input-group mb-3 ps-5"> <input type="text" class="form-control form-control-sm" name="dop_address_zagruzki_contact" value="{{ $dop_zagruzka->dop_address_zagruzki_contact }}"> <input type="hidden" name="dop_zagruzka_id" value="{{ $dop_zagruzka->id }}"> <input class="btn btn-success btn-sm" type="submit" name="action" value="Изменить"> <input class="btn btn-danger btn-sm" type="submit" name="action" value="Удалить"> </div> </form> @endforeach @endif</div>'></iframe>

                    <div class="mb-3 mt-3">
                        <label class="form-label">Документы</label>
                        <input type="text" class="form-control form-control-sm" name="document" value="{{ $client->document }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Доп. условия к ДЗ из основного договора</label>
                        <input type="text" class="form-control form-control-sm" name="dop_uslovia" value="{{ $client->dop_uslovia }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ФИО директора в родительном падеже</label>
                        <input type="text" class="form-control form-control-sm" name="name_director_1" value="{{ $client->name_director_1 }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ФИО директора сокращенно</label>
                        <input type="text" class="form-control form-control-sm" name="name_director_2" value="{{ $client->name_director_2 }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Реквизиты</label>
                        <textarea class="form-control" rows="3" name="rekvizity" value="{{ $client->rekvizity }}" style="font-size:12px">{{ $client->rekvizity }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Требуется проверка СБ для нового перевозчика?</label>
                        <select class="form-select form-select-sm" name="likvidnost">
                            <option value="0" @if($client->likvidnost == 0) selected @endif >Да</option>
                            <option value="1" @if($client->likvidnost == 1) selected @endif >Нет</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Минимальная рентабельность</label>
                        <input type="number" class="form-control form-control-sm" name="rent" value="{{ $client->rent }}" min="0.1" step="0.1">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Отдел</label>
                        <select class="form-select form-select-sm" name="otdel" >
                            <option value="" @if($client->otdel == "") selected @endif>Отдел не выбран</option>
                            <option value="H1" @if($client->otdel == "H1") selected @endif>H1</option>
                            <option value="К2" @if($client->otdel == "К2") selected @endif>К2</option>
                            <option value="Z" @if($client->otdel == "Z") selected @endif>Z</option>
                            <option value="R" @if($client->otdel == "R") selected @endif>R</option>
                            <option value="A" @if($client->otdel == "A") selected @endif>A</option>
                            <option value="M" @if($client->otdel == "M") selected @endif>M</option>
                            <option value="C" @if($client->otdel == "C") selected @endif>C</option>
                        </select>
                    </div>
                    <input type="hidden" name="id" value="{{ $client->id }}">

                    <button type="submit" class="btn btn-sm btn-success mb-5"><i class="bi bi-pencil-square"></i> Изменить</button>
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
        window.addEventListener('message', function(event) {
        var message = event.data;
        if(message == 1) {
            location.reload();
        }
        });
    </script>
    @endpush
@endsection