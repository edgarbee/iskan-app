@extends('sb.layouts.app')
@section('title', 'Проверка перевозчиков')
@section('content')
    @push('styles')
    <style>
        body {
            background: rgb(248, 249, 250);
        }
        .shadow {
            background: #fff;
        }
        .alert {
            font-size: 12px; font-weight: 700;
            padding: 10px;
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
        }
    </style>
    @endpush
    @include("sb.includes.header")
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <div class="shadow rounded p-3 mt-4 mb-4">
                    <div class="row">
                        <div class="col-md-12" style="font-size: 12px;">
                            <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary mt-2 d-inline-block">Вернуться назад</a>
                        </div>
                    </div> 
            
                    <div class="row  mt-3">
                        <div class="col-md-4" style="font-size: 12px; font-weight: 700">
                            Номер
                        </div>
                        <div class="col-md-8" style="font-size: 12px; font-weight: 400">
                            {{ $perevozchiki->id }}
                        </div>
                    </div>  
            
                    <div class="row  mt-2">
                        <div class="col-md-4" style="font-size: 12px; font-weight: 700">
                        Код АТИ
                        </div>
                        <div class="col-md-8" style="font-size: 12px; font-weight: 400">
                            {{ $perevozchiki->code_ATI }}
                        </div>
                    </div>  
            
                    <div class="row  mt-2">
                        <div class="col-md-4" style="font-size: 12px; font-weight: 700">
                        ООО/ИП перевозчика
                        </div>
                        <div class="col-md-8" style="font-size: 12px; font-weight: 400">
                            {{ $perevozchiki->perevozchik_name }}
                        </div>
                    </div>  
                    <div class="row  mt-2">
                        <div class="col-md-4" style="font-size: 12px; font-weight: 700">
                        Телефон диспетчера
                        </div>
                        <div class="col-md-8" style="font-size: 12px; font-weight: 400">
                            {{ $perevozchiki->perevozchik_tel }}
                        </div>
                    </div>  
                    <div class="row  mt-2">
                        <div class="col-md-4" style="font-size: 12px; font-weight: 700">
                        Почта диспетчера
                        </div>
                        <div class="col-md-8" style="font-size: 12px; font-weight: 400">
                            {{ $perevozchiki->perevozchik_email }}
                        </div>
                    </div>  
                    <div class="row  mt-2">
                        <div class="col-md-4" style="font-size: 12px; font-weight: 700">
                        Тип транспорта
                        </div>
                        <div class="col-md-8" style="font-size: 12px; font-weight: 400">
                            {{ $perevozchiki->type_transport }}
                        </div>
                    </div>  
                    <div class="row  mt-2">
                        <div class="col-md-4" style="font-size: 12px; font-weight: 700">
                        Транспортное стредство
                        </div>
                        <div class="col-md-8" style="font-size: 12px; font-weight: 400">
                            {{ $perevozchiki->perevozchik_ts }}
                        </div>
                    </div>  
                    <div class="row  mt-2">
                        <div class="col-md-4" style="font-size: 12px; font-weight: 700">
                        Водитель
                        </div>
                        <div class="col-md-8" style="font-size: 12px; font-weight: 400">
                            {{ $perevozchiki->perevozchik_voditel }}
                        </div>
                    </div>  
                    <div class="row  mt-2">
                        <div class="col-md-4" style="font-size: 12px; font-weight: 700">
                        Паспорт водителя
                        </div>
                        <div class="col-md-8" style="font-size: 12px; font-weight: 400">
                            {{ $perevozchiki->pasport_voditel }}
                        </div>
                    </div>  
            
                    <div class="row  mt-2">
                        <div class="col-md-4" style="font-size: 12px; font-weight: 700">
                        Домашний регион
                        </div>
                        <div class="col-md-8" style="font-size: 12px; font-weight: 400">
                            {{ $perevozchiki->home_region }}
                        </div>
                    </div> 
            
                    <div class="row  mt-2">
                        <div class="col-md-4" style="font-size: 12px; font-weight: 700">
                        ФИО директора
                        </div>
                        <div class="col-md-8" style="font-size: 12px; font-weight: 400">
                            {{ $perevozchiki->name_director }}
                        </div>
                    </div> 
            
                    <div class="row  mt-2">
                        <div class="col-md-4" style="font-size: 12px; font-weight: 700">
                        Карта сбербанка
                        </div>
                        <div class="col-md-8" style="font-size: 12px; font-weight: 400">
                            {{ $perevozchiki->karta_sber }}
                        </div>
                    </div> 
            
                    <div class="row  mt-2">
                        <div class="col-md-4" style="font-size: 12px; font-weight: 700">
                        Реквизиты
                        </div>
                        <div class="col-md-8" style="font-size: 12px; font-weight: 400">
                            {!! str_replace(array("\n"), '<br>', $perevozchiki->contacts) !!}
                        </div>
                    </div> 

                    <div class="row  mt-2">
                        <div class="col-md-4" style="font-size: 12px; font-weight: 700">
                        Сцепка ФИО, телефона и паспорта водителя
                        </div>
                        <div class="col-md-8" style="font-size: 12px; font-weight: 400">
                            {{ $perevozchiki->vod_pas }}
                        </div>
                    </div>
                </div>            
            </div>
            @if(empty($perevozchiki->sb_blank))
            <div class="col-md-7">
                <form action="{{ route('generatePDFSB') }}" method="POST">
                @csrf
                <div class="shadow rounded p-3 mt-4 mb-4">
                    <div class="row">
                        <div class="col-md-12 mb-2" style="font-size: 12px; font-weight: 700">
                            <span style="color:#d0021b">*</span> Общая информация
                        </div>
                        <div class="col-md-4">
                            <div class="mb-1">
                                <input type="text" class="form-control form-control-sm" name="sb[nomer]" required placeholder="Номер проверки">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-1">
                                <input type="date" name="sb[date]"  class="form-control form-control-sm" required placeholder="Дата">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-1">
                                <select class="form-select form-select-sm" name="sb[company_name]" required placeholder="Наша компания">
                                    <option value="">Выберите нашу компанию</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->company_name }}">{{ $company->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-12 mb-2" style="font-size: 12px; font-weight: 700">
                            <span style="color:#d0021b">*</span> Клиент
                        </div>

                        <div class="col-md-8">
                            <div class="search_box">
                                <div class="mb-1">
                                    <input type="text" class="form-control form-control-sm" name="sb[client_name]" id="client_name" required placeholder="Клиент">
                                </div>
                                <div id="search_box-result-client"></div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-1">
                                <select class="form-select form-select-sm" name="sb[type_proverki]" required placeholder="Тип проверки" id="type">
                                    <option value="">Выберите тип проверки</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-12 mb-2" style="font-size: 12px; font-weight: 700">
                            <span style="color:#d0021b">*</span> Перевозчик
                        </div>

                        <div class="col-md-6">
                            <div class="search_box">
                                <div class="mb-1">
                                    <input type="text" class="form-control form-control-sm" name="sb[perevozchik_name]" id="perevozchik_name" required placeholder="Перевозчик" value="{{ $perevozchiki->perevozchik_name }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="search_box">
                                <div class="mb-1">
                                    <input type="text" class="form-control form-control-sm" name="sb[perevozchik_voditel]" id="perevozchik_voditel" required placeholder="Водитель" value="{{ $perevozchiki->perevozchik_voditel }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="search_box">
                                <div class="mb-1">
                                    <input type="text" class="form-control form-control-sm" name="sb[perevozchik_home]" id="perevozchik_home" required placeholder="Место рождения">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="search_box">
                                <div class="mb-1">
                                    <input type="text" class="form-control form-control-sm" name="sb[perevozchik_registr]" id="perevozchik_registr" required placeholder="Адрес регистрации">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="search_box">
                                <div class="mb-1">
                                    <input type="date" name="sb[perevozchik_date]"  class="form-control form-control-sm" required placeholder="Дата рождения">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="search_box">
                                <div class="mb-1">
                                    <input type="text" class="form-control form-control-sm tel" name="sb[perevozchik_voditel_tel]" id="perevozchik_voditel_tel" required placeholder="Телефон водителя">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="search_box">
                                <div class="mb-1">
                                    <input type="text" class="form-control form-control-sm" name="sb[perevozchik_ts]" id="perevozchik_ts" required placeholder="Госномер и модель автомобиля" value="{{ $perevozchiki->perevozchik_ts }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="search_box">
                                <div class="mb-1">
                                    <input type="text" class="form-control form-control-sm" name="sb[perevozchik_ts_color]" id="perevozchik_ts_color" required placeholder="Цвет кабины">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-md-12 mb-2" style="font-size: 12px; font-weight: 700">
                            <span style="color:#d0021b">*</span> Установление подлинности документов
                        </div>

                        <div class="col-md-4">
                            <div class="mb-1">
                                <select class="form-select form-select-sm" name="sb[passport]" id="passport" required placeholder="Паспорт">
                                    <option value="">Паспорт (выбрать из списка)</option>
                                    <option value="Подтвержден">Подтвержден</option>
                                    <option value="Не подтвержден">Не подтвержден</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-1">
                                <select class="form-select form-select-sm" name="sb[vy]" id="vy" required placeholder="ВУ">
                                    <option value="">ВУ (выбрать из списка)</option>
                                    <option value="Подтвержден">Подтвержден</option>
                                    <option value="Не подтвержден">Не подтвержден</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-1">
                                <select class="form-select form-select-sm" name="sb[sts]" id="sts" required placeholder="СТС">
                                    <option value="">СТС (выбрать из списка)</option>
                                    <option value="Подтвержден">Подтвержден</option>
                                    <option value="Не подтвержден">Не подтвержден</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-1">
                                <select class="form-select form-select-sm" name="sb[dost_company]" id="dost_company" required placeholder="Достоверность данных компании">
                                    <option value="">Достоверность данных компании (выбрать из списка)</option>
                                    <option value="Подтвержден">Подтвержден</option>
                                    <option value="Не подтвержден">Не подтвержден</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-1">
                                <input type="text" class="form-control form-control-sm" name="sb[srok_ts]" required placeholder="Срок владения ТС">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-1">
                                <input type="text" class="form-control form-control-sm" name="sb[srok_director]" required placeholder="Срок директора">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-12 mb-2" style="font-size: 12px; font-weight: 700">
                            <span style="color:#d0021b">*</span> Рейс
                        </div>

                        <div class="col-md-6">
                            <div class="mb-1">
                                <input type="text" class="form-control form-control-sm" name="sb[otkyda]" required placeholder="Откуда">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-1">
                                <input type="text" class="form-control form-control-sm" name="sb[kyda]" required placeholder="Куда">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-1">
                                <select class="form-select form-select-sm" name="sb[prinad_tel_voditel]" required placeholder="Принадлежность номера телефона водителя">
                                    <option value="">Принадлежность номера телефона водителя</option>
                                    <option value="Подтвержден">Подтвержден</option>
                                    <option value="Не подтвержден">Не подтвержден</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-1">
                                <select class="form-select form-select-sm" name="sb[social]" required placeholder="Определение страницы VK, OK" id="social">
                                    <option value="">Определение страницы VK, OK</option>
                                    <option value="Подтвержден">Подтвержден</option>
                                    <option value="Не подтвержден">Не подтвержден</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-1">
                                <textarea  class="form-control form-control-sm" name="sb[social_dop]" placeholder="Дополнительная информация из VK"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-12 mb-2" style="font-size: 12px; font-weight: 700">
                            <span style="color:#d0021b">*</span> Данные из ATI
                        </div>

                        <div class="col-md-6">
                            <div class="mb-1">
                                <select class="form-select form-select-sm" name="sb[ati_email]" required placeholder="Сверка почты ATI (выбрать из списка)">
                                    <option value="">Сверка почты ATI (выбрать из списка)</option>
                                    <option value="Подтвержден">Подтвержден</option>
                                    <option value="Не подтвержден">Не подтвержден</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-1">
                                <select class="form-select form-select-sm" name="sb[ati_tel]" required placeholder="Сверка номера телефона ATI (выбрать из списка)">
                                    <option value="">Сверка номера телефона ATI (выбрать из списка)</option>
                                    <option value="Подтвержден">Подтвержден</option>
                                    <option value="Не подтвержден">Не подтвержден</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-1">
                                <input type="text" class="form-control form-control-sm" name="sb[ati_aktivnost]" required placeholder="Активность (указать сколько дней)">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-1">
                                <input type="text" class="form-control form-control-sm" name="sb[ati_srok_raboty]" required placeholder="Срок работы (указать сколько дней)">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-1">
                                <select class="form-select form-select-sm" name="sb[ati_tel_menilsy]" required placeholder="За последние 3 месяца Номер телефона не менялся (выбрать из списка)">
                                    <option value="">За последние 3 месяца Номер телефона не менялся (выбрать из списка)</option>
                                    <option value="Подтвержден">Подтвержден</option>
                                    <option value="Не подтвержден">Не подтвержден</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-1">
                                <select class="form-select form-select-sm" name="sb[ati_email_menilsy]" required placeholder="За последние 3 месяца Почта не менялась (выбрать из списка)">
                                    <option value="">За последние 3 месяца Почта не менялась (выбрать из списка)</option>
                                    <option value="Подтвержден">Подтвержден</option>
                                    <option value="Не подтвержден">Не подтвержден</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-12 mb-2" style="font-size: 12px; font-weight: 700">
                            <span style="color:#d0021b">*</span> Опрос водителя
                        </div>

                        <div class="col-md-12">
                            <div class="row opros">
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <input type="text" class="form-control form-control-sm" name="sb[opros_address]" placeholder="Адреса проживания">
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="mb-1">
                                        <select class="form-select form-select-sm select-opros" name="sb[opros_address_status]"  placeholder="Выберите статус">
                                            <option value="">Выберите статус</option>
                                            <option value="Утвердительно">Утвердительно</option>
                                            <option value="Отрицательно">Отрицательно</option>
                                            <option value="Нет информации">Нет информации</option>
                                        </select>
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="mb-1">
                                        <input type="number" class="form-control form-control-sm balls" name="sb[opros_address_ball]" placeholder="Балл" min="0" step="1" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="row opros">
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <input type="text" class="form-control form-control-sm" name="sb[opros_tel]" placeholder="Номера телефонов">
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="mb-1">
                                        <select class="form-select form-select-sm select-opros" name="sb[opros_tel_status]"  placeholder="Выберите статус">
                                            <option value="">Выберите статус</option>
                                            <option value="Утвердительно">Утвердительно</option>
                                            <option value="Отрицательно">Отрицательно</option>
                                            <option value="Нет информации">Нет информации</option>
                                        </select>
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="mb-1">
                                        <input type="number" class="form-control form-control-sm balls" name="sb[opros_tel_ball]" placeholder="Балл" min="0" step="1" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="row opros">
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <input type="text" class="form-control form-control-sm" name="sb[opros_auto]" placeholder="Модель автомобилей, госномер, цвет">
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="mb-1">
                                        <select class="form-select form-select-sm select-opros" name="sb[opros_auto_status]"  placeholder="Выберите статус">
                                            <option value="">Выберите статус</option>
                                            <option value="Утвердительно">Утвердительно</option>
                                            <option value="Отрицательно">Отрицательно</option>
                                            <option value="Нет информации">Нет информации</option>
                                        </select>
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="mb-1">
                                        <input type="number" class="form-control form-control-sm balls" name="sb[opros_auto_ball]" placeholder="Балл" min="0" step="1" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="row opros">
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <input type="text" class="form-control form-control-sm" name="sb[opros_ip_ooo]" placeholder="Существование юридического лица (ООО, ИП)">
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="mb-1">
                                        <select class="form-select form-select-sm select-opros" name="sb[opros_ip_ooo_status]"  placeholder="Выберите статус">
                                            <option value="">Выберите статус</option>
                                            <option value="Утвердительно">Утвердительно</option>
                                            <option value="Отрицательно">Отрицательно</option>
                                            <option value="Нет информации">Нет информации</option>
                                        </select>
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="mb-1">
                                        <input type="number" class="form-control form-control-sm balls" name="sb[opros_ip_ooo_ball]" placeholder="Балл" min="0" step="1" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="row opros">
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <input type="text" class="form-control form-control-sm" name="sb[opros_work]" placeholder="Прошлые места работы (Название, должность, год)">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-1">
                                        <select class="form-select form-select-sm select-opros" name="sb[opros_work_status]"  placeholder="Выберите статус">
                                            <option value="">Выберите статус</option>
                                            <option value="Утвердительно">Утвердительно</option>
                                            <option value="Отрицательно">Отрицательно</option>
                                            <option value="Нет информации">Нет информации</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-1">
                                        <input type="number" class="form-control form-control-sm balls" name="sb[opros_work_ball]" placeholder="Балл" min="0" step="1" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="row opros">
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <input type="text" class="form-control form-control-sm" name="sb[opros_syd]" placeholder="Судимости">
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="mb-1">
                                        <select class="form-select form-select-sm select-opros" name="sb[opros_syd_status]"  placeholder="Выберите статус">
                                            <option value="">Выберите статус</option>
                                            <option value="Утвердительно">Утвердительно</option>
                                            <option value="Отрицательно">Отрицательно</option>
                                            <option value="Нет информации">Нет информации</option>
                                        </select>
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="mb-1">
                                        <input type="number" class="form-control form-control-sm balls" name="sb[opros_syd_ball]" placeholder="Балл" min="0" step="1" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="row opros">
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <input type="text" class="form-control form-control-sm" name="sb[opros_perelet]" placeholder="Перелёты">
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="mb-1">
                                        <select class="form-select form-select-sm select-opros" name="sb[opros_perelet_status]"  placeholder="Выберите статус">
                                            <option value="">Выберите статус</option>
                                            <option value="Утвердительно">Утвердительно</option>
                                            <option value="Отрицательно">Отрицательно</option>
                                            <option value="Нет информации">Нет информации</option>
                                        </select>
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="mb-1">
                                        <input type="number" class="form-control form-control-sm balls" name="sb[opros_perelet_ball]" placeholder="Балл" min="0" step="1" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="row opros">
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <input type="text" class="form-control form-control-sm" name="sb[opros_rod]" placeholder="Близкие родственники">
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="mb-1">
                                        <select class="form-select form-select-sm select-opros" name="sb[opros_rod_status]"  placeholder="Выберите статус">
                                            <option value="">Выберите статус</option>
                                            <option value="Утвердительно">Утвердительно</option>
                                            <option value="Отрицательно">Отрицательно</option>
                                            <option value="Нет информации">Нет информации</option>
                                        </select>
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="mb-1">
                                        <input type="number" class="form-control form-control-sm balls" name="sb[opros_rod_ball]" placeholder="Балл" min="0" step="1" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="row opros">
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <input type="text" class="form-control form-control-sm" name="sb[opros_fio_mother]" placeholder="ФИО матери">
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="mb-1">
                                        <select class="form-select form-select-sm select-opros" name="sb[opros_fio_mother_status]"  placeholder="Выберите статус">
                                            <option value="">Выберите статус</option>
                                            <option value="Утвердительно">Утвердительно</option>
                                            <option value="Отрицательно">Отрицательно</option>
                                            <option value="Нет информации">Нет информации</option>
                                        </select>
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="mb-1">
                                        <input type="number" class="form-control form-control-sm balls" name="sb[opros_fio_mother_ball]" placeholder="Балл" min="0" step="1" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="row opros">
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <input type="text" class="form-control form-control-sm" name="sb[opros_other_vk]" placeholder="Прочая информация + VK">
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="mb-1">
                                        <select class="form-select form-select-sm select-opros" name="sb[opros_other_vk_status]"  placeholder="Выберите статус">
                                            <option value="">Выберите статус</option>
                                            <option value="Утвердительно">Утвердительно</option>
                                            <option value="Отрицательно">Отрицательно</option>
                                            <option value="Нет информации">Нет информации</option>
                                        </select>
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="mb-1">
                                        <input type="number" class="form-control form-control-sm balls" name="sb[opros_other_vk_ball]" placeholder="Балл" min="0" step="1" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="row opros">
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <input type="text" class="form-control form-control-sm" name="sb[opros_reis]" placeholder="Количество рейсов за последний месяц, более 5">
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="mb-1">
                                        <select class="form-select form-select-sm select-opros" name="sb[opros_reis_status]"  placeholder="Выберите статус">
                                            <option value="">Выберите статус</option>
                                            <option value="Утвердительно">Утвердительно</option>
                                            <option value="Отрицательно">Отрицательно</option>
                                            <option value="Нет информации">Нет информации</option>
                                        </select>
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="mb-1">
                                        <input type="number" class="form-control form-control-sm dop_balls" name="sb[opros_reis_ball]" placeholder="Балл" min="0" step="1" value="0" max="1">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="row opros">
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <input type="text" class="form-control form-control-sm" name="sb[opros_smena]" placeholder="Смены руководства не происходило">
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="mb-1">
                                        <select class="form-select form-select-sm select-opros" name="sb[opros_smena_status]"  placeholder="Выберите статус">
                                            <option value="">Выберите статус</option>
                                            <option value="Утвердительно">Утвердительно</option>
                                            <option value="Отрицательно">Отрицательно</option>
                                            <option value="Нет информации">Нет информации</option>
                                        </select>
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="mb-1">
                                        <input type="number" class="form-control form-control-sm dop_balls" name="sb[opros_smena_ball]" placeholder="Балл" min="0" step="1" value="0" max="1">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="row opros">
                                <div class="col-md-6">
                                    <div class="mb-1">
                                        <input type="text" class="form-control form-control-sm" name="sb[opros_dir]" placeholder="Опрос директора. Не менялся">
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="mb-1">
                                        <select class="form-select form-select-sm select-opros" name="sb[opros_dir_status]"  placeholder="Выберите статус">
                                            <option value="">Выберите статус</option>
                                            <option value="Утвердительно">Утвердительно</option>
                                            <option value="Отрицательно">Отрицательно</option>
                                            <option value="Нет информации">Нет информации</option>
                                        </select>
                                    </div>
                                </div>
        
                                <div class="col-md-3">
                                    <div class="mb-1">
                                        <input type="number" class="form-control form-control-sm dop_balls" name="sb[opros_dir_ball]" placeholder="Балл" min="0" step="1" value="0" max="1">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-1">
                                <textarea  class="form-control form-control-sm" name="sb[opros_dopinfo]" placeholder="Дополнительная информация по водителю"></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="alert mb-0" role="alert" id="indikator_opros" style="display: none;"></div>
                        </div>

                        <input type="hidden" name="sb_status" id="sb_status" value="0">
                        <input type="hidden" name="id" value="{{ $perevozchiki->id }}">

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success w-100 mt-2" id="btnSuccess" disabled><b>Проверку прошел</b></button>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-danger w-100 mt-2" id="btnCancel" disabled><b>Проверку не прошел</b></button>
                                </div>
                            </div> 
                        </div>

                    </div>
                </div>
                </form>
            </div>
            @else
            <div class="col-md-7">
                <div class="shadow rounded p-3 mt-4 mb-4">
                    @php $sb = json_decode($perevozchiki->sb_blank, true) @endphp
                    <table class="table" border="0" style="border: none;">
                        <tr>
                            <td style="width: 60%; padding-top:0; padding-bottom: 0; padding-left:0; border: none; vertical-align: middle">
                                <p style="font-weight: bold; font-size: 11px; text-align: left">Проверка №{{ $sb["nomer"] }} от {{ \Carbon\Carbon::parse($sb["date"])->format('d.m.Y')}}<br> на возможный факт мошенничества и благонадёжность водителя</p>
                            </td>
                            <td style=" width: 10%; padding-top:0; padding-bottom: 0; border: none;"></td>
                            <td style=" width: 30%; padding-top:0; padding-bottom: 0; border: none; vertical-align: middle">
                                <p style="font-size: 11px; text-align: left">Заказчик: {{ $sb["client_name"] }}<br> Инспектор: {{ \Auth::user()->name }}</p>
                            </td>
                        </tr>
                    </table> 

                    <p style="font-weight: bold; font-size: 11px; text-align: center">Условия проверки.</p>
                
                    <table class="table table-bordered">
                        <tr>
                            <td style="font-size: 11px; width: 100%;text-align:center;padding-top:0; padding-bottom: 0" colspan="2">1. Исходные данные водителя</td>
                        </tr>
                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">1.1. Организация перевозчика</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["perevozchik_name"] }}</td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">1.2. ФИО Водителя</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["perevozchik_voditel"] }}</td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">1.3. Место рождения</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["perevozchik_home"] }}</td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">1.4. Адрес регистрации</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["perevozchik_registr"] }}</td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">1.5. Дата Рождения</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">{{ \Carbon\Carbon::parse($sb["perevozchik_date"])->format('d.m.Y') }}</td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">1.6. Номер телефона</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["perevozchik_voditel_tel"] }}</td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">1.6. Рейс</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["otkyda"] }} - {{ $sb["kyda"] }}</td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 100%;text-align:center;padding-top:0; padding-bottom: 0" colspan="2">2. Установление подлинности документов</td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">2.1. Паспорт</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["passport"] }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">2.2. ВУ</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["vy"] }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">2.3. СТС</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["sts"] }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">2.4. Достоверность компании</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["dost_company"] }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">2.5. Достоверность фото в паспорте</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["social"] }}</td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 100%;text-align:center;padding-top:0; padding-bottom: 0" colspan="2">3. Раскрытие и пресечение возможности использования<br> мошенниками чужих данных с целью представления себя другим лицом</td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">3.1. Сверка почты контакта ATI</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["ati_email"] }}</td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">3.2. Сверка номера телефона контакта ATI</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["ati_tel"] }}</td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">3.3. Принадлежность номера телефона водителю</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["prinad_tel_voditel"] }}</td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">3.4. Адреса проживания</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">
                                @if(!empty($sb["opros_address"]))
                                    {{ $sb["opros_address"] }}
                                @else
                                {{ $sb["opros_address_status"] }}
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">3.5. Номера телефонов</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">
                                @if(!empty($sb["opros_tel"]))
                                    {{ $sb["opros_tel"] }}
                                @else
                                {{ $sb["opros_tel_status"] }}
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">3.6. Модель автомобилей, цвета, госномера</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">
                                @if(!empty($sb["opros_auto"]))
                                    {{ $sb["opros_auto"] }}
                                @else
                                {{ $sb["opros_auto_status"] }}
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">3.7. Существование юридического лица (ИП, ООО)</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">
                                @if(!empty($sb["opros_ip_ooo"]))
                                    {{ $sb["opros_ip_ooo"] }}
                                @else
                                {{ $sb["opros_ip_ooo_status"] }}
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">3.8. Судимости</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">
                                @if(!empty($sb["opros_syd"]))
                                    {{ $sb["opros_syd"] }}
                                @else
                                {{ $sb["opros_syd_status"] }}
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">3.9. Перелёты</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">
                                @if(!empty($sb["opros_perelet"]))
                                    {{ $sb["opros_perelet"] }}
                                @else
                                {{ $sb["opros_perelet_status"] }}
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">3.10. Близкие родственники</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">
                                @if(!empty($sb["opros_rod"]))
                                    {{ $sb["opros_rod"] }}
                                @else
                                {{ $sb["opros_rod_status"] }}
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">3.11. ФИО Матери</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">
                                @if(!empty($sb["opros_fio_mother"]))
                                    {{ $sb["opros_fio_mother"] }}
                                @else
                                {{ $sb["opros_fio_mother_status"] }}
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">3.12. Прочая информация + VK</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">
                                @if(!empty($sb["opros_other_vk"]))
                                    {{ $sb["opros_other_vk"] }}
                                @else
                                {{ $sb["opros_other_vk_status"] }}
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 100%;text-align:center;padding-top:0; padding-bottom: 0" colspan="2">4. Раскрытие и пресечение возможности покупки и использования<br> мошенниками компании с транспортом, логистами и водителями</td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">4.1. Срок владения организацией транспортным средством</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["srok_ts"] }}</td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">4.2. Срок службы директра организации</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["srok_director"] }}</td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">4.3. Изменение почты контакта ATI за последние 3 месяца</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["ati_email_menilsy"] }}</td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">4.4. Изменение номера телефона контакта ATI</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["ati_tel_menilsy"] }}</td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">4.5. Активность профиля ATI</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["ati_aktivnost"] }}</td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">4.6. Срок работы профиля ATI</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["ati_srok_raboty"] }}</td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">4.7. Количество рейсов за последний месяц, более 5</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["opros_reis_status"] }}</td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">4.8. Смены руководства не происходило</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["opros_smena_status"] }}</td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">4.9. Опрос директора. Не менялся</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["opros_dir_status"] }}</td>
                        </tr>

                        <tr>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">4.10. Дополнительная информация</td>
                            <td style="font-size: 11px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["opros_dopinfo"] }}</td>
                        </tr>


                    </table>

                    <table class="table mb-0" style="border: none" border="0">
                        @if($sb["type_proverki"] == 1 && $perevozchiki->sb_status == 1)
                        <tr>
                            <td style="font-size: 11px; text-align:center;padding-top:0; padding-bottom: 0; border: none">
                                <div class="alert alert-success" style="padding: 5px 0; font-weight: bold">
                                    Подлинность документов установлена.
                                </div>
                            </td>
                        </tr>
                        @elseif($sb["type_proverki"] == 1 && $perevozchiki->sb_status == 2)
                        <tr>
                            <td style="font-size: 11px; text-align:center;padding-top:0; padding-bottom: 0; border: none">
                                <div class="alert alert-danger" style="padding: 5px 0; font-weight: bold">
                                    Подлинность документов не установлена.
                                </div>
                            </td>
                        </tr>
                        @elseif($sb["type_proverki"] == 2 && $perevozchiki->sb_status == 1)
                            @if($sb["passport"] == 'Подтвержден' && $sb["vy"] == 'Подтвержден' && $sb["sts"] == 'Подтвержден' && $sb["dost_company"] == 'Подтвержден')
                                <tr>
                                    <td style="font-size: 11px; text-align:center;padding-top:0; padding-bottom: 0; border: none">
                                        <div class="alert alert-success" style="padding: 5px 0; font-weight: bold">
                                            Подлинность документов установлена.
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td style="font-size: 11px; text-align:center;padding-top:0; padding-bottom: 0; border: none">
                                    <div class="alert alert-success" style="padding: 5px 0; font-weight: bold">
                                        Водитель ответил на вопросы.
                                    </div>
                                </td>
                            </tr>
                        @elseif($sb["type_proverki"] == 2 && $perevozchiki->sb_status == 2)
                            @if($sb["passport"] != 'Подтвержден' && $sb["vy"] != 'Подтвержден' && $sb["sts"] != 'Подтвержден' && $sb["dost_company"] != 'Подтвержден')
                                    <tr>
                                        <td style="font-size: 11px; text-align:center;padding-top:0; padding-bottom: 0; border: none">
                                            <div class="alert alert-danger" style="padding: 5px 0; font-weight: bold">
                                                Подлинность документов не установлена.
                                            </div>
                                        </td>
                                    </tr>
                            @endif
                            <tr>
                                <td style="font-size: 11px; text-align:center;padding-top:0; padding-bottom: 0; border: none">
                                    <div class="alert alert-danger" style="padding: 5px 0; font-weight: bold">
                                        Водитель не ответил на вопросы.
                                    </div>
                                </td>
                            </tr>
                        @elseif($sb["type_proverki"] == 3 && $perevozchiki->sb_status == 1)
                            @if($sb["passport"] == 'Подтвержден' && $sb["vy"] == 'Подтвержден' && $sb["sts"] == 'Подтвержден' && $sb["dost_company"] == 'Подтвержден')
                                <tr>
                                    <td style="font-size: 11px; text-align:center;padding-top:0; padding-bottom: 0; border: none">
                                        <div class="alert alert-success" style="padding: 5px 0; font-weight: bold">
                                            Подлинность документов установлена.
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td style="font-size: 11px; text-align:center;padding-top:0; padding-bottom: 0; border: none">
                                    <div class="alert alert-success" style="padding: 5px 0; font-weight: bold">
                                        Водитель ответил на вопросы.
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 11px; text-align:center;padding-top:0; padding-bottom: 0; border: none">
                                    <div class="alert alert-success" style="padding: 5px 0; font-weight: bold">
                                        Директор ответил на вопросы.
                                    </div>
                                </td>
                            </tr>
                        @elseif($sb["type_proverki"] == 3 && $perevozchiki->sb_status == 2) 
                            @if($sb["passport"] != 'Подтвержден' && $sb["vy"] != 'Подтвержден' && $sb["sts"] != 'Подтвержден' && $sb["dost_company"] != 'Подтвержден')
                                    <tr>
                                        <td style="font-size: 11px; text-align:center;padding-top:0; padding-bottom: 0; border: none">
                                            <div class="alert alert-danger" style="padding: 5px 0; font-weight: bold">
                                                Подлинность документов не установлена.
                                            </div>
                                        </td>
                                    </tr>
                            @endif
                            <tr>
                                <td style="font-size: 11px; text-align:center;padding-top:0; padding-bottom: 0; border: none">
                                    <div class="alert alert-danger" style="padding: 5px 0; font-weight: bold">
                                        Водитель не ответил на вопросы.
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 11px; text-align:center;padding-top:0; padding-bottom: 0; border: none">
                                    <div class="alert alert-danger" style="padding: 5px 0; font-weight: bold">
                                        Директор не ответил на вопросы.
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>


    @include("sb.includes.footer")

    @push('scripts')
    
    <script>

        var $sum = 0;
        var $sum_dop = 0;

        function operation() {
            var arr = $(".balls").map( (i,el) => $(el).val() ).get();

            $sum = 0;
            for (var i = 0; i < Array.from(arr).length; i++) {
                $sum += Number(arr[i]);
            }

            var arr_dop = $(".dop_balls").map( (i,el) => $(el).val() ).get();

            $sum_dop = 0;
            for (var i = 0; i < Array.from(arr_dop).length; i++) {
                $sum_dop += Number(arr_dop[i]);
            }

            if(($('#type').val() == 1 && $('#passport').val() == 'Подтвержден' && $('#vy').val() == 'Подтвержден' && $('#sts').val() == 'Подтвержден' && $('#dost_company').val() == 'Подтвержден') || ($('#type').val() == 2 && $sum >= 6) || ($('#type').val() == 3 && $sum >= 6 && $sum_dop == 3)) {
                $('#indikator_opros').show().addClass('alert-success').removeClass('alert-danger').text('Водитель допущен');
                $('#btnSuccess').prop('disabled', false);
                $('#btnCancel').prop('disabled', true);
                $('#sb_status').val(1);
            }else{
                $('#indikator_opros').show().addClass('alert-danger').removeClass('alert-success').text('Водитель не допущен');
                $('#btnSuccess').prop('disabled', true);
                $('#btnCancel').prop('disabled', false);
                $('#sb_status').val(0);
            }
        }

        $(".balls, .dop_balls, #type, #passport, #vy, #sts, #dost_company").click(function(){
            operation();
        });

        $('.select-opros').change(function(){
            var val = $(this).val();
            var ball = $(this).parent().parent().parent().find('.balls, .dop_balls');
            if(val == 'Отрицательно' || val == 'Нет информации') {
                ball.val(0).prop('disabled', true);
                operation();
            } else {
                ball.val(1).prop('disabled', false);
                operation();
            }

            console.log(val);
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
                        url: "{{ route('searchClientSB') }}",
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
                $result.fadeOut(100);
                return false;
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