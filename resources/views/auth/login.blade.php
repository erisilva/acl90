@extends('layouts.home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="p-3 mb-2 bg-secondary text-white">
                <h1 class="display-4"><i class="bi bi-archive"></i> {{ config('app.name', 'Protocolos') }}</h1>
                <p class="lead">Projeto Inicial</p>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Login') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-4 col-form-label text-end">E-mail</label>
                            <div class="col-sm-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <div class="invalid-feedback">
                                  <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="password" class="col-sm-4 col-form-label text-end">Senha</label>
                            <div class="col-sm-8">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                <div class="invalid-feedback">
                                  <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>




                        <div class="mb-3 row">
                            <label for="captcha_img" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-8">
                                <div class="captcha_img">
                                    <span>{!! captcha_img() !!}</span>
                                    <button type="button" class="btn btn-danger" class="reload" id="reload">
                                        <span><i class="bi bi-arrow-clockwise"></i></span>
                                    </button>
                                </div>
                            </div>    
                        </div>


                        <div class="mb-3 row">
                            <label for="captcha" class="col-sm-4 col-form-label text-end">Captcha</label>

                            <div class="col-sm-8">
                                <input id="captcha" type="text" class="form-control @error('captcha') is-invalid @enderror" name="captcha" required autocomplete="captcha">
                                @error('captcha')
                                <div class="invalid-feedback">
                                  <strong>{{ $message }}</strong>
                                </div>
                                @enderror
                            </div>
                        </div>




                        <div class="mb-3 row">
                            <div class="col-sm-6 offset-sm-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        Lembre-me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-sm-8 offset-sm-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-box-arrow-in-right"></i> {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-footer')
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#reload').click(function () {
            location.reload();
            return false;
        });
    });    
</script>

@endsection
