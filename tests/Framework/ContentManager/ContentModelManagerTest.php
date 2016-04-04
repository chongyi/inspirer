<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Inspirer\Framework\ContentManager\Models\Article;
use Inspirer\Framework\ContentManager\Category;
use Inspirer\Framework\Account\User\User;
use Inspirer\Framework\ContentManager\Content;

class ContentModelManagerTest extends TestCase
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

    /**
     * @return \Inspirer\Framework\ContentManager\ModelManager
     */
    public function getManager()
    {
        return $this->app->make(\Inspirer\Framework\ContentManager\ModelManager::class);
    }

    public function testRegister()
    {
        $manager = $this->getManager();
        
        $manager->register('article', function () {
            return new Article();
        });
     
        $this->assertInstanceOf(\Inspirer\Framework\ContentManager\ContentModel::class, $manager->getModel('article'));
    }

    public function testPublishArticleViaManager()
    {
        $manager = $this->getManager();
        $manager->register('article', function () {
            return new \Inspirer\Framework\ContentManager\Models\Article();
        });

        $article = null;

        $content = (new Content())->setTitle('test article')
                                  ->setName('test')
                                  ->setPublisher($account = $this->generateAccount())
                                  ->setCategory($this->generateCategory())
                                  ->setModel('article', function (Article $generate) use (&$article) {
                                      $generate->setContent('Content Test!');
                                      $article = $generate;
                                  });

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
