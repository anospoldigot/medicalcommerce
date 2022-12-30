<?php

namespace Silehage\Rajaongkir;

use Illuminate\Support\Facades\Facade;

class RajaongkirFacade extends Facade
{
  public static function getFacadeAccessor()
  {
    return 'Rajaongkir';
  }
}

?>