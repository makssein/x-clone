@extends('layouts/default')

@section('title', 'Подтверждение адреса электронной почты')

@section('content')
    <div class="max-w-7xl mx-auto">
        <div class="flex h-screen items-center justify-center">
            <div class="flex w-1/3 justify-center">
                <img alt="logo" class="max-w-5xl" src="{{asset('/img/logo/380x380.svg')}}">
            </div>
            <div class="flex w-2/3 flex-col justify-center">
                <h1 class="text-white font-bold text-4xl text-center">Вам необходимо подветрдить адрес электронной почты.</h1>
                <form id="send_email_verification_form" action="{{route('verification.send')}}" method="POST" class="flex flex-col space-y-4 justify-center items-center mt-8">
                    @csrf
                    <button type="submit" class="px-4 py-2 w-2/4 font-semibold text-lg bg-cyan-500 text-white rounded-full shadow-sm">
                        Отправить письмо еще раз
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
