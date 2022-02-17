<?php

namespace App\Http\Controllers;

use App\Models\Multipic;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    // FETCH ALL PORTFOLIO IMAGES
    public function getPortfolio() {
        $portfolios = Multipic::all();
        return view('pages.portfolio', compact('portfolios'));
    }
}
    