@extends('layouts.app')
@section('title', 'Регистрация')
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

    ul {
        text-align: left !important;
    }
    ul li {
        text-align: left !important;
    }

    ul li:first-child {
        display: none !important;
    }
</style>
<main class="form-signin w-100 m-auto">
  <form  method="POST" action="{{ route('register') }}">
    @csrf
    <h1 class="h3 mb-3 text-uppercase"><a href="/" style="text-decoration: none; color: #000; font-weight: 900">Akbars Market</a></h1>
    <h2 class="h4 mb-3 fw-normal">Регистрация</h2>

    <div class="form-floating">
      <input style="border-bottom-right-radius: 0; border-bottom-left-radius: 0;" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
      <label for="name">ФИО</label>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-floating">
      <input style="border-radius: 0;" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
      <label for="email">Email (логин)</label>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-floating">
        <input style="border-radius: 0;" id="password" type="password" class="form-control @error('password') is-invalid @enderror mb-0" name="password" required autocomplete="current-password">
        <label for="password">Пароль</label>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-floating">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        <label for="password-confirm">Подтвердите пароль</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Зарегистрироваться</button>

    <p class="mt-5 mb-3 text-muted">
        <a href="{{route('login')}}" class="mb-1 d-block">У меня есть аккаунт. Войти</a>
        
        © <?php echo date("Y");?></p>
  </form>
</main>
@endsection

@push('scripts')
<script>
        window.addEventListener("DOMContentLoaded", function() {
        [].forEach.call( document.getElementsByName("tel"), function(input) {
        var keyCode;
        function mask(event) {
            event.keyCode && (keyCode = event.keyCode);
            var pos = this.selectionStart;
            if (pos < 3) event.preventDefault();
            var matrix = "+7 (___) ___ ____",
                i = 0,
                def = matrix.replace(/\D/g, ""),
                val = this.value.replace(/\D/g, ""),
                new_value = matrix.replace(/[_\d]/g, function(a) {
                    return i < val.length ? val.charAt(i++) || def.charAt(i) : a
                });
            i = new_value.indexOf("_");
            if (i != -1) {
                i < 5 && (i = 3);
                new_value = new_value.slice(0, i)
            }
            var reg = matrix.substr(0, this.value.length).replace(/_+/g,
                function(a) {
                    return "\\d{1," + a.length + "}"
                }).replace(/[+()]/g, "\\$&");
            reg = new RegExp("^" + reg + "$");
            if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
            if (event.type == "blur" && this.value.length < 5)  this.value = ""
        }
    
        input.addEventListener("input", mask, false);
        input.addEventListener("focus", mask, false);
        input.addEventListener("blur", mask, false);
        input.addEventListener("keydown", mask, false)
    
      });
    
    });
    </script>
@endpush