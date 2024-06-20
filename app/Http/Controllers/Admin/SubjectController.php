<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::all();
        return view('admin.subjectDashboard', compact('subjects'));
    }

    public function addSubject(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'code' => 'required|string|max:255|unique:subjects,code',
        // ]);

        $subject = new Subject();
        $subject->name = $request->name;
        $subject->save();

        return response()->json(['success' => true, 'msg' => 'Subject added successfully']);
    }

    public function editSubject(Request $request)
    {
        // $request->validate([
        //     'id' => 'required|exists:subjects,id',
        //     'name' => 'required|string|max:255',
        //     'code' => 'required|string|max:255|unique:subjects,code,' . $request->id,
        // ]);

        $subject = Subject::find($request->id);
        $subject->name = $request->name;
        $subject->save();

        return response()->json(['success' => true, 'msg' => 'Subject updated successfully']);
    }

    public function deleteSubject(Request $request)
    {
        // $request->validate([
        //     'id' => 'required|exists:subjects,id',
        // ]);

        // \Log::info ($request->id);

        $subject = Subject::find($request->id);
        $subject->delete();

        return response()->json(['success' => true, 'msg' => 'Subject deleted successfully']);
    }

    public function searchSubjects (Request $request)
    {
        $search = $request->input('search');

        $subjects = Subject::where('id', 'LIKE', "%{$search}%")
                            ->orWhere('name', 'LIKE', "%{$search}%")
                            ->get();

        if ($request->ajax()) {
            return response()->json($subjects);
        }

        return view('admin.subjects.index', compact('subjects'));
    }

}
