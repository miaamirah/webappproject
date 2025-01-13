<?php

namespace App\Http\Controllers;

use App\Models\Academician;
use App\Models\Grant;
use App\Models\Milestone;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $academiciansCount = Academician::count();
        $grantsCount = Grant::count();
        $milestonesCount = Milestone::count();

        return view('dashboard', compact('academiciansCount', 'grantsCount', 'milestonesCount'));
    }
}
