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



    function setsystempagedesc(desc, title) {
    $("#system-page-desc").text(desc);
            $("#systempagetitle").text(title);
    }
    function setsystempageusers(title, id){
    $("#systempageuserstitle").text(title);
            $.ajax({
            url: "{{URL::to('system-control/system-pages/access-users')}}",
                    type: "POST",
                    dataType: "json",
                    data: {'pageid': id, '_token': $('input[name=_token]').val()},
                    beforeSend: function (xhr) {
                    $("#system-page-users-list").html("");
                    },
                    success: function (results, textStatus, jqXHR) {
                    if (results.length > 0) {
                    $.each(results, function (id, user) {
                    var url = '{{ URL::to("system-control/user-info/:id") }}';
                            url = url.replace(':id', user["id"]);
                            $("#system-page-users-list").append(' <li><a target="_blank" href="' + url + '" class="btn" style="font-size: 18px;">' +
                            user["first_name"] + " " +
                            user["middle_name"] + " " +
                            user["last_name"] + " " +
                            user["sair_name"]
                            + '</a></li>   ');
                    });
                    }
                    }
            });
    }

    function setpageupdatemodaledata(id, title, path, desc){
    $("#update-system-page-title").text(" تحديث" + " " + title);
            $("#update-path").val(path);
            $("#update-id").val(id);
            $("#update-title").val(title);
            $("#update-note").val(desc);
    }

    $('.update-system-page').submit(function (event) {
    event.preventDefault();
            var data = $(".update-system-page").serialize();
            $.ajax({
            url: "{{URL::to('system-control/system-pages/update')}}",
                    type: "POST",
                    dataType: "json",
                    data: data,
                    beforeSend: function (xhr) {
                    $('#update-system-page').attr('disabled', 'disabled');
                            $('#update-system-page-resualt').html('<i class="fa fa-spinner fa-pulse fa-2x text-left"></i>');
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
            function setpagedeletemodaledata(id, title){
            $("#delete-system-page-title").text(" حذف" + " " + title);
                    $("#delete-id").val(id);
            }

    $('.delete-system-page').submit(function (event) {
    event.preventDefault();
            var data = $(".delete-system-page").serialize();
            $.ajax({
            url: "{{URL::to('system-control/system-pages/delete')}}",
                    type: "POST",
                    dataType: "json",
                    data: data,
                    beforeSend: function (xhr) {
                    console.log(data)
                            $('#delete-system-page').attr('disabled', 'disabled');
                            $('#delete-system-page-resualt').html('<i class="fa fa-spinner fa-pulse fa-2x text-left"></i>');
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
    });</script>
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
                                <i class="fa fa-file-code-o"></i>
                                اضافة صفحة جديدة
                                &nbsp;:
                            </p>
                        </div>
                        <hr>
                        <br>
                        <div class="row">
                            @if (isset($addsucsess))
                            @if ($addsucsess == true)
                            <div class="alert alert-success">
                                <strong>للأسف</strong> تم اضافة الصفحة الجديدة<br><br>
                            </div>
                            @endif
                            @endif
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
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="col-md-9" style="text-align: right">
                                {!! Form::open([
                                'url' => 'system-control/system-pages/store',
                                'role'=>'form',
                                'method' => 'POST',
                                'class'=>'form-new-year-budget']) !!}

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="control-label right-lable" for="textinput">
                                                <i class="fa fa-link"></i>
                                                مسار الصفحة
                                            </label>
                                            <input value="{{old('path') }}"  type="text" 
                                                   name="path"
                                                   style="text-align: left"
                                                   required=""
                                                   placeholder="path"
                                                   class="form-control">
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="control-label right-lable" for="textinput">
                                                <i class="fa fa-edit"></i>
                                                عنوان الصفحة
                                            </label>
                                            <input value="{{old('title') }}" type="text" 
                                                   required=""
                                                   name="title"
                                                   placeholder="عنوان الصفحة"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label class="control-label right-lable" for="textinput">
                                                <i class="fa fa-file-o"></i>
                                                الوصف
                                            </label>
                                            <textarea 
                                                value="{{old('note') }}"  
                                                name="note"
                                                required=""
                                                placeholder="الوصف"
                                                rows="3"
                                                class="form-control form-textarea"></textarea>
                                        </div>
                                    </div>
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
                                <i class="fa fa-file-code-o"></i>
                                صفحات النظام
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
                                    </div>
                                </div>
                                <br>
                                <table class="table table-bordered table-hover" >
                                    <thead>
                                        <tr class="filters" >
                                            <th align="right" class="table-head"></th> 
                                            <th align="right"><input type="text" class="form-control" placeholder="عنوان الصفحة" disabled></th>
                                            <th align="right"><input type="text" class="form-control" placeholder="المسار" disabled></th>
                                            <th align="right" class="table-head">المستخدمين</th>
                                            <th align="right" class="table-head">الوصف</th>                                            
                                            <th align="right" class="table-head">تعديل</th>                                            
                                            <th align="right" class="table-head">حذف</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        for ($index = 0; $index < count($systempage); $index++) {
                                            ?>
                                            <tr>
                                                <td>{{$index + 1}}</td>
                                                <td align="right">{{$systempage[$index]->title}}</td>
                                                <td style="max-width: 380px; text-align: left;">{{$systempage[$index]->path}}</td>
                                                <td align="right">
                                                    <button 
                                                    <?php echo ($pagesusercount[$systempage[$index]->id] == 0) ? "disabled" : ''; ?>
                                                        class="btn btn-default btn-block btn-sm"
                                                        data-toggle="modal"
                                                        onclick='setsystempageusers("{{$systempage[$index]->title}}", "{{$systempage[$index]->id}}")'
                                                        data-target="#system-page-users-modal">
                                                        <i class="fa fa-users"></i>
                                                        <span style="font-size: 14px;">{{$pagesusercount[$systempage[$index]->id]}}</span>
                                                    </button>

                                                </td>
                                                <td align="right">
                                                    <button class="btn btn-default btn-block btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#system-page-desc-modal"
                                                            onclick='setsystempagedesc("{{$systempage[$index]->note}}", "{{$systempage[$index]->title}}")'
                                                            >
                                                        <i class="fa fa-file-o"></i>
                                                        الوصف
                                                    </button>
                                                </td>
                                                <td align="right">
                                                    <button class="btn btn-primary btn-block btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#system-page-update-modal"
                                                            onclick='setpageupdatemodaledata("{{$systempage[$index]->id}}", "{{$systempage[$index]->title}}", "{{$systempage[$index]->path}}", "{{$systempage[$index]->note}}")'
                                                            >
                                                        <i class="fa fa-edit"></i>
                                                        تعديل
                                                    </button>
                                                </td>
                                                <td align="right">
                                                    <button class="btn btn-danger btn-block btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#system-page-delete-modal"
                                                            onclick='setpagedeletemodaledata("{{$systempage[$index]->id}}", "{{$systempage[$index]->title}}")'
                                                            >
                                                        <i class="fa fa-trash"></i>
                                                        حذف
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>


                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center">
                                {!! $systempage->render() !!}
                            </div>
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
     id="system-page-desc-modal"
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
                            id="systempagetitle"></h3>
                    </div>
                </div>

            </div>
            <div class="modal-body">
                <p id="system-page-desc" style="font-size: 18px;">

                </p>
            </div>

            <div class="modal-footer" >
                <div class="btn-group" role="group" aria-label="group button">
                    <div class="btn-group" role="group" >
                        <button type="button"  class="btn btn-danger"
                                data-dismiss="modal"  role="button">
                            <i class="fa fa-close"></i> إغلاق</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade"
     dir="rtl"
     id="system-page-update-modal"
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
                    <span class="col-xs-3 text-left" id="update-system-page-resualt">

                    </span>
                    <div class="col-xs-8 text-right">
                        <h3 class="modal-title" id="update-system-page-title"></h3>
                    </div>
                </div>

            </div>
            <div class="modal-body" dir="rtl">
                {!! Form::open([
                'role'=>'form',
                'class'=>'form-new-year-budget update-system-page']) !!}
                <input name="id" id="update-id" type="hidden"/>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="control-label right-lable" for="textinput">
                                <i class="fa fa-link"></i>
                                مسار الصفحة
                            </label>
                            <input 
                                type="text" 
                                name="path"
                                id="update-path"
                                style="text-align: left"
                                required=""
                                placeholder="path"
                                class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <label class="control-label right-lable" for="textinput">
                                <i class="fa fa-edit"></i>
                                عنوان الصفحة
                            </label>
                            <input  
                                type="text" 
                                required=""
                                id="update-title"
                                name="title"
                                placeholder="عنوان الصفحة"
                                class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="control-label right-lable" for="textinput">
                                <i class="fa fa-file-o"></i>
                                الوصف
                            </label>
                            <textarea   
                                name="note"
                                id="update-note"
                                required=""
                                placeholder="الوصف"
                                rows="3"
                                class="form-control form-textarea"></textarea>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer" >
                <div class="btn-group" role="group" aria-label="group button">
                    <div class="btn-group" role="group" >
                        <button type="button"  class="btn btn-danger"
                                data-dismiss="modal"  role="button">
                            <i class="fa fa-close"></i> إغلاق</button>
                        <button type="submit" role="button" class="btn btn-success">تعديل</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>


<div class="modal fade"
     dir="rtl"
     id="system-page-delete-modal"
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
                    <span class="col-xs-3 text-left" id="delete-system-page-resualt">

                    </span>
                    <div class="col-xs-8 text-right">
                        <h3 class="modal-title" id="delete-system-page-title"></h3>
                    </div>
                </div>

            </div>
            <div class="modal-body" dir="rtl">
                {!! Form::open([
                'role'=>'form',
                'class'=>'form-new-year-budget delete-system-page']) !!}
                <input name="id" id="delete-id" type="hidden"/>

                <p dir="rtl" style="font-size: 18px; color: tomato; font-weight: bolder;">
                    هل أنت متأكد من رغبتك من حذف هذه الصفحة ؟
                    <br>
                    عند حذفك للصفحة لن يتم ازالتها من النظام بل ستفقد امكانية ادارتها وتحديد
                    المستخدمين القادرين على الوصول إليها
                </p>
            </div>

            <div class="modal-footer" >
                <div class="btn-group" role="group" aria-label="group button">
                    <div class="btn-group" role="group" >
                        <button type="button"  class="btn btn-success"
                                data-dismiss="modal"  role="button">
                            <i class="fa fa-close"></i> إغلاق</button>
                        <button type="submit" role="button" class="btn btn-danger">حذف</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>


<div class="modal fade"
     dir="rtl"
     id="system-page-users-modal"
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
                            id="systempageuserstitle"></h3>
                    </div>
                </div>

            </div>
            <div class="modal-body" dir="rtl">
                <h4> المستخدمين القادرين على الوصول لهذه الصفحة</h4>
                <div >

                    <ol id="system-page-users-list">

                    </ol>

                </div>
            </div>

            <div class="modal-footer" >
                <div class="btn-group" role="group" aria-label="group button">
                    <div class="btn-group" role="group" >
                        <button type="button"  class="btn btn-danger"
                                data-dismiss="modal"  role="button">
                            <i class="fa fa-close"></i> إغلاق</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop