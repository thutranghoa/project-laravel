<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Result;



class ResultController extends Controller
{
    public function index(Request $request)
    {
        // $results = Result::with('exercise', 'user')->get();
        // return view('admin.studentResults', compact('results'));

        $sortField = $request->input('sortField', 'id'); // Default sort field
        $sortOrder = $request->input('sortOrder', 'asc'); // Default sort order

        $results = Result::with(['user', 'exercise'])
            ->orderBy($sortField, $sortOrder)
            ->get();

        if ($request->ajax()) {
            return view('admin.partials.studentResults', compact('results'))->render();
        }

        return view('admin.studentResults', compact('results', 'sortField', 'sortOrder'));
    }

    

    public function deleteResult(Request $request)
    {
        $result = Result::find($request->id);
        $result->delete();
        return response()->json(['success' => true, 'msg' => 'Result deleted successfully'], 200);
    }
}
