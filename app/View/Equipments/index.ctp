<?php
//Configurações de View
//
//Exemplos de aplicação para Scripts próprios de view:
//$this->Html->script('admin/bootstrap-alert', array('inline' => false));
//$this->Html->css('admin/bootstrap', null, array('inline' => false));
?>


<div class="span9">
    <div class="navbar filtrosAdm">
        <h3 class="pull-left"><?php echo $title_for_layout;?></h3>
        <a class="btn actionMenu pull-right" style="margin-left:10px" href="<?php echo $this->Html->url('/equipments/add'); ?>">Adicionar Dispositivo</a>
        <a class="btn actionMenu pull-right" id="multidelete" href="#">Deletar Dispositivos</a>
    </div>
	<br clear="all"/>
    <div id="content">
        <?php
            $this->Grid->controllerName = 'Equipment';
            $this->Grid->nome = 'equipments';

            echo $this->Grid->listagem(array('Código' => 'id', 'Nome' => 'name', 'Ativo' => 'active'), $listRegistros);
        ?>
    </div>
</div>