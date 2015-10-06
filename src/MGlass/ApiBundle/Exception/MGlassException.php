<?php

namespace MGlass\ApiBundle\Exception;

class MGlassException extends PEAR_Exception {
    public function __construct($message = null, $e = null, $code = 0) {
        $message = ($message ? "$message\n" : "") . "\$_SERVER:" . json_encode($_SERVER) . ";\$_GET:" . json_encode($_GET) . ";\$_POST:" . json_encode($_POST) . ";\$_COOKIE:" . json_encode($_COOKIE) . ";\$_FILES:" . json_encode($_FILES) . ";REQUEST_HEADERS:" . json_encode((function_exists("apache_request_headers") ? apache_request_headers() : array()));
        parent::__construct($message, $e, $code);
    }
}