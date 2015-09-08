@extends('app')


@section('title')
{{$pagetitle}}
@stop

@section('style')
<style type="text/css">

</style>
@stop

@section('scripts')
<script type="text/javascript">

    $("#printalllists").click(function () {
        $.post("{{URL::to('export/all')}}", {flag: "{{$flag}}"}, function (data, status) {
            console.log(data);
        }, "json");
    });




</script>
@stop

@section('navbar')
@include('navbar.nav')
@stop

@section('content')
//<?php
//foreach ($requests as $request) {
//    foreach ($request as $key => $value) {
//        echo $key . " = " . $value . "<br>";
//    }
//    echo "<hr>";
//}
//?>
<div  class="container" >
    <div id="main-container" class="row">
        <div class="center-block">
            <?php
            if (count($requests) > 0) {
                ?>
                <div class="center-block"><div class="container">
                        <div class="card card-container" >
                            <div class="row">
                                <div class="filterable">
                                    <div class="panel-heading">
                                        <div class="pull-right">
                                            <button class="btn btn-default btn-sm btn-filter">
                                                <span class="fa fa-filter"></span> 
                                                البحث في القائمة
                                            </button>
                                            <a href="{{URL::to('export/all/'.$flag)}}" class="btn btn-success btn-sm">
                                                <span class="fa fa-print"></span> 
                                                استخراج الطلبات
                                            </a>
                                        </div>
                                    </div>
                                    <br>
                                    <table class="table table-bordered table-hover" >
                                        <thead>
                                            <tr class="filters">
                                                <th align="right"><input type="checkbox"  text="Dharan" name="checkall"></th>                                          
                                                <th align="right"><input type="text" class="form-control" placeholder="الإسم" disabled></th>
                                                <th align="right"><input type="text" class="form-control" placeholder="الرقم المدني" disabled></th>                                            
                                                <th align="right"><input type="text" class="form-control" placeholder="رقم الطلب" disabled></th>                                            
                                                <th align="right"><input type="text" class="form-control" placeholder="حالة الطلب" disabled></th>
                                                <th align="right"><input type="text" class="form-control" placeholder="سبب الطلب" disabled></th>
                                                <th align="right"><input type="text" class="form-control" placeholder="تاريخ تقديم الطلب" disabled></th>
                                                <th align="right">التفاصيل</th>


                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            foreach ($requests as $request) {
                                                ?>
                                                <tr>
                                                    <td align="right"><input type="checkbox"  name="check" value="{{1}}"></td>
                                                    <td align="right">
                                                        {{$request->requester_first_name}}
                                                        {{$request->requester_middle_name}}
                                                        {{$request->requester_last_name}}
                                                        {{$request->requester_sair_name}}
                                                    </td>
                                                    <td align="right">{{$request->requester_civil_id}}</td>
                                                    <td align="right">{{$request->id}}</td>
                                                    <td align="right">{{$request->requeststatus}}</td>
                                                    <td align="right">{{$request->requestreasone}}</td>
                                                    <td align="right">
                                                        <?php
                                                        $arabicday = array('Saturday' => 'السبت',
                                                            'Sunday' => 'الاحد',
                                                            'Monday' => 'الاثنين',
                                                            'Tuesday' => 'الثلاثاء',
                                                            'Wednesday' => 'الاربعاء',
                                                            'Thursday' => 'الخميس',
                                                            'Friday' => 'الجمعة');
                                                        $basedate = strtotime($request->created_at);
                                                        $date = date("l", $basedate);
                                                        echo $arabicday[$date];
                                                        ?>
                                                        <?php
                                                        $timestamp = strtotime($request->created_at);
                                                        echo date('Y/m/d', $timestamp);
                                                        ?>
                                                    </td>
                                                    <td align="right">
                                                        <a class="btn btn-sm btn-primary btn-block"
                                                           href="{{URL::asset('financial-aids-system/requests-info/'.$request->id)}}"
                                                           >
                                                            <i class="fa fa-file"></i>
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
                                </div>
                                <div class="text-center">
                                    {!! $requests->render() !!}
                                </div>
                            </div>

                        </div>  
                    </div>
                </div>
                <?php
            } else {
                ?>

                <div class="container">
                    <div class="card card-container" >
                        <h1 style="text-align: center">

                            لا توجد طلبات لإستعراضها في هذا القائمة

                        </h1>
                    </div>
                </div>
                <?php
            }
            ?>

        </div>
    </div>
    @stop