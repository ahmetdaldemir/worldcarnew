<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>World Rent A Car Yönetim</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link href="{{ asset('/public/assets/styles/css/themes/lite-purple.css') }}" rel="stylesheet">
    <!-- script src='https://www.google.com/recaptcha/api.js'></script -->
</head>
<body>
<div class="auth-layout-wrap" style="background-image: url({{ asset('/public/assets/images/loginbg.jpg'); }}); background-size: 100% 100%;">
    <div class="auth-content" style="min-width:330px">
        <div class="card o-hidden">
            <div class="row">
                <div class="col-md-12">
                    <div class="p-4">
                        <div class="auth-logo text-center mb-4"><img src="{{ asset('/public/logo.png') }}" alt=""></div>
                        <h1 class="mb-3 text-18">Giriş Yap</h1>
                        <form method="POST" action="{{ route('admin.loginPost') }}">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control form-control-rounded" @error('email') is-invalid @enderror  name="email" value="{{ old('email') }}" required id="email" type="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Şifre</label>
                                <input class="form-control form-control-rounded" @error('password') is-invalid
                                       @enderror name="password" required id="password" type="password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
<!--
                            @if(env('GOOGLE_RECAPTCHA_KEY'))
                                //  <div class="form-group g-recaptcha"
                                //    data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
                                // </div>
                    // @endif -->
                            <button class="btn btn-rounded btn-primary btn-block mt-2">Giriş Yap</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<style>
    .auth-logo img {
        width: 200px;
        height: auto;
    }

</style>
</html>
