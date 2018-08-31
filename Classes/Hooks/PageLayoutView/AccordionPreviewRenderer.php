<?php
namespace Vendor\FoundationZurbFramework\Hooks\PageLayoutView;

use \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use \TYPO3\CMS\Backend\View\PageLayoutView;

/**
 * Contains a preview rendering for the page module of CType="foundation_accordion"
 */
class AccordionPreviewRenderer implements PageLayoutViewDrawItemHookInterface
{

   /**
    * Preprocesses the preview rendering of a content element of type "Foundation Accordion"
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

    $accordionSpeed = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_accordionsettings', $row['accordion_settings_relation'], 'accordion_speed');
    $accordionMultiexpand = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_accordionsettings', $row['accordion_settings_relation'], 'accordion_multiexpand');
    $accordionAllClosed = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_accordionsettings', $row['accordion_settings_relation'], 'accordion_all_closed');
    $accordionDisabled = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('foundation_zurb_accordionsettings', $row['accordion_settings_relation'], 'accordion_disabled');

    if ($row['CType'] === 'foundation_accordion') {
      $headerContent = '<strong class="foundation_title">' . $parentObject->CType_labels[$row['CType']] . '</strong>';
      $itemContent .= '<table class="foundation_table">';
      $itemContent .= '<tbody>';
      $itemContent .= '<tr><th>Accordion speed </th> <td>' . $accordionSpeed['accordion_speed'] . '</td></tr>';
      $itemContent .= ($accordionMultiexpand['accordion_multiexpand']===1 ? '<tr><th>Accordion multiexpand</th> <td> &#10004;</td></tr>' : '<tr><th>Accordion multiexpand</th> <td> &#10008;</td></tr>');
      $itemContent .= ($accordionAllClosed['accordion_all_closed']===1 ? '<tr><th>Accordion all closed</th> <td> &#10004;</td></tr>' : '<tr><th>Accordion all closed</th> <td> &#10008;</td></tr>');
      $itemContent .= ($accordionDisabled['accordion_disabled']===1 ? '<tr><th>Accordion disabled</th> <td> &#10004;</td></tr>' : '<tr><th>Accordion disabled</th> <td> &#10008;</td></tr>');
      $itemContent .= '</tbody>';
      $itemContent .= '</table>';
      $drawItem = false;
    }
  }
}