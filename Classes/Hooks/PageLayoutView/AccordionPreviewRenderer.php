<?php
namespace Vendor\FoundationZurbFramework\Hooks\PageLayoutView;

use \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use \TYPO3\CMS\Backend\View\PageLayoutView;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Core\Database\ConnectionPool;

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

    if ($row['CType'] === 'foundation_accordion') {

      $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('foundation_zurb_accordionsettings');
        $accordionSettings = $queryBuilder
          ->select('accordion_disabled', 'accordion_all_closed', 'accordion_multiexpand', 'accordion_speed', 'uid')
          ->from('foundation_zurb_accordionsettings')
          ->where( 
            $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['accordion_settings_relation'],\PDO::PARAM_INT)),
            $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
            $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchAll();

        $queryBuilderContent = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('foundation_zurb_accordioncontent');
        $accordionContent = $queryBuilderContent 
        ->select('title', 'text', 'files', 'uid')
        ->from('foundation_zurb_accordioncontent')
        ->where(
          $queryBuilderContent->expr()->eq('foundation_zurb_accordionsettings',  $queryBuilderContent->createNamedParameter($accordionSettings[0]['uid'], \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchAll();


      $headerContent = '<strong class="foundation_title">' . $parentObject->CType_labels[$row['CType']] . '</strong>';
      $itemContent .= '<table class="foundation_table">';
      $itemContent .= '<tbody>';
      $itemContent .= '<tr><th>Accordion speed </th> <td>' . $accordionSettings[0]['accordion_speed'] . '</td></tr>';
      $itemContent .= ($accordionSettings[0]['accordion_multiexpand'] ===1 ? '<tr><th>Accordion multiexpand</th> <td> &#10004;</td></tr>' : '<tr><th>Accordion multiexpand</th> <td> &#10008;</td></tr>');
      $itemContent .= ($accordionSettings[0]['accordion_all_closed'] ===1 ? '<tr><th>Accordion all closed</th> <td> &#10004;</td></tr>' : '<tr><th>Accordion all closed</th> <td> &#10008;</td></tr>');
      $itemContent .= ($accordionSettings[0]['accordion_disabled'] ===1 ? '<tr><th>Accordion disabled</th> <td> &#10004;</td></tr>' : '<tr><th>Accordion disabled</th> <td> &#10008;</td></tr>');
      $itemContent .= '</tbody>';
      $itemContent .= '</table>';
      $itemContent .= '<strong class="foundation_subtitle">Content</strong>';
      $itemContent .= '<table class="foundation_table content_table">';
        $itemContent .= '<tbody>';
         $itemContent .= '<tr><th class="listing"></th><th class="secondaryStyle">Title</th><th class="secondaryStyle">Text</th><th class="secondaryStyle">Files</th></tr>';
          $listNumber = 0;
          foreach ($accordionContent as $accContent) {
            $listNumber++;
            if($accContent['files']==1) {
              $fileExist = 'File exists';
            }
            else {
              $fileExist = 'File does not exist';
            }
            $itemContent .= '<tr><td>'.$listNumber .'.</td><td>'.substr($accContent['title'], 0, 30) .'</td><td>'.substr($accContent['text'], 0, 30).'</td><td>'. $fileExist .'</td></tr>';
            }
        $itemContent .= '</tbody>';
      $itemContent .= '</table>';
      $drawItem = false;
    }
  }
}