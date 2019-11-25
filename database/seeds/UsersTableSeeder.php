<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = "Valentina Moya";
        $user->rut = "18.572.666-5";
        $user->hospital = "San Juan de Dios";
        $user->area = "Atención Domiciliaria";
        $user->email = "admin@admin.com";
        $user->password = bcrypt('admin');
        $user->cargo = "Fonoaudiologa";
        $user->save();
    }
}
