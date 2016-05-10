<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
                <title><?php echo isset($title)?$title:"Site";?></title>
            <link rel="stylesheet" href="../webroot/css/bootstrap.min.css"/>
        </head>
        <body>
            <div class="container">
                <?php echo $layout_content ?>

            </div>

        </body>
    </html>