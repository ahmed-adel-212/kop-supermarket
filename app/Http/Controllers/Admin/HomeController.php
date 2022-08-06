<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\Branch;
use App\Models\Category;
use App\Models\User;


class HomeController extends Controller
{
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
