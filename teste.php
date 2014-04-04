<?php
/**
 * Created by PhpStorm.
 * User: gustavo
 * Date: 3/31/14
 * Time: 9:42 PM
 */

require_once "class/RollingCurl.php";
define ('URLPREFIX', 'http://127.0.0.1/processaImagem/services/resize.php');

$terms_list = scandir('image/origin');
$terms_list = array_slice($terms_list,2,count($terms_list));


/*function request_callback($response, $info) {
    // parse the page title out of the returned HTML
    if (preg_match("~<title>(.*?)</title>~i", $response, $out)) {
        $title = $out[1];
    }
    echo "<b>$title</b><br />";
    print_r($info);
    echo "<hr>";
}*/


//$rc = new RollingCurl("request_callback");
$rc = new RollingCurl();
$rc->window_size = 5;
foreach ($terms_list as $terms) {
    $search_url = URLPREFIX.'?file='.urlencode("../image/origin/".$terms);
    $request = new RollingCurlRequest($search_url);
    $rc->add($request);
}
if($rc->execute()){
    foreach($rc->getReturns() as $key => $value){
        echo $value['return']. '<br>';
    }
}
