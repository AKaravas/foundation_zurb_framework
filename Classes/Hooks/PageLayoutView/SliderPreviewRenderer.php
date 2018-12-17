<?php
namespace Vendor\FoundationZurbFramework\Hooks\PageLayoutView;

use \TYPO3\CMS\Backend\View\PageLayoutViewDrawItemHookInterface;
use \TYPO3\CMS\Backend\View\PageLayoutView;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Core\Database\ConnectionPool;
use \TYPO3\CMS\Core\Resource\FileReference;

/**
 * Contains a preview rendering for the page module of CType="foundation_slider"
 */
class SliderPreviewRenderer implements PageLayoutViewDrawItemHookInterface
{

   /**
    * Preprocesses the preview rendering of a content element of type "Foundation Slider"
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
    if ($row['CType'] === 'foundation_slider') {

      $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('foundation_zurb_slidersettings');
      $sliderSettings = $queryBuilder
        ->select('hide_arrows', 'uid', 'hide_bullets', 'auto_play', 'infinite_wrap', 'swipe', 'pause_on_hover', 'timer_delay', 'slide_direction_in_right', 'slide_direction_out_right', 'slide_direction_out_left', 'slide_direction_in_left', 'use_m_u_i', 'accessible_buttons')
        ->from('foundation_zurb_slidersettings')
        ->where( 
          $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($row['slider_settings_relation'],\PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
          $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchAll();

        $imageQueryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('foundation_zurb_slidercontent');
        $sliderImages = $imageQueryBuilder
        ->select('uid','sorting')
        ->from('foundation_zurb_slidercontent')
        ->where(
          $imageQueryBuilder->expr()->eq('foundation_zurb_slidersettings',  $imageQueryBuilder->createNamedParameter($sliderSettings[0]['uid'], \PDO::PARAM_INT)),
          $imageQueryBuilder->expr()->eq('hidden', $imageQueryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
          $imageQueryBuilder->expr()->eq('deleted', $imageQueryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
        )
        ->execute()
        ->fetchAll();
  

        $imagesPath = array();
        $basePath = array();
        $mergedArrays = array();
        $renderedImage = array();
        $sorting = array();
        $sortedItems = array();
        $sorted = array();

        for ($i=0; $i < count($sliderImages); $i++) { 
            $fileRepository = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Resource\FileRepository::class);
            $fileObjects = $fileRepository->findByRelation('foundation_zurb_slidercontent', 'image', $sliderImages[$i]['uid']);
            $imagesPath[] = $fileObjects[0]->getProperty('identifier');
            $basePath[] = $fileObjects[0]->getStorage()->getName();
            $sorting[] = $sliderImages[$i]['sorting'];

        }
        array_push($mergedArrays,$basePath,$imagesPath, $sorting);
        for ($a=0; $a < count($sliderImages); $a++) { 
          $sortedItems[] = $mergedArrays[2][$a];
          $imageComplete = $mergedArrays[0][$a].$mergedArrays[1][$a];
          $finalImage =  '<img src="../'. $imageComplete. '"/>';
          $renderedImage[] = $finalImage;
        }
        array_push($sorted,$renderedImage,$sortedItems);

        $sortedCombined = array_map(null, ...$sorted);

        usort($sortedCombined, function($a, $b) {
            return $a[1] <=> $b[1];
        });

        $headerContent = '<strong class="foundation_title">' . $parentObject->CType_labels[$row['CType']] . '</strong>';
        $itemContent .= '<table class="foundation_table">';
        $itemContent .= '<tbody>';
        $itemContent .= ($sliderSettings[0]['hide_arrows'] ===1 ? '<tr><th>Hide arrows</th> <td> &#10004;</td>' : '<tr><th>Hide arrows</th> <td> &#10008;</td>');
        $itemContent .= ($sliderSettings[0]['hide_bullets'] ===1 ? '<th>Hide bullets</th> <td> &#10004;</td></tr>' : '<th>Hide bullets</th> <td> &#10008;</td></tr>');
        $itemContent .= ($sliderSettings[0]['auto_play'] ===1 ? '<tr><th>Disable auto play</th> <td> &#10004;</td>' : '<tr><th>Disable auto play</th> <td> &#10008;</td>');
        $itemContent .= ($sliderSettings[0]['infinite_wrap'] ===1 ? '<th>Disable infinite wrap</th> <td> &#10004;</td></tr>' : '<th>Disable infinite wrap</th> <td> &#10008;</td></tr>');
        $itemContent .= ($sliderSettings[0]['swipe'] ===1 ? '<tr><th>Disable swipe</th> <td> &#10004;</td>' : '<tr><th>Disable swipe</th> <td> &#10008;</td>');
        $itemContent .= ($sliderSettings[0]['pause_on_hover'] ===1 ? '<th>Disable pause on hover</th> <td> &#10004;</td></tr>' : '<th>Disable pause on hover</th> <td> &#10008;</td></tr>');
        $itemContent .= ($sliderSettings[0]['accessible_buttons'] ===1 ? '<tr><th>Disable keyboard navigation</th> <td> &#10004;</td>' : '<tr><th>Disable keyboard navigation</th> <td> &#10008;</td>');
        $itemContent .= ($sliderSettings[0]['use_m_u_i'] ===1 ? '<th>Disable MUI</th> <td> &#10004;</td></tr>' : '<th>Disable MUI</th> <td> &#10008;</td></tr>');
        $itemContent .= '</tbody>';
        $itemContent .= '</table>';
        $itemContent .= '<strong class="foundation_subtitle">Animations</strong>';
        $itemContent .= '<table class="foundation_table">';
          $itemContent .= '<tbody>';
            $itemContent .= '<tr><th>Animation in left</th> <td> '.$sliderSettings[0]['slide_direction_in_left'].'</td>';
            $itemContent .= '<th>Animation out left</th> <td>'.$sliderSettings[0]['slide_direction_out_left'] .'</td></tr>';
            $itemContent .= '<tr><th>Animation in right</th> <td> '.$sliderSettings[0]['slide_direction_in_right'] .'</td>';
            $itemContent .= '<th>Animation out right</th> <td>'.$sliderSettings[0]['slide_direction_out_right'] .'</td></tr>';
          $itemContent .= '</tbody>';
        $itemContent .= '</table>';
        
        $itemContent .= '<strong class="foundation_subtitle">Timings</strong>';
        $itemContent .= '<table class="foundation_table">';
          $itemContent .= '<tbody>';
            $itemContent .= '<tr><th>Timer Delay in ms</th> <td> '.$sliderSettings[0]['timer_delay'] .'</td></tr>';
          $itemContent .= '</tbody>';
        $itemContent .= '</table>';
        $itemContent .= '<strong class="foundation_subtitle">Images</strong>';
        $itemContent .= '<table class="foundation_table">';
          $itemContent .= '<tbody>';
           $itemContent .= '<tr>';
           $searchText=" (auto-created)";
          foreach ($sortedCombined as $imaged) {  
            $itemContent .= '<td>'. str_replace($searchText, '', $imaged[0]) .'</td>';
          }
          $itemContent .= '</tr>';
          $itemContent .= '</tbody>';
        $itemContent .= '</table>';
        $drawItem = false;
     }
   }
}