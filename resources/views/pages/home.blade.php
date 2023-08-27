@extends('layouts/default')

@section('title', 'Лента')

@section('content')
    <div class="flex flex-col items-center border-b border-gray-700 pt-4">
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
    <div id="posts" class="flex items-center flex-col">
    </div>
@endsection

@section('scripts')
    <script>getFeed();</script>
@endsection
