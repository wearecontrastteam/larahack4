<?php

use App\GameStatus;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $gameStatuses = [
            ['id' => 1, 'status' => 'Creating', 'description' => 'Game is being created'],
            ['id' => 2, 'status' => 'Matching', 'description' => 'Awaiting Opponent'],
            ['id' => 3, 'status' => 'In Progress', 'description' => 'Game is being played'],
            ['id' => 4, 'status' => 'Finished', 'description' => 'Game Finished'],
            ['id' => 5, 'status' => 'Error', 'description' => 'Oh dear, there was an error'],
        ];

        foreach($gameStatuses as $status){
            GameStatus::updateOrCreate(
                ['id' => $status['id']],
                ['status' => $status['status'], 'description' => $status['description']]
            );
        }


        if(User::count() == 0) {
            User::updateOrCreate([
                'name' => 'Mike',
                'email' => 'mike@wearecontrast.com',
                'password' => Hash::make('secret'),
            ]);

            User::updateOrCreate([
                'name' => 'Andy',
                'email' => 'theknight92@gmail.com',
                'password' => Hash::make('secret'),
            ]);

            User::updateOrCreate([
                'name' => 'Simon',
                'email' => 'simon@french-property.com',
                'password' => Hash::make('secret'),
            ]);
        }

        //User::create([
//            'name' => ''
//        ]);
    }
}
