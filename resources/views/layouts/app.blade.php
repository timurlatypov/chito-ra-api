<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e0db9310a8.js" crossorigin="anonymous"></script>
</head>
<body class="bg-gray-100 h-screen antialiased leading-none">
    <div id="app">
        <div>
            @include('admin.partials.sidebar')
            <div class="relative md:ml-64 bg-gray-200">
            @include('admin.partials.navbar')
                <!-- Header -->
                <div class="relative bg-blue-600 md:pt-32 pb-32 pt-12">
                    <div class="px-4 md:px-10 mx-auto w-full">
                        <div>
                            <!-- Card stats -->
                            <div class="flex flex-wrap">
                                <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                                    <div
                                        class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                                        <div class="flex-auto p-4">
                                            <div class="flex flex-wrap">
                                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                                    <h5 class="text-gray-500 uppercase font-bold text-xs">
                                                        Traffic
                                                    </h5>
                                                    <span class="font-semibold text-xl text-gray-800">350,897</span>
                                                </div>
                                                <div class="relative w-auto pl-4 flex-initial">
                                                    <div
                                                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-red-500">
                                                        <i class="far fa-chart-bar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-sm text-gray-500 mt-4">
                                              <span class="text-green-500 mr-2">
                                                <i class="fas fa-arrow-up"></i> 3.48%</span>
                                                <span class="whitespace-no-wrap"> Since last month</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                                    <div
                                        class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                                        <div class="flex-auto p-4">
                                            <div class="flex flex-wrap">
                                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                                    <h5 class="text-gray-500 uppercase font-bold text-xs">
                                                        New users
                                                    </h5>
                                                    <span class="font-semibold text-xl text-gray-800">
                              2,356
                            </span>
                                                </div>
                                                <div class="relative w-auto pl-4 flex-initial">
                                                    <div
                                                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-orange-500">
                                                        <i class="fas fa-chart-pie"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-sm text-gray-500 mt-4">
                          <span class="text-red-500 mr-2">
                            <i class="fas fa-arrow-down"></i> 3.48%
                          </span>
                                                <span class="whitespace-no-wrap">
                            Since last week
                          </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                                    <div
                                        class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                                        <div class="flex-auto p-4">
                                            <div class="flex flex-wrap">
                                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                                    <h5 class="text-gray-500 uppercase font-bold text-xs">
                                                        Sales
                                                    </h5>
                                                    <span class="font-semibold text-xl text-gray-800">
                              924
                            </span>
                                                </div>
                                                <div class="relative w-auto pl-4 flex-initial">
                                                    <div
                                                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-pink-500">
                                                        <i class="fas fa-users"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-sm text-gray-500 mt-4">
                          <span class="text-orange-500 mr-2">
                            <i class="fas fa-arrow-down"></i> 1.10%
                          </span>
                                                <span class="whitespace-no-wrap">
                            Since yesterday
                          </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full lg:w-6/12 xl:w-3/12 px-4">
                                    <div
                                        class="relative flex flex-col min-w-0 break-words bg-white rounded mb-6 xl:mb-0 shadow-lg">
                                        <div class="flex-auto p-4">
                                            <div class="flex flex-wrap">
                                                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                                    <h5 class="text-gray-500 uppercase font-bold text-xs">
                                                        Performance
                                                    </h5>
                                                    <span class="font-semibold text-xl text-gray-800">
                              49,65%
                            </span>
                                                </div>
                                                <div class="relative w-auto pl-4 flex-initial">
                                                    <div
                                                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-blue-500">
                                                        <i class="fas fa-percent"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-sm text-gray-500 mt-4">
                          <span class="text-green-500 mr-2">
                            <i class="fas fa-arrow-up"></i> 12%
                          </span>
                                                <span class="whitespace-no-wrap">
                            Since last month
                          </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="px-4 md:px-10 mx-auto w-full -m-24">
                    <div class="flex flex-wrap mt-4">
                        <div class="w-full mb-12 xl:mb-0 px-4">
                            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                    @include('admin.partials.footer')
                </div>

            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
