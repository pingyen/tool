<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" >
<meta charset="UTF-8" >
<title>Resize Image</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.2/normalize.min.css" rel="stylesheet" >
<style>
    body {
        background: #EEE;
        font-size: 24px;
        padding: 12px 24px;
    }

    h1 {
        font-size: 42px;
        margin: 0;
    }

    input {
        height: 32px;
        vertical-align: middle;
    }

    input[type=file] {
        font-size: 16px;
        width: 180px;
    }

    input[type=number] {
        width: 160px;
    }

    #preview > p {
        text-align: center;
    }

    #preview > p > img {
        max-width: 90%;
    }
</style>
</head>
<body>
<h1>Resize Image</h1>
<form id="resize">
    <p>Target: <input id="resize-files" type="file" name="files[]" accept="image/*" multiple="multiple" /></p>
    <p>Width: <input id="resize-width" name="width" type="number" value="640" /></p>
    <p>Height: <input id="resize-height" name="height" type="number" /></p>
    <p><label><input id="resize-ratio" name="ratio" value="y" type="checkbox" disabled="disabled" checked="checked" /> Maintain Aspect Ratio</label></p>
    <p>Output Format: <select id="resize-type" name="type"> <option value="jpeg">JPG</option> <option value="png">PNG</option> </select></p>
    <p><input id="resize-submit" type="submit" value="Resize" /></p>
</form>
<div id="preview" ></div>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Resize Image -->
<ins class="ad adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-1821434700708607"
     data-ad-slot="2237259198"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
<!--[if lt IE 9]>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" ></script>
<![endif]-->
<!--[if gte IE 9]><!-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js" ></script>
<!--[endif]-->
<script>
    (function() {
        var $form = $('#resize'),
            $files = $form.find('#resize-files')
            $width = $form.find('#resize-width'),
            $height = $form.find('#resize-height'),
            $ratio = $form.find('#resize-ratio'),
            $type = $form.find('#resize-type'),
            $preview = $('#preview');
            
        $width.change(function() {
            $ratio[0].checked = !this.value || !$height.val();
        });
        
        $height.change(function() {
            $ratio[0].checked = !this.value || !$width.val();
        });
            
        $form.submit(function(e) {
            $preview.empty();

            var width = $width.val() ^ 0,
                height = $height.val() ^ 0,
                type = $type.val();

            Array.prototype.slice.call($files[0].files).forEach(function(file) {
                var fileReader = new FileReader();

                fileReader.onload = function(e) {
                    var image = new Image();
                    
                    image.onload = function() {
                        var w = this.width,
                            h = this.height;

                        var canvas = document.createElement('canvas'),
                            context = canvas.getContext('2d');

                        if (width && height) {
                            w = width;
                            h = height;
                        }
                        else if (width) {
                            h *= width / w;
                            w = width;
                        }
                        else if (height) {
                            w *= height / h;
                            h = height;
                        }

                        canvas.width = w;
                        canvas.height = h;

                        context.drawImage(this, 0, 0, w, h);

                        var dataURL = canvas.toDataURL('image/' + type);

                        $preview.append('<p><img src="' + dataURL + '" ></p>');

                        var name = file.name;
                            i = name.lastIndexOf('.');

                        if(i === -1) {
                            name += (type === 'jpeg' ? '_resized.jpg' : '_resized.png');
                        }
                        else {
                            name = name.substr(0, i) + '_resized.' + (type === 'jpeg' ? 'jpg' : 'png');
                        }

                        if(navigator.msSaveBlob) {
                            navigator.msSaveBlob(canvas.msToBlob(), name);
                            return;
                        }

                        var e = document.createEvent('MouseEvents');

                        e.initEvent('click', true, true);

                        $('<a>', {
                            download : name,
                            href : dataURL,
                            target : '_blank'
                        })[0].dispatchEvent(e);
                    };

                    image.src = e.target.result;
                };
                
                fileReader.readAsDataURL(file);
            });
            
            return false;
        });
    })();
</script>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-6851063-2', 'auto');
    ga('send', 'pageview');
</script>
</body>
</html>
