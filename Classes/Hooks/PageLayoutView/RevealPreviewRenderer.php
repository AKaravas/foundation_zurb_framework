<?php
namespace Vendor\FoundationZurbFramework\Hooks\PageLayoutView;

use \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use \TYPO3\CMS\Backend\View\PageLayoutView;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Core\Database\ConnectionPool;

/**
 * Contains a preview rendering for the page module of CType="foundation_reveal"
 */
class RevealPreviewRenderer implements PageLayoutViewDrawItemHookInterface
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

    $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('foundation_zurb_revealcontent');
    $revealInfos = $queryBuilder
           ->select('*')
           ->from('foundation_zurb_revealcontent')
           ->where(
               $queryBuilder->expr()->eq('tt_content', $queryBuilder->createNamedParameter($row['uid'], \PDO::PARAM_INT)),
               $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
               $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
           )
           ->execute();

    if ($row['CType'] === 'foundation_reveal') {
      $headerContent = '<strong class="foundation_title">' . $parentObject->CType_labels[$row['CType']] . '</strong>';
      $itemContent .= '<table class="foundation_table one_table">';
      $itemContent .= '<tbody>';
      $itemContent .= '<tr><th>Title</th><th>Size</th><th>Dis. Overlay</th><th>Reset on close</th><th>Animation In</th><th>Animation out</th></tr>';
      foreach ($revealInfos as $reveal) {
        $itemContent .= '<tr>';
        $itemContent .= '<td>'.$reveal['title'].'</td>';
        $itemContent .= '<td>'.$reveal['size'].'</td>';
        $itemContent .= '<td>'.($reveal['no_overlay']===1 ? '&#10004; </td>' : '&#10008; </td>');
        $itemContent .= '<td>'.($reveal['reset_on_close']===1 ? '&#10004; </td>' : '&#10008; </td>');
        $itemContent .= '<td>'.$reveal['animation_in'].'</td>';
        $itemContent .= '<td>'.$reveal['animation_out'].'</td>';
        $itemContent .= '</tr>';
      }
      $itemContent .= '</tbody>';
      $itemContent .= '</table>';
      $drawItem = false;
    }
  }
}