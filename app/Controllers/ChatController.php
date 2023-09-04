<?php

namespace App\Controllers;

use App\Models\ChatModel;
use CodeIgniter\Controller;

class ChatController extends Controller
{
    public function index()
    {
        return view('chat_view');
    }

    public function processChat()
    {
        $message = $this->request->getPost('message');

        // Lakukan pemrosesan pesan chat di sini sesuai kebutuhan Anda

        // Simpan pesan chat ke database
        $chatModel = new ChatModel();
        $chatId = $chatModel->saveChat(1, $message); // Contoh: 1 adalah ID pengguna (user_id)

        // Kirim tanggapan ke pengguna atau lakukan logika lainnya sesuai kebutuhan

        return redirect()->to('/chat'); // Redirect kembali ke halaman chat
    }
}
