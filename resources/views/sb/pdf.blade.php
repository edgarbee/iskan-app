<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Документ</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body, p { font-family: DejaVu Sans, sans-serif; }
        td {
            padding-bottom: 0;
            padding-top: 0;
            border-color: #000 !important;
        }

        p {
            margin-bottom: 5px;
            line-height: 1.2
        }
    </style>
</head>

<body>
    
    <table class="table" border="0" style="border: none;">
        <tr>
            <td style="width: 60%; padding-top:0; padding-bottom: 0; padding-left:0; border: none; vertical-align: middle">
                <p style="font-weight: bold; font-size: 10px; text-align: left">Проверка №{{ $sb["nomer"] }} от {{ \Carbon\Carbon::parse($sb["date"])->format('d.m.Y')}}<br> на возможный факт мошенничества и благонадёжность водителя</p>
            </td>
            <td style=" width: 10%; padding-top:0; padding-bottom: 0; border: none;"></td>
            <td style=" width: 30%; padding-top:0; padding-bottom: 0; border: none; vertical-align: middle">
                <p style="font-size: 9px; text-align: left">Заказчик: {{ $sb["client_name"] }}<br> Инспектор: {{ \Auth::user()->name }}</p>
            </td>
        </tr>
    </table> 

    <p style="font-weight: bold; font-size: 11px; text-align: center">Условия проверки.</p>
  
    <table class="table table-bordered">
        <tr>
            <td style="font-size: 9px; width: 100%;text-align:center;padding-top:0; padding-bottom: 0" colspan="2">1. Исходные данные водителя</td>
        </tr>
        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">1.1. Организация перевозчика</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["perevozchik_name"] }}</td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">1.2. ФИО Водителя</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["perevozchik_voditel"] }}</td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">1.3. Место рождения</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["perevozchik_home"] }}</td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">1.4. Адрес регистрации</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["perevozchik_registr"] }}</td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">1.5. Дата Рождения</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">{{ \Carbon\Carbon::parse($sb["perevozchik_date"])->format('d.m.Y') }}</td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">1.6. Номер телефона</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["perevozchik_voditel_tel"] }}</td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">1.6. Рейс</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["otkyda"] }} - {{ $sb["kyda"] }}</td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 100%;text-align:center;padding-top:0; padding-bottom: 0" colspan="2">2. Установление подлинности документов</td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">2.1. Паспорт</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["passport"] }}</td>
        </tr>
        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">2.2. ВУ</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["vy"] }}</td>
        </tr>
        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">2.3. СТС</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["sts"] }}</td>
        </tr>
        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">2.4. Достоверность компании</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["dost_company"] }}</td>
        </tr>
        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">2.5. Достоверность фото в паспорте</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["social"] }}</td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 100%;text-align:center;padding-top:0; padding-bottom: 0" colspan="2">3. Раскрытие и пресечение возможности использования<br> мошенниками чужих данных с целью представления себя другим лицом</td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">3.1. Сверка почты контакта ATI</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["ati_email"] }}</td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">3.2. Сверка номера телефона контакта ATI</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["ati_tel"] }}</td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">3.3. Принадлежность номера телефона водителю</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["prinad_tel_voditel"] }}</td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">3.4. Адреса проживания</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">
                @if(!empty($sb["opros_address"]))
                    {{ $sb["opros_address"] }}
                @else
                {{ $sb["opros_address_status"] }}
                @endif
            </td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">3.5. Номера телефонов</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">
                @if(!empty($sb["opros_tel"]))
                    {{ $sb["opros_tel"] }}
                @else
                {{ $sb["opros_tel_status"] }}
                @endif
            </td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">3.6. Модель автомобилей, цвета, госномера</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">
                @if(!empty($sb["opros_auto"]))
                    {{ $sb["opros_auto"] }}
                @else
                {{ $sb["opros_auto_status"] }}
                @endif
            </td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">3.7. Существование юридического лица (ИП, ООО)</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">
                @if(!empty($sb["opros_ip_ooo"]))
                    {{ $sb["opros_ip_ooo"] }}
                @else
                {{ $sb["opros_ip_ooo_status"] }}
                @endif
            </td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">3.8. Судимости</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">
                @if(!empty($sb["opros_syd"]))
                    {{ $sb["opros_syd"] }}
                @else
                {{ $sb["opros_syd_status"] }}
                @endif
            </td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">3.9. Перелёты</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">
                @if(!empty($sb["opros_perelet"]))
                    {{ $sb["opros_perelet"] }}
                @else
                {{ $sb["opros_perelet_status"] }}
                @endif
            </td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">3.10. Близкие родственники</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">
                @if(!empty($sb["opros_rod"]))
                    {{ $sb["opros_rod"] }}
                @else
                {{ $sb["opros_rod_status"] }}
                @endif
            </td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">3.11. ФИО Матери</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">
                @if(!empty($sb["opros_fio_mother"]))
                    {{ $sb["opros_fio_mother"] }}
                @else
                {{ $sb["opros_fio_mother_status"] }}
                @endif
            </td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">3.12. Прочая информация + VK</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">
                @if(!empty($sb["opros_other_vk"]))
                    {{ $sb["opros_other_vk"] }}
                @else
                {{ $sb["opros_other_vk_status"] }}
                @endif
            </td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 100%;text-align:center;padding-top:0; padding-bottom: 0" colspan="2">4. Раскрытие и пресечение возможности покупки и использования<br> мошенниками компании с транспортом, логистами и водителями</td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">4.1. Срок владения организацией транспортным средством</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["srok_ts"] }}</td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">4.2. Срок службы директра организации</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["srok_director"] }}</td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">4.3. Изменение почты контакта ATI за последние 3 месяца</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["ati_email_menilsy"] }}</td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">4.4. Изменение номера телефона контакта ATI</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["ati_tel_menilsy"] }}</td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">4.5. Активность профиля ATI</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["ati_aktivnost"] }}</td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">4.6. Срок работы профиля ATI</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["ati_srok_raboty"] }}</td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">4.7. Количество рейсов за последний месяц, более 5</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["opros_reis_status"] }}</td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">4.8. Смены руководства не происходило</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["opros_smena_status"] }}</td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">4.9. Опрос директора. Не менялся</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["opros_dir_status"] }}</td>
        </tr>

        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">4.10. Дополнительная информация</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">{{ $sb["opros_dopinfo"] }}</td>
        </tr>


    </table>

    <table class="table mb-0" style="border: none" border="0">
        @if($sb["type_proverki"] == 1 && $sb_status == 1)
        <tr>
            <td style="font-size: 11px; text-align:center;padding-top:0; padding-bottom: 0; border: none">
                <div class="alert alert-success" style="padding: 5px 0; font-weight: bold">
                    Подлинность документов установлена.
                </div>
            </td>
        </tr>
        @elseif($sb["type_proverki"] == 1 && $sb_status == 2)
        <tr>
            <td style="font-size: 11px; text-align:center;padding-top:0; padding-bottom: 0; border: none">
                <div class="alert alert-danger" style="padding: 5px 0; font-weight: bold">
                    Подлинность документов не установлена.
                </div>
            </td>
        </tr>
        @elseif($sb["type_proverki"] == 2 && $sb_status == 1)
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
        @elseif($sb["type_proverki"] == 2 && $sb_status == 2)
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
        @elseif($sb["type_proverki"] == 3 && $sb_status == 1)
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
        @elseif($sb["type_proverki"] == 3 && $sb_status == 2) 
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

</body>

</html>