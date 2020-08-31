<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 8/1/20
 * Time: 7:39 PM
 */

namespace App\Repositories;





use Illuminate\Cache\CacheManager;

class CoreRepository
{
    protected $cacheManager;

    public function __construct(CacheManager $cacheManager)
    {
        $this->cacheManager = $cacheManager;

    }
}
