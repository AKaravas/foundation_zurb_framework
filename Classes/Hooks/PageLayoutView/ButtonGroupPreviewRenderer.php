<?php
namespace Vendor\FoundationZurbFramework\Hooks\PageLayoutView;

use \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use \TYPO3\CMS\Backend\View\PageLayoutView;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Core\Database\ConnectionPool;

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
    $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('foundation_zurb_buttongroupsettings');
    $buttonGroupSize = $queryBuilder
            ->select('size')
            ->from('foundation_zurb_buttongroupsettings')
            ->where( 
              $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['buttongroup_settings_relation'],\PDO::PARAM_INT)),
              $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
              $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
           )
           ->execute()
           ->fetchColumn(0);
      $buttonGroupColor = $queryBuilder
            ->select('color')
            ->from('foundation_zurb_buttongroupsettings')
            ->where( 
              $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['buttongroup_settings_relation'],\PDO::PARAM_INT)),
              $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
              $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
           )
           ->execute()
           ->fetchColumn(0);
      $buttonGroupStacked = $queryBuilder
            ->select('stacked')
            ->from('foundation_zurb_buttongroupsettings')
            ->where( 
              $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['buttongroup_settings_relation'],\PDO::PARAM_INT)),
              $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
              $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
           )
           ->execute()
           ->fetchColumn(0);
      $buttonGroupExpanded = $queryBuilder
            ->select('expanded')
            ->from('foundation_zurb_buttongroupsettings')
            ->where( 
              $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['buttongroup_settings_relation'],\PDO::PARAM_INT)),
              $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
              $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
           )
           ->execute()
           ->fetchColumn(0);
      $buttonGroupContainer = $queryBuilder
            ->select('container')
            ->from('foundation_zurb_buttongroupsettings')
            ->where( 
              $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['buttongroup_settings_relation'],\PDO::PARAM_INT)),
              $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
              $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
           )
           ->execute()
           ->fetchColumn(0);
      $buttonGroupAlignment = $queryBuilder
            ->select('position')
            ->from('foundation_zurb_buttongroupsettings')
            ->where( 
              $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['buttongroup_settings_relation'],\PDO::PARAM_INT)),
              $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
              $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
           )
           ->execute()
           ->fetchColumn(0);

      if ($row['CType'] === 'foundation_group_button') {
        $headerContent = '<strong class="foundation_title">' . $parentObject->CType_labels[$row['CType']] . '</strong>';
        $itemContent .= '<table class="foundation_table one_table">';
        $itemContent .= '<tbody>';
        $itemContent .= '<tr><th>Size</th><th>Color</th><th>Stacked</th></tr>';
        $itemContent .= '<tr>';
        $itemContent .= ($buttonGroupSize ==='' ? '<td> Normal</td>' : '<td>'.$buttonGroupSize.'</td>');
        $itemContent .= ($buttonGroupColor ==='' ? '<td> Normal</td>' : '<td>'.$buttonGroupColor.'</td>');
        $itemContent .= ($buttonGroupExpanded ==='' ? '<td>'.$buttonGroupExpanded.'</td>' : '<td> &#10008;</td>');
        $itemContent .= '</tr>';
        $itemContent .= '</tbody>';
        $itemContent .= '</table>';
        $itemContent .= '<strong class="foundation_subtitle">Advanced</strong>';
        $itemContent .= '<table class="foundation_table">';
        $itemContent .= '<tbody>';
        $itemContent .= '<tr><th>Container</th><th>Align</th>';
        $itemContent .= '<tr>';
        $itemContent .= ($buttonGroupContainer ===1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
        $itemContent .= ($buttonGroupContainer !=1 ? '<td>Container not active</td>' : ($buttonGroupAlignment === '' ? '<td> align-left</td>' : '<td>'.$buttonGroupAlignment.'</td>'));
        $itemContent .= '</tr>';
        $itemContent .= '</tbody>';
        $itemContent .= '</table>';
        $drawItem = false;
    }
  }
}