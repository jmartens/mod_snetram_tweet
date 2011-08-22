<?php
/**
* @author Jonathan Martens
* @package Tweet! for Joomla
* @copyright Copyright (C) 2011 Jonathan Martens. All rights reserved. 
* @license  GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

// load our helper function
require_once('helper.php');

// attach to the current Joomla page
$document =& JFactory::getDocument();
$modbase = JURI::base() . "modules/" . $module->module . "/";

// add style sheet to page head element (to the body is handled in the template)
if($params->get('location-css', 'head') == 'head') {

	$document->addStyleSheet($modbase.'css/jquery.tweet.css');

}

// add scripts to page head element (to the body is handled in the template)
if($params->get('location-script', 'head') == 'head') {

	$document->addScript($modbase . "js/jquery.tweet.js");
	$document->addScriptDeclaration(generateScript($params, $module->id));

}

require(JModuleHelper::getLayoutPath($module->module, 'default'));

?>