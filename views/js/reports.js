/*=============================================
local Storage check
=============================================*/
if (localStorage.getItem("captureRange2") != null) {
    $("#daterange-btn2 span").html(localStorage.getItem("captureRange2"));
} else {
    $("#daterange-btn2 span").html('<span><i class="fa fa-calendar"> </i>  بەرواری راپۆرت</span>');
}

/*=================================
=       Date range as a button for sale range           =
=================================*/
$('#daterange-btn2').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment(),
        endDate: moment()
    },
    function (start, end) {
        $('#daterange-btn2 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        var startDate = start.format('YYYY-MM-DD');
        var endDate = end.format('YYYY-MM-DD');
        var captureRange = $('#daterange-btn2 span').html();
        localStorage.setItem("captureRange2", captureRange);

        window.location = "index.php?route=sales-report&startDate=" + startDate + "&endDate=" + endDate;
    }
)

/*=================================
canceling Date rangefor sale range
=================================*/

$(".daterangepicker.opensright .ranges .range_inputs .cancelBtn").on("click", function () {
    localStorage.removeItem("captureRange2");
    localStorage.clear();
    window.location = "sales-report";
})

$(".daterangepicker.opensright .ranges li").on("click", function () {
    var todayButton = $(this).attr("data-range-key");
    if (todayButton == "Today") {

        var d = new Date();

        var day = d.getDate();
        var month = d.getMonth() + 1;
        var year = d.getFullYear();
        if (month < 10 && day < 10) {

            var startDate = year + "-0" + month + "-0" + day;
            var endDate = year + "-0" + month + "-0" + day;

        } else if (day < 10) {

            var startDate = year + "-" + month + "-0" + day;
            var endDate = year + "-" + month + "-0" + day;

        } else if (month < 10) {

            var startDate = year + "-0" + month + "-" + day;
            var endDate = year + "-0" + month + "-" + day;

        } else {
            var startDate = year + "-" + month + "-" + day;
            var endDate = year + "-" + month + "-" + day;
        }
        console.log(startDate);
        console.log(endDate);
        localStorage.setItem("captureRange2", "Today");
        window.location = "index.php?route=sales-report&startDate=" + startDate + "&endDate=" + endDate;
    }
})