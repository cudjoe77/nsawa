<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function get_beneficiary(Request $request)
    {
        return view('livewire.benefit_home');
    }

    public function get_nsawa($nid)

    {
    return view('livewire.donation_home',compact('nid'));
    }


    public function set_funeral(Request $request)

    {
    return view('livewire.funeral_home');
    }
}

