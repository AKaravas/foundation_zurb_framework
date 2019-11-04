<?php


namespace Karavas\FoundationZurbFramework\Helper;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\LinkHandling\LinkService;
use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class Helper
{
    /**
     * Gives back an array with the information of the selected page
     *
     * @var integer $uid
     * @return array $results
     * */
    public static function getPageInfo($uid) : array
    {
        $getQuery = DatabaseQueries::getTableInfosByUid('pages', $uid, 'uid', $fields = null);
        $iconFactory = GeneralUtility::makeInstance(IconFactory::class);

        $getIconForPage = $iconFactory->getIconForRecord('pages', $getQuery[0], Icon::SIZE_SMALL)->render();

        $results = [
            $getQuery,
            'icon' => $getIconForPage
        ];

        return $results;
    }

    /**
     * Gives back the page title as a string including the icon
     *
     * @var string $link
     * @var integer $cropText
     * @return string $fullLink
     * */
    public static function createLink($link, $cropText) : string
    {
        if (strpos($link, 't3://page?uid') !== false) {
            $resolveLink = GeneralUtility::makeInstance(LinkService::class);
            $getUrlDetails = $resolveLink->resolve($link);
            $pageConf = self::getPageInfo($getUrlDetails['pageuid']);
            $title= $pageConf[0][0]['title'];
            $pageIcon = $pageConf['icon'];
            $fullLink = '<td>' . $pageIcon. ' '. substr($title, 0, $cropText) . '</td>';
        }
        else
        {
            $fullLink = '<td>' . substr($link, 0, $cropText) . '</td>';
        }
        return $fullLink;
    }

    public static function getSliderImages($sliderImages) : array
    {
        $renderedImage = array();
        $sorting = array();
        $sorted = array();

        for ($i = 0; $i < count($sliderImages); $i++) {
            $fileRepository = GeneralUtility::makeInstance(FileRepository::class);
            $fileObjects = $fileRepository->findByRelation('foundation_zurb_slidercontent', 'image', $sliderImages[$i]['uid']);
            $imagesPath = $fileObjects[0]->getProperty('identifier');
            $basePath = substr($fileObjects[0]->getOriginalFile()->getStorage()->getConfiguration()['basePath'], 0,-1);
            $sorting[] = $sliderImages[$i]['sorting'];
            $buildImage = $basePath.$imagesPath;
            $finalImage = "<img src='../" . $buildImage . "'/>";
            $renderedImage[] = $finalImage;
        }
        array_push($sorted, $renderedImage, $sorting);
        $sortedCombined = array_map(null, ...$sorted);
        usort($sortedCombined, function ($a, $b) {
            return $a[1] <=> $b[1];
        });
        return $sortedCombined;
    }
}