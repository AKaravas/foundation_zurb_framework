<?php
namespace Vendor\FoundationZurbFramework\Hooks\PageLayoutView;

use \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use \TYPO3\CMS\Backend\View\PageLayoutView;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Core\Database\ConnectionPool;

/**
 * Contains a preview rendering for the page module of CType="foundation_reveal"
 */
class DropdownPreviewRenderer implements PageLayoutViewDrawItemHookInterface
{

   /**
    * Preprocesses the preview rendering of a content element of type "Foundation Modal/Reveal"
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

    $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('foundation_zurb_dropdowncontent');
    $dropDownInfos = $queryBuilder
           ->select('*')
           ->from('foundation_zurb_dropdowncontent')
           ->where(
               $queryBuilder->expr()->eq('tt_content', $queryBuilder->createNamedParameter($row['uid'], \PDO::PARAM_INT)),
               $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
               $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
           )
           ->execute();
    if ($row['CType'] === 'foundation_dropdown') {
      
      $headerContent = '<strong class="foundation_title">' . $parentObject->CType_labels[$row['CType']] . '</strong>';
      $itemContent .= '<table class="foundation_table one_table">';
      $itemContent .= '<tbody>';
      $itemContent .= '<tr><th>Title</th><th>Position</th><th>Aligment</th><th>Hover</th></tr>';
      foreach ($dropDownInfos as $dropdown) {
        $itemContent .= '<tr>';
        $itemContent .= '<td>'.$dropdown['title'].'</td>';
        $itemContent .= '<td>'.$dropdown['position'].'</td>';
        $itemContent .= '<td>'.$dropdown['alignment'].'</td>';
        $itemContent .= '<td>'.($dropdown['hover']===1 ? '&#10004; </td>' : '&#10008; </td>');
        $itemContent .= '</tr>';
      }
      $itemContent .= '</tbody>';
      $itemContent .= '</table>';
      $drawItem = false;
    }
  }
}