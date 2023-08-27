@extends('layouts/default')

@section('title', "Настройки аккаунта")

@section('content')
    <div class="flex flex-col items-center pt-4">
        <div class="px-8 mb-4 self-start">
            <h1 class="text-xl font-bold">Настройки аккаунта</h1>
        </div>
       <div class="flex flex-col w-full p-8">
           <form id="update_info_form" class="flex flex-col" action="{{route('settings.newinfo')}}" method="POST">
               @csrf
               <header class="mb-4 self-start">
                   <h5 class="text-lg font-bold">Основное</h5>
               </header>
               <div class="mb-6">
                   <label for="new_username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Имя пользователя</label>
                   <input type="text" id="new_username" name="username" class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg
                        focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5"
                          placeholder="Имя пользователя" minlength="3" maxlength="25" value="{{auth()->user()->username}}" required>
               </div>
               <div class="mb-6">
                   <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Электронная почта</label>
                   <input type="email" id="email" class="cursor-not-allowed bg-gray-700 border border-gray-600 text-slate-500 text-sm rounded-lg
                        focus:ring-cyan-500 focus:border-cyan-500 block w-full p-2.5"
                          placeholder="Имя пользователя" minlength="3" maxlength="25" value="{{auth()->user()->email}}" disabled>
               </div>
               <button type="submit" class="w-1/3 self-end text-white font-medium rounded-full text-sm px-5 py-2.5 mb-6
                            dark:bg-cyan-600 dark:hover:bg-cyan-700 focus:outline-none dark:focus:ring-cyan-800">Сохранить</button>
           </form>
           <form id="new_password_form" class="flex flex-col" action="{{route('settings.newpassword')}}" method="POST">
               @csrf
               <header class="mb-4 self-start">
                   <h5 class="text-lg font-bold">Пароль</h5>
               </header>
               <div class="mb-6">
                   <label for="current_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Текущий пароль</label>
                   <input type="password" autocomplete="off" id="current_password" name="current_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                        focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600
                        dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                          placeholder="••••••••" minlength="8" maxlength="255" required>
               </div>
               <div class="mb-6">
                   <label for="new_password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Новый пароль</label>
                   <input type="password" autocomplete="off" id="new_password" name="new_password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                        focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600
                        dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                          placeholder="••••••••" minlength="8" maxlength="255" required>
               </div>
               <div class="mb-6">
                   <label for="new_password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Подтверждение пароля</label>
                   <input type="password" autocomplete="off" id="new_password_confirmation" name="new_password_confirmation" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                        focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600
                        dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                          placeholder="••••••••" minlength="8" maxlength="255" required>
               </div>
               <button type="submit" class="w-1/3 self-end text-white font-medium rounded-full text-sm px-5 py-2.5 mb-6
                            dark:bg-cyan-600 dark:hover:bg-cyan-700 focus:outline-none dark:focus:ring-cyan-800">Сохранить</button>
           </form>
       </div>
    </div>
@endsection
