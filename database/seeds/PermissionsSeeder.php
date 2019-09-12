<?php

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' => 'to login', 'guard_name' => 'api'],
            ['name' => '*', 'guard_name' => 'api'],

            //  achievements

            ['name' => 'create achievement', 'guard_name' => 'api'],
            ['name' => 'get achievements', 'guard_name' => 'api'],
            ['name' => 'achievement attach category', 'guard_name' => 'api'],
            ['name' => 'achievement detach category', 'guard_name' => 'api'],
            ['name' => 'achievement attach tag', 'guard_name' => 'api'],
            ['name' => 'achievement detach tag', 'guard_name' => 'api'],
            ['name' => 'get waiting achievements', 'guard_name' => 'api'],
            ['name' => 'edit achievement', 'guard_name' => 'api'],
            ['name' => 'delete achievement', 'guard_name' => 'api'],
            ['name' => 'attach achievement', 'guard_name' => 'api'],
            ['name' => 'detach achievement', 'guard_name' => 'api'],

            //  rewards

            ['name' => 'get rewards', 'guard_name' => 'api'],
            ['name' => 'get waiting rewards', 'guard_name' => 'api'],
            ['name' => 'reward achievement', 'guard_name' => 'api'],
            ['name' => 'remove reward achievement', 'guard_name' => 'api'],

            //  approves

            ['name' => 'approve achievement allow', 'guard_name' => 'api'],
            ['name' => 'approve reward allow', 'guard_name' => 'api'],
            ['name' => 'approve achievement deny', 'guard_name' => 'api'],
            ['name' => 'approve reward deny', 'guard_name' => 'api'],

            //  categories

            ['name' => 'create category', 'guard_name' => 'api'],
            ['name' => 'get categories', 'guard_name' => 'api'],
            ['name' => 'update category', 'guard_name' => 'api'],
            ['name' => 'delete category', 'guard_name' => 'api'],

            //  tags

            ['name' => 'create tag', 'guard_name' => 'api'],
            ['name' => 'get tags', 'guard_name' => 'api'],
            ['name' => 'update tag', 'guard_name' => 'api'],
            ['name' => 'delete tag', 'guard_name' => 'api'],
        ];

        array_walk($permissions, function($permission) {
            \Spatie\Permission\Models\Permission::firstOrCreate($permission);
        });
    }
}
