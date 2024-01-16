<?php

namespace App\Http\Controllers;

use App\Models\Location;
use DateTimeZone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{

    public function home(Request $request)
    {
        $location = $request->input('address');
        $this->trackVisitor($request);
        return view('home', ['location' => $location]);
    }

    public function trackVisitor(Request $request)
    {
        $accessKey = '123f2bcde8c40d38da83bef2f170c0bc';
        $ipAddress = $request->ip();
        if (preg_match('/^(192\.168|10\.|172\.(1[6-9]|2[0-9]|3[0-1])|127\.0\.0\.1)/', $ipAddress)) {
            $ipAddress = '147.175.250.129';
        }

        $url = "http://api.ipstack.com/{$ipAddress}?access_key={$accessKey}";

        $response = file_get_contents($url);
        $data = json_decode($response, true);
        // $data = array("country_name" => "Afg", "country_code" => 93, "city" => "mazar", "latitude" => 36, "longitude" => 67);
        $countryName = $data['country_name'];
        $countryCode = $data['country_code'];
        $flag = $data['location']['country_flag'];
        $city = $data['city'];
        $lat = $data['latitude'];
        $long = $data['longitude'];
        $location = Location::where('ip', $ipAddress)
            ->whereDate('created_at', Carbon::today())
            ->first();
        if (!$location) {
            $location = new Location;
            $location->ip =  $ipAddress;
            $location->country_name =  $countryName;
            $location->country_code =  $countryCode;
            $location->flag =  $flag;
            $location->city = $city;
            $location->lat = $lat;
            $location->lon =  $long;
            $location->save();
        } else {
            $location->updated_at = Carbon::now();
            $location->save();
        }
    }


    public function visitorsByCountry()
    {
        $visitorsByCountry = Location::select('country_code', 'country_name', 'flag', DB::raw('COUNT(*) as total'))
            ->whereDate('created_at', Carbon::today())
            ->groupBy('country_code', 'country_name', 'flag')
            ->get();

        return $visitorsByCountry;
    }


    public function visitorsByCity($country_code)
    {
        $visitorsByCity = Location::select('city', DB::raw('COUNT(*) as total'))
            ->where('country_code', $country_code)
            ->whereDate('created_at', Carbon::today())
            ->groupBy('city')
            ->get();
        return view('table', compact('visitorsByCity', 'country_code'));
    }


    public function visitorsMap()
    {
        $visitors = Location::select('lat', 'lon')->get();
        return $visitors;
    }


    public function visitorsByTimeZone()
    {
        $visitors = Location::whereDate('created_at', Carbon::today())->get();
        $visitsByTimeZone = [
            '6:00-15:00' => 0,
            '15:00-21:00' => 0,
            '21:00-24:00' => 0,
            '24:00-6:00' => 0
        ];
        foreach ($visitors as $visitor) {
            $timezoneIdentifiers = DateTimeZone::listIdentifiers();

            if (in_array($visitor->city, $timezoneIdentifiers)) {
                // Use the visitor's city timezone
                $timeZone = new DateTimeZone($visitor->city);
            } else {
                // Use Europe/Bratislava timezone
                $timeZone = new DateTimeZone('Europe/Bratislava');
            }
            // convert the timestamp to the visitor's local time zone
            $localTime = Carbon::parse($visitor->created_at)->setTimezone($timeZone);

            // categorize the visit into one of the time zones based on the local time
            $hour = $localTime->hour;
            if ($hour >= 6 && $hour < 15) {
                $visitsByTimeZone['6:00-15:00']++;
            } else if ($hour >= 15 && $hour < 21) {
                $visitsByTimeZone['15:00-21:00']++;
            } else if ($hour >= 21 && $hour <= 24) {
                $visitsByTimeZone['21:00-24:00']++;
            } else {
                $visitsByTimeZone['24:00-6:00']++;
            }
        }

        return $visitsByTimeZone;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $visitors =  $this->visitorsMap();
        $visitorsByCountry =  $this->visitorsByCountry();
        $visitsByTimeZone = $this->visitorsByTimeZone();
        return view('info', compact('visitorsByCountry', 'visitors', 'visitsByTimeZone'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $location = $request->input('address');
        $this->trackVisitor($request);
        return view('dashboard', ['location' => $location]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
