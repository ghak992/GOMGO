<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            @yield('title')
        </title>
        <!-- Required meta tags always come first -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta content="authenticity_token" name="csrf-param">
        <!-- Bootstrap CSS -->
        <!-- Latest compiled and minified CSS -->
        <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>

        <link href="{{ URL::asset('css/main.css') }}" rel="stylesheet" type="text/css"/>
        @yield('style')
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            body, html {
                background: url("{{ URL::asset('images/background.png') }}") repeat center center fixed;
                background-repeat: repeat;
                background-color: #f9f9f7;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;

            }
        </style>
    </head>
    <body>
        @yield('navbar')

        <div class="main-container" dir="rtl">            
            @yield('content')
        </div>



        
        
        @yield('footer')
        @yield('modal')
        <!-- jQuery first, then Bootstrap JS. -->
        <script src="{{ URL::asset('js/jquery-2.1.1.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('js/main.js') }}" type="text/javascript"></script>
        <script type="text/javascript">
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#search_box_results').hide();
                function closesearchboxresults() {
                    $('#search_box_results').hide();
                }

                $("#aid-system-search-form").submit(function (event) {
                    event.preventDefault();
                    var search_box_results = $("#search_box_results");
                    var data = $("#aid-system-search-form").serialize();
                    $.ajax({
                        url: $(this).attr('action'),
                        type: "POST",
                        dataType: "json",
                        data: data,
                        beforeSend: function (xhr) {
                            search_box_results.html("");
                            search_box_results.hide();
                            $('#aid-system-search-form').attr('disabled', 'disabled');
                        },
                        success: function (results, textStatus, jqXHR) {
                            $('#aid-system-search-form').removeAttr('disabled');
                            if (results.length == 0) {
                                search_box_results.append('<li style="padding-top: 3px; padding-bottom: 3px">لا توجد نتائج لعملية البحث</li>');
                            }
                            else {
                                $.each(results, function (id, request) {
                                    var url = '{{ URL::to("financial-aids-system/requests-info/:id") }}';
                                    url = url.replace(':id', request["id"]);
                                    search_box_results.append('<li style="padding-top: 3px; font-size:16px; padding-bottom: 3px"><a style="color: #0000C2; word-wrap: break-word; white-space: normal" href="' + url + '" > طلب ' + request["name"] + ' رقم الطلب &nbsp;' + request["id"] + '</a></li > ');
                                });
                            }
                            search_box_results.append('<li onclick="closesearchboxresults()" class="btn" style="padding-top: 3px; padding-bottom: 3px">اغلاق <i class="fa fa-close"></i></li>');

                            $('#search_box_results').show();
                        }, error: function () {
                            $('#aid-system-search-form').removeAttr('disabled');
                            alert("error!!!!");
                        }
                    });
                });
        </script>

        @yield('scripts')
    </body >
</html>