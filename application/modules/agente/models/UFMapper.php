<?php

class Agente_Model_UFMapper extends MinC_Db_Mapper
{
    public function __construct()
    {
        parent::setDbTable('Agente_Model_DbTable_UF');
    }
}