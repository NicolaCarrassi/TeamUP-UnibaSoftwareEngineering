<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller{
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
        $iduser = auth()->user()->getAuthIdentifier();

        $report_end = DB::table('users')->where('id',auth()->user()->getAuthIdentifier())->pluck('report_end')->first();
        $datediff_report = DB::select('select datediff("'.now()->toDateString().'","'.$report_end.'") as datediff_report from users where id='.auth()->user()->getAuthIdentifierName().';');
        $is_banned = DB::table('users')->where('id',$iduser)->pluck('is_banned')->first();

        return view('home',[
            'datediff_report' => $datediff_report[0]->datediff_report,
            'is_banned' => $is_banned
        ]);
    }
}
