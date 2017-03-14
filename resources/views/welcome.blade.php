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
                <select id="acselect">
                        <option value="0">Select Advisory</option>
                        <option value="1">Civillian</option>
                        <option value="2">TWG</option>
                        <option value="3">PSMU</option>
                        <option value="4">ALL</option>
                </select><br><br>
            </div>
            <div>
                <!---->
                <select id="office2" onchange="loaddata(0)">
                    <option value="0" selected>Select Second</option>
                    @foreach ($unitsecond as $unitsecond)
                        <option value="{{$unitsecond->id}}">{{$unitsecond->UnitOfficeSecondaryName}}</option>>
                    @endforeach
                    
                </select>

                <select id="office3" onchange="loaddata(0)">
                    <option value="0" selected>Select Tertiary</option> 
                    @foreach ($unittertiary as $unittertiary)
                        <option value="{{$unittertiary->id}}">{{$unittertiary->UnitOfficeTertiaryName}}</option>>
                    @endforeach
                </select>

                <select id="office4" onchange="loaddata(0)">
                    <option value="0" selected>Select Quaternary</option>
                    @foreach ($unitquaternary as $unitquaternary)
                        <option value="{{$unitquaternary->id}}">{{$unitquaternary->UnitOfficeQuaternaryName}}</option>>
                    @endforeach
                </select>

                <select id="policeposition" onchange="loaddata(0)">
                    <option value="0" selected>Select Police Position</option>
                    @foreach ($policeposition as $policeposition)
                        <option value="{{$policeposition->ID}}">{{$policeposition->PositionName}}</option>
                    @endforeach
                </select><br>

                <select id="acposition" onchange="loaddata(0)">
                    <option value="0" selected>Select AC Position</option>
                    @foreach ($advisoryposition as $advisoryposition)
                        <option value="{{$advisoryposition->ID}}">{{$advisoryposition->acpositionname}}</option>
                    @endforeach
                </select>

                <select id="acsector" onchange="loaddata(0)">
                    <option value="0" selected>Select Sector</option>
                    @foreach ($acsector as $acsector)
                        <option value="{{$acsector->ID}}">{{$acsector->sectorname}}</option>
                    @endforeach
                </select>

                <select id="gender" onchange="loaddata(0)">
                    <option value="0" selected>Select Gender</option>
                    <option value="1" >Male</option>
                    <option value="2" >Female</option>
                </select>

                <input type="text" id="city" value="" placeholder="City">
                <input type="text" id="province" value="" placeholder="Province">

                Age From:<input type="number" style="width: 45px;" onkeyup="loaddata(0)" id="ageFrom"> to <input style="width: 45px;" type="number" id="ageTo" onkeyup="loaddata(0)" ><br><br>
            
                <button id="clearRow" style="display: none;"></button>
                <button id="addRow" style="display: none;"></button>
            </div>

            <div>
            <!--<form method="post" action="createPDF"> 
                <input type="hidden" name="_token" value="{{csrf_token()}}"> -->
                <input type="hidden" id="pdfdata" name="pdfdata[]" value="">
                <button type="button" id="pdf-loader" value="1" onclick="loaddata(1)">Create PDF</button>
                
        
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
                        
                        <th>Birth Month</th>
                        <th>Contact NO</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($policeAdvisory as $polad)
                       <tr {{$polad->ID}}>
                            <td>{{$polad->lname}}, {{$polad->fname}} {{$polad->mname}}</td>
                            <td>{{$polad->second_id}},{{$polad->tertiary_id}},{{$polad->quaternary_id}}</td>
                            <td>PNP</td>
                            <td>{{$polad->police_position_id}}</td>
                            <td>{{$polad->gender}}</td>
                            <td>{{$polad->city}}, {{$polad->province}}</td>
                            <td>{{$polad->birthdate}}</td>
                            <td>{{$polad->contactno}}</td>
                            <td>{{$polad->email}}</td>
                        </tr>
                    @endforeach

                    @foreach ($advisoryCouncil as $adco)
                       <tr {{$adco->ID}}>
                            <td>{{$adco->lname}}, {{$adco->fname}} {{$adco->mname}}</td>
                            <td>{{$adco->second_id}},{{$adco->tertiary_id}},{{$adco->quaternary_id}}</td>
                            <td>{{$adco->ac_sector_id}}</td>
                            <td>{{$adco->advisory_position_id}}</td>
                            <td>{{$adco->gender}}</td>
                            <td>{{$adco->city}}, {{$adco->province}}</td>
                            <td>{{$adco->birthdate}}</td>
                            <td>{{$adco->contactno}}</td>
                            <td>{{$adco->email}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </body>

    <script>
        $(document).ready(function() {
            var tab = $('#datatables').DataTable({
                responsive: true
            });

            $('#clearRow').on('click', function(array){
                tab.clear().draw();
            });

            $('#addRow').on('click', function(array){
               
                var array = $(this).attr('value').split("/");
                console.log(array);

                tab.row.add([
                    array[0],
                    array[1],
                    array[2],
                    array[3],
                    array[4],
                    array[5],
                    array[6],
                    array[7],
                    array[8]

                ]).draw();

            });
        });//document ready function
    </script>
    
    <script>

        function loaddata(loader){
            var advisory = document.getElementById('acselect').value;
            var data;
            ageFrom = document.getElementById('ageFrom').value;
            ageTo = document.getElementById('ageTo').value;
            city = document.getElementById('city').value;
            province = document.getElementById('province').value;
            gender = document.getElementById('gender').value;
            unitofficesecond = document.getElementById('office2').value;

            if(advisory==1)
            {
                data = {
                    'callid' : 1,   
                    'dlpdf' : loader,
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
                    'dlpdf' : loader,
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

            document.getElementById('clearRow').click();

            $.ajax({
                type: "POST",
                data: data,
                url: "{{url('load-pdf-data')}}",
                datatype: "JSON",
                success: function(data){
                    console.log(data);

                    if(loader == 1){

                        return;
                    }

                    if(advisory==1)
                    {
                        for(var i=0;i<data.length;i++)
                        {
                            cell1 = data[i]['lname']+", "+data[i]['fname']+" "+data[i]['mname'];
                            cell2 = data[i]['second_id'];
                            cell3 = data[i]['ac_sector_id'];
                            cell4 = data[i]['advisory_position_id'];
                            cell5 = data[i]['gender'];
                            cell6 = data[i]['city']+", "+data[i]['province'];
                            cell7 = data[i]['birthdate'];
                            cell8 = data[i]['contactno'];
                            cell9 = data[i]['email'];

                            val = cell1 + "/" + cell2 + "/" + cell3 + "/" + cell4 + "/" +
                                  cell5 + "/" + cell6 + "/" + cell7 + "/" + cell8 + "/" + cell9; 
                            
                           // document.getElementById('pdfdata').value = val;
                            document.getElementById('addRow').value = val; 
                            document.getElementById('addRow').click();
                        }
                    }

                    if(advisory==2 || advisory==3)
                    {
                        for(var i=0;i<data.length;i++)
                        {
                            cell1 = data[i]['lname']+", "+data[i]['fname']+" "+data[i]['mname'];
                            cell2 = data[i]['second_id']+", "+data[i]['tertiary_id']+", "+data[i]['quaternary_id'];
                            cell3 = "PNP";
                            cell4 = data[i]['police_position_id'];
                            cell5 = data[i]['gender'];
                            cell6 = data[i]['city']+", "+data[i]['province'];
                            cell7 = data[i]['birthdate'];
                            cell8 = data[i]['contactno'];
                            cell9 = data[i]['email'];

                            val = cell1 + "/" + cell2 + "/" + cell3 + "/" + cell4 + "/" +
                                  cell5 + "/" + cell6 + "/" + cell7 + "/" + cell8 + "/" + cell9;
                            
                            //document.getElementById('pdfdata').value = val;
                            document.getElementById('addRow').value = val;
                            document.getElementById('addRow').click();

                        }       
                    }
                 
                }
            });
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

    </script>

</html>
