$(document)
    .ready(function () {
        $(".header").height($(window).height());
    });

$(document).ready(function () {
    $("#btn_upload")
        .click(function () {
            var fd = new FormData();
            var files = $("#file")[0].files[0];
            fd.append("file", files);

            // AJAX request
            $.ajax({
                url: "ajaxfile.php",
                type: "post",
                data: fd,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != 0) {
                        // Show image preview
                        $("#preview").append("<img src='" + response + "' width='100' height='100' style='display: inline-block;'>");
                    } else {
                        alert("file not uploaded");
                    }
                }
            });
        });
});

$('#Subject').on('change', function () {
    if ($(this).val() == "IS") {
        $('.MSE').hide();
        $('.IS').show();
    } else if ($(this).val() == "MSE") {
        $('.IS').hide();
        $('.MSE').show();
    }
});