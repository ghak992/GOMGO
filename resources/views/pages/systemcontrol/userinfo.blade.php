@extends('app')


@section('title')
نظام المساعدات المالية 
@stop

@section('style')
<style type="text/css">
    .text-right{
        text-align: right;
    }
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
<?php
//print_r($user[0]);
?>
<div class="container-fluid">

    <div class="card card-container" style="max-width: 900px;">
        <p class="card-title text-right" style="float: right">
            <i class="fa fa-user"></i>
            {{$user[0]->first_name}}
            {{$user[0]->middle_name}}
            {{$user[0]->last_name}}
            {{$user[0]->sair_name}}
            &nbsp;:
        </p>
        <hr>
        <br>
        <div class="row">
            <div class="col-xs-6 text-right" style="float: right">
                <span class="field-title">
                    تاريخ الاضافة
                    &nbsp;:
                </span>
                <span class="field-info">
                    <?php
                    $arabicday = array('Saturday' => 'السبت',
                        'Sunday' => 'الاحد',
                        'Monday' => 'الاثنين',
                        'Tuesday' => 'الثلثاء',
                        'Wednesday' => 'الاربعاء',
                        'Thursday' => 'الخميس',
                        'Friday' => 'الجمعة');
                    $basedate = strtotime($user[0]->created_at);
                    $date = date("l", $basedate);
                    echo $arabicday[$date];
                    ?>
                    <?php
                    $timestamp = strtotime($user[0]->created_at);
                    echo date('Y/m/d', $timestamp);
                    ?>
                </span>

            </div>
            <div class="col-xs-6 text-right" style="float: right">
                <span class="field-title">معرف كـ&nbsp;:</span>
                <span class="field-info">{{$user[0]->type}}</span>

            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-xs-6 text-right" style="float: right">
                <span class="field-title">
                    البريد الإلكتروني
                    &nbsp;:
                </span>
                <span class="field-info">{{$user[0]->email}}</span>
            </div>
            <div class="col-xs-6 text-right" style="float: right">
                <span class="field-title">عدد الطلبات التي تعامل معها</span>
                <a href="{{URL::to('system-control/user-info/requests-list/'.$id)}}" class="btn btn-sm btn-primary">{{$request[0]->requests_count}}&nbsp;</a>
            </div>
        </div>

    </div> 


    <div class="card card-container" style="max-width: 900px;">
        <p class="card-title" style="float: right">
            <i class="fa fa-pencil-square-o"></i>
            تعديل المعلومات
            &nbsp;:
        </p>
        <hr>
        <br>
        <div class="row">
            <div class="panel-body">


                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>للأسف</strong> حدثت مشكلة أثناء تحديث المعلومات<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }} <i class="fa fa-exclamation"></i></li>
                        @endforeach
                    </ul>
                </div>
                @endif
                {!! Form::open(['url' => '/user/update', 'method' => 'POST', 'class'=>'form-newuser form-horizontal']) !!}
                <input type="hidden" 
                       value="{{$user[0]->id}}" 
                       name="id">
                <span id="reauth-email" class="reauth-email"></span>

                <div class="form-group">
                    <div class="col-md-8">
                        <input type="text" 
                               value="{{$user[0]->first_name}}" 
                               required="" 
                               placeholder="الاول" 
                               class="form-control" 
                               name="fname">
                        <input type="text" 
                               value="{{$user[0]->middle_name}}" 
                               required="" 
                               placeholder="الثاني" 
                               class="form-control" 
                               name="mname">
                        <input type="text" 
                               value="{{$user[0]->last_name}}" 
                               required="" 
                               placeholder="الثالث" 
                               class="form-control" 
                               name="lname">
                        <input type="text" 
                               value="{{$user[0]->sair_name}}" 
                               required="" 
                               placeholder="القبيلة" 
                               class="form-control" 
                               name="sname">
                    </div>
                    <label class="col-md-2 control-label">
                        <i class="fa fa-pencil-square-o"></i>
                        الاسم
                    </label>
                </div>

                <div class="form-group">
                    <div class="col-md-8">
                        <select class="form-control" name="userrolle">
                            @foreach($roles as $roll)
                            <option value="{{$roll->id}}"
                            <?php echo (($roll->id == $user[0]->role) ? "selected" : ""); ?>
                                    >{{$roll->type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <label class="col-md-2 control-label">
                        <i class="fa fa-pencil-square-o"></i>
                        نوع المستخدم
                    </label>
                </div>

                <div class="form-group">
                    <div class="col-xs-12 text-left">
                        {!! Form::submit('تحديث', ['class'=>"btn btn-primary btn-signin"]) !!}
                    </div>
                </div>

                {!! Form::close() !!}



                <hr>
                {!! Form::open(['url' => '/user/updatepass', 'method' => 'POST', 'class'=>'form-newuser form-horizontal']) !!}
                <input type="hidden" 
                       value="{{$user[0]->id}}" 
                       name="id">
                <div class="form-group">
                    <div class="col-md-8">
                        <input type="password" 
                               required="" 
                               placeholder="كلمة المرور" 
                               class="form-control" 
                               name="password">
                    </div>
                    <label class="col-md-2 control-label">
                        <i class="fa fa-pencil-square-o"></i>
                        كلمة المرور الجديد
                    </label>
                </div>
                <div class="form-group">
                    <div class="col-xs-12 text-left">
                        {!! Form::submit('تحديث كلمة المرور', ['class'=>"btn btn-primary btn-signin"]) !!}
                    </div>
                </div>
                {!! Form::close() !!}


                <hr>
                {!! Form::open(['url' => '/user/updateemail', 'method' => 'POST', 'class'=>'form-newuser form-horizontal']) !!}
                <input type="hidden" 
                       value="{{$user[0]->id}}" 
                       name="id">
                <div class="form-group">
                    <div class="col-md-8">
                        <input type="email" 
                               value="{{$user[0]->email}}" 
                               required="" 
                               placeholder="البريد الإلكتروني" 
                               class="form-control" 
                               name="email">
                    </div>
                    <label class="col-md-2 control-label">
                        <i class="fa fa-pencil-square-o"></i>
                        البريد الإلكتروني
                    </label>
                </div>
                <div class="form-group">
                    <div class="col-xs-12 text-left">
                        {!! Form::submit('تحديث البريد الإلكتروني', ['class'=>"btn btn-primary btn-signin"]) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div> 


    <div class="card card-container" style="max-width: 900px;">
        <p class="card-title" style="float: right">
            <i class="fa fa-lock"></i>
            صلاحيات وصول المستخدم
            &nbsp;:
        </p>
        <hr>
        <br>
        <div class="row">
            <div class="row">
                <div class="panel-body">
                    {!! Form::open(array('url' => '/user/updateuserpageacessuth', 'method' => 'POST')) !!}
                    <input type="hidden" value="{{$id}}" name="userid"/>
                    <?php
                    $index = 1;
                    foreach ($systempages as $page) {
                        ?>
                        <div class="col-md-6">
                            <div class="checkbox">
                                <h4>
                                    <input type="checkbox" 
                                           name="user-pages-auth[]"
                                           value="{{$page->id}}"
                                           <?php echo (in_array($page->id, $userauthpages) == TRUE) ? "checked" : '' ?>/>
                                    &nbsp;
                                    &nbsp;
                                    &nbsp;
                                    {{$page->title}}
                                </h4>
                            </div>
                        </div>
                        <?php
                        $index++;
                    }
                    ?>
                </div>
                <div class="form-group">
                    <div class="col-xs-12 text-left">
                        {!! Form::submit('تحديث صلاحيات وصول المستخدم', ['class'=>"btn btn-primary btn-signin"]) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div> 

@stop