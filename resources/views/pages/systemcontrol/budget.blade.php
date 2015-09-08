@extends('app')


@section('title')
ميزانية المساعدات
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
<div  class="container" >
    <div id="main-container" class="row">
        <div class="center-block">


            <div class="center-block"><div class="container">
                    <div class="card card-container" >
                        <div class="text-right">
                            <p class="card-title" style="float: right">
                                <i class="fa fa-bank"></i>
                                انشاء ميزانية سنوية
                                &nbsp;:
                            </p>
                        </div>
                        <hr>
                        <br>
                        <div class="row">
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
                        </div>
                        <div class="row">
                            <div class="col-md-10" style="text-align: right">
                                {!! Form::open([
                                'url' => 'system-control/budget/store',
                                'role'=>'form',
                                'method' => 'POST',
                                'class'=>'form-new-year-budget form-inline']) !!}

                                <div class="form-group" style="margin-right: 10px;">
                                    <label for="yearinput">
                                        <i class="fa fa-calendar"></i>
                                        السنة
                                    </label>
                                    <input type="number" 
                                           required=""
                                           name="year"
                                           max="3000"
                                           value="{{old('year') }}" 
                                           min="{{date('Y')}}"
                                           step="1"
                                           class="form-control"
                                           id="yearinput"
                                           placeholder="السنة">
                                </div>
                                <div class="form-group" style="margin-right: 10px;">
                                    <label for="valueinput">
                                        <i class="fa fa-money"></i>
                                        الميزانية
                                    </label>
                                    <input type="number" 
                                           name="amount"
                                           required=""
                                           min="1"
                                           step="1"
                                           value="{{old('amount') }}"
                                           class="form-control"
                                           id="valueinput"
                                           placeholder="الميزانية">
                                </div>
                                <button type="submit" class="btn btn-success">اضافة</button>
                                {!! Form::close() !!}
                            </div>
                        </div>

                    </div>  
                </div>
            </div>
            <div class="center-block"><div class="container">
                    <div class="card card-container" >
                        <div class="text-right">
                            <p class="card-title" style="float: right">
                                <i class="fa fa-bank"></i>
                                ميزانية المساعدات المالية
                                &nbsp;:
                            </p>
                        </div>
                        <hr>
                        <br>
                        <div class="row">
                            <div class="filterable">
                                <div class="panel-heading">
                                    <div class="pull-right">
                                        <button class="btn btn-default btn-sm btn-filter">
                                            <span class="fa fa-filter"></span> 
                                            البحث في القائمة
                                        </button>
                                        <a href="" class="btn btn-success btn-sm">
                                            <span class="fa fa-print"></span> 
                                            استخراج 
                                        </a>

                                    </div>
                                </div>
                                <br>
                                <table class="table table-bordered table-hover" >
                                    <thead>
                                        <tr class="filters" >
                                            <th align="right"><input type="text" class="form-control" placeholder="السنة" disabled></th>
                                            <th align="right" class="table-head">تاريخ الإنشاء</th>                                            
                                            <th align="right" class="table-head">الميزانية</th>                                            
                                            <th align="right" class="table-head">الطلبات الموافق عليها</th>                                            
                                            <th align="right" class="table-head">المصروف</th>
                                            <th align="right" class="table-head">انتظار الصرف</th>
                                            <th align="right" class="table-head">المتبقي</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($yearsbudget as $budget) {
                                            ?>
                                            <tr>
                                                <td align="right">
                                                    {{$budget->year}}
                                                </td>
                                                <td align="right">
                                                    <?php
                                                    $arabicday = array('Saturday' => 'السبت',
                                                        'Sunday' => 'الاحد',
                                                        'Monday' => 'الاثنين',
                                                        'Tuesday' => 'الثلاثاء',
                                                        'Wednesday' => 'الاربعاء',
                                                        'Thursday' => 'الخميس',
                                                        'Friday' => 'الجمعة');
                                                    $basedate = strtotime($budget->created_at);
                                                    $date = date("l", $basedate);
                                                    echo $arabicday[$date];
                                                    ?>
                                                    <?php
                                                    $timestamp = strtotime($budget->created_at);
                                                    echo date('Y/m/d', $timestamp);
                                                    ?>
                                                </td>

                                                <td align="right">{{$budget->amount}}</td>
                                                <td align="right">{{$approvedaidsbudget[$budget->year]}}</td>
                                                <td align="right">{{$yearsexchangeide[$budget->year]}}</td>
                                                <td align="right">{{$approvedaidsbudget[$budget->year] - $yearsexchangeide[$budget->year]}}</td>
                                                <td align="right">{{$budget->amount - $yearsexchangeide[$budget->year]}}</td>
                                            </tr>
                                            <?php
                                        }
                                        ?>


                                    </tbody>
                                </table>
                            </div>
                            <h4 style="text-align: left">
                                الارقام بالريال العماني
                            </h4>
                            <div class="text-center">
                                {!! $yearsbudget->render() !!}
                            </div>
                        </div>

                    </div>  
                </div>
            </div>


        </div>
    </div>
    @stop