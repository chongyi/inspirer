<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    public static function getCategoryTree()
    {
        $categorys = static::orderBy('sort', 'desc')->get();

        return static::getSubset(0, $categorys);
    }

    public static function getSubset($parentId = 0, $data)
    {
        $result = [];

        foreach ($data as $key => $value) {
            if ($value['parent_id'] == $parentId) {
                $value['subset'] = static::getSubset($value['id'], $data);
                $result[] = $value;
            }
        }

        return $result;
    }

}
