<?php

namespace Language\Validators;

class ValidateAPI
{
    	/**
	 * Checks the api call result.
	 *
	 * @param mixed  $result   The api call result to check.
	 *
	 * @throws Exception   If the api call was not successful.
	 *
	 * @return void
	 */
	public static function checkForApiErrorResult($result)
	{
		// Error during the api call.
		if ($result === false || !isset($result['status'])) {
			throw new \Exception('Error during the api call');
		}
		// Wrong response.
		if ($result['status'] != 'OK') {
			throw new \Exception('Wrong response: '
				. (!empty($result['error_type']) ? 'Type(' . $result['error_type'] . ') ' : '')
				. (!empty($result['error_code']) ? 'Code(' . $result['error_code'] . ') ' : '')
				. ((string)$result['data']));
		}
		// Wrong content.
		if ($result['data'] === false) {
			throw new \Exception('Wrong content!');
		}
	}
}