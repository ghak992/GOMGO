
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header navbar-right">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img src="<?php echo URL::asset('images/خنجر_عماني.png') ?>" style="max-height: 100%;" /></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">



            <ul class="nav navbar-nav" id="PRS" hidden>
                <li class="active"><a href="#">Link</a></li>

                <form class="navbar-form navbar-left"

                      role="search">
                    <div class="form-group">
                        <input 
                            type="text"
                            class="form-control" 
                            placeholder="البحث في السجل القبلي">

                    </div>
                    <button type="submit" class="btn btn-default">بحث</button>
                </form>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
                <li><a href="#">السجل القبلي</a></li>
            </ul>



            <ul class="nav navbar-nav" id="FAS" >
                <li><a href="<?php echo URL::asset('user/logout') ?>">
                        الخروج 
                        <i class="fa fa-sign-out fa-flip-horizontal"></i>
                    </a>
                </li>
                <?php if (\Auth::user()->role == 1) {
                    ?>
                <li  class="dropdown">
                        <a href="#" class="dropdown-toggle" 
                           data-toggle="dropdown" 
                           role="button" 
                           aria-haspopup="true"
                           aria-expanded="false">
                            <span class="caret"></span>&nbsp;
                            الإعدادات
                        </a>

                        <ul class="dropdown-menu" >
                            <li><a href="<?php echo URL::asset('system-control/users') ?>">المستخدمين</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo URL::asset('system-control/budget') ?>">الميزانية</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo URL::asset('system-control/system-pages') ?>">صفحات النظام</a></li>
                        </ul>
                    </li>
                <?php }
                ?>
                <li><a href="<?php echo URL::asset('user/profile') ?>">
                        {{\Auth::user()->first_name .' '. \Auth::user()->sair_name }}
                        <i class="fa fa-user"></i>
                    </a>
                </li>

                {!! Form::open(['url' => 'system-control/search',
                'method' => 'POST', 
                'role' => 'search',
                'id' => 'aid-system-search-form',
                'class'=>'navbar-form navbar-left']) !!}
                <div class="input-group custom-search-form">
                    <span class="input-group-btn">
                        <input

                            id="aid-system-search-form-submit" 
                            type="submit"
                            value="بحث" 
                            class="btn btn-default">
                    </span>
                    <input required=""
                           type="text" 
                           class="form-control" 
                           name="searckeyword"
                           placeholder="البحث في نظام المساعدات المالية">
                    <ul id="search_box_results" class="dropdown-menu" role="menu">

                    </ul>
                </div>
                {!! Form::close() !!}



                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" 
                       data-toggle="dropdown" 
                       role="button" 
                       aria-haspopup="true"
                       aria-expanded="false">
                        <span class="caret"></span>&nbsp;
                        نظام المساعدات المالية
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="<?php echo URL::asset('financial-aids-system') ?>">احصائيات النظام</a></li>
                        <li><a href="<?php echo URL::asset('financial-aids-system/new-request') ?>">طلب جديد</a></li>
                        <li><a href="<?php echo URL::asset('financial-aids-system/new-requests-list') ?>">الطلبات الجديدة</a></li>

                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo URL::asset('financial-aids-system/checked-requests-list') ?>">الطلبات في انتظار الموافقة</a></li>
                        <li><a href="<?php echo URL::asset('financial-aids-system/approved-requests-list') ?>">الطلبات الموافق عليها</a></li>

                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo URL::asset('financial-aids-system/saved-requests-list') ?>">الطلبات المحفوظة</a></li>


                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo URL::asset('financial-aids-system/waiting-exchange-requests-list') ?>">انتظار الصرف</a></li>
                        <li><a href="<?php echo URL::asset('financial-aids-system/exchange-requests-list') ?>">الطلبات المصروفة</a></li>

                    </ul>
                </li>
                <li><a href="#"></a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" 
                       data-toggle="dropdown" 
                       role="button" aria-haspopup="true" 
                       aria-expanded="false">
                        <span class="caret"></span>&nbsp;
                        النظام
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">نظام المساعدات المالية</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">نظام السجل القبلي</a></li>
                    </ul>
                </li>
                <li><a  style="margin-right: 20px; font-size: 18px;">محافظة مسقط</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>