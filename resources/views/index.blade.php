@extends('layouts/default')

@section('title', 'Y. It`s what`s happening / Y')

@section('content')
    <div id="signin-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-slate-950">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="signin-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Закрыть окно</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Войти в Y</h3>
                    <form class="space-y-6" id="signin_form" action="{{route('signin')}}" method="POST">
                        @csrf
                        <div>
                            <label for="auth_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Адрес электронной почты</label>
                            <input type="email" name="email" id="auth_email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required>
                        </div>
                        <div>
                            <label for="auth_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Пароль</label>
                            <input type="password" autocomplete="off" name="password" id="auth_password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <div class="flex justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" type="checkbox" name="remember" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-cyan-300 dark:bg-gray-600 dark:border-gray-500 dark:focus:ring-cyan-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800">
                                </div>
                                <label for="remember" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Запомнить меня</label>
                            </div>
{{--                            <a href="#" class="text-sm text-blue-700 hover:underline dark:text-blue-500">Забыли пароль?</a>--}}
                        </div>
                        <button type="submit" class="w-full text-white focus:ring-4 bg-cyan-500 hover:bg-cyan-600 focus:outline-none focus:bg-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center disabled:bg-cyan-900">Войти</button>
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                            Нет аккаунта? <a data-modal-target="signup-modal" data-modal-hide="signin-modal" data-modal-toggle="signup-modal" href="javascript:void(0);" class="text-blue-700 hover:underline dark:text-cyan-500">Регистрация</a>
                            <br><br>
                            P.S. Сайт является примером проекта. Если вы не хотите создавать аккаунт, можете использовать тестового пользователя: username: user, password: 123456789
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="signup-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-slate-950">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="signup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Закрыть окно</span>
                </button>
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Регистрация в Y</h3>
                    <form id="signup_form" class="space-y-6" action="{{route('signup')}}" method="POST">
                        @csrf
                        <div>
                            <label for="reg_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Имя</label>
                            <input type="text" name="name" id="reg_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="John Doe" required>
                        </div>
                        <div>
                            <label for="reg_username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Имя пользователя</label>
                            <input type="text" name="username" id="reg_username" placeholder="johndoe" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <div>
                            <label for="reg_email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Адрес электронной почты</label>
                            <input type="email" name="email" id="reg_email" placeholder="name@company.com" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <div>
                            <label for="reg_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Пароль</label>
                            <input type="password" name="password" autocomplete="off" id="reg_password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <button type="submit" class="w-full text-white focus:ring-4 bg-cyan-500 hover:bg-cyan-600 focus:outline-none focus:bg-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Регистрация</button>
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                            P.S. Сайт является примером проекта. Если вы не хотите создавать аккаунт, можете использовать тестового пользователя: username: user, password: 123456789
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="flex">
        <div class="flex-1">
            <div class="h-screen flex items-center justify-center">
                <img alt="logo" class="max-w-5xl" src="{{asset('/img/logo/380x380.svg')}}">
            </div>
        </div>
        <div class="flex-1">
            <div class="h-screen flex justify-center items-center">
                <article class="prose pt-10">
                    <h1 class="text-7xl text-white">В курсе происходяшего</h1>
                    <p class="text-4xl font-bold text-white">Присоединяйтесь сегодня.</p>

                    <div class="flex flex-col space-y-4 justify-center">
                        <button data-modal-target="signup-modal" data-modal-toggle="signup-modal" class="px-4 py-2 w-2/4 font-semibold text-lg bg-cyan-500 text-white rounded-full shadow-sm">
                            Зарегистрироваться
                        </button>
                        <button data-modal-target="signin-modal" data-modal-toggle="signin-modal" class="px-4 py-2 w-2/4 font-semibold text-lg border-2 border-cyan-500
                         bg-transparent text-white rounded-full shadow-sm">
                            Войти
                        </button>
                    </div>
                </article>
            </div>
        </div>
    </div>
@endsection
