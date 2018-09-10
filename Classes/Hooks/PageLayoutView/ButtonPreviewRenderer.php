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

    $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('foundation_zurb_button');
    $buttonTitle = $queryBuilder
        ->select('title')
        ->from('foundation_zurb_button')
        ->where( 
          $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['button_content_relation'],\PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchColumn(0);
    $buttonSize = $queryBuilder
        ->select('size')
        ->from('foundation_zurb_button')
        ->where( 
          $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['button_content_relation'],\PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchColumn(0);
    $buttonColor = $queryBuilder
        ->select('color')
        ->from('foundation_zurb_button')
        ->where( 
          $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['button_content_relation'],\PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchColumn(0);
    $buttonHollow = $queryBuilder
        ->select('hollow')
        ->from('foundation_zurb_button')
        ->where( 
          $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['button_content_relation'],\PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchColumn(0);
    $buttonDisabled = $queryBuilder
        ->select('disabled')
        ->from('foundation_zurb_button')
        ->where( 
          $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['button_content_relation'],\PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchColumn(0);
    $buttonClear = $queryBuilder
        ->select('clear')
        ->from('foundation_zurb_button')
        ->where( 
          $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['button_content_relation'],\PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchColumn(0);
    $buttonContainer = $queryBuilder
        ->select('container')
        ->from('foundation_zurb_button')
        ->where( 
          $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['button_content_relation'],\PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchColumn(0);
    $buttonAlignment = $queryBuilder
        ->select('position')
        ->from('foundation_zurb_button')
        ->where( 
          $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['button_content_relation'],\PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchColumn(0);

    if ($row['CType'] === 'foundation_button') {
        $headerContent = '<strong class="foundation_title">' . $parentObject->CType_labels[$row['CType']] . '</strong>';
        $itemContent .= '<table class="foundation_table one_table">';
        $itemContent .= '<tbody>';
        $itemContent .= '<tr><th>Title</th><th>Size</th><th>Color</th><th>Hollow</th><th>Clear</th><th>Disabled</th></tr>';
        $itemContent .= '<tr>';
        $itemContent .= '<td> '. $buttonTitle .'</td>';
        $itemContent .= '<td> '. $buttonSize .'</td>';
        $itemContent .= '<td> '. $buttonColor .'</td>';
        $itemContent .= ($buttonHollow ===1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
        $itemContent .= ($buttonClear ===1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
        $itemContent .= ($buttonDisabled ===1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
        $itemContent .= '</tr>';
        $itemContent .= '</tbody>';
        $itemContent .= '</table>';
        $itemContent .= '<strong class="foundation_subtitle">Advanced</strong>';
        $itemContent .= '<table class="foundation_table">';
        $itemContent .= '<tbody>';
        $itemContent .= '<tr><th>Container</th><th>Align</th>';
        $itemContent .= '<tr>';
        $itemContent .= ($buttonContainer ===1 ? '<td> &#10004;</td>' : '<td> &#10008;</td>');
        $itemContent .= ($buttonContainer !=1 ? '<td>Container not active</td>' : ($buttonAlignment === '' ? '<td> align-left</td>' : '<td>'.$buttonAlignment .'</td>'));
        $itemContent .= '</tr>';
        $itemContent .= '</tbody>';
        $itemContent .= '</table>';
        $drawItem = false;
    }
  }
}