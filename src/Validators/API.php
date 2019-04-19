<?php

namespace Language\Validators;


class API
{
   
	public static function checkForErrorResult($result)
	{
		self::apiCallError($result);
		Response::validate($result);
		Content::validate($result['data']);
	}

	public function apiCallError($result)
	{
		// Error during the api call.
		if ($result === false || !isset($result['status'])) {
			throw new \Exception('Error during the api call');
		}	
	}
}