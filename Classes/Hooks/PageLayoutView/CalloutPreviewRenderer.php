<?php
namespace Vendor\FoundationZurbFramework\Hooks\PageLayoutView;

use \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use \TYPO3\CMS\Backend\View\PageLayoutView;

/**
 * Contains a preview rendering for the page module of CType="foundation_callout"
 */
class CalloutPreviewRenderer implements PageLayoutViewDrawItemHookInterface
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

    $calloutTitle = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_callout', $row['callout_content_relation'], 'title');
    $calloutSize = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_callout', $row['callout_content_relation'], 'size');
    $calloutColor = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_callout', $row['callout_content_relation'], 'color');
    $calloutClosable = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_callout', $row['callout_content_relation'], 'is_closable');
    $calloutAnimationOut = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_callout', $row['callout_content_relation'], 'animation_out');
    $calloutContainer = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_button', $row['callout_content_relation'], 'container');

      if ($row['CType'] === 'foundation_callout') {
        $headerContent = '<strong class="foundation_title">' . $parentObject->CType_labels[$row['CType']] . '</strong>';
        $itemContent .= '<table class="foundation_table one_table">';
        $itemContent .= '<tbody>';
        $itemContent .= '<tr><th>Title</th><th>Size</th><th>Color</th><th>Animation</th><th>Closable</th><th>Container</th></tr>';
        $itemContent .= '<tr>';
        $itemContent .= '<td> '. $calloutTitle['title'] .'</td>';
        $itemContent .= ($calloutSize['size']==='' ? '<td> Normal</td>' : '<td>'.$calloutSize['size'].'</td>');
        $itemContent .= '<td> '. $calloutColor['color'] .'</td>';
        $itemContent .= ($calloutAnimationOut['animation_out']==='' ? '<td> fade-out</td>' : '<td>'.$calloutAnimationOut['animation_out'].'</td>');
        $itemContent .= ($calloutClosable['is_closable']===1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
        $itemContent .= ($calloutContainer['container']===1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
        $itemContent .= '</tr>';
        $itemContent .= '</tbody>';
        $itemContent .= '</table>';
        $drawItem = false;
    }
  }
}