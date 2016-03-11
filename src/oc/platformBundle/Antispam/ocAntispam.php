<?php


namespace oc\platformBundle\Antispam;

class ocAntispam
{

	public function isSpam($text){
		return strlen($text)<50;
	}
}