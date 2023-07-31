<?php

namespace App\Http\Livewire;

use DateTime;
use Carbon\Carbon;
use App\Models\Number;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class MyNumber extends Component
{
    protected $listeners = ['actualiser' => 'refreshAll'];

    public function render()
    {   
        Auth::user()->restoreState();
        $numbers = Auth::user()->numbers()->orderBy('created_at', 'desc')->get();
        $number_encours =  Auth::user()->numbers()->where('state', 'en cours')->count();
        return view('livewire.my-number', compact('numbers', 'number_encours'));
    }


    

    public function actualiser(Number $nbr)
    {
        

        
        if ($nbr->api_name == 'OnlineSim') {
            $operation = Http::get(
                'https://onlinesim.io/api/getState.php?apikey=a3HaYQM6mn666EZ-B2n56N6g-qKd3eN69-61TwhE35-be233apCFVZ883a&tzid=' . $nbr->tzip
            );
            $rep = $operation->json();
            if (in_array($rep[0]['response'], array("ACCOUNT_IDENTIFICATION_REQUIRED", "ERROR_NO_OPERATIONS", "ERROR_NO_TZID", "TZ_OVER_OK", "TZ_OVER_EMPTY",))) {
                $nbr->update(['state' => "echoué"]);
                Auth::user()->calcAmount();
            }

            if ($rep[0]['response'] =="TZ_NUM_ANSWER" && isset($rep[0]['msg'])) {
                $nbr->update(['message' => $rep[0]['msg']]);
                $nbr->update(['state' => "validé"]);
                Auth::user()->calcAmount();
            }
        }

        if ($nbr->api_name == 'Smspva') {
            if ($nbr->service == 'whatsapp') {
                $service = 'opt20';
            } elseif ($nbr->service == 'telegram') {
                $service = 'opt29';
            } elseif ($nbr->service == 'facebook') {
                $service = 'opt2';
            } elseif ($nbr->service == 'gmail') {
                $service = 'opt1';
            } elseif ($nbr->service == 'TikTok') {
                $service = 'opt104';
            } elseif ($nbr->service == 'Signal') {
                $service = 'opt127';
            } elseif ($nbr->service == 'Viber') {
                $service = 'opt11';
            }
            $operation = Http::get(
                'https://smspva.com/priemnik.php?metod=get_sms&country='.$nbr->pays->country_iso.'&service='.$service.'&id='.$nbr->tzip.'&apikey=L9zCBnR84GOadTQjVqjd3O6ntgqoKY'
            );
            $rep = $operation->json();
            if ($rep) {
                if ($rep['id'] = $nbr->tzip && $rep['text'] != null && $rep['sms'] != null) {
                    $nbr->update(['message' => $rep['sms']]);
                    $nbr->update(['state' => "validé"]);
                    Auth::user()->calcAmount();
                    return redirect()->back();
                } else {
                    $num = DB::table('numbers')->where('user_id', '=', Auth::user()->id)->latest('created_at')->first();
                    $created_at = Carbon::parse($num->created_at);
                    $time = $created_at->format('H:i:s');
                    $date = new DateTime();
                    $is_Expired = $date->format('H:i:s');
                    $diff_in_minutes = $created_at->diffInMinutes($is_Expired);
                    if ($diff_in_minutes >= 10) {
                        $nbr->update(['state' => "echoué"]);
                        Auth::user()->calcAmount();
                    }
                }
            } else {
                $nbr->update(['state' => "echoué"]);
                Auth::user()->calcAmount();
            }
        }


        if ($nbr->api_name == 'Autofication') {
            $operation = Http::get(
                'https://autofications.com/V2/API.php?action=read&username=GhostBoy&key=7576021e3d333d8bd8a8&website='.$nbr->tzip.'&country='.$nbr->pays->country_iso.'&phone_number='.$nbr->phone
            );
            if (isset($operation)) {
                if (in_array($operation, array("Balance_error", "Request_limited", "Website_error", "Number_error", "Number_zero",))) {
                    $nbr->update(['state' => "echoué"]);
                    Auth::user()->calcAmount();
                } elseif ($operation  != "Not_received") {
                    $nbr->update(['message' => $operation]);
                    $nbr->update(['state' => "validé"]);
                    Auth::user()->calcAmount();
                    return redirect()->back();
                }
                if ($operation == "Not_received") {
                    $num = DB::table('numbers')->where('user_id', '=', Auth::user()->id)->latest('created_at')->first();
                    $created_at = Carbon::parse($num->created_at);
                    $time = $created_at->format('H:i:s');
                    $date = new DateTime();
                    $is_Expired = $date->format('H:i:s');
                    $diff_in_minutes = $created_at->diffInMinutes($is_Expired);

                    if ($diff_in_minutes >= 10) {
                        $nbr->update(['state' => "echoué"]);
                        Auth::user()->calcAmount();
                    }
                }
            }
        }


        if ($nbr->api_name == '5sim') {
            $token = 'eyJhbGciOiJSUzUxMiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE2OTAxODY5MjAsImlhdCI6MTY1ODY1MDkyMCwicmF5IjoiMGYwYTE2N2Y2NTJhMTRiNmYzMDhiYzk3Y2VkODhiZGIiLCJzdWIiOjEwODIwNDR9.pp76UdiC_1qEmIXZ-Yw1Hp0eSSonLCgdeccIT8YMxs6Fs2H7BFWqPFEZvJ5YENF_NbVaeaCuc52fRuIN3uvNRPuC-U0Fy6yghOpddwf8qVHSGnneu4aczz1nPmO_-6tdeL5eLQUfdg4_QrWJGbhV7m_QL6CK_s_cD4CkknlqH7kfDmp5G-iHATn0E6XXOZnlQ-8BJ_MpCR9bXKvPCCmDjv8TKGN3mhfQuh1kaRmKFbGn54hDKFr9OI1F-LxBWOPQu35ycx8ZgPaSsF-TEjoDq5sdiuAnEJ98-8JuzocQT7MoxeNun44-44DidmVosSYy8P5boS0u199nTa4zBuOY7A';
            $operation = Http::withHeaders([
                "Authorization" => "Bearer " . $token,
                "Accept" => "application/json",
            ])->get('https://5sim.net/v1/user/check/'.$nbr->tzip);
            $rep = $operation->json();
            if ($rep !=null) {
                if ($rep['sms']!=null &&  $rep['status'] == "RECEIVED") {
                    $nbr->update(['message' => $rep['sms'][0]['code']]);
                    $nbr->update(['state' => "validé"]);
                    Auth::user()->calcAmount();
                    return redirect()->back();
                } else {
                    $num = DB::table('numbers')->where('user_id', '=', Auth::user()->id)->latest('created_at')->first();
                    $created_at = Carbon::parse($num->created_at);
                    $time = $created_at->format('H:i:s');
                    $date = new DateTime();
                    $is_Expired = $date->format('H:i:s');
                    $diff_in_minutes = $created_at->diffInMinutes($is_Expired);

                    if ($diff_in_minutes >= 10) {
                        $nbr->update(['state' => "echoué"]);
                        Auth::user()->calcAmount();
                    }
                }
            } else {
                $nbr->update(['state' => "echoué"]);
                Auth::user()->calcAmount();
            }





            $operation = Http::get(
                'https://autofications.com/V2/API.php?action=read&username=bplayez&key=b6d8fe18e9cdcc285a6d&website='.$nbr->tzip.'&country='.$nbr->pays->country_iso.'&phone_number='.$nbr->phone
            );
            if (isset($operation)) {
                if (in_array($operation, array("Balance_error", "Request_limited", "Website_error", "Number_error", "Number_zero",))) {
                    $nbr->transaction->update(['state' => "echoué"]);
                    $nbr->update(['state' => "echoué"]);
                    Auth::user()->calcAmount();
                } elseif ($operation  != "Not_received") {
                    $nbr->update(['message' => $operation]);
                    $nbr->update(['state' => "validé"]);
                    $nbr->transaction->update(['state' => "validé"]);
                    Auth::user()->calcAmount();
                    return redirect()->back();
                }
                if ($operation == "Not_received") {
            $num = DB::table('numbers')->where('user_id', '=', Auth::user()->id)->latest('created_at')->first();
            $created_at = Carbon::parse($num->created_at);
            $time = $created_at->format('H:i:s');
            $date = new DateTime();
            $is_Expired = $date->format('H:i:s');
            $diff_in_minutes = $created_at->diffInMinutes($is_Expired);

            if ($diff_in_minutes >= 10) {
                $nbr->transaction->update(['state' => "echoué"]);
                $nbr->update(['state' => "echoué"]);
                Auth::user()->calcAmount();
            }
                }
            }
        }
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
