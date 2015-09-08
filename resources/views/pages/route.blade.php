@extends('layouts.master')


@section('title')
index 
@stop

@section('style')
<style type="text/css">
    #main-container{
        margin-top: 10%;
        padding: 20px;
        max-width: 250px;
    }
    .row{
        padding: 20px;
        margin-bottom: 1px;
    }
      .card-container.card {
    max-width: 550px;
}
p{
    font-size: 18px;
    margin-top: 8px;
}
</style>
@stop

@section('scripts')
<script type="text/javascript">

</script>
@stop


@section('contents')
<div  class="container">
    <div id="main-container" class="row">
        <div class="center-block"><div class="container">
                <div class="card card-container">
                    <div class="row">
                        <div class="col-xs-4">
                        <a class="btn btn-block btn-warning">
                                نظام السجل القبلي
                            </a>
                        </div>
                        <div class="col-xs-4">
                            <a href="financial-aids-system"
                                class="btn btn-block btn-primary">
                                نظام المساعدات المالية
                            </a>
                        </div>
                        <div class="col-xs-4">
                            <p style="text-align: right">
                                لأي نظام تود الدخول ؟
                            </p>
                        </div>
                    </div>
                </div>  
            </div></div>
    </div>
</div>


@stop