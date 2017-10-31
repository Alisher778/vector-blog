//function home slider
$('#home-slider').owlCarousel({
    autoplay: true,
    navigation: true,
    slideSpeed: 3000,
    paginationSpeed: 1000,
    navText: ["<i class='fa fa-angle-left' aria-hidden='true'></i>", "<i class='fa fa-angle-right' aria-hidden='true'></i>"],
    responsive: {
        0: {
            items: 1,
            nav: true,
        },
        600: {
            items: 2,
            nav: true,
        },
        1000: {
            items: 3,
            nav: true,
        }
    }

});


//function random slider
$('#random-slider').owlCarousel({
    autoplay: true,
    loop: true,
    navigation: true, // показывать кнопки next и prev
    slideSpeed: 3000,
    paginationSpeed: 1000,
    items: 1,
    dots: false,
    nav: true,
    navText: ["<i class='fa fa-angle-left random-arrow-prev' aria-hidden='true'></i>", "<i class='fa fa-angle-right random-arrow-next' aria-hidden='true'></i>"],
    itemsDesktop: false,
    itemsDesktopSmall: false,
    itemsTablet: false,
    itemsMobile: false,
    onInitialize: function (event) {
        if ($('#owl-random-post-slider .item').length <= 1) {
            this.settings.loop = false;
        }
    },
});

//function  slider
$(window).load(function () {
    $('#post-detail-slider').owlCarousel({
        navigation: true, // показывать кнопки next и prev
        slideSpeed: 3000,
        paginationSpeed: 1000,
        items: 1,
        dots: false,
        nav: true,
        autoHeight: true,
        navText: ["<i class='fa fa-angle-left post-detail-arrow-prev' aria-hidden='true'></i>", "<i class='fa fa-angle-right post-detail-arrow-next' aria-hidden='true'></i>"],
        itemsDesktop: false,
        itemsDesktopSmall: false,
        itemsTablet: false,
        itemsMobile: false,
        onInitialize: function (event) {
            if ($('#owl-random-post-slider .item').length <= 1) {
                this.settings.loop = false;
            }
        },
    });
});

//add animation to slider arrows
$('#home-slider .owl-prev').addClass('animated fadeIn');
$('#home-slider .owl-next').addClass('animated fadeIn');


//update token
$("form").submit(function () {
    $("input[name='" + csfr_token_name + "']").val($.cookie(csfr_cookie_name));
});


//scroll to top
$(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
        $('.scrollup').fadeIn();
    } else {
        $('.scrollup').fadeOut();
    }
});
$('.scrollup').click(function () {
    $("html, body").animate({scrollTop: 0}, 700);
    return false;
});

// Search Modal
$("[data-toggle='modal-search']").click(function () {
    //if click open
    $('body').toggleClass('search-open');
    return false;
});

$(".modal-search .close").click(function () {
    //close modal
    $('body').removeClass('search-open');
    return false;
});


//show slider navigation on hover
$(document).ready(function () {
    $('#home-slider').hover(
        function () {
            $("#home-slider .owl-nav").css({"display": "block"});
        },

        function () {
            $("#home-slider .owl-nav").css({"display": "none"});
        }
    );
});


//ajax function make comment
$(document).ready(function () {
    $('#make-comment').on('click', function () {

        var comment = $('#comment_text').val();
        var post_id = $('#comment_post_id').val();
        var user_id = $('#comment_user_id').val();

        //validation
        if (comment.trim() == '') {
            $('#comment_text').addClass('has-error');
        } else {
            $('#comment_text').removeClass("has-error");
        }

        if (comment.length > 999) {
            $('#comment_text').addClass('has-error');
            return false;
        }

        //post
        if (comment && post_id && user_id) {
            $('.comment-loader-container').show();

            var data = {
                "comment": comment,
                "post_id": post_id,
                "user_id": user_id,
                "parent_id": 0
            };

            data[csfr_token_name] = $.cookie(csfr_cookie_name);

            $.ajax({
                method: 'POST',
                url: add_comment_url,
                data: data,
            })
                .done(function (response) {
                    $('#comment_text').val('');
                    $('.comment-loader-container').hide();
                    document.getElementById("comment-result").innerHTML = response;
                });
        }
        return false;
    });
});


// function validate email
function validateEmail(sEmail) {
    var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
    if (filter.test(sEmail)) {
        return true;
    }
    else {
        return false;
    }
}

//fucntion show sub comment box
function showSubCommentBox(comment_id) {
    if (comment_id) {
        $('.leave-reply-sub-body').hide();
        if ($('#sub_comment_' + comment_id).is(':visible')) {
            $('leave-reply-sub-body').hide();
            $('.leave-reply').hide();
        } else {
            $('#sub_comment_' + comment_id).show();
            $('.leave-reply').hide();
        }
    }
}

//ajax function make sub comment
function makeSubComment(parent_id) {
    var comment = $('#comment_text_' + parent_id).val();
    var post_id = $('#comment_post_id').val();
    var user_id = $('#comment_user_id').val();

    //validation
    if (comment.trim() == '') {
        $('#comment_text_' + parent_id).addClass('has-error');
    } else {
        $('#comment_text_' + parent_id).removeClass("has-error");
    }
    if (comment.length > 999) {
        $('#comment_text_' + parent_id).addClass('has-error');
        return false;
    }

    //post
    if (comment && post_id && user_id && parent_id) {
        $('.sub-comment-loader-container').show();

        var data = {
            "comment": comment,
            "post_id": post_id,
            "user_id": user_id,
            "parent_id": parent_id
        };

        data[csfr_token_name] = $.cookie(csfr_cookie_name);

        $.ajax({
            method: 'POST',
            url: add_comment_url,
            data: data
        })
            .done(function (response) {
                $('#comment_text_' + parent_id).val('');
                $('.sub-comment-loader-container').hide();
                document.getElementById("comment-result").innerHTML = response;
                $('.leave-reply').show();
            });
    }
    return false;
}


//function add to newsletter
function addToNewsletter() {
    var email = $('#newsletter_email').val();
    if (email.trim() == '' || !validateEmail(email.trim()) || email.length > 199) {
        return false;
    }

    if (email) {

        var data = {
            "email": email,
        };

        //new csrf token
        if ($('#ajax_csrf_hash').val() != "" && $('#ajax_csrf_hash') != null && $('#ajax_csrf_hash').val() != undefined) {
            csfr_token = $('#ajax_csrf_hash').val();
        }

        data[csfr_token_name] = csfr_token;


        $.ajax
        ({
            type: 'POST',
            url: newsletter_url,
            data: data,
            success: function (response) {
                $('#newsletter_email').val('');
                document.getElementById("newsletter-result").innerHTML = response;
            },
            error: function (response) {

            }
        });
    }
    return false;
}

//function delete comment
function deleteComment(title, content, id) {
    $.confirm({
        title: title,
        content: content,
        buttons: {
            Delete: function () {
                var data = {
                    "id": id
                };

                data[csfr_token_name] = $.cookie(csfr_cookie_name);

                $.ajax
                ({
                    type: 'POST',
                    url: delete_comment_url,
                    data: data,
                    success: function (response) {
                        document.getElementById("comment-result").innerHTML = response;
                    },
                    error: function (response) {

                    }
                });
            },
            Cancel: function () {

            },
        }
    });
}

//function get photos by id
function getPhotosByCategory(id) {
    if (id) {
        var data = {
            "id": id
        };

        data[csfr_token_name] = $.cookie(csfr_cookie_name);

        $.ajax
        ({
            type: 'POST',
            url: get_gallery_images_url,
            data: data,
            success: function (response) {
                document.getElementById("gallery-content").innerHTML = response;

                $(document).ready(function () {
                    baguetteBox.run('.image-gallery', {
                        captions: function (element) {
                            return element.getElementsByTagName('img')[0].alt;
                        }
                    });
                });
            },
            error: function (response) {
            }
        });
    }
    return false;
}

//add att to iframe
$(document).ready(function () {
    $('iframe').attr("allowfullscreen", "");
});


//function first captcha
$(document).ready(function () {
    var key = randomString(6);
    localStorage['localCaptcha'] = key;
    var canvas = document.getElementById("canvasC");
    imageElem = document.getElementById("imageCaptcha");

    var ctx = canvas.getContext("2d");
    ctx.font = "bold 22px Lucida Console";
    ctx.textAlign = 'center';
    ctx.fillStyle = '#333';
    ctx.fillText(localStorage['localCaptcha'], 100, 33);
    if (imageElem) {
        imageElem.src = ctx.canvas.toDataURL();
    }
});

//function refresh captcha
function refreshCaptcha() {
    var canvas = document.getElementById("canvasC");
    imageElem = document.getElementById("imageCaptcha");
    canvas.width = canvas.width;

    var key = randomString(6);
    localStorage['localCaptcha'] = key;

    var ctx = canvas.getContext("2d");
    ctx.font = "bold 22px Lucida Console";
    ctx.textAlign = 'center';
    ctx.fillStyle = '#333';
    ctx.fillText(localStorage['localCaptcha'], 100, 33);
    if (imageElem) {
        imageElem.src = ctx.canvas.toDataURL();
    }
}

function checkCaptcha(key) {

    if (key == localStorage['localCaptcha']) {
        return true;
    } else {
        return false;
    }

}
//function get random string
function randomString(len, charSet) {
    charSet = charSet || 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    var randomString = '';
    for (var i = 0; i < len; i++) {
        var randomPoz = Math.floor(Math.random() * charSet.length);
        randomString += charSet.substring(randomPoz, randomPoz + 1);
    }
    return randomString;
}

$(document).ready(function ($) {
    "use strict";

    //magnific popup
    $('.image-popup').magnificPopup({
        type: 'image',
        titleSrc: function (item) {
            return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
        },
        image: {
            verticalFit: true,
        },
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
        },
        removalDelay: 300, //delay removal by X to allow out-animation
        callbacks: {
            beforeOpen: function () {
                this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                this.st.mainClass = "mfp-zoom-out";
            }
        },
        fixedContentPos: true,

    });
});

$(document).ready(function () {
    $(".filters .btn").click(function () {
        $(".filters .btn").removeClass('active');
        $(this).addClass('active');
    });

    //masonry
    $(function () {
        var self = $("#masonry");

        self.imagesLoaded(function () {
            self.masonry({
                gutterWidth: 0,
                isAnimated: true,
                itemSelector: ".gallery-item"
            });
        });

        $(".filters .btn").click(function (e) {
            e.preventDefault();

            var filter = $(this).attr("data-filter");

            self.masonryFilter({
                filter: function () {
                    if (!filter) return true;
                    return $(this).attr("data-filter") == filter;
                }
            });
        });
    });
});