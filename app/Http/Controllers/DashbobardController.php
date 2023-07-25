<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashbobardController extends Controller
{
    //

    public function indexDashboard(){

        $breadcrumbs = [
            ['link' => url(""), 'name' => 'Dashboard'],
            ['link' => url("users"), 'name' => 'User'],
            ['name' => __('User')],
        ];

        return view('dashboard.dashboard-analytics');
    }
}
