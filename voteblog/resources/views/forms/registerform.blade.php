@extends('forms.forminclude')

@section('form')

<div class="limiter">
    <div class="container-login100" style="background-image: url({!! asset('/theme/Login_v5/images/bg-01.jpg')!!});">
        <div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
            <form class="login100-form validate-form flex-sb flex-w" action='/register' method="POST">
                {{csrf_field()}}
                <span class="login100-form-title p-b-53">
                    Register
                </span>

                <div class="p-t-31 p-b-9">
                    <span class="txt1">
                        Username
                    </span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Username is required">
                    <input class="input100" type="text" name="username" value={{ old('username') }}>
                    <span class="focus-input100"></span>
                </div>

                <div class="p-t-31 p-b-9">
                    <span class="txt1">
                        E-mail
                    </span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="E-mail is required">
                    <input class="input100" type="email" name="email" value={{ old('email') }}>
                    <span class="focus-input100"></span>
                </div>

                <div class="p-t-13 p-b-9">
                    <span class="txt1">
                        Password
                    </span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password">
                    <span class="focus-input100"></span>
                </div>
                
                @if ($errors->has('fail'))
                    <div class="w-full text-center p-t-55">
                        <span class="txt2" style="color:red;">
                            {{ $errors->first('fail') }}
                        </span>
                    </div>
                @endif

                <div class="w-full text-center p-t-55">
                    <span class="txt2" style="color:blue;"> 
                        @if($errors->has('username'))                                               
                            {{ "Username : ".old('username')." has already used." }}
                        @endif
                    </span>
                </div>

                <div class="w-full text-center p-t-55">
                    <span class="txt2" style="color:purple;"> 
                        @if ($errors->has('email'))                         
                            {{ "Email : ".old('email')." has already used." }}                                
                        @endif
                    </span>
                </div>

                <div class="container-login100-form-btn m-t-17">
                    <button class="login100-form-btn">
                        Register now
                    </button>
                </div>                
            </form>
        </div>
    </div>
</div>

<div id="dropDownSelect1"></div>

@endsection