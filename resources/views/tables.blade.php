@extends('app')


@section('title')
الجداول
@stop

@section('style')
<style type="text/css">

</style>
@stop

@section('scripts')
<script type="text/javascript">




</script>
@stop


@section('content')
<div  class="container" >
    <div id="main-container" class="row">
        <div class="center-block">

            <div class="center-block"><div class="container">
                    <div class="card card-container" >
                        <div class="row">
                            <div class="filterable">
                                <div class="panel-heading">
                                    <div class="pull-right">
                                        <button class="btn btn-default btn-sm btn-filter">
                                            <span class="fa fa-filter"></span> 
                                            البحث في القائمة
                                        </button>
                                        <a href="" class="btn btn-success btn-sm">
                                            <span class="fa fa-print"></span> 
                                            استخراج الطلبات
                                        </a>
                                    </div>
                                </div>
                                <br>
                                <table class="table table-bordered table-hover" >
                                    <thead>
                                        <tr class="filters">
                                            <th align="right"><input type="checkbox"  text="Dharan" name="checkall"></th>                                          
                                            <th align="right"><input type="text" class="form-control" placeholder="الإسم" disabled></th>
                                            <th align="right"><input type="text" class="form-control" placeholder="الرقم المدني" disabled></th>                                            
                                            <th align="right"><input type="text" class="form-control" placeholder="رقم الطلب" disabled></th>                                            
                                            <th align="right"><input type="text" class="form-control" placeholder="حالة الطلب" disabled></th>
                                            <th align="right"><input type="text" class="form-control" placeholder="سبب الطلب" disabled></th>
                                            <th align="right"><input type="text" class="form-control" placeholder="تاريخ تقديم الطلب" disabled></th>
                                            <th align="right">التفاصيل</th>


                                        </tr>
                                    </thead>
                                    <tbody>


                                        <tr>
                                            <td align="right"><input type="checkbox"  name="check" value="1"></td>
                                            <td align="right">
                                                الاسم
                                            </td>
                                            <td align="right">2323456</td>
                                            <td align="right">12</td>
                                            <td align="right">المراجعة</td>
                                            <td align="right">صحي</td>
                                            <td align="right">
                                                الخميس
                                                20/10/2015
                                            </td>
                                            <td align="right">
                                                <a class="btn btn-sm btn-primary btn-block"
                                                   href=""
                                                   >
                                                    <i class="fa fa-file"></i>
                                                    &nbsp;
                                                    التفاصيل
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                    <form action="http://bootsnipp.com/tags/forms?page=2" method="GET">
                                        <td align="right"><input type="checkbox"  name="check" value="1"></td>
                                        <td align="right">
                                            <input type="text" class="form-control" />
                                        </td>
                                        <td align="right">2323456</td>
                                        <td align="right">12</td>
                                        <td align="right">المراجعة</td>
                                        <td align="right">صحي</td>
                                        <td align="right">
                                            الخميس
                                            20/10/2015
                                        </td>
                                        <td align="right">
                                            <button type="submit"
                                                    class="btn btn-warning  btn-block btn-sm"
                                                    >انشاء</button>
                                        </td>
                                    </form>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center">

                            </div>
                        </div>

                    </div>  
                </div>
            </div>


        </div>
    </div>
    @stop