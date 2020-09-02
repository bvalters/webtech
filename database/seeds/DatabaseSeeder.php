<?php

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
        DB::insert('insert into users (id, name, email, is_admin, password) values (?, ?, ?, ?, ?)',
            [1, 'admin', 'admin@test.com', true, bcrypt("password")]);
        DB::insert('insert into users (id, name, email, is_admin, password) values (?, ?, ?, ?, ?)',
            [2, 'test', 'test@test.com', false, bcrypt("password")]);
    }
}
