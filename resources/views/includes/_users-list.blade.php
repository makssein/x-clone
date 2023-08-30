<div class="flex items-center justify-between w-full mb-6">
    <div class="flex items-center">
        @if($u->avatar)
            <img alt="avatar" class="w-24 h-24 rounded-full mr-4 object-cover" src="{{$u->getAvatarLink()}}">
        @else
            <img alt="avatar" class="w-24 h-24 rounded-full mr-4 object-cover" src="{{asset('img/default/default-avatar.svg')}}">
        @endif
        <div class="flex flex-col items-start justify-center">
            <a href="{{$u->profileLink()}}">
                <h5 class="font-bold text-xl">{{$u->name}}</h5>
                <span class="text-slate-500 text-base">{{"@$u->username"}}</span>
            </a>
        </div>
    </div>
    @if(auth()->user()->isNot($u))
        <form data-follow-form action="/profile/{{$u->username}}/follow" method="POST" class="justify-self-end">
            @if($isFollowing)
                <button type="submit" class="px-4 py-2 font-medium text-sm text-white rounded-full shadow-sm bg-transparent border border-slate-500 hover:bg-slate-800">Отписаться</button>
            @else
                <button type="submit" class="px-4 py-2 font-medium text-sm text-white rounded-full shadow-sm bg-cyan-600 hover:bg-cyan-700">Подписаться</button>
            @endif
        </form>
    @endif
</div>
