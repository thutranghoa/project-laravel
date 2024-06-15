<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


use App\Models\KhiemModels;
use App\Models\Answer;
use App\Models\Question;
use App\Models\quiz;
use App\Models\AudioFile;
use App\Models\danhsachmonhoc;
use App\Models\danhsachbaihoc;
use App\Models\ExamHistory;


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







    public function listmonhoc(){
        $danhsachmonhocs = quiz::all();
        return view('khiem/show_danh_sach_mon_hoc', compact('danhsachmonhocs'));
    }


    public function listbaihoc($id_mon){
        $danhsachbaihocs = danhsachbaihoc::where('id_mon', $id_mon)->get();
        return view('khiem/show_danh_sach_bai_hoc', compact('danhsachbaihocs'));
    }


    

    public function showQuestions($id_mon, $ma_de, Request $request){
        $socauhoi = 10;
        $questions = Question::with('answers')->inRandomOrder()->where(['quiz_id' => $id_mon, 'exercise_id' => $ma_de])->take($socauhoi)->get();
        $exercises = DanhSachBaiHoc::where(['id_mon' => $id_mon, 'ma_de' => $ma_de])->first();
        $time = $exercises->time;

        $id_exercise = $exercises->id;

        return view('khiem/showcauhoi', compact('questions','socauhoi', 'time', 'id_exercise'));
    }


    public function submitAnswers($id_exercise, Request $request){
        //dd($request->all());

        $requestData = $request->all();
        $content = json_encode($requestData);

        $score = 0;
        $results = [];

        $tongcauhoi = count($request->answers);

        $elapsedTime = $request->input('elapsedTime');
        $minutes = floor($elapsedTime / 60);
        $remainingSeconds = $elapsedTime % 60;
        if ($minutes < 10) {
            $minutes = '0'.$minutes;
        } 
        if ($remainingSeconds < 10) {
            $remainingSeconds = '0'.$remainingSeconds;
        } 
        $time = $minutes.':'.$remainingSeconds;

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

        $userId = Auth::id();

            ExamHistory::create([
                'user_id' =>  $userId,
                'exam_id' => $id_exercise,
                'score' => $score,
                'exam_duration' => $time,
                'content'=> $content

            ]);

        return view('khiem.showketqua', compact('score', 'results', 'tongcauhoi'));
    }



    
    public function show_question_audio($id){
        $audioFile = AudioFile::find($id);

        if (!$audioFile) {
            abort(404, 'Audio file not found.');
        }

        $socauhoi = 10;
        $questions = Question::with('answers')->where('quiz_id', 9)->take($socauhoi)->get();

        return view('khiem.showcauhoiaudio', compact('audioFile','questions','socauhoi'));
    }


    public function historical_details($exam_historie_id, $exercise_name){


        $ExamHistory = ExamHistory::find($exam_historie_id);
        $content = json_decode($ExamHistory->content, true); // Chuyển đổi JSON thành mảng
    
        $score = 0; // Khởi tạo biến $score
        $results = []; // Khởi tạo mảng $results

        foreach ($content['answers'] as $questionId => $answerId) {
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
        return view('khiem.showchitietlichsu', compact('score', 'results', 'exercise_name'));
    }




}
