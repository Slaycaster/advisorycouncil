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
                <input type="hidden" name="office" value="">
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
                        <th>Name</th>
                        <th>Office</th>
                        <th>Sector</th>
                        <th>Position</th>
                        <th>Gender</th>
                        <th>Location</th>
                        <th>ImagePath</th>
                        <th>Contact NO</th>
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
                    array[9]

                ]).draw();

            });
        });//document ready function
    </script>
    
    <script>

        function adjustRange(val)
        {
          document.getElementById('ageTo').value = val;
          loaddata();
        }
        
        function loaddata(){
            
            pdfname = [];
            pdfsecondoff = [];
            pdftertiaryoff = [];
            pdfquaternaryoff = [];
            pdfsector = [];
            pdfaddress = [];
            pdfposition = [];
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

            $.ajax({
                type: "POST",
                data: data,
                url: "{{url('load-pdf-data')}}",
                datatype: "JSON",
                success: function(data){
                    
                    document.getElementById('clearRow').click();
                    
                    if(advisory==1)
                    {
                        responseArray = data.split("/");
                        numOfRow = responseArray[0];
                        num = 1;

                        for(i=0; i < numOfRow; i++)
                        {
                            cell1 = responseArray[num];num++;
                            cell2 = responseArray[num];num++;
                            cell3 = responseArray[num];num++;
                            cell4 = responseArray[num];num++;
                            cell5 = responseArray[num];num++;
                            cell6 = responseArray[num];num++;
                            cell7 = responseArray[num];num++;
                            cell8 = responseArray[num];num++;
                            cell9 = responseArray[num];num++;
                            cell10 = responseArray[num];num++;

                            val = cell1 + "/" + cell2 + "/" + cell3 + "/" + cell4 + "/" +
                                  cell5 + "/" + cell6 + "/" + cell7 + "/" + cell8 + "/" +
                                  cell9 + "/" + cell10;

                            pdfname.push(cell1);
                            pdfsecondoff.push(cell2);
                            pdfsector.push(cell3); 
                            pdfposition.push(cell4);
                            pdfgender.push(cell5);
                            pdfaddress.push(cell6);
                            pdfimage.push(cell7);
                            pdfcontact.push(cell8);
                            pdfemail.push(cell9);
                            pdfsdate.push(cell10);

                            document.getElementById('addRow').value = val;
                            document.getElementById('addRow').click();
                            
                        }      

                    }

                    if(advisory==2 || advisory==3)
                    {
 
                        responseArray = data.split("/");
                        numOfRow = responseArray[0];
                        num = 1;

                        for(i=0; i < numOfRow; i++)
                        {
                            cell1 = responseArray[num];num++;
                            cell2 = responseArray[num];num++;
                            cell3 = "PNP";
                            cell4 = responseArray[num];num++;
                            cell5 = responseArray[num];num++;
                            cell6 = responseArray[num];num++;
                            cell7 = responseArray[num];num++;
                            cell8 = responseArray[num];num++;
                            cell9 = responseArray[num];num++;
                            cell10 = responseArray[num];num++;

                            val = cell1 + "/" + cell2 + "/" + cell3 + "/" + cell4 + "/" +
                                  cell5 + "/" + cell6 + "/" + cell7 + "/" + cell8 + "/" +
                                  cell9 + "/" + cell10;

                            pdfname.push(cell1);
                            pdfsecondoff.push(cell2);
                            pdfsector.push(""); 
                            pdfposition.push(cell4);
                            pdfgender.push(cell5);
                            pdfaddress.push(cell6);
                            pdfimage.push(cell7);
                            pdfcontact.push(cell8);
                            pdfemail.push(cell9);
                            pdfsdate.push(cell10);

                            document.getElementById('addRow').value = val;
                            document.getElementById('addRow').click();

                            
                        }
                          
                    }

                    if(advisory==4)
                    {

                        if(data[1]!='' && data[1]!=null && data[1]!=0)
                        {
                            responseArray = data[1].split("/");
                            numOfRow = responseArray[0];
                            num = 1;

                            for(i=0; i < numOfRow; i++)
                            {
                                cell1 = responseArray[num];num++;
                                cell2 = responseArray[num];num++;
                                cell3 = responseArray[num];num++;
                                cell4 = responseArray[num];num++;
                                cell5 = responseArray[num];num++;
                                cell6 = responseArray[num];num++;
                                cell7 = responseArray[num];num++;
                                cell8 = responseArray[num];num++;
                                cell9 = responseArray[num];num++;
                                cell10 = responseArray[num];num++;

                                val = cell1 + "/" + cell2 + "/" + cell3 + "/" + cell4 + "/" +
                                      cell5 + "/" + cell6 + "/" + cell7 + "/" + cell8 + "/" +
                                      cell9 + "/" + cell10;

                                pdfname.push(cell1);
                                pdfsecondoff.push(cell2);
                                pdfsector.push(cell3); 
                                pdfposition.push(cell4);
                                pdfgender.push(cell5);
                                pdfaddress.push(cell6);
                                pdfimage.push(cell7);
                                pdfcontact.push(cell8);
                                pdfemail.push(cell9);
                                pdfsdate.push(cell10);

                                document.getElementById('addRow').value = val;
                                document.getElementById('addRow').click();
                                
                            }
                        }

                        if(data[0]!='' && data[0]!=null && data[0]!=0)
                        {
                            responseArray = data[0].split("/");
                            numOfRow = responseArray[0];
                            num = 1;

                            for(i=0; i < numOfRow; i++)
                            {
                                cell1 = responseArray[num];num++;
                                cell2 = responseArray[num];num++;
                                cell3 = "PNP";
                                cell4 = responseArray[num];num++;
                                cell5 = responseArray[num];num++;
                                cell6 = responseArray[num];num++;
                                cell7 = responseArray[num];num++;
                                cell8 = responseArray[num];num++;
                                cell9 = responseArray[num];num++;
                                cell10 = responseArray[num];num++;

                                val = cell1 + "/" + cell2 + "/" + cell3 + "/" + cell4 + "/" +
                                      cell5 + "/" + cell6 + "/" + cell7 + "/" + cell8 + "/" +
                                      cell9 + "/" + cell10;

                                pdfname.push(cell1);
                                pdfsecondoff.push(cell2);
                                pdfsector.push(""); 
                                pdfposition.push(cell4);
                                pdfgender.push(cell5);
                                pdfaddress.push(cell6);
                                pdfimage.push(cell7);
                                pdfcontact.push(cell8);
                                pdfemail.push(cell9);
                                pdfsdate.push(cell10);

                                document.getElementById('addRow').value = val;
                                document.getElementById('addRow').click();
                            }
                        }

                     }   
                            document.getElementsByName('name')[0].value = pdfname.join("/");
                            document.getElementsByName('office')[0].value = pdfsecondoff;
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
        
        function removeDropdown(){
                if(document.getElementById('acselect').value == 0){
                    document.getElementById('office1').style.display = 'hidden';
                    document.getElementById('office2').style.display = 'hidden'; 
                    document.getElementById('office3').style.display = 'hidden';
                    document.getElementById('sector').style.display = 'block';         
                }
                else if(document.getElementById('acselect').value == 1 || document.getElementById('acselect').value == 2){

                    document.getElementById('office1').style.display = 'block';
                    document.getElementById('office2').style.display = 'block'; 
                    document.getElementById('office3').style.display = 'block';
                    document.getElementById('sector').style.display = 'hidden';
                }
        }
        // for(var i=0;i<data.length;i++)
        //                 {
        //                     cell1 = data[i]['lname']+", "+data[i]['fname']+" "+data[i]['mname'];
        //                     cell2 = data[i]['UnitOfficeSecondaryName'];
        //                     cell3 = data[i]['sectorname'];
        //                     cell4 = data[i]['acpositionname'];
        //                     cell5 = data[i]['gender'];
        //                     cell6 = data[i]['city']+", "+data[i]['province'];
        //                     cell7 = data[i]['birthdate'];
        //                     cell8 = data[i]['contactno'];
        //                     cell9 = data[i]['email'];

        //                     val = cell1 + "/" + cell2 + "/" + cell3 + "/" + cell4 + "/" +
        //                           cell5 + "/" + cell6 + "/" + cell7 + "/" + cell8 + "/" + cell9; 

        //                     pdfname.push(cell1);
        //                     pdfsecondoff.push(data[i]['UnitOfficeSecondaryName']);
        //                     pdftertiaryoff.push(data[i]['UnitOfficeTertiaryName']);
        //                     pdfquaternaryoff.push(data[i]['UnitOfficeQuaternaryName']);
        //                     pdfgender.push(data[i]['gender']);
        //                     pdfposition.push(data[i]['acpositionname']);
        //                     pdfemail.push(data[i]['email']);
        //                     pdfcontact.push(data[i]['contactno']);
        //                     pdfaddress.push(cell6);
        //                     pdfsector.push(data[i]['sectorname']);
        //                     pdfimage.push(data[i]['imagepath']);
                         

         // for(var i=0;i<data.length;i++)
                        // {
                        //     cell1 = data[i]['lname']+", "+data[i]['fname']+" "+data[i]['mname'];
                        //     cell2 = data[i]['UnitOfficeSecondaryName']+", "+data[i]['UnitOfficeTertiaryName']+", "+data[i]['UnitOfficeQuaternaryName'];
                        //     cell3 = "PNP";
                        //     cell4 = data[i]['PositionName'];
                        //     cell5 = data[i]['gender'];
                        //     cell6 = data[i]['city']+", "+data[i]['province'];
                        //     cell7 = data[i]['birthdate'];
                        //     cell8 = data[i]['contactno'];
                        //     cell9 = data[i]['email'];

                        //     val = cell1 + "/" + cell2 + "/" + cell3 + "/" + cell4 + "/" +
                        //           cell5 + "/" + cell6 + "/" + cell7 + "/" + cell8 + "/" + cell9;
                            

                        //     pdfname.push(cell1);
                        //     pdfsecondoff.push(data[i]['UnitOfficeSecondaryName']);
                        //     pdftertiaryoff.push(data[i]['UnitOfficeTertiaryName']);
                        //     pdfquaternaryoff.push(data[i]['UnitOfficeQuaternaryName']);
                        //     pdfgender.push(data[i]['gender']);
                        //     pdfposition.push(data[i]['PositionName']);
                        //     pdfemail.push(data[i]['email']);
                        //     pdfcontact.push(data[i]['contactno']);
                        //     pdfaddress.push(cell6);
                        //     pdfsector.push("");  
                        //     pdfimage.push(data[i]['imagepath']);

                        //     //document.getElementById('pdfdata').value= val + val;
                        //     document.getElementById('addRow').value = val;
                        //     document.getElementById('addRow').click();

                        // }
    </script>

</html>
