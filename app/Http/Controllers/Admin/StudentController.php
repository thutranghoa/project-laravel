<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
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
        $students = User::paginate(10); // Fetch 10 students per page
        return view('admin.studentDashboard',  ['students' => $students]);
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
            return response()->json(['success' => false, 'msg' => 'Image upload failed'], 400);
        }
        $student->save();

        // chua gui duoc mail
        $data = [
            'name' => $student->name,
            'email' => $student->email,
            'password' => $student->password,
        ];

        // Mail::send('admin.verifyMail', $data, function ($message) use ($data) {
        //     $message->to($data['email'], $data['name'])->subject('Welcome to our school');
        // });

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
                Storage::delete($student->image);
            }
            $imagePath = $request->file('image')->store('public/images');
            $student->image = basename($imagePath);
        }

        $student->save();

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
