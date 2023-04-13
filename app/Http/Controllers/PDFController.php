<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Models\Carrier;
use App\Models\Clients;
use App\Models\History;

class PDFController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF(Request $request)
    {
        $dz = $request->input('dz');

        if ($dz["partner_name"] == "Не выбрано" ) {
            $companies = DB::table('company')->where('company_name', '=', $dz["company_name"])->first();
            $partner = 0;
        } else {
            $companies = DB::table('partners_company')->where('company_name', '=', $dz["partner_name"])->first();
            $partner = 1;
        }

        $carrier_company = Carrier::select('name_director', 'contacts')
            ->where('perevozchik_name', '=', str_replace(array("\r\n", "\r", "\n"), '', $dz["perevozchik_name"]))
            ->first();

        $voditel = Carrier::select('perevozchik_voditel','perevozchik_tel','pasport_voditel','vod_pas', 'name_director', 'code_ATI', 'perevozchik_email', 'contacts', 'karta_sber')
        ->where('perevozchik_voditel', '=', str_replace(array("\r\n", "\r", "\n"), '', $dz["perevozchik_voditel"]))
        ->first();

        $client = Clients::select('client_name','rekvizity','name_director_1', 'name_director_2')
        ->where('client_name', '=', str_replace(array("\r\n", "\r", "\n"), '', $dz["client_name"]))
        ->first();

        if (isset($dz)) {

            $data = [
                'dz' => $dz,
                'companies' => $companies,
                'carrier_company' => $carrier_company,
                'voditel' => $voditel,
                'partner' => $partner,
                'type_doc' => $request->input('type_doc'),
                'client' => $client,
            ];

            $history = new History();
            $history->title = $dz["nomer"];
            $history->dz_id = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
            $history->logist_id = \Auth::user()->id;
            $history->data = json_encode($request->all(), JSON_UNESCAPED_UNICODE);
            $history->save();

            $pdf = PDF::loadView('dz.pdf', $data);

            if ($partner == 0 && $request->input('type_doc') != "СОЗДАТЬ ДОВЕРЕННОСТЬ") {
                return $pdf->download('Dogovor_zayavka_№'.$dz["nomer"].'_ot_'.\Carbon\Carbon::parse($dz["date"])->format('d/m/Y').'.pdf');
            } elseif($partner == 1 && $request->input('type_doc') != "СОЗДАТЬ ДОВЕРЕННОСТЬ") {
                return $pdf->download('Dogovor_zayavka_ot_'.\Carbon\Carbon::parse($dz["date"])->format('d/m/Y').'.pdf');
            } elseif($partner == 0 && $request->input('type_doc') == "СОЗДАТЬ ДОВЕРЕННОСТЬ") {
                return $pdf->download('Doverennost_№'.$dz["nomer"].'_ot_'.\Carbon\Carbon::parse($dz["date"])->format('d/m/Y').'.pdf');
            } elseif($partner == 1 && $request->input('type_doc') == "СОЗДАТЬ ДОВЕРЕННОСТЬ") {
                return $pdf->download('Doverennost_ot_'.\Carbon\Carbon::parse($dz["date"])->format('d/m/Y').'.pdf');
            }

        }
    }


    public function generatePDFSB(Request $request)
    {
        $sb = $request->input('sb');

        if($request->input('sb_status') != 2) {
            $date = date('d.m.Y');
        } else {
            $date = '';
        }

        $perevozchik = Carrier::find($request->input('id'));
        $perevozchik->data_proverki = $date;
        $perevozchik->sb_blank = $sb;
        $perevozchik->sb_status = $request->input('sb_status');
        $perevozchik->sb_id = \Auth::user()->id;
        $perevozchik->save();


        if (isset($sb)) {
            $data = [
                'sb' => $sb,
                'sb_status' => $request->input('sb_status'),
            ];

            $pdf = PDF::loadView('sb.pdf', $data);

            return $pdf->download('Proverka_SB_№'.$sb["nomer"].'_ot_'.\Carbon\Carbon::parse($sb["date"])->format('d/m/Y').'.pdf');
        }

        // dd($sb);
    }
}
