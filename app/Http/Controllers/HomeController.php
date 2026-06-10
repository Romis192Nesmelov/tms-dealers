<?php

namespace App\Http\Controllers;

//use App\Models\Slide;
//use App\Models\Dealer;
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
            'dealers' => Dealer::query()->with('city')->where('active',1)->get()
        ]);
    }
}
