<!-- ========== INICIO MENU ========== -->
<script language="javascript" type="text/javascript" src="<?php echo $this->baseUrl(); ?>/public/scripts/quickmenu.js"></script>
 
<div id="menu">

    <!-- inicio: conteudo principal #container -->
    <div id="container">

        <!-- inicio: navegacao local  -->
        <script type="text/javascript">
            function layout_fluido() {
                var janela = $(window).width();
                var fluidNavGlobal = janela - 245;
                var fluidConteudo = janela - 253;
                var fluidTitulo = janela - 252;
                var fluidRodape = janela - 19;
                $("#navglobal").css("width",fluidNavGlobal);
                $("#conteudo").css("width",fluidConteudo);
                $("#titulo").css("width",fluidTitulo);
                $("#rodapeConteudo").css("width",fluidConteudo);
                $("#rodape").css("width",fluidRodape);
                $("div#rodapeConteudo").attr("id", "rodapeConteudo_com_menu");
            }
        </script>

        <style type="text/css">
            .sanfonaDiv {
                clear: both;
                display: none;
            }
        </style>

       <div id="menuContexto" style="margin-bottom: 50px;">
            <div class="top"></div>
            
            <div id="qm0" class="qmmc sanfona">
                <a class="no_seta" href="<?php echo $this->url(array('controller' => 'parecerista', 'action' => 'configurar-pagamento-parecerista'), '', true); ?>" title="Configurar Despacho">Configurar Despacho</a>
                <a class="no_seta" href="<?php echo $this->url(array('controller' => 'parecerista', 'action' => 'solicitar-pagamento-parecerista'), '', true); ?>" title="Solicitar pagamento de parecerista">Solicitar Pagamentos</a>
                <a class="no_seta" href="<?php echo $this->url(array('controller' => 'parecerista', 'action' => 'registrar-ordem-bancaria'), '', true); ?>" title="Registrar ordem banc&aacute;ria">Registrar ordem banc&aacute;ria</a>
                <a class="no_seta" href="<?php echo $this->url(array('controller' => 'parecerista', 'action' => 'finalizar-pagamento-parecerista'), '', true); ?>" title="Finalizar pagamento de parecerista">Finalizar pagamentos</a>
                <a class="no_seta" href="<?php echo $this->url(array('controller' => 'parecerista', 'action' => 'index'), '', true); ?>" title="Consulta">Consulta</a>
            </div>

            <div class="bottom"></div>
            
        </div>
    </div>
</div>