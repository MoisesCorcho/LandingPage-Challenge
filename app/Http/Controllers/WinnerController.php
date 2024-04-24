<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WinnerSelector;

class WinnerController extends Controller
{
    private $winnerSelector;

    public function __construct(WinnerSelector $winnerSelector)
    {
        $this->winnerSelector = $winnerSelector;
    }

    public function getWinner()
    {
        $this->winnerSelector->selectWinnerIfAvailable();
        return redirect()->route('landingPage.index');
    }
}
