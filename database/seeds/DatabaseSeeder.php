<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        //添加用户数据
        $this->call(UsersTableSeeder::class);
        //添加微博数据
        $this->call(StatusesTableSeeder::class);
        //关注列表
        $this->call(FollowersTableSeeder::class);
        Model::reguard();
    }
}
