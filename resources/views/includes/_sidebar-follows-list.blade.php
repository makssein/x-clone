<li class="mb-4">
    <div class="flex items-center">
        @if($user->avatar)
            <img class="w-10 h-10 rounded-full object-cover" src="{{$user->getAvatarLink()}}" alt="avatar">
        @else
            <img class="w-10 h-10 rounded-full object-cover" src="{{asset('/img/default/default-avatar.svg')}}" alt="avatar">
        @endif
            <a href="{{$user->profileLink()}}" class="ml-4">
            <div class="font-bold hover:underline">{{$user->name}}</div>
            <div class="text-slate-500 text-sm">{{'@'.$user->username}}</div>
        </a>
    </div>
</li>
