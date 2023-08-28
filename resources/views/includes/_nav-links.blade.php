<div class="flex flex-col justify-between h-screen pb-8 fixed w-60">
    <ul>
        <li class="flex items-center">
        <span class="mb-7">
            <img src="{{asset('/img/logo/32x32.svg')}}" alt="logo">
        </span>
        </li>
        <li class="flex items-center mb-7">
        <span class="mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
        </span>
            <a class="font-bold text-2xl" href="{{route('/')}}">
                Главная
            </a>
        </li>
        <li class="flex items-center mb-7">
        <span class="mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
        </span>
            <a class="font-bold text-2xl">
                Explore
            </a>
        </li>
        <li class="flex items-center mb-7">
        <span class="mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
        </span>
            <a class="font-bold text-2xl">
                Notifications
            </a>
        </li>
        <li class="flex items-center mb-7">
        <span class="mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z" />
            </svg>
        </span>
            <a class="font-bold text-2xl">
                Lists
            </a>
        </li>
        <li class="flex items-center mb-7">
        <span class="mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
        </span>
            <a class="font-bold text-2xl" href="{{route('profile.profile', auth()->user()->username)}}">
                Профиль
            </a>
        </li>
    </ul>
    <div id="dropdownProfileButton" data-dropdown-toggle="dropdownProfile" class="flex items-center px-4 py-3 w-full rounded-full hover:bg-slate-900 cursor-pointer">
        @if(auth()->user()->avatar)
            <img class="w-8 h-8 rounded-full mr-2 object-cover" src="{{auth()->user()->getAvatarLink()}}" alt="avatar">
        @else
            <img class="w-8 h-8 rounded-full mr-2 object-cover" src="{{asset('img/default/default-avatar.svg')}}" alt="avatar">
        @endif
        <div class="flex flex-col items-start justify-center">
            <h5 class="font-bold text-base">Максим Сеин</h5>
            <span class="text-slate-500 text-xs">@deekep</span>
        </div>
    </div>
    <div id="dropdownProfile" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
        <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
            <div class="font-medium ">{{auth()->user()->name}}</div>
            <div class="truncate">{{auth()->user()->email}}</div>
        </div>
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
            <li>
                <a href="{{route('settings.settings')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Настройки</a>
            </li>
        </ul>
        <div class="py-2">
            <a href="{{route('logout')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Выйти</a>
        </div>
    </div>
</div>
