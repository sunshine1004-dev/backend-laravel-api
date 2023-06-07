<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Arr;

/**
 * Class Api
 * @package App
 */
class Api extends Model
{

    /**
 * @return mixed
 * @throws \GuzzleHttp\Exception\GuzzleException
 */
    public function fetchGuardianArticles()
    {
        $urlParams = 'everything?q=news';
        $response = (new Helper)->makeGuardianAPiCall($urlParams);

        return Arr::get($response,'articles');
    }
}
