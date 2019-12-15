<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        // 循环生成50条测试数据
//		for ($i = 0; $i < 2; $i++) {
        $data[] = [
            'name'          => '首页',
            'code'      	=> 'dashboard',
            'parent_id'     => 0,
            'icon'          => 'home',
            'url'           => '#'
        ];
        $data[] = [
            'name'          => '管理员列表',
            'code'      	=> 'admin_list',
            'parent_id'     => 0,
            'icon'          => 'home',
            'url'           => '#'
        ];
        $data[] = [
            'name'          => '系统设置',
            'code'      	=> 'setting',
            'parent_id'     => 0,
            'icon'          => 'home',
            'url'           => '#'
        ];
//		}

        DB::table('menus')->insert($data);
    }
}
