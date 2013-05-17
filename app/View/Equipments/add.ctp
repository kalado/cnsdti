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
			<h3><?php echo $title_for_layout;?></h3>
			<?php echo $this->Form->create('Equipment',array('id'=>'cnsdtiAdd')); ?>
            <fieldset>
                <div class="control-group">
                    <?php echo $this->Form->input('name', array('placeholder' => "Nome", "label" => false)) ?>
                </div>
                <div class="control-group">
                	<?php
                		$checkedtrue = 'checked="checked"';
                		$checkedfalse = '';
                		if (isset($this->data['Equipment'])) {
                			if ($this->data['Equipment']['active'] == 0) {
                				$checkedtrue = '';
                				$checkedfalse = 'checked="checked"';
                			} else {
                				$checkedtrue = 'checked="checked"';
	                			$checkedfalse = '';
                			}
                		}
                	?>
                	<h5>Ativo?</h5>
                	<label class="radio">
                    	<input type="radio" value="1" <?=$checkedtrue?> name="data[Equipment][active]">
                    	Sim
                	</label>
                	<label class="radio">
                    	<input type="radio" value="0" <?=$checkedfalse?> name="data[Equipment][active]">
                    	Não
                	</label>
                </div>
                <div class="control-group pull-right rotinaAction">
                    <?php echo $this->Form->button('Confirmar', array('type' => 'submit', 'class'=>'btn btn-success','escape' => true,'name'=>'enviado')); ?>
                </div>
            </fieldset>
            <?php echo $this->Form->end(); ?>
		</div>
	</div><!--/row-->
</div><!--/span-->