@extends('app')


@section('title')
نظام المساعدات المالية 
@stop

@section('style')
<style type="text/css">

</style>
@stop

@section('scripts')
<script type="text/javascript">

</script>
@stop

@section('navbar')
@include('navbar.nav')
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default card">
                <div class="text-right">
                    <p class="card-title" style="float: right">
                        <i class="fa fa-user"></i>
                        تسجيل مستخدم جديد
                        &nbsp;:
                    </p>
                </div>
                <hr>
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
                        <label class="col-md-3 control-label field-title">
                            <i class="fa fa-pencil-square-o"></i>
                            الإسم
                        </label>
                    </div>


                    <div class="form-group">
                        <div class="col-md-8">
                            {!! Form::email("email", null, ["class"=>'form-control',
                            "required"=>"",
                            "value"=>"{{old('email') }}",
                            "placeholder"=>"البريد الإلكتروني"]) !!}
                        </div>
                        <label class="col-md-3 control-label field-title">
                            <i class="fa fa-pencil-square-o"></i>
                            البريد الإلكتروني
                        </label>
                    </div>


                    <div class="form-group">
                        <div class="col-md-8">
                            <input type="password" value="{{old('password') }}" required="" placeholder="كلمة المرور" class="form-control" name="password">
                        </div>
                        <label class="col-md-3 control-label field-title">
                            <i class="fa fa-pencil-square-o"></i>
                            كلمة المرور
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
                        <label class="col-md-3 control-label field-title">
                            <i class="fa fa-pencil-square-o"></i>
                            نوع المستخدم
                        </label>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 text-left">
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


<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default card">
                <div class="text-right">
                    <p class="card-title" style="float: right">
                        <i class="fa fa-users"></i>
                        المستخدمين الحالين
                        &nbsp;:
                    </p>
                </div>
                <hr>
                <div class="panel-body">
                    <div class="row">
                        <div class="filterable">
                            <div class="panel-heading">
                                <div class="pull-right">
                                    <button class="btn btn-default btn-sm btn-filter">
                                        <span class="fa fa-filter"></span> 
                                        البحث في القائمة
                                    </button>
                                </div>
                            </div>
                            <br>
                            <table class="table table-bordered table-hover" >
                                <thead>
                                    <tr class="filters">
                                        <th align="right"></th>
                                        <th align="right"><input type="text" class="form-control" placeholder="الإسم" disabled></th>
                                        <th align="right"><input type="text" class="form-control" placeholder="معرف كـ" disabled></th>                                            
                                        <th align="right"><input type="text" class="form-control" placeholder="تاريخ الاضافة" disabled></th>
                                        <th align="right">التفاصيل</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    for ($index = 0; $index < count($users); $index++) {
                                        ?>
                                        <tr>

                                            <td align="right">{{$index + 1}}</td>
                                            <td align="right">
                                                {{$users[$index]->first_name}}
                                                {{$users[$index]->middle_name}}
                                                {{$users[$index]->last_name}}
                                                {{$users[$index]->sair_name}}
                                            </td>
                                            <td align="right">{{$users[$index]->type}}</td>

                                            <td align="right">
                                                <?php
                                                $arabicday = array('Saturday' => 'السبت',
                                                    'Sunday' => 'الاحد',
                                                    'Monday' => 'الاثنين',
                                                    'Tuesday' => 'الثلاثاء',
                                                    'Wednesday' => 'الاربعاء',
                                                    'Thursday' => 'الخميس',
                                                    'Friday' => 'الجمعة');
                                                $basedate = strtotime($users[$index]->created_at);
                                                $date = date("l", $basedate);
                                                echo $arabicday[$date]." ";
                                                $timestamp = strtotime($users[$index]->created_at);
                                                echo date('Y/m/d', $timestamp);
                                                ?>
                                            </td>
                                            <td align="right">
                                                <a class="btn btn-sm btn-primary btn-block"
                                                   href="{{URL::asset('system-control/user-info/'.$users[$index]->id)}}"
                                                   >
                                                    <i class="fa fa-user"></i>
                                                    &nbsp;
                                                    التفاصيل
                                                </a>
                                            </td>

                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="text-center">
                                {!! $users->render() !!}
                            </div>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop