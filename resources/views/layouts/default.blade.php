<!DOCTYPE HTML>
<html class="dark" lang="ru">
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="copyright" content="Maxim Sein">
    <meta name="author" content="Maxim Sein">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>
</head>
<body class="dark dark:bg-slate-950">
<div id="toasts" class="fixed right-5 pt-5 z-50"></div>
<section class="px-8">
    <main class="container mx-auto">
        @yield('content')
    </main>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="{{asset('js/script.js')}}"></script>
</body>
</html>
