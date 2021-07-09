<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MakeLinkController extends Controller
{
    public function index(Request $request)
    {
        $key = env('REBRANDLY_API_KEY');

        return $response = Http::post('https://api.rebrandly.com/v1/links', [
            'apikey' => $key,
            'Content-Type' => 'application/json',
            'destination' => $request->input('link'),
            'domain' => [ 'fullName' => 'rebrand.ly' ]
        ]);

//        OR PHP Curl
//
//        $curl = curl_init();
//
//        curl_setopt_array($curl, array(
//            CURLOPT_URL => 'https://api.rebrandly.com/v1/links',
//            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => '',
//            CURLOPT_MAXREDIRS => 10,
//            CURLOPT_TIMEOUT => 0,
//            CURLOPT_FOLLOWLOCATION => true,
//            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//            CURLOPT_CUSTOMREQUEST => 'POST',
//            CURLOPT_POSTFIELDS =>'{"destination": $request->input('link'), "domain": { "fullName": "rebrand.ly"}}',
//            CURLOPT_HTTPHEADER => array(
//                'Content-Type: application/json',
//                'apikey: $key'
//            ),
//        ));
//
//        $response = curl_exec($curl);
//
//        curl_close($curl);
//
//        return $response;
    }
}
