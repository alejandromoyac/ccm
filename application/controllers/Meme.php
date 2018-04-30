<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Meme extends CI_Controller
{

    public function search_instance()
    {
        $query = urlencode($this->input->get('meme_query'));
        // $url   = "http://version1.api.memegenerator.net/Instances_Select_ByPopular?languagecode=en&pageIndex=0&urlName=" . $query . "&days=&apiKey=957ea9e1-0254-4c58-8d9a-608f2fc8073d";
        $url      = "http://version1.api.memegenerator.net/Generators_Search?q=" . $query . "&pageIndex=0&pageSize=10&apiKey=957ea9e1-0254-4c58-8d9a-608f2fc8073d";
        $data     = file_get_contents($url);
        $data     = array(json_decode($data));
        $data     = json_decode(json_encode($data), true);
        $data     = $data[0]["result"];
        $messages = array("messages" => array(array("attachment" => array("type" => "template", "payload" => array("template_type" => "generic", "elements" => array())))));

        for ($i = 0; $i < count($data); $i++) {
            $card = array(
                "title"     => $data[$i]["displayName"],
                "image_url" => $data[$i]["imageUrl"],
                "subtitle"  => "",
                "buttons"   => array(
                    array(
                        "set_attributes" => array(
                            "meme_id"       => $data[$i]["imageID"],
                            "meme_name"     => $data[$i]["displayName"],
                            "meme_url_name" => $data[$i]["urlName"],
                        ),
                        "type"           => "show_block",
                        "block_name"     => "Fetch instances",
                        "title"          => "✅ Use " . $data[$i]["displayName"],
                    )));

            $messages["messages"]["0"]["attachment"]["payload"]["elements"][] = $card;

        }
        echo json_encode($messages);
        // print_r($data[rand(0, sizeof($data) - 1)]);
    }
    public function fetchInstances()
    {
        $query = urlencode($this->input->get('meme_url_name'));
        $url   = "http://version1.api.memegenerator.net/Instances_Select_ByPopular?languagecode=en&pageIndex=0&pageSize=25&urlName=" . $query . "&days=&apiKey=957ea9e1-0254-4c58-8d9a-608f2fc8073d";
        // $url   = "http://version1.api.memegenerator.net/Generators_Search?q=" . $query . "&pageIndex=0&pageSize=10&apiKey=957ea9e1-0254-4c58-8d9a-608f2fc8073d";
        $data = file_get_contents($url);
        $data = array(json_decode($data));
        $data = json_decode(json_encode($data), true);
        $data = $data[0]["result"];
        $this->cfuel->addImage($data[rand(0, sizeof($data) - 1)]['instanceImageUrl']);
        $qr = array(
            array(
                "title" => "Yes please 😂!", "block_names" => array("Main menu")),
            array(
                "title" => "Nope 💔", "block_names" => array("Bye"),
            ),
        );
        $this->cfuel->addText("Hope you liked that one 😁");
        $qr = array("text" => "Wanna play around a little more 😎?", "quick_replies" => $qr);

        $this->cfuel->addQuickReply($qr);
        $this->cfuel->send();
    }

    public function search()
    {
        $query = urlencode($this->input->get('meme_query'));
        $url   = "http://version1.api.memegenerator.net/Generators_Search?q=" . $query . "&pageIndex=0&pageSize=10&apiKey=957ea9e1-0254-4c58-8d9a-608f2fc8073d";
        $data  = file_get_contents($url);
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
                        "title"          => "✅ Use " . $data[$i]["displayName"],
                    )));

            $messages["messages"]["0"]["attachment"]["payload"]["elements"][] = $card;

        }

        echo json_encode($messages);
    }
    public function make_meme()
    {
        $top     = urlencode($this->input->post('top_text'));
        $bot     = urlencode($this->input->post('bot_text'));
        $meme_id = urlencode($this->input->post('meme_id'));
        if ($top == "Skip" && $bot == "Skip") {
            $this->cfuel->addText('Ermahgerd 😱!!! no text???');
            $errors = array(
                "https://dl.dropbox.com/s/nyftyvkkyktcnv0/0.gif",
                "https://dl.dropbox.com/s/yawe4rt5euocuku/1.gif",
                "https://dl.dropbox.com/s/7lgno02ukyqwq92/2.gif",
                "https://dl.dropbox.com/s/d7hvpqgw48ko5lp/3.gif",
                "https://dl.dropbox.com/s/yawe4rt5euocuku/1.gif",
            );
            $gif = $errors[rand(0, 4)];
            $this->cfuel->addImage($gif);
            $this->cfuel->addText("Try again! :D");
            $this->cfuel->redirect(array("Make meme"));

        } else {
            if ($top == "Skip") {
                $top = "";
            }
            if ($bot == "Skip") {
                $bot = "";
            }
            $url  = "http://version1.api.memegenerator.net//Instance_Create?languageCode=en&generatorID=3&imageID=" . $meme_id . "&text0=" . $top . "&text1=" . $bot . "&apiKey=957ea9e1-0254-4c58-8d9a-608f2fc8073d";
            $data = file_get_contents($url);
            $data = array(json_decode($data));
            $data = json_decode(json_encode($data), true);
            // $this->cfuel->addText("Creating your meme...");
            $this->cfuel->addText("Done! :D");
            $instance = $data[0]['result']['instanceImageUrl'];
            $this->cfuel->addImage($instance);
            // $this->cfuel->redirect(array("Search"));

            $qr = array(
                array(
                    "title" => "Yes please 😂!", "block_names" => array("Main menu")),
                array(
                    "title" => "Nope 💔", "block_names" => array("Bye"),
                ),
            );
            $qr = array("text" => "Wanna play around a little more 😍?", "quick_replies" => $qr);

            $this->cfuel->addQuickReply($qr);
        }
        $this->cfuel->send();
    }
    public function trending()
    {
        $url  = "http://version1.api.memegenerator.net/Generators_Select_ByTrending?pageIndex=0&pageSize=12&apiKey=957ea9e1-0254-4c58-8d9a-608f2fc8073d";
        $data = file_get_contents($url);
        $data = array(json_decode($data));
        $data = json_decode(json_encode($data), true);
        $data = $data[0]["result"];

        $messages = array("messages" => array(array("attachment" => array("type" => "template", "payload" => array("template_type" => "generic", "elements" => array())))));

        for ($i = 0; $i < 10; $i++) {
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
                        "title"          => "✅ Use " . $data[$i]["displayName"],
                    )));

            $messages["messages"]["0"]["attachment"]["payload"]["elements"][] = $card;

        }

        echo json_encode($messages);
    }
    public function make_custom()
    {
        $data = $this->input->get('custom_pic');

        // if (!is_array(getimagesize($data))) {
        // if (!filter_var($data, FILTER_VALIDATE_URL)) {
        if (!strpos($data, "fbcdn.net")) {
            // $this->cfuel->addText($data);
            $this->cfuel->addText("I was expecting a picture 💔😢");
            $this->cfuel->addText("No worries, try again! :D");
            $this->cfuel->redirect(array("Load custom"));
        } else {
            $now      = new DateTime();
            $datetime = $now->format('Y.m.d-H.i.s');
            $user     = $this->input->get('first_name') . "-" . $this->input->get('last_name') . "-" . $this->input->get('messenger_user_id') . "-" . $datetime;

            $picFilename = "assets/custom_memes/" . $user . '.jpg';

//Get the file
            $content = file_get_contents($data);
            $fp      = fopen($picFilename, "w");
            fwrite($fp, $content);
            fclose($fp);
            $server_name = "http://moyo.dev.soy/memegenerator/assets/custom_memes/";
            $saved_pic   = $server_name . $user;
            $this->cfuel->set_attributes("saved_pic", $saved_pic);
            $this->cfuel->redirect(array("Edit custom"));
        }
        $this->cfuel->send();
    }
    public function edit_custom()
    {
        $top     = ($this->input->post('top_text'));
        $bot     = ($this->input->post('bot_text'));
        $removed = array("/", "\\");
        $top     = str_replace($removed, "~s", $top);
        $bot     = str_replace($removed, "~s", $bot);
        $top     = str_replace("?", "~q", $top);
        $bot     = str_replace("?", "~q", $bot);
        $top     = str_replace("+", " ", $top);
        $bot     = str_replace("+", " ", $bot);

        $saved_pic = urlencode($this->input->post('saved_pic'));

        if ($top == "Skip" && $bot == "Skip") {
            $this->cfuel->addText('Ermahgerd 😱!!! no text???');
            $errors = array(
                "https://dl.dropbox.com/s/nyftyvkkyktcnv0/0.gif",
                "https://dl.dropbox.com/s/yawe4rt5euocuku/1.gif",
                "https://dl.dropbox.com/s/7lgno02ukyqwq92/2.gif",
                "https://dl.dropbox.com/s/d7hvpqgw48ko5lp/3.gif",
                "https://dl.dropbox.com/s/0azy17tquc9ts7f/4.gif",
            );
            $gif = $errors[rand(0, 4)];
            $this->cfuel->addImage($gif);
            $this->cfuel->addText("Try again! :D");
            $this->cfuel->redirect(array("Edit custom"));
        } else {

            if ($top == "Skip") {
                $top = " ";
            }
            if ($bot == "Skip") {
                $bot = " ";
            }

            $url = "https://memegen.link/custom/" . $top . "/" . $bot . ".jpg?alt=" . $saved_pic . "&watermark=none";
            $this->cfuel->addImage($url);
            $qr = array(
                array(
                    "title" => "Yes please 😂!", "block_names" => array("Main menu")),
                array(
                    "title" => "Nope 💔", "block_names" => array("Bye"),
                ),
            );
            $this->cfuel->addText("Nice one 😂!");
            $qr = array("text" => "Wanna play around a little more 😎?", "quick_replies" => $qr);

            $this->cfuel->addQuickReply($qr);

        }
        $this->cfuel->send();

    }
    public function write()
    {
        $file = fopen("assets/custom_memes/test.txt", "w");
        echo fwrite($file, "Hello World. Testing!");
        fclose($file);

    }
    public function try_stuff()
    {
        $this->cfuel->addText("ehmargerd!!! :V");
        $this->cfuel->set_attributes("aux_val", "crap baskets");
        $this->cfuel->redirect(array("Welcome message"));
        $this->cfuel->send();
    }
    public function pr()
    {
        $this->cfuel->addText("Sorry, I missed that");
        $this->cfuel->addText("Maybe you should go back to the main menu :)");
        $this->cfuel->redirect(array("Main menu"));
        $this->cfuel->send();
    }
    public function emoji()
    {
        $db_str = "Show me some <3 right now. It is raining today [umbr], that gives me peace [peace].";
        echo $db_str;
        echo "<hr />";
        $chars   = array("<3", "[peace]", "[umbr]");
        $icons   = array("&#10084;", "&#9774;", "&#9730;");
        $new_str = str_replace($chars, $icons, $db_str);
        echo $new_str;
    }

}
