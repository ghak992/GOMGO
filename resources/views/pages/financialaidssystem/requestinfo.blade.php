@extends('app')


@section('title')
طلب
{{$request[0]->requester_first_name}}
{{$request[0]->requester_sair_name}}
@stop

@section('style')
<style type="text/css">

</style>
@stop

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {

        $('#firstcheck-ajax-card-info').hide();
        $('#saverequest-ajax-card-info-card').hide();
        $('.form-request-first-check').submit(function (event) {
            event.preventDefault();
            var data = $(".form-request-first-check").serialize();
            $.ajax({
                url: "{{URL::to('financial-aids-system/request/first-check')}}",
                type: "POST",
                dataType: "json",
                data: data,
                beforeSend: function (xhr) {
                    $('#savecheckbutton').attr('disabled', 'disabled');
                    $('#check-request-resualt').html('<i class="fa fa-spinner fa-pulse fa-2x text-left"></i>');
                },
                success: function (response) {
                    if (response.status == "true") {
                        location.reload();
//                        $('#checker-name').text(response.user_name);
//                        $('#check-date').text(response.created_at);
//                        $('#check-date').text(response.created_at);
//                        $('#valueofaid').text(response.info.aid_amount + 'ريال');
//                        $('#check-comments').text(response.info.note);
//                        $('#request-add-firstcheck').hide();
//                        $('#check-request-resualt').html('<i>تمت العملية</i>');
//                        $('#savecheckbutton').attr('disabled', 'disabled');
//                        $('#firstcheck-ajax-card-info').show();
//                        console.log(response);
                    }
                    if (response.status == "false") {
                        alert('NO!!!')
                    }
                }, error: function () {
                    alert("error!!!!");
                }
            });
        });
        $('.form-save-request').submit(function (event) {
            event.preventDefault();
            var data = $(".form-save-request").serialize();
            $.ajax({
                url: "{{URL::to('financial-aids-system/request/save')}}",
                type: "POST",
                dataType: "json",
                data: data,
                beforeSend: function (xhr) {
                    $('#save-request-resualt').html('<i class="fa fa-spinner fa-pulse fa-2x text-left"></i>');
                    $('#requesttosave').attr('disabled', 'disabled');
                },
                success: function (response) {
                    if (response.status == "true") {
                        location.reload();
//                        $('#saveby-name').text(response.user_name);
//                        $('#save-date').text(response.created_at);
//                        $('#save-comments').text(response.info.note);
//                        $('#request-add-save').hide();
//                        $('#save-request-resualt').html('<i>تمت العملية</i>');
//                        $('#saverequest-ajax-card-info-card').show();
//                        console.log(response);
                    }
                    if (response.status == "false") {
                        alert('NO!!!')
                    }
                }, error: function () {
                    alert("error!!!!");
                }
            });
        });
        $('.form-request-approved').submit(function (event) {
            event.preventDefault();
            var data = $(".form-request-approved").serialize();
            $.ajax({
                url: "{{URL::to('financial-aids-system/request/approved')}}",
                type: "POST",
                dataType: "json",
                data: data,
                beforeSend: function (xhr) {
                    $('#approved-request-resualt').html('<i class="fa fa-spinner fa-pulse fa-2x text-left"></i>');
                    $('#approvedbutton').attr('disabled', 'disabled');
                },
                success: function (response) {
                    if (response.status == "true") {

//                        $('#saveby-name').text(response.user_name);
//                        $('#save-date').text(response.created_at);
//                        $('#save-comments').text(response.info.note);
//                        $('#request-add-save').hide();
//                        $('#approved-request-resualt').html('<i>تمت العملية</i>');
//                        $('#saverequest-ajax-card-info-card').show();
                        location.reload();
                    }
                    if (response.status == "false") {
                        alert('NO!!!')
                    }
                }, error: function () {
                    alert("error!!!!");
                }
            });
        });
        $('.form-request-unsave').submit(function (event) {
            event.preventDefault();
            var data = $(".form-request-unsave").serialize();

            $.ajax({
                url: "{{URL::to('financial-aids-system/request/unsave')}}",
                type: "POST",
                dataType: "json",
                data: data,
                beforeSend: function (xhr) {
                    $('#unsvaebutton').attr('disabled', 'disabled');
                },
                success: function (response) {
                    if (response.status == "true") {
                        location.reload();
                    }
                    if (response.status == "false") {
                        alert('NO!!!')
                    }
                }, error: function () {
                    alert("error!!!!");
                }
            });
        });
    });


</script>
@stop

@section('navbar')
@include('navbar.nav')
@stop


@section('content')
<?php
//foreach ($requests as $requests) {
//    foreach ($$request as $key => $value) {
//        echo $key . " = " . $value . "<br>";
//    }
//    echo "<br>";
//}
?>
<div  class="container" >
    <div id="main-container" class="row">
        <div class="center-block"><div class="container">
                <div class="card card-container" style="max-width: 900px;">
                    <p class="card-title text-right" style="float: right">
                        معلومات الطلب
                        &nbsp;:
                    </p>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-xs-4 text-right" style="float: right">
                            <span class="field-title">رقم الطلب&nbsp;:</span>
                            <span class="field-info">{{$request[0]->id}}</span>

                        </div>
                        <div class="col-xs-4 text-right" style="float: right">
                            <span class="field-title">حالة الطلب&nbsp;:</span>
                            <span class="field-info">{{$request[0]->requeststatus}}</span>

                        </div>
                        <div class="col-xs-4 text-right" style="float: right">
                            <span class="field-title">سبب الطلب&nbsp;:</span>
                            <span class="field-info">{{$request[0]->reasone}}</span>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xs-4 text-right" style="float: right">
                            <span class="field-title">مستلم الطلب&nbsp;:</span>
                            <span class="field-info">

                                {{$request[0]->first_name}}
                                {{$request[0]->middle_name}}
                                {{$request[0]->last_name}}
                                {{$request[0]->sair_name}}</span>
                        </div>
                        <div class="col-xs-6 text-right" style="float: right">
                            <span class="field-title">تاريخ إستلام الطلب&nbsp;:</span>
                            <span class="field-info">
                                <?php
                                $arabicday = array('Saturday' => 'السبت',
                                    'Sunday' => 'الاحد',
                                    'Monday' => 'الاثنين',
                                    'Tuesday' => 'الثلاثاء',
                                    'Wednesday' => 'الاربعاء',
                                    'Thursday' => 'الخميس',
                                    'Friday' => 'الجمعة');
                                $basedate = strtotime($request[0]->created_at);
                                $date = date("l", $basedate);
                                echo $arabicday[$date];
                                ?>
                                <?php
                                $timestamp = strtotime($request[0]->created_at);
                                echo date('Y/m/d', $timestamp);
                                ?>
                            </span>

                        </div>
                    </div>
                </div> 

                <div class="card card-container" style="max-width: 900px;">
                    <p class="card-title text-right" style="float: right">
                        معلومات صاحب الطلب
                        &nbsp;:
                    </p>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-xs-4 text-right" style="float: right">
                            <span class="field-title">العمر&nbsp;:</span>
                            <span class="field-info">
                                <?php
                                $age = date_create($request[0]->requester_bod)->diff(date_create('today'))->y;
                                ?>
                                {{$age}}
                                <?php echo (($age > 60) ? "| كبار السن" : ""); ?>

                            </span>

                        </div>
                        <div class="col-xs-4 text-right" style="float: right">
                            <span class="field-title">الرقم المدني&nbsp;:</span>
                            <span class="field-info">{{$request[0]->requester_civil_id}}</span>

                        </div>
                        <div class="col-xs-4 text-right" style="float: right">
                            <span class="field-title">الإسم&nbsp;:</span>
                            <span class="field-info">
                                {{$request[0]->requester_first_name}}
                                {{$request[0]->requester_middle_name}}
                                {{$request[0]->requester_last_name}}
                                {{$request[0]->requester_sair_name}}</span>

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-4 text-right" style="float: right">
                            <span class="field-title">العنوان&nbsp;:</span>
                            <span class="field-info">{{$request[0]->state_name}} / {{$request[0]->requester_address_district}}</span>

                        </div>
                        <div class="col-xs-4 text-right" style="float: right">
                            <span class="field-title">الحالة الإجتماعية&nbsp;:</span>
                            <span class="field-info">{{$request[0]->maritalstatus}}</span>

                        </div>
                        <div class="col-xs-4 text-right" style="float: right">
                            <span class="field-title">الجنس&nbsp;:</span>
                            <span class="field-info">
                                <?php echo ($request[0]->requester_gender == 'M') ? 'ذكر' : 'أنثى'; ?>
                            </span>

                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-xs-6 text-right" style="float: right">
                            <span class="field-title">الهاتف&nbsp;:</span>
                            <span class="field-info">{{$request[0]->requester_phone}}</span>

                        </div>
                        <?php
                        if ($bastrequestcount > 0) {
                            ?>
                            <div class="col-xs-6 text-right" style="float: right">
                                <span class="field-title">عدد الطلبات التي قام هذا المستخدم بتقديمها&nbsp;</span>
                                <a href="{{URL::to('financial-aids-system/user-requests-list/'.$request[0]->requester_civil_id)}}" class="btn btn-sm btn-primary">{{$bastrequestcount}}</a>

                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-12 text-right" style="float: right">
                            <span class="field-title">الملاحظات&nbsp;:</span>
                            <span class="field-info">
                                {{$request[0]->note}}
                            </span>

                        </div>
                    </div>
                </div>  


                <?php
                if (isset($approvedinfo)) {
                    ?>
                    <div class = "card card-container" style = "max-width: 900px;">
                        <p class = "card-title text-right" style = "float: right">
                            &nbsp;
                            الموافقة
                            :
                        </p>
                        <hr>
                        <br>
                        <div class = "row">
                            <div class = "col-xs-4 text-right" style = "float: right">
                                <span class = "field-title">تمت  الموافقة بواسطة&nbsp;
                                    :</span>
                                <span class = "field-info">
                                    {{$approvedinfo[0]->first_name}}
                                    {{$approvedinfo[0]->middle_name}}
                                    {{$approvedinfo[0]->last_name}}
                                    {{$approvedinfo[0]->sair_name}}
                                </span>
                            </div>
                            <div class = "col-xs-4 text-right" style = "float: right">
                                <span class = "field-title">تاريخ الموافقة&nbsp;
                                    :</span>
                                <span class = "field-info">
                                    <?php
                                    $arabicday = array('Saturday' => 'السبت',
                                        'Sunday' => 'الاحد',
                                        'Monday' => 'الاثنين',
                                        'Tuesday' => 'الثلاثاء',
                                        'Wednesday' => 'الاربعاء',
                                        'Thursday' => 'الخميس',
                                        'Friday' => 'الجمعة');
                                    $basedate = strtotime($approvedinfo[0]->created_at);
                                    $date = date("l", $basedate);
                                    echo $arabicday[$date];
                                    ?>
                                    <?php
                                    $timestamp = strtotime($approvedinfo[0]->created_at);
                                    echo date('Y/m/d', $timestamp);
                                    ?>
                                </span>
                            </div>
                            <div class="col-xs-4 text-right" style="float: right">
                                <span class="field-title">قيمة المساعدة&nbsp;:</span>
                                <span class="field-info" id="valueofaid" style="color: tomato">
                                    {{$approvedinfo[0]->aide_amount}}
                                    ريال
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12 text-right" style="float: right">
                                <span class="field-title">الملاحظات&nbsp;:</span>
                                <span class="field-info">
                                    {{$approvedinfo[0]->not}}
                                </span>

                            </div>
                        </div>
                    </div> 
                    <?php
                }
                ?>

                <?php
                if (isset($checkinfo)) {
                    ?>
                    <div class = "card card-container" style = "max-width: 900px;">
                        <p class = "card-title text-right" style = "float: right">
                            &nbsp;
                            المراجعة
                            :
                        </p>
                        <hr>
                        <br>
                        <div class = "row">
                            <div class = "col-xs-4 text-right" style = "float: right">
                                <span class = "field-title">تمت المراجعة بواسطة&nbsp;
                                    :</span>
                                <span class = "field-info">
                                    {{$checkinfo[0]->first_name}}
                                    {{$checkinfo[0]->middle_name}}
                                    {{$checkinfo[0]->last_name}}
                                    {{$checkinfo[0]->sair_name}}
                                </span>
                            </div>
                            <div class = "col-xs-4 text-right" style = "float: right">
                                <span class = "field-title">تاريخ المراجعة&nbsp;
                                    :</span>
                                <span class = "field-info">
                                    <?php
                                    $arabicday = array('Saturday' => 'السبت',
                                        'Sunday' => 'الاحد',
                                        'Monday' => 'الاثنين',
                                        'Tuesday' => 'الثلاثاء',
                                        'Wednesday' => 'الاربعاء',
                                        'Thursday' => 'الخميس',
                                        'Friday' => 'الجمعة');
                                    $basedate = strtotime($checkinfo[0]->created_at);
                                    $date = date("l", $basedate);
                                    echo $arabicday[$date];
                                    ?>
                                    <?php
                                    $timestamp = strtotime($checkinfo[0]->created_at);
                                    echo date('Y/m/d', $timestamp);
                                    ?>
                                </span>
                            </div>
                            <div class="col-xs-4 text-right" style="float: right">
                                <span class="field-title">قيمة المساعدة المقترحة&nbsp;:</span>
                                <span class="field-info" id="valueofaid" style="color: tomato">
                                    {{$checkinfo[0]->aid_amount}}
                                    ريال
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12 text-right" style="float: right">
                                <span class="field-title">الملاحظات&nbsp;:</span>
                                <span class="field-info">
                                    {{$checkinfo[0]->note}}
                                </span>

                            </div>
                        </div>
                    </div> 
                    <?php
                }
                ?>
                <?php
                if (isset($exchange)) {
                    ?>
                    <div class = "card card-container" style = "max-width: 900px;">
                        <p class = "card-title text-right" style = "float: right">
                            &nbsp;
                            الصرف
                            :
                        </p>
                        <hr>
                        <br>
                        <div class = "row">
                            <div class = "col-xs-4 text-right" style = "float: right">
                                <span class = "field-title">تمت الصرف بواسطة&nbsp;
                                    :</span>
                                <span class = "field-info">
                                    {{$exchange[0]->first_name}}
                                    {{$exchange[0]->middle_name}}
                                    {{$exchange[0]->last_name}}
                                    {{$exchange[0]->sair_name}}
                                </span>
                            </div>
                            <div class = "col-xs-4 text-right" style = "float: right">
                                <span class = "field-title">تاريخ الصرف&nbsp;
                                    :</span>
                                <span class = "field-info">
                                    <?php
                                    $arabicday = array('Saturday' => 'السبت',
                                        'Sunday' => 'الاحد',
                                        'Monday' => 'الاثنين',
                                        'Tuesday' => 'الثلاثاء',
                                        'Wednesday' => 'الاربعاء',
                                        'Thursday' => 'الخميس',
                                        'Friday' => 'الجمعة');
                                    $basedate = strtotime($exchange[0]->created_at);
                                    $date = date("l", $basedate);
                                    echo $arabicday[$date];
                                    ?>
                                    <?php
                                    $timestamp = strtotime($exchange[0]->created_at);
                                    echo date('Y/m/d', $timestamp);
                                    ?>
                                </span>
                            </div>
                            <div class="col-xs-4 text-right" style="float: right">
                                <span class="field-title">قيمة المساعدة المصروفة&nbsp;:</span>
                                <span class="field-info" id="valueofaid" style="color: tomato">
                                    {{$exchange[0]->amount}}
                                    ريال
                                </span>
                            </div>
                        </div>
                    </div> 
                    <?php
                }
                ?>
                <div class="card card-container" style="max-width: 900px;" id="firstcheck-ajax-card-info">
                    <p class="card-title text-right" style="float: right">
                        &nbsp;:
                        المراجعة 
                    </p>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-xs-4 text-right" style="float: right">
                            <span class="field-title">تمت المراجعة بواسطة&nbsp;:</span>
                            <span class="field-info" id="checker-name">

                            </span>
                        </div>
                        <div class="col-xs-4 text-right" style="float: right">
                            <span class="field-title">تاريخ المراجعة&nbsp;:</span>
                            <span class="field-info" id="check-date">

                            </span>
                        </div>
                        <div class="col-xs-4 text-right" style="float: right">
                            <span class="field-title">قيمة المساعدات المقترحة&nbsp;:</span>
                            <span class="field-info" id="valueofaid" style="color: tomato">

                            </span>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-12 text-right" style="float: right">
                            <span class="field-title">الملاحظات&nbsp;:</span>
                            <span class="field-info" id="check-comments">

                            </span>

                        </div>
                    </div>
                </div> 


                <?php
                if (isset($savedinfo)) {
                    ?>

                    <div class = "card card-container" style = "max-width: 900px;">
                        <p class="card-title text-right" style="float: right">
                            الحفظ 
                            &nbsp;:
                        </p>
                        <hr>
                        <br>
                        <div class="row">
                            <div class="col-xs-5 text-right" style="float: right">
                                <span class="field-title">تم حفظ الطلب بواسطة&nbsp;:</span>
                                <span class="field-info" id="saveby-name">
                                    {{$savedinfo[0]->first_name}}
                                    {{$savedinfo[0]->middle_name}}
                                    {{$savedinfo[0]->last_name}}
                                    {{$savedinfo[0]->sair_name}}
                                </span>
                            </div>
                            <div class="col-xs-3 text-right" style="float: right">
                                <span class="field-title">الحالة السابقة للطلب قبل الحفظ&nbsp;:</span>
                                <span class="field-info" id="saveby-name">
                                    {{$savedinfo[0]->title}}
                                </span>
                            </div>
                            <div class="col-xs-4 text-right" style="float: right">
                                <span class="field-title">تاريخ الحفظ&nbsp;:</span>
                                <span class="field-info" id="save-date">
                                    <?php
                                    $arabicday = array('Saturday' => 'السبت',
                                        'Sunday' => 'الاحد',
                                        'Monday' => 'الاثنين',
                                        'Tuesday' => 'الثلاثاء',
                                        'Wednesday' => 'الاربعاء',
                                        'Thursday' => 'الخميس',
                                        'Friday' => 'الجمعة');
                                    $basedate = strtotime($savedinfo[0]->created_at);
                                    $date = date("l", $basedate);
                                    echo $arabicday[$date];
                                    ?>
                                    <?php
                                    $timestamp = strtotime($savedinfo[0]->created_at);
                                    echo date('Y/m/d', $timestamp);
                                    ?>
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-12 text-right" style="float: right">
                                <span class="field-title">الملاحظات&nbsp;:</span>
                                <span class="field-info" id="save-comments">
                                    {{$savedinfo[0]->note}}
                                </span>

                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>

                <div  class="card card-container" style="max-width: 900px;" id="saverequest-ajax-card-info-card">
                    <p class="card-title text-right" style="float: right">
                        الحفظ 
                        &nbsp;:
                    </p>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-xs-6 text-right" style="float: right">
                            <span class="field-title">تم حفظ الطلب بواسطة&nbsp;:</span>
                            <span class="field-info" id="saveby-name">

                            </span>
                        </div>
                        <div class="col-xs-6 text-right" style="float: right">
                            <span class="field-title">تاريخ الحفظ&nbsp;:</span>
                            <span class="field-info" id="save-date">

                            </span>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-12 text-right" style="float: right">
                            <span class="field-title">الملاحظات&nbsp;:</span>
                            <span class="field-info" id="save-comments">

                            </span>

                        </div>
                    </div>
                </div> 

                <div class="card card-container" style="max-width: 900px;">
                    <p class="card-title text-right" style="float: right">
                        المستندات المرفقة
                        &nbsp;:
                    </p>
                    <hr>
                    <br>
                    <div class="row">
                        @foreach ($documents as $file)
                        <div class="col-xs-2 text-right" style="float: right">
                            <a target="_blank"
                               class="btn btn-sm btn-primary"
                               href="<?php echo URL::asset("$file->filepath/$file->name") ?>">
                                <i class="fa fa-file"></i>
                                ملف مرفق</a>
                        </div>
                        @endforeach
                    </div>
                </div> 


                <?php
                if ($request[0]->status != 6) {
                    ?>
                    <div class="card card-container"  style="max-width: 900px;"  <?php echo (($request[0]->status == 4) ? "hidden=''" : ""); ?> >
                        <div class="text-left">
                            {!! Form::open([
                            'role'=>'form',
                            'method' => 'POST',
                            'class'=>'form-request-unsave form-inline']) !!}

                            <?php
                            if ($request[0]->status == 3 && \Auth::user()->role == 4) {
                                ?>
                                <span class="btn btn-default"
                                      id="request-add-firstcheck"
                                      data-toggle="modal"
                                      data-target="#requestapprovedmodal"
                                      >الموافقة على الطلب</span>
                                      <?php
                                  }


                                  if ($request[0]->status == 1 && \Auth::user()->role == 3) {
                                      ?>
                                <span class="btn btn-success"
                                      id="request-add-firstcheck"
                                      data-toggle="modal"
                                      data-target="#firstcheckmodal"
                                      >تحويل الطلب لأخذ الموافقة</span>
                                      <?php
                                  }
                                  if ($request[0]->status == 4) {
                                      ?>
                            <h3>الطلب في انتظار الصرف </h3>
                                      <?php
                                  }


                                  if ($request[0]->status != 2) {
                                      if ((\Auth::user()->role == 3 && $request[0]->status != 3) || \Auth::user()->role == 4) {
                                          ?>

                                    <span class="btn btn-danger"
                                          id="request-add-save"
                                          data-toggle="modal"
                                          data-target="#saverequestmodal"
                                          >تحويل الطلب للحفظ</span>
                                          <?php
                                      }
                                  }



                                  if ($request[0]->status == 2) {
                                      if (\Auth::user()->role == 3 || \Auth::user()->role == 4) {
                                          ?>
                                    <input 
                                        name="id"
                                        type="hidden"
                                        value="{{$request[0]->id}}">

                                    <input 
                                        name="status"
                                        type="hidden"
                                        value="{{$savedinfo[0]->last_status}}">

                                    <button type="submit"
                                            id="unsvaebutton"
                                            class="btn btn-warning"
                                            >استخراج الطلب من الحفظ</button>
                                            <?php
                                        }
                                    }
                                    ?>
                            {!! Form::close() !!}

                        </div>
                    </div> 
    <?php
}
?>


            </div>
        </div>
    </div>
</div>
@stop



@section('modal')

<div class="modal fade"
     dir="rtl"
     id="firstcheckmodal"
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
                    <span class="col-xs-3 text-left" id="check-request-resualt">

                    </span>
                    <div class="col-xs-8 text-right">
                        <h3 class="modal-title" 
                            id="lineModalLabel">تحويل الطلب للموافقة</h3>
                    </div>
                </div>

            </div>
            <div class="modal-body">
                <!-- modal content  -->
                {!! Form::open([
                'role'=>'form',
                'method' => 'POST',
                'class'=>'form-request-first-check form-horizontal']) !!}
                <input 
                    name="id"
                    type="hidden"
                    value="{{$request[0]->id}}">
                <fieldset>
                    <!-- Name input-->
                    <div class="form-group">
                        <div class="col-md-9">
                            <input id="aidvalue"
                                   name="aidvalue"
                                   type="number"
                                   min="1"
                                   step="0.5"
                                   placeholder="قيمة المساعدة بالريال العماني" 
                                   class="form-control">
                        </div>
                        <label class="col-md-3 control-label" for="name">قيمة المساعدة المقترحة</label>
                    </div>


                    <!-- Message body -->
                    <div class="form-group">
                        <div class="col-md-9">
                            <textarea
                                dir="rtl"
                                class="form-control"
                                id="comments"
                                name="comments"
                                placeholder="الملاحظات" rows="5"></textarea>
                        </div>
                        <label class="col-md-3 control-label" for="message">ملاحظات</label>
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
                            <i class="fa fa-save"></i> حفظ</button>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>

<div class="modal fade"
     dir="rtl"
     id="saverequestmodal"
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
                    <span class="col-xs-3 text-left" id="save-request-resualt">

                    </span>
                    <div class="col-xs-8 text-right">
                        <h3 class="modal-title" 
                            id="lineModalLabel">تحويل الطلب للحفظ</h3> 
                    </div>
                </div>

            </div>
            <div class="modal-body">
                <!-- modal content  -->
                {!! Form::open([
                'role'=>'form',
                'method' => 'POST',
                'class'=>'form-save-request form-horizontal']) !!}
                <input 
                    name="id"
                    type="hidden"
                    value="{{$request[0]->id}}">
                <input 
                    name="status"
                    type="hidden"
                    value="{{$request[0]->status}}">
                <fieldset>
                    <!-- Message body -->
                    <div class="form-group">
                        <div class="col-md-9">
                            <textarea dir="rtl" 
                                      class="form-control" 
                                      name="note" 
                                      placeholder="الملاحظات" rows="5"></textarea>
                        </div>
                        <label class="col-md-3 control-label" for="message">ملاحظات</label>
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
                        <button type="submit" 
                                id="requesttosave" class="btn btn-success btn-hover-green"
                                data-action="save" role="button">
                            <i class="fa fa-save"></i> حفظ</button>
                    </div>

                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>



<div class="modal fade"
     id="requestapprovedmodal"
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
                    <span class="col-xs-3 text-left" id="approved-request-resualt">

                    </span>
                    <div class="col-xs-8 text-right">
                        <h3 class="modal-title" 
                            id="lineModalLabel">الموافقة على الطلب</h3>
                    </div>
                </div>

            </div>
            <div class="modal-body">
                <!-- modal content  -->
                {!! Form::open([
                'role'=>'form',
                'method' => 'POST',
                'class'=>'form-request-approved form-horizontal']) !!}
                <input 
                    name="id"
                    type="hidden"
                    value="{{$request[0]->id}}">
                <fieldset>
                    <!-- Name input-->
                    <div class="form-group">
                        <div class="col-md-9">
                            <input id="aidvalue"
                                   disabled="true"
                                   type="number"
<?php
if (isset($checkinfo)) {
    ?>
                                       value="{{$checkinfo[0]->aid_amount}}"
                                       <?php
                                   }
                                   ?>
                                   placeholder="قيمة المساعدة بالريال العماني" 
                                   class="form-control">
                        </div>
                        <label class="col-md-3 control-label" for="name">قيمة المساعدة المقترحة</label>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9">
                            <input id="aidvalue"
                                   name="lastaidvalue"
                                   type="number"
                                   min="1"
<?php if (isset($checkinfo)) {
    ?>
                                       value="{{$checkinfo[0]->aid_amount}}"
                                       <?php
                                   }
                                   ?>
                                   step="0.5"
                                   placeholder="قيمة المساعدة بالريال العماني" 
                                   class="form-control">
                        </div>
                        <label class="col-md-3 control-label" for="name">قيمة المساعدة</label>
                    </div>


                    <!-- Message body -->
                    <div class="form-group">
                        <div class="col-md-9">
                            <textarea
                                dir="rtl"
                                class="form-control"
                                id="comments"
                                name="comments"
                                placeholder="الملاحظات" rows="5"></textarea>
                        </div>
                        <label class="col-md-3 control-label" for="message">ملاحظات</label>
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
                        <button type="submit" id="approvedbutton" class="btn btn-success btn-hover-green"
                                data-action="save" role="button">
                            <i class="fa fa-save"></i> حفظ</button>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>

@stop