<?php
namespace Vendor\FoundationZurbFramework\Hooks\PageLayoutView;

use \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use \TYPO3\CMS\Backend\View\PageLayoutView;

/**
 * Contains a preview rendering for the page module of CType="foundation_card"
 */
class ButtonGroupPreviewRenderer implements PageLayoutViewDrawItemHookInterface
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

 
    $buttonGroupSize = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_buttongroupsettings', $row['buttongroup_settings_relation'], 'size');
    $buttonGroupColor = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_buttongroupsettings', $row['buttongroup_settings_relation'], 'color');
    $buttonGroupStacked = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_buttongroupsettings', $row['buttongroup_settings_relation'], 'stacked');
    $buttonGroupExpanded = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_buttongroupsettings', $row['buttongroup_settings_relation'], 'expanded');
    $buttonGroupContainer = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_buttongroupsettings', $row['buttongroup_settings_relation'], 'container');
    $buttonGroupAlignment = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_buttongroupsettings', $row['buttongroup_settings_relation'], 'position');

      if ($row['CType'] === 'foundation_group_button') {
        $headerContent = '<strong class="foundation_title">' . $parentObject->CType_labels[$row['CType']] . '</strong>';
        $itemContent .= '<table class="foundation_table one_table">';
        $itemContent .= '<tbody>';
        $itemContent .= '<tr><th>Size</th><th>Color</th><th>Stacked</th><th>Container</th></tr>';
        $itemContent .= '<tr>';
        $itemContent .= ($buttonGroupSize['size']==='' ? '<td> Normal</td>' : '<td>'.$buttonGroupSize['size'].'</td>');
        $itemContent .= ($buttonGroupColor['color']==='' ? '<td> Normal</td>' : '<td>'.$buttonGroupColor['color'].'</td>');
        $itemContent .= ($buttonGroupExpanded['stacked']==='' ? '<td>'.$buttonGroupExpanded['stacked'].'</td>' : '<td> &#10008;</td>');
        $itemContent .= ($buttonGroupContainer['container']===1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
        $itemContent .= '</tr>';
        $itemContent .= '</tbody>';
        $itemContent .= '</table>';
        $itemContent .= '<strong class="foundation_subtitle">Advanced</strong>';
        $itemContent .= '<table class="foundation_table">';
        $itemContent .= '<tbody>';
        $itemContent .= '<tr><th>Container</th><th>Align</th>';
        $itemContent .= '<tr>';
        $itemContent .= ($buttonGroupContainer['container']===1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
        $itemContent .= ($buttonGroupContainer['container']!=1 ? '<td>Container not active</td>' : ($buttonGroupAlignment['position']=== '' ? '<td> align-left</td>' : '<td>'.$buttonGroupAlignment['position'].'</td>'));
        $itemContent .= '</tr>';
        $itemContent .= '</tbody>';
        $itemContent .= '</table>';
        $drawItem = false;
    }
  }
}