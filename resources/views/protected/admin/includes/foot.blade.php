</div>
</div>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <!-- gauge js -->
    <script type="text/javascript" src="{{ asset('assets/js/gauge/gauge.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/gauge/gauge_demo.js') }}"></script>
    <!-- chart js -->
    <script src="{{ asset('assets/js/chartjs/chart.min.js') }}"></script>
    <!-- bootstrap progress js -->
    <script src="{{ asset('assets/js/progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <!-- icheck -->
    <script src="{{ asset('assets/js/icheck/icheck.min.js') }}"></script>
    <!-- daterangepicker -->
    <script type="text/javascript" src="{{ asset('assets/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/datepicker/daterangepicker.js') }}"></script>

    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- flot js -->
    <!--[if lte IE 8]><script type="text/javascript" src="{{ asset('assets/js/excanvas.min.js') }}"></script><![endif]-->
    <script type="text/javascript" src="{{ asset('assets/js/flot/jquery.flot.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/flot/jquery.flot.pie.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/flot/jquery.flot.orderBars.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/flot/jquery.flot.time.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/flot/date.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/flot/jquery.flot.spline.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/flot/jquery.flot.stack.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/flot/curvedLines.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/flot/jquery.flot.resize.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootbox/bootbox.min.js') }}"></script>

    {{--pace--}}
    <script src="{{ asset('assets/js/pace/pace.js')}}"></script>
    <script>
    paceOptions = {
          // Configuration goes here. Example:
          elements: false,
          restartOnPushState: false,
          restartOnRequestAfter: false
    }
    </script>
    <script type="text/javascript">
        var SITE_ROOT = "{{url().'/admin/'}}";
    </script>
</body>
</html>