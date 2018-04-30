<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cfuel
{
    public $messages;
    public function __construct()
    {
        $messages = array();
    }
    // sendText         x
    // sendImage        x
    // sendVideo        x
    // sendAudio        x
    // sendFile         x
    // sendTextCard
    // sendGallery      x
    // sendAttachment   x
    public function send()
    {
        // echo "<pre>";
        // print_r($this->messages);
        echo json_encode($this->messages, JSON_UNESCAPED_SLASHES);

    }
    public function addText($text)
    {
        $base                         = array("text" => $text);
        $this->messages['messages'][] = $base;
    }
    public function addImage($url)
    {
        $base                         = array('attachment' => array('type' => 'image', 'payload' => array('url' => $url)));
        $this->messages['messages'][] = $base;
    }
    public function addFile($url)
    {
        $base                         = array('attachment' => array('type' => 'file', 'payload' => array('url' => $url)));
        $this->messages['messages'][] = $base;
    }
    public function addAudio($url)
    {
        $base                         = array('attachment' => array('type' => 'audio', 'payload' => array('url' => $url)));
        $this->messages['messages'][] = $base;
    }
    public function addVideo($url)
    {
        $base                         = array('attachment' => array('type' => 'video', 'payload' => array('url' => $url)));
        $this->messages['messages'][] = $base;
    }
    public function addCard($data)
    {
        $base = array('attachment' => array('type' => "template", 'payload' => array("template_type" => "button", "text" => $data['title'], "buttons" => array())));
        foreach ($data['buttons'] as $buttons) {
            $base['attachment']['payload']['buttons'][] = $buttons;
        }
        $this->messages['messages'][] = $base;
    }
    public function addQuickReply($data)
    {
        // $data = array(
        //     array(
        //         "title" => "Yes please 🙏🏼!", "block_names" => array("Search")),
        //     array(
        //         "title" => "Nope 💔", "block_names" => array("Bye"),
        //     ),
        // );
        // $base                         = array("text" => "_", "quick_replies" => $data);
        $this->messages['messages'][] = $data;
    }
    public function redirect($blocks)
    {
        $this->messages['redirect_to_blocks'] = $blocks;
    }
    public function set_attributes($var, $val)
    {
        $this->messages['set_attributes'][$var] = $val;
    }
    public function broadcast($messenger_user_id, $goToBlock)
    {
        //
        //
        //

        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $_request = &$_GET;
                break;
            case 'POST':
                $_request = &$_POST;
                break;
            default:
                $_request = &$_GET;
        }

        // $msgrID    = (!empty($_request['messenger_user_id'])) ? $_request['messenger_user_id'] : '';
        // $goToBlock = (!empty($_request['goToBlock'])) ? $_request['goToBlock'] : '';

        $msgrID = $messenger_user_id;

// HERE IS WHERE YOU SET UP YOUR BROADCAST SETTINGS
        // this needs to be your bot ID
        $botID = '5a6a8196e4b02eba7e337cab';
// this needs to be your bot's broadcast token
        $botToken = 'qwYLsCSz8hk4ytd6CPKP4C0oalstMnGdpDjF8YFHPHCieKNc0AfrnjVs91fGuH74';

// HERE IS WHERE YOU WOULD SET UP USER ATTRIBUTES IF NEEDED
        // set up the user attributes to send back to the bot
        $params = array(
            'user_attribute1' => $this->getRequest('SomeCustomField1'),
            'user_attribute2' => $this->getRequest('SomeCustomField2'),
        );

        $sendUrl = 'https://api.chatfuel.com/bots/' . $botID . '/users/' . $msgrID . '/send';
        $sendUrl .= '?chatfuel_token=' . $botToken;
        $sendUrl .= '&chatfuel_block_name=' . urlencode($goToBlock);
        echo $sendUrl;

        $options = array(
            'http' => array(
                'method'  => 'POST',
                'header'  => 'Content-Type: application/json' . "\r\n" . 'Accept: application/json' . "\r\n",
                'content' => json_encode($params),
            ),
        );

        if (!empty($msgrID) && !empty($goToBlock)) {
            $context = stream_context_create($options);
            $result  = @file_get_contents($sendUrl, false, $context);
        }
        print_r($result);

    }
    public function getRequest($key = '', $fallback = '')
    {
        global $_request;
        if (!empty($key)) {
            if (!empty($_request[$key])) {
                return $_request[$key];
            } else {
                return $fallback;
            }
        }
        return '';
    }
}
