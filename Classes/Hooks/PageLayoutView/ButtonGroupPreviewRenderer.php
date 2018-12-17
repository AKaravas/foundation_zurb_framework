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
      if ($row['CType'] === 'foundation_group_button') {

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('foundation_zurb_buttongroupsettings');
        $groupButtonSettings = $queryBuilder
          ->select('position', 'container', 'expanded', 'stacked', 'color', 'size', 'uid')
          ->from('foundation_zurb_buttongroupsettings')
          ->where( 
            $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['buttongroup_settings_relation'],\PDO::PARAM_INT)),
            $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
            $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchAll();

        $queryBuilderContent = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('foundation_zurb_buttongroupcontent');
        $buttonGroupContent = $queryBuilderContent 
        ->select('title', 'link', 'uid', 'color', 'hollow', 'clear', 'disabled' )
        ->from('foundation_zurb_buttongroupcontent')
        ->where(
          $queryBuilderContent->expr()->eq('foundation_zurb_buttongroupsettings',  $queryBuilderContent->createNamedParameter($groupButtonSettings[0]['uid'], \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchAll();


        $headerContent = '<strong class="foundation_title">' . $parentObject->CType_labels[$row['CType']] . '</strong>';
        $itemContent .= '<table class="foundation_table one_table">';
        $itemContent .= '<tbody>';
        $itemContent .= '<tr><th>Size</th><th>Color</th><th>Stacked</th></tr>';
        $itemContent .= '<tr>';
        $itemContent .= ($groupButtonSettings[0]['size'] ==='' ? '<td> Normal</td>' : '<td>'.$groupButtonSettings[0]['size'].'</td>');
        $itemContent .= '<td>'.$groupButtonSettings[0]['color'].'</td>';
        $itemContent .= ($groupButtonSettings[0]['expanded'] ==='' ? '<td>'.$groupButtonSettings[0]['expanded'].'</td>' : '<td> &#10008;</td>');
        $itemContent .= '</tr>';
        $itemContent .= '</tbody>';
        $itemContent .= '</table>';
        $itemContent .= '<strong class="foundation_subtitle">Advanced</strong>';
        $itemContent .= '<table class="foundation_table">';
        $itemContent .= '<tbody>';
        $itemContent .= '<tr><th>Container</th><th>Align</th>';
        $itemContent .= '<tr>';
        $itemContent .= ($groupButtonSettings[0]['container'] ===1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
        $itemContent .= ($groupButtonSettings[0]['container'] !=1 ? '<td>Container not active</td>' : ($groupButtonSettings[0]['position'] === '' ? '<td> align-left</td>' : '<td>'.$groupButtonSettings[0]['position'].'</td>'));
        $itemContent .= '</tr>';
        $itemContent .= '</tbody>';
        $itemContent .= '</table>';
        $itemContent .= '<strong class="foundation_subtitle">Content</strong>';
        $itemContent .= '<table class="foundation_table content_table">';
          $itemContent .= '<tbody>';
          $itemContent .= '<tr><th class="listing"></th><th class="secondaryStyle">Title</th><th class="secondaryStyle">Link</th><th class="secondaryStyle">Color</th><th class="secondaryStyle">Hollow</th><th class="secondaryStyle">Clear</th><th class="secondaryStyle">Disabled</th></tr>';
          $listNumber = 0;
          foreach ($buttonGroupContent as $bgContent) {
            $listNumber++;
            $itemContent .= 
              '<tr>
                <td>'.$listNumber .'.</td>
                <td>'.substr($bgContent['title'], 0, 50) .'</td>
                <td>'.$bgContent['link'].'</td>
                <td>'.($groupButtonSettings[0]['color'] === 'undefined' ? $bgContent['color'] : 'Defined on parent').'</td>
                <td>'.($bgContent['hollow'] ===1 ? '&#10004;' : '&#10008').'</td>
                <td>'.($bgContent['clear'] ===1 ? '&#10004;' : '&#10008').'</td>
                <td>'.($bgContent['disabled'] ===1 ? '&#10004;' : '&#10008').'</td>
              </tr>';
          }
          $itemContent .= '</tbody>';
        $itemContent .= '</table>';
        $drawItem = false;
    }
  }
}