<?php

namespace App\Http\Controllers;

use App\Models\Maincrimecategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrimeanalizerController extends Controller
{
    public function index(){
        $maincrimecategory = Maincrimecategory::all();
        return view('Investigations.Search_View.crimeanalizerview',compact('maincrimecategory'));
    }

    public function analizer(Request $request)
    {
        $searchArea = $request->input('searcharea');
        $fromDate = $request->input('fromdate');
        $toDate = $request->input('todate');
        $mainCrimeCategory = $request->input('maincrime');


        if(empty($mainCrimeCategory)){

            $totalCrimes = DB::table('crime_details')
            ->where('incident_city', 'like', '%' . $searchArea . '%')
            ->whereBetween('dateofincident', [$fromDate, $toDate])
            ->count();

            $crimeStats = DB::table('crime_details')
                ->join('maincrimecategories', 'crime_details.arrested_crime_category', '=', 'maincrimecategories.id')
                ->select('crime_details.arrested_crime_category',  'maincrimecategories.main_crime_category', 
                    DB::raw('COUNT(crime_details.id) as crime_count'))
                ->where('crime_details.incident_city', 'like', '%' . $searchArea . '%') 
                ->whereBetween('crime_details.dateofincident', [$fromDate, $toDate]) 
                ->groupBy('crime_details.arrested_crime_category', 'maincrimecategories.main_crime_category')
                ->get();

                $crimeData = [];
                foreach ($crimeStats as $crime) {
                    $crimeCount = $crime->crime_count;
                    $percentage = ($crimeCount / $totalCrimes) * 100;
            
                    $crimeData[] = [
                        'arrested_crime_category' => $crime->arrested_crime_category,
                        'main_crime_category' => $crime->main_crime_category,
                        'crime_count' => $crimeCount,
                        'percentage' => round($percentage, 2) 
                    ];
                }
        }else{

            $totalCrimes = DB::table('crime_details')
            ->where('incident_city', 'like', '%' . $searchArea . '%')
            ->whereBetween('dateofincident', [$fromDate, $toDate])
            ->where('arrested_crime_category','=', $mainCrimeCategory)
            ->count();

            $crimeStats = DB::table('crime_details')
            ->join('crimelists', 'crime_details.arrested_crime', '=', 'crimelists.id')
            ->select('crime_details.arrested_crime', 'crimelists.crime', 
                DB::raw('COUNT(crime_details.id) as crime_count'))
            ->where('crime_details.incident_city', 'like', '%' . $searchArea . '%') 
            ->whereBetween('crime_details.dateofincident', [$fromDate, $toDate]) 
            ->where('crime_details.arrested_crime_category', '=', $mainCrimeCategory)
            ->groupBy('crime_details.arrested_crime', 'crimelists.crime')
            ->get();
           
            $crimeData = [];
                foreach ($crimeStats as $crime) {
                    $crimeCount = $crime->crime_count;
                    $percentage = ($crimeCount / $totalCrimes) * 100;
            
                    $crimeData[] = [
                        'arrested_crime_category' => $crime->arrested_crime,
                        'main_crime_category' => $crime->crime,
                        'crime_count' => $crimeCount,
                        'percentage' => round($percentage, 2) 
                    ];
                }
        }

        return response()->json(['total_crimes' => $totalCrimes,'crime_stats' => $crimeData]);
    }
}
