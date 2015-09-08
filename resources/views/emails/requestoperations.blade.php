<!DOCTYPE html>
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <style>
            td, th{
                padding:  10px;
            }
            thead tr{
                background: #ffff99;
            }
        </style>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body dir="rtl">
        <table border="1" style="max-width: 990px;">
            <thead>
                <tr>
                    <th>العملية</th>
                    <th>تمت العملية بواسطة</th>
                    <th>رقم الطلب</th>
                    <th>اسم صاحب المعاملة</th>
                    <th>تاريخ العملية</th>
                    <th>معاينة الطلب</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$operation_title}}</td>
                    <td>
                        <?php
                        $creator = \Illuminate\Support\Facades\Auth::user();
                        echo $creator->first_name . ' ' . $creator->middle_name . ' ' . $creator->sair_name . '<br>';
                        ?>
                    </td>
                    <td>{{$request_id}}</td>
                    <td>{{$requestername}}</td>
                    <td>
                        <?php
                        $arabicday = array('Saturday' => 'السبت',
                            'Sunday' => 'الاحد',
                            'Monday' => 'الاثنين',
                            'Tuesday' => 'الثلاثاء',
                            'Wednesday' => 'الاربعاء',
                            'Thursday' => 'الخميس',
                            'Friday' => 'الجمعة');
                        $basedate = strtotime($created_at);
                        $date = date("l", $basedate);
                        echo $arabicday[$date];
                        ?>
                        <?php
                        $timestamp = strtotime($created_at);
                        echo date('Y/m/d', $timestamp);
                        ?>
                    </td>
                    <td><a href="{{URL::to('financial-aids-system/requests-info/'.$request_id)}}">الرابط</a></td>
                </tr>
            </tbody>
        </table>

    </body>
</html>
