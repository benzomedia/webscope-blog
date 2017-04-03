/**
 * Created by Benzo Media.
 * http://www.benzomedia.com
 * User: Oren Reuveni
 * Date: 14/08/2016
 * Time: 10:23
 */
jQuery(document).ready(function($){

    //Initialize HighlightJS
    hljs.initHighlightingOnLoad();

    //Initialize Slick
    $('.featured-posts-div').slick({
        nextArrow:'<button type="button" class="btn btn-default slick-prev"><i class="material-icons">keyboard_arrow_right</i></button>',
        prevArrow:'<button type="button" class="btn btn-default slick-next"><i class="material-icons">keyboard_arrow_left</i></button>'
    });


    //Send sidebar mailchimp form

    $('#mailchimp-form').on('submit', function(e){
        e.preventDefault();

        $('#mc-spinner').css("display","inline-block");

        var data = {
            action: 'webscope_mailchimp_submit',
            email: $('#email-input').val(),
            firstName: $('#first-name-input').val()
        }

        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: data,
            success: function (data) {
                console.log(data);
                $('#mc-spinner').css("display","none");
                $('#loading-div').html("Success! Cool things are on their way")
                $('#email-input').val("")
                $('#first-name-input').val("")
            },
            error: function(error){
                console.log(error);
                $('#mc-spinner').fadeOut()
            }
        });

    })


    //Send after-post mailchimp form
    $('#mc-after-form').on('submit', function(e){
        e.preventDefault();

        $('#mc-after-spinner').css("display","inline-block");

        var data = {
            action: 'webscope_mailchimp_submit',
            email: $('#mc-after-email-input').val(),
            firstName: $('#mc-after-first-name-input').val()
        }

        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: data,
            success: function (data) {
                console.log(data);
                $('#mc-after-spinner').css("display","none");
                $('#mc-after-loading-div').html("Success! Cool things are on their way")
                $('#mc-after-email-input').val("")
                $('#mc-after-first-name-input').val("")
            },
            error: function(error){
                console.log(error);
                $('#mc-after-spinner').fadeOut()
            }
        });



    })
})