<?php

namespace App\Http\Controllers;
use App\Models\City;
use App\Models\Dealer;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display home page.
     */
    public function __invoke(): View
    {
        return view('home', [
            'cities' => City::query()->with('dealers')->orderBy('name')->get(),
            'countDealers' => Dealer::query()->where('active',1)->count()
        ]);
    }
}
