<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\KhiemModels;
use App\Models\Answer;
use App\Models\Question;
use App\Models\quiz;
use App\Models\AudioFile;
use App\Models\danhsachmonhoc;
use App\Models\danhsachbaihoc;
use App\Models\ExamHistory;
use App\Models\Exercise;




class AnController extends Controller
{
    public function listmonhoc(){
        $danhsachmonhocs = quiz::all();
        return view('an/show_danh_sach_mon_hoc', compact('danhsachmonhocs'));
    }



    public function thembaithiget($id_mon){
        $mon_hoc = quiz::where('id', $id_mon)->first();
        $ten_mon_hoc = $mon_hoc->name;
        $id_mon = $mon_hoc->id;

        return view('an/them_bai_thi', compact('ten_mon_hoc','id_mon'));
    }

    public function submitBaiThi(Request $request)
    {
        $ten_bai_thi = $request->input('tenbaithi');
        $id_mon = $request->input('idmon');
        $ma_de = $request->input('made');
        $thoi_gian = $request->input('time');


        Exercise::create([
            'exercise_name' => $ten_bai_thi,
            'id_mon' => $id_mon,
            'ma_de' => $ma_de,
            'time' => $thoi_gian
        ]);

    
        return redirect()->route('admin.monhoc.show')->with('success', 'Bài thi đã được thêm thành công!');
    }



}
