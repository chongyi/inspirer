<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\Article;

class DefaultSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
            ]);

        Category::create([
            'name' => 'default',
            'display_name' => '默认',
            'display_in_nav' => true,
            'description' => '默认分类',
            ]);
        Category::create([
            'name' => 'default',
            'display_name' => '默认1',
            'display_in_nav' => true,
            'description' => '默认分类',
            ]);
        Category::create([
            'name' => 'default',
            'display_name' => '默认2',
            'display_in_nav' => true,
            'description' => '默认分类',
            'parent_id' => 2
            ]);
        Category::create([
            'name' => 'default',
            'display_name' => '默认3',
            'display_in_nav' => true,
            'description' => '默认分类',
            'parent_id' => 2
            ]);
        Category::create([
            'name' => 'default',
            'display_name' => '默认4',
            'display_in_nav' => true,
            'description' => '默认分类',
            'parent_id' => 4
            ]);

        Article::create([
            'title' => '欢迎使用！',
            'keywords' => 'myblog,welcome,我的博客,欢迎使用',
            'description' => '欢迎使用我的博客！这是一个简单到极致的博客程序，基于laravel 5开发。',
            'content' => '欢迎使用我的博客！这是一个简单到极致的博客程序，基于laravel 5开发。',
            'category_id' => 1,
            ]);

        Article::create([
            'title' => '这是一篇测试文章',
            'keywords' => 'test,myblog,测试',
            'description' => '这只是一篇测试文章，用测试效果',
            'content' => '欢迎使用我的博客！这是一个简单到极致的博客程序，基于laravel 5开发。',
            'category_id' => 1,
            ]);

        // $this->call('UserTableSeeder');
    }

}
