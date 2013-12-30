<?php
/**
 * Replaces curl calls
 */
require_once 'Mailchimp.php';


class MailchimpStream extends  Mailchimp {

    public function call($url, $params) {
//        echo phpinfo();die;
        $params['apikey'] = $this->apikey;
        $params = json_encode($params);

        $opts = array('http' =>
                      array(
                          'method'  => 'POST',
                          'header'  => 'Content-type: application/json',
                          'content' => json_encode($params),
                          'ssl'=>array('verify_peer'   => $this->ssl_verifypeer),
                           //'ignore_errors' => true
                      )
        );
        $context  = stream_context_create($opts);
        $result = file_get_contents($this->root . $url . '.json', false, $context);

        print_r($result);die;
        /*
        echo "xxx";
        echo  $this->root . $url . '.json';die;
        $ch = $this->ch;

        curl_setopt($ch, CURLOPT_URL, $this->root . $url . '.json');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_VERBOSE, $this->debug);
        // SSL Options
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->ssl_verifypeer);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $this->ssl_verifyhost);
        if ($this->ssl_cainfo) curl_setopt($ch, CURLOPT_CAINFO, $this->ssl_cainfo);

        $start = microtime(true);
        $this->log('Call to ' . $this->root . $url . '.json: ' . $params);
        if($this->debug) {
            $curl_buffer = fopen('php://memory', 'w+');
            curl_setopt($ch, CURLOPT_STDERR, $curl_buffer);
        }

        $response_body = curl_exec($ch);
        $info = curl_getinfo($ch);
        $time = microtime(true) - $start;
        if($this->debug) {
            rewind($curl_buffer);
            $this->log(stream_get_contents($curl_buffer));
            fclose($curl_buffer);
        }
        $this->log('Completed in ' . number_format($time * 1000, 2) . 'ms');
        $this->log('Got response: ' . $response_body);

        if(curl_error($ch)) {
            throw new Mailchimp_HttpError("API call to $url failed: " . curl_error($ch));
        }
        $result = json_decode($response_body, true);
        
        if(floor($info['http_code'] / 100) >= 4) {
            throw $this->castError($result);
        }

        return $result;
        */
    }

}


