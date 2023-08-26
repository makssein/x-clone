<ul class="fixed">
    <li class="flex items-center">
                        <span class="mb-7 block">
                            <img src="{{asset('/img/logo/32x32.svg')}}" alt="logo">
                        </span>
    <li class="flex items-center"><a class="font-bold text-2xl mb-7 block" href="{{route('/')}}">Home</a></li>
    <li class="flex items-center"><a class="font-bold text-2xl mb-7 block">Explore</a></li>
    <li class="flex items-center"><a class="font-bold text-2xl mb-7 block">Notifications</a></li>
    <li class="flex items-center"><a class="font-bold text-2xl mb-7 block">Lists</a></li>
    <li class="flex items-center"><a class="font-bold text-2xl mb-7 block" href="{{route('profile.profile', auth()->user()->username)}}">Profile</a></li>
</ul>
