@extends('app')

@section('content')
<div class="container">
    <div class="panel">
        <div class="panel-heading">
            طلب مساعدة جديد
        </div>
        <div class="panel-body">
            لقد تم إظافة طلب مساعدة جديد للنظام بواسظة
            <?php
            $creator = \Illuminate\Support\Facades\Auth::user();
            echo $creator->first_name.' '.$creator->middle_name.' '.$creator->sair_name.'<br>';
            echo $creator->email.'<br>';
            ?>
            <hr>
            اسم صاحب الطلب
            {{$requestername}}
            <br>
            رقم الطلب
            {{$request_id}}
        </div>
        <div class="panel-footer">
            <a class="btn btn-primary btn-block" href="http://localhost/GOMGOSystem/public/financial-aids-system/requests-info/{{$request_id}}">معاينة الطلب</a>
        </div>
    </div>
</div>
@endsection
