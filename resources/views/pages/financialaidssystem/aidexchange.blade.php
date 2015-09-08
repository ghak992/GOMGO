@extends('app')


@section('title')
صرف المساعدة لـ 
{{$requestinfo[0]->requester_first_name}}{{$requestinfo[0]->requester_middle_name}}
{{$requestinfo[0]->requester_last_name}}{{$requestinfo[0]->requester_sair_name}}
@stop

@section('style')
<style type="text/css">

</style>
@stop

@section('scripts')
<script type="text/javascript">

    $('.form-request-exchange').submit(function (event) {

        event.preventDefault();
        var data = $(".form-request-exchange").serialize();
        $.ajax({
            url: "{{URL::to('financial-aids-system/request/exchange')}}",
            type: "POST",
            dataType: "json",
            data: data,
            beforeSend: function (xhr) {
                $("#errors-alert").hide();
                $('.formsubmit').attr('disabled', 'disabled');
                $("#exchange-request-resualt").show();
                $('#exchange-request-resualt').html('<i class="fa fa-spinner fa-pulse fa-2x text-left"></i>');
            },
            success: function (response) {
                if (response.status == "true") {

//                    $('#checker-name').text(response.user_name);

                    $('#exchange-request-resualt').html('<i>تمت العملية</i>');
                    $('.form-request-exchange').attr('disabled', 'disabled');
                    $('.formsubmit').hide();

                }
                if (response.status == "false") {
                    $('.formsubmit').removeAttr('disabled');
                    if (response.errorflage == "validation") {
                        $('#errors-alert ul').append('<li>تأكد من إدخال جميع الحقول المطلوبة</li>');
                    }
                    else if (response.errorflage == "budget") {
                        console.log(response.errorinfo);
                        $('#errors-alert ul').append('<li>ميزانية المساعدات لهذا العام لا تسمح بصرف هذه المساعدة</li>');
                    }
                    $('.formsubmit').removeAttr('disabled');
                    $("#errors-alert").show();
                    $("#exchange-request-resualt").hide();
                }
            }, error: function () {
                alert("error!!!!");
            }
        });
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
                    <p class="card-title" style="float: right">
                        <i class="fa fa-money"></i>
                        صرف المساعدة
                        &nbsp;:
                    </p>
                </div>
                <hr>
                <div class="panel-body">
                    <h4 style="text-align: left">
                        صاحب الطلب
                        &nbsp;
                        :
                        &nbsp;
                        {{$requestinfo[0]->requester_first_name}}
                        {{$requestinfo[0]->requester_middle_name}}
                        {{$requestinfo[0]->requester_last_name}}
                        {{$requestinfo[0]->requester_sair_name}}
                    </h4>
                    <br>
                    <div class="alert alert-danger" hidden="" id="errors-alert">
                        <strong>للأسف</strong> حدثت مشكلة <br><br>
                        <ul>

                        </ul>
                    </div>


                    {!! Form::open(['url' => 'financial-aids-system/request/exchange', 'method' => 'POST', 'class'=>'form-request-exchange form-horizontal']) !!}
                    <input type="hidden" value="{{$requestid}}" name="id"/> 


                    <input 
                        name="aidvalue"
                        type="hidden"
                        value="{{$requestinfo[0]->aide_amount}}"
                        class="form-control">

                    <div class="form-group">
                        <div class="col-md-3"></div>
                        <div class="col-md-5">
                            <input 
                                disabled=""
                                value="{{$requestinfo[0]->aide_amount}}" 
                                class="form-control">
                        </div>
                        <label class="col-md-3 control-label" for="name">المبلغ المصروف</label>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3"></div>
                        <div class="col-md-5">
                            <select class="form-control" name="exchangeway">
                                @foreach($exchangeways as $way)
                                <option value="{{$way->id}}">{{$way->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <label class="col-md-3 control-label" for="name"> طريقة صرف المساعدة</label>
                    </div>

                    <div class="form-group">
                        <span class="col-xs-3 text-left" id="exchange-request-resualt">

                        </span>
                        <div class="col-md-6 col-md-offset-4">
                            <?php
                            if ($requestinfo[0]->status == 4) {
                                ?>
                            {!! Form::submit('صرف', ['class'=>"btn btn-primary btn-signin formsubmit"]) !!}
                            <?php
                            } elseif ($requestinfo[0]->status == 6) {
                                ?>
                            <h4 style="color: #ff3333">لقد تم صرف المساعدة سابقا</h4>
                            <?php
                            }
                            ?>
                        </div>
                    </div>


                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>


@stop