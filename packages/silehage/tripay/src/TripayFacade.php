<?php

namespace Silehage\Tripay;

use Illuminate\Support\Facades\Facade;

class TripayFacade extends Facade
{
  public static function getFacadeAccessor()
  {
    return 'Tripay';
  }
}

?>