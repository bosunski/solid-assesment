<?php

namespace Language\Validators;

class Content
{
    public static function validate($data){
        // Wrong content.
		if ($data === false) {
			throw new \Exception('Wrong content!');
		}
    }
}