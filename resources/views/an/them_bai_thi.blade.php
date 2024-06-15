<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p>Đây là trang của admin</p>
                    <br>
                    <p>thêm bài môn {{$ten_mon_hoc}}</p>
                    <br>

                    <form action="{{ route('admin.thembaihoc.submit') }}" method="POST">
                        @csrf
                        <label for="ten">tên bài thi:</label>
                        <input type="text" id="tenbaithi" name="tenbaithi" required>
                        <br>
                        <label for="pass">id mon:</label>
                        <input type="text" id="idmon" name="idmon" value="{{$id_mon}}" required>
                        <br>
                        <label for="email">made:</label>
                        <input type="text" id="made" name="made" required>
                        <br>
                        <label for="email">thời gian:</label>
                        <input type="text" id="time" name="time" required>
                        <br>
                        <button type="submit">thêm môn</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
