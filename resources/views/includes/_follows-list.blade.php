<li class="mb-4">
    <div class="flex items-center">
        <img class="w-10 h-10 rounded-full" src="https://i.pravatar.cc/40" alt="avatar">
        <a href="{{$user->profileLink()}}" class="ml-4">
            <div class="font-bold hover:underline">{{$user->name}}</div>
            <div class="text-slate-500 text-sm">{{'@'.$user->username}}</div>
        </a>
    </div>
</li>
