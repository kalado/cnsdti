function construct(data){
	var html = "";
	
	if(data[0]['Schedule']){
		dados = data[0]['Schedule'];
		
		for(i=1; i<7; i++){
			disableManha = "";
			agendaManha = "";
			disableTarde = "";
			agendaTarde = "";
			
			if(data[0]['dtAtual'] == "true"){
				disableManha = "disabled";
				disableTarde = "disabled";
				
				$("#error").html('<div class="alert alert-error">Para agendar hoje ainda, entre em contato com o Setor de TI pelo Ramal: 316</div>');
			}
			
			$.each(data, function(x, val){
				if(val['Schedule']['hour'] == i){
					if(data[x]['Schedule']['rotation'] == 1){
						disableManha = "disabled";
						agendaManha = data[x]['Schedule']['clientname']+' - '+data[x]['Schedule']['classroom'];
					} else {
						disableTarde = "disabled";
						agendaTarde = data[x]['Schedule']['clientname']+' - '+data[x]['Schedule']['classroom'];
					}
				}
			});
			
			html += "<tr>";
				html += "<td>";
					html += "<span class='label label-inverse'>"+getHours(i,1)+"</span>"
					html += '&nbsp;<button type="button" style="width:75%" id="1.'+i+'" data-toggle="button" class="btn '+disableManha+'"><strong>'+i+'º Horário : '+agendaManha+'</strong></button>';
				html += "</td>";
				html += "<td>";
					html += "<span class='label label-inverse'>"+getHours(i,2)+"</span>"
					html += '&nbsp;<button type="button" style="width:75%" id="2.'+i+'" data-toggle="button" class="btn '+disableTarde+'"><strong>'+i+'º Horário : '+agendaTarde+'</strong></button>';
				html += "</td>";
			html += "</tr>";
		}
	} else {
		for(i=1; i<7; i++){
			disableManha = "";
			disableTarde = "";
			
			if(data[0]['dtAtual'] == "true"){
				disableManha = "disabled";
				disableTarde = "disabled";
				
				$("#error").html('<div class="alert alert-error">Para agendar hoje ainda, entre em contato com o Setor de TI pelo Ramal: 316</div>');
			}
			
			html += "<tr>";
				html += "<td>";
					html += "<span class='label label-inverse'>"+getHours(i,1)+"</span>"
					html += '&nbsp;<button type="button" style="width:75%" id="1.'+i+'" data-toggle="button" class="btn '+disableManha+'"><strong>'+i+'º Horário</strong></button>';
				html += "</td>";
				html += "<td>";
					html += "<span class='label label-inverse'>"+getHours(i,2)+"</span>"
					html += '&nbsp;<button type="button" style="width:75%" id="2.'+i+'" data-toggle="button" class="btn '+disableTarde+'"><strong>'+i+'º Horário</strong></button>';
				html += "</td>";
			html += "</tr>";
		}
	}
	
	$("#ajax").html(html);
};

function get(id, date, url){
	$.ajax({
		type: "POST",
		url: url,
		dataType: "json",
		data: {id: id, date: date}
	}).done(function(data) {
		$("#error").html("");
		construct(data);
	});
};

function save(id, date, classroom, clientname, url){
	var ids = [];
	var i = 0;
	
	if(classroom == "Turma"){ 
		alert("Você precisa preencher a turma.");
		$("#classroom").focus();
		return;
	}
	
	$(window.document).find(".active").each(function(){
		ids[i] = $(this).attr("id");
		i++;
	});
	
	if(ids.length < 1){
		alert("Você precisa escolher algum horário.");
		return;
	}
	
	$.ajax({
		type: "POST",
		url: url,
		dataType: "json",
		data: {id: id, date: date, classroom: classroom, ids: ids, clientname: clientname}
	}).done(function(dt) {
		$("#error").html("");
		$("#error").html('<div class="alert alert-success">Agendamento realizado com Sucesso! Para ver os seus agendamentos, acesse "Meus Agendamentos" no menu ao lado.</div>');
		construct(dt);
	});
}

function getHours(id,rotation){
	switch(id){
		case 1:
			if(rotation == 1){
				return "07:10 às 08:00";
			} else {
				return "13:00 às 13:50";
			}
			break;
		case 2:
			if(rotation == 1){
				return "08:00 às 08:50";
			} else {
				return "13:50 às 14:40";
			}
			break;
		case 3:
			if(rotation == 1){
				return "08:50 às 09:40";
			} else {
				return "14:40 às 15:30";
			}
			break;
		case 4:
			if(rotation == 1){
				return "10:00 às 10:50";
			} else {
				return "15:50 às 16:40";
			}
			break;
		case 5:
			if(rotation == 1){
				return "10:50 às 11:40";
			} else {
				return "16:40 às 17:30";
			}
			break;
		case 6:
			if(rotation == 1){
				return "11:40 às 12:40";
			} else {
				return "17:30 às 18:20";
			}
			break;
	}
}