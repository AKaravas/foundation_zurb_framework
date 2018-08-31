<?php
namespace Vendor\FoundationZurbFramework\Hooks\PageLayoutView;

use \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use \TYPO3\CMS\Backend\View\PageLayoutView;

/**
 * Contains a preview rendering for the page module of CType="foundation_tabs"
 */
class TabsPreviewRenderer implements PageLayoutViewDrawItemHookInterface
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

    $verticalTabs = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_tabssettings', $row['tabs_settings_relation'], 'vertical_tabs');
    $collapsedTabs = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_tabssettings', $row['tabs_settings_relation'], 'collapse_tabs');
    $deepTabs = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_tabssettings', $row['tabs_settings_relation'], 'deep_linking');

    if ($row['CType'] === 'foundation_tabs') {
      $headerContent = '<strong class="foundation_title">' . $parentObject->CType_labels[$row['CType']] . '</strong>';
      $itemContent .= '<table class="foundation_table">';
      $itemContent .= '<tbody>';
      $itemContent .= ($verticalTabs['vertical_tabs']===1 ? '<tr><th>Vertical Tabs</th> <td> &#10004;</td></tr>' : '<tr><th>Vertical Tabs</th> <td> &#10008;</td></tr>');
      $itemContent .= ($collapsedTabs['collapse_tabs']===1 ? '<tr><th>Collapsed tabs</th> <td> &#10004;</td></tr>' : '<tr><th>Collapsed tabs</th> <td> &#10008;</td></tr>');
      $itemContent .= ($deepTabs['deep_linking']===1 ? '<tr><th>Deep linking</th> <td> &#10004;</td></tr>' : '<tr><th>Deep linking</th> <td> &#10008;</td></tr>');
      $itemContent .= '</tbody>';
        $itemContent .= '</table>';
        $drawItem = false;
    }
  }
}