</div>
</div>
<!-- JQuery.JS -->
<script src="$inc/js/jquery.min.js"></script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<!-- Main JS -->
<script src="$inc/js/main.js"></script>
<script>

    function toggleBars()
    {
        $sideBar = $('#sidebar');
        $sideBarCollapse = $('#sidebarCollapse');

        if(parseInt($sideBar.css("marginLeft")) < 0)
            $sideBarCollapse
                .find('[data-fa-i2svg]')
                .removeClass('fa-times')
                .removeClass('fa-bars')
                .addClass('fa-bars');
        else
            $sideBarCollapse
                .find('[data-fa-i2svg]')
                .removeClass('fa-times')
                .removeClass('fa-bars')
                .addClass('fa-times');

    }
    $(document).ready(function () {

        setTimeout(toggleBars,100);

        $(window).on('resize', function () {
            toggleBars();
        });

        $('#sidebarCollapse').on('click', function () {
            $('#sidebar')
                .toggleClass('active');

            $(this)
                .find('[data-fa-i2svg]')
                .toggleClass('fa-times')
                .toggleClass('fa-bars');
        });

    });
</script>
</body>