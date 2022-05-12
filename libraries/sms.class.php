<?php
class sms
{
    private $api_key;
    private $response;
    private $errors;
    const endpoint = "https://rest.messagebird.com/";

    function __construct()
    {
        if ( config("sms")->is_live ) {
            $this->api_key = config("sms")->live_token;
        } else {
            $this->api_key = config("sms")->test_token;
        }
        require_once("libraries/sms/messagebird/vendor/autoload.php");
        $this->provider = new \MessageBird\Client($this->api_key);
        $this->builder = new \MessageBird\Objects\Message();
    }

    function getApiKey()
    {
        return $this->api_key;
    }

    function setApiKey($key = "")
    {
        if ( empty($key) ) {
            echo "access_key is required";
            return;
        }
        $this->api_key = $key;
        return $this;
    }

    function from($from = "")
    {
        if ( empty($from) ) {
            echo "sender is required";
            return;
        }
        $this->builder->originator = $from;
        return $this;
    }

    function to(array $to)
    {
        if ( sizeof($to) < 1 ) {
            echo "recipients is required";
            return;
        }
        $this->builder->recipients = $to;
        return $this;
    }

    function body($body = "")
    {
        if ( empty($body) ) {
            echo "sms body is required";
            return;
        }
        $this->builder->body = $body;
        return $this;
    }

    /**
     * getList
     * Get all sent messages as object
     *
     * @param null
     * @return object
     */
    function getList()
    {
        return $this->provider->messages->getList(array ('offset' => 100, 'limit' => 30));
        //return json_decode(file_get_contents(self::endpoint."messages?access_key=$this->api_key"));
    }

    /**
     * balance
     * Return account balance object
     *
     * @param null
     * @return object
     */
    function balance()
    {
        return $this->provider->balance->read();
        //return json_decode(file_get_contents(self::endpoint."balance?access_key=$this->api_key"));
    }

    /**
     * send
     * Send sms message
     *
     * @param array optional
     * @return null
     */
    function send($body = false)
    {
        if ( $body ) {
            $this->builder->originator = $body["from"];
            $this->builder->recipients = $body["to"];
            $this->builder->body = $body["body"];
        }
        try {
            $this->response = $this->provider->messages->create($this->builder);
        } catch (\MessageBird\Exceptions\AuthenticateException $e) {
            // That means that your accessKey is unknown
            echo "wrong login";
        } catch (\MessageBird\Exceptions\BalanceException $e) {
            // That means that you are out of credits, so do something about it.
            echo "no balance";
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * sent
     * Check if the message sent or not (server side)
     *
     * @param null
     * @return boolen
     */
    function sent()
    {
        return $this->response->recipients->totalSentCount > 0;
    }

    /**
     * delivered
     * Check if the message delivered to recipient(s) or not
     *
     * @param null
     * @return boolen
     */
    function delivered()
    {
        return $this->response->recipients->totalDeliveredCount > 0;
    }


    function details()
    {
        return $this->response->recipients->items;
    }

    /**
     * response
     * Return the response object
     *
     * @param null
     * @return object
     */
    function response()
    {
        return $this->response;
    }
}

?>
