@extends('layouts.app')

@section('content')
    <div class="rounded-t mb-0 px-4 py-3 border-0">
        <div class="flex flex-wrap items-center">
            <div class="relative w-full px-2 max-w-full flex-grow flex-1">
                <h3 class="font-semibold text-base text-gray-800">Заказы</h3>
            </div>
            <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                <button
                    class="bg-green-500 text-white active:bg-indigo-600 text-xs font-bold uppercase px-3 py-2 rounded outline-none focus:outline-none mr-1 mb-1"
                    type="button"
                    style="transition:all .15s ease">
                    Создать заказ
                </button>
            </div>
        </div>
    </div>
    <div class="block w-full overflow-x-auto">
        <!-- Projects table -->
        <table class="items-center w-full bg-transparent border-collapse">
            <thead>
            <tr>
                <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                    Номер
                </th>
                <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                    Клиент
                </th>
                <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                    Сумма
                </th>
                <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                    Статус
                </th>
                <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                    Дата
                </th>
                <th class="px-6 bg-gray-100 text-gray-600 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-no-wrap font-semibold text-left">
                    Действия
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-no-wrap p-4 text-left">
                        {{ $order->id }}
                    </td>
                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-no-wrap p-4 text-left">
                        {{ $order->user->name }}
                    </td>
                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-no-wrap p-4">
                        {{ $order->formattedSubtotal }}
                    </td>
                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-no-wrap p-4">
                        {!! $order->status_with_color !!}
                    </td>
                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-no-wrap p-4">
                        {{ $order->created_at }}
                    </td>
                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-no-wrap p-4">

                        <a href="{{ route('admin.order.view', $order->id) }}"
                           class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 pl-2 pr-2 rounded mr-2">
                            <i class="fas fa-eye"></i>
                        </a>

                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 pl-2 pr-2 rounded">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
