<?php

/**
 * @name Agente_Model_TbMensagemProjetoMapper
 * @package Modules/Admissibilidade
 * @subpackage Models
 *
 * @author Ruy Junior Ferreira Silva <ruyjfs@gmail.com>
 * @since 01/09/2016
 *
 * @copyright © 2012 - Ministerio da Cultura - Todos os direitos reservados.
 * @link http://salic.cultura.gov.br
 */
class Admissibilidade_Model_TbMensagemProjetoMapper extends MinC_Db_Mapper
{

    public function __construct()
    {
        $this->setDbTable('Admissibilidade_Model_DbTable_TbMensagemProjeto');
    }

    public function isUniqueCpfCnpj($value)
    {
        return ($this->findBy(array("cnpjcpf" => $value))) ? true : false;
    }

    public function encaminhar($arrData)
    {
        $booStatus = false;
        if (!empty($arrData)) {
            unset($arrData['dsMensagem']);
            unset($arrData['IdPRONAC']);
            $model = new Admissibilidade_Model_TbMensagemProjeto($arrData);
            try {
                $auth = Zend_Auth::getInstance(); // pega a autenticacao
                $arrAuth = array_change_key_case((array) $auth->getIdentity());
                $model->setStAtivo(1);
                if ($intId = parent::save($model)) {
                    $booStatus = 1;
                    $this->setMessage('Mensagem encaminhada com sucesso!');
                } else {
                    $this->setMessage('Nao foi possivel encaminhar mensagem!');
                }
            } catch (Exception $e) {
                $this->setMessage($e->getMessage());
            }
        }
        return $booStatus;
    }

    public function responder($arrData)
    {
        $booStatus = false;
        if (!empty($arrData)) {
            $arrData['dsMensagem'] = $arrData['dsResposta'];
            $arrData['idMensagemOrigem'] = $arrData['idMensagemProjeto'];
            unset($arrData['idMensagemProjeto']);
            $model = new Admissibilidade_Model_TbMensagemProjeto($arrData);
            try {
                $auth = Zend_Auth::getInstance(); // pega a autenticacao
                $arrAuth = array_change_key_case((array) $auth->getIdentity());
                $model->setStAtivo(1);
                $model->setDtMensagem(date('Y-m-d h:i:s'));
                $model->setIdRemetente($arrAuth['usu_codigo']);
                $model->setCdTipoMensagem(1);
                $arrMensagemOrigem = $this->getDbTable()->findBy($arrData['idMensagemOrigem']);
                $model->setIdDestinatario($arrMensagemOrigem['idRemetente']);
                if ($intId = parent::save($model)) {
                    $booStatus = 1;
                    $this->setMessage('Pergunta respondida com sucesso!');
                } else {
                    $this->setMessage('Nao foi possivel respondida a pergunta!');
                }
            } catch (Exception $e) {
                $this->setMessage($e->getMessage());
            }
        }
        return $booStatus;
    }

    public function salvar($arrData)
    {
        $booStatus = false;
        if (!empty($arrData)) {
            $model = new Admissibilidade_Model_TbMensagemProjeto($arrData);
            try {
                $auth = Zend_Auth::getInstance(); // pega a autenticacao
                $arrAuth = array_change_key_case((array) $auth->getIdentity());
                $model->setDtMensagem(date('Y-m-d h:i:s'));
                $model->setIdRemetente($arrAuth['usu_codigo']);
//                $model->setIdDestinatario($arrAuth['usu_codigo']);
                $model->setCdTipoMensagem(1);
                $model->setStAtivo(1);
                if ($intId = parent::save($model)) {
                    $booStatus = 1;
                    $this->setMessage('Pergunta enviada com sucesso!');
                } else {
                    $this->setMessage('Nao foi possivel enviar mensagem!');
                }
            } catch (Exception $e) {
                $this->setMessage($e->getMessage());
            }
        }
        return $booStatus;
    }
}
