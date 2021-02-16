<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $senha  = Hash::make('1234');
        User::create([
            'name' => 'Administrador',
            'email'=>'administrador@adm.com',
            'cpf' => '905.131.940-10',
            'password'=>$senha
        ]);
        User::create([
            'name' => 'Uilton',
            'email'=>'uilton-gomes@hotmail.com',
            'cpf' => '061.578.055-52',
            'password'=>$senha
        ]);
    }
}
