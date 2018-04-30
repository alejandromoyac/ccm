<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chatbot
{
    public $d = array('messages' => array());
    public function __construct()
    {

    }

    public function sendText($messages)
    {
        $data = array(
            'messages' => array(
            ),
        );
        if (is_array($messages)) {
            foreach ($messages as $row) {
                $data['messages'][] = array('text' => $row);
            }
        } else {
            $data['messages'][] = array('text' => $messages);
        }
        // return $data;
        echo json_encode($data, JSON_UNESCAPED_SLASHES);
    }

    public function sendImage($url_arr)
    {

        $data = array('messages' => array());
        foreach ($url_arr as $row) {
            $data['messages'][] = array('attachment' => array('type' => 'image', 'payload' => array('url' => $row)));
        }

        echo json_encode($data, JSON_UNESCAPED_SLASHES);
    }

    public function sendVideo($url_arr)
    {

        $data = array('messages' => array());
        foreach ($url_arr as $row) {
            $data['messages'][] = array('text' => $row['text']);
            $data['messages'][] = array('attachment' => array('type' => 'video', 'payload' => array('url' => $row['url'])));
        }

        echo json_encode($data, JSON_UNESCAPED_SLASHES);
    }

    public function sendAudio($url_arr)
    {

        $data = array('messages' => array());
        foreach ($url_arr as $row) {
            $data['messages'][] = array('text' => $row['text']);
            $data['messages'][] = array('attachment' => array('type' => 'audio', 'payload' => array('url' => $row['url'])));
        }
        echo json_encode($data, JSON_UNESCAPED_SLASHES);
    }

    public function sendFile($url_arr)
    {
        $data = array('messages' => array());
        foreach ($url_arr as $row) {
            $data['messages'][] = array('text' => $row['text']);
            $data['messages'][] = array('attachment' => array('type' => 'file', 'payload' => array('url' => $row['url'])));
        }
        echo json_encode($data, JSON_UNESCAPED_SLASHES);
    }

    public function sendGallery($gal)
    {
        // $gal = array(
        //        array(
        //            "title"     => "gal 1",
        //            "image_url" => "",
        //            "subtitle"  => "subtitle 1",
        //            "buttons"   => array(
        //                array(
        //                    "type"  => "web_url",
        //                    "url"   => "https://google.com",
        //                    "title" => "google",
        //                ),
        //                array(
        //                    "type"  => "web_url",
        //                    "url"   => "https://facebook.com",
        //                    "title" => "facebook",
        //                ),
        //                array(
        //                    "type"  => "web_url",
        //                    "url"   => "https://youtube.com",
        //                    "title" => "youtube",
        //                ),
        //            )),
        //        array(
        //            "title"     => "gal 2",
        //            "image_url" => "",
        //            "subtitle"  => "subtitle 2",
        //            "buttons"   => array(
        //                array(
        //                    "type"  => "web_url",
        //                    "url"   => "https://google.com",
        //                    "title" => "google",
        //                ),
        //                array(
        //                    "type"  => "web_url",
        //                    "url"   => "https://facebook.com",
        //                    "title" => "facebook",
        //                ),
        //            )),
        //    );

        $data = array("messages" => array(array("attachment" => array("type" => "template", "payload" => array("template_type" => "generic", "elements" => $gal)))));
        echo json_encode($data, JSON_UNESCAPED_SLASHES);
    }
    // sendText         x
    // sendImage        x
    // sendVideo        x
    // sendAudio        x
    // sendFile         x
    // sendTextCard
    // sendGallery      x
    // sendAttachment   x
}
