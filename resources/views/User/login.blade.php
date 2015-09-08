@extends('app')


@section('title')
تسجيل الدخول 
@stop

@section('style')
<style type="text/css">
    .card-container.card {
        max-width: 350px;
        padding: 40px 40px;
    }

    .btn {
        font-weight: 700;
        height: 36px;
        -moz-user-select: none;
        -webkit-user-select: none;
        user-select: none;
        cursor: default;
    }

    /*
     * Card component
     */


    .profile-img-card {
        width: 226px;
        height: 226px;
        margin: 0 auto 10px;
        display: block;
    }

    /*
     * Form styles
     */
    .profile-name-card {
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        margin: 10px 0 0;
        min-height: 1em;
    }

    .reauth-email {
        display: block;
        color: #404040;
        line-height: 2;
        margin-bottom: 10px;
        font-size: 14px;
        text-align: center;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }

    .form-signin #inputEmail,
    .form-signin #inputPassword {
        direction: ltr;
        height: 44px;
        font-size: 16px;
    }

    .form-signin input[type=email],
    .form-signin input[type=password],
    .form-signin input[type=text],
    .form-signin button {
        width: 100%;
        display: block;
        margin-bottom: 10px;
        z-index: 1;
        position: relative;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }

    .form-signin .form-control:focus {
        border-color: rgb(104, 145, 162);
        outline: 0;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
    }

    .btn.btn-signin {
        /*background-color: #4d90fe; */
        background-color: rgb(104, 145, 162);
        /* background-color: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));*/
        padding: 0px;
        font-weight: 700;
        font-size: 14px;
        height: 36px;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        border-radius: 3px;
        border: none;
        -o-transition: all 0.218s;
        -moz-transition: all 0.218s;
        -webkit-transition: all 0.218s;
        transition: all 0.218s;
    }

    .btn.btn-signin:hover,
    .btn.btn-signin:active,
    .btn.btn-signin:focus {
        background-color: rgb(12, 97, 33);
    }

    .forgot-password {
        color: rgb(104, 145, 162);
    }

    .forgot-password:hover,
    .forgot-password:active,
    .forgot-password:focus{
        color: rgb(12, 97, 33);
    }
</style>
@stop

@section('scripts')

@stop


@section('content')
<div class="card card-container">
    <img id="profile-img" class="profile-img-card" src="images/خنجر_عماني.png" />
    <p id="profile-name" class="profile-name-card">
        محافظة مسقط, مكتب المحافظ
    </p>
    {!! Form::open(['url'=>'user/login','id' => 'signin-form', 'method' => 'POST', 'class'=>'form-signin form-horizontal']) !!}
    <span id="reauth-email" class="reauth-email"></span>
    <input type="email"
           name="email"
           value="{{old('email') }}"
           class="form-control" 
           placeholder="البريد الإلكتروني"
           required 
           autofocus>
    <input type="password"
           value="{{old('password') }}"
           name="password"
           class="form-control"
           placeholder="كلمة المرور"
           required>

    {!! Form::submit('تسجيل الدخول', ['class'=>"btn btn-lg btn-primary btn-block btn-signin"]) !!}
    {!! Form::close() !!}
    <br>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>للأسف</strong> حدثت مشكلة أثناء تسجيل الدخول<br><br>
        <ol>
            @foreach ($errors->all() as $error)
            <li>{{ $error }} <i class="fa fa-exclamation"></i></li>
            @endforeach
        </ol>
    </div>
    @endif
    
    
     @if (isset($loginwrong))
    <div class="alert alert-danger">
        <strong>للأسف</strong> حدثت مشكلة أثناء تسجيل الدخول<br><br>
        <ol>
            @foreach ($loginwrong as $error)
            <li>{{ $error }} <i class="fa fa-exclamation"></i></li>
            @endforeach
        </ol>
    </div>
    @endif
    
    
    <hr>
    <a href="route" class="forgot-password">
        نسيت كلمة المرور؟
    </a>

</div><!-- /card-container -->
</div><!-- /container -->
@stop