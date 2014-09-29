<?php

namespace Parc\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ParcUserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
