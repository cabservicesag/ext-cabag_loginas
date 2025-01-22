<?php

if (!defined('TYPO3')) {
	die ('Access denied.');
}

use TYPO3\CMS\Core\Http\ApplicationType;

if (ApplicationType::fromRequest(@$GLOBALS['TYPO3_REQUEST'])->isBackend()) {
	// register the class as toolbar item
	$GLOBALS['TYPO3_CONF_VARS']['BE']['toolbarItems']['cabag_loginas'] = \Cabag\CabagLoginas\Hook\ToolbarItemHook::class;
}
