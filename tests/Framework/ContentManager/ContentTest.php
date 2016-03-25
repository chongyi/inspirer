<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Inspirer\Framework\ContentManager\Category;
use Inspirer\Framework\ContentManager\Content;
use Inspirer\Framework\ContentManager\Models\Article;
use Inspirer\Framework\Account\User\User;

class ContentTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    public function generateCategory()
    {
        $category = (new Category())->setTitle('test')->setName('test');
        $category->save();

        return $category;
    }

    public function generateAccount()
    {
        $account = (new User())->setEmail('admin@admin.com')->setNickname('test')->setPassword('123456');
        $account->save();

        return $account;
    }

    public function testCategoryGenerate()
    {
        $category = (new Category())->setTitle('test')->setName('test');
        $category->save();

        $this->seeInDatabase('categories', ['title' => 'test', 'name' => 'test']);

        $categoryChild = (new Category())->setName('test2')->setTitle('test')->setParent($category);
        $categoryChild->save();

        $this->seeInDatabase('categories', ['title' => 'test', 'name' => 'test2', 'parent_id' => $category->id]);
    }

    public function testContentPublish()
    {
        $account  = $this->generateAccount();
        $category = $this->generateCategory();

        $article = (new Article())->setContent('Content Test!');
        $article->save();

        $content = (new Content())->setTitle('test article')
                                  ->setName('test')
                                  ->setPublisher($account)
                                  ->setCategory($category)
                                  ->setModel($article);

        $content->save();

        $this->seeInDatabase('articles', ['content' => 'Content Test!']);
        $this->seeInDatabase('contents', [
            'account_type' => User::class,
            'account_id'   => $account->id,
            'model_type'   => Article::class,
            'model_id'     => $article->id,
            'title'        => 'test article',
            'name'         => 'test',
        ]);
    }


}
