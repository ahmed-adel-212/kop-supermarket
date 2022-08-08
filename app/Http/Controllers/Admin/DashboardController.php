<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\LogfileTrait;
use App\Models\User;
use App\Models\Order;
use App\Models\Branch;
use App\Models\Category;

class DashboardController extends Controller
{

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */

    use LogfileTrait;
    
    public function __invoke()
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
        $this->Make_Log('App\Models\dashboard','view',0);
        return view('home', compact('ordersCount', 'branchesCount', 'categoriesCount', 'customersCount'));

    }

}
