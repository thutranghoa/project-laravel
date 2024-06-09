<?php

namespace App\Http\Controllers;

use App\Models\KhiemModels;
use App\Models\Answer;
use App\Models\Question;

use Illuminate\Http\Request;

class KhiemController extends Controller
{
    public function showdata(){
        $students = KhiemModels::all();

        return view('khiem/showdata', compact('students'));
    }

    public function themdulieu_get(){
        return view('khiem/themdulieu');
    }

    public function themdulieu_post(Request $request){
        $validated = $request->validate([
            'ten' => 'required|string|max:255',
            'img' => 'required|string|max:255',
            'gmail' => 'required|string|email|max:255',
        ]);

        KhiemModels::create([
            'ten' => $validated['ten'],
            'img' => $validated['img'],
            'gmail' => $validated['gmail'],
        ]);

        return redirect()->route('themdulieu.get')->with('success', 'Tạo danh mục thành công.');
    }



    public function suadulieu_get($id){
        $student = KhiemModels::findOrFail($id);
        return view('khiem/suadata', compact('student'));
    }

    public function suadulieu_post(Request $request, $id){
        $student = KhiemModels::findOrFail($id);
        $student->update($request->only(['ten', 'img', 'gmail']));
        return redirect()->route('showdata.get')->with('success', 'Dữ liệu đã được cập nhật thành công.');
    }



    public function xoadulieu($id){
        $student = KhiemModels::findOrFail($id);
        $student->delete();
        return redirect()->route('showdata.get')->with('success', 'Dữ liệu đã được xóa thành công.');
    }








    public function showQuestions(){
        // Lấy danh sách câu hỏi và câu trả lời
        $questions = Question::with('answers')->inRandomOrder()->take(5)->get();
        return view('khiem/showcauhoi', compact('questions'));
    }

    public function submitAnswers(Request $request){
        $score = 0;
        $results = [];

        foreach ($request->answers as $questionId => $answerId) {
            $question = Question::with('answers')->find($questionId);
            $selectedAnswer = Answer::find($answerId);
            $isCorrect = $selectedAnswer->is_correct;

            if ($isCorrect) {
                $score++;
            }

            $results[] = [
                'question' => $question,
                'selected_answer' => $selectedAnswer,
                'is_correct' => $isCorrect,
            ];
        }

        return view('khiem.showketqua', compact('score', 'results'));
    }



}
