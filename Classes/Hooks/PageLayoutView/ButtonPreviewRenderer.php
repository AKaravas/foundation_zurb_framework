<?php
namespace Vendor\FoundationZurbFramework\Hooks\PageLayoutView;

use \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use \TYPO3\CMS\Backend\View\PageLayoutView;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Core\Database\ConnectionPool;

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


    if ($row['CType'] === 'foundation_button') {

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('foundation_zurb_button');
        $buttonSettings = $queryBuilder
          ->select('position', 'container', 'clear', 'disabled', 'hollow', 'color', 'size', 'title', 'link')
          ->from('foundation_zurb_button')
          ->where( 
            $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['button_content_relation'],\PDO::PARAM_INT)),
            $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
            $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchAll();
        $headerContent = '<strong class="foundation_title">' . $parentObject->CType_labels[$row['CType']] . '</strong>';
        $itemContent .= '<table class="foundation_table one_table">';
        $itemContent .= '<tbody>';
        $itemContent .= '<tr><th>Size</th><th>Color</th><th>Hollow</th><th>Clear</th><th>Disabled</th></tr>';
        $itemContent .= '<tr>';
        $itemContent .= '<td> '. $buttonSettings[0]['size'] .'</td>';
        $itemContent .= '<td> '. $buttonColor .'</td>';
        $itemContent .= ($buttonSettings[0]['hollow'] ===1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
        $itemContent .= ($buttonSettings[0]['clear'] ===1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
        $itemContent .= ($buttonSettings[0]['disabled'] ===1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
        $itemContent .= '</tr>';
        $itemContent .= '</tbody>';
        $itemContent .= '</table>';
        $itemContent .= '<strong class="foundation_subtitle">Advanced</strong>';
        $itemContent .= '<table class="foundation_table">';
        $itemContent .= '<tbody>';
        $itemContent .= '<tr><th>Container</th><th>Align</th>';
        $itemContent .= '<tr>';
        $itemContent .= ($buttonSettings[0]['container'] ===1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
        $itemContent .= ($buttonSettings[0]['container'] !=1 ? '<td>Container not active</td>' : ($buttonSettings[0]['position'] === '' ? '<td> align-left</td>' : '<td>'.$buttonAlignment .'</td>'));
        $itemContent .= '</tr>';
        $itemContent .= '</tbody>';
        $itemContent .= '</table>';
        $itemContent .= '<strong class="foundation_subtitle">Content</strong>';
        $itemContent .= '<table class="foundation_table content_table">';
        $itemContent .= '<tbody>';
         $itemContent .= '<tr><th>Title</th><th>Link</th></tr>';
          $itemContent .= '<tr>';
        $itemContent .= '<td> '. $buttonSettings[0]['title'] .'</td>';
        $itemContent .= '<td> '. $buttonSettings[0]['link'] .'</td>';
         $itemContent .= '</tr>';
        $itemContent .= '</tbody>';
        $itemContent .= '</table>';
        $drawItem = false;
    }
  }
}