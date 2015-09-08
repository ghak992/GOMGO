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
            <ul class="nav navbar-nav" id="FAS" >
                <li><a href="<?php echo URL::asset('user/logout') ?>">
                        <i class="fa fa-sign-out fa-flip-horizontal"></i>
                        الخروج 
                    </a>
                </li>
                <li><a href="<?php echo URL::asset('system-control') ?>">
                        <i class="fa fa-cog"></i>
                        إدارة النظام 
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" 
                       data-toggle="dropdown" 
                       role="button" aria-haspopup="true" 
                       aria-expanded="false">
                        <span class="caret"></span>&nbsp;
                        النظام
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo URL::asset('financial-aids-system') ?>">نظام المساعدات المالية</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">نظام السجل القبلي</a></li>
                    </ul>
                </li>
                <li><a href="#"></a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" 
                       data-toggle="dropdown" 
                       role="button" 
                       aria-haspopup="true"
                       aria-expanded="false">
                        <span class="caret"></span>&nbsp;
                        الإعدادات
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="<?php echo URL::asset('system-control/users') ?>">المستخدمين</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="<?php echo URL::asset('system-control/budget') ?>">الميزانية</a></li>
                    </ul>
                </li>

                <li><a  style="margin-right: 20px; font-size: 18px;">محافظة مسقط</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>