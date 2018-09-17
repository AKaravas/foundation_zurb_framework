<?php
namespace Vendor\FoundationZurbFramework\Hooks\PageLayoutView;

use \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use \TYPO3\CMS\Backend\View\PageLayoutView;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Core\Database\ConnectionPool;

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



    if ($row['CType'] === 'foundation_tabs') {

      $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('foundation_zurb_tabssettings');
      $tabsSettings = $queryBuilder
        ->select('deep_linking', 'collapse_tabs', 'vertical_tabs')
        ->from('foundation_zurb_tabssettings')
        ->where( 
          $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['tabs_settings_relation'],\PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
      )
      ->execute()
      ->fetchAll();

      $headerContent = '<strong class="foundation_title">' . $parentObject->CType_labels[$row['CType']] . '</strong>';
      $itemContent .= '<table class="foundation_table">';
      $itemContent .= '<tbody>';
      $itemContent .= ($tabsSettings[0]['vertical_tabs'] ===1 ? '<tr><th>Vertical Tabs</th> <td> &#10004;</td></tr>' : '<tr><th>Vertical Tabs</th> <td> &#10008;</td></tr>');
      $itemContent .= ($tabsSettings[0]['collapse_tabs'] ===1 ? '<tr><th>Collapsed tabs</th> <td> &#10004;</td></tr>' : '<tr><th>Collapsed tabs</th> <td> &#10008;</td></tr>');
      $itemContent .= ($tabsSettings[0]['deep_linking'] ===1 ? '<tr><th>Deep linking</th> <td> &#10004;</td></tr>' : '<tr><th>Deep linking</th> <td> &#10008;</td></tr>');
      $itemContent .= '</tbody>';
        $itemContent .= '</table>';
        $drawItem = false;
    }
  }
}