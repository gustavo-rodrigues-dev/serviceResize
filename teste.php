<?php
/**
 * Created by PhpStorm.
 * User: gustavo
 * Date: 3/31/14
 * Time: 9:42 PM
 */

require_once "class/ParallelCurl.php";
define ('URLPREFIX', 'http://127.0.0.1/processaImagem/services/resize.php');

function on_request_done($content, $url, $ch, $search) {

    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($httpcode !== 200) {
        print "Fetch error $httpcode for '$url'\n";
        return;
    }


    echo print_r($content);
}
echo "<pre>";
$terms_list = scandir('image/origin');
$terms_list = array_slice($terms_list,2,count($terms_list));


$max_requests = 2;

$curl_options = array(
    CURLOPT_SSL_VERIFYPEER => FALSE,
    CURLOPT_SSL_VERIFYHOST => FALSE,
    CURLOPT_USERAGENT, 'Parallel Curl test script',
);

$parallel_curl = new ParallelCurl($max_requests, $curl_options);

foreach ($terms_list as $terms) {
    $search = '"'.$terms.' is a"';
    $search_url = URLPREFIX.'?file='.urlencode("../image/origin/".$terms);
    $parallel_curl->startRequest($search_url, 'on_request_done', $search);
}

var_dump($parallel_curl->getReturns());