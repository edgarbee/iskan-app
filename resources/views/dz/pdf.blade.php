<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Документ</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    @if ($partner == 0 && $type_doc == "СОЗДАТЬ ДЗ ПЕРЕВОЗЧИК")
    <style>
        @page { margin:0px; }
        body {
            background: url("{{ asset('public/img/bg.png')}}");
            background-size: 100% auto;
            background-repeat: no-repeat;
            padding: 30px 30px 30px 80px;
            margin: 0
        }
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
    @elseif($partner == 0 && $type_doc == "СОЗДАТЬ ДЗ КЛИЕНТ")
    <style>
        @page { margin:0px; }
        body {
            background: url("{{ asset('public/img/bg-g.png')}}");
            background-size: 100% auto;
            background-repeat: no-repeat;
            padding: 30px 30px 30px 80px;
            margin: 0
        }
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
    @elseif($type_doc == "СОЗДАТЬ ДОВЕРЕННОСТЬ")
    <style>
        @page { margin-top:30px; margin-bottom:30px; }
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
    @else
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
    @endif
</head>
@if($type_doc == "СОЗДАТЬ ДЗ ПЕРЕВОЗЧИК")
<body>

    @if ($partner == 0)
    <table class="table" border="0" style="border: none;">
        <tr>
            <td style="width: 50%; padding-top:0; padding-bottom: 0; padding-left:0; border: none; vertical-align: middle">
                <p style="font-weight: bold; font-size: 10px; text-align: left">Договор-заявка №{{ $dz["nomer"] }} от {{ \Carbon\Carbon::parse($dz["date"])->format('d.m.Y')}} <br> на перевозку и транспортно-экспедиционное обслуживание грузов по территории РФ</p>
            </td>
            <td style=" width: 10%; padding-top:0; padding-bottom: 0; border: none;"></td>
            <td style=" width: 30%; padding-top:0; padding-bottom: 0; border: none; vertical-align: middle">
                <p style="font-size: 9px; text-align: left">Логист {{ \Auth::user()->name }}<br> тел.: {{ \Auth::user()->tel }}<br>Почта: {{ \Auth::user()->email }}</p>
            </td>
            <td style=" width: 10%; padding-top:0; padding-bottom: 0; border: none; vertical-align: middle">
                <div style="margin-bottom: 10px; text-align:right">
                    <img src="{{ asset('public/img/logo.png')}}" style="width: 60px">
                </div>
            </td>
        </tr>
    </table>
    @else
    <p style="font-weight: bold; font-size: 10px; text-align: center">Договор-заявка от {{ \Carbon\Carbon::parse($dz["date"])->format('d.m.Y')}} <br> на перевозку и транспортно-экспедиционное обслуживание грузов по территории РФ</p>
    @endif
    <p style="font-size: 9px; text-align: justify">{{ $companies->company_name }}, именуемое в дальнейшем Заказчик, в лице директора {{ $companies->name_director_1 }}, действующего на основании
    Устава с одной стороны и {{ $dz["perevozchik_name"] }} в лице руководителя {{ $carrier_company->name_director }}, именуемое в дальнейшем
    «Исполнитель», действующего на основании Устава/свидетельства, с другой стороны, совместно именуемые «Стороны» а по отдельности
    «Сторона», заключили настоящий Договор о нижеследующем:
    </p>

    <p style="font-weight: bold; font-size: 11px; text-align: center">1. Предмет договора</p>

    <p style="font-size: 9px; text-align: justify">1. Исполнитель обязуется в порядке и на условиях настоящего Договора осуществить в интересах Заказчика либо третьих лиц по поручению
    Заказчика транспортные услуги по доставке грузов с обязанностями экспедитора, а Заказчик обязуется оплатить выполненные услуги на условиях
    настоящего Договора.
    </p>

    <p style="font-size: 9px; text-align: justify">1.2. При оказании услуг по настоящему Договору Стороны руководствуются ФЗ № 259-ФЗ «Устав автомобильного транспорта и городского
    наземного электрического транспорта» ФЗ № 87-ФЗ «О транспортно-экспедиционной деятельности» № 87-ФЗ, действующими или установленными
    правилами погрузки/выгрузки на территории загружаемого или выгружаемого груза, Гражданским кодексом РФ и нормативными актами РФ.
    </p>

    <p style="font-weight: bold; font-size: 11px; text-align: center">2. Условия перевозки.</p>

    <table class="table table-bordered">
        <tr>
            <td style="font-size: 9px; width: 40%; padding-top:0; padding-bottom: 0">2.1. Тип (тент, откр., рефр-ор), грузоподъемность, размер кузова:</td>
            <td style="font-size: 9px; width: 60%; padding-top:0; padding-bottom: 0"  colspan="2">{{ implode(",", $dz["client_transport"]) }}</td>
        </tr>

        <tr>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">2.2. Дата и время загрузки:</td>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0"  colspan="2">
            {{ \Carbon\Carbon::parse($dz["date_zagruzki"])->format('d.m.Y')}}
            @if(!empty($dz["date_zagruzki_time_start"]))
            {{ $dz["date_zagruzki_time_start"] }}
            @endif
            @if(!empty($dz["date_zagruzki_time_end"]))
            - {{ $dz["date_zagruzki_time_end"] }}
            @endif
        </td>
        </tr>

        <tr>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">2.3. Адрес загрузки (наименование отправителя, город, улица, № дома, контактное лицо, номер телефона):</td>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0"  colspan="2">{{ $dz["address_zagruzki_contact"] }}</td>
        </tr>

        <tr>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">2.5. Описание груза (наименование, размеры и количество мест, тип упаковки, вес брутто)</td>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0"  colspan="2">
                @if($dz["gruz_poym"] == '-' && !empty($dz["gruz_fact"]))
                    {{ $dz["gruz_fact"] }}
                @else
                    {{ $dz["gruz_poym"] }}
                @endif
                @if(!empty($dz["ves"]))
                    ,{{ $dz["ves"] }} т.
                @endif
                @if(!empty($dz["objem"]))
                    ,{{ $dz["objem"] }} м<sup>3</sup>
                @endif
                @if(!empty($dz["upakovka"]))
                    ,{{ $dz["upakovka"] }}
                    @if(!empty($dz["upakovka_kolvo"]))
                     {{ $dz["upakovka_kolvo"] }}
                    @endif
                @endif
            </td>
        </tr>
        <tr>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">2.5.1. Способ погрузки (задняя, боковая, верхняя)</td>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0"  colspan="2">{{ implode(",", $dz["type_zagruzki"]) }}/{{ implode(",", $dz["type_razgruzki"]) }}</td>
        </tr>
        <tr>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">2.6. Дополнительные требования (класс опасности, номер ООН; кол-во крепежных ремней, пневмоподвески и т.д.):</td>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0"  colspan="2">{{ $dz["dop_trebovaniy"] }}</td>
        </tr>
        <tr>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">2.7. Дата доставки:</td>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0"  colspan="2">
            {{ \Carbon\Carbon::parse($dz["date_vigruzki"])->format('d.m.Y')}}
            @if(!empty($dz["date_razgruzki_time_start"]))
            {{ $dz["date_razgruzki_time_start"] }}
            @endif
            @if(!empty($dz["date_razgruzki_time_end"]))
            - {{ $dz["date_razgruzki_time_end"] }}
            @endif
        </td>
        </tr>
        <tr>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">2.8. Адрес разгрузки (наименование получателя, город, улица, № дома, контактное лицо, номер телефона):</td>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0" colspan="2">{{ $dz["address_vigruzki_contact"] }}</td>
        </tr>
        <tr>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">2.10. Нормативное время простоя на загрузке/разгрузке</td>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0" colspan="2"><u>1 сутки</u></td>
        </tr>
        <tr>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">2.11. Стоимость услуг и форма оплаты: </td>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0" colspan="2">{{ $dz["oplata_perevozchik"] }} руб.
                @if($dz["forma_oplata_company"] == "С НДС")
                {{ $dz["forma_oplata_company"] }}
                Выставить счет на {{ $dz["cshet_company"] }}
                @elseif($dz["forma_oplata_company"] == "На карту")
                    {{ $dz["forma_oplata_company"] }} - {{$voditel->karta_sber}}
                @else
                {{ $dz["forma_oplata_company"] }}
                @endif
                {{ $dz["srok_oplata"] }}
            </td>
        </tr>
        <tr>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">2.12. Гос. ном. знаки подвижного состава, согласованного к перевозке:</td>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0" colspan="2">{{ $dz["perevozchik_ts"] }}</td>
        </tr>
        <tr>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">2.12.1. Ф.И.О. и паспортные данные водителя:</td>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0" colspan="2">
            @if(!empty($voditel->vod_pas))
                {{ $voditel->vod_pas }}
            @else
            {{ $voditel->perevozchik_voditel }},
            {{ $voditel->perevozchik_tel }},
            {{ $voditel->pasport_voditel }}
            @endif
            </td>
        </tr>
        <tr>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">2.13. Документы, необходимые для отправки/оплаты, и обязательные примечания.</td>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0" colspan="2">
                @if(empty($dz["document"]) && !empty($dz["document_fact"]))
                    {{ $dz["document_fact"] }}
                @else
                    {{ $dz["document"] }}
                @endif
            </td>
        </tr>
        <tr>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">Код Ати Исполнителя и контакты</td>
            <td style="font-size: 9px; width: 10%; padding-top:0; padding-bottom: 0">
                {{ $voditel->code_ATI }}
            </td>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">
                Контакты: /  {{ $dz["perevozchik_tel"] }} /  {{ $voditel->perevozchik_email }}
            </td>
        </tr>
    </table>

    <p style="font-weight: bold; font-size: 11px; text-align: center; margin-bottom:0">3. Порядок расчетов.</p>
    <p style="font-weight: bold; font-size: 11px">Заказчик осуществляет оплату за выполненные Исполнителем услуги в следующем порядке</p>

    <p style="font-size: 9px; text-align: justify">3.1. Оплата осуществляется Заказчиком после получения скана документов, указанных в пункте 2.13  в хорошем качестве (PDF), фиксирующих передачу груза грузополучателю (подписанные грузополучателем, грузоотправителем и лицом, указанным в пункте 2.12 Договора Заявки), скан-квитка об отправке оригиналов этих документов  на почтовый адрес (при отправке на юридический адрес оплата будет приостановлена до получения оригиналов этих документов), а также описи, отправляемых документов. При отправке ТТН  на эл. адрес ПРОСИМ  указывать  № договора, маршрут и ФИО водителя. В противном случае оплата будет произведена через 7-12 банковских дней по оригиналам документов (указанных в пункте 2.13). Стороны договорились, что в отношении сумм платежей по настоящему Договору, проценты на сумму долга по ст. 317.1 Гражданского кодекса РФ не начисляются.</p>

    <p style="font-size: 9px; text-align: justify">3.2. В случае оплаты на расчетный счет с учётом НДС к отправляемым оригиналам документов фиксирующих передачу груза (согласно п. 2.13) приложить подписанный счёт, УПД (акт, сч. фактура).</p>

    <p style="font-size: 9px; text-align: justify">3.3. В случае перечисления денежных средств от третьих заинтересованных лиц (в том числе аффилированных с Заказчиком либо
    Грузополучателем), Исполнитель подтверждает, что это является фактом оплаты Заказчиком услуг Исполнителя и предоставляет свое согласие на
    оплату услуги со счета партнера Заказчика. При оплате на карту Сбербанка 50 % от суммы комиссии взыскиваемых банком за перевод денежных
    средств оплачивается Исполнителем.</p>

    <p style="font-size: 9px; text-align: justify">3.4. Оригиналы документов, а именно полный комплект ТТН, указанных в п. 3.1. и п. 3.2. должны быть направлены Заказчику в течение 7 (семи) календарных дней с момента выгрузки. В случае задержки отправки документов оплата за выполненные услуги будет приостановлена. В случае задержки с отправкой документов свыше 20 (двадцати) календарных дней, либо, если Исполнитель присылает оригиналы документов на юридический адрес Заказчика или какой-либо другой вместо почтового, Заказчик вправе наложить штраф в размере 20 % от стоимости услуг, если иной штраф не указан в пункте 4.1.</p>

    <p style="font-size: 9px; text-align: justify">3.5. Оригиналы и сканы документов, фиксирующих передачу груза (согласно п. 2.13.), оформленные с нарушениями, а именно с отсутствующими
    подписями грузополучателя, грузоотправителя и лица, указанного в пункте 2.12. Договора Заявки, а также отсутствующими печатями
    грузополучателя и грузоотправителя, для оплаты приниматься не будут.</p>

    <p style="font-size: 9px; text-align: justify">3.6. Восстановление необходимых документов производится за счет Исполнителя с удержанием 3 000 руб. из стоимости услуг и по срокам согласно
    п. 3.1</p>

    <p style="font-weight: bold; font-size: 11px; text-align: center">4. Ответственность сторон</p>
     <p style="font-size: 9px; text-align: justify">
     4.1 Исполнитель несет ответственность за срыв перевозки:
     </p>
     <p style="font-size: 9px; text-align: justify">
     - за отказ от перевозки менее, чем за 24 часа до времени подачи автотранспортного средства на место загрузки, согласованного п. 2.2. настоящего Договора, Исполнитель уплачивает Заказчику штраф в размере 20% от стоимости фрахта;
     </p>
     <p style="font-size: 9px; text-align: justify">
     - за неподачу автотранспортного средства на место загрузки к дате и времени, указанные в настоящем Договоре, Исполнитель уплачивает Заказчику штраф в размере 20% от стоимости фрахта;
     </p>
     <p style="font-size: 9px; text-align: justify">
     - за неподачу автотранспортного средства на место разгрузки к дате и времени, указанные в настоящем Договоре, Исполнитель уплачивает Заказчику штраф в размере 10% от стоимости фрахта, за каждые сутки опоздания, но не менее 2000 рублей; а в случае обнаружения несогласованных догрузов, Исполнитель уплачивает Заказчику штраф в размере 50% от стоимости фрахта.
     </p>
     <p style="font-size: 9px; text-align: justify">
     - подача автотранспортного средства, не соответствующего п. 2.1/ и/или п.2.6, а также непригодного для перевозки груза в соответствии с условиями п. 2.5. при отказе грузоотправителя грузить данное автотранспортное средство приравнивается к срыву перевозки, за что Исполнитель уплачивает Заказчику штраф в размере 20% от стоимости фрахта. Если Исполнитель принял к перевозке крупногабаритный (негабаритный)  или тяжеловесный или опасный (АДР) груз, соответствующий данной Договор-Заявке, то в случае привлечения Заказчика и/или Грузоотправителя Заказчика к административной ответственности за перевозку крупногабаритных и/или тяжеловесных, либо опасных грузов в транспортном средстве, предоставленном Исполнителем, Исполнитель обязан возместить Заказчику сумму наложенного административного штрафа, а также обеспечить своевременную доставку до Грузополучателя в соответствии с указанными в Договор-Заявке сроками либо оплатить все дополнительные расходы Заказчика по перегрузу в автотранспортное средство третьих лиц и дополнительный фрахт по доставке принятого груза до места назначения на основании письменного требования в течение 15 (пятнадцати) календарных дней с даты его получения. Требование может быть направлено с использованием почтовой связи, факса или сети Интернет (электронной почтой). Заказчик вправе удержать в одностороннем порядке компенсацию штрафа из стоимости оказанных "Исполнителем" услуг.
     </p>
     <p style="font-size: 9px; text-align: justify">
     - отказ представителя (водителя) Исполнителя от пересчета грузовых мест при загрузке и подписания им товарно-сопроводительных документов о принятии груза приравнивается к не подаче автотранспортного средства на место загрузки. Водитель Исполнителя обязан проконтролировать, чтобы был загружен весь груз, указанный в п. 2.5. (количество, вес и т.п.). При этом груз может быть погружен частями по нескольким комплектам товарно-сопроводительных документов. При погрузке груза не соответствующего заявке, в меньшем количестве или отличающегося по весу от данных в п. 2.5. заявки, водитель Исполнителя обязан проинформировать Представителя Заказчика и не уезжать с места погрузки без согласования Заказчика. Вес груза и количество груза должны быть не меньше заявленных, но не больше грузоподъемности и грузовместимости заказанного транспорта. Если в Договор-заявке не согласована доставка догрузом, то увеличение объема или веса груза в пределах грузоподъемности и грузовместимости поданного автотранспортного средства считается согласованным и стоимость услуг оплачивается в соответствии с п. 2.11. без доплат.
     </p>
     <p style="font-size: 9px; text-align: justify">
     4.2. За несоблюдение водителем Исполнителя требований внутризаводского и пропускного режимов грузоотправителя/грузополучателя, техники безопасности, пожарной безопасности и иных требований, предусмотренных локальными актами грузоотправителя/грузополучателя, если указанные обстоятельства подтверждены актом, составленным работниками грузоотправителя, Исполнитель несет ответственность перед Заказчиком в виде предусмотренного грузоотправителем/грузополучателем штрафа. Исполнитель обязуется подавать под загрузку технически исправный подвижной состав и отвечающий санитарным требованиям, в соответствии с требованиями Заказчика (сухой/чистый тент без посторонних предметов и запахов, пол должен быть ровным без гвоздей или иных предметов).
     </p>
     <p style="font-size: 9px; text-align: justify">
     4.3. Водитель ТС обязан контролировать погрузку груза в ТС, в том числе следить за размещением груза таким образом, чтобы обеспечить выполнение требований безопасности дорожного движения и соблюдение допустимой массы ТС, нагрузки на оси ТС, а также проверить исправность упаковки и обеспечить крепление груза в ТС. В случае привлечения Заказчика и/или Грузоотправителя Заказчика к административной ответственности за превышение допустимой массы транспортного средства и/или допустимой нагрузки на ось транспортного средства, предоставленного Исполнителем, Исполнитель обязан возместить Заказчику сумму наложенного административного штрафа на основании письменного требования в течение 15 (пятнадцати) календарных дней с даты его получения. Требование может быть направлено с использованием почтовой связи, факса или сети Интернет (электронной почтой). Заказчик вправе удержать в одностороннем порядке компенсацию штрафа из стоимости оказанных "Исполнителем" услуг.
     </p>
     <p style="font-size: 9px; text-align: justify">
     4.4. Исполнитель несет ответственность за сохранность передаваемого ему груза в полном объеме. В случае предъявления материальных претензий по выполненным услугам со стороны Грузополучателя к Заказчику (потеря/порча груза, опоздание на разгрузку) Заказчик вправе предъявить их к Исполнителю в регрессорном порядке, Исполнитель обязуется возместить их Заказчику в полном объеме. При этом грузополучатель и Заказчик предоставляют соответствующий Акт либо документ, подтверждающий потерю/порчу груза/опоздание на загрузку.  Заказчик вправе удержать в одностороннем порядке сумму возмещения материальных претензий к Исполнителю из стоимости оказанных "Исполнителем" услуг.
     </p>
     <p style="font-size: 9px; text-align: justify">
     Исполнитель несет ответственность за соблюдение правил пункта 1.2 Договора. Заказчик несет ответственность за срыв перевозки:
     </p>
     <p style="font-size: 9px; text-align: justify">
     - за неподачу автотранспортного средства на место разгрузки к дате и времени, указанные в настоящем Договоре, Исполнитель уплачивает Заказчику штраф в размере 10% от стоимости фрахта, за каждые сутки опоздания, но не менее 2000 рублей; а в случае обнаружения несогласованных догрузов, Исполнитель уплачивает Заказчику штраф в размере 50% от стоимости фрахта.
     </p>
     <p style="font-size: 9px; text-align: justify">
     4.5. Заказчик вправе в одностороннем порядке произвести зачет денежных средств с основного платежа в счет штрафных неустоек.
     </p>
     <p style="font-size: 9px; text-align: justify">
     4.6. Исполнитель не вправе удерживать переданные ему для перевозки грузы в обеспечение причитающихся ему провозной платы и других платежей за предоставленные транспортные услуги по доставке грузов.
     </p>
     <p style="font-size: 9px; text-align: justify">
     4.7.  За сверхнормативный простой, определяемый на основании пункта 2.10. настоящего Договора, за каждые начатые сутки Заказчик уплачивает штраф в размере 1000 руб. Выходные и праздничные дни включаются в простой при условии, что являются рабочими для грузоотправителя. Предъявление груза для перевозки не будет считаться опозданием (срывом), если Заказчик предъявит груз в течение 5-7 рабочих дней с даты подачи автотранспортного средства. При этом Исполнителю необходимо предоставить оригиналы документов, подтверждающих факт простоя – простойный лист, ТТН/ТН или путевой лист с соответствующими отметками.
     </p>
     <p style="font-size: 9px; text-align: justify">
     4.8. До предъявления иска, связанного с нарушением условий настоящего Договора, обязательно предъявление претензии в письменной форме в порядке, предусмотренным законодательством РФ. Ответ на претензию должен быть не более 10  (десяти) календарных дней с момента вручения претензии.
     </p>
     <p style="font-size: 9px; text-align: justify">
     4.9. В случае нарушения условий договора стороны несут ответственность согласно действующему законодательству РФ.
     </p>
     <p style="font-size: 9px; text-align: justify">
     4.10. Споры, возникающие между сторонами по выполнению условий настоящего договора, рассматриваются в Арбитражном суде Республики Башкортостан либо в соответствии с законодательством.
     </p>

     <p style="font-weight: bold; font-size: 11px; text-align: center">5. Дополнительные условия к Договор-Заявке.</p>
     <p style="font-size: 9px; text-align: justify">
        @if(!empty($dz["dop_uslovia"]))
        5.1. {{ $dz["dop_uslovia"] }}
        @else
        5.1. Дополнительные условия отсутствуют
        @endif
    </p>

    <p style="font-weight: bold; font-size: 11px; text-align: center">6. Заключительные положения</p>
    <p style="font-size: 9px; text-align: justify">6.1. Настоящий Договор вступает в силу с момента его подписания и будет действовать до полного выполнения Сторонами обязательств указанных в настоящем Договоре. Срок предъявления претензий от Исполнителя по оплате его услуг составляет 6 месяцев</p>
    <p style="font-size: 9px; text-align: justify">6.2. В случае выявления факта коммерческого подкупа (отката) логиста(у) заказчика со стороны исполнителя договор расторгается заказчиком в одностороннем порядке, и оплата услуги по доставке грузов, осуществлённая исполнителем, не будет произведена.</p>
    <p style="font-size: 9px; text-align: justify">6.3. В случае выяления Службой Безопасности признаков недобросовестности налогоплательщиков со стороны исполнителя заказчик в праве потребовать замену контрагента для произведения расчётов за услугу по доставке грузов.</p>
    <p style="font-size: 9px; text-align: justify">6.4. Настоящий Договор составлен в двух экземплярах, имеющих равную юридическую силу.</p>
    <p style="font-size: 9px; text-align: justify">6.5. Договор, подписанный Сторонами и переданный посредством факсимильной или электронной связи (а также вся переписка между сторонами), имеет юридическую силу.</p>

    <table class="table" border="0">
        <tr>
            <td style="font-size: 9px; width: 50%; border: none; text-align: center; padding-top:0; padding-bottom: 0">Заказчик</td>
            <td style="font-size: 9px; width: 50%; border: none; text-align: center; padding-top:0; padding-bottom: 0">Исполнитель</td>
        </tr>
        <tr>
            <td style="font-size: 9px; width: 50%; border: 1px solid #dee2e6; padding-top:0; padding-bottom: 0">{{ $companies->company_name }}</td>
            <td style="font-size: 9px; width: 50%; border: 1px solid #dee2e6; padding-top:0; padding-bottom: 0">{{ $dz["perevozchik_name"] }}</td>
        </tr>
        <tr>
            <td style="font-size: 9px;border: 1px solid #dee2e6; border-bottom:0px solid #fff !important; padding-top:0; padding-bottom: 0">
                {!! str_replace(array("\n"), '<br>', $companies->rekvizity) !!}
            </td>
            <td style="padding: 0; border-right: 1px solid #dee2e6">
                <table class="table table-bordered">
                    <tr>
                        <td style="font-size: 9px;border-top: transparent; padding-top:0; padding-bottom: 0">Почта</td>
                        <td style="font-size: 9px;border-top: transparent; padding-top:0; padding-bottom: 0">{{ $voditel->perevozchik_email }}</td>
                    </tr>
                    <tr>
                        <td style="font-size: 9px;border-left: transparent; padding-top:0; padding-bottom: 0">АТИ</td>
                        <td style="font-size: 9px; padding-top:0; padding-bottom: 0">{{ $voditel->code_ATI }}</td>
                    </tr>
                </table>

                <div style="padding: 0.5rem 0.5rem; font-size: 9px">
                    {!! str_replace(array("\n"), '<br>', $carrier_company->contacts) !!}
                </div>
            </td>
        </tr>

        <tr>
            <td style="font-size: 9px; padding-top: 120px;border-top:0px solid #fff !important; text-align:center; border: 1px solid #dee2e6">
            <div style="position: relative">
                @if (!empty($companies->stamp) && $dz["indikator_sb"] != 0)
                    <img src="{{ asset('public/img/'.$companies->stamp)}}" style="position: absolute; top:-95px; left: 40px; width: 150px"> <span>_________________/{{ $companies->name_director_2 }}</span>
                @else
                <span>_________________/{{ $companies->name_director_2 }}</span>
                @endif
            </div>
        </td>
            <td style="font-size: 9px; padding-top: 120px;border-top:0px solid #fff !important; text-align:center; border: 1px solid #dee2e6">_________________/{{ $carrier_company->name_director }}</td>
        </tr>
    </table>

    <p style="font-weight: bold; font-size: 11px;">
        @if ($partner == 0) Адрес для почты: г.Уфа 450022 а/я 40. Представитель {{ $companies->company_name }}, Логист {{ $dz["logist_name"] }}, тел.: {{ \Auth::user()->tel }}, {{ \Auth::user()->email }} @endif
    </p>

</body>
@elseif ($type_doc == "СОЗДАТЬ ДЗ КЛИЕНТ")
<body>

    @if ($partner == 0)
    <table class="table" border="0" style="border: none;">
        <tr>
            <td style="width: 50%; padding-top:0; padding-bottom: 0; padding-left:0; border: none; vertical-align: middle">
                <p style="font-weight: bold; font-size: 10px; text-align: left">Договор-заявка №{{ $dz["nomer"] }} от {{ \Carbon\Carbon::parse($dz["date"])->format('d.m.Y')}}</p>
            </td>
            <td style=" width: 10%; padding-top:0; padding-bottom: 0; border: none;"></td>
            <td style=" width: 30%; padding-top:0; padding-bottom: 0; border: none; vertical-align: middle">
                <p style="font-size: 9px; text-align: left">Логист {{ \Auth::user()->name }}<br> тел.: {{ \Auth::user()->tel }}<br>Почта: {{ \Auth::user()->email }}</p>
            </td>
            <td style=" width: 10%; padding-top:0; padding-bottom: 0; border: none; vertical-align: middle">
                <div style="margin-bottom: 10px; text-align:right">
                    <img src="{{ asset('public/img/logo-g.png')}}" style="width: 60px">
                </div>
            </td>
        </tr>
    </table>
    @else
    <p style="font-weight: bold; font-size: 10px; text-align: center">Договор-заявка от {{ \Carbon\Carbon::parse($dz["date"])->format('d.m.Y')}}</p>
    @endif
    <p style="font-size: 9px; text-align: justify">
    {{ $companies->company_name }}, именуемое в дальнейшем «Исполнитель», в лице директора {{ $companies->name_director_1 }}, действующего
    на основании Устава с одной стороны и {{ $client->client_name }} в лице руководителя {{ $client->name_director_1 }}, именуемое в дальнейшем «Заказчик», действующего на
    основании Устава/свидетельства, с другой стороны, совместно именуемые «Стороны» а по отдельности «Сторона», заключили
    настоящий Договор о нижеследующем:
    </p>

    <p></p>
    <table class="table table-bordered">
        <tr>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">Тип (тент, откр., рефр-ор), грузоподъемность, размер кузова:</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0">{{ implode(",", $dz["client_transport"]) }}</td>
        </tr>

        <tr>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">Дата и время загрузки:</td>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">
            {{ \Carbon\Carbon::parse($dz["date_zagruzki"])->format('d.m.Y')}}
            @if(!empty($dz["date_zagruzki_time_start"]))
            {{ $dz["date_zagruzki_time_start"] }}
            @endif
            @if(!empty($dz["date_zagruzki_time_end"]))
            - {{ $dz["date_zagruzki_time_end"] }}
            @endif
        </td>
        </tr>

        <tr>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">Адрес загрузки (наименование отправителя, город, улица, № дома, контактное лицо, номер телефона):</td>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">{{ $dz["address_zagruzki_contact"] }}</td>
        </tr>

        <tr>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">Описание груза (наименование, размеры и количество мест, тип упаковки, вес брутто)</td>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">
                @if($dz["gruz_poym"] == '-' && !empty($dz["gruz_fact"]))
                    {{ $dz["gruz_fact"] }}
                @else
                    {{ $dz["gruz_poym"] }}
                @endif
                @if(!empty($dz["ves"]))
                    ,{{ $dz["ves"] }} т.
                @endif
                @if(!empty($dz["objem"]))
                    ,{{ $dz["objem"] }} м<sup>3</sup>
                @endif
                @if(!empty($dz["upakovka"]))
                    ,{{ $dz["upakovka"] }}
                    @if(!empty($dz["upakovka_kolvo"]))
                     {{ $dz["upakovka_kolvo"] }}
                    @endif
                @endif
            </td>
        </tr>
        <tr>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0"> Способ погрузки (задняя, боковая, верхняя)</td>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">{{ implode(",", $dz["type_zagruzki"]) }}/{{ implode(",", $dz["type_razgruzki"]) }}</td>
        </tr>
        <tr>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">Дополнительные требования (класс опасности, номер ООН; кол-во крепежных ремней, пневмоподвески и т.д.):</td>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">{{ $dz["dop_trebovaniy"] }}</td>
        </tr>
        <tr>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">Дата доставки:</td>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">
            {{ \Carbon\Carbon::parse($dz["date_vigruzki"])->format('d.m.Y')}}
            @if(!empty($dz["date_razgruzki_time_start"]))
            {{ $dz["date_razgruzki_time_start"] }}
            @endif
            @if(!empty($dz["date_razgruzki_time_end"]))
            - {{ $dz["date_razgruzki_time_end"] }}
            @endif
        </td>
        </tr>
        <tr>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">Адрес разгрузки (наименование получателя, город, улица, № дома, контактное лицо, номер телефона):</td>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">{{ $dz["address_vigruzki_contact"] }}</td>
        </tr>
        <tr>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">Нормативное время простоя на загрузке/разгрузке</td>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0"><u>1 сутки</u></td>
        </tr>
        <tr>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">Стоимость услуг и форма оплаты: </td>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">{{ $dz["oplata_client"] }} руб. {{ $dz["forma_oplata_client"] }} </td>
        </tr>
        <tr>
            <td style="padding: 0; border:none;" colspan="2">
                <div style="font-size: 9px;text-align:center; border: 1px solid #000; border-top: none; border-bottom: none;">
                    <b>Заполняется Экспедитором:</b>
                </div>
            </td>
        </tr>
        <tr>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">2.12. Гос. ном. знаки подвижного состава, согласованного к перевозке:</td>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">{{ $dz["perevozchik_ts"] }}</td>
        </tr>
        <tr>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">2.12.1. Ф.И.О. и паспортные данные водителя:</td>
            <td style="font-size: 9px; padding-top:0; padding-bottom: 0">
            @if(!empty($voditel->vod_pas))
                {{ $voditel->vod_pas }}
            @else
            {{ $voditel->perevozchik_voditel }},
            {{ $voditel->perevozchik_tel }},
            {{ $voditel->pasport_voditel }}
            @endif
            </td>
        </tr>
        <tr>
            <td style="font-size: 9px; width: 50%; border: 1px solid #dee2e6; padding: 0">
                <table class="table" style="margin-bottom: 0;">
                    <tr>
                        <td style="font-size: 9px;border-top: transparent;border-left: transparent; padding-top:0; padding-bottom: 0; border-bottom: none; width: 20%">Клиент:</td>
                        <td style="font-size: 9px;border-top: transparent;border-right: transparent; padding-top:0; padding-bottom: 0; border-bottom: none">{{ $client->client_name }}</td>
                    </tr>
                </table>
            </td>
            <td style="font-size: 9px; width: 50%; border: 1px solid #dee2e6; padding: 0">
                <table class="table" style="margin-bottom: 0;">
                    <tr>
                        <td style="font-size: 9px;border-top: transparent;border-left: transparent; padding-top:0; padding-bottom: 0; border-bottom: none; width: 20%">Экспедитор:</td>
                        <td style="font-size: 9px;border-top: transparent; padding-top:0; padding-bottom: 0; border-bottom: none">{{ $companies->company_name }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="font-size: 9px;border: 1px solid #dee2e6; border-bottom:0px solid #fff !important; padding-top:0; padding-bottom: 0">
                {!! str_replace(array("\n"), '<br>', $client->rekvizity) !!}
            </td>
            <td style="font-size: 9px;border: 1px solid #dee2e6; border-bottom:0px solid #fff !important; padding-top:0; padding-bottom: 0">
                {!! str_replace(array("\n"), '<br>', $companies->rekvizity) !!}
            </td>
        </tr>

        <tr>
            <td style="font-size: 9px; padding-top: 120px;border-top:0px solid #fff !important; text-align:center; border: 1px solid #dee2e6">_________________/{{ $client->name_director_2 }}</td>
            <td style="font-size: 9px; padding-top: 120px;border-top:0px solid #fff !important; text-align:center; border: 1px solid #dee2e6">
                <div style="position: relative">
                    @if (!empty($companies->stamp) && $dz["indikator_sb"] != 0)
                        <img src="{{ asset('public/img/'.$companies->stamp)}}" style="position: absolute; top:-95px; left: 40px; width: 150px"> <span>_________________/{{ $companies->name_director_2 }}</span>
                    @else
                    <span>_________________/{{ $companies->name_director_2 }}</span>
                    @endif
                </div>
            </td>
        </tr>
    </table>
</body>
@else
<body>
    <table class="table table-bordered m-0">
        <tr>
            <td style="font-size: 9px; width: 10%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle">Номер доверенности</td>
            <td style="font-size: 9px; width: 10%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle">Дата выдачи</td>
            <td style="font-size: 9px; width: 10%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle">Срок действия</td>
            <td style="font-size: 9px; width: 40%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle">Должность и фамилия лица, которому выдана доверенность</td>
            <td style="font-size: 9px; width: 30%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle">Расписка в получении доверенности</td>
        </tr>
        <tr>
            <td style="font-size: 9px; width: 10%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle">1</td>
            <td style="font-size: 9px; width: 10%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle">2</td>
            <td style="font-size: 9px; width: 10%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle">3</td>
            <td style="font-size: 9px; width: 40%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle">4</td>
            <td style="font-size: 9px; width: 30%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle">5</td>
        </tr>
        <tr>
            <td style="font-size: 9px; width: 10%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle">{{ $dz["nomer"] }}</td>
            <td style="font-size: 9px; width: 10%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle">{{ \Carbon\Carbon::parse($dz["date"])->format('d.m.Y')}}</td>
            <td style="font-size: 9px; width: 10%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle">
                {{ \Carbon\Carbon::parse($dz["date"])->add(10, 'day')->format('d.m.Y') }}
            </td>
            <td style="font-size: 9px; width: 40%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle">{{ $voditel->perevozchik_voditel }}</td>
            <td style="font-size: 9px; width: 30%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle"></td>
        </tr>
    </table>
    <table class="table table-bordered">
        <tr>
            <td style="font-size: 9px; width: 25%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle">Поставщик</td>
            <td style="font-size: 9px; width: 30%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle">Номер и дата наряда (замещающего наряд документа) или извещения</td>
            <td style="font-size: 9px; width: 45%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle">Номер и дата документа, подтверждающего выполнение поручения</td>
        </tr>
        <tr>
            <td style="font-size: 9px; width: 25%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle">6</td>
            <td style="font-size: 9px; width: 30%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle">7</td>
            <td style="font-size: 9px; width: 45%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle">8</td>
        </tr>
        <tr>
            <td style="font-size: 9px; width: 25%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle">{{ $dz["client_name"] }}</td>
            <td style="font-size: 9px; width: 30%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle"></td>
            <td style="font-size: 9px; width: 45%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle"></td>
        </tr>
    </table>

    <p style="font-size: 9px; text-align:right;">Типовая межотраслевая форма № М-2 <br> Утверждена постановлением Госкомстата России от 30.10.97 № 71а</p>
    <table class="table" style="border: none; margin-bottom: 0">
        <tr>
            <td style="font-size: 9px; width: 75%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle; border: none"></td>
            <td style="font-size: 9px; width: 15%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle; border: none"></td>
            <td style="font-size: 9px; width: 10%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle; border: 1px solid #000">коды</td>
        </tr>
        <tr>
            <td style="font-size: 9px; width: 75%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle; border: none"></td>
            <td style="font-size: 9px; width: 15%; padding-top:0; padding-bottom: 0; text-align:right; vertical-align:middle; border: none">Форма по ОКУД</td>
            <td style="font-size: 9px; width: 10%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle; border: 1px solid #000">315001</td>
        </tr>
        <tr>
            <td style="font-size: 9px; width: 75%; padding: 0; text-align:left; vertical-align:bottom; border: none;padding-left: 50px !important"><span style="vertical-align:middle;">Организация</span> <div style="width: 400px; border-bottom: 1px solid #000; display: inline-block">{{ $companies->company_name }}</div></td>
            <td style="font-size: 9px; width: 15%; padding-top:0; padding-bottom: 0; text-align:right; vertical-align:middle; border: none">по ОКПО</td>
            <td style="font-size: 9px; width: 10%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle; border: 1px solid #000"></td>
        </tr>
        <tr>
            <td style="font-size: 7px; width: 75%; padding: 0; text-align:center; vertical-align:top; border: none;padding-left: 50px !important"><div style="width: 100%;">наименование организации</div></td>
            <td style="font-size: 9px; width: 15%; padding-top:0; padding-bottom: 0; text-align:right; vertical-align:middle; border: none"></td>
            <td style="font-size: 9px; width: 10%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle; border: none"></td>
        </tr>
    </table>

    <table class="table" style="border: none">
        <tr>
            <td style="font-size: 9px; width: 30%;padding: 0; text-align:right; vertical-align:middle; border: none; font-weight: bold">ДОВЕРЕННОСТЬ №</td>
            <td style="font-size: 9px; width: 70%; padding-top:0; padding-bottom: 0; text-align:left; vertical-align:middle; border: none; font-weight: bold"><u>{{ $dz["nomer"] }}</u></td>
        </tr>
        <tr>
            <td style="font-size: 9px; width: 30%; padding: 0; text-align:right; vertical-align:middle; border: none">Дата выдачи:</td>
            <td style="font-size: 9px; width: 70%; padding-top:0; padding-bottom: 0; text-align:left; vertical-align:middle; border: none"><u>{{ \Carbon\Carbon::parse($dz["date"])->format('d.m.Y')}}</u></td>
        </tr>
        <tr>
            <td style="font-size: 9px; width: 30%; padding: 0; text-align:right; vertical-align:bottom; border: none">Доверенность действительна до:</td>
            <td style="font-size: 9px; width: 70%; padding-top:0; padding-bottom: 0; text-align:left; vertical-align:middle; border: none"><u>{{ \Carbon\Carbon::parse($dz["date"])->add(10, 'day')->format('d.m.Y') }}</u></td>
        </tr>
    </table>

    <table class="table" style="border: none; margin-top:15px; margin-bottom: 15px">
        <tr>
            <td style="font-size: 9px; padding: 0; text-align:left; vertical-align:bottom; border: none;padding-left: 50px !important"><div style="width: 100%; border-bottom: 1px solid #000;">{{ $companies->inn }}</div></td>
        </tr>
        <tr>
            <td style="font-size: 7px; padding: 0; text-align:center; vertical-align:top; border: none;padding-left: 50px !important"><div style="width: 100%;">наименование потребителя и его адрес</div></td>
        </tr>
    </table>

    <table class="table" style="border: none; margin-top:0px; margin-bottom: 0">
        <tr>
            <td style="font-size: 9px; padding: 0; text-align:left; vertical-align:bottom; border: none;padding-left: 50px !important"><div style="width: 100%; border-bottom: 1px solid #000;">{{ $companies->inn }}</div></td>
        </tr>
        <tr>
            <td style="font-size: 7px; padding: 0; text-align:center; vertical-align:top; border: none;padding-left: 50px !important"><div style="width: 100%;">наименование плательщика и его адрес</div></td>
        </tr>
    </table>

    <table class="table" style="border: none; margin-bottom: 0">
        <tr>
            <td style="font-size: 9px; width: 20%;padding: 0; text-align:right; vertical-align:bottom; border: none;">Счет №</td>
            <td style="font-size: 9px; width: 35%; padding-top:0; padding-bottom: 0; text-align:left; vertical-align:bottom; border: none;"><div style="width: 100%; border-bottom: 1px solid #000;"></div></td>
            <td style="font-size: 9px; width: 2%; padding-top:0; padding-bottom: 0; text-align:left; vertical-align:bottom; border: none;">в</td>
            <td style="font-size: 9px; width: 43%; padding-top:0; padding-bottom: 0; text-align:left; vertical-align:bottom; border: none;"><div style="width: 100%; border-bottom: 1px solid #000;"></div></td>
        </tr>
        <tr>
            <td style="font-size: 9px; width: 20%;padding: 0; text-align:right; vertical-align:middle; border: none;"></td>
            <td style="font-size: 9px; width: 35%; padding-top:0; padding-bottom: 0; text-align:left; vertical-align:middle; border: none;"></td>
            <td style="font-size: 9px; width: 2%; padding-top:0; padding-bottom: 0; text-align:left; vertical-align:middle; border: none;"></td>
            <td style="font-size: 7px; width: 43%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:top; border: none;"><div style="width: 100%;">наименование банка</div></td>
        </tr>
    </table>

    <table class="table" style="border: none; margin-bottom: 0">
        <tr>
            <td style="font-size: 9px; width: 20%;padding: 0; text-align:right; vertical-align:middle; border: none;">Доверенность выдана</td>
            <td style="font-size: 9px; width: 20%; padding-top:0; padding-bottom: 0; text-align:left; vertical-align:middle; border: none;"><div style="width: 100%; border-bottom: 1px solid #000;">водитель</div></td>
            <td style="font-size: 9px; width: 60%; padding-top:0; padding-bottom: 0; text-align:left; vertical-align:middle; border: none;"><div style="width: 100%; border-bottom: 1px solid #000;">{{ $voditel->perevozchik_voditel }}</div></td>
        </tr>
        <tr>
            <td style="font-size: 9px; width: 20%;padding: 0; text-align:right; vertical-align:middle; border: none;"></td>
            <td style="font-size: 7px; width: 20%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle; border: none;"><div style="width: 100%;">должность</div></td>
            <td style="font-size: 7px; width: 60%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:top; border: none;"></td>
        </tr>
    </table>

    <table class="table" style="border: none; margin-bottom: 0">
        <tr>
            <td style="font-size: 9px; width: 20%;padding: 0; text-align:right; border: none;">Паспорт: серия и номер<br> Кем выдан</td>
            <td style="font-size: 9px; width: 50%; padding-top:0; padding-bottom: 0; text-align:left; border: none;"><div style="width: 100%;">{!! str_replace(array("\n"), '<br>', $voditel->pasport_voditel) !!}</div></td>
            <td style="font-size: 9px; width: 30%; padding-top:0; padding-bottom: 0; border: none;"></td>
        </tr>
    </table>

    <table class="table" style="border: none; margin-bottom: 0">
        <tr>
            <td style="font-size: 9px; width: 20%;padding: 0; text-align:right; vertical-align:middle; border: none;">На получение от</td>
            <td style="font-size: 9px; width: 80%; padding-top:0; padding-bottom: 0; text-align:left; vertical-align:middle; border: none;"><div style="width: 100%; border-bottom: 1px solid #000;">{{ $dz['client_name'] }}</div></td>
        </tr>
        <tr>
            <td style="font-size: 9px; width: 20%;padding: 0; text-align:right; vertical-align:middle; border: none;"></td>
            <td style="font-size: 7px; width: 80%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:middle; border: none;"><div style="width: 100%;">наименование поставщика</div></td>
        </tr>
    </table>

    <table class="table" style="border: none">
        <tr>
            <td style="font-size: 9px; width: 20%;padding: 0; text-align:right; vertical-align:bottom; border: none;">Материальных ценностей по</td>
            <td style="font-size: 9px; width: 80%; padding-top:0; padding-bottom: 0; text-align:left; vertical-align:bottom; border: none;"><div style="width: 100%; border-bottom: 1px solid #000;"></div></td>
        </tr>
        <tr>
            <td style="font-size: 9px; width: 20%;padding: 0; text-align:right; vertical-align:bottom; border: none;"></td>
            <td style="font-size: 7px; width: 80%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:top; border: none;"><div style="width: 100%;">наименование, номер и дата документа</div></td>
        </tr>
    </table>

    <table class="table" style="border: none">
        <tr>
            <td style="font-size: 9px; width: 100%; padding-top:0; padding-bottom: 0; text-align:left; vertical-align:bottom; border: none;"><div style="width: 100%; border-bottom: 1px solid #000;"></div></td>
        </tr>
    </table>
    <p style="font-size: 9px;"><b>Перечень товарно-материальных ценностей, подлежащих получению</b></p>

    <table class="table table-bordered">
        <tr>
            <td style="font-size: 9px; width: 10%;padding-top: 0;padding-bottom: 0; text-align:center; vertical-align:middle;">Номер по порядку</td>
            <td style="font-size: 9px; width: 40%;padding-top: 0;padding-bottom: 0; text-align:center; vertical-align:middle;">Материальные ценности</td>
            <td style="font-size: 9px; width: 10%;padding-top: 0;padding-bottom: 0; text-align:center; vertical-align:middle;">Единица измерения</td>
            <td style="font-size: 9px; width: 40%;padding-top: 0;padding-bottom: 0; text-align:center; vertical-align:middle;">Количество (прописью)</td>
        </tr>
        @php $id=1; @endphp
        @while ($id < 6)
        <tr>
            <td style="font-size: 9px; width: 10%;padding-top: 0;padding-bottom: 0; text-align:center; vertical-align:middle;">{{$id}}</td>
            <td style="font-size: 9px; width: 40%;padding-top: 0;padding-bottom: 0; text-align:center; vertical-align:middle;"></td>
            <td style="font-size: 9px; width: 10%;padding-top: 0;padding-bottom: 0; text-align:center; vertical-align:middle;"></td>
            <td style="font-size: 9px; width: 40%;padding-top: 0;padding-bottom: 0; text-align:center; vertical-align:middle;"></td>
        </tr>
        @php $id++; @endphp
        @endwhile
    </table>

    <p style="font-size: 9px;">Подпись лица, получившего доверенность <u> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </u> удостоверяем</p>



    <div style="position: relative">
        <table class="table" style="border: none; margin-bottom: 0; margin-top: 20px">
            <tr>
                <td style="font-size: 9px; width: 15%;padding: 0; text-align:left; vertical-align:bottom; border: none;">Руководитель</td>
                <td style="font-size: 9px; width: 20%; padding-top:0; padding-bottom: 0; text-align:left; vertical-align:bottom; border: none;"><div style="width: 100%; border-bottom: 1px solid #000;"></div></td>
                <td style="font-size: 9px; width: 30%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:bottom; border: none;"><div style="width: 100%; border-bottom: 1px solid #000;">{{ $companies->name_director_2 }}</div></td>
                <td style="font-size: 9px; width: 35%; border: none;"></td>
            </tr>
            <tr>
                <td style="font-size: 9px; width: 15%;padding: 0; text-align:left; vertical-align:middle; border: none;"></td>
                <td style="font-size: 7px; width: 20%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:top; border: none;"><div style="width: 100%;">подпись</div></td>
                <td style="font-size: 7px; width: 30%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:top; border: none;"><div style="width: 100%;">расшифровка подписи</div></td>
                <td style="font-size: 9px; width: 35%; border: none;"></td>
            </tr>
        </table>

        <table class="table" style="border: none; margin-bottom: 0; margin-top: 20px">
            <tr>
                <td style="font-size: 9px; width: 15%;padding: 0; text-align:left; vertical-align:bottom; border: none;">Главный бухгалтер</td>
                <td style="font-size: 9px; width: 20%; padding-top:0; padding-bottom: 0; text-align:left; vertical-align:bottom; border: none;"><div style="width: 100%; border-bottom: 1px solid #000;"></div></td>
                <td style="font-size: 9px; width: 30%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:bottom; border: none;"><div style="width: 100%; border-bottom: 1px solid #000;">{{ $companies->name_director_2 }}</div></td>
                <td style="font-size: 9px; width: 35%; border: none;"></td>
            </tr>
            <tr>
                <td style="font-size: 9px; width: 15%;padding: 0; text-align:left; vertical-align:middle; border: none;"></td>
                <td style="font-size: 7px; width: 20%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:top; border: none;"><div style="width: 100%;">подпись</div></td>
                <td style="font-size: 7px; width: 30%; padding-top:0; padding-bottom: 0; text-align:center; vertical-align:top; border: none;"><div style="width: 100%;">расшифровка подписи</div></td>
                <td style="font-size: 9px; width: 35%; border: none;"></td>
            </tr>
        </table>

        @if (!empty($companies->stamp) && $dz["indikator_sb"] != 0)
            <img src="{{ asset('public/img/'.$companies->stamp_1)}}" style="position: absolute; top:-30px; left: 10px; width: 230px">
        @endif
    </div>
</body>
@endif
</html>
