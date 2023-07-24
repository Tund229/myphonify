<?php

namespace App\Http\Livewire;

use DateTime;
use App\Models\Number;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class MyNumber extends Component
{
    protected $listeners = ['actualiser' => 'refreshAll'];

    public function render()
    {
        
        Auth::user()->restoreState();
        $numbers = Auth::user()->numbers()->orderBy('created_at', 'desc')->get();
        return view('livewire.my-number', compact('numbers'));
    }


    public function actualiser(Number $nbr)
    {
        // if ($nbr->api_name == 'OnlineSim') {
        //     $operation = Http::get(
        //         'https://onlinesim.io/api/getState.php?apikey=G35FFApry182XSY-9stXta5D-m3FHEMna-FhPs7165-rxnrKQXAejs18j2&tzid=' . $nbr->tzip
        //     );
        //     $rep = $operation->json();
        //     if (in_array($rep[0]['response'], array("ACCOUNT_IDENTIFICATION_REQUIRED", "ERROR_NO_OPERATIONS", "ERROR_NO_TZID", "TZ_OVER_OK", "TZ_OVER_EMPTY",))) {
        //         $nbr->transaction->update(['state' => "echoué"]);
        //         $nbr->update(['state' => "echoué"]);
        //         Auth::user()->calcAmount();
        //     }

        //     if ($rep[0]['response'] =="TZ_NUM_ANSWER" && isset($rep[0]['msg'])) {
        //         $nbr->update(['message' => $rep[0]['msg']]);
        //         $nbr->update(['state' => "validé"]);
        //         $nbr->transaction->update(['state' => "validé"]);
        //         Auth::user()->calcAmount();
        //     }
        // }

        // if ($nbr->api_name == 'Smspva') {
        //     if ($nbr->service == 'whatsapp') {
        //         $service = 'opt20';
        //     } elseif ($nbr->service == 'telegram') {
        //         $service = 'opt29';
        //     } elseif ($nbr->service == 'facebook') {
        //         $service = 'opt2';
        //     } elseif ($nbr->service == 'gmail') {
        //         $service = 'opt1';
        //     } elseif ($nbr->service == 'TikTok') {
        //         $service = 'opt104';
        //     } elseif ($nbr->service == 'Signal') {
        //         $service = 'opt127';
        //     } elseif ($nbr->service == 'Viber') {
        //         $service = 'opt11';
        //     }
        //     $operation = Http::get(
        //         'https://smspva.com/priemnik.php?metod=get_sms&country='.$nbr->pays->country_iso.'&service='.$service.'&id='.$nbr->tzip.'&apikey=v1rNIwTzstolXukLAdUSJlbIxqvMQL'
        //     );
        //     $rep = $operation->json();

        //     if ($rep) {
        //         if ($rep['id'] = $nbr->tzip && $rep['text'] != null && $rep['sms'] != null) {
        //             $nbr->update(['message' => $rep['sms']]);
        //             $nbr->update(['state' => "validé"]);
        //             $nbr->transaction->update(['state' => "validé"]);
        //             Auth::user()->calcAmount();
        //             return redirect()->back();
        //         } else {
        //             $num = DB::table('numbers')->where('user_id', '=', Auth::user()->id)->latest('created_at')->first();
        //             $created_at = Carbon::parse($num->created_at);
        //             $time = $created_at->format('H:i:s');
        //             $date = new DateTime();
        //             $is_Expired = $date->format('H:i:s');
        //             $diff_in_minutes = $created_at->diffInMinutes($is_Expired);

        //             if ($diff_in_minutes >= 10) {
        //                 $nbr->transaction->update(['state' => "echoué"]);
        //                 $nbr->update(['state' => "echoué"]);
        //                 Auth::user()->calcAmount();
        //             }
        //         }
        //     } else {
        //         $nbr->transaction->update(['state' => "echoué"]);
        //         $nbr->update(['state' => "echoué"]);
        //         Auth::user()->calcAmount();
        //     }
        // }


        // if ($nbr->api_name == 'Autofication') {
        //     $operation = Http::get(
        //         'https://autofications.com/V2/API.php?action=read&username=bplayez&key=b6d8fe18e9cdcc285a6d&website='.$nbr->tzip.'&country='.$nbr->pays->country_iso.'&phone_number='.$nbr->phone
        //     );
        //     if (isset($operation)) {
        //         if (in_array($operation, array("Balance_error", "Request_limited", "Website_error", "Number_error", "Number_zero",))) {
        //             $nbr->transaction->update(['state' => "echoué"]);
        //             $nbr->update(['state' => "echoué"]);
        //             Auth::user()->calcAmount();
        //         } elseif ($operation  != "Not_received") {
        //             $nbr->update(['message' => $operation]);
        //             $nbr->update(['state' => "validé"]);
        //             $nbr->transaction->update(['state' => "validé"]);
        //             Auth::user()->calcAmount();
        //             return redirect()->back();
        //         }
        //         if ($operation == "Not_received") {
        //             $num = DB::table('numbers')->where('user_id', '=', Auth::user()->id)->latest('created_at')->first();
        //             $created_at = Carbon::parse($num->created_at);
        //             $time = $created_at->format('H:i:s');
        //             $date = new DateTime();
        //             $is_Expired = $date->format('H:i:s');
        //             $diff_in_minutes = $created_at->diffInMinutes($is_Expired);

        //             if ($diff_in_minutes >= 10) {
        //                 $nbr->transaction->update(['state' => "echoué"]);
        //                 $nbr->update(['state' => "echoué"]);
        //                 Auth::user()->calcAmount();
        //             }
        //         }
        //     }
        // }


        // if ($nbr->api_name == '5sim') {
        //     $token = 'eyJhbGciOiJSUzUxMiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE3MTA3MDMxODEsImlhdCI6MTY3OTE2NzE4MSwicmF5IjoiMTFkZDUxYmZjMjUyYzBkNjUzYWJkNjhiZmNkNTEwY2IiLCJzdWIiOjEzMzcyODJ9.QbC2s8QmJIHKfcEHjd9sxsxYOoGm8pQzcpvGVREGH5caOscJIlncQe_oKAgBhWdX3PR-DsGLCZ8lQlh7OeC-LfvzOSN8y8zcRIf2m7xsJioANnC8lH35iRehh-ocQ76VEA0yUvUWGBzSyW-LhgaY4uRHH_OrScNHHXgSaXV0XdFO_WB-sNzPqV7BQQyGkyi8vGhWw19-TWIY0e8AVsOLKrd2UX0sJM2mXkRo_heWYMAzTJRffcjGfzk0vkSwls121-AZ9nYLfFv5LkGWkwE-2t0di7BFlp4CeEVGCUZbHcSDkLOL3jjDI4Q8Xu3hBQv-PBCx293Gk-GN-4cRjLaHHg';
        //     $operation = Http::withHeaders([
        //         "Authorization" => "Bearer " . $token,
        //         "Accept" => "application/json",
        //     ])->get('https://5sim.net/v1/user/check/'.$nbr->tzip);
        //     $rep = $operation->json();
        //     if ($rep !=null) {
        //         if ($rep['sms']!=null &&  $rep['status'] == "RECEIVED") {
        //             $nbr->update(['message' => $rep['sms'][0]['code']]);
        //             $nbr->update(['state' => "validé"]);
        //             $nbr->transaction->update(['state' => "validé"]);
        //             Auth::user()->calcAmount();
        //             return redirect()->back();
        //         } else {
        //             $num = DB::table('numbers')->where('user_id', '=', Auth::user()->id)->latest('created_at')->first();
        //             $created_at = Carbon::parse($num->created_at);
        //             $time = $created_at->format('H:i:s');
        //             $date = new DateTime();
        //             $is_Expired = $date->format('H:i:s');
        //             $diff_in_minutes = $created_at->diffInMinutes($is_Expired);

        //             if ($diff_in_minutes >= 10) {
        //                 $nbr->transaction->update(['state' => "echoué"]);
        //                 $nbr->update(['state' => "echoué"]);
        //                 Auth::user()->calcAmount();
        //             }
        //         }
        //     } else {
        //         $nbr->transaction->update(['state' => "echoué"]);
        //         $nbr->update(['state' => "echoué"]);
        //         Auth::user()->calcAmount();
        //     }





        //     // $operation = Http::get(
        //     //     'https://autofications.com/V2/API.php?action=read&username=bplayez&key=b6d8fe18e9cdcc285a6d&website='.$nbr->tzip.'&country='.$nbr->pays->country_iso.'&phone_number='.$nbr->phone
        //     // );
        //     // if (isset($operation)) {
        //     //     if (in_array($operation, array("Balance_error", "Request_limited", "Website_error", "Number_error", "Number_zero",))) {
        //     //         $nbr->transaction->update(['state' => "echoué"]);
        //     //         $nbr->update(['state' => "echoué"]);
        //     //         Auth::user()->calcAmount();
        //     //     } elseif ($operation  != "Not_received") {
        //     //         $nbr->update(['message' => $operation]);
        //     //         $nbr->update(['state' => "validé"]);
        //     //         $nbr->transaction->update(['state' => "validé"]);
        //     //         Auth::user()->calcAmount();
        //     //         return redirect()->back();
        //     //     }
        //     //     if ($operation == "Not_received") {
        //     // $num = DB::table('numbers')->where('user_id', '=', Auth::user()->id)->latest('created_at')->first();
        //     // $created_at = Carbon::parse($num->created_at);
        //     // $time = $created_at->format('H:i:s');
        //     // $date = new DateTime();
        //     // $is_Expired = $date->format('H:i:s');
        //     // $diff_in_minutes = $created_at->diffInMinutes($is_Expired);

        //     // if ($diff_in_minutes >= 10) {
        //     //     $nbr->transaction->update(['state' => "echoué"]);
        //     //     $nbr->update(['state' => "echoué"]);
        //     //     Auth::user()->calcAmount();
        //     // }
        //     //     }
        //     // }
        // }
    }

    public function refreshAll()
    { 
        Auth::user()->restoreState();
        $date = new DateTime();
        $date->modify('-10 minutes');
        $formatted_date = $date->format('Y-m-d H:i:s');
        $numbers = Auth::user()->numbers()->where('created_at', '>=', $formatted_date)->where('state', 'en cours')->get();
        if ($numbers) {
            foreach ($numbers as $number) {
                $this->actualiser($number);
            }
        }
    }
}
