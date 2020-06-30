<?php
/**
 * Created by PhpStorm.
 * User: alishojaei
 * Date: 2020-03-02
 * Time: 17:30.
 */

namespace Alishojaeiir\Smschi;

use Illuminate\Support\Facades\Facade;

class SmschiFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'smschi';
    }
}
