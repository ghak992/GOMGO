@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default card">
                <div class="panel-heading text-right">
                    <h4>
                        تسجيل مستخدم جديد
                        <i class="fa fa-user"></i>
                    </h4>
                </div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>للأسف</strong> حدثت مشكلة أثناء تسجيل المستخدم الجديد<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }} <i class="fa fa-exclamation"></i></li>
                            @endforeach
                        </ul>
                    </div>
                    @endif


                    {!! Form::open(['url' => '/user/store', 'method' => 'POST', 'class'=>'form-newuser form-horizontal']) !!}
                    <span id="reauth-email" class="reauth-email"></span>

                    <div class="form-group">
                        <div class="col-md-8">
                            {!! Form::text("fname", null, ["class"=>'form-control',
                            "value"=>"{{old('fname') }}",
                            "required"=>"",
                            "autofocus"=>"",
                            "placeholder"=>"الأول"]) !!}


                            {!! Form::text("mname", null, ["class"=>'form-control',
                             "value"=>"{{old('mname') }}",
                            "required"=>"",
                            "placeholder"=>"الثاني"]) !!}

                            {!! Form::text("lname", null, ["class"=>'form-control',
                            "value"=>"{{old('lname') }}",
                            "required"=>"",
                            "placeholder"=>"الثالث"]) !!}


                            {!! Form::text("sname", null, ["class"=>'form-control',
                            "value"=>"{{old('sname') }}",
                            "required"=>"",
                            "placeholder"=>"القبيلة"]) !!}
                        </div>
                        <label class="col-md-2 control-label">الإسم
                            <i class="fa fa-pencil-square-o"></i></label>
                    </div>


                    <div class="form-group">
                        <div class="col-md-8">
                            {!! Form::email("email", null, ["class"=>'form-control',
                            "required"=>"",
                            "value"=>"{{old('email') }}",
                            "placeholder"=>"البريد الإلكتروني"]) !!}
                        </div>
                       <label class="col-md-2 control-label">
                          البريد الإلكتروني
                        <i class="fa fa-pencil-square-o"></i>
                        </label>
                    </div>


                    <div class="form-group">
                        <div class="col-md-8">
                            <input type="password" value="{{old('password') }}" required="" placeholder="كلمة المرور" class="form-control" name="password">
                        </div>
                        <label class="col-md-2 control-label">
                         كلمة المرور
                        <i class="fa fa-pencil-square-o"></i>
                        </label>
                    </div>


                    <div class="form-group">
                        <div class="col-md-8">
                            <select class="form-control" name="userrolle">
                                @foreach($roles as $roll)
                                <option value="{{$roll->id}}">{{$roll->type}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label class="col-md-2 control-label">
                           نوع المستخدم
                        <i class="fa fa-pencil-square-o"></i>
                        </label>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            {!! Form::submit('إنشاء الحساب', ['class'=>"btn btn-primary btn-signin"]) !!}

                        </div>
                    </div>

<!--<input type="text" class="form-control" name="name" ">-->

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
