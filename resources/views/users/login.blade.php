@extends('layouts.main')
<link rel="stylesheet" href="/css/login.css">
@section('Title', 'DirectTarefas - Login')

@if ($errors->any())
    <div class="box-alert">
        <div class="alert rounded-md drop-shadow-lg">
            <ion-icon name="alert-circle-outline"> </ion-icon>
            <h2>ERRO!!!</h2>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
            <button class="btn drop-shadow-lg"><a href="{{ url('/login') }}">OK</a></button>
        </div>
    </div>
@endif

@section('content')
    <main class="pageLogin">
        
        <section class="section-one">
        </section>

        <section class="container-login">
            <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
                <div class="w-full max-w-md space-y-8">
                    <div>
                        <img class="mx-auto w-auto logo-login" src="/imgs/acertsoft.png" alt="Your Company">
                        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Entrar no sistema</h2>
                    </div>
                    <form class="mt-8 space-y-6" action={{ url('login') }} method="POST">
                        @csrf
                        <input type="hidden" name="remember" value="true">
                        <div class="-space-y-px rounded-md shadow-sm">
                            <div>
                                <label for="email-address" class="sr-only">Login</label>
                                <input id="email-address" name="email" type="email" autocomplete="email" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm" placeholder="Email">
                            </div>
                            <div>
                                <label for="password" class="sr-only">Senha</label>
                                <input id="password" name="password" type="password" autocomplete="current-password" required class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm" placeholder="Senha">
                            </div>
                        </div>

                        <div class="flex items-center justify-end">
                            <div class="text-sm">
                                <a href="#" class="font-medium text-blue-600 hover:text-blue-500">Esqueci minha senha?</a>
                            </div>
                        </div>

                        <div>
                            <button type="submit" placeholder="Entrar" class="btn-login group relative flex w-full justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class=" h-5 w-5 text-blue-300 group-hover:text-blue-100" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                Entrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <section class="section-two">
        </section>
    </main>

@endsection

