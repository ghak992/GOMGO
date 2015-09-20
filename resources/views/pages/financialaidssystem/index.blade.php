@extends('app')


@section('title')
الطلبات
@stop

@section('style')
<style type="text/css">
    .field-info{
        color: #3333ff;
        font-size: 18px;
        font-weight: bolder;
    }
</style>
@stop

@section('scripts')
<script type="text/javascript">
    $('#year').on('change', function () {
        var url = '{{ URL::to("financial-aids-system/statistics/:id") }}';
        url = url.replace(':id', $(this).val());
       window.location = url;
    });
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
                    <p class="card-title" style="text-align: center">
                        <i class="fa fa-pie-chart"></i>
                        <br>
                        احصائية الطلبات لسنة 
                        <select id="year" class="form-control" style="max-width: 150px; margin-right: auto; margin-left: auto;">
                            <?php
                            foreach ($aidbudgetyears as $aidbudgetyear) {
                                ?>
                                <option value="{{$aidbudgetyear->year}}"
                                <?php echo (($aidbudgetyear->year) == $year) ? "selected" : ""; ?>
                                        >{{$aidbudgetyear->year}}</option>
                                        <?php
                                    }
                                    ?>
                        </select>
                    </p>
                </div>
                <br>
            </div>
        </div>

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default card">
                <div class="text-right">
                    <p class="card-title" style="float: right">
                        <i class="fa fa-calculator"></i>
                        اعداد الطلبات
                        &nbsp;:
                    </p>
                </div>
                <hr>
                <br>
                <div class="row">
                    <div class="col-xs-3 text-right" >
                        <span class="field-title">الموافق عليها&nbsp;:</span>
                        <span class="field-info">{{$statistics["approved"]}}</span>
                    </div>
                    <div class="col-xs-3 text-right" >
                        <span class="field-title">في انتظار الموافقة&nbsp;:</span>
                        <span class="field-info">{{$statistics["waitingapprove"]}}</span>
                    </div>
                    <div class="col-xs-3 text-right" >
                        <span class="field-title">في انتظار المراجعة&nbsp;:</span>
                        <span class="field-info">{{$statistics["newrequest"]}}</span>
                    </div>
                    <div class="col-xs-3 text-right" >
                        <span class="field-title">الطلبات الجديدة&nbsp;:</span>
                        <span class="field-info">{{$statistics["newrequest"]}}</span>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-3 text-right" >
                    </div>
                    <div class="col-xs-3 text-right" >
                        <span class="field-title">المحفوظة&nbsp;:</span>
                        <span class="field-info">{{$statistics["saved"]}}</span>
                    </div>
                    <div class="col-xs-3 text-right" >
                        <span class="field-title">المصروفة&nbsp;:</span>
                        <span class="field-info">{{$statistics["exchange"]}}</span>
                    </div>
                    <div class="col-xs-3 text-right" >
                        <span class="field-title">في انتظار الصرف&nbsp;:</span>
                        <span class="field-info">{{$statistics["waitingexchange"]}}</span>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default card">
                <div class="text-right">
                    <p class="card-title" style="float: right">
                        <i class="fa fa-map-marker"></i>
                        عدد الطلبات على حسب الولايات
                        &nbsp;:
                    </p>
                </div>
                <hr>
                <br>
                <div class="row">
                    <?php
                    foreach ($states as $state) {
                        ?>
                        <div class="col-xs-4 text-right">
                            <span class="field-title">{{$state->state_name}}&nbsp;:</span>
                            <span class="field-info">{{$requestsbystates[$state->id]}}</span>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>


        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default card">
                <div class="text-right">
                    <p class="card-title" style="float: right">
                        <i class="fa fa-list"></i>
                        عدد الطلبات على حسب سبب الطلب
                        &nbsp;:
                    </p>
                </div>
                <hr>
                <br>
                <div class="row">
                    <?php
                    foreach ($reasones as $reasone) {
                        ?>
                        <div class="col-xs-4 text-right">
                            <span class="field-title">{{$reasone->type}}&nbsp;:</span>
                            <span class="field-info">{{$requestsbyreasones[$reasone->id]}}</span>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>


        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default card">
                <div class="text-right">
                    <p class="card-title" style="float: right">
                        <i class="fa fa-users"></i>
                        عدد الطلبات على حسب الجنس
                        &nbsp;:
                    </p>
                </div>
                <hr>
                <br>
                <div class="row">
                    <div class="col-xs-6 text-right">
                        <span class="field-title">الإناث&nbsp;:</span>
                        <span class="field-info">{{$statistics["femailsrequest"]}}</span>
                    </div>
                    <div class="col-xs-6 text-right">
                        <span class="field-title">الذكور&nbsp;:</span>
                        <span class="field-info">{{$statistics["mailsrequest"]}}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default card">
                <div class="text-right">
                    <p class="card-title" style="float: right">
                        <i class="fa fa-money"></i>
                        قيمة الطلبات
                        &nbsp;:
                    </p>
                </div>
                <hr>
                <br>
                <div class="row">

                    <div class="col-xs-6 text-right" >
                        <span class="field-title">قيمة الطلبات الموافق عليها&nbsp;:</span>
                        <span class="field-info">{{$statistics["approvedamount"]}} ريال</span>
                    </div>
                    <div class="col-xs-6 text-right" >
                        <span class="field-title">قيمة الطلبات المصروفة&nbsp;:</span>
                        <span class="field-info">{{$statistics["exchangeamount"]}} ريال</span>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-6 text-right" ></div>
                    <div class="col-xs-6 text-right" >
                        <span class="field-title">قيمة الطلبات في انتظار الصرف&nbsp;:</span>
                        <span class="field-info">{{$statistics["waitingexchangeamount"]}} ريال</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>


@stop