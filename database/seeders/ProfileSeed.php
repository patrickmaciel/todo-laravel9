<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'name' => 'Administrator', 'created_at' => now()],
            ['id' => 2, 'name' => 'User', 'created_at' => now()],
        ];

        Profile::whereNotNull('id')->delete();

        foreach ($data as $item) {
            Profile::create($item);
        }
    }
}
