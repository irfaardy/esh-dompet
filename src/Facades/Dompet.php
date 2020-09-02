<?php
/* 
	Author: Irfa Ardiansyah <irfa.backend@protonmail.com>
*/
namespace Irfa\Dompet\Facades;

use Illuminate\Support\Facades\Facade;

class Dompet extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Irfa\Dompet\Saku\Dompet::class;
    }
}
