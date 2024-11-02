<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>Qasr el aini | Login </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

{!! Html::style('https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all')!!}
{!! Html::style('back/assets/global/plugins/font-awesome/css/font-awesome.min.css')!!}
{!! Html::style('back/assets/global/plugins/simple-line-icons/simple-line-icons.min.css')!!}
{!! Html::style('back/assets/global/plugins/bootstrap/css/bootstrap.min.css')!!}
{!! Html::style('back/assets/global/plugins/uniform/css/uniform.default.css')!!}
<!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
{!! Html::style('back/assets/global/plugins/select2/select2.css')!!}
{!! Html::style('back/assets/admin/pages/css/login-soft.css')!!}
<!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME STYLES -->
{!! Html::style('back/assets/global/css/components-md.css')!!}
{!! Html::style('back/assets/global/css/plugins-md.css')!!}
{!! Html::style('back/assets/admin/layout/css/layout.css')!!}
{!! Html::style('back/assets/admin/layout/css/themes/default.css')!!}
{!! Html::style('back/assets/global/css/login.css')!!}


<!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-md login">
<!-- BEGIN LOGO -->
<div class="logo">
    <h2 style="color:white"><span style="color:red">Qasr el aini</span></h2>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div id="notify" style="display:none;">
    <div id="login-status" class="error-notice info" style="visibility: visible; opacity: 1;">
        <div class="content-wrapper">
            <div id="login-detail">
                <div id="login-status-icon-container"><i class="fa fa-spinner fa-pulse fa-2x fa-fw"></i></div>
                <ul id="login-status-message" class="list-unstyled">Please Wait : Checking for your credentials.</ul>
            </div>
        </div>
    </div>
</div>
<div class="content">
    {!!Form::open(['url'=>Url('/admin/login')])!!}
    <h3 class="form-title">Login to your account</h3>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Email</label>
        <div class="input-icon">
            <i class="fa fa-user"></i>
            <input id="email" class="form-control placeholder-no-fix" type="text" autocomplete="off"
                   placeholder="E-mail" name="email"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <div class="input-icon">
            <i class="fa fa-lock"></i>
            <input id="password" class="form-control " type="password" autocomplete="new-password"
                   placeholder="Password" name="password"/>
        </div>
    </div>
    <div class="form-actions">
        <label class="checkbox"></label>
        <button type="submit" id="btn-login" class="btn blue pull-right">
            Login <i class="m-icon-swapright m-icon-white"></i>
        </button>
    </div>
{!!Form::close()!!}

<!-- END REGISTRATION FORM -->
</div>
<!-- END LOGIN -->

<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="{!!Url('/')!!}/back/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="{!!Url('/')!!}/back/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="{!!Url('/')!!}/back/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{!!Url('/')!!}/back/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="{!!Url('/')!!}/back/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="{!!Url('/')!!}/back/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{!!Url('/')!!}/back/assets/global/plugins/jquery-validation/js/jquery.validate.min.js"
        type="text/javascript"></script>
<script src="{!!Url('/')!!}/back/assets/global/plugins/backstretch/jquery.backstretch.min.js"
        type="text/javascript"></script>
<script type="text/javascript" src="{!!Url('/')!!}/back/assets/global/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{!!Url('/')!!}/back/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="{!!Url('/')!!}/back/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="{!!Url('/')!!}/back/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="{!!Url('/')!!}/back/assets/admin/pages/scripts/login-soft.js" type="text/javascript"></script>
<script src="{!!Url('/')!!}/back/assets/global/js/custom.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>

    $(document).ready(function () {
        $('#btn-login').on('click', function (event) {
            event.preventDefault();
            if ($('#email').val().trim() != '' && $('#password').val().trim() != '') {

                do_login("{{url('/')}}/admin/login");
            }
        });
    })

</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
