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
        <a class="btn actionMenu pull-right" style="margin-left:10px" href="<?php echo $this->Html->url('/users/add'); ?>">Adicionar Usuário</a>
        <a class="btn actionMenu pull-right" id="multidelete" href="#">Deletar Usuários</a>
    </div>
	<br clear="all"/>
    <div id="content">
        <?php
            $this->Grid->controllerName = 'User';
            $this->Grid->nome = 'users';

            echo $this->Grid->listagem(array('Código' => 'id', 'Nome' => 'name', 'Login' => 'login'), $listRegistros);
        ?>
    </div>
</div>