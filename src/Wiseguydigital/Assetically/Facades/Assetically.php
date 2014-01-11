<?php

namespace Wiseguydigital\Assetically\Facades;

use Illuminate\Support\Facades\Facade;

class Assetically extends Facade {

	protected static function getFacadeAccessor() {
		return 'assetically'; 
	}

}