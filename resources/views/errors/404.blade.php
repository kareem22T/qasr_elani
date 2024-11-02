<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Snap Skin</title>
    {!! Html::style("assets/backend/dist/css/vendor.styles.css")  !!}
    {!! Html::style("assets/backend/dist/css/demo/floater-template.css")  !!}
    {!! Html::style("assets/backend/dist/images/favicon.png")  !!}
</head>
<body class="fixed-sidebar">
<div class="main-container">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="errors error-v1">
            <div class="row no-gutters">
                <div class="col-10 col-sm-10 col-lg-8 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <img class="error-image" src="{{url('/')}}/assets/backend/dist/images/error-bg/error-bg-1.png" title="Error Occurred"/>
                            <div class="row mt-5">
                                <div class="col-12 text-center mt-xl-2">
                                    <h1 class="error-title">404 Error...</h1>
                                    <p class="error-description">Looks like the page you are trying to access doesn't exist or moved.<br> Please check URL and try again.</p>
                                    <a class="btn btn-sm btn-primary" href="{{Url('/dashboard')}}">Back to home</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End main-container -->

<!-- inject:js -->
{!! Html::script("assets/backend/dist/js/vendor.base.js") !!}
{!! Html::script("assets/backend/dist/js/vendor.bundle.js") !!}
{!! Html::script("assets/backend/dist/js/components/floater-theme/template-floater.js") !!}
<!-- endinject -->
<!-- Custom js for this page-->
<!-- End custom js for this page-->
</body>

</html>
