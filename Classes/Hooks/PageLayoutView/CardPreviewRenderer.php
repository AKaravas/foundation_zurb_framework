<?php
namespace Vendor\FoundationZurbFramework\Hooks\PageLayoutView;

use \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use \TYPO3\CMS\Backend\View\PageLayoutView;

/**
 * Contains a preview rendering for the page module of CType="foundation_card"
 */
class CardPreviewRenderer implements PageLayoutViewDrawItemHookInterface
{

   /**
    * Preprocesses the preview rendering of a content element of type "Foundation Tabs"
    *
    * @param \TYPO3\CMS\Backend\View\PageLayoutView $parentObject Calling parent object
    * @param bool $drawItem Whether to draw the item using the default functionality
    * @param string $headerContent Header content
    * @param string $itemContent Item content
    * @param array $row Record row of tt_content
    *
    * @return void
    */
   public function preProcess(
      PageLayoutView &$parentObject,
      &$drawItem,
      &$headerContent,
      &$itemContent,
      array &$row
   )
   {

    $removeContainer = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_cardsettings', $row['card_settings_relation'], 'use_container');
    $smallItems = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_cardsettings', $row['card_settings_relation'], 'small_items');
    $mediumItems = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_cardsettings', $row['card_settings_relation'], 'medium_items');
    $largeItems = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_cardsettings', $row['card_settings_relation'], 'large_items');
    
      if ($row['CType'] === 'foundation_card') {
        $headerContent = '<strong class="foundation_title">' . $parentObject->CType_labels[$row['CType']] . '</strong>';
        $itemContent .= '<table class="foundation_table">';
        $itemContent .= '<tbody>';
        $itemContent .= '<tr><th>Items on small</th> <td> '. $smallItems['small_items'] .'</td></tr>';
        $itemContent .= '<tr><th>Items on medium</th> <td> '. $mediumItems['medium_items'] .'</td></tr>';
        $itemContent .= '<tr><th>Items on large</th> <td> '. $largeItems['large_items'] .'</td></tr>';
        $itemContent .= '</tbody>';
        $itemContent .= '</table>';
        $itemContent .= '<strong class="foundation_subtitle">Card container</strong>';
        $itemContent .= '<table class="foundation_table">';
        $itemContent .= '<tbody>';
        $itemContent .= ($removeContainer['use_container']===1 ? '<th>Remove container</th> <td> &#10004;</td></tr>' : '<th>Remove container</th> <td> &#10008;</td></tr>');
        $itemContent .= '</tbody>';
        $itemContent .= '</table>';
        $drawItem = false;
    }
  }
}