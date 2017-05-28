<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status;
use App\Detail;

class StatusController extends Controller
{
    public function index()
    {
        $statuses = Detail::paginate(10);

        return view('admin.statuses.index', compact('statuses'));
    }

    public function create()
    {
        $statuses = Status::pluck('name', 'id')->toArray();

        return view('admin.statuses.create')
            ->with('statuses', $statuses);

    }

    public function store(Request $request)
    {
        Detail::create($request->all());

        return redirect()->route('statuses');
    }

    public function edit($id)
    {
        $detail = Detail::find($id);
        $statuses = Status::pluck('name', 'id')->toArray();

        return view('admin.statuses.edit')
            ->with('detail', $detail)
            ->with('statuses', $statuses);
    }

    public function update(Request $request, $id)
    {
        $detail = Detail::find($id);

        $detail->update($request->all());

        return redirect()->route('statuses');
    }

    public function getDetails(Request $request, $id)
    {
        if($request->ajax()) {
            $details = Detail::details($id);
            return response()->json($details);
        }
    }
}
