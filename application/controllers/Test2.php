<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Test2 extends CI_Controller
{
    public function bunch2()
    {
        //text
        $this->cfuel->addText("Alo alo?");
        $this->cfuel->addText("Estoy agregando nuevas lineas! :D");
        //file
        $this->cfuel->addFile("https://chatfuel.com/PrivacyPolicy.pdf");
        //audio
        $this->cfuel->addAudio("https://dl.dropbox.com/s/82vyqk0rdvurv4t/nujabes.m4a?dl=0");
        //video
        $this->cfuel->addVideo("https://drive.google.com/uc?export=view&id=0B94fi1kj_VhRdi1KcEh3bU5Fa3M");
        //card
        $data = array(
            "title"   => "Titulo",
            "buttons" => array(
                array("type" => "show_block", "block_name" => "Welcome message", "title" => "Sub 1 (block redir->)"),
                array("type" => "web_url", "url" => "https://www.facebook.com", "title" => "Sub 2 (url facebook)"),
                array("type" => "web_url", "url" => "https://www.google.com", "title" => "Sub 3 (url google)"),
            ),
        );
        $this->cfuel->addCard($data);

        $this->cfuel->send();
    }
    public function libcard()
    {
        $data = array(
            "title"   => "Titulo",
            "buttons" => array(
                array("type" => "show_block", "block_name" => "Welcome message", "title" => "Sub 1 (block redir->)"),
                array("type" => "web_url", "url" => "https://www.facebook.com", "title" => "Sub 2 (url facebook)"),
                array("type" => "web_url", "url" => "https://www.google.com", "title" => "Sub 3 (url google)"),
            ),
        );
        $this->cfuel->addCard($data);
        $this->cfuel->send();
    }

    public function postback()
    {
        echo '
      {
        "set_attributes":
        {
          "another_onex": "bright <3 x2!!!"
        },
  "messages": [
    {
      "attachment": {
        "payload":{
          "template_type": "button",
          "text": "test JSON with postback",
          "buttons": [
            {
              "url": "https://cfchatbot.000webhostapp.com/parrot/test2/posted",
              "type":"json_plugin_url",
              "title":"go"
            }
          ]
        },
        "type": "template"
      }
    }
  ]
}
      ';
    }
    public function pbck()
    {
        echo '{"messages":[{"text":"testSimpleJson success"}]}';
    }

    public function posted()
    {
        $text = "";
        foreach ($this->input->post() as $key => $value) {
            $text .= "Key: $key; Value: $value\n";
        }
        // $this->cfuel->addText(json_encode($this->input->post()));
        // $this->cfuel->addText(serialize($this->input->post()));
        $this->cfuel->addText($text);
        // foreach ($this->input->post() as $row) {
        //     $this->cfuel->addText($row);
        // }
        $this->cfuel->send();
    }
    public function search()
    {
        $query = urlencode($this->input->get('meme_query'));
        $url   = "http://version1.api.memegenerator.net/Generators_Search?q=" . $query . "&pageIndex=0&pageSize=10&apiKey=957ea9e1-0254-4c58-8d9a-608f2fc8073d";
        $data  = file_get_contents($url); // put the contents of the file into a variable
        $data  = array(json_decode($data));
        $data  = json_decode(json_encode($data), true);
        $data  = $data[0]["result"];

        $messages = array("messages" => array(array("attachment" => array("type" => "template", "payload" => array("template_type" => "generic", "elements" => array())))));

        for ($i = 0; $i < count($data); $i++) {
            $card = array(
                "title"     => $data[$i]["displayName"],
                "image_url" => $data[$i]["imageUrl"],
                "subtitle"  => "",
                "buttons"   => array(
                    array(
                        "set_attributes" => array(
                            "meme_id"   => $data[$i]["imageID"],
                            "meme_name" => $data[$i]["displayName"],
                        ),
                        "type"           => "show_block",
                        "block_name"     => "Make meme",
                        "title"          => "Use this one 👌🏼 !!!",
                    )));

            $messages["messages"]["0"]["attachment"]["payload"]["elements"][] = $card;

        }

        echo json_encode($messages);

    }
    public function car()
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
                "image_url" => "",
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

        $data = array("messages" => array(array("attachment" => array("type" => "template", "payload" => array("template_type" => "generic", "elements" => $gal)))));
        echo json_encode($data, JSON_UNESCAPED_SLASHES);
        // echo "<pre>";
        // print_r($data);
    }

    public function make_meme()
    {
        $top     = urlencode($this->input->post('top_text'));
        $bot     = urlencode($this->input->post('bot_text'));
        $meme_id = urlencode($this->input->post('meme_id'));
        if ($top == "Skip" && $bot == "Skip") {
            $this->cfuel->addText('Ermahgerd 😱!!! no text??? try again 😉!!! ');
            $this->cfuel->redirect(array("Search"));

        } else {
            if ($top == "Skip") {
                $top = "";
            }
            if ($bot == "Skip") {
                $bot = "";
            }
            $url = "http://version1.api.memegenerator.net//Instance_Create?languageCode=en&generatorID=3&imageID=" . $meme_id . "&text0=" . $top . "&text1=" . $bot . "&apiKey=957ea9e1-0254-4c58-8d9a-608f2fc8073d";
            // $url  = "http://version1.api.memegenerator.net//Instance_Create?languageCode=en&generatorID=3&imageID=5715741&text0=XXX&text1=YYY&apiKey=957ea9e1-0254-4c58-8d9a-608f2fc8073d";
            $data = file_get_contents($url);
            $data = array(json_decode($data));
            $data = json_decode(json_encode($data), true);
            $this->cfuel->addText("Creating your meme...");
            $this->cfuel->addText("Done! :D");
            $instance = $data[0]['result']['instanceImageUrl'];
            $this->cfuel->addImage($instance);
            // $this->cfuel->addText("Wanna play around a little more 😍?");
            // $this->cfuel->redirect(array("Search"));
            $qr = array(
                array(
                    "title" => "Yes please 🙏🏼!", "block_names" => array("Search")),
                array(
                    "title" => "Nope 💔", "block_names" => array("Bye"),
                ),
            );
            $this->cfuel->addQuickReply($qr);
        }
        $this->cfuel->send();
    }
    public function test_redir()
    {
        echo '
        {
 "messages": [
   {"text": "Welcome to our store!"},
   {"text": "How can I help you?"}
 ],

  "redirect_to_blocks": ["Search"]



}
        ';
    }
    public function image()
    {
        $this->cfuel->addText("Creating your meme...");
        $this->cfuel->addText("Done! :D");
        $this->cfuel->addImage("https://memegenerator.net/img/instances/400x/81451805/xxx-yyy.jpg");
        $this->cfuel->send();
    }

    public function sms()
    {

// Get the PHP helper library from twilio.com/docs/php/install
        require_once '/path/to/vendor/autoload.php'; // Loads the library

        use Twilio\Rest\Client;

        $account_sid = 'AC4ddb34f50fdca1d740d28b1a5d77dee0';
        $auth_token  = '9c9ab3a3005fd7641683265b682bde80';
        $client      = new Client($account_sid, $auth_token);

        $messages = $client->accounts("AC4ddb34f50fdca1d740d28b1a5d77dee0")
            ->messages->create("+59165343087", array(
                'From' => "+17378885804",
                'Body' => "Hey there alex ;)",
            ));
    }

}
