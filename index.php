<?php


//absolute path to root directory of app
define("ABSPATH", str_replace("\\", "/",  dirname(__FILE__) ));

//--->minifier > js > start 
function app_minify_js($input) 
{
    if(trim($input) === "") return $input;
    return preg_replace(
        array(
            // Remove comment(s)
            '#\s*("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\')\s*|\s*\/\*(?!\!|@cc_on)(?>[\s\S]*?\*\/)\s*|\s*(?<![\:\=])\/\/.*(?=[\n\r]|$)|^\s*|\s*$#',
            // Remove white-space(s) outside the string and regex
            '#("(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'|\/\*(?>.*?\*\/)|\/(?!\/)[^\n\r]*?\/(?=[\s.,;]|[gimuy]|$))|\s*([!%&*\(\)\-=+\[\]\{\}|;:,.<>?\/])\s*#s',
            // Remove the last semicolon
            '#;+\}#',
            // Minify object attribute(s) except JSON attribute(s). From `{'foo':'bar'}` to `{foo:'bar'}`
            '#([\{,])([\'])(\d+|[a-z_][a-z0-9_]*)\2(?=\:)#i',
            // --ibid. From `foo['bar']` to `foo.bar`
            '#([a-z0-9_\)\]])\[([\'"])([a-z_][a-z0-9_]*)\2\]#i'
        ),
        array(
            '$1',
            '$1$2',
            '}',
            '$1$3',
            '$1.$3'
        ),
    $input);
}
//--->minifier > js > end




//--->minifier > html > start
function app_minify_html($buffer)
{ 
  $buffer =preg_replace('/<!--(.*?)-->/', '', $buffer);
  $buffer =preg_replace('/\>\s*\</', '><', $buffer);
  return $buffer; 
}

//--->minifier > html > end


function app_load_page_files($dir,$file_ext)
{
    $arr = array();
    $ffs = scandir($dir);   

    foreach($ffs as $ff) 
    {
        if($ff != '.' && $ff != '..') 
        {    
            $filename =  $ff;
            $ext = substr($filename,strrpos($filename,'.',-1),strlen($filename));  
            if($ext ==$file_ext)
            {   
                if($file_ext == ".js")
                {
                    //minify_js
                    echo app_minify_js (file_get_contents($dir.$filename))."\n";
                    //need this to ensure there is no code break
                }
                else  if($file_ext == ".html")
                { 
                    echo  app_minify_html(file_get_contents($dir.$filename));
                }
            }
        }
    }
}


//minify html
ob_start("app_minify_html");

?>

<!DOCTYPE html>
<html>

<head>

    <title> Single Page Application </title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="This single page application ">

    <meta name="author" content="Code With Mark">
    <meta name="authorUrl" content="http://codewithmark.com">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/js/bootstrap.min.js"></script>


</head>

<body>



    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
        <div class="container">
            <a class="navbar-brand" href="#">Single Page Application - PHP</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link btn_menu" screen_name="home" href="#/home">Home
              <span class="sr-only">(current)</span>
            </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn_menu" screen_name="about" href="#/about">About</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link btn_menu" screen_name="contact" href="#/contact">Contact</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link btn_menu" screen_name="services" href="#/services">Services</a>
                    </li>


                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container" style="padding-top:20px;">
        <div class="row card ">

            <div class="screen_name text-center text-uppercase	" style="font-size: 70px;"></div>

            <div class="col-lg-12	 screen_data"></div>

        </div>
    </div>



    <div style="display:none;" class="screens">

        <?php app_load_page_files(ABSPATH.'/html/', '.html');    ?>

    </div>



    <script type="text/javascript">
        <?php app_load_page_files(ABSPATH.'/js/', '.js');    ?>
    </script>

</body>

</html>