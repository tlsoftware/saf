<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status;
use App\Detail;

class StatusController extends Controller
{
    public function index()
    {
        $statuses = Status::all();
        return view('form', compact('statuses'));
    }

    public function getDetails(Request $request, $id)
    {
        if($request->ajax()) {
            $details = Detail::details($id);
            return response()->json($details);
        }
    }
}
