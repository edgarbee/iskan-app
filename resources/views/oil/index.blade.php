@extends('oil.layouts.app')
@section('title', 'Топливо')
@section('content')
    @push('styles')
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
    @include("oil.includes.header")
    <div class="container p-3  shadow rounded pt-3 pb-3 mt-4 mb-4">
        <form action="{{ route('oilRequest') }}" method="POST">
            @csrf
            <div class="row">
                @if (\Session::has('success'))
                    <div class="col-md-12 mt-2 mb-2">
                        <div class="alert alert-success">
                            {!! \Session::get('success') !!}
                        </div>
                    </div>
                @endif
                <div class="col-md-12 mt-2">
                    <div class="row">
                        <div class="col-md-12 mb-2" style="font-size: 12px; font-weight: 700">
                            <span style="color:#d0021b">*</span> Информация о контрагенте
                        </div>

                        <div class="col-md-3">
                            <div class="mb-1 form-floating">
                                <input type="text" class="form-control" name="oil[seller]" required placeholder="Контрагент">
                                <label>Продажник</label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-1 form-floating">
                                <input type="text" class="form-control" name="oil[contragent_title]" required placeholder="Контрагент">
                                <label>Контрагент</label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-1 form-floating">
                                <input type="tel" class="form-control tel" name="oil[contragent_tel]" required placeholder="Телефон контрагента">
                                <label>Телефон контрагента</label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-1 form-floating">
                                <input type="text" class="form-control" name="oil[contragent_name]" required placeholder="ФИО контрагента">
                                <label>ФИО контрагента</label>
                            </div>
                        </div>

                        <div class="col-md-12 mb-2 mt-2" style="font-size: 12px; font-weight: 700">
                            <span style="color:#d0021b">*</span> Сумма
                        </div>

                        <div class="col-md-3">
                            <div class="mb-1 form-floating">
                                <input type="number" min="0.1" step="0.1" class="form-control" name="oil[client_summa]" required placeholder="Сумма от клиента" id="client_summa">
                                <label>Сумма от клиента</label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-1 form-floating">
                                <select class="form-select" name="oil[forma_oplati]" required id="forma_oplati">
                                    <option value="" selected>Выберите форму оплаты</option>
                                    <option value="с ндс">с ндс</option>
                                    <option value="без ндс">без ндс</option>
                                    <option value="нал">нал</option>
                                </select>
                                <label>Форма оплаты</label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-1 form-floating">
                                <input type="number" min="0.1" step="0.1" class="form-control" name="oil[client_summa_nds]" required placeholder="Сумма от клиента с НДС" id="client_summa_nds">
                                <label>Сумма от клиента с НДС</label>
                            </div>
                        </div>

                        <div class="col-md-12 mb-2 mt-2" style="font-size: 12px; font-weight: 700">
                            <span style="color:#d0021b">*</span> Скидка
                        </div>

                        <div class="col-md-3">
                            <div class="mb-1 form-floating">
                                <input type="number" min="0.1" step="0.1" class="form-control" name="oil[maks_skidka]" readonly placeholder="Максимальная скидка" id="maks_skidka">
                                <label>Максимальная скидка</label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-1 form-floating">
                                <input type="number" min="0.1" step="0.1" class="form-control" name="oil[client_skidka]" required placeholder="Cкидка для клиента" id="client_skidka">
                                <label>Cкидка для клиента</label>
                            </div>
                        </div>

                        <div class="col-md-12 mb-2 mt-2" style="font-size: 12px; font-weight: 700">
                            <span style="color:#d0021b">*</span> Сумма к заправке и отправке
                        </div>

                        <div class="col-md-3">
                            <div class="mb-1 form-floating">
                                <input type="number" min="0.1" step="0.1" class="form-control" name="oil[summa_zapravki]" readonly placeholder="Сумма к заправке" id="summa_zapravki">
                                <label>Сумма к заправке</label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-1 form-floating">
                                <input type="number" min="0.1" step="0.1" class="form-control" name="oil[summa_otpravki]" readonly placeholder="Сумма к отправке" id="summa_otpravki">
                                <label>Сумма к отправке</label>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-1 form-floating">
                                <input type="number" min="0.1" step="0.1" class="form-control" name="oil[pribl]" readonly placeholder="Прибль" id="pribl">
                                <label>Прибль</label>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="drivers">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 mb-2 mt-2" style="font-size: 12px; font-weight: 700">
                                    <span style="color:#d0021b">*</span> Водитель №1
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-1 form-floating">
                                        <input type="text" class="form-control" name="driver[0][name]" required placeholder="ФИО водителя">
                                        <label>ФИО водителя</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-1 form-floating">
                                        <input type="tel" class="form-control tel" name="driver[0][tel]" required placeholder="Телефон водителя">
                                        <label>Телефон водителя</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-1 form-floating">
                                        <select class="form-select vink" name="driver[0][vink]" required>
                                            <option value="" selected>Выберите ВИНК</option>
                                            <option value="Лукойл">Лукойл</option>
                                            <option value="Газпромнефть">Газпромнефть</option>
                                            <option value="Роснефть">Роснефть</option>
                                        </select>
                                        <label>ВИНК</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <select class="form-select oil " name="driver[0][oil]" required>
                                        </select>
                                        <label>Топливо</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-1 form-floating">
                                        <input type="number" min="0.1" step="0.1" class="form-control" name="driver[0][limit]" required placeholder="Лимит">
                                        <label>Лимит</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2 mb-2">
                        <div class="col-md-3">
                        <button type="button" class="btn btn-success" id="addDrivers">Добавить водителя</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <input type="submit" class="btn btn-primary w-100 mt-2" id="btnSub" value="Отправить заявку" name="oilBtn">
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    @include("oil.includes.footer")

    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#client_summa, #forma_oplati, #client_skidka').bind('keyup change blur', function(){
                var client_summa = $('#client_summa').val();
                var forma_oplati = $('#forma_oplati').val();

                if(forma_oplati == "с ндс" && client_summa > 0) {
                    $('#client_summa_nds').val(client_summa);
                    $('#maks_skidka').val(4);
                }
                if(forma_oplati == "без ндс" && client_summa > 0) {
                    $('#client_summa_nds').val((client_summa/0.94).toFixed(2));
                    $('#maks_skidka').val(11);
                }
                if(forma_oplati == "нал" && client_summa > 0) {
                    $('#client_summa_nds').val((client_summa/0.89).toFixed(2));
                    $('#maks_skidka').val(15);
                }

                if($('#client_skidka').val()>0){
                    $('#summa_zapravki').val((client_summa*(1+($('#client_skidka').val()/100))).toFixed(2));
                }

                if($('#summa_zapravki').val()>0){
                    $('#summa_otpravki').val(($('#summa_zapravki').val()/1.06).toFixed(2));
                }

                if($('#client_summa_nds').val()>0 && $('#summa_otpravki').val()>0){
                    $('#pribl').val((($('#client_summa_nds').val()-($('#client_summa_nds').val()/100)-$('#summa_otpravki').val())/100*85).toFixed(2));
                }
            })
        });
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click','.vink', function(){
                var vink = $(this).val();

                if(vink == 'Лукойл'){
                    var oil = $(this).parent().parent().parent().find('.oil');
                    oil.find('option').remove();
                    oil.append('<option value="Дизельное топливо налив">Дизельное топливо налив</option><option value="Низкооктановое топливо (&lt;92) налив">Низкооктановое топливо (&lt;92) налив</option><option value="А/АИ-92 налив">А/АИ-92 налив</option><option value="А/АИ-98 налив/АИ-100 налив">А/АИ-98 налив/АИ-100 налив</option><option value="Прочее топливо налив">Прочее топливо налив</option><option value="Прочие нефтепродукты налив">Прочие нефтепродукты налив</option><option value="А/АИ-95 налив">А/АИ-95 налив</option><option value="Газ (любой) налив">Газ (любой) налив</option>');
                }

                if(vink == 'Газпромнефть'){
                    var oil = $(this).parent().parent().parent().find('.oil');
                    oil.find('option').remove();
                    oil.append('<option value="АИ-100">АИ-100</option><option value="Аи-80">Аи-80</option><option value="Аи-92(Аи-92 + Аи-92 ОПТИ)">Аи-92(Аи-92 + Аи-92 ОПТИ)</option><option value="Аи-92 Премиум">Аи-92 Премиум</option><option value="Аи-95(Аи-95 + Аи-95 ОПТИ)">Аи-95(Аи-95 + Аи-95 ОПТИ)</option><option value="Аи-95 Премиум">Аи-95 Премиум</option><option value="Аи-98">Аи-98</option><option value="Аи-98 Премиум">Аи-98 Премиум</option><option value="ДТ(ДТ + ДТ ОПТИ + ДТ Зимнее)">ДТ(ДТ + ДТ ОПТИ + ДТ Зимнее)</option><option value="ДТ Премиум">ДТ Премиум</option><option value="Газ">Газ</option>');
                }

                if(vink == 'Роснефть'){
                    var oil = $(this).parent().parent().parent().find('.oil');
                    oil.find('option').remove();
                    oil.append('<option value="Топливо ВСЕ">Топливо ВСЕ</option><option value="АИ-100">АИ-100</option><option value="АИ-100-Фирм">АИ-100-Фирм</option><option value="Все виды АИ-100">Все виды АИ-100</option><option value="АИ-98">АИ-98</option><option value="АИ-98-Фирм">АИ-98-Фирм</option><option value="Все виды АИ-98">Все виды АИ-98</option><option value="АИ-95">АИ-95</option><option value="АИ-95-Фирм">АИ-95-Фирм</option><option value="Все виды АИ-95">Все виды АИ-95</option><option value="АИ-92">АИ-92</option><option value="АИ-92-Фирм">АИ-92-Фирм</option><option value="Все виды АИ-92">Все виды АИ-92</option><option value="ДТ">ДТ</option><option value="ДТ-Зим">ДТ-Зим</option><option value="ДТ-Фирм">ДТ-Фирм</option><option value="ДТ-Аркт">ДТ-Аркт</option><option value="ДТ-Меж">ДТ-Меж</option><option value="Все виды ДТ">Все виды ДТ</option><option value="Газ">Газ</option>');
                }
            })
        });
    </script>

    <script>
        $(document).ready(function() {
            var $i=1;
            $('#addDrivers').on('click', function(){
                $('#drivers').append('<div class="col-md-12"> <div class="row"><div class="col-md-12 mb-2 mt-2" style="font-size: 12px; font-weight: 700"> <span style="color:#d0021b">*</span> Водитель '+($i+1)+' </div> <div class="col-md-3"> <div class="mb-1 form-floating"> <input type="text" class="form-control" name="driver['+$i+'][name]" required placeholder="ФИО водителя"> <label>ФИО водителя</label> </div> </div> <div class="col-md-3"> <div class="mb-1 form-floating"> <input type="tel" class="form-control tel" name="driver['+$i+'][tel]" required placeholder="Телефон водителя"> <label>Телефон водителя</label> </div> </div> <div class="col-md-3"> <div class="mb-1 form-floating"> <select class="form-select vink" name="driver['+$i+'][vink]" required> <option value="" selected>Выберите ВИНК</option> <option value="Лукойл">Лукойл</option> <option value="Газпромнефть">Газпромнефть</option> <option value="Роснефть">Роснефть</option> </select> <label>ВИНК</label> </div> </div> <div class="col-md-3"> <div class="form-floating"> <select class="form-select oil " name="driver['+$i+'][oil]" required> </select> <label>Топливо</label> </div> </div> <div class="col-md-3"> <div class="mb-1 form-floating"> <input type="number" min="0.1" step="0.1" class="form-control" name="driver['+$i+'][limit]" required placeholder="Лимит"> <label>Лимит</label> </div> </div></div> </div>');
                $i++;
            })
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
        $(document).on('click','.tel', function(){
            $('.tel').inputmask('+7 (999) 999 9999');
        });
    </script>
    @endpush
@endsection
