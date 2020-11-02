
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4">
			
		</div>
		<div class="col-md-4">
		
			<h4 style="text-align: center;">Myelination</h4>
			
			
			
			<!-- Button trigger modal -->
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModalId">
  				new
			</button>
			
			<?php
				$timestamp = time();
				$timezone = date_default_timezone_get();
				//date_default_timezone_set('Ulaanbaatar');
						//echo(date("Y-m-d h:i:s",time()));
				//echo(mktime(0,0,0,5,31,2021));
				//echo $timezone;
				$start_date  = new DateTime('2020-09-17 06:42:00');
				//$since_start = $start_date->diff(new DateTime('2020-09-16 10:03:50'));
				$since_start = $start_date->diff(new DateTime(date("Y-m-d h:i:s",time())));
				$daysTotal = $since_start->days;
				$year = $since_start->y;
				$month = $since_start->m;
				$day = $since_start->d;
				$hour = $since_start->h;
				$minute = $since_start->i;
				$seconds = $since_start->s;
				$minutesLeft = (25-$minute);
						
			?>

			<?php
				$target = mktime(0,0,0,5,31,2021);//this is altered to be exact.255 days as of 09-17-2020
				$today = time();
				$timeLeft = ($target-$today);
				$days = (int) ($timeLeft/86400);
						echo "<h6 style=><strong>I have ".$days." days. <strong></h6><div id = 'timer_id'></div>";
			?>

			<div id = "taskList_id"></div>
			
		</div>
		<div class="col-md-4">
			
		</div>
	</div> 
</div>



<!-- Add Modal -->
<div class="modal fade" id="addModalId" tabindex="-1" role="dialog" aria-labelledby="AddModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="addModalLongTitle">Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>s


      <div class="modal-body">
	 
	  	<textarea class = "form-control" placeholder = "task" id = "task_id"></textarea>
		  <br>
		  <textarea class = "form-control" placeholder = "remarks" id = "remarks_id"></textarea>
		  <br><input type = "number" id = "taskSession_id" class="form-control" placeholder="session">

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning" id = "saved_id">Save</button>
      </div>


    </div>
  </div>
</div>
<!-- End add modal -->


<!-- Edit Modal -->
<div class="modal fade" id="updateModalId" tabindex="-1" role="dialog" aria-labelledby="editModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLongTitle">Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <textarea class = "form-control" placeholder = "task" id = "taskUpdate_id"></textarea>
		  <br>
		  <textarea class = "form-control" placeholder = "remarks" id = "remarksUpdate_id"></textarea>
		  <br><input type = "number" id = "taskSessionUpdate_id" class="form-control" placeholder="session">
		  <input type = "hidden" id  = "taskId">
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-warning" id = "updateChanges_id">Save Changes</button>
		
      </div>
    </div>
  </div>
</div>
<!-- End edit modal -->

<script>
	$(document).ready(function(){
		
		var x, secs = 600;
		//x = setInterval(myTimer,1000);
		task = [""];
		remarks = [""];
		sessions = [""];
		taskId = [""];

		function myTimer(){
			$('#timer_id').html(secs);
			secs--;
			if(secs==0){
				clearInterval(x);
			}
		}


	//-----------------------------end ----------------------------


	


		function callBackDelete(i){
			
				//console.log(i);
				$.ajax({
					url:'data/home/myelination_data.php',
					method:'POST',
					dataType:"text",
					data:{action:'delete',id:i},
					success:function(data){
						console.log(data+'delete id');
						getDataRows();
						
						
					},
					error:function(xhr,status,error){
						console.log(xhr);
						console.log(status);
						console.log(error);
					}
				});


			//}
			
		}


		function callBackUpdate(i){
		console.log(i);
		$('#taskUpdate_id').html(task[i]);
		$('#remarksUpdate_id').html(remarks[i]);
		$('#taskSessionUpdate_id').val(sessions[i]);
		$('#taskId').val(i);
		
		
	}

    //-----------------------------end ----------------------------
		

		function getDataRows(){
			
			
			$.ajax({
			url:'data/home/myelination_data.php',
			method:'POST',
			dataType:'json',
			data:{action:'getData'},
			success:function(data){
				list = "";
				

				var x, secs = 600;
				

				list+="<hr>";
				Object.keys(data).forEach(function(key){
					
					

					task[data[key].myelination_id] = data[key].myelination_task;
					remarks[data[key].myelination_id] = data[key].myelination_remarks;
					sessions[data[key].myelination_id] = data[key].myelination_session;
					taskId["id"] = data[key].myelination_id;
					
					list+="<div class='card' border:1px solid white'> ";
					list+="<div class='body'>";
						list+="<h2 class ='card-title'><strong>"+data[key].myelination_task+"</strong></h2>";
						list+="<h6 class='card-subtitle mb-2 text-muted'><em>created: "+data[key].myelination_created+"</em></h6>";
						list+="<p class='card-text'>"+data[key].myelination_remarks+"</h5><br>";
						list+="<br><input type = 'button' class='btn btn-sm btn-danger' value = 'delete' id='delete_"+data[key].myelination_id+"id'>&nbsp;&nbsp;&nbsp;";
						list+="<input type = 'button' class='btn btn-sm btn-info' value = 'update' id='update_"+data[key].myelination_id+"id' data-toggle='modal' data-target='#updateModalId'>&nbsp;&nbsp;&nbsp;";
						//list+="&nbsp;&nbsp;<input type = 'button' class='btn btn-sm btn-warning' value = 'update' id='edit_"+data[key].myelination_id+"id' data-toggle='modal' data-target='#editModalId'><hr>";
						for(i = 1;i<=data[key].myelination_session;i++){
							list+="&nbsp;<input type='checkbox' checked='yes'>";
						}
					list+="<hr><br></div>";
					list+="</div>";

					$(document).on('click','#delete_'+data[key].myelination_id+'id',function(){
						callBackDelete(data[key].myelination_id);
					});
					

					$(document).on('click','#update_'+data[key].myelination_id+'id',function(){
						callBackUpdate(data[key].myelination_id);
					});
					
					

				});

				$("#taskList_id").html(list);
			},
			error(xhr,error,status){
				console.log(xhr);
				console.log(error);
				console.log(status);
			}
		});

		}

		getDataRows();
	
//----------------------------------saved function-----------------		

		$(document).on('click','#saved_id',function(){
			
			task = $('#task_id').val();
			remarks = $('#remarks_id').val();
			sessions = $('#taskSession_id').val();
		

			// console.log(task);
			// console.log(remarks);
			// console.log(sessions);
		
		
			$.ajax({
			url:'data/home/myelination_data.php',
			method:'POST',
			dataType:"text",
			data:{action:'insert',task:task,remarks:remarks,sessions:sessions},
			success:function(data){
				getDataRows();
				alert('saved successfully!');
				console.log(data);
				$("#addModalId").modal('hide');
				
			},
			error:function(xhr,status,error){
				console.log(xhr);
				console.log(status);
				console.log(error);
			}
		});

	
		});


//----------------------------------saved function-----------------		

$(document).on('click','#updateChanges_id',function(){
	
	task = $('#taskUpdate_id').val();
	remarks = $('#remarksUpdate_id').val();
	sessions = $('#taskSessionUpdate_id').val();
	ids = $('#taskId').val();
	
		
	$.ajax({
	url:'data/home/myelination_data.php',
	method:'POST',
	dataType:"text",
	data:{action:'update',task:task,remarks:remarks,sessions:sessions,id:ids},
	success:function(data){
		getDataRows();
		alert('updated successfully!');
		//console.log(data);
		$("#updateModalId").modal('hide');
				
	},
	error:function(xhr,status,error){
		console.log(xhr);
		console.log(status);
		console.log(error);
		}
	});

});



		

});
</script>
