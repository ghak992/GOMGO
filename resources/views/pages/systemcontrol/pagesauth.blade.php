@extends('app')


@section('title')
صلاحيات الوصول
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
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default card">
                <h1 style="color: #ff3333">لا تملك صلاحية الوصول لهذه الصفحة</h1>
                <hr>
                <h3>الصفحات التي يمكن أن تصل لها داخل النظام 
                    :
                </h3>
                <div class="row">

                    <?php
                    foreach ($pages as $page) {
                        ?>
                    <a  class="btn btn-success btn-lg disabled" style="margin: 2px;" href="{{URL::to($page->path)}}">{{$page->title}}</a>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>


@stop