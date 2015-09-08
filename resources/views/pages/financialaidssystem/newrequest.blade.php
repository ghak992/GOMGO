@extends('app')


@section('title')
طلب مساعدة جديد 
@stop

@section('style')
<style type="text/css">
    form{
        font-size: 18px;
    }

    .right-lable{
        float: right;
    }
    #name-inputs div{
        padding-bottom: 10px;
    }
</style>
@stop

@section('scripts')
<script type="text/javascript">
    $("#civilid").keyup(function () {
        var civilid_box_results = $("#civilid_box_results");
        civilid_box_results.html("");
        if ($("#civilid").val().length >= 8) {
            $.ajax({
                url: "{{URL::to('financial-aids-system/requesterpastrequest')}}",
                type: "POST",
                dataType: "json",
                data: {'civilid': $("#civilid").val(), '_token': $('input[name=_token]').val()},
                beforeSend: function (xhr) {

                    return;
                    civilid_box_results.html("");
                    civilid_box_results.hide();
                },
                success: function (results, textStatus, jqXHR) {
                    if (results.length > 0) {
                        $.each(results, function (id, request) {
                            var url = '{{ URL::to("financial-aids-system/requests-info/:id") }}';
                            url = url.replace(':id', request["id"]);
                            civilid_box_results.append('<li style="padding-top: 3px; font-size:16px; padding-bottom: 3px"><a target="_blank" style="color: #0000C2; word-wrap: break-word; white-space: normal" href="' + url + '" > طلب ' + request["name"] + ' رقم الطلب &nbsp;' + request["id"] + '</a></li > ');
                        });
                    }
                    civilid_box_results.show();
                }
            });
        }
    });
</script>
@stop

@section('navbar')
@include('navbar.nav')
@stop

@section('content')

<div  class="container" >
    <div id="main-container" class="row">
        <div class="center-block"><div class="container">
                <div class="card card-container"  style="max-width: 800px;">
                    <div class="row">
                        <div class="col-xs-12">
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
                            
                            {!! Form::open(['files'=>true, 'url' => 'financial-aids-system/new-request/store', 'role'=>'form' ,'method' => 'POST', 'class'=>'form-newuser form-horizontal']) !!}

                            <fieldset>

                                <!-- Form Name -->
                                <legend>
                                    طلب مساعدة مالية جديد
                                </legend>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <!-- Text input-->
                                <div class="form-group">
                                    <label  
                                        class="col-sm-2 control-label right-lable" 
                                        for="textinput">الإسم الثلاثي والقبيلة</label>
                                    <div id="name-inputs" class="col-sm-10">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input value="{{old('mname') }}"  type="text"
                                                       name="mname"
                                                       required=""
                                                       placeholder="الثاني"
                                                       class="form-control">
                                            </div>
                                            <div class="col-sm-6">
                                                <input value="{{old('fname') }}"  type="text"
                                                       name="fname"
                                                       required=""
                                                       placeholder="الأول"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input value="{{old('sname') }}"  type="text" 
                                                       name="sname"
                                                       required=""
                                                       placeholder="القبيلة" 
                                                       class="form-control">
                                            </div>
                                            <div class="col-sm-6">
                                                <input value="{{old('lname') }}"  type="text" 
                                                       name="lname"
                                                       required=""
                                                       placeholder="الثالث" 
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                                
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label right-lable" for="textinput">تاريخ الميلاد</label>
                                    <div class="col-sm-10">
                                        <input value="{{old('birthday') }}" class="form-control" 
                                               name="birthday"
                                               required=""
                                               type="date" >
                                    </div>
                                </div>

                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label right-lable" for="textinput">الرقم المدني</label>
                                    <div class="col-sm-10">
                                        <input value="{{old('civilid') }}"  type="number" 
                                               name="civilid"
                                               id="civilid"
                                               required=""
                                               placeholder="الرقم المدني"
                                               class="form-control">
                                        <ol id="civilid_box_results">

                                        </ol>
                                    </div>
                                </div>


                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label right-lable" for="textinput">الجنس</label>
                                    <div class="col-sm-4">
                                        <select 
                                            name="maritalstatus"
                                            class="form-control">
                                            @foreach($maritalstatus as $status)
                                            <option value="{{$status->id}}">{{$status->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <label class="col-sm-2 control-label" for="textinput">الحالة الإجتماعية</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="gender">
                                            <option value="M">ذكر</option>
                                            <option value="F">أنثى</option>
                                        </select>
                                    </div>

                                    <br>
                                    <br>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label right-lable" for="textinput">العنوان</label>

                                            <div class="col-sm-5">
                                                <input value="{{old('addressdistrict') }}"  type="text" 
                                                       name="addressdistrict"
                                                       required=""
                                                       placeholder="الحلة" 
                                                       class="form-control">
                                            </div>
                                            <div class="col-sm-5">
                                                <select 
                                                    name="state"
                                                    class="form-control">
                                                    @foreach($muscatstates as $states)
                                                    <option value="{{$states->id}}">{{$states->state_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>



                                    <br>
                                    <br>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label right-lable" for="textinput">رقم الهاتف</label>
                                            <div class="col-sm-10">
                                                <input value="{{old('phone') }}"  type="number" 
                                                       name="phone"
                                                       required=""
                                                       placeholder="رقم الهاتف" 
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    <br>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label right-lable" for="textinput">رقم حساب البنك</label>
                                            <div class="col-sm-10">
                                                <input value="{{old('bankaccount') }}"  type="number" 
                                                       name="bankaccount"
                                                       required=""
                                                       placeholder="الحساب البنكي" 
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <br>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label right-lable" for="textinput">سبب طلب المساعدة</label>
                                            <div class="col-sm-10">
                                                <select  name="reasone" class="form-control">
                                                    @foreach($requestreasone as $reasone)
                                                    <option value="{{$reasone->id}}">{{$reasone->type}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label right-lable" for="textinput">ملاحظات</label>
                                            <div class="col-sm-10">
                                                <textarea
                                                    required
                                                    value="{{old('comments') }}"
                                                    name="comments"
                                                    class="form-control form-textarea" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>




                                    <hr>


                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label right-lable" for="textinput">المستندات المرفقة</label>
                                            <div class="col-sm-10">
                                                <input 
                                                    multiple="true"
                                                    class="form-control"
                                                    name="files[]" 
                                                    type="file"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <div class="pull-left">
                                            <button type="submit" class="btn btn-default">إلغاء</button>
                                            <button type="submit" class="btn btn-primary">حفظ</button>
                                        </div>
                                    </div>
                                </div>

                            </fieldset>
                            {!! Form::close() !!}
                            <br>
                            
                        </div><!-- /.col-lg-12 -->
                    </div><!-- /.row -->
                </div>  

            </div>
        </div>
    </div>
</div>
@stop