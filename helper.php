<?php
/**
* @author Jonathan Martens
* @package Tweet for Joomla!
* @copyright Copyright (C) 2011 Jonathan Martens. All rights reserved. 
* @license  GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
*/

function generateScript($params, $id = '') {

	/*
	First check for minimal required settings:
	We need a username if that is not supplied we need a query,
	both should perhaps be OK as well
	*/
	if (($params->get('username', '') != '') || ($params->get('query', '') != '')) {

		$api = array(
			'username' => 'string',
			'list' => 'string',
/*			'favorites' => 'bool',*/
			'query' => 'string',
			'avatar_size' => 'int',
			'count' => 'int',
			'fetch' => 'int',
			'page' => 'int',
			'retweets' => 'bool',
			'intro_text' => 'string',
			'outro_text' => 'string',
			'join_text' => 'string',
			'auto_join_text_default' => 'string',
			'auto_join_text_ed' => 'string',
			'auto_join_text_ing' => 'string',
			'auto_join_text_reply' => 'string',
			'auto_join_text_url' => 'string',
			'loading_text' => 'string',
			'refresh_interval' => 'int',
			'twitter_url' => 'string',
			'twitter_api_url' => 'string',
			'twitter_search_url' => 'string',
			'template' => 'string',
			'comparator' => 'function',
			'filter' => 'function',
		);

		// set up an empty array to hold all the formatted params
		$values = array();

		// loop through the params
		foreach($api as $key => $type) {

			// handle appropriate quote based on data type
			switch ($type) {
				case 'function':
				case 'int':
					$quote = '';
				break;
				case 'bool':
				case 'string':
				case 'default':
					$quote = '"';
			}

			// retrieve the value
			$value = $params->get($key, null);

			// make sure we only add valid values
			if (!is_null($value)) {

				if ($key == 'username') {
				
					$value = preg_split(
						"/[\s,;:.]+/",
						//            '/,/',
						$value,
						null,
						PREG_SPLIT_NO_EMPTY
					);
					
				}

				// handle the special case of a multivalue list, currently only possible for the username field
				if (!is_array($value)) {

					$values[] = sprintf(
						"\t\t%s: %s%s%s",
						$key,
						$quote,
						$value,
						$quote
					);

				} else {

					$values[] = sprintf(
						"\t\t%s: [%s%s%s]",
						$key,
						$quote,
						implode(
							'", "',
							$value
						),
						$quote
					);

				}

			}

			$bind = '';

		}

	} else {

		$bind = sprintf('.bind(%s)', '"empty", function() { $(this).append("Either a username or a query needs to be provided"); }');

	}

	return $script = sprintf(
		"jQuery.noConflict();\n" .
		"jQuery(document).ready(function(){\n" .
		"\tjQuery('#jtweet$id').tweet({\n" .
		"%s\n" .
		"\t});\n" .
		"})%s;", join(",\n", $values), $bind
	);

}
?>