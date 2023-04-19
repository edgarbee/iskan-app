@extends('dz.layouts.app')
@section('title', 'Создание ДЗ')
@section('content')
    @push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" integrity="sha512-f0tzWhCwVFS3WeYaofoLWkTP62ObhewQ1EZn65oSYDZUg1+CyywGKkWzm8BxaJj5HGKI72PnMH9jYyIFz+GH7g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background: rgb(248, 249, 250);
        }
        .search_box {
        position: relative;
        }
        .search_result {
            position: absolute;
            top: 100%;
            left: 0;
            border: 1px solid #ddd;
            background: #fff;
            padding: 10px;
            width: 100%;
            z-index: 9999;
            height: 17em;
            overflow-y: scroll;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
            font-size: 12px;
        }
        .container.shadow {
            background: #fff;
        }
        .alert {
            font-size: 12px; font-weight: 700;
            padding: 10px;
        }

        .input-group-text, .select2-container--bootstrap-5 .select2-dropdown .select2-results__options .select2-results__option, .form-select-sm~.select2-container--bootstrap-5 .select2-selection--multiple .select2-selection__rendered .select2-selection__choice {
            font-size: 12px !important;
        }

        .show-col {
            display: none;
        }
        @media(max-width: 568px) {
            .hidden {
                display: none;
            }

            .show-col {
                display: block;
            }
        }
    </style>
    @endpush
    @include("dz.includes.header")
    <div class="container p-3  shadow rounded pt-3 pb-3 mt-4 mb-4">
        <form action="{{ route('generatePDF') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12 mt-2">
                    <div class="row">
                        <div class="col-md-12 mb-2" style="font-size: 12px; font-weight: 700">
                            <span style="color:#d0021b">*</span> Общая информация
                        </div>
                        <div class="col-md-3">
                            <div class="mb-1">
                                <input type="text" class="form-control form-control-sm" name="dz[nomer]" required placeholder="Договор заявка №">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-1">
                                <input type="date" name="dz[date]"  class="form-control form-control-sm" required placeholder="Дата">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-1">
                                <select class="form-select form-select-sm" name="dz[company_name]" required placeholder="Наша компания">
                                    <option value="">Выберите нашу компанию</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->company_name }}">{{ $company->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="search_box">
                                <div class="mb-1">
                                    <input type="text" class="form-control form-control-sm" name="dz[client_name]" id="client_name" required placeholder="Клиент">
                                </div>
                                <div id="search_box-result-client"></div>
                            </div>
                            <div class="mb-1 d-none">
                                <label class="form-label">Логист</label>
                                <input type="hidden" class="form-control form-control-sm" name="dz[logist_name]" value="{{ \Auth::user()->name }}">
                            </div>
                        </div>
                    </div>


                    <div class="row mt-2">
                        <div class="col-md-12 mb-2" style="font-size: 12px; font-weight: 700">
                            <span style="color:#d0021b">*</span> Информация о перевозчике ( <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Добавить нового перевозчика</a> )
                        </div>
                        <div class="col-md-3">
                            <div class="search_box">
                                <div class="mb-1">
                                    <input type="text" class="form-control form-control-sm" name="dz[perevozchik_name]" id="perevozchik_name" required placeholder="Исполнитель">
                                </div>
                                <div id="search_box-result-perevozchik"></div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-1">
                                <select class="form-select form-select-sm" name="dz[perevozchik_ts]" id="perevozchik_ts" required placeholder="Транспорт">
                                    <option value="" selected>Выберите транспорт</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-1">
                                <select class="form-select form-select-sm" name="dz[perevozchik_voditel]" id="perevozchik_voditel" required>
                                    <option value="" selected>Выберите водителя</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-1">
                                <select class="form-select form-select-sm" name="dz[perevozchik_tel]" id="perevozchik_tel" required>
                                    <option value="" selected>Выберите контакт водителя</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="alert mt-2 mb-0" role="alert" id="indikator_sb" style="display: none;"></div>

                            <input type="hidden" name="dz[indikator_sb]" value="0" id="indikator_sb_hidden">
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-2" style="font-size: 12px; font-weight: 700">
                            <span style="color:#d0021b">*</span> Груз
                        </div>
                        <div class="col-md-4">
                            <div class="mb-1">
                                <input type="text" class="form-control form-control-sm" name="dz[gruz_poym]" id="gruz_poym" placeholder="Введите груз" required>
                                <input type="hidden" class="form-control form-control-sm" name="dz[gruz_fact]" id="gruz_fact">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="">
                                <select class="form-select form-select-sm" name="dz[upakovka]" id="upakovka" placeholder="Упаковка" required>
                                    <option value="" selected>Выберите упаковку</option>
                                    <option value="Навалом">Навалом</option>
                                    <option value="Коробки">Коробки</option>
                                    <option value="Россыпью">Россыпью </option>
                                    <option value="Паллеты">Паллеты</option>
                                    <option value="Пачки">Пачки</option>
                                    <option value="Мешки">Мешки</option>
                                    <option value="Биг-бэги">Биг-бэги</option>
                                    <option value="Ящики">Ящики</option>
                                    <option value="Листы">Листы</option>
                                    <option value="Бочки">Бочки</option>
                                    <option value="Канистры">Канистры</option>
                                    <option value="Рулоны">Рулоны</option>
                                    <option value="Пирамида">Пирамида</option>
                                    <option value="Еврокубы">Еврокубы</option>
                                    <option value="Катушки">Катушки</option>
                                    <option value="Барабаны">Барабаны</option>
                                </select>
                            </div>
                            <a data-bs-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="false" aria-controls="collapseExample4" style="font-size: 10px; font-weight: 700">Указать кол-во</a>
                            <div class="collapse" id="collapseExample4">
                                <div class="col-md-12">
                                    <input type="text" name="dz[upakovka_kolvo]" id="upakovka_kolvo"  class="form-control form-control-sm" placeholder="Введите кол-во" style="font-size: 10px;">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="mb-1">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control form-control-sm" name="dz[ves]" id="ves" placeholder="Вес">
                                    <span class="input-group-text">т.</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="mb-1">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control form-control-sm" name="dz[objem]" id="objem" placeholder="Объем">
                                    <span class="input-group-text">м<sup>3</sup></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-2" style="font-size: 12px; font-weight: 700">
                            <span style="color:#d0021b">*</span> Загрузка
                        </div>
                        <div class="col-md-2">
                            <div class="mb-1">
                                <input type="date" name="dz[date_zagruzki]" id="date_zagruzki"  class="form-control form-control-sm" placeholder="Дата загрузки" required>
                                <a data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample1" style="font-size: 10px; font-weight: 700">Добавить время</a>
                                <div class="collapse" id="collapseExample1">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" name="dz[date_zagruzki_time_start]" id="date_zagruzki_time_start"  class="form-control form-control-sm" placeholder="C" style="font-size: 10px;">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="dz[date_zagruzki_time_end]" id="date_zagruzki_time_end"  class="form-control form-control-sm" placeholder="До" style="font-size: 10px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-1">
                                <select class="form-select form-select-sm" name="dz[address_zagruzki_contact]" id="address_zagruzki_contact" required>
                                    <option value="" selected>Выберите адрес загрузки + контактное лицо</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-1">
                                <select class="form-select form-select-sm" name="dz[type_zagruzki][]" id="type_zagruzki" required multiple data-placeholder="Выберите способ загрузки">
                                    <option value="верхняя">верхняя</option>
                                    <option value="боковая">боковая</option>
                                    <option value="задняя">задняя</option>
                                    <option value="с полной растентовкой">с полной растентовкой</option>
                                    <option value="со снятием стоек">со снятием стоек</option>
                                    <option value="без ворот">без ворот</option>
                                    <option value="гидроборт">гидроборт</option>
                                    <option value="аппарели">аппарели</option>
                                    <option value="с обрешёткой">с обрешёткой</option>
                                    <option value="с бортами">с бортами</option>
                                    <option value="боковая с 2-х сторон">боковая с 2-х сторон</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-2" style="font-size: 12px; font-weight: 700">
                            <span style="color:#d0021b">*</span> Разгрузка
                        </div>
                        <div class="col-md-2">
                            <div class="mb-1">
                                <input type="date" name="dz[date_vigruzki]" id="date_razgruzki"  class="form-control form-control-sm" placeholder="Дата разгрузки" required>
                                <a data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2" style="font-size: 10px; font-weight: 700">Добавить время</a>
                                <div class="collapse" id="collapseExample2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" name="dz[date_razgruzki_time_start]" id="date_razgruzki_time_start"  class="form-control form-control-sm" placeholder="C" style="font-size: 10px;">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="dz[date_razgruzki_time_end]" id="date_razgruzki_time_end"  class="form-control form-control-sm" placeholder="До" style="font-size: 10px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-1">
                                <select class="form-select form-select-sm" name="dz[address_vigruzki_contact]" id="address_vigruzki_contact" required>
                                    <option value="" selected>Выберите адрес разгрузки + контактное лицо</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-1">
                                <select class="form-select form-select-sm" name="dz[type_razgruzki][]" id="type_razgruzki" required multiple data-placeholder="Выберите способ разгрузки">
                                    <option value="верхняя">верхняя</option>
                                    <option value="боковая">боковая</option>
                                    <option value="задняя">задняя</option>
                                    <option value="с полной растентовкой">с полной растентовкой</option>
                                    <option value="со снятием стоек">со снятием стоек</option>
                                    <option value="без ворот">без ворот</option>
                                    <option value="гидроборт">гидроборт</option>
                                    <option value="аппарели">аппарели</option>
                                    <option value="с обрешёткой">с обрешёткой</option>
                                    <option value="с бортами">с бортами</option>
                                    <option value="боковая с 2-х сторон">боковая с 2-х сторон</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row  mt-2">
                        <div class="col-md-2" style="font-size: 12px; font-weight: 700">
                            Доп. информация
                        </div>
                        <div class="col-md-5">
                            <div class="mb-1">
                                <select class="form-select form-select-sm" name="dz[client_transport][]" id="client_transport" required multiple data-placeholder="Тип требуемого транспорта">
                                    <option value="закрытый">закрытый</option>
                                    <option value="тентованный">тентованный</option>
                                    <option value="контейнер">контейнер</option>
                                    <option value="фургон">фургон</option>
                                    <option value="цельнометалл">цельнометалл</option>
                                    <option value="изотермический">изотермический</option>
                                    <option value="рефрижератор">рефрижератор</option>
                                    <option value="все открытые">все открытые</option>
                                    <option value="бортовой">бортовой</option>
                                    <option value="самосвал">самосвал</option>
                                    <option value="низкорамный">низкорамный</option>
                                    <option value="трал">трал</option>
                                    <option value="низкорам.платформа">низкорам.платформа</option>
                                    <option value="балковоз (негабарит)">балковоз (негабарит)</option>
                                    <option value="контейнеровоз">контейнеровоз</option>
                                    <option value="зерновоз">зерновоз</option>
                                    <option value="кран">кран</option>
                                    <option value="манипулятор">манипулятор</option>
                                    <option value="цистерна">цистерна</option>
                                    <option value="мега фура">мега фура</option>
                                    <option value="муковоз">муковоз</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-1">
                                <input type="text" class="form-control form-control-sm" name="dz[dop_trebovaniy]" id="dop_trebovaniy" placeholder="Доп. требования к перевозчику">
                            </div>
                        </div>
                    </div>
                    <div class="row  mt-2">
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-5">
                            <div class="mb-1">
                                <input type="text" class="form-control form-control-sm" name="dz[document]" id="document" placeholder="Необходимые документы для оплаты" required>
                                <input type="hidden" class="form-control form-control-sm" name="dz[document_fact]" id="document_fact">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-1">
                                <input type="text" class="form-control form-control-sm" name="dz[dop_uslovia]" id="dop_uslovia" placeholder="Доп. условия к ДЗ из основного договора">
                            </div>
                        </div>

                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <h5 style="font-size: 12px; font-weight: 700">Оплата</h5>
                        </div>
                        <div class="col-md-6">
                            <div class="row mt-2">
                                <div class="col-md-12 mb-2" style="font-size: 12px; font-weight: 700">
                                    <span style="color:#d0021b">*</span> Для клиента
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <input type="text" class="form-control form-control-sm" name="dz[oplata_client]" id="oplata_client" required placeholder="Стоимость оплаты для клиента">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <select class="form-select form-select-sm" name="dz[forma_oplata_client]" id="forma_oplata_client" required>
                                            <option value="" selected>Форма оплаты для клиента</option>
                                            <option value="С НДС">С НДС</option>
                                            <option value="Без НДС">Без НДС</option>
                                            <option value="На карту">На карту</option>
                                            <option value="Нет">Нет</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 hidden">
                                    <div class="mb-1">
                                        <label class="form-label" style="font-size: 12px; font-weight: 700">Прибыль</label>
                                        <input type="text" class="form-control form-control-sm" name="dz[pribl]" id="pribl" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3 hidden">
                                    <div class="mb-1">
                                        <label class="form-label" style="font-size: 12px; font-weight: 700">Рентабельность</label>
                                        <input type="text" class="form-control form-control-sm" name="dz[rent]" id="rent" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3 hidden">
                                    <div class="mb-1">
                                        <label class="form-label" style="font-size: 12px; font-weight: 700">Логисту</label>
                                        <input type="text" class="form-control form-control-sm" name="dz[logist_pribl]" id="logist_pribl" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3 hidden">
                                    <div class="mb-1">
                                        <label class="form-label" style="font-size: 12px; font-weight: 700">Продажнику</label>
                                        <input type="text" class="form-control form-control-sm" name="dz[prodaznik_pribl]" id="prodaznik_pribl" readonly>
                                    </div>
                                </div>
                                <input type="hidden" name="min_rent" id="min_rent" value="">
                                <div class="col-md-12 hidden">
                                    <div class="alert mt-2 mb-0" role="alert" id="indikator_otgruzki" style="display: none;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row mt-2">
                                <div class="col-md-12 mb-2" style="font-size: 12px; font-weight: 700">
                                    <span style="color:#d0021b">*</span> Для перевозчика
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <input type="text" class="form-control form-control-sm" name="dz[oplata_perevozchik]" id="oplata_perevozchik" required placeholder="Стоимость оплаты для перевозчика">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <select class="form-select form-select-sm" name="dz[forma_oplata_company]" id="forma_oplata_company" required>
                                            <option value="" selected>Форма оплаты</option>
                                            <option value="С НДС">С НДС</option>
                                            <option value="Без НДС">Без НДС</option>
                                            <option value="На карту">На карту</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <select class="form-select form-select-sm" name="dz[cshet_company]" id="cshet_company" required>
                                            <option value="" selected>Счёт на компанию</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->company_name }}">{{ $company->company_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <select class="form-select form-select-sm" name="dz[srok_oplata]" id="srok_oplata" required data-placeholder="Срок оплаты">
                                            <option value="">Выберите срок оплаты</option>
                                            <option>7-12 б. д. по сканам и квитку</option>
                                            <option>5 б. д. по сканам и квитку</option>
                                            <option>1 б. д. по сканам и квитку</option>
                                            <option>Предоплата 30%, остаток - 7-12 б. д. по сканам и квитку. В случае получения предоплаты исполнитель обязуется доставить груз в место выгрузки.</option>
                                            <option>Предоплата 50%, остаток - 7-12 б. д. по сканам и квитку. В случае получения предоплаты исполнитель обязуется доставить груз в место выгрузки.</option>
                                            <option>Предоплата 80%, остаток - 7-12 б. д. по сканам и квитку. В случае получения предоплаты исполнитель обязуется доставить груз в место выгрузки.</option>
                                            <option>7-12 б. д. по оригиналам документов</option>
                                            <option>5 б. д. по оригиналам документов</option>
                                            <option>1 б. д. по оригиналам документов</option>
                                            <option>Предоплата 30%, остаток - 7-12 б. д. по оригиналам документов. В случае получения предоплаты исполнитель обязуется доставить груз в место выгрузки.</option>
                                            <option>Предоплата 50%, остаток - 7-12 б. д. по оригиналам документов. В случае получения предоплаты исполнитель обязуется доставить груз в место выгрузки.</option>
                                            <option>Предоплата 80%, остаток - 7-12 б. д. по оригиналам документов. В случае получения предоплаты исполнитель обязуется доставить груз в место выгрузки.</option>
                                            <option>По сканам после выгрузки</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <a data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" style="font-size: 12px; font-weight: 700">Выставить счет на партнера?</a>
                                    <div class="collapse" id="collapseExample">
                                        <div class="row align-items-center">
                                            <div class="col-md-10">
                                                <div class="mb-1">
                                                    <select class="form-select form-select-sm" name="dz[partner_name]" id="partner_name">
                                                        <option value="Не выбрано" selected>Выберите партнера</option>
                                                        @foreach ($partner_companies as $partner_company)
                                                            <option value="{{ $partner_company->company_name }}">{{ $partner_company->company_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-light mb-1" id="deletePartner"><i class="bi bi-trash3"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 show-col">

                                </div>

                                <div class="col-md-12 mt-2">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="submit" class="btn btn-primary w-100 mt-2" id="btnSub" value="СОЗДАТЬ ДЗ ПЕРЕВОЗЧИК" name="type_doc" style="font-size: 10px;">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="submit" class="btn btn-primary w-100 mt-2" id="btnSub1" value="СОЗДАТЬ ДЗ КЛИЕНТ" name="type_doc" style="font-size: 10px;">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="submit" class="btn btn-primary w-100 mt-2" id="btnSub2" value="СОЗДАТЬ ДОВЕРЕННОСТЬ" name="type_doc" style="font-size: 10px;">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Новый перевозчик</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addPerevozchik" method="POST">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 per mb-2">
                        <div class="mb-1">
                            <input type="text" class="form-control form-control-sm" name="p[code_ATI]" id="code_ATI" placeholder="Код АТИ" required>
                        </div>
                    </div>
                    <div class="col-md-6 per mb-2">
                        <div class="mb-1">
                            <input type="text" class="form-control form-control-sm" name="p[perevozchik_name]" id="perevozchik_name" placeholder="ООО/ИП перевозчика" required>
                        </div>
                    </div>
                    <div class="col-md-6 per mb-2">
                        <div class="mb-1">
                            <input type="tel" class="tel form-control form-control-sm" name="p[perevozchik_tel]" id="perevozchik_tel" placeholder="Телефон диспетчера" required>
                        </div>
                    </div>
                    <div class="col-md-6 per mb-2">
                        <div class="mb-1">
                            <input type="email" class="form-control form-control-sm" name="p[perevozchik_email]" id="perevozchik_email" placeholder="Почта диспетчера" required>
                        </div>
                    </div>
                    <div class="col-md-6 per mb-2">
                        <div class="mb-1">
                            <input type="text" class="form-control form-control-sm" name="p[type_transport]" id="type_transport" placeholder="Тип транспорта" required>
                        </div>
                    </div>
                    <div class="col-md-6 per mb-2">
                        <div class="mb-1">
                            <input type="text" class="form-control form-control-sm" name="p[perevozchik_ts]" id="perevozchik_ts" placeholder="Транспортное стредство" required>
                        </div>
                    </div>
                    <div class="col-md-6 per mb-2">
                        <div class="mb-1">
                            <input type="text" class="form-control form-control-sm" name="p[perevozchik_voditel]" id="perevozchik_voditel" placeholder="Водитель" required>
                        </div>
                    </div>
                    <div class="col-md-6 per mb-2">
                        <div class="mb-1">
                            <input type="tel" class="tel form-control form-control-sm" name="p[perevozchik_voditel_tel]" id="perevozchik_voditel_tel" placeholder="Телефон водителя" required>
                        </div>
                    </div>
                    <div class="col-md-6 per mb-2">
                        <div class="mb-1">
                            <input type="text" class="form-control form-control-sm" name="p[pasport_voditel]" id="pasport_voditel" placeholder="Паспорт водителя" required>
                        </div>
                    </div>
                    <div class="col-md-6 per mb-2">
                        <div class="mb-1">
                            <input type="text" class="form-control form-control-sm" name="p[home_region]" id="home_region" placeholder="Домашний регион">
                        </div>
                    </div>
                    <div class="col-md-6 per mb-2">
                        <div class="mb-1">
                            <input type="text" class="form-control form-control-sm" name="p[name_director]" id="name_director" placeholder="ФИО директора" required>
                        </div>
                    </div>
                    <div class="col-md-6 per mb-2">
                        <div class="mb-1">
                            <input type="text" class="form-control form-control-sm" name="p[karta_sber]" id="karta_sber" placeholder="Карта сбербанка">
                        </div>
                    </div>
                    <div class="col-md-12 per mb-2">
                        <div class="mb-1">
                            <textarea  class="form-control form-control-sm" name="p[contacts]" id="contacts" placeholder="Реквизиты" required></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="alert mb-0" role="alert" id="indikator_tel" style="display: none;"></div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="test">Отправить на проверку</button>
            </div>
            </form>
        </div>
        </div>
    </div>

    @include("dz.includes.history")
    @include("dz.includes.footer")

    @push('scripts')
    <script>
        if (Math.min(window.screen.width) <= 568) {
          $('.hidden').remove();
          $('.show-col').append('<div class="row"> <div class="col-md-3"> <div class="mb-1"> <label class="form-label" style="font-size: 12px; font-weight: 700">Прибыль</label> <input type="text" class="form-control form-control-sm" name="dz[pribl]" id="pribl" readonly> </div> </div> <div class="col-md-3"> <div class="mb-1"> <label class="form-label" style="font-size: 12px; font-weight: 700">Рентабельность</label> <input type="text" class="form-control form-control-sm" name="dz[rent]" id="rent" readonly> </div> </div> <div class="col-md-3"> <div class="mb-1"> <label class="form-label" style="font-size: 12px; font-weight: 700">Логисту</label> <input type="text" class="form-control form-control-sm" name="dz[logist_pribl]" id="logist_pribl" readonly> </div> </div> <div class="col-md-3"> <div class="mb-1"> <label class="form-label" style="font-size: 12px; font-weight: 700">Продажнику</label> <input type="text" class="form-control form-control-sm" name="dz[prodaznik_pribl]" id="prodaznik_pribl" readonly> </div> </div> <div class="col-md-12"> <div class="alert mt-2 mb-0" role="alert" id="indikator_otgruzki" style="display: none;"></div> </div> </div>');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    $(function() {
        $('#date_zagruzki_time_start, #date_zagruzki_time_end, #date_razgruzki_time_start, #date_razgruzki_time_end').datetimepicker({
            datepicker:false,
            format:'H:i'
        });
    });
    </script>

    <script>
        $( '#type_zagruzki, #type_razgruzki, #client_transport' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
            tags: true
        } );

        $( '#srok_oplata, #address_zagruzki_contact, #address_vigruzki_contact' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
            tags: true
        } );

        $('#type_zagruzki, #type_razgruzki, #client_transport, #srok_oplata, #address_zagruzki_contact, #address_vigruzki_contact').on('select2:select', function (e) {
            $(this).select2("close");
        });
    </script>


    <script>
        $(document).ready(function() {
            var $result = $('#search_box-result-client');

            $('#client_name').on('keyup', function(){
                var client_name = $(this).val();
                if ((client_name != '') && (client_name.length > 1)){
                    $.ajax({
                        type: "POST",
                        url: "{{ route('searchClient') }}",
                        data: {'client_name': client_name, '_token': $('meta[name="csrf-token"]').attr('content')},
                        success: function(msg){
                            $result.html(msg);
                            if(msg != ''){
                                $result.fadeIn();
                            } else {
                                $result.fadeOut(100);
                            }
                        }
                    });
                } else {
                    $result.html('');
                    $result.fadeOut(100);
                }
            });

            $(document).on('click', function(e){
                if (!$(e.target).closest('.search_box').length){
                    $result.html('');
                    $result.fadeOut(100);
                }
            });

            $(document).on('click', '.client_name', function(){
                $('#client_name').val($(this).text());
                $('#gruz_poym').val($(this).parent().find('.gruz').text());

                var address_zagruzki = JSON.parse($(this).parent().find('.address_zagruzki_contact').text());
                address_zagruzki = address_zagruzki.split(" | ");
                for (key in address_zagruzki) {
                    if (address_zagruzki.hasOwnProperty(key)) {
                        $('#address_zagruzki_contact').append('<option value="'+address_zagruzki[key]+'">'+address_zagruzki[key]+'</option>');
                    }
                }

                var address_vigruzki = JSON.parse($(this).parent().find('.address_vigruzki_contact').text());
                address_vigruzki = address_vigruzki.split(" | ");
                for (key in address_vigruzki) {
                    if (address_vigruzki.hasOwnProperty(key)) {

                    }
                }

                $('#document').val($(this).parent().find('.document').text());
                $('#dop_uslovia').val($(this).parent().find('.dop_uslovia').text());
                $('#min_rent').val($(this).parent().find('.rent').text());
                $result.fadeOut(100);
                return false;
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            var $result = $('#search_box-result-perevozchik');

            $('#perevozchik_name').on('keyup', function(){
                var perevozchik_name = $(this).val();
                if ((perevozchik_name != '') && (perevozchik_name.length > 1)){
                    $.ajax({
                        type: "POST",
                        url: "{{ route('searchPerevozchik') }}",
                        data: {'perevozchik_name': perevozchik_name, '_token': $('meta[name="csrf-token"]').attr('content')},
                        success: function(msg){
                            $result.html(msg);
                            if(msg != ''){
                                $result.fadeIn();
                            } else {
                                $result.fadeOut(100);
                            }
                        }
                    });
                } else {
                    $result.html('');
                    $result.fadeOut(100);
                }
            });

            $(document).on('click', function(e){
                if (!$(e.target).closest('.search_box').length){
                    $result.html('');
                    $result.fadeOut(100);
                }
            });

            var data_proverki = '';
            var perevozchik_name = '';

            $(document).on('click', '.perevozchik_name', function(){
                $('#perevozchik_tel, #perevozchik_ts, #perevozchik_voditel').find('option').remove();
                perevozchik_name = $('#perevozchik_name').val($(this).text());
                data_proverki = $(this).parent().find('.data_proverki').text();

                var client_name = $('#client_name').val();

                var perevozchik_tel = JSON.parse($(this).parent().find('.perevozchik_tel').text());
                for (key in perevozchik_tel) {
                    if (perevozchik_tel.hasOwnProperty(key)) {
                        $('#perevozchik_tel').append('<option value="'+perevozchik_tel[key]+'">'+perevozchik_tel[key]+'</option>');
                    }
                }

                var perevozchik_ts = JSON.parse($(this).parent().find('.perevozchik_ts').text());
                for (key in perevozchik_ts) {
                    if (perevozchik_ts.hasOwnProperty(key)) {
                        $('#perevozchik_ts').append('<option value="'+perevozchik_ts[key]+'">'+perevozchik_ts[key]+'</option>');
                    }
                }

                var perevozchik_voditel = JSON.parse($(this).parent().find('.perevozchik_voditel').text());
                for (key in perevozchik_voditel) {
                    if (perevozchik_voditel.hasOwnProperty(key)) {
                        $('#perevozchik_voditel').append('<option value="'+perevozchik_voditel[key]+'">'+perevozchik_voditel[key]+'</option>');
                    }
                }

                if (!data_proverki) {
                    $('#indikator_sb').show().addClass('alert-warning').removeClass('alert-success').text('Требуется проверка СБ');
                    $('#indikator_sb_hidden').val(0);
                }
                if(data_proverki) {
                    $('#indikator_sb').show().addClass('alert-success').removeClass('alert-warning').text('Проверка СБ не требуется');
                    $('#indikator_sb_hidden').val(1);
                }
                if (!data_proverki @foreach($clients as $client) @if($loop->first) @php echo "&& (client_name == '".$client->client_name."'"; @endphp @endif  @php echo " || client_name == '".$client->client_name."'"; @endphp @if ($loop->last) @php echo ")"; @endphp @endif @endforeach) {
                    $('#indikator_sb').show().addClass('alert-success').removeClass('alert-warning').text('Проверка СБ не требуется');
                    $('#indikator_sb_hidden').val(1);
                }

                $result.fadeOut(100);
                return false;
            });

            $(document).on('click', '.client_name', function(){
                var client_name = $('#client_name').val();

                if (!data_proverki && perevozchik_name != '') {
                    $('#indikator_sb').show().addClass('alert-warning').removeClass('alert-success').text('Требуется проверка СБ');
                    $('#indikator_sb_hidden').val(0);
                }
                if(data_proverki && perevozchik_name != '') {
                    $('#indikator_sb').show().addClass('alert-success').removeClass('alert-warning').text('Проверка СБ не требуется');
                    $('#indikator_sb_hidden').val(1);
                }
                if (!data_proverki @foreach($clients as $client) @if($loop->first) @php echo "&& (client_name == '".$client->client_name."'"; @endphp @endif  @php echo " || client_name == '".$client->client_name."'"; @endphp @if ($loop->last) @php echo ")"; @endphp @endif @endforeach && perevozchik_name != '') {
                    $('#indikator_sb').show().addClass('alert-success').removeClass('alert-warning').text('Проверка СБ не требуется');
                    $('#indikator_sb_hidden').val(1);
                }
            });


        });
    </script>

    {{-- <script>
        $(document).ready(function() {
            var $result = $('#forma_oplata_company');

            $('#cshet_company').on('click', function(){
                var company_name_option = $(this).val();

                $.ajax({
                    type: "POST",
                    url: "{{ route('searchCompany') }}",
                    data: {'company_name': company_name_option, '_token': $('meta[name="csrf-token"]').attr('content')},
                    success: function(msg){
                        $result.html(msg);
                        if(msg != ''){
                            $result.fadeIn();
                        } else {

                        }
                    }
                });

            });

        });
    </script> --}}

    <script>
        $(document).ready(function() {
            var $result = $('#pribl');
            var $rent = $('#rent');
            var $logist_pribl = $('#logist_pribl');
            var $prodaznik_pribl = $('#prodaznik_pribl');

            var $summa = 0;

            var forma_oplata_client = $('#forma_oplata_client').val();
            var forma_oplata_company = $('#forma_oplata_company').val();

            $('#forma_oplata_client, #forma_oplata_company, #oplata_client, #oplata_perevozchik').bind('keyup change blur', function(){
                forma_oplata_client = $('#forma_oplata_client').val();
                forma_oplata_company = $('#forma_oplata_company').val();

                var oplata_client = $('#oplata_client').val();
                var oplata_perevozchik = $('#oplata_perevozchik').val();

                if(forma_oplata_client == "С НДС" && forma_oplata_company == "Без НДС" && oplata_client > 0 && oplata_perevozchik > 0) {
                    $summa = oplata_client-oplata_perevozchik-(oplata_client/100)-(oplata_perevozchik/100)*16.6;
                    $summa = $summa/100*88-(oplata_client/200);
                }
                if(forma_oplata_client == "С НДС" && forma_oplata_company == "С НДС" && oplata_client > 0 && oplata_perevozchik > 0) {
                    $summa = (oplata_client-oplata_perevozchik-(oplata_client-oplata_perevozchik)/100)*0.99/100*83.4-(oplata_client-oplata_perevozchik)/100*2;
                }
                if(forma_oplata_client == "Без НДС" && forma_oplata_company == "Без НДС" && oplata_client > 0 && oplata_perevozchik > 0) {
                    $summa = (oplata_client-oplata_perevozchik-oplata_perevozchik/100*1)/100*98;
                }
                if(forma_oplata_client == "С НДС" && forma_oplata_company == "На карту" && oplata_client > 0 && oplata_perevozchik > 0) {
                    $summa = oplata_client-oplata_perevozchik-(oplata_client/100)-oplata_client/100*16.6-oplata_client/200;
                }
                if(forma_oplata_client == "Без НДС" && forma_oplata_company == "На карту" && oplata_client > 0 && oplata_perevozchik > 0) {
                    $summa = oplata_client-oplata_perevozchik-(oplata_client/100)-oplata_client/100*2-oplata_perevozchik/100*0.5-oplata_client/200;
                }
                if(forma_oplata_client == "На карту" && forma_oplata_company == "С НДС" && oplata_client > 0 && oplata_perevozchik > 0) {
                    $summa = (oplata_client/0.9-oplata_perevozchik)/100*89;
                }
                if(forma_oplata_client == 'Нет' && forma_oplata_company == "На карту" && oplata_client > 0 && oplata_perevozchik > 0) {
                    $summa = oplata_client-oplata_perevozchik-oplata_perevozchik/200;
                }

                if (oplata_client > 0 && oplata_perevozchik > 0) {
                    $result.val($summa.toFixed(2)+' ₽');
                    $rent.val((($summa*0.7/oplata_perevozchik)*100).toFixed(2)+' %');
                    $logist_pribl.val(($summa/5).toFixed(2)+' ₽');
                    $prodaznik_pribl.val((($summa/5)/2).toFixed(2)+' ₽');

                    if(forma_oplata_company == "Без НДС") {
                        $('#indikator_otgruzki').show().addClass('alert-success').removeClass('alert-danger').text('Можно отгружать');
                        $('#btnSub, #btnSub1, #btnSub2').prop('disabled', false);
                    } else if (forma_oplata_company == "На карту" && ($summa*0.7/oplata_perevozchik) > 0.08) {
                        $('#indikator_otgruzki').show().addClass('alert-success').removeClass('alert-danger').text('Можно отгружать');
                        $('#btnSub, #btnSub1, #btnSub2').prop('disabled', false);
                    } else if (forma_oplata_company == "С НДС") {
                        $('#indikator_otgruzki').show().addClass('alert-success').removeClass('alert-danger').text('Можно отгружать');
                        $('#btnSub, #btnSub1, #btnSub2').prop('disabled', false);
                    } else {
                        $('#indikator_otgruzki').show().addClass('alert-danger').removeClass('alert-success').text('Отгружать нельзя');
                        $('#btnSub, #btnSub1, #btnSub2').prop('disabled', true);
                    }

                    if($('#min_rent').val() != '') {
                        if($('#min_rent').val() > (($summa*0.7/$('#oplata_perevozchik').val())*100)) {
                            $('#indikator_otgruzki').show().addClass('alert-danger').removeClass('alert-success').text('Нужно повысить рентабельность.');
                            $('#btnSub, #btnSub1, #btnSub2').prop('disabled', true);
                        }
                    }

                }
            });

            $(document).on('click', '.client_name', function(){
                if ($('#oplata_client').val() > 0 && $('#oplata_perevozchik').val() > 0) {
                    $result.val($summa.toFixed(2)+' ₽');
                    $rent.val((($summa*0.7/$('#oplata_perevozchik').val())*100).toFixed(2)+' %');
                    $logist_pribl.val(($summa/5).toFixed(2)+' ₽');
                    $prodaznik_pribl.val((($summa/5)/2).toFixed(2)+' ₽');

                    if($('#forma_oplata_company').val() == "Без НДС" && ($summa*0.7/$('#oplata_perevozchik').val()) > 0.08 && $('#oplata_perevozchik').val() > 19999) {
                        $('#indikator_otgruzki').show().addClass('alert-success').removeClass('alert-danger').text('Можно отгружать');
                        $('#btnSub, #btnSub1, #btnSub2').prop('disabled', false);
                    } else if ($('#forma_oplata_company').val() == "На карту" && ($summa*0.7/$('#oplata_perevozchik').val()) > 0.08) {
                        $('#indikator_otgruzki').show().addClass('alert-success').removeClass('alert-danger').text('Можно отгружать');
                        $('#btnSub, #btnSub1, #btnSub2').prop('disabled', false);
                    } else if ($('#forma_oplata_company').val() == "С НДС") {
                        $('#indikator_otgruzki').show().addClass('alert-success').removeClass('alert-danger').text('Можно отгружать');
                        $('#btnSub, #btnSub1, #btnSub2').prop('disabled', false);
                    } else {
                        $('#indikator_otgruzki').show().addClass('alert-danger').removeClass('alert-success').text('Отгружать нельзя');
                        $('#btnSub, #btnSub1, #btnSub2').prop('disabled', true);
                    }
                    if($('#min_rent').val() != '') {
                        if($('#min_rent').val() > (($summa*0.7/$('#oplata_perevozchik').val())*100)) {
                            $('#indikator_otgruzki').show().addClass('alert-danger').removeClass('alert-success').text('Нужно повысить рентабельность.');
                            $('#btnSub, #btnSub1, #btnSub2').prop('disabled', true);
                        }
                    }
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#deletePartner').bind('click', function(){
                $('#partner_name').val('Не выбрано');
                $("#partner_name option[value='Не выбрано']").attr("selected", "selected");
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#addPerevozchik').on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{ route('addPerevozchik') }}",
                    data: $(this).serialize(),
                    success: function(msg){
                        $('#indikator_tel').show().addClass('alert-success').removeClass('alert-warning').text('Данные отправлены на проверку');
                        setTimeout(function(){
                            $('#exampleModal').modal('hide');
                            $('#addPerevozchik').trigger('reset');
                        }, 2000);
                    }
                });
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
