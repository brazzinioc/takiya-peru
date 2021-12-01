<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if( config('app.env') === 'local' ){

            User::create([
                'name' => 'Jhon Doe',
                'slug' => 'jhon-doe',
                'email' => 'admin@takiya.com',
                'password' => bcrypt('BXS!3rn%ea')
            ]);

        }
    }
}
