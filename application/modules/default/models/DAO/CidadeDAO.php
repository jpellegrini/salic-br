<?php
/**
 * Modelo Cidade
 * @author Equipe RUP - Politec
 * @since 29/03/2010
 * @version 1.0
 * @package application
 * @subpackage application.models
 * @copyright � 2010 - Minist�rio da Cultura - Todos os direitos reservados.
 * @link http://www.cultura.gov.br
 */

class CidadeDAO extends Zend_Db_Table
{
	protected $_name = 'agentes.dbo.Municipios'; // nome da tabela



	/**
	 * M�todo para buscar as cidades de um determinado estado
	 * @access public
	 * @param integer $idUF
	 * @return object $db->fetchAll($sql)
     * @todo utilizar o metoddo listar em Agente_Model_DbTable_Municipios
     * @deprecated  utilizar o metodo listar em Agente_Model_DbTable_Municipios
	 */
	public static function buscar($idUF, $idCidade = null)
	{
		$sql = "SELECT idMunicipioIBGE AS id, Descricao AS descricao ";
		$sql.= "FROM agentes.dbo.Municipios ";
		$sql.= "WHERE idUFIBGE = " . $idUF . " ";

		if (!empty($idCidade))
		{
			$sql.= " AND idMunicipioIBGE = " .$idCidade. "";
		}

		$sql.= "ORDER BY Descricao";

		try
		{
			$db = Zend_Db_Table::getDefaultAdapter();
			$db->setFetchMode(Zend_DB::FETCH_OBJ);
		}
		catch (Zend_Exception_Db $e)
		{
			$this->view->message = "Erro ao buscar Cidades: " . $e->getMessage();
		}
		throw new Exception('M&eacute;todo Transferido para Agente Model DbTable Municipios');
		
		return $db->fetchAll($sql);
	} // fecha buscar()
} // fecha class