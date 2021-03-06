<?php
if (!defined('APPPATH'))
    exit('No direct script access allowed');
/**
 * views/_template.php
 *
 * Pass in page title (which will in turn be passed along),
 * menu bar, and content (the page selected by my controllers).
 * The JS for TinyMCE rich text editor is added here.
 *
 * ------------------------------------------------------------------------
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>{title}</title>
        <meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script src="/assets/js/tiny_mce/tiny_mce.js" type="text/javascript"></script>
        <script type="text/javascript">
            tinyMCE.init({
                selector: "textarea",
                content_css: "/assets/css/bootstrap.min.css"
            });
        </script>
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet" media="screen"/>
        <link rel="stylesheet" type="text/css" href="/assets/css/style.css"/>
        {caboose_styles}
    </head>
    <body>
        <div class="container">
            <div class="navbar">
                <div class="navbar-inner">
                    <a class="brand" href="/"><img src="/assets/images/logo.png"/></a>
                    <h1>{title}</h1>
                    {menubar} </div>
            </div>           
            <div id="content">
                {content}
            </div>
            <div id="footer" class="span12">
                Copyright &copy; 2015,  <a href="mailto:someone@somewhere.com">Sanders Lee</a>.
            </div>
        </div>
        <script src="/assets/js/jquery-1.11.1.min.js"></script>
        <script src="/assets/js/bootstrap.min.js"></script>
        {caboose_scripts}
        {caboose_trailings}
    </body>
</html>
