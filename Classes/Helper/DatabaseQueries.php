<?php


namespace Karavas\FoundationZurbFramework\Helper;


use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class DatabaseQueries
{
    /**
     *
     * Gives back an array with entries defined by fields or '*'
     *
     * @var string $table
     * @var integer $comparedValue
     * @var string $comparedField
     * @var array $fields
     * @return array $getQuery
     * */
    public static function getTableInfosByUid($table, $comparedValue, $comparedField, $fields = null) : array
    {

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable($table);
        if ($fields)
        {
            $getQuery = $queryBuilder
                ->select(...$fields)
                ->from($table)
                ->where(
                    $queryBuilder->expr()->eq($comparedField, $queryBuilder->createNamedParameter($comparedValue,\PDO::PARAM_INT)),
                    $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
                    $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
                )
                ->execute()
                ->fetchAll();
        }
        else {
            $getQuery = $queryBuilder
                ->select('*')
                ->from($table)
                ->where(
                    $queryBuilder->expr()->eq($comparedField, $queryBuilder->createNamedParameter($comparedValue,\PDO::PARAM_INT)),
                    $queryBuilder->expr()->eq('hidden', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT)),
                    $queryBuilder->expr()->eq('deleted', $queryBuilder->createNamedParameter(0, \PDO::PARAM_INT))
                )
                ->execute()
                ->fetchAll();
        }
        return $getQuery;
    }
}