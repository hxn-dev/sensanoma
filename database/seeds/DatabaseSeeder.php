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

        $path = public_path() .'/uploads/avatars';
        if(!is_dir($path)) {
            File::makeDirectory($path, 0777, true);
        }

        factory(App\Models\Role::class)->create();
        factory(App\Models\Role::class)->create([
            'name' => 'viewer',
            'display_name' => 'Viewer',
            'description' => 'Viewer'
        ]);

        for ($i = 0; $i < 5; $i++) {
            $this->createUsersWithEachRoles();
        }

        $this->command->info('The database has been seeded');

    }

    public function createUsersWithEachRoles()
    {
        $user = factory(App\Models\User::class)->create();
        $user->attachRole('admin');
        // Create an Area, bind it to an account
        $areas = factory(App\Models\Area::class, rand(1, 3))->create([
            'account_id' => $user->account->id
        ]);

        // Create a Zone, bind it to an area
        $zones = new \Illuminate\Support\Collection();
        foreach ($areas as $area) {
            $zones->push(factory(App\Models\Zone::class, rand(1, 5))->create(['area_id' => $area->id]));
        }


        // Create a Sensor Node, bind it to an account and a zone
        foreach ($zones as $zone) {
            foreach ($zone->toArray() as $zone) {
                factory(App\Models\SensorNode::class)->create([
                    'account_id' => $user->account->id,
                    'zone_id' => $zone['id']
                ]);
            }
        }

        $viewer = factory(App\Models\User::class)->create(['account_id' => $user->account->id]);
        $viewer->attachRole('viewer');
    }

}
