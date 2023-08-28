@extends('layouts/default')

@section('title', 'Поиск')

@section('content')
    <div class="flex flex-col items-center pt-4">
        <div class="px-8 mb-4 self-start">
            <h1 class="text-xl font-bold">Результаты поиска: {{$query}}</h1>
        </div>
        <div class="flex flex-col w-full p-8">
            @php $follows = auth()->user()->follows @endphp
            @forelse($data as $u)
                @php
                    $isFollowing = $follows->contains($u);
                @endphp
                @include('includes/_follows-list' , ['isFollowing' => $isFollowing])
            @empty
                <p class="self-center text-gray-300">Ничего не найдено</p>
            @endforelse
        </div>
    </div>
@endsection

@section('scripts')

@endsection
