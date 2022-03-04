<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Detail;
use App\Models\SignAstrologique;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use Whatsma\ZodiacSign;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'birthday' => 'required|string|max:255',
            'country' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postcode' => 'required|integer',
            'street_number' => 'required|integer',
            'street_name' => 'required|string|max:255',
            'coord_lat' => 'required|string',
            'coord_lon' => 'required|string',
            'timezone' => 'required|string',
        ]);

        $calculator = new ZodiacSign\Calculator();

        try {
            $user = User::create([
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'gender' => $validatedData['gender'],
                    'birthday' => $validatedData['birthday'],
                    'country' => $validatedData['country'],
                    'password' => Hash::make($validatedData['password']),
            ]);
            // Detail::create([
            //     'user_id'=> $user,
            //     'country' => $validatedData['country'],
            //     'city' => $validatedData['city'],
            //     'postcode' => $validatedData['postcode'],
            //     'street_number' => $validatedData['street_number'],
            //     'street_name' => $validatedData['street_name'],
            //     'coord_lat' => $validatedData['coord_lat'],
            //     'coord_lon' => $validatedData['coord_lon'],
            //     'timezone' => $validatedData['timezone'],
            // ]);

            // $monthUser = (int) \Carbon\Carbon::parse($validatedData['birthday'])->format('m');
            // $dayUser = (int) \Carbon\Carbon::parse($validatedData['birthday'])->format('d');

            // SignAstrologique::create([
            //     'user_id'=> $user,
            //     'zodiac_sign' => $calculator->calculate( $dayUser, $monthUser),
            // ]);

            return response()->json("Ok",200);

        } catch (\Throwable $th) {

            return response()->json("Error",500);
        }
        
    }
    /**
     * Illuminate\Support\Facades\Http
     * $response = data of json
     */

    public function fillUsers(){
        $response  = Http::get('https://randomuser.me/api/?nat=fr');
        $response = json_decode($response);
        try {
           
            $user = User::insertGetId([
                'name' => $response->results[0]->name->first,
                'gender' => $response->results[0]->gender,
                'birthday' => '1975-05-25 06:24:25',
                'email' => $response->results[0]->email,
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]);

            Detail::create([
                'user_id'=> $user,
                'country' => $response->results[0]->location->country,
                'city' => $response->results[0]->location->city,
                'postcode' => $response->results[0]->location->postcode,
                'street_number' => $response->results[0]->location->street->number,
                'street_name' => $response->results[0]->location->street->name,
                'coord_lat' => $response->results[0]->location->coordinates->latitude,
                'coord_lon' => $response->results[0]->location->coordinates->longitude,
                'timezone' => $response->results[0]->location->timezone->offset,
            ]);
        
            return response()->json("Ok",200);

        } catch (\Throwable $th) {
            
            return response()->json("Error",500);
        }
    }
    /**
     * $page = query
     * $page localhost/users?page=5
     */

    public function users(Request $request){

        $page = $request->has('page') ? $request->get('page') : 0 ;
        $page = $page * 10;
        $users = User::with(["details","sign"])->skip($page)->take(10)->get();
        return response()->json($users);

    }
}
