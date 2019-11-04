<?php


namespace Karavas\FoundationZurbFramework\Helper;


use phpDocumentor\Reflection\Types\String_;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\LinkHandling\LinkService;
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
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('pages');
        $getQuery = $queryBuilder
            ->select('*')
            ->from('pages')
            ->where(
                $queryBuilder->expr()->eq('uid', $queryBuilder->createNamedParameter($uid,\PDO::PARAM_INT)),
                $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
                $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
            )
            ->execute()
            ->fetchAll();

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
            $link = $pageConf[0][0]['title'];
            $pageIcon = $pageConf['icon'];
            $fullLink = '<td>' . $pageIcon. ' '. substr($link, 0, $cropText) . '</td>';
        }
        else
        {
            $fullLink = '<td>' . substr($link, 0, $cropText) . '</td>';
        }
        return $fullLink;
    }
}