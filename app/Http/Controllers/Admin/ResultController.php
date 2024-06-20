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

        $sortField = $request->input('sortField', 'id'); 
        $sortOrder = $request->input('sortOrder', 'asc'); 

        $sortableFields = [
            'id',
            'user_id',
            'user.name',
            'exam_id',
            'exercise.exercise_name',
            'score',
            'exam_duration',
            'updated_at'
        ];

        $results = Result::with(['user', 'exercise'])
            ->when($sortField == 'exercises.exercise_name', function ($query) use ($sortOrder) {
                // Sort by exercise_name field using relationship
                return $query->leftJoin('exercises', 'exam_histories.exam_id', '=', 'exercises.id')
                    ->orderBy('exercises.exercise_name', $sortOrder);
            })
            ->when($sortField == 'user.name', function ($query) use ($sortOrder) {
                // Sort by username field using relationship
                return $query->leftJoin('users', 'exam_histories.user_id', '=', 'users.id')
                    ->orderBy('users.name', $sortOrder);
            }, function ($query) use ($sortField, $sortOrder) {
                // Default sorting for other fields
                return $query->orderBy($sortField, $sortOrder);
            })
            ->get();

        if ($request->ajax()) {
            return view('admin.studentResults', compact('results'))->render();
        }

        return view('admin.studentResults', compact('results', 'sortField', 'sortOrder'));
    }

    

    public function deleteResult(Request $request)
    {
        $result = Result::find($request->id);
        $result->delete();
        return response()->json(['success' => true, 'msg' => 'Result deleted successfully'], 200);
    }

    public function searchResults(Request $request)
    {
        $search = $request->search;
        $results = Result::with('exercise', 'user')
            ->whereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->orWhereHas('exercise', function ($query) use ($search) {
                $query->where('exercise_name', 'like', '%' . $search . '%');
            })
            ->orWhere('score', 'like', '%' . $search . '%')
            ->orWhere('exam_duration', 'like', '%' . $search . '%')
            ->orWhere('updated_at', 'like', '%' . $search . '%')
            ->get();

        if ($request->ajax()) {
            return response()->json($results);
        }

        return view('admin.studentResults', compact('results'));
    }


}
