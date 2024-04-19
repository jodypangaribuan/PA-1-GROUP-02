<?php

namespace App\Http\Controllers;

use App\Models\CatatanKeuangan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard(Request $request){
        $data['page_title'] = 'Dashboard';

		return view('dashboard',$data);
    }
}
