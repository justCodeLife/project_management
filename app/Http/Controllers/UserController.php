<?php

namespace App\Http\Controllers;

use App\Models\ProjectUser;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function total_hours_of_work_per_project(Request $request)
    {
        return response()->json(ProjectUser::where('user_id', $request->user->_id)->where('project_id', $request->route('id'))->sum('hours_of_work'));
    }

    public function total_hours_of_work_per_day(Request $request)
    {
        return response()->json(ProjectUser::where('user_id', $request->user->_id)->where('day', Carbon::now()->day)->sum('hours_of_work'));
//        return response()->json(ProjectUser::where('user_id', $request->user->_id)->project(['date' => ['$dayOfYear' => Carbon::now()->day]])->sum('hours_of_work'));
    }

    public function total_hours_of_work_per_month(Request $request)
    {
        return response()->json(ProjectUser::where('user_id', $request->user->_id)->where('month', Carbon::now()->month)->sum('hours_of_work'));
    }
}
