<?php

namespace Language\Validators;

class Response
{
    public static function validate($data)
    {
        // Wrong response.
		if ($data['status'] != 'OK') {
			throw new \Exception('Wrong response: '
				. (!empty($data['error_type']) ? 'Type(' . $data['error_type'] . ') ' : '')
				. (!empty($data['error_code']) ? 'Code(' . $data['error_code'] . ') ' : '')
				. ((string)$data['data']));
		}
    }
}