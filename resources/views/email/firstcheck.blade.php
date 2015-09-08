@extends('app')

@section('content')
<div class="container">
    <div class="panel">
        <div class="panel-heading">
            الموافقة الأولية
        </div>
        <div class="panel-body">
           تم تجويل طلب للموافقة النهائية من قبل
            <?php
            $creator = \Illuminate\Support\Facades\Auth::user();
            echo $creator->first_name.' '.$creator->middle_name.' '.$creator->sair_name.'<br>';
            echo $creator->email.'<br>';
            ?>
            <hr>
            <br>
            رقم الطلب
            {{$request_id}}
        </div>
        <div class="panel-footer">
            <a class="btn btn-primary btn-block" href="{{URL::to('financial-aids-system/requests-info/'.$request_id)}}">معاينة الطلب</a>
        </div>
    </div>
</div>
@endsection
