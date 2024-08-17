<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-sm">
                <ul class="nav navbar-nav side-menu" id="sidebarnav" style="min-height: 100vh;">

                    <li>
                        <a href="{{ url('/') }}">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">Dashboard
                                    </span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('currencies.index')  }}">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">CurrencyManagement
                                    </span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('amounts.index')}}">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">Amount Management
                                    </span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>

                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
