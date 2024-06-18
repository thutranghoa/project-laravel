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
                    <p>bạn chưa phải là vip hãy nạp lần đầu để trở thành vip</p>
                    <form action="{{ route('thanhtoan.submit') }}" method="POST">
                        @csrf
                        <button type="submit" name = "redirect">bấm vào đây để thực hiện thanh toán</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>