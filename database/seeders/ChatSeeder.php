<?php

namespace Database\Seeders;

use App\Models\Chat;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chat = new Chat();
        $insertForm = [];
        for ($i = 1; $i <= 10; $i++) {
            $insertForm[] = [
                'user_id' => '1',
                'content' => 'sample' . (string)$i,
                'public' => 1,
            ];
        }
        foreach ($insertForm as $data) {
            $chat->create($data);
        }
    }
}
