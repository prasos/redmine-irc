<?php

require_once(__DIR__.'/err.php');

$network_curlh = curl_init();

// Close cURL handle on shutdown. Not sure if really needed.
register_shutdown_function (function() {
    global $network_curlh, $network_irc;
    curl_close($network_curlh);
    if ($network_irc !== NULL) {
        fclose($network_irc);
    }
});

// Run cURL with user data and return the XML response
function curl_xml_get($url) {

    global $network_curlh;
    curl_reset($network_curlh);

    curl_setopt_array($network_curlh, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_URL => $url,
        CURLOPT_HTTPGET => true,
    ]);

    $out = curl_exec($network_curlh);

	// Try to decode JSON
    return simplexml_load_string($out);
}

// Send message to IRC. Connect if not yet done
function irc_raw($msg) {
    global $network_irc, $conf;

    if ($network_irc === NULL) {
        // Connect first
        $network_irc = fsockopen($conf->irc_host, $conf->irc_port);
        if ($network_irc === FALSE) err("Unable to connect to IRC");
        fwrite($network_irc, "PASS {$conf->irc_pass}\nUSER\nNICK\n");
    }
    fwrite($network_irc, $msg);
}
