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
        $this->call(UsersTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);

        $this->call(FeedstockSeeder::class);
        $this->call(SideDishSeeder::class);
        
        $this->call(ProductHasFeedstockSeeder::class);
        $this->call(ProductHasSideDishSeeder::class);
        $this->call(ProductCategorySeeder::class);
        
        $this->call(ProductSeeder::class);
    }
}
