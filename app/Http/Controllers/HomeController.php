<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Branch;
use App\Models\Category;
use App\Models\User;


class HomeController extends Controller
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

        // orders
        $ordersCount = Order::where('state', 'pending')->count();

        // branches
        $branchesCount = Branch::count();

        // categories
        $categoriesCount = Category::count();

        // customers
        $customersCount = User::whereHas('roles', function($role) {
            $role->where('name', 'customer');
        })->count();

        return view('admin.dashboard', compact('ordersCount', 'branchesCount', 'categoriesCount', 'customersCount'));


    }
}
