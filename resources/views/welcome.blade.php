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
            <input type="radio" name="acselect" value="0">
            <label for="advisoryCouncil">Advisory Councill</label><br>
            <input type="radio" name="acselect" value="1">
            <label for="twg">TWG</label><br>
            <input type="radio" name="acselect" value="2">
            <label for="psmu">PSMU</label><br><br>
        </div>
        <div>
            <!---->
            <select id="office1">
                <option value="0" selected>Select Prime</option>
                
            </select>

            <select id="office2">
                <option value="0" selected>Select Second</option> 
            </select>

            <select id="office3">
                <option value="0" selected>Select Tertiary</option>
            </select><br>

            <select id="sector">
                <option value="0" selected>Select Sector</option>
            </select>

            <select id="gender">
                <option value="0" selected>Select Gender</option>
            </select>

            <select id="location">
                <option value="0" selected>Select Location</option>
            </select>

            <select id="age">
                <option value="0" selected>Select Age</option>
            </select>

            <select id="birthmonth">
                <option value="0" selected>Select BirthMonth</option>
            </select><br><br>
            
            <form method="post" action="createPDF">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                
                <button type="submit" name="submit" target="_blank">Create PDF</button>
                
            </form><br><br>
        
        </div>

        <div >
            <table id="datatable" class="ui celled table" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Office 1</th>
                        <th>Office 1</th>
                        <th>Office 1</th>
                        <th>Sector</th>
                        <th>Gender</th>
                        <th>Location</th>
                        <th>Age</th>
                        <th>Birth Month</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </body>

    <script type="text/javascript">
        

    </script>

</html>
