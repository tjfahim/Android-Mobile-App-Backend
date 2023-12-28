
<footer class="footer">
    <div class="container-fluid">
        <nav>
           
            <p class="mt-3 text-sm text-center">
                ©   
                <script>
                    document.write(new Date().getFullYear())
                </script> All rights reserved by
                <a href="">{{ $settings->title ?? 'Candelita'}}</a>
            </p>
        </nav>
    </div>
</footer>
</div>
</div>
</body>
<!--   Core JS Files   -->
<script src="{{ asset('backend/assets/js/core/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/js/core/popper.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/js/core/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/js/plugins/bootstrap-switch.js')}}"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<script src="{{ asset('backend/assets/js/plugins/bootstrap-notify.js')}}"></script>
<script src="{{ asset('backend/assets/js/light-bootstrap-dashboard.js?v=2.0.0')}} " type="text/javascript"></script>
<script src="{{ asset('backend/assets/js/demo.js')}}"></script>

<script type="text/javascript">

$(document).ready(function() {
// Javascript method's body can be found in assets/js/demos.js
// demo.initDashboardPageCharts();

// demo.showNotification();

});
</script>

</html>
