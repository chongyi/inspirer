<?php

namespace Inspirer\Framework\ContentManager\Models;

use Illuminate\Database\Eloquent\Model;
use Inspirer\Framework\ContentManager\Content;

class Article extends Model
{
    /**
     * @param mixed $content
     *
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @param mixed $author
     *
     * @return Article
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @param mixed $source
     *
     * @return Article
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @param mixed $sourceName
     *
     * @return Article
     */
    public function setSourceName($sourceName)
    {
        $this->sourceName = $sourceName;

        return $this;
    }

    public function meta()
    {
        return $this->morphOne(Content::class, 'model');
    }

    public function category()
    {
        return $this->meta->category();
    }
}
