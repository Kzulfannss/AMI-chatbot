<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use App\ThirdParty\chatbot\chatbot\Chatbot;
use App\ThirdParty\chatbot\chatbot\Config;
// require_once APPPATH . "ThirdParty/chatbot/chatbot/Config.php";
// require_once APPPATH . "ThirdParty/chatbot/chatbot/Database/Connection.php";

class TestController extends BaseController
{

    public function index()
    {
        $request = \Config\Services::request();
        $message = $request->getVar('userInput');
        
        $config = new Config();
        define("LOG", $config->log);
        $userId = isset($_REQUEST['userId']) ? $_REQUEST['userId'] : $_SERVER['REMOTE_ADDR'];
        $chatbot = new Chatbot($config, $userId);
        //
        $userInput = $message;
        $chatbotReply = $chatbot->talk($userInput);
        //
        $data = $chatbot->getData();

        $arr = [
            'status' => 'success',
            'type' => 'talk',
            'message' => trim(preg_replace("/\s+/", " ", $chatbotReply)),
            'data' => $data
        ];

        return $this->response->setStatusCode(200)->setJSON($arr);
    }

    public function view(){
        return view('chat');
    }
}
