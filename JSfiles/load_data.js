 $(document).ready(function () {
     $window = $(window);
     $document = $(document);
        $(window).scroll(function () {
            if (Math.round( $window.scrollTop() +$window.height() -  $document.height())==-5) {
                if ($(".page_number:last").val() <= $(".total_record").val()) {
                    var pagenum = parseInt($(".page_number:last").val()) + 1;
                    loadRecord('result_data.php?page=' + pagenum);
                }
            }
        });
    });
function loadRecord(url) {
    $.ajax({
        url: url,
        type: "GET",
        data: {total_record: $("#total_record").val()},
        beforeSend: function () {
            $('#loader').show();
        },
        complete: function () {
            $('#loader').hide();
        },
        success: function (data) {
            $("#results").append(data);
        },
        error: function () {}
    });
}

 