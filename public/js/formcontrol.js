//Form

var dval = ["Advisory Council Summit", "Family Conference", "Boot Camp(Basic)",
				"Boot Camp(Master)", "Lecture Series", "Startegy Refresh", "Others"];

var rowcount = 0;


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

function createdropdown(oid, tempcon, dtype, offunc, textnode) {
	var select = document.createElement('select');
	select.setAttribute('class','ui selection dropdown');
	select.setAttribute('name', oid);
	select.setAttribute('id', oid);

	if(dtype == 1) {
		select.setAttribute('onchange', offunc)
	}//if

	tempcon.lastChild.lastChild.lastChild.appendChild(select);

	var opt = document.createElement('option');
	opt.setAttribute('selected', 'selected');
	opt.setAttribute('value', 'disitem');

	tempcon.lastChild.lastChild.lastChild.lastChild.appendChild(opt);

	tempcon.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode(textnode));

}//createdropdown

function createdropdown2(oid, tempcon, dtype, offunc, textnode) {
	var select = document.createElement('select');
	select.setAttribute('class','modified ui selection dropdown selectstyle2');
	select.setAttribute('name', oid);
	select.setAttribute('id', oid);

	if(dtype == 1) {
		select.setAttribute('onchange', offunc)
	}//if

	tempcon.lastChild.lastChild.appendChild(select);

	var opt = document.createElement('option');
	opt.setAttribute('selected', 'selected');
	opt.setAttribute('value', 'disitem');

	tempcon.lastChild.lastChild.lastChild.appendChild(opt);

	tempcon.lastChild.lastChild.lastChild.lastChild.appendChild(document.createTextNode(textnode));

}//createdropdown2

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

	createdropdown("acposition", tempcon, 0, "", 'Select One'); 

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

	var div8 = creatediv('field');
	tempcon.appendChild(div8);

	tempcon.lastChild.appendChild(document.createElement('label'));


	tempcon.lastChild.lastChild.appendChild(document.createTextNode('Designation '));

	var span = document.createElement('span');
	span.setAttribute('class','asterisk');
	tempcon.lastChild.lastChild.appendChild(span);

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('*'));

	var div9 = creatediv('five fields');
	tempcon.lastChild.appendChild(div9);

	var div9 = creatediv('field');
	tempcon.lastChild.lastChild.appendChild(div9);

	createdropdown("primary", tempcon, 1, "getsecoffice(this.value)", 'Category');

	var div10 = creatediv('field');
	tempcon.lastChild.lastChild.appendChild(div10);

	createdropdown("secondary", tempcon, 1, "getteroffice(this.value)", 'Unit/Office');

	var div11 = creatediv('field');
	tempcon.lastChild.lastChild.appendChild(div11);

	createdropdown("tertiary", tempcon, 1, "getquaroffice(this.value)", 'PPO/CPO');

	var div12 = creatediv('field');
	tempcon.lastChild.lastChild.appendChild(div12);

	createdropdown("quaternary", tempcon, 0, "",'Municipal Police Station');

	var div13 = creatediv('five fields');
	tempcon.appendChild(div13);

	var div14 = creatediv('field');
	tempcon.lastChild.appendChild(div14);

	tempcon.lastChild.lastChild.appendChild(document.createElement('label'));

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('AC Sector '));

	createspan(tempcon);
	
	var div19 = creatediv('field');
	tempcon.lastChild.lastChild.appendChild(div19);

	createdropdown("acsector", tempcon, 0, "", 'Select One');

	$("select").not('#searchbox').dropdown('refresh');
	//$("select").dropdown('refresh'); //refresh dropdown
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

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Rank '));

	createspan(tempcon);

	var div6 = creatediv('field');
	tempcon.lastChild.lastChild.appendChild(div6);

	createdropdown("position", tempcon, 0, "", 'Select One');

	var div8 = creatediv('field');
	tempcon.appendChild(div8);

	tempcon.lastChild.appendChild(document.createElement('label'));

	tempcon.lastChild.lastChild.appendChild(document.createTextNode('Designation'));

	var span = document.createElement('span');
	span.setAttribute('class','asterisk');
	tempcon.lastChild.lastChild.appendChild(span);

	tempcon.lastChild.lastChild.lastChild.appendChild(document.createTextNode('*'));
	
	var div9 = creatediv('five fields');
	tempcon.lastChild.appendChild(div9);

	var div9 = creatediv('field');
	tempcon.lastChild.lastChild.appendChild(div9);

	createdropdown("primary", tempcon, 1, "getsecoffice(this.value)", 'Category');

	var div10 = creatediv('field');
	tempcon.lastChild.lastChild.appendChild(div10);

	createdropdown("secondary", tempcon, 1, "getteroffice(this.value)", 'Unit/Office');

	var div11 = creatediv('field');
	tempcon.lastChild.lastChild.appendChild(div11);

	createdropdown("tertiary", tempcon, 1, "getquaroffice(this.value)", 'PPO/CPO');

	var div12 = creatediv('field');
	tempcon.lastChild.lastChild.appendChild(div12);

	createdropdown("quaternary", tempcon, 0, "",'Municipal Police Station');

	$("select").not('#searchbox').dropdown('refresh');
	//$("select").dropdown('refresh'); //refresh dropdown
}//function addT2Elements() {


function adddropdown(){

	var labelpane = document.getElementById('templpane');
	var ddpane = document.getElementById('tempddfield');

	//label
	var ldiv1 = creatediv("twelve wide column bspacing");
	labelpane.appendChild(ldiv1);


	var span = document.createElement('span');
	span.setAttribute('class', 'asterisk');
	labelpane.lastChild.appendChild(span);

	labelpane.lastChild.lastChild.appendChild(document.createTextNode('Unit to Manage*'));


	var ldiv2 = creatediv("field");
	labelpane.lastChild.appendChild(ldiv2);
	labelpane.lastChild.lastChild.appendChild(document.createElement('label'));
	labelpane.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Primary Office'));

	var ldiv3 = creatediv("twelve wide column bspacing");
	labelpane.appendChild(ldiv3);

	var ldiv4 = creatediv("field");
	labelpane.lastChild.appendChild(ldiv4);
	labelpane.lastChild.lastChild.appendChild(document.createElement('label'));
	labelpane.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Secondary Office'));


	var ldiv5 = creatediv("twelve wide column bspacing");
	labelpane.appendChild(ldiv5);

	var ldiv6 = creatediv("field");
	labelpane.lastChild.appendChild(ldiv6);
	labelpane.lastChild.lastChild.appendChild(document.createElement('label'));
	labelpane.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Tertiary Office'));


	var ldiv7 = creatediv("twelve wide column bspacing");
	labelpane.appendChild(ldiv7);

	var ldiv8 = creatediv("field");
	labelpane.lastChild.appendChild(ldiv8);
	labelpane.lastChild.lastChild.appendChild(document.createElement('label'));
	labelpane.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Quaternary Office'));

	//Dropdown
	var ddiv1 = creatediv("twelve wide column bspacing2");
	ddpane.appendChild(ddiv1);

	var ddiv2 = creatediv('field');
	ddpane.lastChild.appendChild(ddiv2);

	createdropdown2("primary", ddpane, 1, "getsecoffice(this.value)", 'Category');

	var ddiv3 = creatediv("twelve wide column bspacing2");
	ddpane.appendChild(ddiv3);

	var ddiv4 = creatediv('field');
	ddpane.lastChild.appendChild(ddiv4);

	createdropdown2("secondary", ddpane, 1, "getteroffice(this.value)", 'Unit/Office');

	var ddiv5 = creatediv("twelve wide column bspacing2");
	ddpane.appendChild(ddiv5);

	var ddiv6 = creatediv('field');
	ddpane.lastChild.appendChild(ddiv6);

	createdropdown2("tertiary", ddpane, 1, "getquaroffice(this.value)", 'PPO/CPO');

	var ddiv7 = creatediv("twelve wide column bspacing2");
	ddpane.appendChild(ddiv7);

	var ddiv8 = creatediv('field');
	ddpane.lastChild.appendChild(ddiv8);

	createdropdown2("quaternary", ddpane, 0, "",'Municipal Police Station');

}


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

//Adviser Add Table

function addrow() {
	var table = document.getElementById('traintable').getElementsByTagName('tbody')[0];

	tr = document.createElement('tr');
	tr.setAttribute('class', 'trow1');
	table.appendChild(tr);


	//----------------------------------------Title------------------------------------------


	table.lastChild.appendChild(document.createElement('td'));

	table.lastChild.lastChild.appendChild(document.createElement('center'));

	var div1 = creatediv('ui input field');
	div1.setAttribute('name', 'titlecon');
	table.lastChild.lastChild.lastChild.appendChild(div1);

	var input1 = createinput('text', 'traintitle', 'e.g. The Sample Title');
	input1.setAttribute('id', 'traintitle-' + rowcount);
	input1.setAttribute('onchange', 'setvalidity(this.id)');
	table.lastChild.lastChild.lastChild.lastChild.appendChild(input1);


	//--------------------------------------Category--------------------------------------------


	table.lastChild.appendChild(document.createElement('td'));

	table.lastChild.lastChild.appendChild(document.createElement('center'));

	var div2 = creatediv('field');
	div2.setAttribute('name', 'categcon');
	table.lastChild.lastChild.lastChild.appendChild(div2);

	var select1 = document.createElement('select');
	select1.setAttribute('id', 'traincateg-' + rowcount);
	select1.setAttribute('class', 'ui selection dropdown');
	select1.setAttribute('onchange', 'showfield(); setvalidity(this.id)');
	select1.setAttribute('name','traincateg');
	table.lastChild.lastChild.lastChild.lastChild.appendChild(select1);

	var opt1 = document.createElement('option');
	opt1.setAttribute('selected', 'selected');
	opt1.setAttribute('value', '-');
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
	div4.setAttribute('name', 'loccon');
	table.lastChild.lastChild.lastChild.appendChild(div4);

	var input3 = createinput('text', 'location', 'e.g. Makati City');
	input3.setAttribute('id','location-' + rowcount);
	input3.setAttribute('onchange', 'setvalidity(this.id)');
	table.lastChild.lastChild.lastChild.lastChild.appendChild(input3);


	//---------------------------------------Start-------------------------------------------


	table.lastChild.appendChild(document.createElement('td'));

	table.lastChild.lastChild.appendChild(document.createElement('center'));

	var div = creatediv('field');
	table.lastChild.lastChild.lastChild.appendChild(div);

	var div5 = creatediv('ui input field');
	div5.setAttribute('name', 'sdcon');

	table.lastChild.lastChild.lastChild.lastChild.appendChild(div5);

	var input4 = createinput('date', 'trainsdate', '');
	input4.setAttribute('id', 'trainsdate-' + rowcount);
	input4.setAttribute('max', "{{date('Y-m-d', strtotime(date('Y-m-d')  . ' +1 day'))}}");
	input4.setAttribute('onchange', 'setvalidity(this.id)');
	table.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(input4);

	var div10 = creatediv('ui input field');
	table.lastChild.lastChild.lastChild.lastChild.appendChild(div10);

	var input8 = createinput('time', 'trainstime', '');
	input8.setAttribute('id', rowcount);
	input8.setAttribute('onchange', 'setvalidity(this.id)');
	table.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(input8);


	//-------------------------------------End---------------------------------------------


	table.lastChild.appendChild(document.createElement('td'));

	table.lastChild.lastChild.appendChild(document.createElement('center'));

	var div6 = creatediv('field');
	table.lastChild.lastChild.lastChild.appendChild(div6);

	var div11 = creatediv('ui input field');
	div11.setAttribute('name', 'edcon');

	table.lastChild.lastChild.lastChild.lastChild.appendChild(div11);

	var input5 = createinput('date', 'trainedate', '');
	input5.setAttribute('id', 'trainedate-' + rowcount);
	input5.setAttribute('max', "{{date('Y-m-d', strtotime(date('Y-m-d')  . ' +1 day'))}}");
	input5.setAttribute('onchange', 'setvalidity(this.id)');
	table.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(input5);

	var div11 = creatediv('ui input field');
	table.lastChild.lastChild.lastChild.lastChild.appendChild(div11);

	var input9 =  createinput('time', 'trainetime', '');
	input9.setAttribute('id', rowcount);
	input9.setAttribute('onchange', 'setvalidity(this.id)');
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
	input6.setAttribute('onkeydown','if(event.keyCode == 13){ addarritem(this.id, this.value);}');
	input6.setAttribute('onblur','addarritem(this.id, this.value)');

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
	div9.setAttribute('name','orgcon')
	table.lastChild.lastChild.lastChild.appendChild(div9);

	var input7 = createinput('text', 'trainorg', 'e.g. CPSM');
	input7.setAttribute('id', 'trainorg-' +  rowcount);
	input7.setAttribute('onchange', 'setvalidity(this.id)');
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


//TABLE VALIDATION

function setvalidity(id) {

	var index = id.split("-");

	var title = !(document.getElementsByName('traintitle')[index[1]].value == "");
	var categ = !(document.getElementsByName('traincateg')[index[1]].value == "disitem");
	var loc = !(document.getElementsByName('location')[index[1]].value == "");
	var sd = !(document.getElementsByName('trainsdate')[index[1]].value == "");
	var st = !(document.getElementsByName('trainstime')[index[1]].value == "");
	var et = !(document.getElementsByName('trainstime')[index[1]].value == "");
	var ed = !(document.getElementsByName('trainedate')[index[1]].value == "");
	var org = !(document.getElementsByName('trainorg')[index[1]].value == "");
	//var lect = jQuery.inArray(id, lecturer[]);
	var lect;

	for(var ctr = 0 ; ctr < lecturers.length ; ctr++) {
		if(lecturers[ctr][1] == id) {
			lect = true;
			break;

		} else {
			lect = false;
		}
	};

	//console.log(title || categ || loc || sd || ed || org || lect);
	if(title || categ || loc || sd || st|| et || ed || org || lect || st || et) {

		destroy();
		tablevalidate(index[1]);
	} else {

		destroy();
		reinst();

	}//if
	


}//validatefield

// function addfield(){
// 	var sfield = document.getElementById('tempsadmin');

// 	var sdiv = creatediv('field');
// 	sfield.appendChild(sdiv);

// 	var sdiv1 = creatediv('ui radio checkbox');
// 	sfield.lastChild.appendChild(sdiv1);

// 	var sinput = document.createElement('input');
// 	sinput.setAttribute('value', '0');
// 	sinput.setAttribute('onchange', 'changeinput(this.value)');
// 	sinput.setAttribute('name', 'admintype');
// 	sinput.setAttribute('checked', 'checked');

// 	sfield.lastChild.lastChild.appendChild(sinput);
// 	sfield.lastChild.lastChild.appendChild(document.createElement('label');
// 	sfield.lastChild.lastChild.lastChild.appendChild(document.createTextNode('Superadmin'));

// }//super admin field

//NAME CARD

function addnamecard(ACtype,cardlistid, data) {

	var ilist = document.getElementById("itemlists");

	if(ACtype == 0)
	{
	var ctr=0
	var h6 = document.createElement('h6');
	h6.setAttribute('class','ui horizontal divider divtitle');

	ilist.appendChild(h6);
	if(data == null && data=="")
	{
		ilist.lastChild.appendChild(document.createTextNode('No Results'));	
	}
	else 
	{
		ilist.lastChild.appendChild(document.createTextNode('Advisory Council'));
	}

	var divscroll = document.createElement('div');
	divscroll.setAttribute('class','infinite-scroll');

	ilist.appendChild(divscroll);

	var cardlistel = document.createElement('div');
	cardlistel.setAttribute('id', cardlistid);
	cardlistel.setAttribute('class', "ui doubling grid cardlist2");

	ilist.lastChild.appendChild(cardlistel);

	responseArray = data.split("|");
                        numOfRow = responseArray[0];
                        num = 1;

                        for(i=0; i < numOfRow; i++)
                        {
                  
                            var div1 = creatediv('five1 wide column colheight');
							ilist.lastChild.lastChild.appendChild(div1);

							var div2 = creatediv('cardstyle');
							//div2.setAttribute('onclick', 'alert('+ '0-' + ID +')');
							div2.setAttribute('onclick', "loadModal('0-" + responseArray[num] +"')"); //type-id
							ilist.lastChild.lastChild.lastChild.appendChild(div2);

							var img = document.createElement('img');
							img.setAttribute('class', 'advphoto');
							pdfid.push(responseArray[num]);num++;

							if(responseArray[num+10] == null && responseArray[num+10] == "") {
								img.setAttribute('src', "{{URL::asset('objects/Logo/InitProfile.png')}}");

							} else {
								img.setAttribute('src', responseArray[num+10]);

							}//if

                            pdfimage.push(responseArray[num+10]);

							ilist.lastChild.lastChild.lastChild.lastChild.appendChild(img);

							var div3 = creatediv('advdata');
							ilist.lastChild.lastChild.lastChild.lastChild.appendChild(div3);

							var h5 = document.createElement('h5');
							h5.setAttribute('class', 'name');
							ilist.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(h5);

							ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
									  .appendChild(document.createTextNode(responseArray[num] + ", " +
									  									   responseArray[num+1] +" "+
									  									   responseArray[num+2] + "(AC)"));

                            pdffname.push(responseArray[num+1]);
                            pdfmname.push(responseArray[num+2]);
                            pdflname.push(responseArray[num]);

                            num+=3;
							
                            var p1 = document.createElement('p');
							p1.setAttribute('class', 'p1');
							ilist.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(p1);

							ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
									  .appendChild(document.createTextNode(responseArray[num+4]));

							pdfposition.push(responseArray[num+4]);

							ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
									  .appendChild(document.createElement("br"));



                            if(responseArray[num+2]!='')
                            {
                                //$office = $office4name." - ".$office3name." - ".$office2name;
                                //cell3 = responseArray[num+2] +' - ' + responseArray[num+1] +' - '+ responseArray[num];
                                ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
								.appendChild(document.createTextNode(responseArray[num+2]+','));

                                //pdftertiaryoff.push(responseArray[num+1]);

                                // pdfquaternaryoff.push(responseArray[num+2]);
                            }

                            if(responseArray[num+1]!='')
                            {
                                //$office = $office3name." - ".$office2name;
                                //cell3 = responseArray[num];num+=3;
                                //cell3 = responseArray[num+1] +' - '+ responseArray[num];
                                ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
								.appendChild(document.createTextNode(responseArray[num+1]));

								ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
		   					    .appendChild(document.createElement("br"));

                                // pdftertiaryoff.push(responseArray[num+1]);
                                
                            }

							ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
							.appendChild(document.createTextNode(responseArray[num]));

							ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
			   			    .appendChild(document.createElement("br"));
                            
                            pdfsecondoff.push(responseArray[num]);
                            pdftertiaryoff.push(responseArray[num+1]);
                            pdfquaternaryoff.push(responseArray[num+2]);
                			num+=8;

                			if(responseArray[num+2] != null) {
								ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
									  .appendChild(document.createTextNode(responseArray[num+2]));

								ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
									  .appendChild(document.createElement("br"));
							}//if


                            pdfemail.push(responseArray[num+2]);

							if(responseArray[num] != null && responseArray[num+1] != null && 
								responseArray[num] != "" && responseArray[num+1] != "") {
								ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
									  .appendChild(document.createTextNode(responseArray[num] + "/ " + responseArray[num+1]));

								ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
									  .appendChild(document.createElement("br"));

							} else {
								if(responseArray[num] != null && responseArray[num] != '') {
									ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
									  .appendChild(document.createTextNode(responseArray[num]));

									ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
									  .appendChild(document.createElement("br"));

								} else if(responseArray[num+1] != null && responseArray[num+1] != '') {
									ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
									  .appendChild(document.createTextNode(responseArray[num+1]));

									ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
									  .appendChild(document.createElement("br"));

								}//if
							}//if


                            pdfcontact.push(responseArray[num]);
                            pdflandline.push(responseArray[num+1]);
							num+=3;

							var p3 = document.createElement('p');
							p3.setAttribute('class', 'p2');
							p3.setAttribute('valign', 'bottom');
							ilist.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(p3);

							ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
									  .appendChild(document.createTextNode("Member since " + responseArray[num]));

                            pdfsdate.push(responseArray[num]);num++;
                           
                            pdfsector.push(""); 
                            pdfpoltype.push("AC");
                            pdfgender.push("");
                            pdfaddress.push("");
                            // document.getElementById('addRow').value = val;
                            // document.getElementById('addRow').click();
                          	ctr++;

         //                  	if(ctr%6==0)
         //                  	{
         //                  		while(ctr==6)
							  //   {
							  //   	document.addEventListener('scroll', function (event) {
									//     if (document.body.scrollHeight == 
									//         document.body.scrollTop +        
									//         window.innerHeight) {
									//         ctr=0;
									//     }
									// });
							  //   }
         //                  	}  

                        } 
        //ilist.lastChild.lastChild.appendChild("{{responseArray[0]->links()}}");
	}

	if(ACtype == 1)
	{

	var h6 = document.createElement('h6');
	h6.setAttribute('class','ui horizontal divider divtitle');

	ilist.appendChild(h6);
	if(data == null && data=="")
	{
		ilist.lastChild.appendChild(document.createTextNode('No Results'));	
	}
	else 
	{
		ilist.lastChild.appendChild(document.createTextNode('TWG & PSMU'));
	}

	var divscroll = document.createElement('div');
	divscroll.setAttribute('class','infinite-scroll');

	ilist.appendChild(divscroll);

	var cardlistel = document.createElement('div');
	cardlistel.setAttribute('id', cardlistid);
	cardlistel.setAttribute('class', "ui doubling grid cardlist2");

	ilist.lastChild.appendChild(cardlistel);

	responseArray = data.split("|");
                        numOfRow = responseArray[0];
                        num = 1;

                        for(i=0; i < numOfRow; i++)
                        {
                            ID = responseArray[num];num++;
                            var div1 = creatediv('five1 wide column colheight');
							ilist.lastChild.lastChild.appendChild(div1);

							var div2 = creatediv('cardstyle');
							div2.setAttribute('onclick', "loadModal('" +responseArray[num+7] + '-' + ID +"')"); //type-id
							ilist.lastChild.lastChild.lastChild.appendChild(div2);

							var img = document.createElement('img');
							img.setAttribute('class', 'advphoto');

							if(responseArray[num+10] == null && responseArray[num+10] == "") {
								img.setAttribute('src', "{{URL::asset('objects/Logo/InitProfile.png')}}");

							} else {
								img.setAttribute('src', responseArray[num+10]);

							}//if

                            pdfimage.push(responseArray[num+10]);

							ilist.lastChild.lastChild.lastChild.lastChild.appendChild(img);

							var div3 = creatediv('advdata');
							ilist.lastChild.lastChild.lastChild.lastChild.appendChild(div3);

							var h5 = document.createElement('h5');
							h5.setAttribute('class', 'name');
							ilist.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(h5);

							var poltype;
							if(responseArray[num+7]==1){poltype = "TWG";}
							else {poltype="PSMU";}
							ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
									  .appendChild(document.createTextNode(responseArray[num] + ", " +
									  									   responseArray[num+1] +" "+
									  									   responseArray[num+2] + "(" + 
									  									   poltype + ")"));

							pdfpoltype.push(responseArray[num+7]);
                            pdffname.push(responseArray[num+1]);
                            pdfmname.push(responseArray[num+2]);
                            pdflname.push(responseArray[num]);

                            num+=3;
							
                            var p1 = document.createElement('p');
							p1.setAttribute('class', 'p1');
							ilist.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(p1);

							ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
									  .appendChild(document.createTextNode(responseArray[num+3]));

							pdfposition.push(responseArray[num+3]);

							ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
									  .appendChild(document.createElement("br"));



                            if(responseArray[num+2]!='')
                            {
                                //$office = $office4name." - ".$office3name." - ".$office2name;
                                //cell3 = responseArray[num+2] +' - ' + responseArray[num+1] +' - '+ responseArray[num];
                                ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
								.appendChild(document.createTextNode(responseArray[num+2]+','));

                                //pdftertiaryoff.push(responseArray[num+1]);

                                // pdfquaternaryoff.push(responseArray[num+2]);
                            }

                            if(responseArray[num+1]!='')
                            {
                                //$office = $office3name." - ".$office2name;
                                //cell3 = responseArray[num];num+=3;
                                //cell3 = responseArray[num+1] +' - '+ responseArray[num];
                                ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
								.appendChild(document.createTextNode(responseArray[num+1]));

								ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
		   					    .appendChild(document.createElement("br"));

                                // pdftertiaryoff.push(responseArray[num+1]);
                                
                            }

							ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
							.appendChild(document.createTextNode(responseArray[num]));

							ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
			   			    .appendChild(document.createElement("br"));
                            
                            pdfsecondoff.push(responseArray[num]);
                            pdftertiaryoff.push(responseArray[num+1]);
                            pdfquaternaryoff.push(responseArray[num+2]);
                			num+=8;

                			if(responseArray[num+2] != null) {
								ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
									  .appendChild(document.createTextNode(responseArray[num+2]));

								ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
									  .appendChild(document.createElement("br"));
							}//if


                            pdfemail.push(responseArray[num+2]);

							if(responseArray[num] != null && responseArray[num+1] != null && 
								responseArray[num] != "" && responseArray[num+1] != "") {
								ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
									  .appendChild(document.createTextNode(responseArray[num] + "/ " + responseArray[num+1]));

								ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
									  .appendChild(document.createElement("br"));

							} else {
								if(responseArray[num] != null && responseArray[num] != '') {
									ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
									  .appendChild(document.createTextNode(responseArray[num]));

									ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
									  .appendChild(document.createElement("br"));

								} else if(responseArray[num+1] != null && responseArray[num+1] != '') {
									ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
									  .appendChild(document.createTextNode(responseArray[num+1]));

									ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
									  .appendChild(document.createElement("br"));

								}//if
							}//if


                            pdfcontact.push(responseArray[num]);
                            pdflandline.push(responseArray[num+1]);
							num+=3;

							var p3 = document.createElement('p');
							p3.setAttribute('class', 'p2');
							p3.setAttribute('valign', 'bottom');
							ilist.lastChild.lastChild.lastChild.lastChild.lastChild.appendChild(p3);

							ilist.lastChild.lastChild.lastChild.lastChild.lastChild.lastChild
									  .appendChild(document.createTextNode("Member since " + responseArray[num]));

                            pdfsdate.push(responseArray[num]);num++;
                           
                            pdfid.push(ID);
                            pdfsector.push(""); 
                            pdfgender.push("");
                            pdfaddress.push("");
	}
	//ilist.lastChild.lastChild.appendChild(responseArray[0]);
}//addnamecard

}


//SHOW LIST

function createlist(index, value) {
	var namelist = document.getElementsByName('namelist')[index];

	var div = creatediv('twelve wide column  bspacing8');
	namelist.appendChild(div);

	var span = document.createElement('span');
	span.setAttribute('class', 'labeldesc');
	namelist.lastChild.appendChild(span);

	namelist.lastChild.lastChild.appendChild(document.createTextNode(value));
}
