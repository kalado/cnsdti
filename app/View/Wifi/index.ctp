<?php
//Configurações de View
//
//Exemplos de aplicação para Scripts próprios de view:
//$this->Html->script('admin/bootstrap-alert', array('inline' => false));
//$this->Html->css('admin/bootstrap', null, array('inline' => false));
?>


<div class="span9">
	<div class="row-fluid">
		<div class="hero-unit">
		    <h3 class="pull-left"><?php echo $title_for_layout;?></h3>
			<a class="btn actionMenu pull-right" style="margin-left:10px" href="<?php echo $this->Html->url('/wifi/add'); ?>">Adicionar Dispositivo</a>
		    <a class="btn actionMenu pull-right" id="multidelete" href="#">Deletar Dispositivos</a>
			<br clear="all"/>
			<div>
		        <?php
		            $this->Grid->controllerName = 'Wifi';
		            $this->Grid->nome = 'wifi';
		
		            echo $this->Grid->listagem(array('Código' => 'id', 'Nome' => 'name', 'Mac' => 'macaddress', 'Tipo' => 'Typesdevice|name', 'Setor' => 'Sector|name'), $listRegistros);
		        ?>
			</div>
		</div>
	</div>
</div>