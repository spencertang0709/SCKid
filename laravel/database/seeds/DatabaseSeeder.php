<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(KidsTableSeeder::class);

        //Can be created without seeding other tables
        $this->call(AppsTableSeeder::class);
        $this->call(WebsitesTableSeeder::class);
        $this->call(TimesTableSeeder::class);
        $this->call(DevicesTableSeeder::class);

        //These are linked
    	$this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        //All these are associated with a kid
        $this->call(BeaconsTableSeeder::class);
        $this->call(LocationsTableSeeder::class);
        $this->call(SmssTableSeeder::class);
        $this->call(CallsTableSeeder::class);
		$this->call(PanicsTableSeeder::class);
		$this->call(ContextPolicysTableSeeder::class);

        //These are all associated with the user
        $this->call(CategoriesTableSeeder::class);
        $this->call(TitlesTableSeeder::class);
    }
}
