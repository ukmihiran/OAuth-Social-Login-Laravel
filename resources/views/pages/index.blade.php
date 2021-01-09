@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Sign In</h5>
                    <!-- Post Action -->
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-label-group">
                             <input type="email" id="email" class="form-control  @error('email') is-invalid @enderror" name="email" placeholder="Email address" value="{{ old('email') }}" required autocomplete="email" autofocus>

                             @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        
                        <div class="form-label-group"> 
                            <input id="password" type="password" id="inputPassword" class="form-control @error('password') is-invalid @enderror" placeholder="Password"  name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        </div>
                        <button  class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">{{ __('Login') }}</button>
                        
                        <!-- Social Login Buttons -->
                        <hr class="my-4">
                        <a href="{{ route('login.google') }}" class="btn btn-lg btn-google btn-block text-uppercase" role="button"><i class="fab fa-google mr-2"></i> Sign in with Google</button></a>
                        <a href="{{ route('login.facebook') }}" class="btn btn-lg btn-facebook btn-block text-uppercase" role="button"><i class="fab fa-facebook-f mr-2"></i> Sign in with Facebook</button></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


