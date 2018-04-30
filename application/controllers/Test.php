<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
{
    public function text()
    {
        // $data = array("hola :D", "k ase?", ":D !!!!!");
        $data = array("Ups, no he entendido a que te refieres.");
        $this->chatbot->sendText($data);
    }

    public function image()
    {
        $url = 'https://api.tenor.com/v1/random?q=samurai%20champloo&key=6MV5N9DZLXW4&limit=1';
        $ch  = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $gif = curl_exec($ch);
        $gif = json_decode($gif);
        $gif = $gif->results[0]->media[0]->tinygif->url;
        curl_close($ch);

        $data = array('https://d1u5p3l4wpay3k.cloudfront.net/dota2_gamepedia/f/f7/Enigma_icon.png?version=b6fa5ae7c9ce6ed6c122690d9c251b49', 'https://d1u5p3l4wpay3k.cloudfront.net/dota2_gamepedia/0/03/Main_Page_icon_Mechanics.png?version=1a7eb5346ac0548da12b90206163c913', 'https://i.giphy.com/media/BlVnrxJgTGsUw/200w.gif', $gif);
        $this->chatbot->sendImage($data);
    }

    public function video()
    {
        $data   = array();
        $url1   = array('text' => 'Video desde DropBox', 'url' => 'https://dl.dropbox.com/s/1dic1uopaw575bv/Markem-Imaje%209450.mp4?dl=0');
        $url2   = array('text' => 'Video desde GoogleDrive', 'url' => 'https://drive.google.com/uc?export=view&id=0B94fi1kj_VhRdi1KcEh3bU5Fa3M');
        $url3   = array('text' => '', 'url' => 'https://drive.google.com/uc?export=view&id=0B94fi1kj_VhRdi1KcEh3bU5Fa3M');
        $data[] = $url1;
        $data[] = $url2;
        $data[] = $url3;
        $this->chatbot->sendVideo($data);
    }
    public function audio()
    {
        $data   = array();
        $url    = array('text' => 'Audio desde Dropbox', 'url' => 'https://dl.dropbox.com/s/82vyqk0rdvurv4t/nujabes.m4a?dl=0');
        $data[] = $url;
        $this->chatbot->sendAudio($data);
    }

    public function file()
    {
        $data   = array();
        $url    = array('text' => 'Archivo desde DropBox', 'url' => 'https://dl.dropbox.com/s/0p6w1nopd0j9zp9/419701.pdf?dl=0');
        $data[] = $url;
        $this->chatbot->sendFile($data);
    }

    public function gallery()
    {
        $gal = array(
            array(
                "title"     => "gal 1",
                "image_url" => "",
                "subtitle"  => "subtitle 1",
                "buttons"   => array(
                    array(
                        "type"  => "web_url",
                        "url"   => "https://google.com",
                        "title" => "google",
                    ),
                    array(
                        "type"  => "web_url",
                        "url"   => "https://facebook.com",
                        "title" => "facebook",
                    ),
                    array(
                        "type"  => "web_url",
                        "url"   => "https://youtube.com",
                        "title" => "youtube",
                    ),
                )),
            array(
                "title"     => "gal 2",
                "image_url" => "https://pre00.deviantart.net/0306/th/pre/i/2017/227/3/1/logo_murloc_nightcrawler__slark_dota_2_by_ritchyzz-dbb2pzx.png",
                "subtitle"  => "subtitle 2",
                "buttons"   => array(
                    array(
                        "type"  => "web_url",
                        "url"   => "https://google.com",
                        "title" => "google",
                    ),
                    array(
                        "type"  => "web_url",
                        "url"   => "https://facebook.com",
                        "title" => "facebook",
                    ),
                )),
        );
        $this->chatbot->sendGallery($gal);
        // $data = array("messages" => array(array("attachment" => array("type" => "template", "payload" => array("template_type" => "generic", "elements" => $gal)))));
        // echo json_encode($data, JSON_UNESCAPED_SLASHES);
    }

    public function gallery2()
    {
        echo '{
  "messages": [
    {
      "attachment": {
        "type": "template",
        "payload": {
          "template_type": "list",
          "top_element_style": "compact",
          "elements": [
            {
              "title": "Classic White T-Shirt",
              "image_url": "https://d1u5p3l4wpay3k.cloudfront.net/dota2_gamepedia/0/03/Main_Page_icon_Mechanics.png?version=1a7eb5346ac0548da12b90206163c913",
              "subtitle": "Soft white cotton t-shirt is back in style",
              "buttons": [
                {
                  "type": "web_url",
                  "url": "https://petersapparel.parseapp.com/buy_item?item_id=101",
                  "title": "Buy Item"
                }
              ]
            },
            {
              "title": "Classic White T-Shirt",
              "image_url": "https://d1u5p3l4wpay3k.cloudfront.net/dota2_gamepedia/0/03/Main_Page_icon_Mechanics.png?version=1a7eb5346ac0548da12b90206163c913",
              "subtitle": "Soft white cotton t-shirt is back in style",
              "buttons": [
                {
                  "type": "web_url",
                  "url": "https://petersapparel.parseapp.com/buy_item?item_id=101",
                  "title": "Buy Item"
                }
              ]
            },
            {
              "title": "Classic White T-Shirt",
              "image_url": "https://d1u5p3l4wpay3k.cloudfront.net/dota2_gamepedia/0/03/Main_Page_icon_Mechanics.png?version=1a7eb5346ac0548da12b90206163c913",
              "subtitle": "Soft white cotton t-shirt is back in style",
              "buttons": [
                {
                  "type": "web_url",
                  "url": "https://petersapparel.parseapp.com/buy_item?item_id=101",
                  "title": "Buy Item"
                }
              ]
            },
            {
              "title": "Classic Grey T-Shirt",
              "image_url": "https://d1u5p3l4wpay3k.cloudfront.net/dota2_gamepedia/0/03/Main_Page_icon_Mechanics.png?version=1a7eb5346ac0548da12b90206163c913",
              "subtitle": "Soft gray cotton t-shirt is back in style",
              "buttons": [
                {
                  "type": "web_url",
                  "url": "https://petersapparel.parseapp.com/buy_item?item_id=100",
                  "title": "Buy Item"
                }
              ]
            }
          ]
        }
      }
    }
  ]
}';
    }

    public function share()
    {
        echo '{
  "messages":[
    {
      "attachment":{
        "type":"template",
        "payload":{
          "template_type":"generic",
          "elements":[
            {
              "title":"Classic White T-Shirt",
              "image_url":"http://petersapparel.parseapp.com/img/item100-thumb.png",
              "subtitle":"Soft white cotton t-shirt is back in style",
              "buttons":[
                {
                  "type":"phone_number",
                  "phone_number":"+79268881413",
                  "title":"Call"
                },
                {
                  "type":"element_share"
                }
              ]
            }
          ]
        }
      }
    }
  ]
}';
    }

    public function call()
    {
        echo '{
  "messages":[
    {
      "attachment":{
        "type":"template",
        "payload":{
          "template_type":"generic",
          "elements":[
            {
              "title":"Classic White T-Shirt",
              "image_url":"http://petersapparel.parseapp.com/img/item100-thumb.png",
              "subtitle":"Soft white cotton t-shirt is back in style",
              "buttons":[
                {
                  "type":"phone_number",
                  "phone_number":"+79268881413",
                  "title":"Call"
                },
                {
                  "type":"element_share"
                }
              ]
            }
          ]
        }
      }
    }
  ]
}';
    }
    public function combine()
    {
        $this->video();
        $this->audio();
        $this->file();
        $this->send();
    }
    public function codeigniter()
    {
        $data   = array();
        $url    = array('text' => "", 'url' => 'https://dl.dropbox.com/s/t4attrf5xy9pv6b/parrot.zip?dl=0');
        $data[] = $url;
        $this->chatbot->sendFile($data);
    }

    public function webview()
    {
        $data = '{
  "messages": [
    {
      "attachment": {
        "type": "template",
        "payload": {
          "template_type": "generic",
          "elements": [
            {
              "title": "This is a Gallery Headline",
              "subtitle": "And this is a subtitle!",
              "image_url": "https://via.placeholder.com/1200x628",
              "buttons": [
                {
                  "type": "web_url",
                  "url": "https://braintrustinteractive.com",
                  "title": "Click to Launch!",
                  "messenger_extensions": true,
                  "webview_height_ratio": "tall"
                }
              ]
            }
          ]
        }
      }
    }
  ]
}';
        echo $data;
    }
    public function wvtest()
    {
        $this->load->view('webview');
    }
    public function tutorial()
    {
        $data   = array();
        $url    = array('text' => 'Tutorial Toñales :V ', 'url' => 'https://dl.dropbox.com/s/0prwvdihp5lfkuf/tutorial.zip?dl=0');
        $data[] = $url;
        $this->chatbot->sendFile($data);
    }

    public function littlemore()
    {
        echo '{"messages":[{"attachment":{"type":"template","payload":{"template_type":"generic","image_aspect_ratio":"square","elements":[{"title":"Hello : 123213","subtitle":"Choose your preferences","buttons":[{"type":"web_url","url":"https://discreet-attic.glitch.me/show-webview","title":"Webview (compact)","messenger_extensions":true,"webview_height_ratio":"compact"},{"type":"web_url","url":"https://discreet-attic.glitch.me/show-webview","title":"Webview (tall)","messenger_extensions":true,"webview_height_ratio":"tall"},{"type":"web_url","url":"https://discreet-attic.glitch.me/show-webview","title":"Webview (full)","messenger_extensions":true,"webview_height_ratio":"full"}]}]}}}]}';
    }

}
