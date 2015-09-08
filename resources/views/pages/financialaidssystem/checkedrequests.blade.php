@extends('layouts.master')


@section('title')
الطلبات المراجعة
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

@section('contents')
<div  class="container" >
    <div id="main-container" class="row">
        <div class="center-block">

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
                                        <button class="btn btn-warning btn-sm">
                                            <span class="fa fa-print"></span> 
                                            طباعة هذه القائمة
                                        </button>
                                        <button class="btn btn-success btn-sm">
                                            <span class="fa fa-print"></span> 
                                            طباعة كل القوائم
                                        </button>
                                    </div>
                                </div>
                                <br>
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr class="filters">
                                            <th></th>
                                            <th><input type="checkbox"  text="Dharan" name="checkall"></th>
                                            <th><input type="text" class="form-control" placeholder="الإسم" disabled></th>
                                            <th><input type="text" class="form-control" placeholder="الرقم المدني" disabled></th>
                                            <th><input type="text" class="form-control" placeholder="تاريخ تقديم الطلب" disabled></th>
                                            <th><input type="text" class="form-control" placeholder="سبب الطلب" disabled></th>
                                            <th>التفاصيل</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        for ($index = 1; $index < 20; $index++) {
                                            ?>
                                            <tr>
                                                <td>{{$index}}</td>
                                                <td><input type="checkbox"  name="check" value="{{$index}}"></td>
                                                <td>سالم محمد عادل</td>
                                                <td>2015868{{$index}}</td>
                                                <td>{{$index}}/11/2014</td>
                                                <td>طبي</td>
                                                <td>
                                                    <a class="btn btn-sm btn-primary btn-block"
                                                       href="{{URL::asset('financial-aids-system/new-requests-list/requests-info/'.$index)}}"
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
                            <div>
                                <nav class="text-center">
                                    <ul class="pagination">
                                        <!--<li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>-->
                                        <?php
                                        for ($index1 = 1; $index1 < 10; $index1++) {
                                            ?>
                                            <li><a href="#">{{$index1}}</a></li>
                                            <?php
                                        }
                                        ?>

                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
    @stop