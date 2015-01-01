jQuery(document).ready(function($) {
    $("#bw_tabs").jVertTabs();

    $('.bw_tabs-column li').click(function() {
        $('.success-message').hide();
    });


    $('.bw_upload_image').click(function() {
        // get custom data field for the text field to return the url to
        var strInputID = $(this).attr('input-data');

        ssba_tb_interval = setInterval(function() {
            $('#TB_iframeContent').contents().find('.savesend .button').val('Use this image');
        }, 200);
        tb_show('Upload Image', 'media-upload.php?type=image&amp;TB_iframe=true');

        window.send_to_editor = function(html) {
            imgurl = $('img', html).attr('src');
            $('#' + strInputID).val(imgurl);
            tb_remove();
        };

        return false;
    });
});



