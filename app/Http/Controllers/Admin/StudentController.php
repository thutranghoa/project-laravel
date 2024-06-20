<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentEdited;
use Illuminate\Support\Str;
use App\Models\Subject;
use App\Models\User;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = User::all();
        return view('admin.studentDashboard',  compact('students'));
    }

    public function addStudent(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users,email',
        // ]);

        $student = new User();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->gender = $request->gender;
        $student->dob = $request->dob;
        $student->phone = $request->phone;

        $student->password = bcrypt(Str::random(8));


        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/images');
            //print imagePath
            $student->image = basename($imagePath);

        } else {
            $student->image = '';

        }
        $student->save();

        // chua gui duoc mail
        $data = [
            'name' => $student->name,
            'email' => $student->email,
            'password' => $student->password,
        ];

        return response()->json(['success' => true, 'msg' => 'Student added successfully']);
    }

    public function editStudent(Request $request)
    {
        // $request->validate([
        //     'id' => 'required|exists:users,id',
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users,email,' . $request->id,
        // ]);

        $student = User::find($request->id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->gender = $request->gender;
        $student->dob = $request->dob;
        $student->phone = $request->phone;


        if ($request->hasFile('image')) {
            if ($student->image) {
                // Storage::delete($student->image);
                Storage::delete('public/images/' . $student->image);
                Log::info('Deleted image: ' . $student->image);
            }
            $imagePath = $request->file('image')->store('public/images');
            $student->image = basename($imagePath);
        }

        $student->save();

        Mail::to($student->email)->send(new StudentEdited($student));


        return response()->json(['success' => true, 'msg' => 'Student updated successfully']);
    }

    
    public function deleteStudent(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
        ]);

        \Log::info('Deleting student with ID: ' . $request->id);

        $student = User::find($request->id);
        
        if ($student) {
            $student->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'msg' => 'Student not found']);
    }

    public function searchStudents(Request $request)
    {
        $search = $request->input('search');

        $students = User::where('id', 'LIKE', "%{$search}%")
                            ->orWhere('name', 'LIKE', "%{$search}%")
                            ->orWhere('email', 'LIKE', "%{$search}%")
                            ->get(); 

        if ($request->ajax()) {
            return response()->json($students);
        }

        return view('admin.studentDashboard', compact('students'));
    }


}
