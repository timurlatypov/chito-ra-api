@extends('layouts.app')

@section('content')
    <div class="rounded-t mb-0 p-8 border-0">

        <div class="uppercase tracking-wide bg-blue-200 text-gray-700 text-md font-bold p-4 mb-8 rounded">
            ЗАКАЗ №{{ $order->id }}
        </div>
        <div class="w-full">
            <div class="block uppercase tracking-wide text-gray-700 text-md font-bold mb-4">
                Клиент
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="text-sm block uppercase tracking-wide text-gray-600 font-bold mb-2"
                           for="name">
                        Имя
                    </label>
                    <input disabled
                           class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-2 px-3 mb-2 leading-tight"
                           id="name"
                           value="{{ $order->user->name }}"
                           type="text"
                           placeholder="">
                </div>
                <div class="w-full md:w-1/3 px-3">
                    <label class="text-sm block uppercase tracking-wide text-gray-600 font-bold mb-2"
                           for="phone">
                        Телефон
                    </label>
                    <input disabled
                           class="text-sm appearance-none block w-full bg-gray-200 text-gray-700 rounded py-2 px-3 mb-2 leading-tight"
                           id="phone"
                           value="{{ $order->user->phone }}"
                           type="text"
                           placeholder="">
                </div>
                <div class="w-full md:w-1/3 px-3">
                    <label class="text-sm block uppercase tracking-wide text-gray-600 font-bold mb-2"
                           for="email">
                        Email
                    </label>
                    <input disabled
                           class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-2 px-3 mb-2 leading-tight"
                           id="email"
                           value="{{ $order->user->email }}"
                           type="text"
                           placeholder="">
                </div>
            </div>

            <div class="mt-10"></div>

            <div class="block uppercase tracking-wide text-gray-700 text-md font-bold mb-4">
                Доставка
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="text-sm block uppercase tracking-wide text-gray-600 font-bold mb-2"
                           for="address">
                        Адрес
                    </label>
                    <input disabled
                        class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-2 px-3 mb-2 leading-tight"
                        id="address"
                        type="text"
                        value="{{ $order->address->address }}">
                </div>
                <div class="w-full px-3 mt-2">
                    <label class="text-sm block uppercase tracking-wide text-gray-600 font-bold mb-2"
                           for="comment">
                        Комментарий
                    </label>
                    <textarea disabled
                        class="appearance-none block w-full bg-gray-200 text-gray-700 rounded py-2 px-3 mb-2 leading-tight"
                        id="comment"
                        type="text">{{ $order->address->comment }}</textarea>
                </div>
            </div>
        </div>

        <div class="w-full">
            <div class="block uppercase tracking-wide text-gray-700 text-md font-bold mb-4">
                Заказ
            </div>
            <div class="flex flex-wrap mb-6">
                <div class="w-full lg:w-1/2 py-3 mb-6 md:mb-0 bg-gray-200 rounded">
                    <table class="items-center w-full bg-transparent border-collapse">
                        <thead>
                        <tr>
                            <th class="px-6 text-gray-600 align-middle py-3 text-xs uppercase whitespace-no-wrap font-semibold text-left">
                                Картинка
                            </th>
                            <th class="px-6 text-gray-600 align-middle py-3 text-xs uppercase whitespace-no-wrap font-semibold text-left">
                                Наименование
                            </th>
                            <th class="px-6 text-gray-600 align-middle py-3 text-xs uppercase whitespace-no-wrap font-semibold text-left">
                                Кол-во
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($order->products as $item)
                            <tr>
                                <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-no-wrap p-4">
                                    <img class="w-24 rounded" src="https://api.chito-ra.ru/storage/{{ $item->product->images->first()->name }}">
                                </td>
                                <td class="border-t-0 px-6 align-middle font-bold border-l-0 border-r-0 whitespace-no-wrap p-4">
                                    {{ $item->product->name }}
                                </td>
                                <td class="border-t-0 px-6 align-middle font-bold border-l-0 border-r-0 whitespace-no-wrap p-4">
                                    {{ $item->pivot->quantity }} шт.
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="w-full lg:w-1/2 py-3 mb-6 md:mb-0">
                    <div class="px-3 lg:px-10 py-3">

                        <h4 class="uppercase text-gray-700 text-md font-bold mb-2">Статус</h4>
                        {!! $order->status_with_color !!}

                        <div class="mt-10"></div>

                        <h4 class="uppercase text-gray-700 text-md font-bold mb-2">Общая стоимость</h4>
                        {!! $order->formattedSubtotal !!}

                        <div class="mt-6"></div>

                        <h4 class="uppercase text-gray-700 text-md font-bold mb-2">Доставка</h4>
                        <p>0</p>

                        <div class="mt-6"></div>

                        <h4 class="uppercase text-gray-700 text-md font-bold mb-2">Итого</h4>
                        <p>0</p>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
