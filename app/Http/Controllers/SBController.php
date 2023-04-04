<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrier;
use App\Models\Company;
use App\Models\Clients;

use Illuminate\Support\Facades\Storage;

class SBController extends Controller
{
    public function index() {
        $perevozchiki = Carrier::where('data_proverki', '=', '')->get();

        return view('sb.sb', compact('perevozchiki'));
    }

    public function sb_perevozchik() {
        $perevozchiki = Carrier::all();

        return view('sb.perevozchik.index', compact('perevozchiki'));
    }

    public function my() {

        $perevozchiki = Carrier::where('sb_id', '=', \Auth::user()->id)->get();

        return view('sb.sb-my', compact('perevozchiki'));
    }

    public function cancel() {

        $perevozchiki = Carrier::where('sb_status', '=', 0)->get();

        return view('sb.sb-cancel', compact('perevozchiki'));
    }

    public function sbSearch($id) {
        $perevozchiki = Carrier::where('id', '=', $id)->first();
        $companies = Company::all();

        // $image = Storage::disk('private')->get("example.txt");

        // dd($image);

        return view('sb.sb-check', compact('perevozchiki', 'companies'));
    }

    public function searchClientSB(Request $request) {
        $client_name = $request->input('client_name');
        $results = Clients::where('client_name', 'LIKE', '%'.$client_name.'%')->get();

        if ($results) {
            $output = '<div class="search_result"><table>';
            foreach ($results as $result) {
                $output .= '
                <tr>
                    <td class="search_result-name">
                        <a href="#" class="client_name">'.$result->client_name.'</a>
                    </td>
                </tr>
                ';
            }
            $output .= '</table></div>';
        }

        return $output;
    }

}
