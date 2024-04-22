<?php

namespace App\Http\Controllers\LandingPage;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LandingPageRequest;

class LandingPageController extends Controller
{

    public function index()
    {
        $winner = User::where('is_winner', true)->first();
        $departamentCities = $this->getDepartmentCities();

        return view('landingPage.home', ['randomUser' => $winner, 'departamentCities' => $departamentCities]);
    }

    public function store(LandingPageRequest $request)
    {
        User::create($request->except('habeasData'));
        session()->flash('success', 'Registration completed successfully.');

        return back();
    }

    private function getDepartmentCities()
    {
        $jsonFile = public_path('Data/colombian_departments_cities.json');
        $departmentsCities = json_decode(file_get_contents($jsonFile), true);
        return $departmentsCities;
    }
}
