<?php

namespace DDD\App\Facades;

use Illuminate\Support\Facades\Facade;

class GoogleAuth extends Facade
{
   protected static function getFacadeAccessor()
   {
       return 'GoogleAuthService';
   }
}