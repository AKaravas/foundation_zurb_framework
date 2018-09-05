<?php
namespace Vendor\FoundationZurbFramework\Hooks\PageLayoutView;

use \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use \TYPO3\CMS\Backend\View\PageLayoutView;

/**
 * Contains a preview rendering for the page module of CType="foundation_card"
 */
class ButtonPreviewRenderer implements PageLayoutViewDrawItemHookInterface
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

    $buttonTitle = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_button', $row['button_content_relation'], 'title');
    $buttonSize = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_button', $row['button_content_relation'], 'size');
    $buttonColor = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_button', $row['button_content_relation'], 'color');
    $buttonHollow = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_button', $row['button_content_relation'], 'hollow');
    $buttonDisabled = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_button', $row['button_content_relation'], 'disabled');
    $buttonHollow = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_button', $row['button_content_relation'], 'hollow');
    $buttonClear = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_button', $row['button_content_relation'], 'clear');
    $buttonContainer = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_button', $row['button_content_relation'], 'container');
    $buttonAlignment = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_button', $row['button_content_relation'], 'position');

      if ($row['CType'] === 'foundation_button') {
        $headerContent = '<strong class="foundation_title">' . $parentObject->CType_labels[$row['CType']] . '</strong>';
        $itemContent .= '<table class="foundation_table one_table">';
        $itemContent .= '<tbody>';
        $itemContent .= '<tr><th>Title</th><th>Size</th><th>Color</th><th>Hollow</th><th>Clear</th><th>Disabled</th></tr>';
        $itemContent .= '<tr>';
        $itemContent .= '<td> '. $buttonTitle['title'] .'</td>';
        $itemContent .= '<td> '. $buttonSize['size'] .'</td>';
        $itemContent .= '<td> '. $buttonColor['color'] .'</td>';
        $itemContent .= ($buttonHollow['hollow']===1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
        $itemContent .= ($buttonClear['clear']===1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
        $itemContent .= ($buttonDisabled['disabled']===1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
        $itemContent .= '</tr>';
        $itemContent .= '</tbody>';
        $itemContent .= '</table>';
        $itemContent .= '<strong class="foundation_subtitle">Advanced</strong>';
        $itemContent .= '<table class="foundation_table">';
        $itemContent .= '<tbody>';
        $itemContent .= '<tr><th>Container</th><th>Align</th>';
        $itemContent .= '<tr>';
        $itemContent .= ($buttonContainer['container']===1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
        $itemContent .= ($buttonContainer['container']!=1 ? '<td>Container not active</td>' : ($buttonAlignment['position']=== '' ? '<td> align-left</td>' : '<td>'.$buttonAlignment['position'].'</td>'));
        $itemContent .= '</tr>';
        $itemContent .= '</tbody>';
        $itemContent .= '</table>';
        $drawItem = false;
    }
  }
}