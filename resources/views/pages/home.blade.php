@extends('layouts/default')

@section('title', 'home')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="flex h-full">
            <div class="text-white w-3/12 pt-4 px-8">
                <ul class="fixed">
                    <li class="flex items-center">
                        <span class="mb-7 block">
                            <img src="{{asset('/img/logo/32x32.svg')}}" alt="logo">
                        </span>
                    <li class="flex items-center"><a class="font-bold text-2xl mb-7 block">Home</a></li>
                    <li class="flex items-center"><a class="font-bold text-2xl mb-7 block">Explore</a></li>
                    <li class="flex items-center"><a class="font-bold text-2xl mb-7 block">Notifications</a></li>
                    <li class="flex items-center"><a class="font-bold text-2xl mb-7 block">Lists</a></li>
                    <li class="flex items-center"><a class="font-bold text-2xl mb-7 block">Profile</a></li>
                </ul>
            </div>
            <div class="text-white w-5/12 pt-4 h-full border-r border-l border-gray-700">
                <div class="flex flex-col items-center border-b border-gray-700">
                    <div class="px-8 mb-4 self-start">
                        <h1 class="text-xl font-bold">Главная</h1>
                    </div>
                    <ul class="flex flex-nowrap justify-between -mb-px text-sm font-medium text-center w-full" role="tablist">
                        <li class="mr-2 w-1/2" role="button">
                            <button class="inline-block p-4 border-b-4 font-bold border-cyan-300 rounded-t-lg" type="button" role="tab" aria-controls="profile" aria-selected="false">Подписки</button>
                        </li>
                        <li class="mr-2 w-1/2">
                            <button class="inline-block p-4 text-slate-600 font-bold rounded-t-lg" disabled type="button" role="tab" aria-controls="profile" aria-selected="false">Для вас </button>
                        </li>
                    </ul>
                </div>
                <form id="create_post_form" action="{{route('posts.create')}}" method="POST" class="flex flex-col item-center border-b border-gray-700 px-4 pt-4 pb-2">
                    @csrf
                    <div class="flex">
                        <img class="w-10 h-10 rounded-full mr-4" src="https://i.pravatar.cc/40" alt="avatar">
                        <textarea minlength="5" maxlength="255" name="text" class="block p-2.5 w-full text-xl dark:bg-transparent dark:placeholder-gray-400
                            dark:text-white border-0 focus:ring-0 resize-none overflow-hidden h-fit" placeholder="Что произошло?!"></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="text-white font-medium rounded-full text-sm px-5 py-2.5
                            dark:bg-cyan-600 dark:hover:bg-cyan-700 focus:outline-none dark:focus:ring-cyan-800">Опубликовать</button>
                    </div>
                </form>
                <div id="posts" class="flex items-center flex-col">
                </div>
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
@endsection

@section('scripts')
    <script>getPosts();</script>
@endsection
