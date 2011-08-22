<?php/*** @author Jonathan Martens* @package Tweet! for Joomla* @copyright Copyright (C) 2011 Jonathan Martens. All rights reserved. * @license  GNU/GPL license: http://www.gnu.org/copyleft/gpl.html*/
defined( '_JEXEC' ) or die( 'Restricted access' ); 
// Load css in the body
if ($params->get('location-css', 'head') == 'body')  : ?><link rel="stylesheet" href="<?php echo $modbase ?>css/j.css" type="text/css" /><?php endif; // Load scripts in the body
if($params->get('location-script', 'head') == 'body') : ?><script type="text/javascript" src="<?php echo $modbase?>js/jquery.tweet.js"></script><script type="text/javascript"><?php echo generateScript($params, $module->id); ?></script><?php endif;?><div class="tweet" id="tweet<?php echo $module->id;?>"></div>