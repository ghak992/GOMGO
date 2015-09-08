@extends('app')


@section('title')
الطلبات الجديدة
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
                                <table class="table table-bordered table-hover" >
                                    <thead>
                                        <tr class="filters">
                                            <th align="right">التفاصيل</th>
                                            <th align="right"><input type="text" class="form-control" placeholder="سبب الطلب" disabled></th>
                                            <th align="right"><input type="text" class="form-control" placeholder="الرقم المدني" disabled></th>                                            
                                            <th align="right"><input type="text" class="form-control" placeholder="تاريخ تقديم الطلب" disabled></th>
                                            <th align="right"><input type="text" class="form-control" placeholder="الإسم" disabled></th>
                                            <th align="right"><input type="checkbox"  text="Dharan" name="checkall"></th>                                          
                                            <th align="right"></th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        foreach ($requests as $request) {
                                            ?>
                                            <tr>

                                                <td align="right">
                                                    <a class="btn btn-sm btn-primary btn-block"
                                                       href="{{URL::asset('financial-aids-system/requests-info/'.$request->id)}}"
                                                       >
                                                        <i class="fa fa-file"></i>
                                                        &nbsp;
                                                        التفاصيل
                                                    </a>
                                                </td>
                                                <td align="right">{{$request->requestreasone}}</td>
                                                <td align="right">{{$request->requester_phone}}</td>
                                                <td align="right">{{$request->created_at}}</td>
                                                <td align="right">
                                                                  {{$request->requester_first_name}}
                                                                    {{$request->requester_middle_name}}
                                                                    {{$request->requester_last_name}}
                                                                    {{$request->requester_sair_name}}
                                                </td>
                                                <td align="right"><input type="checkbox"  name="check" value="{{1}}"></td>
                                                <td align="right">{{1}}</td>

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
        </div>
    </div>
    @stop