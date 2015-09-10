<?php namespace App\Console\Commands;

use App\Inspirer\Models\Article;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SearchIndexBuilder extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'build:search-index';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $articles = Article::all();

        $xs      = new \XS('inspirer');
        $xsindex = $xs->index;
        $xsindex->clean();

        foreach ($articles as $article) {
            $doc = new \XSDocument();
            $this->output->writeln(sprintf("<comment>[Add]</comment> article [id:<info>%d</info>] - %s", $article->id,
                $article->title));
            $doc->setFields([
                'id'          => $article->id,
                'title'       => $article->title,
                'name'        => $article->name,
                'description' => $article->description,
                'keyword'     => $article->keywords,
                'content'     => $article->content
            ]);

            $xsindex->add($doc);
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [

        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [

        ];
    }

}
