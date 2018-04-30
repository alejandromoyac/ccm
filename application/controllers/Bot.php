<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Bot extends CI_Controller
{

    public function index()
    {

        $this->load->view('welcome_message');

    }

    public function bot_response()
    {

        include_once APPPATH . 'vendor/autoload.php';

        $bot = new \juno_okyo\Chatfuel();

        if (isset($_POST['msg']) && !empty($_POST['msg'])) {

            $bot->sendText("Bot sayxs: " . $_POST['msg']);

        }
    }

    public function posted_stuff()
    {
        echo "<pre>";
        print_r($this->input->post());
        echo "</pre>";
    }

    public function demo()
    {
        include_once APPPATH . 'vendor/autoload.php';
        $bot = new \juno_okyo\Chatfuel();
        $bot->createQuickReply('DEMO FUNCTIONS:', array(
            $bot->createQuickReplyButton('texto', ['text']),
            $bot->createQuickReplyButton('imagen', ['image']),
            $bot->createQuickReplyButton('video', ['video']),
            $bot->createQuickReplyButton('audio', ['audio']),
            $bot->createQuickReplyButton('text card', ['multiple']),
            $bot->createQuickReplyButton('multiple', ['multiple']),
            $bot->createQuickReplyButton('galeria', ['multiple']),

        ));

    }

    public function multiple()
    {
        include_once APPPATH . 'vendor/autoload.php';
        $bot = new \juno_okyo\Chatfuel();
        $bot->sendTextCard('Ola k ase', array(
            $bot->createButtonToURL('Google', 'http://www.google.com'),
            $bot->createButtonToURL('Publiaciertos', 'http://publiaciertos.net'),
            $bot->createButtonToURL('Whatsapp', 'https://api.whatsapp.com/send?l=es&phone=59165343087&text=Ola%20k%20ase,%20mensajea%20desde%20web%20o%20k%20ase?'),
            // $bot->createShareButton(),
        ));
    }

    public function text()
    {
        include_once APPPATH . 'vendor/autoload.php';
        $bot = new \juno_okyo\Chatfuel();
        $bot->sendText([
            'Linea 1',
            'Linea 2',
            'Linea 3 :v',
        ]);
    }

    public function image()
    {
        include_once APPPATH . 'vendor/autoload.php';
        $bot = new \juno_okyo\Chatfuel();
        $bot->sendImage('http://publiaciertos.net/images/PubliAciertos_w200.png');
    }

    public function video()
    {
        include_once APPPATH . 'vendor/autoload.php';
        $bot = new \juno_okyo\Chatfuel();
        $bot->sendText('Video desde dropbox:');
        $bot->sendVideo('https://dl.dropbox.com/s/1dic1uopaw575bv/Markem-Imaje%209450.mp4?dl=0');
        $bot->sendText('Video desde Google Drive:');
        $bot->sendVideo('https://drive.google.com/uc?export=view&id=0B94fi1kj_VhRdi1KcEh3bU5Fa3M');
    }

    public function audio()
    {
        include_once APPPATH . 'vendor/autoload.php';
        $bot = new \juno_okyo\Chatfuel();
        $bot->sendText('Audio desde dropbox:');
        $bot->sendAudio('https://dl.dropbox.com/s/82vyqk0rdvurv4t/nujabes.m4a?dl=0');
    }

    public function textCard()
    {
        include_once APPPATH . 'vendor/autoload.php';
        $bot = new \juno_okyo\Chatfuel();
    }

    public function gallery()
    {
        include_once APPPATH . 'vendor/autoload.php';
        $bot = new \juno_okyo\Chatfuel();
    }

    public function attachment()
    {
        include_once APPPATH . 'vendor/autoload.php';
        $bot = new \juno_okyo\Chatfuel();
    }

    public function manual_text()
    {
        $data = array(
            'messages' => array(
                array('text' => 'oli'),
                array('text' => 'k ase?'),
                array('text' => 'message: ' . $this->input->post('msg')),
                array('text' => 'other data: ' . $this->input->post('first_name') . ' / ' . $this->input->post('last_name')),
            ),
        );
        echo json_encode($data);
    }

    public function hopeful()
    {
        $data = array('ola', 'k', 'ase'); //array de strings
        // $data = "hi! :D"; //string simple
        $this->chatbot->sendPlain($data);
    }

    public function webview()
    {
        $this->load->view('web_view');
    }
}

// sendText
// sendImage
// sendVideo
// sendAudio
// sendTextCard
// sendGallery
// sendAttachment
// enviar link a whatsapp con msj predeterminado :D
// =================
// createElement
// createButtonToBlock
// createButtonToURL
// createPostBackButton
// createCallButton
// createShareButton
// createQuickReply
// createQuickReplyButton
// isUrl (filtro)
