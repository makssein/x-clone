<div class="flex items-center justify-between w-full mb-6">
    <div class="flex items-center">
        @if($user->avatar)
            <img alt="avatar" class="w-24 h-24 rounded-full mr-4" src="{{$user->getAvatarLink()}}">
        @else
            <img alt="avatar" class="w-24 h-24 rounded-full mr-4" src="{{asset('img/default/default-avatar.svg')}}">
        @endif
        <div class="flex flex-col items-start justify-center">
            <h5 class="font-bold text-xl">{{$user->name}}</h5>
            <span class="text-slate-500 text-base">{{"@$user->username"}}</span>
        </div>
    </div>
    <form data-follow-form action="/profile/{{$user->username}}/follow" method="POST" class="justify-self-end">
        @if($isFollowing)
            <button type="submit" class="px-4 py-2 font-medium text-sm text-white rounded-full shadow-sm bg-transparent border border-slate-500 hover:bg-slate-800">Отписаться</button>
        @else
            <button type="submit" class="px-4 py-2 font-medium text-sm text-white rounded-full shadow-sm bg-cyan-600 hover:bg-cyan-700">Подписаться</button>
        @endif
    </form>
</div>
