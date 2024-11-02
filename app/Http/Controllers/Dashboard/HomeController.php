<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Order;
class HomeController extends Controller
{

    public function index()
    {
        return view('welcome') ;
    }

    public function chartjs()
    {
        $viewer = Order::latest()
            ->orderBy("created_at")
            ->get()->toArray();
        $viewer = array_column($viewer, 'id');


        return view('chartjs')
            ->with('viewer',json_encode($viewer,JSON_NUMERIC_CHECK)) ;
            /*->with('click',json_encode($click,JSON_NUMERIC_CHECK));*/
    }
}
