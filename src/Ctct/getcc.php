<?php
include 'ccapi.php';
// use Ctct\Auth\CtctOAuth2;
// use Ctct\Util\Config;
// use GuzzleHttp\Client;
// use GuzzleHttp\Message\Response;
// use GuzzleHttp\Stream\Stream;
// use GuzzleHttp\Subscriber\Mock;
        $http_origin = $_SERVER['HTTP_ORIGIN'];

        if ($http_origin == "https://www.ksbar.org" || $http_origin == "https://site-ksbar.c9users.io/" || $http_origin == "https://site-ksbar.appspot.com/")
        {
            header("Access-Control-Allow-Origin: ".$http_origin);
        }
        header('Content-Type: application/json;charset=UTF-8');

//
// /emailmarketing/campaigns/1131596922378


        // declare/get a few variables
        $method = isset($_GET['method']) ? $_GET['method']:$defUID;
        $status = isset($_GET['status']) ? 'status='.$_GET['status'].'&':'';
        $id = isset($_GET['id']) ? '/'.$_GET['id']:'';
        $tracking = isset($_GET['tracking']) ? '/tracking/'.$_GET['tracking']:'';
        $email = isset($_GET['email']) ? 'email='.$_GET['email'].'&':'';
        $action_by = isset($_GET['action_by']) ? 'action_by='.$_GET['action_by'].'&':'';
        $next = isset($_GET['next']) ? 'next='.$_GET['next'].'&':'';
        $url = $base.$method.$id.$tracking.'?'.$email.$action_by.$next.$status.'api_key='.$api_key;
        //$_GET['url'];

        $XmlMessage = '';

        /* gets the data from a URL */
        function get_data($url) {
            global $token;
        	$ch = curl_init();
        	$timeout = 5;
        	$options = array(
        	    CURLOPT_URL => $url,
        	    //CURLOPT_POST => true,
        	    CURLOPT_HTTPHEADER => array(
                                            'Authorization: Bearer '.$token,
                                            'Content-Type: application/json;charset-utf-8',
                                            //'Content-Length: 218', //. strlen($XmlMessage),
                                            'Connection: Keep-alive'
                                            //'X-Originating-IP: 50.17.180.192:443'
                                            //'X-Originating-IP: 70.184.226.7'
                                            ),
        	    //CURLOPT_POSTFIELDS => $XmlMessage,
        	    //CURLOPT_RETURNTRANSFER => 1,
        	    CURLOPT_CONNECTTIMEOUT => $timeout
        	);
//echo $options;
        	/*
        	curl_setopt($ch, CURLOPT_URL, $url);
        	curl_setopt($ch, CURLOPT_POST, true);
        	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                                            'Content-Type: text/xml; charset-utf-8',
                                            'Content-Length: 218', //. strlen($XmlMessage),
                                            'Connection: Keep-alive'
                                            ));
        	curl_setopt($ch, CURLOPT_POSTFIELDS, $XmlMessage);
        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

            */

            curl_setopt_array($ch, $options);

        	$data = curl_exec($ch);
        	curl_close($ch);

        	return $data;
        }

        $returned_content = get_data($url);
        echo $returned_content[0];
        //$array_data = json_decode(json_encode(simplexml_load_string(get_data($url))), true);
        //echo $array_data;
?>