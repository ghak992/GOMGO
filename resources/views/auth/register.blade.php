@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default card">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif


                    {!! Form::open(['url' => '/auth/register', 'method' => 'POST', 'class'=>'form-signin form-horizontal']) !!}
                    <span id="reauth-email" class="reauth-email"></span>

                    <div class="form-group">
                        <div class="col-md-8">
                            {!! Form::text("fname", null, ["class"=>'form-control',
                            "required"=>"",
                            "autofocus"=>"",
                            "placeholder"=>"الأول"]) !!}


                            {!! Form::text("mname", null, ["class"=>'form-control',
                            "required"=>"",
                            "placeholder"=>"الثاني"]) !!}

                            {!! Form::text("lname", null, ["class"=>'form-control',
                            "required"=>"",
                            "placeholder"=>"الثالث"]) !!}


                            {!! Form::text("sname", null, ["class"=>'form-control',
                            "required"=>"",
                            "placeholder"=>"القبيلة"]) !!}
                        </div>
                        <label class="col-md-2 control-label">الإسم</label>
                    </div>


                    <div class="form-group">
                        <div class="col-md-8">
                            {!! Form::email("email", null, ["class"=>'form-control',
                            "required"=>"",
                            "placeholder"=>"البريد الإلكتروني"]) !!}
                        </div>
                        <label class="col-md-2 control-label">البريد الإلكتروني</label>
                    </div>


                    <div class="form-group">
                        <div class="col-md-8">
                            {!! Form::text("password", null, ["class"=>'form-control',
                            "required"=>"",
                            "placeholder"=>"كلمة المرور"]) !!}
                        </div>
                        <label class="col-md-2 control-label">كلمة المرور</label>
                    </div>


                    <div class="form-group">
                        <div class="col-md-8">
                            <select class="form-control" name="userrolle">
                                @foreach($roles as $roll)
                                <option value="{{$roll->id}}">{{$roll->type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label class="col-md-2 control-label">كلمة المرور</label>
                    </div>

                    {!! Form::password("password", null, ["class"=>'form-control',
                    "id"=>"inputPassword",
                    "required"=>"",
                    "placeholder"=>"كلمة المرور"]) !!}
                    {!! Form::submit('تسجيل الدخول', ['class'=>"btn btn-lg btn-primary btn-block btn-signin"]) !!}

                    {!! Form::close() !!}

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
