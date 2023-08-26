<!DOCTYPE HTML>
<html class="dark" lang="ru">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="copyright" content="Maxim Sein">
    <meta name="author" content="Maxim Sein">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>
</head>
<body class="dark dark:bg-slate-950 min-h-screen">
<div id="toasts" class="fixed right-5 pt-5 z-50"></div>
<section class="px-32 min-h-screen">
    <main class="container mx-auto min-h-screen">
        @yield('modals')
        <div class="max-w-7xl mx-auto min-h-screenl">
            <div class="flex min-h-screen">
                <div class="text-white w-3/12 pt-4 px-8">
                    @include('includes/_nav-links')
                </div>
                <div class="text-white w-6/12 min-h-screen border-r border-l border-gray-700">
                    @yield('content')
                </div>
                <div class="text-white w-4/12 pt-4 px-8 col-end-1">
                    <form class="mb-4">
                        <label for="search" class="mb-2 text-sm font-medium sr-only dark:text-white">Поиск</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="search" id="search" class="block w-full p-3 pl-12 text-sm border
                        rounded-full bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Поиск" required>
                        </div>
                    </form>
                    <div class="flex flex-col max-w-sm p-6 bg-white border border-gray-200 rounded-2xl shadow dark:bg-gray-800 dark:border-gray-700">
                        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">Подписки</h5>
                        <ul>
                            @foreach(auth()->user()->follows->take(5) as $user)
                                @include('includes/_follows-list')
                            @endforeach
                        </ul>
                        <a href="#" class="text-sm self-center text-cyan-300 hover:text-cyan-600">Посмотреть всех</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="{{asset('js/script.js')}}"></script>
@yield('scripts')
</body>
</html>
