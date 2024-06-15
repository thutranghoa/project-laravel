<style>
    body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 96%;
            border-collapse: collapse;
            margin: 10px 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .name-column {
            width: 30%;
        }
        .exam-column {
            width: 50%;
        }
        .score-column {
            width: 20%;
        }
        caption {
            font-size: 1.5em;
            margin-bottom: 10px;
        }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="">
                    <h2>Lịch sử làm bài</h2>
                    <table border="1">
                        <tr>
                            <th>Tên</th>
                            <th>Bài thi</th>
                            <th>Điểm</th>
                            <th>thơi gian làm bài</th>
                            <th>ngày làm bài</th>
                            <th>Xem chi tiết bài làm</th>

                        </tr>
                        @foreach ($exam_histories as $exam_historie)
                            <tr>
                                <td>{{$name}}</td>
                                <td>{{ $exam_historie->exercise->exercise_name }}
                                <td>{{$exam_historie->score}}</td>
                                <td>{{$exam_historie->exam_duration}}</td>
                                <td>{{$exam_historie->created_at}}</td>
                                <td><a href="{{ route('historicaldetails.show', ['exam_historie_id'=> $exam_historie->id, 'exercise_name'=>$exam_historie->exercise->exercise_name]) }}">Chi tiết</a></td>
                            </tr>
                        @endforeach
                    </table>

                    
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
