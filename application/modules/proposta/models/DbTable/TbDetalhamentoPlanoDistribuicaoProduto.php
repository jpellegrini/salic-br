<?php

/**
 *
 *
 */
class Proposta_Model_DbTable_TbDetalhamentoPlanoDistribuicaoProduto extends MinC_Db_Table_Abstract
{
    /**
     * _schema
     *
     * @var string
     * @access protected
     */
    protected $_schema = 'sac';

    /**
     * _name
     *
     * @var bool
     * @access protected
     */
    protected $_name = 'tbDetalhaPlanoDistribuicao';

    public function salvar($dados)
    {
        return $this->insert($dados);
    }

    public function listarPorMunicicipioUF($dados)
    {
        $cols = array(
            'idDetalhaPlanoDistribuicao',
            'idPlanoDistribuicao',
            'idUF' ,
            'idMunicipio' ,
            'stDistribuicao' ,
            'dsProduto' ,
            'qtExemplares' ,
            'qtGratuitaDivulgacao' ,
            'qtGratuitaPatrocinador' ,
            'qtGratuitaPopulacao' ,
            'qtPopularIntegral' ,
            'qtPopularParcial' ,
            "FORMAT(vlUnitarioPopularIntegral, 'N') as vlUnitarioPopularIntegral",
            "FORMAT(vlReceitaPopularIntegral, 'N') as vlReceitaPopularIntegral",
            "FORMAT(vlReceitaPopularParcial, 'N') as vlReceitaPopularParcial",
            'qtProponenteIntegral' ,
            'qtProponenteParcial' ,
            "FORMAT(vlUnitarioProponenteIntegral, 'N') as  vlUnitarioProponenteIntegral",
            "FORMAT(vlReceitaProponenteIntegral, 'N') as vlReceitaProponenteIntegral",
            "FORMAT(vlReceitaProponenteParcial, 'N') as vlReceitaProponenteParcial",
            "FORMAT(vlReceitaPrevista, 'N') as vlReceitaPrevista"
        );

        $sql = $this->select()
            ->from($this->_name, $cols, $this->_schema)
            ->where(' idUF= ?', $dados['idUF'])
            ->where(' idMunicipio= ?', $dados['idMunicipio'])
            ->where('idPlanoDistribuicao = ?', $dados['idPlanoDistribuicao']);

        return $this->fetchAll($sql);
    }

    public function excluir($id)
    {
        return $this->delete("idDetalhaPlanoDistribuicao =  $id");
    }

    public function excluirByIdPreProjeto($idPreProjeto, $where = array(), $order = null)
    {
        $slct = $this->select();
        $slct->setIntegrityCheck(false);
        $slct->from(array("d" => $this->_name) , array('d.idDetalhaPlanoDistribuicao'), $this->_schema);

        $slct->joinInner(array("p" => 'planodistribuicaoproduto'),
            "p.idPlanoDistribuicao = d.idPlanoDistribuicao",
            array(), $this->_schema);

        $slct->where('p.idProjeto = ?', $idPreProjeto);

        foreach ($where as $coluna => $valor) {
            $slct->where($coluna, $valor);
        }

        $slct->order($order);

        $this->delete(new Zend_Db_Expr('idDetalhaPlanoDistribuicao in (' . $slct .')'));

    }
}
