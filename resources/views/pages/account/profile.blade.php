@extends('layouts/default')

@section('title', "$user->name (@$user->username)")

@section('modals')
    @if(auth()->user()->is($user))
        <div id="edit_profile-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-slate-950">
                <form id="edit_profile_form" action="{{route('profile.edit')}}" method="POST" class="flex flex-col">
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
                    <div class="relative h-48">
                        @if($user->banner)
                            <img class="h-48 w-full object-cover" id="banner_preview" data-user-banner-link="{{$user->getBannerLink()}}" src="{{$user->getBannerLink()}}" alt="banner">
                        @else
                            <img class="h-48 w-full object-cover" id="banner_preview" src="{{asset('img/default/default-banner.svg')}}" alt="banner">
                        @endif
                        <div class="flex h-48 justify-center items-center -mt-48" id="banner_controls">
                            <label for="banner_input" class="bg-transparent flex items-center justify-center cursor-pointer bg-gray-50 ">
                                <span class="flex items-center justify-center bg-gray-900 hover:bg-opacity-90 w-12 h-12 mr-2 text-gray-200 bg-opacity-50 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>
                                </span>
                                <input id="banner_input" name="banner" type="file" class="hidden" accept="image/png, image/jpeg" />
                            </label>
                            @if($user->banner)
                                <label for="delete_banner" class="cursor-pointer">
                                    <span class="flex items-center justify-center bg-gray-900 w-12 h-12 ml-2 text-gray-200 bg-opacity-50 hover:bg-opacity-90 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </span>
                                    <input id="delete_banner" name="delete_banner" type="checkbox" class="hidden">
                                </label>
                            @endif
                        </div>
                    </div>
                    <div class="relative pl-4 -mt-16 h-28">
                        @if($user->avatar)
                            <img class="w-28 h-28 ring ring-slate-950 rounded-full object-cover" id="avatar_preview" src="{{$user->getAvatarLink()}}" alt="Rounded avatar">
                        @else
                            <img class="w-28 h-28 ring ring-slate-950 rounded-full object-cover" id="avatar_preview" src="{{asset('img/default/default-avatar.svg')}}" alt="avatar">
                        @endif
                        <div class="flex h-28 justify-start items-center -mt-28 pl-8">
                            <label for="avatar_input" class="bg-transparent flex flex items-center justify-center cursor-pointer bg-gray-50">
                                <span class="flex items-center justify-center bg-gray-900 w-12 h-12 text-gray-200 bg-opacity-50 hover:bg-opacity-90 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>
                                </span>
                                <input id="avatar_input" name="avatar" type="file" class="hidden" />
                            </label>
                        </div>
                    </div>
                    <div class="flex flex-col w-full items-center justify-center p-4">
                        @csrf
                        <div class="w-full mb-4">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Имя</label>
                            <input type="text" name="name" autocomplete="off" id="name" placeholder="Джон Дое" value="{{$user->name}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <div class="w-full mb-4">
                            <label for="bio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Описание</label>
                            <textarea type="text" minlength="5" maxlength="255" name="bio" autocomplete="off" id="bio" placeholder="Описание" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">{{$user?->bio}}</textarea>
                        </div>
                        <div class="w-full mb-4">
                            <label for="website" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Сайт</label>
                            <input type="text" name="website" autocomplete="off" id="website" placeholder="Ссылка на Ваш сайт" value="{{$user?->website}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                        </div>
                        <button type="submit" class="w-full text-white focus:ring-4 bg-cyan-500 hover:bg-cyan-600 focus:outline-none focus:bg-cyan-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
@endsection

@section('content')
    <header class="border-b border-gray-700">
        @if($user->banner)
            <img class="h-48 w-full object-cover" id="profile_banner" src="{{$user->getBannerLink()}}" alt="banner">
        @else
            <img class="h-48 w-full object-cover" id="profile_banner" src="{{asset('img/default/default-banner.svg')}}" alt="banner">
        @endif
        <div class="flex justify-between">
            <div class="flex -mt-16 pl-4">
                @if($user->avatar)
                    <img class="w-32 h-32 ring ring-slate-950 rounded-full object-cover" id="profile_avatar" src="{{$user->getAvatarLink()}}" alt="Rounded avatar">
                @else
                    <img class="w-32 h-32 ring ring-slate-950 rounded-full object-cover" id="profile_avatar" src="{{asset('img/default/default-avatar.svg')}}" alt="Rounded avatar">
                @endif
            </div>
            @if(auth()->user()->is($user))
                <div class="flex items-start justify-center p-4">
                    <button data-modal-target="edit_profile-modal" data-modal-toggle="edit_profile-modal" class="px-4 py-2 font-medium text-sm border-2 border-gray-500
                         bg-transparent text-white rounded-full shadow-sm hover:bg-slate-900">
                            Редактировать профиль
                    </button>
                </div>
            @else
                <form id="follow_user_form" class="flex items-start justify-center p-4" action="{{$user->profileLink()}}/follow" method="POST">
                    @csrf
                    @if(auth()->user()->isFollowing($user))
                        <button type="submit" class="px-4 py-2 font-medium text-sm
                         bg-transparent border border-slate-500 text-white rounded-full shadow-sm hover:bg-slate-800">
                            Отписаться
                        </button>
                    @else
                        <button type="submit" class="px-4 py-2 font-medium text-sm
                            bg-cyan-600 text-white rounded-full shadow-sm hover:bg-cyan-700">
                            Подписаться
                        </button>
                    @endif
                </form>
            @endif
        </div>
        <div class="flex flex-col px-4 pt-4">
            <div class="mb-2">
                <h5 class="font-bold text-xl" id="profile_name">{{$user->name}}</h5>
                <span class="text-slate-500 text-sm" id="profile_username">{{'@'.$user->username}}</span>
            </div>
            <div class="mb-4">
                <p class="text-gray-200" id="profile_bio">{!!nl2br($user->bio)!!}</p>
            </div>
            <div>
                <div class="flex text-slate-500 text-sm">
                    @if($user->website)
                        <div class="flex mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" />
                            </svg>
                            <a class="ml-1 text-cyan-400 hover:text-cyan-600" href="{{$user->website}}">
                                {{$user->website}}
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
            <ul class="flex flex-nowrap justify-between -mb-px text-sm font-medium text-center w-full" id="tabs" data-tabs-toggle="#tabs_content" role="tablist">
                <li class="mr-2 w-1/2 cursor-pointer" role="presentation">
                    <button id="main_tab-tab" data-tabs-target="#main_tab" class="inline-block p-4 font-bold rounded-t-lg" type="button" role="tab" aria-selected="false">Посты</button>
                </li>
                <li class="mr-2 w-1/2" role="presentation">
                    <button id="follows_tab-tab" data-tabs-target="#follows_tab" class="inline-block p-4 text-slate-600 font-bold rounded-t-lg" type="button" role="tab" aria-selected="false">Подписки</button>
                </li>
                <li class="mr-2 w-1/2" role="presentation">
                    <button id="followers_tab-tab" data-tabs-target="#followers_tab" class="inline-block p-4 text-slate-600 font-bold rounded-t-lg" type="button" role="tab" aria-selected="false">Подписчики</button>
                </li>
            </ul>
        </div>
    </header>
    <div id="tabs_content">
        <div id="main_tab">
            @if(auth()->user()->is($user))
                <form id="create_post_form" action="{{route('posts.create')}}" method="POST" class="flex flex-col item-center border-b border-gray-700 px-4 pt-4 pb-2">
                @csrf
                <div class="flex">
                    @if(auth()->user()->avatar)
                        <img class="w-10 h-10 rounded-full mr-4 object-cover" src="{{auth()->user()->getAvatarLink()}}" alt="avatar">
                    @else
                        <img class="w-10 h-10 rounded-full mr-4 object-cover" src="{{asset('/img/default/default-avatar.svg')}}" alt="avatar">
                    @endif
                    <textarea minlength="5" maxlength="255" name="text" class="block p-2.5 w-full text-xl dark:bg-transparent dark:placeholder-gray-400
                                    dark:text-white border-0 focus:ring-0 resize-none overflow-hidden h-fit" placeholder="Что произошло?!"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="text-white font-medium rounded-full text-sm px-5 py-2.5
                                    dark:bg-cyan-600 dark:hover:bg-cyan-700 focus:outline-none dark:focus:ring-cyan-800">Опубликовать</button>
                </div>
            </form>
            @endif
            <div id="feed" class="flex items-center flex-col"></div>
        </div>
        <div id="follows_tab">
            <div class="flex flex-col w-full p-8">
                @php $follows = auth()->user()->follows @endphp
                @forelse($follows as $user)
                    @include('includes/_follows-list', ['isFollowing' => true])  <!--Пользователь точно подписан на своих подписчиков, поэтому true -->
                @empty
                    <div class="flex justify-center items-center">
                        <p class="text-gray-300">У вас нет подписок</p>
                    </div>
                @endforelse
            </div>
        </div>
        <div id="followers_tab">
            <div class="flex flex-col w-full p-8">
                @php $followers = auth()->user()->followers @endphp
                @forelse($followers as $user)
                     @php
                         $isFollowing = $follows->contains($user);
                     @endphp
                    @include('includes/_follows-list', ['isFollowing' => $isFollowing])
                @empty
                    <div class="flex justify-center items-center">
                        <p class="text-gray-300">У вас нет подписок</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>getFeed('/posts/'+ {{$user->id}} +'/get');</script>
@endsection
