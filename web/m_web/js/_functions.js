// JavaScript Document
var array_title_prod = new Array();
function openHref(url){
	window.open(url);
}
function clearImgMenu(id){
	for(var i=1;i<=5;i++){
		$("#menu_li_"+i).css("background-color", "#fff");			
		$("#menu_a_"+i).css("color", "#000");		
	}
	$("#menu_li_"+id).css("background-color", "#AE2320");
	$("#menu_a_"+id).css("color", "#fff");
}
function changeImg(id, img){
	$("#img_content_"+id).attr("src", "../core/images/subcontent/"+img);
}
function getNameDiv(opc){
	var tmpArray = new Array();
	switch(opc){
		case 1: tmpArray[0] = "content_sub_1";
				tmpArray[1] = "content_sub_2";
				tmpArray[2] = "sub_bullet1";break;
		case 2: tmpArray[0] = "content_sub_3";
				tmpArray[1] = "content_sub_4";
				tmpArray[2] = "sub_bullet2";break;
		case 3: tmpArray[0] = "content_sub_5";
				tmpArray[1] = "content_sub_6";
				tmpArray[2] = "sub_bullet3";break;
	}
	return tmpArray;
}
var page_act_sub_1 = 0;
var page_act_sub_2 = 0;
var page_act_sub_3 = 0;
function habilitOpcSubContent(opc){
	switch(opc){
		case 1: page_act_sub_1 = 1;break;
		case 2: page_act_sub_2 = 1;break;
		case 3: page_act_sub_3 = 1;break;
	}	
}
function changeStyleDivContentUp(opc){
	var tmpArray = new Array();
	tmpArray = getNameDiv(opc);
	var strDiv1 = tmpArray[0];
	var strDiv2 = tmpArray[1];
	var strDiv3 = tmpArray[2];
	
	$("#"+strDiv1).attr("class", "text_black_big_up");
	//$("#"+strDiv2).attr("class", "text_plomo_7_small_up");
	$("#"+strDiv3).css("background-color", "#AE2320");
}
function changeStyleDivContentDown(opc){	
	var tmpArray = new Array();
	tmpArray = getNameDiv(opc);
	var strDiv1 = tmpArray[0];
	var strDiv2 = tmpArray[1];
	var strDiv3 = tmpArray[2];
	
	switch(opc){
		case 1: var page = page_act_sub_1;break;
		case 2: var page = page_act_sub_2;break;
		case 3: var page = page_act_sub_3;break;
	}
	
	if(page == 1){ // SI NO SE DEBE HABILITAR EL changeStyleDivContentDown PORQUE SE ESTÁ EN UNA DE LAS PÁGINAS DEL SUB
		$("#"+strDiv1).attr("class", "text_black_big_up");
		//$("#"+strDiv2).attr("class", "text_plomo_7_small_up");
		$("#"+strDiv3).css("background-color", "#AE2320");
	}else{
		$("#"+strDiv1).attr("class", "text_black_big");
		//$("#"+strDiv2).attr("class", "text_plomo_7_small");
		$("#"+strDiv3).css("background-color", "#5a5859");
	}
}
function clearTxtHeaderSearch(opc, texto){
	if(opc == 1){
		$("#txtSearch").attr("value", "");
	}else{
		$("#txtSearch").attr("value", texto);
	}
}
function openInfoProd(idProd){
	$("#divSubContentProductsDet").html("");
}
function addTitleProd(opc, title){
		array_title_prod[opc] = title;
		var strProd = "";
		for(var i=0;i<=opc;i++){
			if(i==opc) strProd += "&nbsp;&nbsp;"+array_title_prod[i];
			else strProd += "&nbsp;&nbsp;"+array_title_prod[i]+"&nbsp;&nbsp;/";
		}
		$('#titleProdAddc').html("&nbsp;&nbsp;/"+strProd);
		
		$('#divProdDetMenuVer').jScrollPane();
}
function changeProdDetail(id){
	$('#divSubContentProductsDet').html('<div id="prodDescTop">'+
											'<div id="prodDescTopLeft" style="position:relative">'+											
											'<img src="../core/images/interior/pes_der_1.jpg" width="361" height="259" border="0" />'+
											'<div style="position:absolute; top:215px; left:10px;">'+
											'<a href="../core/images/interior/pes_der_1.jpg" rel="superbox[gallery][my_gallery]">'+
											'<img border="0" src="../core/images/interior/lupa_zoom.png" width="36" height="40" /></a></div>'+
											'</div>'+
											'<div id="prodDescTopRight">'+
												'<div id="prodDescTopRightTitle" align="left"><span class="text_black">SALMON PREMIUM</span></div>'+
												'<div id="prodDescTopRightDesc" align="left"><span class="text_plomo_5_small">'+
												'IMPORTADO DE CHILE (DE CRIADERO)<br /><br />'+
												'Salm&oacute;n Premium importado - "Fresco" (importaciones semanales)<br />'+
												'Entero: Con cabeza, enviscerado,<br />'+
												'Filete: Con piel, sin espinas'+
												'</span></div>'+
												'<div id="prodDescTopRightPDF" align="left">'+
													'<img src="../core/images/interior/pdf.jpg" width="36" height="40" border="0" style="cursor:pointer;" />&nbsp;&nbsp;'+
													'<span class="text_rojo_2_small_cur"><b>SALM&Oacute;N PREMIUM IMPORTADO DE CHILE (DE CRIADERO)</b></span>'+
												'</div>'+
											'</div>'+
										'</div>'+
										'<div id="prodDescBottom" align="justify">'+
											'<span class="text_black">BENEFICIOS</span><br /><br />'+
										'<span class="text_plomo_5_small">Salm&oacute;n Premium importado - "Fresco" (importaciones semanales) Entero: Con cabeza, eviscerado, Filete: Con piel, sin espinas Salm&oacute;n Premium importado - "Fresco" (importaciones semanales) Entero: Con cabeza,eviscerado, Filete: Con Piel, sin espinas.<br />'+
										'Salm&oacute;n Premium importado - "Fresco" (importaciones semanales) Entero: Con cabeza, eviscerado, Filete: Con piel, sin espinas Salm&oacute;n Premium importado - "Fresco" (importaciones semanales) Entero: Con cabeza,eviscerado, Filete: Con Piel, sin espinas.'+
										'</span>'+
										'</div>');
	$(function(){
		$.superbox();
	});
	$.superbox.settings = {
		boxId: "superbox", // Id attribute of the "superbox" element
		boxClasses: "", // Class of the "superbox" element
		overlayOpacity: .9, // Background opaqueness
		boxWidth: "1000", // Default width of the box
		boxHeight: "1000", // Default height of the box
		loadTxt: "Loading...", // Loading text
		closeTxt: "Cerrar", // "Close" button text
		prevTxt: "Previous", // "Previous" button text
		nextTxt: "Next" // "Next" button text
	};
}