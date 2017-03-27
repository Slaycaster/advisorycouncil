<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,height=device-height, initial-scale=1, maximum-scale=1,user-scalable=yes">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <link rel="shortcut icon" type="image/png" href="{{URL::asset('images/Philippine-National-Police.png')}}"> <!--LOGO-->

        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/semantic.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/stylev1.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/icon.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/toast.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/multipletextinput.css')}}">
        <!--<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/res.css')}}">-->

        <!-- JS -->
        <script type="text/javascript" src="{{ URL::asset('js/jquery-2.1.4.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/semantic.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/initialization.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/toast.js') }}"></script>


        <!--Data Table plugins and design-->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/datatable/dataTables.semanticui.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/datatable/responsive.semanticui.min.css')}}">

        <script type="text/javascript" src="{{ URL::asset('js/datatable/jquery.dataTables.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/datatable/dataTables.semanticui.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/datatable/dataTables.responsive.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/datatable/responsive.semanticui.min.js') }}"></script>
    </head>

    <body onload = "init()" class = "phbdy">

    <div>
        
            <div>            
                <select id="acselect" onchange="loaddata()">
                        <option value="1">Civillian</option>
                        <option value="2">TWG</option>
                        <option value="3">PSMU</option>
                        <option value="4" selected>ALL</option>
                </select><br><br>
            </div>
            <div>
                <!---->
                <select id="office2" onchange="loaddata()">
                    <option value="0" selected>Select Second</option>
                    @foreach ($unitsecond as $unitsecond)
                        <option value="{{$unitsecond->id}}">{{$unitsecond->UnitOfficeSecondaryName}}</option>>
                    @endforeach
                    
                </select>

                <select id="office3" onchange="loaddata()">
                    <option value="0" selected>Select Tertiary</option> 
                    @foreach ($unittertiary as $unittertiary)
                        <option value="{{$unittertiary->id}}">{{$unittertiary->UnitOfficeTertiaryName}}</option>>
                    @endforeach
                </select>

                <select id="office4" onchange="loaddata()">
                    <option value="0" selected>Select Quaternary</option>
                    @foreach ($unitquaternary as $unitquaternary)
                        <option value="{{$unitquaternary->id}}">{{$unitquaternary->UnitOfficeQuaternaryName}}</option>>
                    @endforeach
                </select>

                <select id="policeposition" onchange="loaddata()">
                    <option value="0" selected>Select Police Position</option>
                    @foreach ($policeposition as $policeposition)
                        <option value="{{$policeposition->ID}}">{{$policeposition->PositionName}}</option>
                    @endforeach
                </select><br>

                <select id="acposition" onchange="loaddata()">
                    <option value="0" selected>Select AC Position</option>
                    @foreach ($advisoryposition as $advisoryposition)
                        <option value="{{$advisoryposition->ID}}">{{$advisoryposition->acpositionname}}</option>
                    @endforeach
                </select>

                <select id="acsector" onchange="loaddata()">
                    <option value="0" selected>Select Sector</option>
                    @foreach ($acsector as $acsector)
                        <option value="{{$acsector->ID}}">{{$acsector->sectorname}}</option>
                    @endforeach
                </select>

                Gender: <input type="checkbox" id="genderM" onclick="loaddata()" name="gender" value="0">Male
                        <input type="checkbox" id="genderF" onclick="loaddata()" name="gender" value="1">Female

                <input type="text" onkeyup="loaddata()" id="city" value="" placeholder="City">
                <input type="text" onkeyup="loaddata()" id="province" value="" placeholder="Province">

                Age From:<input type="number" style="width: 45px;" onkeyup="adjustRange(this.value)" id="ageFrom"> to <input style="width: 45px;" type="number" id="ageTo" onkeyup="loaddata()" ><br><br>
            
                <button id="clearRow" style="display: none;"></button>
                <button id="addRow" style="display: none;"></button>
            </div>

            <div>
            <form method="post" action="createPDF" target="_blank"> 
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="name" value="">
                <input type="hidden" name="position" value="">
                <input type="hidden" name="office2" value="">
                <input type="hidden" name="office3" value="">
                <input type="hidden" name="office4" value="">
                <input type="hidden" name="poltype" value="">
                <input type="hidden" name="landline" value="">
                <input type="hidden" name="address" value="">
                <input type="hidden" name="contact" value="">
                <input type="hidden" name="email" value="">
                <input type="hidden" name="gender" value="">
                <input type="hidden" name="sector" value="">
                <input type="hidden" name="imageurl" value="">
                <input type="hidden" name="startdate" value="">

                <button type="submit" name="submit" id="pdf-loader" value="1">Create PDF</button>
                
            </form>
            </div>
        
    </div>

        


        <div >
            <table id="datatables" class="ui celled table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Office</th>
                        <th>Sector</th>
                        <th>Position</th>
                        <th>Police Type</th>
                        <th>Gender</th>
                        <th>Location</th>
                        <th>ImagePath</th>
                        <th>Contact NO</th>
                        <th>Landline</th>
                        <th>Email</th>
                        <th>Start Date</th>
                    </tr>

                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>

    </body>

    <script>
        $(document).ready(function() {
            var tab = $('#datatables').DataTable({
                responsive: true
            });

            loaddata();

            $('#clearRow').on('click', function(array){
                tab.clear().draw();
            });

            $('#addRow').on('click', function(array){
               
                var array = $(this).attr('value').split("/");
                
               tab.row.add([
                    array[0],
                    array[1],
                    array[2],
                    array[3],
                    array[4],
                    array[5],
                    array[6],
                    array[7],
                    array[8],
                    array[9],
                    array[10],
                    array[11],
                    array[12]

                ]).draw();
            //console.log(array);

            });
        });//document ready function
    </script>
    
    <script>
            var pdfid=[];
            var pdfname = [];
            var pdfsecondoff = [];
            var pdftertiaryoff = [];
            var pdfquaternaryoff = [];
            var pdfsector = [];
            var pdfaddress = [];
            var pdfposition = [];
            var pdfpoltype = [];
            var pdflandline = [];
            var pdfemail = [];
            var pdfgender = [];
            var pdfbday = [];
            var pdfcontact = [];
            var pdfimage = [];
            var pdfsdate = [];
    


        function adjustRange(val)
        {
          document.getElementById('ageTo').value = val;
          loaddata();
        }
        
        function loaddata(){
            
            pdfid=[];
            pdfname = [];
            pdfsecondoff = [];
            pdftertiaryoff = [];
            pdfquaternaryoff = [];
            pdfsector = [];
            pdfaddress = [];
            pdfposition = [];
            pdfpoltype = [];
            pdflandline = [];
            pdfemail = [];
            pdfgender = [];
            pdfbday = [];
            pdfcontact = [];
            pdfimage = [];
            pdfsdate = [];
    
            var advisory = document.getElementById('acselect').value;
            var data;
            var gender;
            ageFrom = document.getElementById('ageFrom').value;
            ageTo = document.getElementById('ageTo').value;
            city = document.getElementById('city').value;
            province = document.getElementById('province').value;
            unitofficesecond = document.getElementById('office2').value;

            if(document.getElementById('genderM').checked == true && document.getElementById('genderF').checked == true)
                { gender = 0;}
            else if(document.getElementById('genderM').checked == true && document.getElementById('genderF').checked == false)
                { gender = 1; }
            else if(document.getElementById('genderM').checked == false && document.getElementById('genderF').checked == true) 
                { gender = 2; }
            else { gender = 0; }

            if(advisory==1)
            {
                data = {
                    'callid' : 1,   
                    'office2' : unitofficesecond,
                    'sector' : document.getElementById('acsector').value,
                    'civposition' : document.getElementById('acposition').value,
                    'ageFrom' : ageFrom,
                    'ageTo' : ageTo,
                    'city' : city,
                    'province' : province,
                    'gender' : gender,
                    '_token' : '{{ Session::token() }}'
                };    
            }

            else if(advisory==2 || advisory==3)
            {   
                data = {
                    'callid' : 2,
                    'advisory' : advisory-1,
                    'office2' : unitofficesecond,
                    'office3' : document.getElementById('office3').value,
                    'office4' : document.getElementById('office4').value,
                    'polposition' : document.getElementById('policeposition').value,
                    'ageFrom' : ageFrom,
                    'ageTo' : ageTo,
                    'city' : city,
                    'province' : province,
                    'gender' : gender,
                    '_token' : '{{ Session::token() }}'
                };
            }

            else if(advisory==4)
            {
                data = {
                    'callid' : 3,
                    'office2' : unitofficesecond,
                    'advisory' : 0,
                    'office3' : document.getElementById('office3').value,
                    'office4' : document.getElementById('office4').value,
                    'ageFrom' : ageFrom,
                    'ageTo' : ageTo,
                    'city' : city,
                    'province' : province,
                    'gender' : gender,
                    '_token' : '{{ Session::token() }}'
                };   
            }
            console.log(data);

            $.ajax({
                type: "POST",
                data: data,
                url: "{{url('load-pdf-data')}}",
                datatype: "JSON",
                success: function(data){
                    
                    document.getElementById('clearRow').click();
                    console.log(data);
                    
                    if(advisory==1)
                    {
                        loadAC(data);      
                    }

                    if(advisory==2 || advisory==3)
                    {
                        loadPolAd(data);
                    }

                    if(advisory==4)
                    {

                        if(data[0]!='' && data[0]!=null && data[0]!=0)
                        {
                            loadAC(data[0]);
                        }

                        if(data[1]!='' && data[1]!=null && data[1]!=0)
                        {
                            loadPolAd(data[1]);
                        }

                     }   
                            document.getElementsByName('name')[0].value = pdfname.join("/");
                            document.getElementsByName('office2')[0].value = pdfsecondoff;
                            document.getElementsByName('office3')[0].value = pdftertiaryoff;
                            document.getElementsByName('office4')[0].value = pdfquaternaryoff;
                            document.getElementsByName('poltype')[0].value = pdfpoltype;
                            document.getElementsByName('landline')[0].value = pdflandline;
                            document.getElementsByName('gender')[0].value = pdfgender;
                            document.getElementsByName('position')[0].value = pdfposition;
                            document.getElementsByName('email')[0].value = pdfemail;
                            document.getElementsByName('contact')[0].value = pdfcontact;
                            document.getElementsByName('address')[0].value = pdfaddress;
                            document.getElementsByName('sector')[0].value = pdfsector;
                            document.getElementsByName('imageurl')[0].value = pdfimage; 
                            document.getElementsByName('startdate')[0].value = pdfsdate;

                }

            });//AJAX
        }// LOAD DATA

        function loadAC(data)
        {
            responseArray = data.split("/");
                        numOfRow = responseArray[0];
                        num = 1;

                        for(i=0; i < numOfRow; i++)
                        {
                            cell1 = responseArray[num];num++;
                            cell2 = responseArray[num];num++;
                            
                            if(responseArray[num+1]!='' && responseArray[num+2]!='')
                            {
                                //$office = $office4name." - ".$office3name." - ".$office2name;
                                cell3 = responseArray[num+2] +' - ' + responseArray[num+1] +' - '+ responseArray[num];
                                pdftertiaryoff.push(responseArray[num+1]);
                                pdfquaternaryoff.push(responseArray[num+2]);
                            }

                            if(responseArray[num+1]!='' && responseArray[num+2]=='')
                            {
                                //$office = $office3name." - ".$office2name;
                                //cell3 = responseArray[num];num+=3;
                                cell3 = responseArray[num+1] +' - '+ responseArray[num];
                                pdftertiaryoff.push(responseArray[num+1]);
                                pdfquaternaryoff.push("");
                            }

                            if(responseArray[num+1]=='' && responseArray[num+2]=='')
                            {
                              //  $office = $office2name;
                                cell3 = responseArray[num];
                                pdftertiaryoff.push("");
                                pdfquaternaryoff.push("");
                            
                            }

                            pdfsecondoff.push(responseArray[num]);

                            num+=3;

                            //cell3 = responseArray[num];num+=3;
                            
                            cell4 = responseArray[num];num++;
                            cell5 = responseArray[num];num++;
                            cell6 = "AC";
                            cell7 = responseArray[num];num++;
                            cell8 = responseArray[num];num++;
                            cell9 = responseArray[num];num++;
                            cell10 = responseArray[num];num++;
                            cell11 = responseArray[num];num++;
                            cell12 = responseArray[num];num++;
                            cell13 = responseArray[num];num++;

                            val = cell1 + "/" + cell2 + "/" + cell3 + "/" + cell4 + "/" +
                                  cell5 + "/" + cell6 + "/" + cell7 + "/" + cell8 + "/" +
                                  cell9 + "/" + cell10 + "/" + cell11 + "/" + cell12 + "/" + cell13;

                            pdfid.push(cell1);
                            pdfname.push(cell2);
                            pdfsector.push(cell4); 
                            pdfposition.push(cell5);
                            pdfpoltype.push(cell6);
                            pdfgender.push(cell7);
                            pdfaddress.push(cell8);
                            pdfimage.push(cell9);
                            pdfcontact.push(cell10);
                            pdflandline.push(cell11);
                            pdfemail.push(cell12);
                            pdfsdate.push(cell13);
                            document.getElementById('addRow').value = val;
                            document.getElementById('addRow').click();
                            
                        }
        }

        function loadPolAd(data)
        {
            responseArray = data.split("/");
                        numOfRow = responseArray[0];
                        num = 1;

                        for(i=0; i < numOfRow; i++)
                        {
                            cell1 = responseArray[num];num++;
                            cell2 = responseArray[num];num++;
                            
                            if(responseArray[num+1]!='' && responseArray[num+2]!='')
                            {
                                //$office = $office4name." - ".$office3name." - ".$office2name;
                                cell3 = responseArray[num+2] +' - ' + responseArray[num+1] +' - '+ responseArray[num];
                                pdftertiaryoff.push(responseArray[num+1]);
                                pdfquaternaryoff.push(responseArray[num+2]);
                            
                            }

                            if(responseArray[num+1]!='' && responseArray[num+2]=='')
                            {
                                //$office = $office3name." - ".$office2name;
                                //cell3 = responseArray[num];num+=3;
                                cell3 = responseArray[num+1] +' - '+ responseArray[num];
                                pdftertiaryoff.push(responseArray[num+1]);
                                pdfquaternaryoff.push("");
                            }

                            if(responseArray[num+1]=='' && responseArray[num+2]=='')
                            {
                              //  $office = $office2name;
                              cell3 = responseArray[num];
                              pdftertiaryoff.push("");
                              pdfquaternaryoff.push("");
                            
                            }

                            pdfsecondoff.push(responseArray[num]);
                            pdftertiaryoff.push(responseArray[num+1]);
                            pdfquaternaryoff.push(responseArray[num+2]);

                            num+=3;

                            //cell3 = responseArray[num];num+=3;
                            cell4 = "PNP";
                            cell5 = responseArray[num];num++;
                            cell6 = responseArray[num];num++;
                            cell7 = responseArray[num];num++;
                            cell8 = responseArray[num];num++;
                            cell9 = responseArray[num];num++;
                            cell10 = responseArray[num];num++;
                            cell11 = responseArray[num];num++;
                            cell12 = responseArray[num];num++;
                            cell13 = responseArray[num];num++;


                            val = cell1 + "/" + cell2 + "/" + cell3 + "/" + cell4 + "/" +
                                  cell5 + "/" + cell6 + "/" + cell7 + "/" + cell8 + "/" +
                                  cell9 + "/" + cell10 + "/" + cell11 + "/" + cell12 + "/" + cell13;

                            pdfid.push(cell1);
                            pdfname.push(cell2);
                            pdfsector.push(""); 
                            pdfposition.push(cell5);
                            if(cell6==1)
                                { pdfpoltype.push("TWG"); }
                            else { pdfpoltype.push("PSMU"); }
                            pdfgender.push(cell7);
                            pdfaddress.push(cell8);
                            pdfimage.push(cell9);
                            pdfcontact.push(cell10);
                            pdflandline.push(cell11);
                            pdfemail.push(cell12);
                            pdfsdate.push(cell13);

                            document.getElementById('addRow').value = val;
                            document.getElementById('addRow').click();

                            
                        }
        }

    </script>

</html>

