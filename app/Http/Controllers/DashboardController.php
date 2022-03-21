<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use DB;
use App\Models\User;
use App\Models\Product;
use App\Models\Categories;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $count['user'] = User::count();
        $count['product'] = Product::count();
        $count['categories'] = Categories::count();
        return view('dashboard', $count)->with('dashboardTab', 'active');
    }
}
