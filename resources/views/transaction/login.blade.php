<!doctype html>
<html>
<head>
<script type="text/javascript" src="{{ URL::asset('js/jquery-2.1.4.js') }}"></script>
<link href="{{ URL::asset('selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet">
<script type="text/javascript" src='{{ URL::asset("selectize/js/standalone/selectize.min.js") }}'></script>
<title>Look at me Login</title>
</head>
<body>
@if(session('message'))
	<p>{{session('message')}}</p>
@endif

<form action="login" method="POST">
	<input type="hidden" name="_token" id="csrf-token" value="{{Session::token()}}" type="text">
	<label>Username</label><input type="text" name="username">
	<br>
	<label>Password</label> <input type="password" name="password">
	<input type="submit">
</form>
<br>
<br>


<br>
<select id="searchbox" name="q" placeholder="Search Advisers or category" class="form-control"></select>
<script>
    
    var root = '{{url("/")}}';
    $(document).ready(function(){
   
    $('#searchbox').selectize({
        valueField: 'url',
        labelField: 'fname',
        searchField: ['fname','mname','lname'],
        maxOptions: 20,
        options: [],
        create: function(input){
            window.location = "searchAll?sq=" + input;


        },
        createOnBlur: false,
        render: {
            option_create: function(data, escape) {
              return '<div class="create">SELECT <strong>' + escape(data.input) + '</strong>&hellip;</div>';
            },
            option: function(item, escape) {
                if (item.imagepath == '') {
                    return '<div><img style="width:30px;height:30px;" src="'+ '{{URL::asset("objects/Logo/InitProfile.png")}}' +'"> ' +escape(item.fname) + " " + escape(item.imagepath)+ " " + escape(item.lname)+'</div>';    
                }else{
                    return '<div><img style="width:30px;height:30px;" src="'+ item.imagepath +'"> ' +escape(item.fname) + " " + escape(item.mname)+ " " + escape(item.lname)+'</div>';
                };
                
            }
        },
        optgroups: [
            {value: 'AdvisoryCouncil', label: 'Advisory Council'},
            {value: 'police', label: 'Police Advisory'}
        ],
        optgroupField: 'class',
        optgroupOrder: ['AdvisoryCouncil','police'],
        load: function(query, callback) {
            if (!query.length) return callback();
            $.ajax({
                url: 'search',
                type: 'GET',
                dataType: 'json',
                data: {
                    q: query
                },
                error: function() {
                    callback();
                },
                success: function(res) {
                    callback(res.data);
                }
            });
        },
        onChange: function(){

            window.location = this.items[0];
        }
    });
});

function reset(){
    $('#searchbox').first().selectize()[0].selectize.setValue('‌​');
}

</script>
</body>
</html>