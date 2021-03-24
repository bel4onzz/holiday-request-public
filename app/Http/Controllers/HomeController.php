<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HolidayRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['holiday_requests']= HolidayRequest::where('fkUserId', auth()->user()->id)->get();
        return view('home', $data);
    }
}
