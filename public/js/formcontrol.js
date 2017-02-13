//Form

var rowcount = 0;

function removeElements() {

	$('#tempfields').empty();

}//function removeElements() {


function addT1Elements() { //AC ELEMENTS
	var tempcon = document.getElementById('tempfields');

	//----------------------------------------------------------------------------------

	var div = document.createElement('div');
	div.setAttribute('class', 'five fields');
	tempcon.appendChild(div);

	var div1 = document.createElement('div');
	div1.setAttribute('class', 'field');
	tempcon.lastChild.appendChild(div1);

	tempcon.lastChild.lastChild.appendChild(document.createElement('label'));

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('AC Position '));

	var span1 = document.createElement('span');
	span1.setAttribute('class', 'asterisk');
	tempcon.lastChild.lastChild.lastChild.appendChild(span1);

	tempcon.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode('*'));

	var div2 = document.createElement('div');
	div2.setAttribute('class', 'field');
	tempcon.lastChild.lastChild.appendChild(div2);

	var select = document.createElement('select');
	select.setAttribute('class','ui selection dropdown');
	select.setAttribute('name', 'acposition');
	tempcon.lastChild.lastChild.lastChild.appendChild(select);

	var opt = document.createElement('option');
	opt.setAttribute('disabled', 'disabled');
	opt.setAttribute('selected', 'selected');
	opt.setAttribute('value', 'disitem');

	tempcon.lastChild.lastChild.lastChild.lastChild.appendChild(opt);

	tempcon.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Select One'));

	//----------------------------------------------------------------------------------

	var div3 = document.createElement('div');
	div3.setAttribute('class', 'three fields');
	tempcon.appendChild(div3);

	var div4 = document.createElement('div');
	div4.setAttribute('class', 'field');
	tempcon.lastChild.appendChild(div4);

	tempcon.lastChild.lastChild.appendChild(document.createElement('label'));

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Office Name '));

	var span2 = document.createElement('span');
	span2.setAttribute('class', 'asterisk');
	tempcon.lastChild.lastChild.lastChild.appendChild(span2);

	tempcon.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode('*'));

	var div5 = document.createElement('div');
	div5.setAttribute('class', 'ui input field');
	tempcon.lastChild.lastChild.appendChild(div5);

	var input2 = document.createElement('input');
	input2.setAttribute('type','text');
	input2.setAttribute('name', 'officename');
	input2.setAttribute('placeholder', 'e.g. Sample Inc.');
	tempcon.lastChild.lastChild.lastChild.appendChild(input2);

	//----------------------------------------------------------------------------------

	var div6 = document.createElement('div');
	div6.setAttribute('class', 'field');
	tempcon.lastChild.appendChild(div6);

	tempcon.lastChild.lastChild.appendChild(document.createElement('label'));

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Office Address '));

	var span3 = document.createElement('span');
	span3.setAttribute('class', 'asterisk');
	tempcon.lastChild.lastChild.lastChild.appendChild(span3);

	tempcon.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode('*'));

	var div7 = document.createElement('div');
	div7.setAttribute('class', 'ui input field');
	tempcon.lastChild.lastChild.appendChild(div7);

	var input2 = document.createElement('input');
	input2.setAttribute('type','text');
	input2.setAttribute('name', 'officeadd');
	input2.setAttribute('placeholder', 'Street Address Barangay City');
	tempcon.lastChild.lastChild.lastChild.appendChild(input2);

	//----------------------------------------------------------------------------------

	div13 = document.createElement('div');
	div13.setAttribute('class', 'five fields');
	tempcon.appendChild(div13);

	div11 = document.createElement('div');
	div11.setAttribute('class', 'field');
	tempcon.lastChild.appendChild(div11);

	tempcon.lastChild.lastChild.appendChild(document.createElement('label'));

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('AC Category '));

	var span5 = document.createElement('span');
	span5.setAttribute('class', 'asterisk');
	tempcon.lastChild.lastChild.lastChild.appendChild(span5);

	tempcon.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode('*'));

	div12 = document.createElement('div');
	div12.setAttribute('class', 'field');
	tempcon.lastChild.lastChild.appendChild(div12);

	var select2 = document.createElement('select');
	select2.setAttribute('class', 'ui selection dropdown');
	select2.setAttribute('name', 'accateg');
	select2.setAttribute('onchange', 'getsubcateg()');
	tempcon.lastChild.lastChild.lastChild.appendChild(select2);

	var opt2 = document.createElement('option');
	opt2.setAttribute('disabled', 'disabled');
	opt2.setAttribute('selected', 'selected');
	opt2.setAttribute('value', 'disitem');

	tempcon.lastChild.lastChild.lastChild.lastChild.appendChild(opt2);

	tempcon.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Select One'));

	//----------------------------------------------------------------------------------

	div14 = document.createElement('div');
	div14.setAttribute('class', 'field');
	tempcon.lastChild.appendChild(div14);

	tempcon.lastChild.lastChild.appendChild(document.createElement('label'));

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('AC Sub-Category '));

	var span6 = document.createElement('span');
	span6.setAttribute('class', 'asterisk');
	tempcon.lastChild.lastChild.lastChild.appendChild(span6);

	tempcon.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode('*'));

	div15 = document.createElement('div');
	div15.setAttribute('class', 'field');
	tempcon.lastChild.lastChild.appendChild(div15);

	var select3 = document.createElement('select');
	select3.setAttribute('class', 'ui selection dropdown');
	select3.setAttribute('name', 'acsubcateg');
	tempcon.lastChild.lastChild.lastChild.appendChild(select3);

	var opt5 = document.createElement('option');
	opt5.setAttribute('disabled', 'disabled');
	opt5.setAttribute('selected', 'selected');
	opt5.setAttribute('value', 'disitem');
	tempcon.lastChild.lastChild.lastChild.lastChild.appendChild(opt5);

	tempcon.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Select One'));

	//----------------------------------------------------------------------------------

	div8 = document.createElement('div');
	div8.setAttribute('class', 'five fields');
	tempcon.appendChild(div8);

	var div9 = document.createElement('div');
	div9.setAttribute('class', 'field');
	tempcon.lastChild.appendChild(div9);

	tempcon.lastChild.lastChild.appendChild(document.createElement('label'));

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('AC Sector '));

	var span4 = document.createElement('span');
	span4.setAttribute('class', 'asterisk');
	tempcon.lastChild.lastChild.lastChild.appendChild(span4);

	tempcon.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode('*'));

	div10 = document.createElement('div');
	div10.setAttribute('class', 'field');
	tempcon.lastChild.lastChild.appendChild(div10);

	var select1 = document.createElement('select');
	select1.setAttribute('class', 'ui selection dropdown multiple');
	select1.setAttribute('multiple', 'true');
	select1.setAttribute('name', 'acsector');
	tempcon.lastChild.lastChild.lastChild.appendChild(select1);

	var opt1 = document.createElement('option');
	opt1.setAttribute('disabled', 'disabled');
	opt1.setAttribute('selected', 'selected');
	opt1.setAttribute('value', 'disitem');

	tempcon.lastChild.lastChild.lastChild.lastChild.appendChild(opt1);

	tempcon.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Select One or More'));

	$("select").dropdown(); //refresh dropdown
}//function addACElements() {

function addT2Elements() { //PSMU and TWG ELEMENTS

	var tempcon = document.getElementById('tempfields');

	var div = document.createElement('div');
	div.setAttribute('class', 'field');
	tempcon.appendChild(div);

	tempcon.lastChild.appendChild(document.createElement('label'));

	tempcon.lastChild.lastChild.appendChild(document.createTextNode('Authority Order '));

	var span = document.createElement('span');
	span.setAttribute('class', 'asterisk');
	tempcon.lastChild.lastChild.appendChild(span);

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('*'));

	var div8 = document.createElement('div');
	div8.setAttribute('class', 'five fields');
	tempcon.lastChild.appendChild(div8);

	var div9 = document.createElement('div');
	div9.setAttribute('class', 'ui input field');
	tempcon.lastChild.lastChild.appendChild(div9);

	var input = document.createElement('input');
	input.setAttribute('type','text');
	input.setAttribute('name','authorder');
	input.setAttribute('placeholder', 'Authority Order');
	tempcon.lastChild.lastChild.lastChild.appendChild(input);

	//----------------------------------------------------------------------------------

	var div12 = document.createElement('div');
	div12.setAttribute('class', 'five fields');
	tempcon.appendChild(div12);

	var div1 = document.createElement('div');
	div1.setAttribute('class', 'field');
	tempcon.lastChild.appendChild(div1);

	tempcon.lastChild.lastChild.appendChild(document.createElement('label'));

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('PNP Position '));

	var span1 = document.createElement('span');
	span1.setAttribute('class', 'asterisk');
	tempcon.lastChild.lastChild.lastChild.appendChild(span1);

	tempcon.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode('*'));

	var div3 = document.createElement('div');
	div3.setAttribute('class', 'field');
	tempcon.lastChild.lastChild.appendChild(div3);

	var select1 = document.createElement('select');
	select1.setAttribute('class', 'ui selection dropdown');
	select1.setAttribute('name', 'position');
	tempcon.lastChild.lastChild.lastChild.appendChild(select1);

	var opt1 = document.createElement('option');
	opt1.setAttribute('disabled', 'disabled');
	opt1.setAttribute('selected', 'selected');
	opt1.setAttribute('value', 'disitem');

	tempcon.lastChild.lastChild.lastChild.lastChild.appendChild(opt1);

	tempcon.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Select One'));

	//----------------------------------------------------------------------------------
	
	var div13 = document.createElement('div');
	div13.setAttribute('class', 'field');
	tempcon.lastChild.appendChild(div13);

	tempcon.lastChild.lastChild.appendChild(document.createElement('label'));

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Rank '));

	var span3 = document.createElement('span');
	span3.setAttribute('class', 'asterisk');
	tempcon.lastChild.lastChild.lastChild.appendChild(span3);

	tempcon.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode('*'));

	var div14 = document.createElement('div');
	div14.setAttribute('class', 'field');
	tempcon.lastChild.lastChild.appendChild(div14);

	var select6 = document.createElement('select');
	select6.setAttribute('class', 'ui selection dropdown');
	select6.setAttribute('name', 'rank');
	tempcon.lastChild.lastChild.lastChild.appendChild(select6);

	var opt6 = document.createElement('option');
	opt6.setAttribute('disabled', 'disabled');
	opt6.setAttribute('selected', 'selected');
	opt6.setAttribute('value', 'disitem');

	tempcon.lastChild.lastChild.lastChild.lastChild.appendChild(opt6);

	tempcon.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Select One'));

	
	//----------------------------------------------------------------------------------

	var div4 = document.createElement('div');
	div4.setAttribute('class', 'field');
	tempcon.appendChild(div4);

	tempcon.lastChild.appendChild(document.createElement('label'));

	tempcon.lastChild.lastChild.appendChild(document.createTextNode('Unit/Office '));

	var span2 = document.createElement('span');
	span2.setAttribute('class', 'asterisk');
	tempcon.lastChild.lastChild.appendChild(span2);

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('*'));

	var div5 = document.createElement('div');
	div5.setAttribute('class', 'five fields');
	tempcon.lastChild.appendChild(div5);

	var div6 = document.createElement('div');
	div6.setAttribute('class', 'field');
	tempcon.lastChild.lastChild.appendChild(div6);

	var select2 = document.createElement('select');
	select2.setAttribute('class', 'ui selection dropdown');
	select2.setAttribute('name', 'primary');
	select2.setAttribute('onchange', 'getsecoffice()');
	tempcon.lastChild.lastChild.lastChild.appendChild(select2);

	var opt2 = document.createElement('option');
	opt2.setAttribute('disabled', 'disabled');
	opt2.setAttribute('selected', 'selected');
	opt2.setAttribute('value', 'disitem');

	tempcon.lastChild.lastChild.lastChild.lastChild.appendChild(opt2);

	tempcon.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Primary Office'));

	//----------------------------------------------------------------------------------

	var div15 = document.createElement('div');
	div15.setAttribute('class', 'field');
	tempcon.lastChild.lastChild.appendChild(div15);

	var select3 = document.createElement('select');
	select3.setAttribute('class', 'ui selection dropdown');
	select3.setAttribute('name', 'secondary');
	select3.setAttribute('onchange', 'getteroffice()');
	tempcon.lastChild.lastChild.lastChild.appendChild(select3);

	var opt3 = document.createElement('option');
	opt3.setAttribute('disabled', 'disabled');
	opt3.setAttribute('selected', 'selected');
	opt3.setAttribute('value', 'disitem');
	tempcon.lastChild.lastChild.lastChild.lastChild.appendChild(opt3);

	tempcon.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Secondary Office'));

	//----------------------------------------------------------------------------------

	var div10 = document.createElement('div');
	div10.setAttribute('class', 'field');
	tempcon.lastChild.lastChild.appendChild(div10);

	var select4 = document.createElement('select');
	select4.setAttribute('class', 'ui selection dropdown');
	select4.setAttribute('name', 'tertiary');
	select4.setAttribute('onchange', 'getquaroffice()');
	tempcon.lastChild.lastChild.lastChild.appendChild(select4);

	var opt4 = document.createElement('option');
	opt4.setAttribute('disabled', 'disabled');
	opt4.setAttribute('selected', 'selected');
	opt4.setAttribute('value', 'disitem');
	tempcon.lastChild.lastChild.lastChild.lastChild.appendChild(opt4);

	tempcon.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Tertiary Office'));

	//----------------------------------------------------------------------------------

	var div11 = document.createElement('div');
	div11.setAttribute('class', 'field');
	tempcon.lastChild.lastChild.appendChild(div11);

	var select5 = document.createElement('select');
	select5.setAttribute('class', 'ui selection dropdown');
	select5.setAttribute('name', 'quaternary');
	tempcon.lastChild.lastChild.lastChild.appendChild(select5);

	var opt5 = document.createElement('option');
	opt5.setAttribute('disabled', 'disabled');
	opt5.setAttribute('selected', 'selected');
	opt5.setAttribute('value', 'disitem');
	tempcon.lastChild.lastChild.lastChild.lastChild.appendChild(opt5);

	tempcon.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Quaternary Office'));

	$("select").dropdown(); //refresh dropdown
}//function addT2Elements() {


//Multiple Text Input

function additem(text, index) {
	var ulist = document.getElementsByName('lecturer')[index];
	var container = document.getElementsByName('pcontainer')[index];
	var inputlist = document.getElementsByName('inputlist')[index];
	var textfield = document.getElementsByName('inputlecturer')[index];

	var newli = document.createElement('li');
	newli.setAttribute('class', 'inputchoice');
	ulist.appendChild(newli);

	var span = document.createElement("span");
	span.setAttribute('class', 'inputtitle');
	ulist.lastChild.appendChild(span);
	ulist.lastChild.lastChild.appendChild(document.createTextNode(text));

	var alink = document.createElement("a");
	alink.setAttribute('class','deleteinput');
	alink.setAttribute('onclick', 'deletearritem($(this).parent().index(), ' + index + ')');
	ulist.lastChild.appendChild(alink);
	var ibtn = document.createElement("i");
	ibtn.setAttribute('class', 'remove icon');
	ulist.lastChild.lastChild.appendChild(ibtn);

	ulist.insertBefore(newli, inputlist);

	textfield.value = "";

}//function additemtolist() {

function deleteitem(index, rowindex, ulist) {

	ulist.removeChild(ulist.getElementsByTagName('li')[index]);
}//function deleteitem() {

function divonfocus(index) {
	document.getElementsByName("pcontainer")[0].style.borderColor = "#85B7D9";

}//function divonfocus() {

$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});

//Adviser Add Table

function addrow() {
	var table = document.getElementById('traintable').getElementsByTagName('tbody')[0];

	tr = document.createElement('tr');
	tr.setAttribute('class', 'trow1');
	table.appendChild(tr);


	//----------------------------------------Title------------------------------------------


	table.lastChild.appendChild(document.createElement('td'));

	table.lastChild.lastChild.appendChild(document.createElement('center'));

	var div1 = document.createElement('div');
	div1.setAttribute('class', 'ui input field');
	table.lastChild.lastChild.lastChild.appendChild(div1);

	var input1 = document.createElement('input');
	input1.setAttribute('type', 'text');
	input1.setAttribute('name','traintitle');
	input1.setAttribute('placeholder', 'e.g. The Sample Title');
	table.lastChild.lastChild.lastChild.lastChild.appendChild(input1);


	//--------------------------------------Category--------------------------------------------


	table.lastChild.appendChild(document.createElement('td'));

	table.lastChild.lastChild.appendChild(document.createElement('center'));

	var div2 = document.createElement('div');
	div2.setAttribute('class', 'field');
	table.lastChild.lastChild.lastChild.appendChild(div2);

	var select1 = document.createElement('select');
	select1.setAttribute('id', 'select');
	select1.setAttribute('class', 'ui selection dropdown');
	select1.setAttribute('onchange', 'showfield()');
	select1.setAttribute('name','traincateg');
	table.lastChild.lastChild.lastChild.lastChild.appendChild(select1);

	var opt1 = document.createElement('option');
	opt1.setAttribute('class', 'disabled');
	table.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(opt1);

	table.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Select One'));

	var opt2 = document.createElement('option');
	opt2.setAttribute('value', 'Advisory Council Summit');
	table.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(opt2);

	table.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Advisory Council Summit'));

	var opt3 = document.createElement('option');
	opt3.setAttribute('value', 'Family Conference');
	table.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(opt3);

	table.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Family Conference'));

	var opt4 = document.createElement('option');
	opt4.setAttribute('value', 'Boot Camp (Basic)');
	table.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(opt4);

	table.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Boot Camp (Basic)'));

	var opt5 = document.createElement('option');
	opt5.setAttribute('value', 'Boot Camp (Master)');
	table.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(opt5);

	table.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Boot Camp (Master)'));

	var opt6 = document.createElement('option');
	opt6.setAttribute('value', 'Lecture Series');
	table.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(opt6);

	table.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Lecture Series'));


	var opt7 = document.createElement('option');
	opt7.setAttribute('value', 'Strategy Refresh');
	table.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(opt7);

	table.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Strategy Refresh'));

	var opt8 = document.createElement('option');
	opt8.setAttribute('value', '7');
	table.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(opt8);

	table.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Others'));

	var div3 = document.createElement('div');
	div3.setAttribute('class', 'ui input');
	div3.setAttribute('name', 'othercon');
	div3.setAttribute('style', 'display:none');
	table.lastChild.lastChild.lastChild.lastChild.appendChild(div3);

	table.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(document.createElement('br'));

	var input2 = document.createElement('input');
	input2.setAttribute('type', 'text');
	input2.setAttribute('name','othercat');
	input2.setAttribute('placeholder', 'Please specify (required)');
	table.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(input2);

	//-------------------------------------------Location---------------------------------------

	table.lastChild.appendChild(document.createElement('td'));

	table.lastChild.lastChild.appendChild(document.createElement('center'));

	var div4 = document.createElement('div');
	div4.setAttribute('class', 'ui input field');
	table.lastChild.lastChild.lastChild.appendChild(div4);

	var input3 = document.createElement('input');
	input3.setAttribute('type', 'text');
	input3.setAttribute('name','location');
	input3.setAttribute('placeholder', 'e.g. Makati City');
	table.lastChild.lastChild.lastChild.lastChild.appendChild(input3);


	//---------------------------------------Start-------------------------------------------


	table.lastChild.appendChild(document.createElement('td'));

	table.lastChild.lastChild.appendChild(document.createElement('center'));

	var div = document.createElement('div');
	div.setAttribute('class', 'field');
	table.lastChild.lastChild.lastChild.appendChild(div);

	var div5 = document.createElement('div');
	div5.setAttribute('class', 'ui input field');
	table.lastChild.lastChild.lastChild.lastChild.appendChild(div5);

	var input4 = document.createElement('input');
	input4.setAttribute('type', 'date');
	input4.setAttribute('name','trainsdate');
	input4.setAttribute('max', "{{date('Y-m-d', strtotime(date('Y-m-d')  . ' +1 day'))}}");
	table.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(input4);

	var div10 = document.createElement('div');
	div10.setAttribute('class', 'ui input field');
	table.lastChild.lastChild.lastChild.lastChild.appendChild(div10);

	var input8 = document.createElement('input');
	input8.setAttribute('type', 'time');
	input8.setAttribute('name','trainstime');
	table.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(input8);


	//-------------------------------------End---------------------------------------------


	table.lastChild.appendChild(document.createElement('td'));

	table.lastChild.lastChild.appendChild(document.createElement('center'));

	var div6 = document.createElement('div');
	div6.setAttribute('class', 'field');
	table.lastChild.lastChild.lastChild.appendChild(div6);

	var div11 = document.createElement('div');
	div11.setAttribute('class', 'ui input field');
	table.lastChild.lastChild.lastChild.lastChild.appendChild(div11);

	var input5 = document.createElement('input');
	input5.setAttribute('type', 'date');
	input5.setAttribute('name','trainedate');
	input5.setAttribute('max', "{{date('Y-m-d', strtotime(date('Y-m-d')  . ' +1 day'))}}");
	table.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(input5);

	var div11 = document.createElement('div');
	div11.setAttribute('class', 'ui input field');
	table.lastChild.lastChild.lastChild.lastChild.appendChild(div11);

	var input9 = document.createElement('input');
	input9.setAttribute('type', 'time');
	input9.setAttribute('name','trainetime');
	table.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(input9);

	//------------------------------------Lecturer----------------------------------------------

	table.lastChild.appendChild(document.createElement('td'));

	table.lastChild.lastChild.appendChild(document.createElement('center'));

	var div7 = document.createElement('div');
	div7.setAttribute('class', 'five fields');
	table.lastChild.lastChild.lastChild.appendChild(div7);

	var div8 = document.createElement('div');
	div8.setAttribute('class', 'divpercon');
	div8.setAttribute('name', 'pcontainer');
	table.lastChild.lastChild.lastChild.lastChild.appendChild(div8);

	var ul = document.createElement('ul');
	ul.setAttribute('class', 'perlist');
	ul.setAttribute('name', 'lecturer');
	table.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(ul);

	var li = document.createElement('li');
	li.setAttribute('class', 'inputitem');
	li.setAttribute('name', 'inputlist');
	table.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(li);

	var input6 = document.createElement('input');
	input6.setAttribute('type', 'text');
	input6.setAttribute('name','inputlecturer');
	input6.setAttribute('id', rowcount);
	input6.setAttribute('placeholder','LN, FN MI');
	input6.setAttribute('class','perfield');
	input6.setAttribute('onclick','divonfocus()');
	input6.setAttribute('onkeydown','if(event.keyCode == 13){ addarritem(this.id);}');
	table.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(input6);

	/*var textarea = document.createElement('textarea');
	textarea.setAttribute('name', 'trainlecturer');
	textarea.setAttribute('class', 'areastyle');
	textarea.setAttribute('rows', '4');
	textarea.setAttribute('placeholder', 'Type here...');
	table.lastChild.lastChild.lastChild.lastChild.appendChild(textarea);*/


	//-----------------------------------Organization-----------------------------------------------


	table.lastChild.appendChild(document.createElement('td'));

	table.lastChild.lastChild.appendChild(document.createElement('center'));

	var div9 = document.createElement('div');
	div9.setAttribute('class', 'ui input field');
	table.lastChild.lastChild.lastChild.appendChild(div9);

	var input7 = document.createElement('input');
	input7.setAttribute('type', 'text');
	input7.setAttribute('name','trainorg');
	input7.setAttribute('placeholder','e.g. CPSM');
	table.lastChild.lastChild.lastChild.lastChild.appendChild(input7);

}//function addrow() {


//DROPDOWNS

function populatedropdown(id, selname, desc) {
	var item = document.createElement('option');
	item.setAttribute('value',  id);
	document.getElementsByName(selname)[0].appendChild(item);
	document.getElementsByName(selname)[0].lastChild.appendChild(document.createTextNode(desc));
}//function populatedropdown() {
