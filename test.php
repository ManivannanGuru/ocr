<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>OCR Test</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <script type="text/javascript" src="../jquery-1.11.3.min.js"></script>
    </head>

    <body>
        <form name="ocr_form" id="ocr_form">
            <div id="preview"></div>
            <label>
                <input style="width:500px;" type="text" name="url" id="url" placeholder="Enter Image Url" value="http://114.69.235.57:9998/ocr/test.png"/>
            </label>
            <input type="button" id="parse_image" name="parse_image" value="Parse Image"/>
            <div id="parsed_result"></div>
        </form>
    </body>
</html>

<script>
    jQuery(document).ready(function () {
        jQuery(document).on('click', '#parse_image', function () {
            jQuery('#parsed_result').html('<p>Processing...</p>');
            var imageUrl = jQuery.trim(jQuery('#url').val());
            jQuery.post('https://api.ocr.space/parse/image',
                    {
                        apikey: '4d4033618f88957',
                        url: imageUrl,
                        language: 'eng',
                        isOverlayRequired: true
                    },
            function (data) {
                console.log(data);
                jQuery('#parsed_result').html('<p>Output Text : </p>');
                var resultText = data.ParsedResults;
                for (i in resultText) {
                    var row = resultText[i];
                    if(jQuery.trim(row.ErrorDetails) != ''){
                        alert(row.ErrorDetails);
                        return false;
                    }
                    jQuery('#parsed_result').append('<p>' + row.ParsedText + '</p>');
                }
            });
        });

        jQuery(document).on('click', '#parse_image', function () {
            var previewImageUrl = jQuery.trim(jQuery('#url').val());
            jQuery('#preview').html('<img style="width:500px;" src="'+previewImageUrl+'"/>')
        });
    });
</script>
