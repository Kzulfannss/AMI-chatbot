<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatModel extends Model
{
    protected $table = 'chats';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'message', 'created_at', 'updated_at'];

    public function saveChat($userId, $message)
    {
        $data = [
            'user_id' => $userId,
            'message' => $message,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->insert($data);
        return $this->insertID();
    }
}
