<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" >
<title>Convert HTML to Image</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" rel="stylesheet" >
<style>
body {
    background: #DDD;
}

h1 {
    margin: 8px 6px;
}

#explain {
    margin: 8px 6px;
}

#explain > p {
    margin: 8px 6px;
}

#explain > p > a {
    color: #DD4B39;
    text-decoration: none;
}

#buttons {
    margin: 12px 6px;
}

#buttons > a {
    -moz-box-shadow: inset 0px 0px 15px 3px #23395e;
    -webkit-box-shadow: inset 0px 0px 15px 3px #23395e;
    box-shadow: inset 0px 0px 15px 3px #23395e;
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #2e466e), color-stop(1, #415989));
    background: -moz-linear-gradient(top, #2e466e 5%, #415989 100%);
    background: -webkit-linear-gradient(top, #2e466e 5%, #415989 100%);
    background: -o-linear-gradient(top, #2e466e 5%, #415989 100%);
    background: -ms-linear-gradient(top, #2e466e 5%, #415989 100%);
    background: linear-gradient(to bottom, #2e466e 5%, #415989 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#2e466e', endColorstr='#415989',GradientType=0);
    background-color: #2e466e;
    -moz-border-radius: 28px;
    -webkit-border-radius: 28px;
    border-radius: 28px;
    border: 1px solid #1f2f47;
    display: inline-block;
    cursor: pointer;
    color: #ffffff;
    font-family: arial;
    font-size: 28px;
    padding: 12px 18px;
    text-decoration: none;
    text-shadow: 0px 1px 0px #263666;
    margin: 0 4px;
}

#buttons > a:hover {
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #415989), color-stop(1, #2e466e));
    background: -moz-linear-gradient(top, #415989 5%, #2e466e 100%);
    background: -webkit-linear-gradient(top, #415989 5%, #2e466e 100%);
    background: -o-linear-gradient(top, #415989 5%, #2e466e 100%);
    background: -ms-linear-gradient(top, #415989 5%, #2e466e 100%);
    background: linear-gradient(to bottom, #415989 5%, #2e466e 100%);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#415989', endColorstr='#2e466e',GradientType=0);
    background-color: #415989;
}

#buttons > a:active {
    position: relative;
    top: 1px;
}

#result {
    margin: 12px;
}

.waiting #container {
    opacity: 0.5;
    transition: opacity .1s ease-in-out;
}

.waiting .spinner {
    display: block;
}

.spinner {
    display: none;
    width: 100%;
    text-align: center;
    position: fixed;
    top: 40%;
}

.spinner > div {
    width: 18px;
    height: 18px;
    background-color: orange;
    border-radius: 100%;
    display: inline-block;
    -webkit-animation: bouncedelay 1.4s infinite ease-in-out;
    animation: bouncedelay 1.4s infinite ease-in-out;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
}

.spinner .bounce1 {
    -webkit-animation-delay: -0.32s;
    animation-delay: -0.32s;
}

.spinner .bounce2 {
    -webkit-animation-delay: -0.16s;
    animation-delay: -0.16s;
}

@-webkit-keyframes bouncedelay {
    0%, 80%, 100% {
        -webkit-transform: scale(0.0);
    }

    40% {
        -webkit-transform: scale(1.0);
    }
}

@keyframes bouncedelay {
    0%, 80%, 100% { 
        transform: scale(0.0);
        -webkit-transform: scale(0.0);
    }

    40% { 
        transform: scale(1.0);
        -webkit-transform: scale(1.0);
    }
}
</style>
</head>
<body>
<div id="container">
    <h1>Convert HTML to Image</h1>
    <div id="explain" >
        <p>You can use this online converter to convert HTML into an image or canvas easily.</p>
        <p>Powered by <a href="http://html2canvas.hertzen.com/" target="_blank" >html2canvas</a> + <a href="http://www.tinymce.com/" target="_blank" >TinyMCE</a>.</p>
    </div>
    <textarea></textarea>
    <p id="buttons" >
        <a id="html2image" href="#" >To Image</a>
        <a id="html2canvas" href="#" >To Canvas</a>
    </p>
    <div id="result" >&nbsp;</div>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-1821434700708607"
         data-ad-slot="4133883193"
         data-ad-format="auto"></ins>
    <script>
    (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</div>
<div class="spinner">
    <div class="bounce1"></div>
    <div class="bounce2"></div>
    <div class="bounce3"></div>
</div>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://cdn.tiny.cloud/1/3jhzwliucx7zy1uq4ozfranba35z3wkc1q8qib7anz1bso91/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
    selector: 'textarea',
    plugins: 'textcolor, charmap, emoticons, fullscreen, image, print, code',
    valid_children: '+body[style]',
    menubar: false,
    toolbar: 'undo redo | fontsizeselect forecolor backcolor bold italic charmap emoticons image | fullscreen print code',
    height: 200
});
</script>
<script>
(function() {
    var editor = null,
        editorBody = null,
        result = document.getElementById('result'),
        htmlClassList = document.documentElement.classList;

    var render = function(kind) {
        htmlClassList.add('waiting');

        if (editor === null) {
            editor = tinymce.activeEditor;
            editorBody = editor.contentDocument.body;
        }

        var content = editor.getContent();

        result.innerHTML = content;

        var images = result.getElementsByTagName('img'),
            n = images.length;

        for (var i = 0; i < n; ++i) {
            var image = images[i];

            image.crossOrigin = 'Anonymous';
            image.src = 'https://cors-anywhere.herokuapp.com/' + image.src;
        }

        html2canvas(result, {
            useCORS: true,
            backgroundColor: null
        }).then(function(canvas) {
            result.innerHTML = '';

            if (kind === 'canvas') {
                result.appendChild(canvas);
            }
            else {
                var image = document.createElement('img');

                image.onload = function() {
                    this.style.width = this.width / (window.devicePixelRatio || 1) + 'px';
                }

                image.onerror = function() {
                    this.style.display = 'none';
                }

                image.src = canvas.toDataURL();

                result.appendChild(image);
            }

            htmlClassList.remove('waiting');
        });
    }

    document.getElementById('html2image').addEventListener('click', function(e) {
        render('image');
        e.preventDefault();
    });

    document.getElementById('html2canvas').addEventListener('click', function(e) {
        render('canvas');
        e.preventDefault();
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
