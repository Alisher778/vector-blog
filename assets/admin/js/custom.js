//update token
$("form").submit(function () {
    $("input[name='" + csfr_token_name + "']").val($.cookie(csfr_cookie_name));
});

//datatable
$(function () {
    $(document).ready(function () {
        $('#cs_datatable').DataTable({
            "order": [[0, "desc"]],
            "aLengthMenu": [[15, 30, 60, 100], [15, 30, 60, 100, "All"]]
        });
    });
});


//Flat red color scheme for iCheck
$('input[type="checkbox"].flat-orange, input[type="radio"].flat-orange').iCheck({
    checkboxClass: 'icheckbox_flat-orange',
    radioClass: 'iradio_flat-orange'
});

//function save photo order
function saveOrder(id) {
    var value = $('#slider_order_' + id).val();

    //check value
    if ($.isNumeric(value) && value >= 0 && value <= 100000) {
        //it's numeric

        var data = {
            "post_id": id,
            "order_value": value
        };
        //new csrf token
        if ($('#ajax_csrf_hash').val() != "") {
            csfr_token = $('#ajax_csrf_hash').val();
        }

        data[csfr_token_name] = csfr_token;

        $.ajax
        ({
            type: 'POST',
            url: save_slider_order_url,
            data: data,
            success: function (response) {
                $('#ajax_csrf_hash').val(response);
            },
        });
    } else {
        alert("Please enter a valid number value! (0-100000)");
    }

}

//function get subcategories
function getSubcategories(parent_id) {
    $.ajax
    ({
        type: 'GET',
        url: get_subcategories_url,
        data: {
            'parent_id': parent_id,
        },
        success: function (response) {
            location.reload();
        }
    });
}

//function delete post image
function deletePostImage(id) {
    if (confirm("Are you sure you want to delete this image?")) {
        var data = {
            "id": id
        };
        data[csfr_token_name] = csfr_token;

        $.ajax
        ({
            type: 'POST',
            url: delete_post_image_url,
            data: data,
            success: function (response) {
                location.reload();
            },
            error: function (response) {
                location.reload();
            }
        });
    } else {
        return false;
    }
}

//function add or remove slider
function setUserRole(id) {
    $.ajax
    ({
        type: 'POST',
        url: role_url,
        data: {
            "_token": role_token,
            "id": id
        },
        success: function (response) {
            location.reload();

        },
        error: function (response) {
            location.reload();

        }
    });
}

//ajax post delete page
function deletePage(id) {
    if (confirm("Are you sure you want to delete this page?")) {
        if (id) {
            var data = {
                "id": id
            };
            data[csfr_token_name] = csfr_token;

            $.ajax
            ({
                type: 'POST',
                url: delete_page_url,
                data: data,
                success: function (response) {
                    location.reload();
                }
            });
        }
        return false;
    }
}

//Multi Image Previev
window.onload = function () {
    var MultifileUpload = document.getElementById("Multifileupload");

    if (MultifileUpload) {
        MultifileUpload.onchange = function () {
            if (typeof (FileReader) != "undefined") {
                var MultidvPreview = document.getElementById("MultidvPreview");
                MultidvPreview.innerHTML = "";
                var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                for (var i = 0; i < MultifileUpload.files.length; i++) {
                    var file = MultifileUpload.files[i];
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var img = document.createElement("IMG");
                        img.height = "100";
                        img.width = "100";
                        img.src = e.target.result;
                        MultidvPreview.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                }
            } else {
                alert("This browser does not support HTML5 FileReader.");
            }
        }
    }
};


//Multi Image Previev
Multifileupload1.onchange = function () {
    var MultifileUpload = document.getElementById("Multifileupload1");

    if (MultifileUpload) {
        if (typeof (FileReader) != "undefined") {
            var MultidvPreview = document.getElementById("MultidvPreview1");
            MultidvPreview.innerHTML = "";
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            for (var i = 0; i < MultifileUpload.files.length; i++) {
                var file = MultifileUpload.files[i];

                var reader = new FileReader();
                reader.onload = function (e) {
                    var img = document.createElement("IMG");
                    img.height = "100";
                    img.width = "100";
                    img.src = e.target.result;
                    MultidvPreview.appendChild(img);
                }
                reader.readAsDataURL(file);

            }
        } else {
            alert("This browser does not support HTML5 FileReader.");
        }
    }
};







