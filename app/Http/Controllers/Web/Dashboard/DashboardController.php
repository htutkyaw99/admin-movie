<?php

namespace App\Http\Controllers\Web\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $moviesCount = Movie::withoutTrashed()->count();
        $adminsCount = DB::table('admins')->count();

        return view('dashboard.panel', [
            'moviesCount' => $moviesCount,
            'adminsCount' => $adminsCount
        ]);
    }
}
