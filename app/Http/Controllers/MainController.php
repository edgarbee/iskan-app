<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Clients;
use App\Models\Zagruzka;
use App\Models\Vigruzka;

class MainController extends Controller
{
    public function createDz() {

        $companies = DB::table('company')->get();
        $partner_companies = DB::table('partners_company')->get();
        $clients = Clients::where('likvidnost', '=', 1)->get();

        return view('dz.dz', compact('companies', 'partner_companies', 'clients'));
    }

    public function searchClient(Request $request) {
        $client_name = $request->input('client_name');
        $results = Clients::where('client_name', 'LIKE', '%'.$client_name.'%')->where('otdel', '=', Auth::user()->otdel)->get();

        if ($results) {
            $output = '<div class="search_result"><table>';
            foreach ($results as $result) {
                $dop_zagruzka = Zagruzka::where('client_id', $result->id)->select('dop_address_zagruzki_contact')->get()->toArray();
                $dop_vigruzka = Vigruzka::where('client_id', $result->id)->get()->toArray();

                $dz = [];
                array_push($dz, $result->address_zagruzki_contact);
                foreach($dop_zagruzka as $dop_zagruzk) {
                    array_push($dz, $dop_zagruzk["dop_address_zagruzki_contact"]);
                }

                $dz = json_encode(implode(" | ", $dz), JSON_UNESCAPED_UNICODE);

                $dv = [];
                array_push($dv, $result->address_vigruzki_contact);
                foreach($dop_vigruzka as $dop_vigruzk) {
                    array_push($dv, $dop_vigruzk["dop_address_zagruzki_contact"]);
                }

                $dv = json_encode(implode(" | ", $dv), JSON_UNESCAPED_UNICODE);

                $output .= '
                <tr>
                    <td class="search_result-name">
                        <a href="#" class="client_name">'.$result->client_name.'</a>
                        <span class="gruz" style="display: none;">'.$result->gruz.'</span>
                        <span class="address_zagruzki_contact" style="display: none;">'.$dz.'</span>
                        <span class="address_vigruzki_contact" style="display: none;">'.$dv.'</span>
                        <span class="document" style="display: none;">'.$result->document.'</span>
                        <span class="dop_uslovia" style="display: none;">'.$result->dop_uslovia.'</span>
                        <span class="rent" style="display: none;">'.$result->rent.'</span>
                    </td>
                </tr>
                ';
            }
            $output .= '</table></div>';
        }

        return $output;
    }

    public function searchPerevozchik(Request $request) {
        $perevozchik_name = $request->input('perevozchik_name');
        $results = DB::table('perevozchiki')
        ->select('perevozchik_name', 'data_proverki', 'code_ATI',
        DB::raw("GROUP_CONCAT(perevozchik_ts SEPARATOR '| ') as 'perevozchik_ts'"), 
        DB::raw("GROUP_CONCAT(perevozchik_voditel SEPARATOR '| ') as 'perevozchik_voditel'"),
        DB::raw("GROUP_CONCAT(perevozchik_tel SEPARATOR '| ') as 'perevozchik_tel'"))
        ->groupBy('perevozchik_name')
        ->where('perevozchik_name', 'LIKE', '%'.$perevozchik_name.'%')
        ->get();

        if ($results) {
            $output = '<div class="search_result"><table>';
            foreach ($results as $result) {
                $result->perevozchik_ts = explode("| ", $result->perevozchik_ts);
                $result->perevozchik_voditel = explode("| ", $result->perevozchik_voditel);
                $result->perevozchik_tel = explode("| ", $result->perevozchik_tel);

                if(empty($result->code_ATI)) {
                    $result->code_ATI = "Нет ATI";
                }

                $output .= '
                <tr>
                    <td class="search_result-name">
                        <a href="#" class="perevozchik_name">'.$result->perevozchik_name.'</a> <span>(ATI - '.$result->code_ATI.')</span>
                        <span class="perevozchik_tel" style="display: none;">'.json_encode($result->perevozchik_tel, JSON_UNESCAPED_UNICODE).'</span>
                        <span class="perevozchik_ts" style="display: none;">'.json_encode($result->perevozchik_ts, JSON_UNESCAPED_UNICODE).'</span>
                        <span class="perevozchik_voditel" style="display: none;">'.json_encode($result->perevozchik_voditel, JSON_UNESCAPED_UNICODE).'</span>
                        <span class="data_proverki" style="display: none;">'.$result->data_proverki.'</span>
                    </td>
                </tr>
                ';
            }
            $output .= '</table></div>';
        }

        return $output;
    }

    public function searchCompany(Request $request) {
        $company_name = $request->input('company_name');
        $results = DB::table('company')->where('company_name', 'LIKE', '%'.$company_name.'%')->get();

        if ($results) {
            $output = '';
            foreach ($results as $result) {
                if ($result->c_nds == 1) {
                    $output .= '<option value="C НДС">C НДС</option>';
                }
                if ($result->bez_nds == 1) {
                    $output .= '<option value="Без НДС">Без НДС</option>';
                }
                if ($result->na_carty == 1) {
                    $output .= '<option value="На карту">На карту</option>';
                }
            }
        }

        return $output;
    }

    public function addPerevozchik(Request $request) {
        $perevozchik = $request->input('p');

        DB::table('perevozchiki')->insert([
            'code_ATI' => $perevozchik["code_ATI"], 
            'perevozchik_name' => $perevozchik["perevozchik_name"],
            'perevozchik_tel' => $perevozchik["perevozchik_tel"],
            'perevozchik_email' => $perevozchik["perevozchik_email"],
            'type_transport' => $perevozchik["type_transport"],
            'perevozchik_ts' => $perevozchik["perevozchik_ts"],
            'perevozchik_voditel' => $perevozchik["perevozchik_voditel"],
            'pasport_voditel' => $perevozchik["pasport_voditel"],
            'home_region' => $perevozchik["home_region"],
            'name_director' => $perevozchik["name_director"],
            'karta_sber' => $perevozchik["karta_sber"],
            'contacts' => $perevozchik["contacts"],
            'data_proverki' => '',
            'logist' => Auth::user()->name, 
            'vod_pas' => $perevozchik["perevozchik_voditel"].', '.$perevozchik["perevozchik_voditel_tel"].', '.$perevozchik["pasport_voditel"]
        ]);
    }

    /**
     * Log out account user.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Session::flush();
        
        Auth::logout();

        return redirect('login');
    }

}
