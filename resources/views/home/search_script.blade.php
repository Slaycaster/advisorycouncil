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
		        window.location = "/search?sq=" + input;


			},
			createOnBlur: false,
				render: {
					        option_create: function(data, escape) {
						        return '<div class="create">Typing <strong>' + escape(data.input) + '</strong>&hellip;</div>';
						    },
						    option: function(item, escape) {
						        if (item.imagepath == null) {
				                    return '<div><div class="imgcon"><img class="dropphoto" src="{{URL::asset('objects/Logo/InitProfile.png')}}"></div>&nbsp;<label class="dropname">' +escape(item.fname) + " " + escape(item.mname)+ " " + escape(item.lname)+'</label></div>';    
				                }else{
				                   return '<div><div class="imgcon"><img class="dropphoto" src="{!!URL::asset("' + item.imagepath + '")!!}"></div>&nbsp;<label class="dropname">' +escape(item.fname) + " " + escape(item.mname)+ " " + escape(item.lname)+'</label></div>';    
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
						               	url: "{{url('loadsuggestion')}}",
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
