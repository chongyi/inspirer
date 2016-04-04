<?php
namespace Inspirer\Framework\ContentManager\Facades;

use Inspirer\Framework\ContentManager\ModelManager as ContentModelManager;
use Illuminate\Support\Facades\Facade;

/**
 * ModelManager.php
 *
 * Creator:         chongyi
 * Create Datetime: 2016/4/4 15:52
 */
class ModelManager extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ContentModelManager::class;
    }

}