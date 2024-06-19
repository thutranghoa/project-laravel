<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


use App\Models\KhiemModels;
use App\Models\Answer;
use App\Models\Question;
use App\Models\quiz;
use App\Models\AudioFile;
use App\Models\danhsachmonhoc;
use App\Models\Exercise;
use App\Models\ExamHistory;
use App\Models\users;


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
        $danhsachmonhocs = quiz::where('id', '!=', 9)->get();
        return view('khiem/show_danh_sach_mon_hoc', compact('danhsachmonhocs'));
    }


    public function listbaihoc($id_mon){
        $danhsachbaihocs = Exercise::where('id_mon', $id_mon)->get();
        return view('khiem/show_danh_sach_bai_hoc', compact('danhsachbaihocs'));
    }


    

    public function showQuestions($id_mon, $ma_de, Request $request){
        $exercises = Exercise::where(['id_mon' => $id_mon, 'ma_de' => $ma_de])->first();
        $id_exercise = $exercises->id;
        $socauhoi = $exercises->num_questions;
        $time = $exercises->time;
        
        $questions = Question::with('answers')->inRandomOrder()->where(['quiz_id' => $id_mon, 'exercise_id' => $ma_de])->take($socauhoi)->get();
        

        

        return view('khiem/showcauhoi', compact('questions','socauhoi', 'time', 'id_exercise'));
    }


    public function submitAnswers($id_exercise, Request $request){
        //dd($request->all());

        $requestData = $request->all();
        $content = json_encode($requestData);

        $score = 0;
        $results = [];

        $exercises = Exercise::where(['id' => $id_exercise])->first();
        $tongcauhoi = $exercises->num_questions;

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
        
        $score = ($score/$tongcauhoi)*10;
        $score = number_format($score, 2);

        ExamHistory::create([
            'user_id' =>  $userId,
            'exam_id' => $id_exercise,
            'score' => $score,
            'exam_duration' => $time,
            'content'=> $content

        ]);

        return view('khiem.showketqua', compact('score', 'results'));
    }



    

    public function historical_details($exam_historie_id, $exercise_name){


        $ExamHistory = ExamHistory::find($exam_historie_id);
        $content = json_decode($ExamHistory->content, true); 
    

        $score = $ExamHistory->score; 
        $results = []; 

        foreach ($content['answers'] as $questionId => $answerId) {
            $question = Question::with('answers')->find($questionId);
            $selectedAnswer = Answer::find($answerId);
            $isCorrect = $selectedAnswer->is_correct;

            if ($isCorrect) {
                $score;
            }

            $results[] = [
                'question' => $question,
                'selected_answer' => $selectedAnswer,
                'is_correct' => $isCorrect,
            ];
        }


        return view('khiem/showchitietlichsu', compact('score', 'results', 'exercise_name'));
    }

    public function baithichovip(){
        return view('khiem/show_danh_sach_bai_tap_vip');
    }


    public function thanhtoanvnpay(){

        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/lam_bai/thanh_toan_thanh_cong";
        $vnp_TmnCode = "D84SB8SQ";//Mã website tại VNPAY 
        $vnp_HashSecret = "XKE6TH3R4VTAC4FXP8BT8XSS20O5YFYU"; //Chuỗi bí mật
        
        //random mã đơn hàng
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $vnp_TxnRef = $randomString; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này 
        $vnp_OrderInfo = "thanh toán hóa đơn";
        $vnp_OrderType = "nap lan đầu";
        $vnp_Amount = 20000 * 100;
        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef 
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
        
    }

    public function thanhtoanthanhcong(){
        $userId = Auth::id();
        $users = users::findOrFail($userId);
        $users->update([
            'role' => 'user_vip'
        ]);
        return view('khiem/thanhtoanthanhcong');
    }

    public function listbainghe($id_mon){
        $danhsachbainghes = Exercise::where('id_mon', $id_mon)->get();
        return view('khiem/vip/show_danh_sach_bai_nghe', compact('danhsachbainghes'));
    }


    public function show_question_audio($id_mon, $ma_de, $id_audio,  Request $request){
        $exercises = Exercise::where(['id_mon' => $id_mon, 'ma_de' => $ma_de])->first();
        $id_exercise = $exercises->id;
        $socauhoi = $exercises->num_questions;
        $time = $exercises->time;
        
        $questions = Question::with('answers')->where(['quiz_id' => $id_mon, 'exercise_id' => $ma_de])->take($socauhoi)->get();
        
        $audioFile = AudioFile::find($id_audio);
        if (!$audioFile) {
            abort(404, 'Audio file not found.');
        }

        return view('khiem/vip/showcauhoiaudio', compact('questions','socauhoi', 'time', 'id_exercise','audioFile'));
    }

/*
    public function show_question_audio($id){
        $audioFile = AudioFile::find($id);

        if (!$audioFile) {
            abort(404, 'Audio file not found.');
        }

        $socauhoi = 10;
        $questions = Question::with('answers')->where('quiz_id', 9)->take($socauhoi)->get();



        return view('khiem.showcauhoiaudio', compact('audioFile','questions','socauhoi'));
    }
*/


}
