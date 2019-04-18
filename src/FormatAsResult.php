<?php

namespace Language;

class FormatAsResult
{

    public static function formatAsResult($data)
	{
		return [
			'status' => 'OK',
			'data'   => $data,
		];
	}

}