<?php

namespace AppBundle\Utils;

/**
 * Crea un Slug de un texto.
 *
 * @author Javier
 */
class Slugger {

	public function slugify($string) {
		return preg_replace(
				'/[^a-z0-9]/', '-', strtolower(trim(strip_tags($string)))
		);
	}

}
