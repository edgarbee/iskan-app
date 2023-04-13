@extends('layouts.app')
@section('title', 'Авторизация')
@section('body-class', 'text-center')

@section('content')
<style>
    html,
    body {
    height: 100%;
    }

    body {
    display: flex;
    align-items: center;
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #f5f5f5;
    }

    .form-signin {
    max-width: 330px;
    padding: 15px;
    }

    .form-signin .form-floating:focus-within {
    z-index: 2;
    }

    .form-signin input[type="email"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    }

    .oil {
        position: absolute;
        top: 10px;
        right: 10px;
    }
</style>
<div class="oil">
    <a href="{{ route('oil_index') }}">Заявки на топливо</a>
</div>
<main class="form-signin w-100 m-auto">
  <form  method="POST" action="{{ route('login') }}">
    @csrf
    <img class="mb-4" src="https://iskan-group.com/assets/img/Logo_RU%20Black.png" alt="" width="60" height="auto">
    <h1 class="h3 mb-3 text-uppercase"><a href="/" style="text-decoration: none; color: #000; font-weight: 900">ISKAN GROUP</a></h1>
    <h2 class="h4 mb-3 fw-normal">Авторизация</h2>

    <div class="form-floating">
      <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
      <label for="email">Email (логин)</label>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-floating">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
        <label for="password">Пароль</label>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="checkbox mb-3">
      <label>
        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Запомнить меня
      </label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Войти</button>
    <p class="mt-5 mb-3 text-muted">© <?php echo date("Y");?></p>
  </form>
</main>
@endsection
