//Form

var rowcount;

function removeElements() {

	$('#tempfields').empty();

}//function removeElements() {

function fillul(ulelement, index, item) {
	var ul = document.getElementsByName(ulelement)[index];

	var li = document.createElement('li');
	ul.appendChild(li);
	ul.lastChild.appendChild(document.createTextNode(item));

}//function fillsect() {

function filltable(tableid, mainlist, sublist, minilist) {
	var table = document.getElementById(tableid).getElementsByTagName('tbody')[0];

	table.appendChild(document.createElement('tr'));

	filltd(table, mainlist['trainingname']);
	filltd(table, mainlist['trainingtype']);
	filltd(table, mainlist['location']);
	filltd(table, minilist[0] + "\n" + minilist[1]);
	filltd(table, minilist[2] + "\n" + minilist[3]);

	table.lastChild.appendChild(document.createElement('td'));
	table.lastChild.lastChild.appendChild(document.createElement('center'));

	var ul = document.createElement('ul');
	ul.setAttribute('class', 'unorderedlist');
	ul.setAttribute('name', 'lecturelist');

	table.lastChild.lastChild.lastChild.appendChild(ul);

	var ulelems = document.getElementsByName('lecturelist');

	for(var ctr = 0 ; ctr < sublist.length ; ctr++) {
		fillul("lecturelist", ulelems.length-1, sublist[ctr]['lecturername']);
		
	};

	filltd(table, mainlist['organizer']);

}//function filltable(trainlist) {

function filltd(table, item) {
	table.lastChild.appendChild(document.createElement('td'));

	table.lastChild.lastChild.appendChild(document.createElement('center'));

	table.lastChild.lastChild.lastChild.appendChild(document.createTextNode(item));

}//function filltd(item) {

function creatediv(divclass) {
	var div = document.createElement('div');
	div.setAttribute('class', divclass);

	return div;

}//creatediv

function createspan(tempcon) {
	var span = document.createElement('span');
	span.setAttribute('class', 'asterisk');
	tempcon.lastChild.lastChild.lastChild.appendChild(span);

	tempcon.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode('*'));


}//createspan

function createdropdown(oid, tempcon, dtype, offunc) {
	var select = document.createElement('select');
	select.setAttribute('class','ui selection dropdown');
	select.setAttribute('name', oid);
	select.setAttribute('id', oid);

	if(dtype == 1) {
		select.setAttribute('onchange', offunc)
	}//if

	tempcon.lastChild.lastChild.lastChild.appendChild(select);

	var opt = document.createElement('option');
	opt.setAttribute('disabled', 'disabled');
	opt.setAttribute('selected', 'selected');
	opt.setAttribute('value', 'disitem');

	tempcon.lastChild.lastChild.lastChild.lastChild.appendChild(opt);

	tempcon.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Select One'));

}//createdropdown

function createinput(intype, oid, placeholder) {
	var input = document.createElement('input');
	input.setAttribute('type', intype);
	input.setAttribute('name', oid);
	input.setAttribute('placeholder', placeholder);

	return input;

}//createinput

function addT1Elements() { //AC ELEMENTS
	var tempcon = document.getElementById('tempfields');

	//----------------------------------------------------------------------------------

	var div = creatediv('five fields');
	tempcon.appendChild(div);

	var div1 = creatediv('field');
	tempcon.lastChild.appendChild(div1);

	tempcon.lastChild.lastChild.appendChild(document.createElement('label'));

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('AC Position '));

	createspan(tempcon);

	var div2 = creatediv('field');
	tempcon.lastChild.lastChild.appendChild(div2);

	createdropdown("acposition", tempcon, 0, ""); 

	var div3 = creatediv('three fields');
	tempcon.appendChild(div3);

	var div4 = creatediv('field');
	tempcon.lastChild.appendChild(div4);

	tempcon.lastChild.lastChild.appendChild(document.createElement('label'));

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Office Name '));

	var div5 = creatediv('ui input field');
	tempcon.lastChild.lastChild.appendChild(div5);

	var input = createinput("text", "officename", "e.g. Sample Inc.");
	tempcon.lastChild.lastChild.lastChild.appendChild(input);

	var div6 = creatediv('field');
	tempcon.lastChild.appendChild(div6);

	tempcon.lastChild.lastChild.appendChild(document.createElement('label'));

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Office Address '));

	var div7 = creatediv('ui input field');
	tempcon.lastChild.lastChild.appendChild(div7);

	var input2 = createinput("text", "officeadd", "Street Address, Barangay City");
	tempcon.lastChild.lastChild.lastChild.appendChild(input2);

	var div8 = creatediv('five fields');
	tempcon.appendChild(div8);

	var div9 = creatediv('field');
	tempcon.lastChild.appendChild(div9);

	tempcon.lastChild.lastChild.appendChild(document.createElement('label'));

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Primary Unit/Office '));

	createspan(tempcon);

	var div10 = creatediv('field');
	tempcon.lastChild.lastChild.appendChild(div10);

	createdropdown("primary", tempcon, 1, "getsecoffice()");

	var div11 = creatediv('field');
	tempcon.lastChild.appendChild(div11);

	tempcon.lastChild.lastChild.appendChild(document.createElement('label'));

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Secondary Unit/Office '));

	var div12 = creatediv('field');
	tempcon.lastChild.lastChild.appendChild(div12);

	createdropdown("secondary", tempcon, 1, "getteroffice()");

	var div13 = creatediv('field');
	tempcon.lastChild.appendChild(div13);

	tempcon.lastChild.lastChild.appendChild(document.createElement('label'));

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Tertiary Unit/Office '));

	var div14 = creatediv('field');
	tempcon.lastChild.lastChild.appendChild(div14);

	createdropdown("tertiary", tempcon, 1, "getquaroffice()");

	var div15 = creatediv('field');
	tempcon.lastChild.appendChild(div15);

	tempcon.lastChild.lastChild.appendChild(document.createElement('label'));

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Quaternary Unit/Office '));

	var div16 = creatediv('field');
	tempcon.lastChild.lastChild.appendChild(div16);

	createdropdown("quaternary", tempcon, 0, "");

	var div17 = creatediv('five fields');
	tempcon.appendChild(div17);

	var div18 = creatediv('field');
	tempcon.lastChild.appendChild(div18);

	tempcon.lastChild.lastChild.appendChild(document.createElement('label'));

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('AC Sector '));

	createspan(tempcon);
	
	var div19 = creatediv('field');
	tempcon.lastChild.lastChild.appendChild(div19);

	createdropdown("acsector", tempcon, 0, "");


	$("select").dropdown('refresh'); //refresh dropdown
}//function addACElements() {


function addT2Elements() { //PSMU and TWG ELEMENTS
	var tempcon = document.getElementById('tempfields');

	var div = creatediv('five fields');
	tempcon.appendChild(div);

	var div1 = creatediv('field');
	tempcon.lastChild.appendChild(div1);

	tempcon.lastChild.lastChild.appendChild(document.createElement('label'));

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Authority Order Number '));

	createspan(tempcon);

	var div3 = creatediv('ui input field');
	tempcon.lastChild.lastChild.appendChild(div3);


	var input = createinput("text", "authorder", "Authority Order Number");
	tempcon.lastChild.lastChild.lastChild.appendChild(input);


	var div4 = creatediv('five fields');
	tempcon.appendChild(div4);

	var div5 = creatediv('field');
	tempcon.lastChild.appendChild(div5);

	tempcon.lastChild.lastChild.appendChild(document.createElement('label'));

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('PNP Position '));

	createspan(tempcon);

	var div6 = creatediv('field');
	tempcon.lastChild.lastChild.appendChild(div6);

	createdropdown("position", tempcon, 0, "");

	var div7 = creatediv('field');
	tempcon.lastChild.appendChild(div7);

	tempcon.lastChild.lastChild.appendChild(document.createElement('label'));

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Rank '));

	createspan(tempcon);

	var div8 = creatediv('field');
	tempcon.lastChild.lastChild.appendChild(div8);

	createdropdown("rank", tempcon, 0, "");

	var div9 = creatediv('five fields');
	tempcon.appendChild(div9);

	var div10 = creatediv('field');
	tempcon.lastChild.appendChild(div10);

	tempcon.lastChild.lastChild.appendChild(document.createElement('label'));

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Primary Unit/Office '));

	createspan(tempcon);

	var div11 = creatediv('field');
	tempcon.lastChild.lastChild.appendChild(div11);

	createdropdown("primary", tempcon, 1, "getsecoffice()");

	var div12 = creatediv('field');
	tempcon.lastChild.appendChild(div12);

	tempcon.lastChild.lastChild.appendChild(document.createElement('label'));

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Secondary Unit/Office '));

	var div13 = creatediv('field');
	tempcon.lastChild.lastChild.appendChild(div13);

	createdropdown("secondary", tempcon, 1, "getteroffice()");

	var div14 = creatediv('field');
	tempcon.lastChild.appendChild(div14);

	tempcon.lastChild.lastChild.appendChild(document.createElement('label'));

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Tertiary Unit/Office '));

	var div15 = creatediv('field');
	tempcon.lastChild.lastChild.appendChild(div15);

	createdropdown("tertiary", tempcon, 1, "getquaroffice()");

	var div16 = creatediv('field');
	tempcon.lastChild.appendChild(div16);

	tempcon.lastChild.lastChild.appendChild(document.createElement('label'));

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Quaternary Unit/Office '));

	var div17 = creatediv('field');
	tempcon.lastChild.lastChild.appendChild(div17);

	createdropdown("quaternary", tempcon, 0, "");

	$("select").dropdown('refresh'); //refresh dropdown
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
	var dval = ["Advisory Council Summit", "Family Conference", "Boot Camp(Basic)",
				"Boot Camp(Master)", "Lecture Series", "Startegy Refresh", "Others"];
	var table = document.getElementById('traintable').getElementsByTagName('tbody')[0];

	tr = document.createElement('tr');
	tr.setAttribute('class', 'trow1');
	table.appendChild(tr);


	//----------------------------------------Title------------------------------------------


	table.lastChild.appendChild(document.createElement('td'));

	table.lastChild.lastChild.appendChild(document.createElement('center'));

	var div1 = creatediv('ui input field');
	table.lastChild.lastChild.lastChild.appendChild(div1);

	var input1 = createinput('text', 'traintitle', 'e.g. The Sample Title');
	table.lastChild.lastChild.lastChild.lastChild.appendChild(input1);


	//--------------------------------------Category--------------------------------------------


	table.lastChild.appendChild(document.createElement('td'));

	table.lastChild.lastChild.appendChild(document.createElement('center'));

	var div2 = creatediv('field')
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

	for(var ctr = 0 ; ctr < dval.length ; ctr++) {
		var opt2 = document.createElement('option');
		var value = dval[ctr];

		if(ctr == dval.length-1) {
			value = 7;
		}//if

		opt2.setAttribute('value', value);

		table.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(opt2);

		table.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode(dval[ctr]));

	};//for
	
	var div3 = creatediv('ui input');
	div3.setAttribute('name', 'othercon');
	div3.setAttribute('style', 'display:none');
	table.lastChild.lastChild.lastChild.lastChild.appendChild(div3);

	table.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(document.createElement('br'));

	var input2 = createinput('text', 'othercat', 'Please specify (required)');
	table.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(input2);

	//-------------------------------------------Location---------------------------------------

	table.lastChild.appendChild(document.createElement('td'));

	table.lastChild.lastChild.appendChild(document.createElement('center'));

	var div4 = creatediv('ui input field');
	table.lastChild.lastChild.lastChild.appendChild(div4);

	var input3 = createinput('text', 'location', 'e.g. Makati City');
	table.lastChild.lastChild.lastChild.lastChild.appendChild(input3);


	//---------------------------------------Start-------------------------------------------


	table.lastChild.appendChild(document.createElement('td'));

	table.lastChild.lastChild.appendChild(document.createElement('center'));

	var div = creatediv('field');
	table.lastChild.lastChild.lastChild.appendChild(div);

	var div5 = creatediv('ui input field');
	table.lastChild.lastChild.lastChild.lastChild.appendChild(div5);

	var input4 = createinput('date', 'trainsdate', '');
	input4.setAttribute('max', "{{date('Y-m-d', strtotime(date('Y-m-d')  . ' +1 day'))}}");
	table.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(input4);

	var div10 = creatediv('ui input field');
	table.lastChild.lastChild.lastChild.lastChild.appendChild(div10);

	var input8 = createinput('time', 'trainstime', '');
	table.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(input8);


	//-------------------------------------End---------------------------------------------


	table.lastChild.appendChild(document.createElement('td'));

	table.lastChild.lastChild.appendChild(document.createElement('center'));

	var div6 = creatediv('field');
	table.lastChild.lastChild.lastChild.appendChild(div6);

	var div11 = creatediv('ui input field');
	table.lastChild.lastChild.lastChild.lastChild.appendChild(div11);

	var input5 = createinput('date', 'trainedate', '');
	input5.setAttribute('max', "{{date('Y-m-d', strtotime(date('Y-m-d')  . ' +1 day'))}}");
	table.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(input5);

	var div11 = creatediv('ui input field');
	table.lastChild.lastChild.lastChild.lastChild.appendChild(div11);

	var input9 =  createinput('time', 'trainetime', '');
	table.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(input9);

	//------------------------------------Lecturer----------------------------------------------

	table.lastChild.appendChild(document.createElement('td'));

	table.lastChild.lastChild.appendChild(document.createElement('center'));

	var div7 = creatediv('five fields');
	table.lastChild.lastChild.lastChild.appendChild(div7);

	var div8 = creatediv('divpercon');
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

	var input6 = createinput('text', 'inputlecturer', 'LN, FN MI');
	input6.setAttribute('id', rowcount);
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

	var div9 = creatediv('ui input field');
	table.lastChild.lastChild.lastChild.appendChild(div9);

	var input7 = createinput('text', 'trainorg', 'e.g. CPSM');
	table.lastChild.lastChild.lastChild.lastChild.appendChild(input7);

	rowcount = rowcount + 1;
}//function addrow() {


//DROPDOWNS

function populatedropdown(id, selname, desc) {
	var item = document.createElement('option');
	item.setAttribute('value',  id);
	document.getElementsByName(selname)[0].appendChild(item);
	document.getElementsByName(selname)[0].lastChild.appendChild(document.createTextNode(desc));
}//function populatedropdown() {
