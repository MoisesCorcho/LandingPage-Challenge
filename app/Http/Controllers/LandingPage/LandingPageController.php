<?php

namespace App\Http\Controllers\LandingPage;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\WinnerSelector;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\LandingPageRequest;

class LandingPageController extends Controller
{
    private $winnerSelector;

    public function __construct(WinnerSelector $winnerSelector)
    {
        $this->winnerSelector = $winnerSelector;
    }

    public function index()
    {
        $winner = User::where('is_winner', true)->first();
        $departamentCities = $this->getDepartamentCities();

        return view('landingPage.home', ['randomUser' => $winner, 'departamentCities' => $departamentCities]);
    }

    public function store(LandingPageRequest $request)
    {
        $data = $request->except('habeasData');
        User::create($data);
        Session::flash('success', 'Registro completado exitosamente!');

        return back();
    }

    private function getDepartamentCities()
    {
        $departamentosJson = file_get_contents(public_path('Data\colombian_departments_cities.json'));
        return json_decode($departamentosJson, true);
    }

    protected function getWinner()
    {
        $this->winnerSelector->selectWinnerIfAvailable();
        return redirect()->route('landingPage.index');
    }
}
