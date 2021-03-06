<?php

/**
 * Description of Agentes
 *
 * @author Equipe MINC
 */
class TbEscolaridade extends MinC_Db_Table_Abstract {

    protected $_banco = 'Agentes';
    protected $_name = 'tbEscolaridade';
    protected $_schema  = 'agentes';


    public function BuscarEscolaridades($idAgente)
    {
        $select = $this->select();
        $select->setIntegrityCheck(false);

        $select->from(array('E'=>$this->_name),
        			  array('*','CONVERT(CHAR(10), dtInicioCurso, 103) as dtInicio',
        			  			'CONVERT(CHAR(10), dtFimCurso, 103) as dtFim'),'agentes'
        );

        $select->joinInner(
                array('TE'=>'tbTipoEscolaridade'),'TE.idTipoEscolaridade = E.idTipoEscolaridade',
                array('nmEscolaridade'),'agentes'
        );

        $select->joinInner(
                array('P'=>'Pais'),'P.idPais = E.idPais',
                array('Descricao as pais'),'agentes'
        );

        $select->joinLeft(
                array('D'=>'tbDocumento'),'D.idDocumento = E.idDocumento',
                array('*'),'bdcorporativo.scCorp'
        );

        $select->joinLeft(
                array('TA'=>'tbArquivo'),'TA.idArquivo = D.idArquivo',
                array('*'),'bdcorporativo.scCorp'
        );

        $select->joinLeft(
                array('TAI'=>'tbArquivoImagem'),'TAI.idArquivo = TA.idArquivo',
                array('*'),'bdcorporativo.scCorp'
        );

        $select->where('E.idAgente = ?', $idAgente);

        $select->order('E.idTipoEscolaridade');

        return $this->fetchAll($select);

    }


    public function BuscarTipoEscolaridade()
    {
        $select = $this->select();
        $select->setIntegrityCheck(false);
        $select->from(
                array('E'=> 'tbTipoEscolaridade'),
                array('*')
        );

        $select->order('E.idTipoEscolaridade');

        return $this->fetchAll($select);

    }

    public function BuscarPais()
    {
        $select = $this->select();
        $select->setIntegrityCheck(false);
        $select->from(
                array('P'=> 'Pais'),
                array('*')
        );

        $select->order('P.Descricao');

        return $this->fetchAll($select);

    }

    public function BuscarTipoDocumento()
    {
        $select = $this->select();
        $select->setIntegrityCheck(false);
        $select->from(
                array('TP'=> 'tbTipoDocumento'),
                array('idTipoDocumento', 'dsTipoDocumento'),'bdcorporativo.scCorp'
        );

        $select->order('TP.dsTipoDocumento');

        return $this->fetchAll($select);

    }




    public function inserirEscolaridade($dados) {
        $insert = $this->insert($dados);
        return $insert;
    }



}
