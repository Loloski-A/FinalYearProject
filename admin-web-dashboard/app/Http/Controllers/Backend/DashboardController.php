<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        return view('backend.dashboard.list');
    }

    public function admin_home(Request $request)
    {
        return view('backend.home.list');
    }

     public function admin_resources(Request $request)
    {
        return view('backend.resources.list');
    }

     public function admin_incident(Request $request)
    {
        return view('backend.incident.list');
    }
}
