@extends('sb.layouts.app')
@section('title', 'Проверка перевозчиков')
@section('content')
    @push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" />
    <style>
        body {
            background: rgb(248, 249, 250);
        }
        .container.shadow {
            background: #fff;
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
        .ati {
            width: 70px;
        }

        .name, .tel, .email, .trans {
            width: 170px;
        }
    </style>
    @endpush
    @include("sb.includes.header")
    <div class="container-fluid p-3  shadow rounded pt-3 pb-3 mt-4 mb-4">
        @if (\Session::has('success'))
            <div class="alert alert-success mt-5">
                {!! \Session::get('success') !!}
            </div>
        @endif
        <div class="table-responsive mt-5">
            <h4>Новые заявки</h4>
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

                <th scope="col">Водитель</th>
                <th scope="col">Паспорт водителя</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $perevozchiki as $perevozchik )
                    @if($perevozchik->sb_status != 2)
                        <tr class="item" id="{{ $perevozchik->id }}" onclick="window.location.href='/sb/perevozchik-sb/{{ $perevozchik->id }}'">
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
                    @endif
                @endforeach
            </tbody>
            </table>
        </div>
    </div>


    @include("sb.includes.footer")

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