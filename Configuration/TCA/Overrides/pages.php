<?php
defined('TYPO3_MODE') or die();

$_EXTKEY = $GLOBALS['_EXTKEY'] = 'foundation_zurb_framework';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    $_EXTKEY,
    'Configuration/BackendLayouts/BackendLayouts.typoscript',
    'Foundation Zurb - BackendLayouts'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::registerPageTSConfigFile(
    $_EXTKEY,
    'Configuration/TSconfig/Page.typoscript',
    'Foundation Zurb - PageTS'
);