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
                    {{ __("You're logged in!") }}
                    <table class="min-w-full divide-y divide-gray-200">
                        <br>
                        <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tên bài Nghe
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Thời gian
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($danhsachbainghes as $danhsanhbainghe)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                        {{$danhsanhbainghe->exercise_name}}                                
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <p>{{$danhsanhbainghe->time}} phút</p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{route("quiznghe.show",['id_mon' => $danhsanhbainghe->id_mon, 'ma_de' => $danhsanhbainghe->ma_de, 'id_audio' => $danhsanhbainghe->ma_de])}}">
                                        <button type="button">Bắt đầu làm bài</button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
