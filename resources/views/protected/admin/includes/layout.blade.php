@include('protected.admin.includes.head')
@yield('outCSS')
@include('protected.admin.includes.menu')
@include('protected.admin.includes.header')
    <!-- page content -->
    <div class="right_col" role="main">
        @yield('content')
    </div>

@include('protected.admin.includes.foot')
@yield('outJS')

