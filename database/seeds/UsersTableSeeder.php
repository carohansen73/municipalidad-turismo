<?php

use Illuminate\Database\Seeder;

use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = factory(User::class)->create([
            'name'          =>  'Diego',
            'lastname'      =>  'Gonzalez',
            'email'         =>  'diego.computos@gmail.com',
            'password'      =>  bcrypt(env('ADMIN_PASS_SEED')),
            'created_at'    =>  date("Y-m-d H:i:s"),
            'updated_at'    =>  date("Y-m-d H:i:s")
        ]);

        $user2 = factory(User::class)->create([
            'name'          =>  'Usuario',
            'lastname'      =>  'Administrador',
            'email'         =>  'administrador@gmail.com',
            'password'      =>  bcrypt(env('ADMIN_PASS_SEED')),
            'created_at'    =>  date("Y-m-d H:i:s"),
            'updated_at'    =>  date("Y-m-d H:i:s")
        ]);

        $superadmin = Bouncer::role()->firstOrCreate([
            'name' => 'superadmin',
            'title' => 'Super administrador',
        ]);

        $admin = Bouncer::role()->firstOrCreate([
            'name' => 'admin',
            'title' => 'Administrador',
        ]);

        // Creamos el rol de super administrador con permisos para todo
        Bouncer::allow($superadmin)->everything();
        // Asignamos los roles a los distintos usuarios
        Bouncer::assign($superadmin)->to($user1);
        Bouncer::assign($admin)->to($user2);

        // Creamos el rol de miembro
        Bouncer::disallow($admin)->to('view-all', User::class);
    }
}
