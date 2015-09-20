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
    $('.form-request-info-new-muscatstate').submit(function (event) {
        event.preventDefault();
        var data = $(".form-request-info-new-muscatstate").serialize();
        $.ajax({
            url: "{{URL::to('system-control/requests/addnew')}}",
            type: "POST",
            dataType: "json",
            data: data,
            beforeSend: function (xhr) {
                $(".errors-panel").hide();
                $('.form-request-info-new-muscatstate').attr('disabled', 'disabled');
            },
            success: function (response) {
                responseForm(response)
            }, error: function () {
                alert("error!!!!");
            }
        });
    });
    $('.form-request-info-new-requestreasone').submit(function (event) {
        event.preventDefault();
        var data = $(".form-request-info-new-requestreasone").serialize();
        $.ajax({
            url: "{{URL::to('system-control/requests/addnew')}}",
            type: "POST",
            dataType: "json",
            data: data,
            beforeSend: function (xhr) {
                $(".errors-panel").hide();
                $('.form-request-info-new-requestreasone').attr('disabled', 'disabled');
            },
            success: function (response) {
                responseForm(response)
            }, error: function () {
                alert("error!!!!");
            }
        });
    });
    $('.form-request-info-new-maritalstatus').submit(function (event) {
        event.preventDefault();
        var data = $(".form-request-info-new-maritalstatus").serialize();
        $.ajax({
            url: "{{URL::to('system-control/requests/addnew')}}",
            type: "POST",
            dataType: "json",
            data: data,
            beforeSend: function (xhr) {
                $(".errors-panel").hide();
                $('.form-request-info-new-maritalstatus').attr('disabled', 'disabled');
            },
            success: function (response) {
                responseForm(response)
            }, error: function () {
                alert("error!!!!");
            }
        });
    });
    $('.form-request-info-new-exchangeways').submit(function (event) {
        event.preventDefault();
        var data = $(".form-request-info-new-exchangeways").serialize();
        $.ajax({
            url: "{{URL::to('system-control/requests/addnew')}}",
            type: "POST",
            dataType: "json",
            data: data,
            beforeSend: function (xhr) {
                $(".errors-panel").hide();
                $('.form-request-info-new-exchangeways').attr('disabled', 'disabled');
            },
            success: function (response) {
                responseForm(response)
            }, error: function () {
                alert("error!!!!");
            }
        });
    });


    $('.form-editeinforequest').submit(function (event) {
        event.preventDefault();
        var data = $(".form-editeinforequest").serialize();
        $.ajax({
            url: "{{URL::to('system-control/requests/update')}}",
            type: "POST",
            dataType: "json",
            data: data,
            beforeSend: function (xhr) {
                $(".errors-panel").hide();
                $('.form-editeinforequest').attr('disabled', 'disabled');
            },
            success: function (response) {
                if (response.status == "true") {
                    location.reload();
                }
                if (response.status == "false") {
                    $("#errors-list-editeinforequest").html("");
                    $("#errors-list-editeinforequest").show();
                    $.each(response.errors, function (key, value) {
                        $("#errors-list-editeinforequest").append('<li>' + value + '<i class="fa fa-exclamation"></i></li>');
                    });
                }
            }, error: function () {
                alert("error!!!!");
            }
        });
    });


    function responseForm(response) {
        console.log(response)
        if (response.status == "true") {
        location.reload();
    }
    if (response.status == "false") {
        $("#errors-list-" + response.destinathon).html("");
        $("#errors-panel-" + response.destinathon).show();
        $.each(response.errors, function (key, value) {
            $("#errors-list-" + response.destinathon).append('<li>' + value + '<i class="fa fa-exclamation"></i></li>');
        });
        }
    }


    function seteditmodaleinfo(id, value, destination) {
        $("#editeinforequest-id").val(id);
        $("#editeinforequest-destinathon").val(destination);
        $("#editeinforequest-changevalue").val(value);
    }
</script>
@stop

@section('navbar')
@include('navbar.nav')
@stop

@section('content')

<div class="container">
    <div class="row">

        <div class="col-md-12">
            <!-- Nav tabs --><div class="card">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation"><a href="#exchangeways" aria-controls="exchangeways" role="tab" data-toggle="tab">طرق صرف المساعدة</a></li>
                    <li role="presentation"><a href="#requestreasones" aria-controls="requestreasones" role="tab" data-toggle="tab">طبيعة المساعدات</a></li>
                    <li role="presentation"><a href="#maritalsstatus" aria-controls="maritalsstatus" role="tab" data-toggle="tab">الحالة الاجتماعية</a></li>
                    <li role="presentation" class="active"><a href="#muscatstates" aria-controls="muscatstates" role="tab" data-toggle="tab">ولايات محافظة مسقط</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="muscatstates">
                        <div class="row">

                            <div class="col-lg-12 errors-panel" id="errors-panel-muscatstate" hidden="">
                                <div class="alert alert-danger">
                                    <strong>للأسف</strong> حدثت مشكلة أثناء اضافة الولاية<br><br>
                                    <ol id="errors-list-muscatstate">

                                    </ol>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                {!! Form::open([ 'role'=>'form' ,'method' => 'POST', 'class'=>'form-request-info-new-muscatstate form-inline']) !!}
                                <input type="hidden" name="destinathon" value="muscatstate"/>
                                <div class="form-group">
                                    <label style="font-size: 18px;">اضافة ولاية جديدة</label>
                                    <input type="text" name="state_name" required="" class="form-control"  placeholder="اسم الولاية الجديدة">
                                </div>
                                <button type="submit" class="btn btn-success">
                                    <span class="fa fa-plus"></span>
                                    اضافة
                                </button>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <hr>
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
                                        <th align="right"><input type="text" class="form-control" placeholder="الولاية" disabled></th>
                                        <th align="right" style="text-align: right">تعديل</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($muscatstates as $state) {
                                        ?>
                                        <tr>
                                            <td align="right">
                                                {{$state->state_name}}
                                            </td>
                                            <td style="width: 30px;">
                                               <button class="btn btn-primary btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#editeinforequest"
                                                        onclick='seteditmodaleinfo({{$state->id}}, "{{$state->state_name}}", "muscatstate")'
                                                        >
                                                    <span class="fa fa-edit"></span> 
                                                    تعديل
                                                </button>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="requestreasones">
                        <div class="row">
                            <div class="col-lg-12 errors-panel" id="errors-panel-requestreasone" hidden="">
                                <div class="alert alert-danger">
                                    <strong>للأسف</strong> حدثت مشكلة أثناء الاضافة<br><br>
                                    <ol id="errors-list-requestreasone">

                                    </ol>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                {!! Form::open([ 'role'=>'form' ,'method' => 'POST', 'class'=>'form-request-info-new-requestreasone form-inline']) !!}
                                <input type="hidden" name="destinathon" value="requestreasone"/>
                                <div class="form-group">
                                    <label style="font-size: 18px;">اضافة طبيعة مساعدة جديدة</label>
                                    <input name="type" required="" type="text" class="form-control"  placeholder="طبيعة المساعدة الجديدة">
                                </div>
                                <button type="submit" class="btn btn-success">
                                    <span class="fa fa-plus"></span>
                                    اضافة
                                </button>
                                </form>
                            </div>
                        </div>
                        <hr>
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
                                        <th align="right"><input type="text" class="form-control" placeholder="طبيعة المساعدة" disabled></th>
                                        <th align="right" style="text-align: right">تعديل</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($requestreasones as $resone) {
                                        ?>
                                        <tr>
                                            <td align="right">
                                                {{$resone->type}}
                                            </td>
                                            <td style="width: 30px;">
                                                <button class="btn btn-primary btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#editeinforequest"
                                                        onclick='seteditmodaleinfo({{$resone->id}}, "{{$resone->type}}", "requestreasone")'
                                                        >
                                                    <span class="fa fa-edit"></span> 
                                                    تعديل
                                                </button>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="maritalsstatus">
                        <div class="row">
                            <div class="col-lg-12 errors-panel" id="errors-panel-maritalstatus" hidden="">
                                <div class="alert alert-danger">
                                    <strong>للأسف</strong> حدثت مشكلة أثناء الاضافة<br><br>
                                    <ol id="errors-list-maritalstatus">

                                    </ol>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                {!! Form::open([ 'role'=>'form' ,'method' => 'POST', 'class'=>'form-request-info-new-maritalstatus form-inline']) !!}
                                <input type="hidden" name="destinathon" value="maritalstatus"/>
                                <div class="form-group">
                                    <label style="font-size: 18px;">اضافة حالة اجتماعية جديدة</label>
                                    <input name="title" required="" type="text" class="form-control"  placeholder="الحالة الاجتماعية الجديدة">
                                </div>
                                <button type="submit" class="btn btn-success">
                                    <span class="fa fa-plus"></span>
                                    اضافة
                                </button>
                                </form>
                            </div>
                        </div>
                        <hr>
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
                                        <th align="right"><input type="text" class="form-control" placeholder="الحالة الاجتماعية" disabled></th>
                                        <th align="right" style="text-align: right">تعديل</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($maritalsstatus as $maritalstatus) {
                                        ?>
                                        <tr>
                                            <td align="right">
                                                {{$maritalstatus->title}}
                                            </td>
                                            <td style="width: 30px;">
                                                <button class="btn btn-primary btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#editeinforequest"
                                                        onclick='seteditmodaleinfo({{$maritalstatus->id}}, "{{$maritalstatus->title}}", "maritalstatus")'
                                                        >
                                                    <span class="fa fa-edit"></span> 
                                                    تعديل
                                                </button>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="exchangeways">
                        <div class="row">
                            <div class="col-lg-12 errors-panel" id="errors-panel-exchangeways" hidden="">
                                <div class="alert alert-danger">
                                    <strong>للأسف</strong> حدثت مشكلة أثناء الاضافة<br><br>
                                    <ol id="errors-list-exchangeways">

                                    </ol>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                {!! Form::open([ 'role'=>'form' ,'method' => 'POST', 'class'=>'form-request-info-new-exchangeways form-inline']) !!}
                                <input type="hidden" name="destinathon" value="exchangeways"/>
                                <div class="form-group">
                                    <label style="font-size: 18px;">اضافة طريقة صرف جديدة</label>
                                    <input name="name" required="" type="text" class="form-control"  placeholder="طريقة الصرف الجديدة">
                                </div>
                                <button type="submit" class="btn btn-success">
                                    <span class="fa fa-plus"></span>
                                    اضافة
                                </button>
                                </form>
                            </div>
                        </div>
                        <hr>
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
                                        <th align="right"><input type="text" class="form-control" placeholder="الحالة الاجتماعية" disabled></th>
                                        <th align="right" style="text-align: right">تعديل</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($exchangeways as $exchangeway) {
                                        ?>
                                        <tr>
                                            <td align="right">
                                                {{$exchangeway->name}}
                                            </td>
                                            <td style="width: 30px;">
                                                <button class="btn btn-primary btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#editeinforequest"
                                                        onclick='seteditmodaleinfo({{$exchangeway->id}}, "{{$exchangeway->name}}", "exchangeways")'
                                                        >
                                                    <span class="fa fa-edit"></span> 
                                                    تعديل
                                                </button>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





@stop

@section('modal')
<div class="modal fade"
     dir="rtl"
     id="editeinforequest"
     tabindex="-1" role="dialog"
     aria-labelledby="modalLabel" 
     aria-hidden="true">

    <div class="modal-dialog ">
        <div class="modal-content card card-container">
            <div class="modal-header">
                <div class="row">
                    <div class="col-xs-1 ">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true"><i class="fa fa-close"></i></span><span class="sr-only">Close</span></button>
                    </div>
                    <div class="col-xs-11 errors-panel" id="errors-panel-editeinforequest" hidden="">
                        <div class="alert alert-danger">
                            <strong>للأسف</strong> حدثت مشكلة أثناء التحديث<br><br>
                            <ol id="errors-list-editeinforequest">

                            </ol>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-body">
                <!-- modal content  -->
                {!! Form::open([
                'role'=>'form',
                'method' => 'POST',
                'class'=>'form-editeinforequest form-horizontal']) !!}
                <input 
                    name="id"
                    id="editeinforequest-id"
                    type="hidden">
                <input 
                    name="destinathon"
                    id="editeinforequest-destinathon"
                    type="hidden">
                <fieldset>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input id="editeinforequest-changevalue"
                                   name="changevalue"
                                   type="text"
                                   class="form-control">
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="modal-footer text-left" >
                <div class="btn-group" role="group" aria-label="group button">
                    <div class="btn-group" role="group" >
                        <button type="button"  class="btn btn-danger"
                                data-dismiss="modal"  role="button">
                            <i class="fa fa-close"></i> إغلاق</button>
                    </div>

                    <div class="btn-group" role="group">
                        <button type="submit" id="savecheckbutton" class="btn btn-success btn-hover-green"
                                data-action="save" role="button">
                            <i class="fa fa-save"></i> تحديث</button>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop