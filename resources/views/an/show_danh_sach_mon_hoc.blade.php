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
                    <table class="min-w-full divide-y divide-gray-200">
                        <br>
                        <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tên Môn Học
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Mô Tả
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($danhsachmonhocs as $danhsachmonhoc)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{route('admin.thembaihoc.show',['id_mon'=> $danhsachmonhoc->id])}}">
                                        {{$danhsachmonhoc->name}}
                                    </a>
                                    
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="">
                                        {{$danhsachmonhoc->description}}
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
