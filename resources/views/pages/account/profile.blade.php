@extends('layouts/default')

@section('title', "$user->name (@$user->username)")

@section('modals')
    <div id="edit_profile-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-slate-950">
                <div class="flex flex-col">
                    <header class="flex justify-between items-center px-6 py-4 lg:px-8">
                        <span class="text-white font-bold text-xl">
                            Редактирование профиля
                        </span>
                        <button type="button" class=" text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="edit_profile-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Закрыть окно</span>
                        </button>
                    </header>
                    <div class="flex">
                        <img class="h-48 w-full object-cover" src="https://styles.redditmedia.com/t5_7h4z23/styles/profileBanner_b7chu8dlkr2a1.jpeg" alt="banner">
                    </div>
                    <div class="flex pl-4 -mt-16">
                        <img class="w-28 h-28 ring ring-slate-950 rounded-full" src="https://realsnooker.com/storage/avatars/646d39a1c741ef51e4078554.jpg?1693077421202" alt="Rounded avatar">
                    </div>
                    <form id="edit_profile_form" action="{{route('profile.edit')}}" method="POST" class="flex flex-col w-full items-center justify-center p-4">
                        @csrf
                        <div class="w-full mb-4">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Имя</label>
                            <input type="text" name="name" autocomplete="off" id="name" placeholder="Джон Дое" value="{{$user->name}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <div class="w-full mb-4">
                            <label for="bio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Описание</label>
                            <textarea type="text" minlength="5" maxlength="255" name="bio" autocomplete="off" id="bio" placeholder="Описание" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">{{$profile_info?->bio}}</textarea>
                        </div>
                        <div class="w-full mb-4">
                            <label for="link" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Сайт</label>
                            <input type="text" name="link" autocomplete="off" id="link" placeholder="Ссылка на Ваш сайт" value="{{$profile_info?->link}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                        </div>
                        <button type="submit" class="w-full text-white focus:ring-4 bg-cyan-500 hover:bg-cyan-600 focus:outline-none focus:bg-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <header class="border-b border-gray-700">
        <img class="h-48 w-full object-cover" src="https://styles.redditmedia.com/t5_7h4z23/styles/profileBanner_b7chu8dlkr2a1.jpeg" alt="banner">
        <div class="flex justify-between">
            <div class="flex -mt-16 pl-4">
                <img class="w-32 h-32 ring ring-slate-950 rounded-full" src="https://realsnooker.com/storage/avatars/646d39a1c741ef51e4078554.jpg?1693077421202" alt="Rounded avatar">
            </div>
            @if($user->id === auth()->id())
                <div class="flex items-start justify-center p-4">
                    <button data-modal-target="edit_profile-modal" data-modal-toggle="edit_profile-modal" class="px-4 py-2 font-medium text-sm border-2 border-gray-500
                         bg-transparent text-white rounded-full shadow-sm hover:bg-slate-900">
                            Редактировать профиль
                    </button>
                </div>
            @else
                <form class="flex items-start justify-center p-4" action="{{$user->profileLink()}}/follow" method="POST">
                    @csrf
                    <button class="px-4 py-2 font-medium text-sm
                     bg-cyan-600 text-white rounded-full shadow-sm hover:bg-cyan-700">
                        {{auth()->user()->isFollowing($user) ? 'Отписаться' : 'Подписаться'}}
                    </button>
                </form>
            @endif
        </div>
        <div class="flex flex-col px-4 pt-4">
            <div class="mb-2">
                <h5 class="font-bold text-xl">{{$user->name}}</h5>
                <span class="text-slate-500 text-sm">{{'@'.$user->username}}</span>
            </div>
            @if($profile_info && $profile_info->bio)
            <div class="mb-4">
                <p class="text-gray-200">{!!nl2br($profile_info->bio)!!}</p>
            </div>
            @endif
            <div>
                <div class="flex text-slate-500 text-sm">
                    @if($profile_info && $profile_info->link)
                        <div class="flex mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                            </svg>
                            <a class="ml-1 text-cyan-400 hover:text-cyan-600" href="{{$profile_info->link}}">
                                {{$profile_info->link}}
                            </a>
                        </div>
                    @endif
                    <div class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                        </svg>
                        <span class="ml-1">
                            Присоединился
                            {{$user->created_at->format('m Y')}}
                        </span>
                    </div>
                </div>
            </div>
            <ul class="flex flex-nowrap justify-between -mb-px text-sm font-medium text-center w-full" role="tablist">
                <li class="mr-2 w-1/2" role="button">
                    <button class="inline-block p-4 border-b-4 font-bold border-cyan-300 rounded-t-lg" type="button" role="tab" aria-controls="profile" aria-selected="false">Посты</button>
                </li>
                <li class="mr-2 w-1/2">
                    <button class="inline-block p-4 text-slate-600 font-bold rounded-t-lg" disabled type="button" role="tab" aria-controls="profile" aria-selected="false">Подписки</button>
                </li>
                <li class="mr-2 w-1/2">
                    <button class="inline-block p-4 text-slate-600 font-bold rounded-t-lg" disabled type="button" role="tab" aria-controls="profile" aria-selected="false">Подписчики</button>
                </li>
            </ul>
        </div>
    </header>
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
@endsection

@section('scripts')
    <script>getPosts({{$user->id}});</script>
@endsection
