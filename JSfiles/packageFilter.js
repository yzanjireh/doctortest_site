 $(document).ready(function () {
     $window = $(window);
     $document = $(document);
                $(window).scroll(function () {
                    if (Math.round( $window.scrollTop() +$window.height() -  $document.height()+100)==86) {
//                        $(window).scrollTop() == $(document).height() - $(window).height()){
                        var pagenumber=$("#page_number").val();
                        if ( pagenumber<= $('#total_record').val()) {
                            var pagenum = parseInt(pagenumber) + 1;
                            var q = "<?php echo $q ?> "
                            loadRecord('packageFilter.php?page=' + pagenum +'&q='+q);
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
            $("#new_items").append(data);
        },
        error: function () {}
    });
}

 