<?php
if (!defined ('TYPO3_MODE')) {
 	die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'deCode.' . $_EXTKEY,
	'Gallery',
	array(
		'Gallery' => 'list'
	)
);

require_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Classes/ViewHelpers/FastGalleryPaginatorViewHelper.php');