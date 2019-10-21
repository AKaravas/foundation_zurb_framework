<?php
defined('TYPO3_MODE') or die();

/***************
  * Add User-TSconfig
  */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('
    <INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/TSconfig/User/Base.typoscript">
    [adminUser = 1]
        <INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/TSconfig/User/Admin.typoscript">
    [global]
');


// Register for hook to show preview of tt_content element of CType="foundation_slider" in page module
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['foundation_slider'] = \Karavas\FoundationZurbFramework\Hooks\PageLayoutView\SliderPreviewRenderer::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['foundation_accordion'] = \Karavas\FoundationZurbFramework\Hooks\PageLayoutView\AccordionPreviewRenderer::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['foundation_tabs'] = \Karavas\FoundationZurbFramework\Hooks\PageLayoutView\TabsPreviewRenderer::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['foundation_reveal'] = \Karavas\FoundationZurbFramework\Hooks\PageLayoutView\RevealPreviewRenderer::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['foundation_card'] = \Karavas\FoundationZurbFramework\Hooks\PageLayoutView\CardPreviewRenderer::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['foundation_dropdown'] = \Karavas\FoundationZurbFramework\Hooks\PageLayoutView\DropdownPreviewRenderer::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['foundation_button'] = \Karavas\FoundationZurbFramework\Hooks\PageLayoutView\ButtonPreviewRenderer::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['foundation_group_button'] = \Karavas\FoundationZurbFramework\Hooks\PageLayoutView\ButtonGroupPreviewRenderer::class;
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['foundation_callout'] = \Karavas\FoundationZurbFramework\Hooks\PageLayoutView\CalloutPreviewRenderer::class;