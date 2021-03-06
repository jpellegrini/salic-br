<?php
/**
 * Nomes dos status da comprova&ccedil;&atilde;o f&iacute;sica do projeto
 * @author Equipe RUP - Politec
 * @since 14/05/2010
 * @version 1.0
 * @package application
 * @subpackage application.views.helpers
 * @copyright © 2010 - Minist&eacute;rio da Cultura - Todos os direitos reservados.
 * @link http://www.cultura.gov.br
 */

class Zend_View_Helper_TipoDocumento
{
	/**
	 * M&eacute;todo com os status dos comprovantes de status do projeto
	 * @access public
	 * @param string $status
	 * @return string $nomeStatus
	 */
	function tipoDocumento($status)
	{
		switch ($status){
                    case 1:
                        $status = 'Boleto Banc&aacute;rio';
                        break;
                    case 2:
                        $status = 'Cupom Fiscal';
                        break;
                    case 3:
                        $status = 'Nota fiscal/Fatura';
                        break;
                    case 4:
                        $status = 'Recibo de Pagamento Autônomo';
                        break;
                    default:
                        $status = '-';
                        break;
                }

		return $status;
	} // fecha m&eacute;todo statusComprovacaoFisicaDoProjeto()

} // fecha class