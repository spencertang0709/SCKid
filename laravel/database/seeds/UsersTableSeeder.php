<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Create admin user with 4 kids, each kid has 5 SMS messages
        factory(App\User::class, 'admin')
            ->create()
            ->each(function($user){
                //Saving 4 kids for the admin
                $user->kids()->saveMany(factory(App\Kid::class, 4)
                	->create()
                    ->each(function($kid){
                        //Attach five apps to each kid
						$kid->apps()->saveMany(factory(App\App::class, 5)->create());
						
						//Attach one device to each kid
						$kid->devices()->save(factory(App\Device::class)->create());
						
						
                    })
                );
				
				//Create 5 devices for the admin that are not linked to any kid
				$user->devices()->saveMany(factory(App\Device::class, 5)->create());

                //Attaching admin role to user
                $user->roles()->attach(1);
				
            });
			
		factory(App\User::class, 'parent')
            ->create()
            ->each(function($user){
                //Saving 4 kids for the admin
                $user->kids()->saveMany(factory(App\Kid::class, 4)
                	->create()
                    ->each(function($kid){
                        //Attach five apps to each kid
						$kid->apps()->saveMany(factory(App\App::class, 5)->create());
						
						//Attach one device to each kid
						$kid->devices()->save(factory(App\Device::class)->create());
						
						
                    })
                );
				
				//Create 5 devices for the admin that are not linked to any kid
				$user->devices()->saveMany(factory(App\Device::class, 5)->create());

                //Attaching parent role to user
                $user->roles()->attach(2);
				
            });

        //Creating roles

//        $parent = Role::create(array(
//            'name'     => 'parent'
//        ));
//
//        $teacher = Role::create(array(
//            'name'     => 'teacher'
//        ));
//
//        $admin = Role::create(array(
//            'name'     => 'admin'
//        ));

        // Assign roles using one of several methods:
        // Syncing
//        $user->roles()->sync([$superadmin->id]);
//        // or attaching
//        $user->roles()->attach($superadmin->id);
//        // or save
//        $user->roles()->save($superadmin);


//        //Create 3 users with no kids attached
//        factory(App\User::class, 3)->create();

//        10 users with 2 kids attached each
        factory(App\User::class, 10)
            ->create()
            ->each(function($user){

//           $u->kids()->save(factory(App\Kid::class)->make());

                //Assign 5 kids to each user
                //1 parent to many children
                $user->kids()->saveMany(factory(App\Kid::class, 2));

                //Assign 1 role to parent role_user table
//                $u->roles()->sync([1]);

                //This works below
//                $user->roles()->attach(2);

//                $user->roles()->attach(factory(App\Role::class));
//                $user->roles()->save(factory(App\Role::class)->create());

                //Attach random role 2,3 (Parent, Teacher)
                $user->roles()->attach(App\Role::find(rand(2,3)));
        });


    }
}
