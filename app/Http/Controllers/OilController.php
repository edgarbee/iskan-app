<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\OilClient;
use App\Models\OilClientVoditel;

class OilController extends Controller
{
    public function index()
    {
        return view('oil.index');
    }

    public function oilRequest(Request $request) {
        $oil = $request->input('oil');
        $drivers =  $request->input('driver');

        $oilClient = new OilClient();
        $oilClient->seller = $oil['seller'];
        $oilClient->contragent_title = $oil['contragent_title'];
        $oilClient->contragent_tel = $oil['contragent_tel'];
        $oilClient->contragent_name = $oil['contragent_name'];
        $oilClient->client_summa = $oil['client_summa'];
        $oilClient->forma_oplati = $oil['forma_oplati'];
        $oilClient->client_summa_nds = $oil['client_summa_nds'];
        $oilClient->maks_skidka = $oil['maks_skidka'];
        $oilClient->client_skidka = $oil['client_skidka'];
        $oilClient->summa_zapravki = $oil['summa_zapravki'];
        $oilClient->summa_otpravki = $oil['summa_otpravki'];
        $oilClient->pribl = $oil['pribl'];
        $oilClient->save();

        foreach ($drivers as $driver) {
            $oilClientVoditel = new OilClientVoditel();
            $oilClientVoditel->name = $driver['name'];
            $oilClientVoditel->tel = $driver['tel'];
            $oilClientVoditel->vink = $driver['vink'];
            $oilClientVoditel->oil = $driver['oil'];
            $oilClientVoditel->limit = $driver['limit'];
            $oilClientVoditel->oil_client_id = $oilClient->id;
            $oilClientVoditel->save();
        }

        return redirect()->route('oil_index')->with('success', 'Заявка успешно отправлена.');
    }
}
