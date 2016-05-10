<?php
/**
 * Created by PhpStorm.
 * User: Malick
 * Date: 01/09/2015
 * Time: 22:33
 */
define('WEBROOT',dirname(__FILE__));
define('ROOT',dirname(WEBROOT));
define('DS',DIRECTORY_SEPARATOR);
define('CORE',ROOT.DS.'core');
define('BASE_URL',(dirname(dirname($_SERVER['SCRIPT_NAME']))));

require(CORE.DS.'include.php');
new Dispatcher();
?>

<pre>
    <?php

    ?>
</pre>