<?php
//Configurações de View
//
//Exemplos de aplicação para Scripts próprios de view:
//$this->Html->script('admin/bootstrap-alert', array('inline' => false));
//$this->Html->css('admin/bootstrap', null, array('inline' => false));
?>
<script>
	$(function() {
		$("#datepicker").datepicker({
			minDate: "-D",
			maxDate: "+1M",
			dateFormat: "dd-mm-yy",
			regional: "pt-br",
			onSelect: function(date) {
				get("<?php echo $equipamento["Equipment"]["id"]; ?>",date,"<?php echo $this->Html->url("/schedules/getschedules");?>");
			}
		});
		
		$("#save").click(function(){
			save("<?php echo $equipamento["Equipment"]["id"]; ?>",$("#datepicker").val(),$("#classroom").val(),$("#professor").val(),"<?php echo $this->Html->url("/schedules/saveschedules");?>");
		});
	});
</script>

<div class="span9">
	<div class="row-fluid">
		<div class="hero-unit">
			<h3><?php echo $title_for_layout.$equipamento["Equipment"]["name"];?></h3>
			<h5>Escolha o dia e o horário que você deseja marcar.</h5>
			
			<input type="text" id="datepicker" placeholder="Data" />
			<input type="text" id="professor" placeholder="Nome Professor" />
			<select id="classroom">
				<option value="Turma">Turma</option>
				<optgroup label="Ensino Médio">
					<option value="EM 1-1">1-1</option>
					<option value="EM 1-2">1-2</option>
					<option value="EM 2-1">2-1</option>
					<option value="EM 2-2">2-2</option>
					<option value="EM 3-1">3-1</option>
					<option value="EM 3-2">3-2</option>
				</optgroup>
				<optgroup label="Fundamental II">
					<option value="6-1">6-1</option>
					<option value="6-2">6-2</option>
					<option value="6-3">6-3</option>
					<option value="7-1">7-1</option>
					<option value="7-2">7-2</option>
					<option value="7-3">7-3</option>
					<option value="8-1">8-1</option>
					<option value="8-2">8-2</option>
					<option value="8-3">8-3</option>
					<option value="9-1">9-1</option>
					<option value="9-2">9-2</option>
					<option value="9-3">9-3</option>
				</optgroup>
				<optgroup label="Fundamental I">
					<option value="FM 1-1">1-1</option>
					<option value="FM 1-2">1-2</option>
					<option value="FM 1-3">1-3</option>
					<option value="FM 1-4">1-4</option>
					<option value="FM 2-1">2-1</option>
					<option value="FM 2-2">2-2</option>
					<option value="FM 2-3">2-3</option>
					<option value="FM 2-4">2-4</option>
					<option value="FM 3-1">3-1</option>
					<option value="FM 3-2">3-2</option>
					<option value="FM 3-3">3-3</option>
					<option value="FM 3-4">3-4</option>
					<option value="4-1">4-1</option>
					<option value="4-2">4-2</option>
					<option value="4-3">4-3</option>
					<option value="4-3">4-4</option>
					<option value="5-1">5-1</option>
					<option value="5-2">5-2</option>
					<option value="5-3">5-3</option>
				</optgroup>
				<optgroup label="Infantil">
					<option value="1PER1">1º PER 1</option>
					<option value="1PER2">1º PER 2</option>
					<option value="2PER1">2º PER 1</option>
					<option value="2PER2">2º PER 2</option>
					<option value="3PER1">3º PER 1</option>
					<option value="MAT2-1">MAT 2-1</option>
					<option value="MAT2-2">MAT 2-2</option>
					<option value="MAT3">MAT 3</option>
				</optgroup>
				<optgroup label="Integral">
					<option value="INT1">INT 1</option>
					<option value="INT2">INT 2</option>
					<option value="INT3">INT 3</option>
					<option value="INT4">INT 4</option>
					<option value="INT5">INT 5</option>
				</optgroup>
				<optgroup label="Administrativo">
					<option value="biblioteca">Biblioteca</option>
					<option value="secretaria">Secretaria</option>
					<option value="capela">Capela</option>
					<option value="outros">Outros</option>
				</optgroup>
			</select>
			<table class="table table-bordered table-hover table-condensed">
				<thead>
					<tr>
						<th style="width:47%">Manhã</th>
						<th style="width:47%">Tarde</th>
					</tr>
				</thead>
				
				<tbody class="table" id="ajax">
					<!-- Montagem automática via Ajax : ajax.js -->
				</tbody>
			</table>
			
			<div id="error"></div>
			
			<div class="row-fluid">
				<div class="offset10">
					<button type="button" id="save" class="btn btn-success btn-large">Agendar</button>
				</div>
			</div>
		</div>
	</div><!--/row-->
</div><!--/span-->
