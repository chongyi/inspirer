<?php
namespace App\Inspirer;

use Parsedown;

class ArticleProcess
{
    const PAGE_BREAK = '[========]';

    const PAGE_BREAK_CONVERT = '<p id="page-break-anchor"></p>';

    public static function getSummary($body, Parsedown $parse = null)
    {
        if (is_null($parse)) {
            $parse = new Parsedown;
        }

        $split = explode(static::PAGE_BREAK_CONVERT, $body);

        return $parse->text($split[0]);
    }

    public static function convertArticle($body)
    {
        $split = explode(ArticleProcess::PAGE_BREAK, $body, 2);

        $content = implode(ArticleProcess::PAGE_BREAK_CONVERT, $split);

        return ['description' => $split[0], 'content' => $content];
    }

    public static function recallArticle($body)
    {
        $split = explode(ArticleProcess::PAGE_BREAK_CONVERT, $body, 2);

        $content = implode(ArticleProcess::PAGE_BREAK, $split);

        return $content;
    }

    public static function getContent($body, Parsedown $parse = null)
    {
        if (is_null($parse)) {
            $parse = new Parsedown;
        }

        return $parse->text($body);
    }
}