<?php namespace App\Http\Facades\Repository;

use Illuminate\Support\Facades\Facade;

/**
 * Class CategoriesFacade
 *
 * @package App\Http\Facades\Repository
 */
class CategoriesFacade extends Facade
{

    /**
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'categories';
    }
}