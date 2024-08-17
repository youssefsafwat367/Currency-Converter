<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template"/>
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template"/>
    <meta name="author" content="potenzaglobalsolutions.com"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    @include('layouts.head')
</head>

<body>

<div class="wrapper">

    <!--=================================
preloader -->

    <div id="pre-loader">
        <img src="assets/images/pre-loader/loader-01.svg" alt="">
    </div>

    <!--=================================
preloader -->

    @include('layouts.main-header')

    @include('layouts.main-sidebar')

    <!--=================================
 Main content -->
    <!-- main-content -->
    <div class="content-wrapper">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="mb-0"> Dashboard</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    </ol>
                </div>
            </div>
        </div>

        <div class="row d-flex statistics">
            <div class="col-xl-6 mb-30">
                <div class="card user-activity h-100">
                    <div class="card-body h-100">
                        <h5 class="card-title h-20">Currency Management</h5>
                        <div class="card-input text-center d-flex justify-content-center align-items-center h-80"
                             style="height: 80%;">
                            <div class="card-body">
                                <a href="{{route('currencies.index')}}"><h4 class="text-danger">View The Currencies</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-6 mb-30">
                <div class="card user-activity h-100">
                    <div class="card-body h-100">
                        <h5 class="card-title h-20">Amount Management</h5>
                        <div class="card-input text-center d-flex justify-content-center align-items-center h-80"
                             style="height: 80%;">
                            <div class="card-body">
                                <a href="{{route('amounts.index')}}"><h4 class="text-danger">View The Amounts</h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main content wrapper end-->
</div>

<!--=================================
footer -->

@include('layouts.footer-scripts')

</body>

</html>
