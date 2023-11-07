@extends('layouts.site_user')

@section('title')
    Главная
@endsection

@section('content')
<svg class="fixed bottom-0 fill-green-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill-opacity="1"
          d="M0,224L48,186.7C96,149,192,75,288,74.7C384,75,480,149,576,160C672,171,768,117,864,101.3C960,85,1056,107,1152,144C1248,181,1344,235,1392,261.3L1440,288L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
</svg>
<main>
    <div class="m-6 mb-12 rounded-xl p-6 shadow-xl sm:p-10">
        <h1 class="text-3xl font-semibold">Профиль</h1>
        <div class="text">
            <svg class="mx-auto h-12 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>

            <p>
            <h1 class="text-3xl font-semibold">{{auth()->user()->name}}</h1> </p>
        </div>
    </div>
    <div class="m-6 mb-12 rounded-xl p-6 shadow-xl sm:p-10 text">
        <p><a href="{{route('view.records.user')}}"
              class="rounded-md bg-green-600 py-2 px-4 font-semibold text-white shadow-lg transition duration-150 ease-in-out hover:bg-green-700 hover:shadow-xl focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">Запись
                на приём</a>
            <a href="{{route('view.my.records', ['id' => auth()->user()->id])}}"
               class="rounded-md bg-green-600 py-2 px-4 font-semibold text-white shadow-lg transition duration-150 ease-in-out hover:bg-green-700 hover:shadow-xl focus:shadow-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">Мои
                записи</a></p>
    </div>
</main>
@endsection()
