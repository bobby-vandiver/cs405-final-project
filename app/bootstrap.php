<?php

function head($title, $inline_css = NULL) {

    $default_css= '
        <style>
            body {
                padding-top: 40px;
                padding-bottom: 40px;
                background-color: #f5f5f5;
            }
        </style>';

    if(!$inline_css) {
        $inline_css = $default_css;
    }

    echo '
    <!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <title>' . $title . '</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
    
        <!-- Le styles -->
        <link href="css/bootstrap.css" rel="stylesheet">'
        . $inline_css .
        '<link href="css/bootstrap-responsive.css" rel="stylesheet">
    
        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
          <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
                        <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
                                       <link rel="shortcut icon" href="ico/favicon.png">
      </head>
      ';
}

?>

