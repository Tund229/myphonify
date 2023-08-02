<?php

namespace App\Http\Controllers;

use App\Models\Number;
use App\Models\Country;
use App\Models\TempPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class NumberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    // my-numbers function
    public function my_numbers()
    {
        Auth::user()->restoreState();
        $title = "Mes numéros";
        $countries_count = Country::where('state', true)->count();
        return view('numbers.my-numbers', compact('title', 'countries_count'));
    }


    //purchase-numbers
    public function purchase_numbers($id = null)
    {

        // $countries = ["Afghanistan" => "Afghanistan", "Afrique du Sud" => "South Africa", "Albanie" => "Albania", "Algérie" => "Algeria", "Allemagne" => "Germany", "Andorre" => "Andorra", "Angola" => "Angola", "Antigua-et-Barbuda" => "Antigua and Barbuda", "Arabie Saoudite" => "Saudi Arabia", "Argentine" => "Argentina", "Arménie" => "Armenia", "Australie" => "Australia", "Autriche" => "Austria", "Azerbaïdjan" => "Azerbaijan", "Bahamas" => "Bahamas", "Bahreïn" => "Bahrain", "Bangladesh" => "Bangladesh", "Barbade" => "Barbados", "Belgique" => "Belgium", "Belize" => "Belize", "Bénin" => "Benin", "Bhoutan" => "Bhutan", "Biélorussie" => "Belarus", "Birmanie" => "Myanmar", "Bolivie" => "Bolivia", "Bosnie-Herzégovine" => "Bosnia and Herzegovina", "Botswana" => "Botswana", "Brésil" => "Brazil", "Brunei" => "Brunei", "Bulgarie" => "Bulgaria", "Burkina Faso" => "Burkina Faso", "Burundi" => "Burundi", "Cambodge" => "Cambodia", "Cameroun" => "Cameroon", "Canada" => "Canada", "Cap-Vert" => "Cape Verde", "Centrafrique" => "Central African Republic", "Chili" => "Chile", "Chine" => "China", "Chypre" => "Cyprus", "Colombie" => "Colombia", "Comores" => "Comoros", "République du Congo" => "Republic of the Congo", "République démocratique du Congo" => "Democratic Republic of the Congo", "Corée du Nord" => "North Korea", "Corée du Sud" => "South Korea", "Costa Rica" => "Costa Rica", "Côte d’Ivoire" => "Ivory Coast", "Croatie" => "Croatia", "Cuba" => "Cuba", "Danemark" => "Denmark", "Djibouti" => "Djibouti", "Dominique" => "Dominica", "Égypte" => "Egypt", "Émirats arabes unis" => "United Arab Emirates", "Équateur" => "Ecuador", "Érythrée" => "Eritrea", "Espagne" => "Spain", "Estonie" => "Estonia", "États-Unis" => "United States", "Éthiopie" => "Ethiopia", "Fidji" => "Fiji", "Finlande" => "Finland", "France" => "France", "Gabon" => "Gabon", "Gambie" => "Gambia", "Géorgie" => "Georgia", "Ghana" => "Ghana", "Grèce" => "Greece", "Grenade" => "Grenada", "Guatemala" => "Guatemala", "Guinée" => "Guinea","Géorgie" => "Georgia", "Ghana" => "Ghana", "Grenade" => "Grenada", "Guatemala" => "Guatemala", "Guinée" => "Guinea", "Guinée équatoriale" => "Equatorial Guinea", "Guinée-Bissau" => "Guinea-Bissau", "Guyana" => "Guyana", "Haïti" => "Haiti", "Honduras" => "Honduras", "Hongrie" => "Hungary", "Îles Marshall" => "Marshall Islands", "Inde" => "India", "Indonésie" => "Indonesia", "Iran" => "Iran", "Iraq" => "Iraq", "Irlande" => "Ireland", "Islande" => "Iceland", "Israël" => "Israel", "Italie" => "Italy", "Jamaïque" => "Jamaica", "Japon" => "Japan", "Jordanie" => "Jordan", "Kazakhstan" => "Kazakhstan", "Kenya" => "Kenya", "Kirghizistan" => "Kyrgyzstan", "Kiribati" => "Kiribati", "Koweït" => "Kuwait", "Laos" => "Laos", "Lesotho" => "Lesotho", "Lettonie" => "Latvia", "Liban" => "Lebanon", "Libéria" => "Liberia", "Libye" => "Libya", "Liechtenstein" => "Liechtenstein", "Lituanie" => "Lithuania", "Luxembourg" => "Luxembourg", "Macédoine" => "Macedonia", "Madagascar" => "Madagascar", "Malaisie" => "Malaysia", "Malawi" => "Malawi", "Maldives" => "Maldives", "Mali" => "Mali", "Malte" => "Malta", "Maroc" => "Morocco", "Maurice" => "Mauritius", "Mauritanie" => "Mauritania", "Mexique" => "Mexico", "Micronésie" => "Micronesia", "Moldavie" => "Moldova", "Monaco" => "Monaco", "Mongolie" => "Mongolia", "Monténégro" => "Montenegro", "Mozambique" => "Mozambique", "Myanmar" => "Myanmar", "Namibie" => "Namibia", "Nauru" => "Nauru", "Népal" => "Nepal", "Nicaragua" => "Nicaragua", "Niger" => "Niger", "Nigeria" => "Nigeria", "Niue" => "Niue", "Norvège" => "Norway", "Nouvelle-Zélande" => "New Zealand", "Oman" => "Oman", "Ouganda" => "Uganda", "Ouzbékistan" => "Uzbekistan", "Palau" => "Palau", "Panama" => "Panama", "Papouasie-Nouvelle-Guinée" => "Papua New Guinea", "Paraguay" => "Paraguay", "Pays-Bas" => "Netherlands", "Pérou" => "Peru", "Philippines" => "Philippines", "Pologne" => "Poland", "Portugal" => "Portugal", "Qatar" => "Qatar", "République centrafricaine" => "Central African Republic", "République démocratique du Congo" => "Democratic Republic of the Congo", "République dominicaine" => "Dominican Republic", "République tchèque" => "Czech Republic", "Roumanie" => "Romania", "Royaume-Uni" => "United Kingdom", "Russie" => "Russia", "Rwanda" => "Rwanda", "Saint-Christophe-et-Niévès" => "Saint Kitts and Nevis", "Saint-Marin" => "San Marino", "Saint-Vincent-et-les Grenadines" => "Saint Vincent and the Grenadines", "Sainte-Lucie" => "Saint Lucia", "Salomon, Îles" => "Solomon Islands", "Salvador" => "El Salvador", "Samoa" => "Samoa", "Sao Tomé-et-Principe" => "Sao Tome and Principe", "Sénégal" => "Senegal", "Serbie" => "Serbia", "Seychelles" => "Seychelles", "Sierra Leone" => "Sierra Leone", "Singapour" => "Singapore", "Slovaquie" => "Slovakia", "Slovénie" => "Slovenia", "Somalie" => "Somalia", "Soudan" => "Sudan", "Soudan du Sud" => "South Sudan", "Sri Lanka" => "Sri Lanka", "Suède" => "Sweden", "Suisse" => "Switzerland", "Suriname" => "Suriname", "Swaziland" => "Eswatini", "Syrie" => "Syria", "Tadjikistan" => "Tajikistan", "Tanzanie" => "Tanzania", "Tchad" => "Chad", "Tchéquie" => "Czech Republic", "Thaïlande" => "Thailand", "Timor-Leste" => "Timor-Leste", "Togo" => "Togo", "Tonga" => "Tonga", "Trinité-et-Tobago" => "Trinidad and Tobago", "Tunisie" => "Tunisia", "Turkménistan" => "Turkmenistan", "Turquie" => "Turkey", "Tuvalu" => "Tuvalu", "Ukraine" => "Ukraine", "Uruguay" => "Uruguay", "Vanuatu" => "Vanuatu", "Venezuela" => "Venezuela", "Vietnam" => "Vietnam", "Yémen" => "Yemen", "Zambie" => "Zambia", "Zimbabwe" => "Zimbabwe"];
        // $count = 0;
        // foreach ($countries as $fr => $en) {
        //     $pays = Country::where('name', $fr)->first();
        //     if ($pays) {
        //         $pays->update(["en_name" => $en]) ;
        //     }
        // }
        // foreach ($countries as $fr => $en) {
        //     $pays = Country::where('name', $en)->first();
        //     if ($pays) {
        //         $pays->update(["en_name" => $en]) ;
        //     }
        // }


        $title = "Acheter un numéro";
        $countries = Country::where('state', true)->get();
        $countries_count = Country::where('state', true)->count();
        $temppurchase = TempPurchase::where('state', true)->get();
        return view('numbers.purchase-numbers', compact('title', 'countries', 'countries_count', 'id', 'temppurchase'));
    }


    //temp_purchase
    public function temp_purchase(Request $request)
    {
        Auth::user()->restoreState();
        $data = $request->validate([
            'country_id' => ['required'],
            'service' => ['required'],
        ]);
        $amount = Auth::user()->account_balance;
        $country = Country::where('id', $data['country_id'])->first();
        $service = $data['service'];
        $country_price = 'price'.'_'.$service;
        $price = $country->$country_price;
        if($amount >=   $price) {
            $tempourchase = TempPurchase::create([
                'user_id' => Auth::user()->id,
                'country_id' => $country->id,
                'service' =>   $service,
                'service_price' => $price,
            ]);
        } else {
            $message = "Votre sole est insuffisant !";
            $request->session()->flash('error_message', $message);
            return redirect()->back();
        }
        return redirect()->back();
    }


    // purchase_delete
    public function purchase_delete($id)
    {
        Auth::user()->restoreState();
        $tempourchase = TempPurchase::where('id', $id)->first();
        if($tempourchase) {
            $tempourchase->delete();
        }
        return redirect()->back();
    }



    //purchase
    public function purchase(Request $request, $id)
    {
        Auth::user()->restoreState();
        $tempourchase = TempPurchase::where('id', $id)->first();
        if($tempourchase) {
            $amount = $tempourchase->service_price;
            if(Auth::user()->account_balance >= $amount) {
                $getLastBuys = Number::where('state', ['en cours'])->where('user_id', Auth::user()->id)->count();
                if ($getLastBuys > 0) {
                    $message = "Vous avez déjà un achat en cours. Réessayez plus tard !";
                    $request->session()->flash('error_message', $message);
                    return redirect()->back();
                } else {
                    $product = $tempourchase->service;
                    $country = Country::find($tempourchase->country_id);
                    $api_name = $country->api_name->name;


                    // Smspva
                    if($api_name == 'Smspva') {
                        if ($product == 'whatsapp') {
                            $service = 'opt20';
                        } elseif ($product == 'telegram') {
                            $service = 'opt29';
                        } elseif ($product == 'facebook') {
                            $service = 'opt2';
                        } elseif ($product == 'gmail') {
                            $service = 'opt1';
                        } elseif ($product == 'TikTok') {
                            $service = 'opt104';
                        } elseif ($product == 'Signal') {
                        } elseif ($product == 'Viber') {
                            $service = 'opt11';
                        }
                        $response = Http::get(
                            'https://smspva.com/priemnik.php?metod=get_number&country='.$country->country_iso.'&service='.$service.'&apikey=L9zCBnR84GOadTQjVqjd3O6ntgqoKY'
                        );
                        $rep = $response->json();
                        if ($rep && $rep['response'] == 1) {
                            // buy number chez smspva
                            $phone = $rep['CountryCode'].$rep['number'];
                            $number = Number::create([
                                'service' => $product,'country_name' => $country->name, 'user_id' => Auth::user()->id,'country' => $country->id,
                                'state' => 'en cours', 'phone' =>$phone,'tzip' => $rep['id'], 'api_name' => $api_name, 'amount' => $amount
                            ]);
                            $tempourchase->delete();
                            Auth::user()->calcAmount();
                            return redirect('my-numbers');
                        } else {
                            if ($country->Mta == 1) {
                                // OnlineSim
                                $response = Http::get(
                                    'https://onlinesim.io/api/getNum.php?apikey=a3HaYQM6mn666EZ-B2n56N6g-qKd3eN69-61TwhE35-be233apCFVZ883a&service=' .$product. '&country=' . $country->phonecode
                                );
                                $rep = $response->json();
                                if ($rep['response'] == 1) {
                                    $number = Number::create([
                                        'service' => $product,'country_name' => $country->name, 'user_id' => Auth::user()->id, 'country' => $country->id,
                                        'state' => 'en cours', 'tzip' => $rep['tzid'], 'api_name' => 'OnlineSim', 'amount' => $amount
                                    ]);

                                    $operation = Http::get(
                                        'https://onlinesim.io/api/getState.php?apikey=a3HaYQM6mn666EZ-B2n56N6g-qKd3eN69-61TwhE35-be233apCFVZ883a&tzid=' . $number->tzip
                                    );
                                    $this->operation = $operation->json();
                                    if ($operation[0]['number']) {
                                        $number->update(['phone' => $operation[0]['number'], 'state' => "en cours"]);
                                        $tempourchase->delete();
                                        Auth::user()->calcAmount();
                                        return redirect('my-numbers');
                                    }
                                } else {
                                    //Autofication
                                    $website = $country->toArray()['id_'.$product];
                                    $response = Http::get(
                                        'https://autofications.com/V2/API.php?action=generate&username=GhostBoy&key=7576021e3d333d8bd8a8&website='.$website.'&country='.$country->country_iso
                                    );
                                    $rep = $response->json();
                                    if (in_array($response, array("Number_zero", "Website_error", "Balance_error ", "Request_limited"))) {
                                        $minuscules_country = strtolower(str_replace(' ', '_', $country->en_name));
                                        $operator = 'any';
                                        $token = 'eyJhbGciOiJSUzUxMiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE2OTAxODY5MjAsImlhdCI6MTY1ODY1MDkyMCwicmF5IjoiMGYwYTE2N2Y2NTJhMTRiNmYzMDhiYzk3Y2VkODhiZGIiLCJzdWIiOjEwODIwNDR9.pp76UdiC_1qEmIXZ-Yw1Hp0eSSonLCgdeccIT8YMxs6Fs2H7BFWqPFEZvJ5YENF_NbVaeaCuc52fRuIN3uvNRPuC-U0Fy6yghOpddwf8qVHSGnneu4aczz1nPmO_-6tdeL5eLQUfdg4_QrWJGbhV7m_QL6CK_s_cD4CkknlqH7kfDmp5G-iHATn0E6XXOZnlQ-8BJ_MpCR9bXKvPCCmDjv8TKGN3mhfQuh1kaRmKFbGn54hDKFr9OI1F-LxBWOPQu35ycx8ZgPaSsF-TEjoDq5sdiuAnEJ98-8JuzocQT7MoxeNun44-44DidmVosSYy8P5boS0u199nTa4zBuOY7A';
                                        $response = Http::withHeaders([
                                            "Authorization" => "Bearer " . $token,
                                            "Accept" => "application/json",
                                        ])->get('https://5sim.net/v1/user/buy/activation/'.$minuscules_country.'/'.$operator.'/'.$product);
                                        $rep = $response->json();
                                        if($response->status() == 200 && $rep !=null) {
                                            $number = Number::create([
                                                'service' => $product,'country_name' => $country->name, 'user_id' => Auth::user()->id,'country' => $country->id,
                                                'state' => 'en cours', 'phone' =>$rep['phone'],'tzip' => $rep['id'], 'api_name' => '5sim', 'amount' => $amount
                                            ]);
                                            $tempourchase->delete();
                                            Auth::user()->calcAmount();
                                            return redirect('my-numbers');
                                        } else {
                                            $tempourchase->delete();
                                            Auth::user()->calcAmount();
                                            $message = "Rupture de numeros " . $product ." pour ". $country->name;
                                            $request->session()->flash('error_message', $message);
                                            return redirect()->back();
                                        }
                                    } else {
                                        $number = Number::create([
                                            'service' => $product,'country_name' => $country->name, 'user_id' => Auth::user()->id, 'country' => $country->id,
                                            'state' => 'en cours', 'phone' =>$rep,'tzip' => $website, 'api_name' => "Autofication", 'amount' => $amount
                                        ]);
                                        $tempourchase->delete();
                                        Auth::user()->calcAmount();
                                        return redirect('my-numbers');
                                    }

                                }
                            } else {
                                $tempourchase->delete();
                                Auth::user()->calcAmount();
                                $message = "Rupture de numeros " . $product." pour ". $country->name;
                                $request->session()->flash('error_message', $message);
                                return redirect()->back();
                            }
                        }
                    }

                    //Autofication
                    if($api_name == 'Autofication') {
                        $website = $country->toArray()['id_'.$product];
                        $response = Http::get(
                            'https://autofications.com/V2/API.php?action=generate&username=GhostBoy&key=7576021e3d333d8bd8a8&website='.$website.'&country='.$country->country_iso
                        );
                        $rep = $response->json();
                        if (in_array($response, array("Number_zero", "Website_error", "Balance_error ", "Request_limited"))) {
                            if($country->Mta == 1) {
                                if ($product == 'whatsapp') {
                                    $service = 'opt20';
                                } elseif ($product == 'telegram') {
                                    $service = 'opt29';
                                } elseif ($product == 'facebook') {
                                    $service = 'opt2';
                                } elseif ($product == 'gmail') {
                                    $service = 'opt1';
                                } elseif ($product == 'TikTok') {
                                    $service = 'opt104';
                                } elseif ($product == 'Signal') {
                                } elseif ($product == 'Viber') {
                                    $service = 'opt11';
                                }
                                $response = Http::get(
                                    'https://smspva.com/priemnik.php?metod=get_number&country='.$country->country_iso.'&service='.$service.'&apikey=L9zCBnR84GOadTQjVqjd3O6ntgqoKY'
                                );
                                $rep = $response->json();
                                if ($rep && $rep['response'] == 1) {
                                    // buy number chez smspva
                                    $phone = $rep['CountryCode'].$rep['number'];
                                    $number = Number::create([
                                        'service' => $product,'country_name' => $country->name, 'user_id' => Auth::user()->id, 'country' => $country->id,
                                        'state' => 'en cours', 'phone' =>$phone,'tzip' => $rep['id'], 'api_name' => 'Smspva', 'amount' => $amount
                                    ]);
                                    $tempourchase->delete();
                                    Auth::user()->calcAmount();
                                    return redirect('my-numbers');
                                } else {
                                    $response = Http::get(
                                        'https://onlinesim.io/api/getNum.php?apikey=a3HaYQM6mn666EZ-B2n56N6g-qKd3eN69-61TwhE35-be233apCFVZ883a&service=' .$product. '&country=' . $country->phonecode
                                    );
                                    $rep = $response->json();
                                    if ($rep['response'] == 1) {
                                        $number = Number::create([
                                            'service' => $product,'country_name' => $country->name, 'user_id' => Auth::user()->id, 'country' => $country->id,
                                            'state' => 'en cours', 'tzip' => $rep['tzid'], 'api_name' => 'OnlineSim', 'amount' => $amount
                                        ]);
                                        $operation = Http::get(
                                            'https://onlinesim.io/api/getState.php?apikey=a3HaYQM6mn666EZ-B2n56N6g-qKd3eN69-61TwhE35-be233apCFVZ883a&tzid=' . $number->tzip
                                        );
                                        $this->operation = $operation->json();
                                        if ($operation[0]['number']) {
                                            $number->update(['phone' => $operation[0]['number'], 'state' => "en cours"]);
                                            $tempourchase->delete();
                                            Auth::user()->calcAmount();
                                            return redirect('my-numbers');
                                        }
                                    } else {
                                        $minuscules_country = strtolower(str_replace(' ', '_', $country->en_name));
                                        $operator = 'any';
                                        $token = 'eyJhbGciOiJSUzUxMiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE2OTAxODY5MjAsImlhdCI6MTY1ODY1MDkyMCwicmF5IjoiMGYwYTE2N2Y2NTJhMTRiNmYzMDhiYzk3Y2VkODhiZGIiLCJzdWIiOjEwODIwNDR9.pp76UdiC_1qEmIXZ-Yw1Hp0eSSonLCgdeccIT8YMxs6Fs2H7BFWqPFEZvJ5YENF_NbVaeaCuc52fRuIN3uvNRPuC-U0Fy6yghOpddwf8qVHSGnneu4aczz1nPmO_-6tdeL5eLQUfdg4_QrWJGbhV7m_QL6CK_s_cD4CkknlqH7kfDmp5G-iHATn0E6XXOZnlQ-8BJ_MpCR9bXKvPCCmDjv8TKGN3mhfQuh1kaRmKFbGn54hDKFr9OI1F-LxBWOPQu35ycx8ZgPaSsF-TEjoDq5sdiuAnEJ98-8JuzocQT7MoxeNun44-44DidmVosSYy8P5boS0u199nTa4zBuOY7A';
                                        $response = Http::withHeaders([
                                            "Authorization" => "Bearer " . $token,
                                            "Accept" => "application/json",
                                        ])->get('https://5sim.net/v1/user/buy/activation/'.$minuscules_country.'/'.$operator.'/'.$product);
                                        $rep = $response->json();
                                        if($response->status() == 200 && $rep !=null) {
                                            $number = Number::create([
                                                'service' => $product,'country_name' => $country->name, 'user_id' => Auth::user()->id, 'country' => $country->id,
                                                'state' => 'en cours', 'phone' =>$rep['phone'],'tzip' => $rep['id'], 'api_name' => '5sim', 'amount' => $amount
                                            ]);
                                            $tempourchase->delete();
                                            Auth::user()->calcAmount();
                                            return redirect('my-numbers');
                                        } else {
                                            $tempourchase->delete();
                                            $message = "Rupture de numeros " . $product ." pour ". $country->name;
                                            $request->session()->flash('error_message', $message);
                                            return redirect()->back();
                                        }
                                    }
                                }

                            } else {
                                $tempourchase->delete();
                                $message = "Rupture de numeros " . $product ." pour ". $country->name;
                                $request->session()->flash('error_message', $message);
                                return redirect()->back();
                            }
                        } else {
                            $number = Number::create([
                                'service' => $product,'country_name' => $country->name, 'user_id' => Auth::user()->id,'country' => $country->id,
                                'state' => 'en cours', 'phone' =>$rep,'tzip' => $website, 'api_name' => $api_name, 'amount' => $amount
                            ]);
                            $tempourchase->delete();
                            Auth::user()->calcAmount();
                            return redirect('my-numbers');
                        }
                    }


                    //OnlineSim
                    if($api_name == 'OnlineSim') {
                        $response = Http::get(
                            'https://onlinesim.io/api/getNum.php?apikey=a3HaYQM6mn666EZ-B2n56N6g-qKd3eN69-61TwhE35-be233apCFVZ883a&service=' .$product. '&country=' . $country->phonecode
                        );
                        $rep = $response->json();

                        if ($rep['response'] == 1) {
                            $number = Number::create([
                                'service' => $product,'country_name' => $country->name, 'user_id' => Auth::user()->id,'country' => $country->id,
                                'state' => 'en cours','tzip' => $rep['tzid'], 'api_name' => $api_name, 'amount' => $amount
                            ]);
                            $operation = Http::get(
                                'https://onlinesim.io/api/getState.php?apikey=a3HaYQM6mn666EZ-B2n56N6g-qKd3eN69-61TwhE35-be233apCFVZ883a&tzid=' . $number->tzip
                            );
                            $this->operation = $operation->json();
                            if ($operation[0]['number']) {
                                $number->update(['phone' => $operation[0]['number'], 'state' => "en cours"]);
                                $tempourchase->delete();
                                Auth::user()->calcAmount();
                                return redirect('my-numbers');
                            }
                        } else {
                            //Autofication
                            $website = $country->toArray()['id_'.$product];
                            $response = Http::get(
                                'https://autofications.com/V2/API.php?action=generate&username=GhostBoy&key=7576021e3d333d8bd8a8&website='.$website.'&country='.$country->country_iso
                            );
                            $rep = $response->json();
                            if (in_array($response, array("Number_zero", "Website_error", "Balance_error ", "Request_limited"))) {
                                // 5sim
                                $minuscules_country = strtolower(str_replace(' ', '_', $country->en_name));
                                $operator = 'any';
                                $token = 'eyJhbGciOiJSUzUxMiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE2OTAxODY5MjAsImlhdCI6MTY1ODY1MDkyMCwicmF5IjoiMGYwYTE2N2Y2NTJhMTRiNmYzMDhiYzk3Y2VkODhiZGIiLCJzdWIiOjEwODIwNDR9.pp76UdiC_1qEmIXZ-Yw1Hp0eSSonLCgdeccIT8YMxs6Fs2H7BFWqPFEZvJ5YENF_NbVaeaCuc52fRuIN3uvNRPuC-U0Fy6yghOpddwf8qVHSGnneu4aczz1nPmO_-6tdeL5eLQUfdg4_QrWJGbhV7m_QL6CK_s_cD4CkknlqH7kfDmp5G-iHATn0E6XXOZnlQ-8BJ_MpCR9bXKvPCCmDjv8TKGN3mhfQuh1kaRmKFbGn54hDKFr9OI1F-LxBWOPQu35ycx8ZgPaSsF-TEjoDq5sdiuAnEJ98-8JuzocQT7MoxeNun44-44DidmVosSYy8P5boS0u199nTa4zBuOY7A';
                                $response = Http::withHeaders([
                                    "Authorization" => "Bearer " . $token,
                                    "Accept" => "application/json",
                                ])->get('https://5sim.net/v1/user/buy/activation/'.$minuscules_country.'/'.$operator.'/'.$product);
                                $rep = $response->json();
                                if($response->status() == 200 && $rep !=null) {
                                    $number = Number::create([
                                        'service' => $product,'country_name' => $country->name, 'user_id' => Auth::user()->id,'country' => $country->id,
                                        'state' => 'en cours', 'phone' =>$rep['phone'],'tzip' => $rep['id'], 'api_name' => '5sim', 'amount' => $amount
                                    ]);

                                    $tempourchase->delete();
                                    Auth::user()->calcAmount();
                                    return redirect('my-numbers');
                                } else {
                                    // Smspva
                                    if ($product == 'whatsapp') {
                                        $service = 'opt20';
                                    } elseif ($product == 'telegram') {
                                        $service = 'opt29';
                                    } elseif ($product == 'facebook') {
                                        $service = 'opt2';
                                    } elseif ($product == 'gmail') {
                                        $service = 'opt1';
                                    } elseif ($product == 'TikTok') {
                                        $service = 'opt104';
                                    } elseif ($product == 'Signal') {
                                    } elseif ($product == 'Viber') {
                                        $service = 'opt11';
                                    }
                                    $response = Http::get(
                                        'https://smspva.com/priemnik.php?metod=get_number&country='.$country->country_iso.'&service='.$service.'&apikey=L9zCBnR84GOadTQjVqjd3O6ntgqoKY'
                                    );
                                    $rep = $response->json();
                                    if ($rep && $rep['response'] == 1) {
                                        // buy number chez smspva
                                        $phone = $rep['CountryCode'].$rep['number'];
                                        $number = Number::create([
                                            'service' => $product,'country_name' => $country->name, 'user_id' => Auth::user()->id,'country' => $country->id,
                                            'state' => 'en cours', 'phone' =>$phone,'tzip' => $rep['id'], 'api_name' => $api_name, 'amount' => $amount
                                        ]);
                                        $tempourchase->delete();
                                        Auth::user()->calcAmount();
                                        return redirect('my-numbers');
                                    } else {
                                        $tempourchase->delete();
                                        $message = "Rupture de numeros " . $product ." pour ". $country->name;
                                        $request->session()->flash('error_message', $message);
                                        return redirect()->back();
                                    }
                                }
                            } else {
                                $number = Number::create([
                                    'service' => $product,'country_name' => $country->name, 'user_id' => Auth::user()->id,'country' => $country->id,
                                    'state' => 'en cours', 'phone' =>$rep,'tzip' => $website, 'api_name' => "Autofication", 'amount' => $amount
                                ]);
                                $tempourchase->delete();
                                Auth::user()->calcAmount();
                                return redirect('my-numbers');
                            }

                        }
                    }

                }
            } else {
                Auth::user()->restoreState();
                Auth::user()->calcAmount();
                $message = "Solde insuffisant, veuillez recharger votre compte";
                $request->session()->flash('error_message', $message);
                return redirect()->back();
            }
        }
        return redirect()->back();
    }
}
