<?php

function debug($variable)
{
    echo '<pre>' . print_r($variable, true) . '</pre>';
    
}

function getColumnNames($tableName)
{
    $sql="SELECT
    COLUMN_NAME
FROM
    INFORMATION_SCHEMA.COLUMNS
WHERE
    TABLE_NAME = ? ORDER BY ORDINAL_POSITION" ;

            $db = config::getConnexion();
            try {
                $query=$db->prepare($sql);
                $query->execute([$tableName]);

                $nameList=$query->fetch();
                return $nameList;
            } catch (Exception $e) {
                die('Erreur: '.$e->getMessage());
            }
}