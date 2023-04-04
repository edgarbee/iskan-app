<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrier;
use App\Models\Clients;
use App\Models\Company;
use App\Models\Zagruzka;
use App\Models\Vigruzka;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index() {
        return view('admin.admin');
    }

    public function clients() {

        $clients = Clients::orderBy('id', 'DESC')->get();

        return view('admin.clients.index', compact('clients'));
    }

    public function clientsShow($id) {
        $client = Clients::where('id', '=', $id)->first();

        return view('admin.clients.show', compact('client'));
    }

    public function clientsEdit(Request $request) {

        $client = Clients::find($request->input('id'));
        $client->client_name = $request->input('client_name');
        $client->gruz = $request->input('gruz');
        $client->address_zagruzki_contact = $request->input('address_zagruzki_contact');
        $client->address_vigruzki_contact = $request->input('address_vigruzki_contact');
        $client->document = $request->input('document');
        $client->dop_uslovia = $request->input('dop_uslovia');
        $client->name_director_1 = $request->input('name_director_1');
        $client->name_director_2 = $request->input('name_director_2');
        $client->rekvizity = $request->input('rekvizity');
        $client->likvidnost = $request->input('likvidnost');
        $client->rent = $request->input('rent');
        $client->otdel = $request->input('otdel');
        $client->save();

        return redirect()->route('clients_index')->with('success', 'Данные клиента обновлены.');
    }

    public function clientsAdd(Request $request) {

        $client = new Clients();
        $client->client_name = $request->input('client_name');
        $client->gruz = $request->input('gruz');
        $client->address_zagruzki_contact = $request->input('address_zagruzki_contact');
        $client->address_vigruzki_contact = $request->input('address_vigruzki_contact');
        $client->document = $request->input('document');
        $client->dop_uslovia = $request->input('dop_uslovia');
        $client->name_director_1 = $request->input('name_director_1');
        $client->name_director_2 = $request->input('name_director_2');
        $client->rekvizity = $request->input('rekvizity');
        $client->likvidnost = $request->input('likvidnost');
        $client->rent = $request->input('rent');
        $client->otdel = $request->input('otdel');
        $client->save();

        return redirect()->route('clients_index')->with('success', 'Клиент успешно добавлен.');
    }

    public function clientsDelete(Request $request) {

        $client = Clients::find($request->input('id'));
        $client->delete();

        return redirect()->route('clients_index')->with('success', 'Данные клиента удалены.');
    }

    public function dopZagruzka(Request $request) {

        if($request->input('action') == 'Изменить') {
            $dopZagruzka = Zagruzka::find($request->input('dop_zagruzka_id'));
            $dopZagruzka->dop_address_zagruzki_contact = $request->input('dop_address_zagruzki_contact');
            $dopZagruzka->save();
        } elseif ($request->input('action') == 'Добавить') {
            $dopZagruzka = new Zagruzka();
            $dopZagruzka->client_id = $request->input('client_id');
            $dopZagruzka->dop_address_zagruzki_contact = $request->input('dop_address_zagruzki_contact');
            $dopZagruzka->save();
        }         
        else {
            $dopZagruzka = Zagruzka::find($request->input('dop_zagruzka_id'));
            $dopZagruzka->delete();
        }
    }

    public function dopVigruzka(Request $request) {

        if($request->input('action') == 'Изменить') {
            $dopZagruzka = Vigruzka::find($request->input('dop_zagruzka_id'));
            $dopZagruzka->dop_address_zagruzki_contact = $request->input('dop_address_zagruzki_contact');
            $dopZagruzka->save();
        } elseif ($request->input('action') == 'Добавить') {
            $dopZagruzka = new Vigruzka();
            $dopZagruzka->client_id = $request->input('client_id');
            $dopZagruzka->dop_address_zagruzki_contact = $request->input('dop_address_zagruzki_contact');
            $dopZagruzka->save();
        }         
        else {
            $dopZagruzka = Vigruzka::find($request->input('dop_zagruzka_id'));
            $dopZagruzka->delete();
        }
    }

    public function perevozchik() {

        $perevozchiki = Carrier::orderBy('id', 'DESC')->get();

        return view('admin.perevozchik.index', compact('perevozchiki'));
    }

    public function perevozchikShow($id) {
        $perevozchik = Carrier::where('id', '=', $id)->first();

        return view('admin.perevozchik.show', compact('perevozchik'));
    }

    public function perevozchikEdit(Request $request) {

        $perevozchik = Carrier::find($request->input('id'));
        $perevozchik->code_ATI = $request->input('code_ATI');
        $perevozchik->perevozchik_name = $request->input('perevozchik_name');
        $perevozchik->perevozchik_tel = $request->input('perevozchik_tel');
        $perevozchik->perevozchik_email = $request->input('perevozchik_email');
        $perevozchik->type_transport = $request->input('type_transport');
        $perevozchik->perevozchik_ts = $request->input('perevozchik_ts');
        $perevozchik->perevozchik_voditel = $request->input('perevozchik_voditel');
        $perevozchik->pasport_voditel = $request->input('pasport_voditel');
        $perevozchik->home_region = $request->input('home_region');
        $perevozchik->name_director = $request->input('name_director');
        $perevozchik->karta_sber = $request->input('karta_sber');
        $perevozchik->contacts = $request->input('contacts');
        $perevozchik->data_proverki = '';
        $perevozchik->logist = Auth::user()->name;
        $perevozchik->vod_pas = $request->input('perevozchik_voditel').', '.$request->input('pasport_voditel');
        $perevozchik->save();

        return redirect()->route('perevozchik_index')->with('success', 'Данные перевозчика обновлены.');
    }

    public function perevozchikAdd(Request $request) {

        $perevozchik = new Carrier();
        $perevozchik->code_ATI = $request->input('code_ATI');
        $perevozchik->perevozchik_name = $request->input('perevozchik_name');
        $perevozchik->perevozchik_tel = $request->input('perevozchik_tel');
        $perevozchik->perevozchik_email = $request->input('perevozchik_email');
        $perevozchik->type_transport = $request->input('type_transport');
        $perevozchik->perevozchik_ts = $request->input('perevozchik_ts');
        $perevozchik->perevozchik_voditel = $request->input('perevozchik_voditel');
        $perevozchik->pasport_voditel = $request->input('pasport_voditel');
        $perevozchik->home_region = $request->input('home_region');
        $perevozchik->name_director = $request->input('name_director');
        $perevozchik->karta_sber = $request->input('karta_sber');
        $perevozchik->contacts = $request->input('contacts');
        $perevozchik->data_proverki = '';
        $perevozchik->logist = Auth::user()->name;
        $perevozchik->vod_pas = $request->input('perevozchik_voditel').', '.$request->input('pasport_voditel');
        $perevozchik->save();

        return redirect()->route('perevozchik_index')->with('success', 'Перевозчик успешно добавлен.');
    }

    public function perevozchikDelete(Request $request) {

        $perevozchik = Carrier::find($request->input('id'));
        $perevozchik->delete();

        return redirect()->route('perevozchik_index')->with('success', 'Данные перевозчика удалены.');
    }


    public function company() {

        $companies = Company::orderBy('id', 'DESC')->get();

        return view('admin.company.index', compact('companies'));
    }

    public function companyShow($id) {
        $company = Company::where('id', '=', $id)->first();

        return view('admin.company.show', compact('company'));
    }

    public function companyEdit(Request $request) {

        $company = Company::find($request->input('id'));
        $company->company_name = $request->input('company_name');
        $company->name_director_1 = $request->input('name_director_1');
        $company->name_director_2 = $request->input('name_director_2');
        $company->rekvizity = $request->input('rekvizity');
        $company->inn = $request->input('inn');

        if(!empty($request->file('stamp'))) {
            $name_1 = $request->file('stamp')->getClientOriginalName();
            $path_1 = $request->file('stamp')->move(public_path('img'), $name_1);
            $company->stamp = $name_1;
        }

        if(!empty($request->file('stamp_1'))) {
            $name_2 = $request->file('stamp_1')->getClientOriginalName();
            $path_2 = $request->file('stamp_1')->move(public_path('img'), $name_2);
            $company->stamp_1 = $name_2;
        }

        $company->save();

        return redirect()->route('company_index')->with('success', 'Данные компании обновлены.');
    }

    public function companyAdd(Request $request) {

        $company = new Company();
        $company->company_name = $request->input('company_name');
        $company->name_director_1 = $request->input('name_director_1');
        $company->name_director_2 = $request->input('name_director_2');
        $company->rekvizity = $request->input('rekvizity');
        $company->inn = $request->input('inn');

        if(!empty($request->file('stamp'))) {
            $name_1 = $request->file('stamp')->getClientOriginalName();
            $path_1 = $request->file('stamp')->move(public_path('img'), $name_1);
            $company->stamp = $name_1;
        }

        if(!empty($request->file('stamp_1'))) {
            $name_2 = $request->file('stamp_1')->getClientOriginalName();
            $path_2 = $request->file('stamp_1')->move(public_path('img'), $name_2);
            $company->stamp_1 = $name_2;
        }
        $company->save();

        return redirect()->route('company_index')->with('success', 'Компания успешно добавлена.');
    }

    public function companyDelete(Request $request) {

        $company = Company::find($request->input('id'));
        $company->delete();

        return redirect()->route('company_index')->with('success', 'Данные компании удалены.');
    }

    public function users() {

        $users = User::orderBy('role', 'ASC')->get();

        return view('admin.users.index', compact('users'));
    }

    public function usersShow($id) {

        $user = User::where('id', '=', $id)->first();

        return view('admin.users.show', compact('user'));
    }

    public function usersEdit(Request $request) {

        $user = User::find($request->input('id'));
        $user->name = $request->input('name');
        $user->tel = $request->input('tel');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->otdel = $request->input('otdel');

        if(!empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('users_index')->with('success', 'Данные пользователя обновлены.');
    }

    public function usersAdd(Request $request) {

        $user = new User();
        $user->name = $request->input('name');
        $user->tel = $request->input('tel');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->otdel = $request->input('otdel');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect()->route('users_index')->with('success', 'Пользователь успешно добавлен.');
    }

    public function usersDelete(Request $request) {

        $user = User::find($request->input('id'));
        $user->delete();

        return redirect()->route('users_index')->with('success', 'Данные пользователя удалены.');
    }


    public function excelClients() {

        header("Content-Type: application/xls");    
        header("Content-Disposition: attachment; filename=Клиенты.xls");  
        header("Pragma: no-cache"); 
        header("Expires: 0");
        $output = '';

        $clients = Clients::all();

        $output = "<div style=\"font-family: Helvetica, Arial, sans-serif;\"><table cellpadding=\"3\" border=\"1\" cellspacing=\"0\" style=\"width:60%; border-color: #ddd;\">";
        $output .= "
        <tr style=\"font-size:13px;\">
        <td><div style=\"padding:5px; font-family: Helvetica, Arial, sans-serif; text-align:center\"><strong>№</strong></div></td>
        <td><div style=\"padding:5px; font-family: Helvetica, Arial, sans-serif; text-align:center\"><strong>ООО/ИП клиента</strong></div></td>
        <td><div style=\"padding:5px; font-family: Helvetica, Arial, sans-serif; text-align:center\"><strong>Груз</strong></div></td>
        <td><div style=\"font-family: Helvetica, Arial, sans-serif; padding:5px; text-align:center\"><strong>Адрес загрузки + контакт</strong></div></td>
        <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\"><strong>Адрес разгрузки + контакт</strong></div></td>
        <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\"><strong>Документы</strong></div></td>
        <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\"><strong>Доп. условия к ДЗ из основного договора</strong></div></td>
        <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\"><strong>ФИО директора в родительном падеже</strong></div></td>
        <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\"><strong>ФИО директора сокращенно</strong></div></td>
        <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\"><strong>Реквизиты</strong></div></td>
        <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\"><strong>Минимальная рентабельность</strong></div></td>
        <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\"><strong>Отдел</strong></div></td>
        </tr>
        ";
        $i=1;
        foreach($clients as $client) {
            $output .= "
            <tr style=\"font-size:13px;\">
            <td><div style=\"padding:5px; font-family: Helvetica, Arial, sans-serif; text-align:center\">".$i."</div></td>
            <td><div style=\"padding:5px; font-family: Helvetica, Arial, sans-serif; text-align:center\">".$client->client_name."</div></td>
            <td><div style=\"padding:5px; font-family: Helvetica, Arial, sans-serif; text-align:center\">".$client->gruz."</div></td>
            <td><div style=\"font-family: Helvetica, Arial, sans-serif; padding:5px; text-align:center\">".$client->address_zagruzki_contact."</div></td>
            <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\">".$client->address_vigruzki_contact."</div></td>
            <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\">".$client->document."</div></td>

            <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\">".$client->dop_uslovia."</div></td>
            <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\">".$client->name_director_1."</div></td>
            <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\">".$client->name_director_2."</div></td>
            <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\">".$client->rekvizity."</div></td>
            <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\">".$client->rent."%</div></td>
            <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\">".$client->otdel."</div></td>
            </tr>
            ";
            $i++;
        }

        $output .="</table></div>";

        echo $output;
        
    }

    public function excelPerevozchik() {

        header("Content-Type: application/xls");    
        header("Content-Disposition: attachment; filename=Перевозчики.xls");  
        header("Pragma: no-cache"); 
        header("Expires: 0");
        $output = '';

        $carriers = Carrier::all();

        $output = "<div style=\"font-family: Helvetica, Arial, sans-serif;\"><table cellpadding=\"3\" border=\"1\" cellspacing=\"0\" style=\"width:80%; border-color: #ddd;\">";
        $output .= "
        <tr style=\"font-size:13px;\">
        <td><div style=\"padding:5px; font-family: Helvetica, Arial, sans-serif; text-align:center\"><strong>№</strong></div></td>
        <td><div style=\"padding:5px; font-family: Helvetica, Arial, sans-serif; text-align:center\"><strong>Код АТИ</strong></div></td>
        <td><div style=\"padding:5px; font-family: Helvetica, Arial, sans-serif; text-align:center\"><strong>ООО/ИП перевозчика</strong></div></td>
        <td><div style=\"font-family: Helvetica, Arial, sans-serif; padding:5px; text-align:center\"><strong>Телефон диспетчера</strong></div></td>
        <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\"><strong>Почта диспетчера</strong></div></td>
        <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\"><strong>Тип транспорта</strong></div></td>
        <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\"><strong>Транспортное средство</strong></div></td>
        <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\"><strong>Водитель</strong></div></td>
        <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\"><strong>Паспорт водителя</strong></div></td>
        <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\"><strong>Домашний регион</strong></div></td>
        <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\"><strong>ФИО директора</strong></div></td>
        <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\"><strong>Карта сбербанка</strong></div></td>
        <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\"><strong>Реквизиты</strong></div></td>
        <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\"><strong>Водитель+паспорт</strong></div></td>
        </tr>
        ";
        $i=1;
        foreach($carriers as $carrier) {
            $output .= "
            <tr style=\"font-size:13px;\">
            <td><div style=\"padding:5px; font-family: Helvetica, Arial, sans-serif; text-align:center\">".$i."</div></td>
            <td><div style=\"padding:5px; font-family: Helvetica, Arial, sans-serif; text-align:center\">".$carrier->code_ATI."</div></td>
            <td><div style=\"padding:5px; font-family: Helvetica, Arial, sans-serif; text-align:center\">".$carrier->perevozchik_name."</div></td>
            <td><div style=\"font-family: Helvetica, Arial, sans-serif; padding:5px; text-align:center\">".$carrier->perevozchik_tel."</div></td>
            <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\">".$carrier->perevozchik_email."</div></td>
            <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\">".$carrier->type_transport."</div></td>
            <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\">".$carrier->perevozchik_ts."</div></td>
            <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\">".$carrier->perevozchik_voditel."</div></td>
            <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\">".$carrier->pasport_voditel."</div></td>
            <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\">".$carrier->home_region."</div></td>
            <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\">".$carrier->name_director."%</div></td>
            <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\">".$carrier->karta_sber."</div></td>
            <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\">".$carrier->contacts."</div></td>
            <td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\">".$carrier->vod_pas."</div></td>
            </tr>
            ";
            $i++;
        }

        $output .="</table></div>";

        echo $output;
        
    }

}
