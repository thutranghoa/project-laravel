<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use Illuminate\Support\Facades\Log;


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
        $subject->title = $request->description;
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

        if ($subject) {
            $subject->name = $request->name;
            $subject->title = $request->description;
    
            $subject->save();
    
            return response()->json(['success' => true, 'msg' => 'Subject updated successfully']);
        } else {
            Log::error('Subject not found with ID:', ['id' => $request->id]);

            return response()->json(['success' => false, 'msg' => 'Subject not found']);
        }
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
                            ->orWhere('description', 'LIKE', "%{$search}%")
                            ->get();

        if ($request->ajax()) {
            return response()->json($subjects);
        }

        return view('admin.subjects.index', compact('subjects'));
    }

}
