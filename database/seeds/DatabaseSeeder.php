<?php

use App\GameStatus;
use App\Person;
use App\Services\PersonService;
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
        $this->seedGameStatuses();
        $this->seedAdmins();
        $this->seedPeople();
    }

    private function seedGameStatuses(): void
    {
        $gameStatuses = [
            ['id' => 1, 'status' => 'Creating', 'description' => 'Game is being created'],
            ['id' => 2, 'status' => 'Matching', 'description' => 'Awaiting Opponent'],
            ['id' => 3, 'status' => 'In Progress', 'description' => 'Game is being played'],
            ['id' => 4, 'status' => 'Finished', 'description' => 'Game Finished'],
            ['id' => 5, 'status' => 'Error', 'description' => 'Oh dear, there was an error'],
        ];

        foreach ($gameStatuses as $status) {
            GameStatus::updateOrCreate(
                ['id' => $status['id']],
                ['status' => $status['status'], 'description' => $status['description']]
            );
        }
    }

    private function seedAdmins(): void
    {
        if (User::count() === 0) {
            $admins = [
                ['id' => 1, 'name' => 'Mike', 'email' => 'mike@wearecontrast.com'],
                ['id' => 2, 'name' => 'Andy', 'email' => 'theknight92@gmail.com'],
                ['id' => 3, 'name' => 'Simon', 'email' => 'simon@french-property.com'],
                ['id' => 4, 'name' => 'Test', 'email' => 'test@test.com'],
            ];

            foreach ($admins as $admin) {
                User::updateOrCreate(['id' => $admin['id']], [
                    'name' => $admin['name'],
                    'email' => $admin['email'],
                    'password' => Hash::make('secret'),
                ]);
            }
        }
    }

    private function seedPeople(): void
    {
        if (Person::count() === 0) {

            $people = [
                'taylorotwell', 'mikeaag', 'franzliedke', 'GrahamCampbell', 'daylerees', 'driesvints', 'sparksp',
                'cviebrock', 'tobsn', 'crynobone', 'jasonlewis', 'ShawnMcCool', 'JeffreyWay', 'tillkruss', 'themsaid',
                'JosephSilber', 'laurencei', 'neoascetic', 'ericlbarnes', 'barryvdh', 'JesseObrien', 'mikelbring',
                'kapv89', 'codler'
            ];

            $service = new PersonService();
            foreach ($people as $username) {
                $service->importPersonFromGithub($username);
            }
        }
    }
}
