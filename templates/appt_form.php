<div class="row">
    <div class="col-md-9">
        <form class="form" action="index.php" method="post" class="form-inline">    
        <fieldset>  
            <h2>Appointments <small>Select an existing row to <span class="text-info">edit</span> or 
                <span class="text-danger">cancel</span>. Add a row to <span class="text-success">book</span>.</small></h2>
    </div>
    <div class="col-md-3">
            <div class="form-group">
                <label class="control-label" for="filter">Type to Filter:</label>
                <input type="text" id="filter" name="filter" class="form-control input-lg" placeholder="Enter keyword (e.g. initials)">
            </div>
    </div>
</div>
<div class="row">
            <!-- start appt table -->
            <div class="table-responsive">
            <table class="table table-bordered table-striped">

                <thead>
                    <tr>
                        <th>Select</th> 
                        <th>Subject ID</th>
                        <th>Initials</th>
                        <th>Timepoint</th>
                        <th>Component</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Staff</th>
                        <th>Location</th>
                        <th>Materials</th>
                    </tr>
                </thead>
                <tbody id="appt_body">
                    <!-- start existing appts -->
                    <?php foreach ($appt_positions as $appt_position):?>
                        <tr>
                            <td>
                            	<input type="radio" name="appt" value="<?= $appt_position['appt_id'] ?>">
                            </td>
                            <td><?= $appt_position['sub_id'] ?> </td>
                            <td><?= $appt_position['initials'] ?></td>
                            <td><?= $appt_position['timepoint'] ?></td>
                            <td><?= $appt_position['comp_id'] ?></td>
                            <td><?= $appt_position['date'] ?></td>
                            <td><?= $appt_position['start_time'] ?></td>
                            <td><?= $appt_position['end_time'] ?></td>
                            <td><?= $appt_position['staff'] ?></td>
                            <td><?= $appt_position['location'] ?></td>
                            <td><?= $appt_position['materials'] ?></td>
                        </tr>
                    <? endforeach ?>
                    <!-- end existing appts -->

                    <!-- start new appt row -->
                    <tr id="new_appt_row">
                        <td>
                        	<input type="radio" name="appt" value="new_appt">
                        </td>
                        <td>
                        	<select id="book_id" name="book_id" class="form-control">
        						<?php foreach ($uni_subs as $uni_sub):?>
        							<option value="<?= $uni_sub['sub_id'] ?>"><?= $uni_sub['sub_id'] ?></option>
        						<? endforeach ?>
                    		</select>
                        </td>	
                        <td>
                        	<select id="book_inits" name="book_inits" class="form-control">
        						<?php foreach ($uni_subs as $uni_sub):?>
        							<option value="<?= $uni_sub['sub_id'] ?>"><?= $uni_sub['initials'] ?></option>
        						<? endforeach ?>
                    		</select>
                        </td>
                        <td colspan="2">
                            <select id="book_comp" name="book_comp" class="form-control">
                                <?php foreach ($comps as $comp): ?>
                                <option value="<?= $comp['comp_id'] ?>"><?= $comp['point_name'] ?> | <?= $comp['component'] ?></option>
                                 <? endforeach ?>
                            </select>
                        </td>
                        <td>
                            <div class="datepicker_wrapper">
                                <input type="text" name="book_date" id="book_date" class="form-control datepick">
                            </div>
                        </td>
                        <td><input type="time" name="book_start" id="book_start" class="form-control"></td>
                        <td><input type="time" name="book_end" id="book_end" class="form-control"></td>
                        <td>
                            <select name="book_s" id="book_s" class="form-control">
                                <?php foreach ($staff as $s):?>
                                    <option value="<?= $s['resource_id'] ?>"><?= $s['name'] ?></option>  
                                <? endforeach ?>
                            </select>
                        </td>
                        <td>
                            <select name="book_l" id="book_l" class="form-control">
                                <?php foreach ($locations as $l):?>
                                    <option value="<?= $l['resource_id'] ?>"><?= $l['name'] ?></option>  
                                <? endforeach ?>
                            </select>   
                        </td>
                        <td>
                            <select name="book_m" id="book_m" class="form-control">
                                <?php foreach ($materials as $m):?>
                                    <option value="<?= $m['resource_id'] ?>"><?= $m['name'] ?></option>  
                                <? endforeach ?>
                            </select> 
                        </td>
                    </tr>
                    <!-- end new appt row -->
                </tbody>
            </table>  
            </div> 
            <!-- end appt table -->

            <div class="row">
<!-- start edit appt panel-->
<div class="col-lg-6">
    <div class="form-group panel panel-info" id="edit">

        <div class="panel-heading">
            <strong>Edit Appointment</strong>
        </div>
        
        <div class="panel-body">

            <div class="row">
	            <div class="col-xs-3">
	                <div class="form-group">
	                    <label for="edit_id" class="control-label">ID</label>
	                    <select id="edit_id" name="edit_id" class="form-control">
	                        <?php foreach ($uni_subs as $uni_sub):?>
	                            <option value="<?= $uni_sub['sub_id'] ?>"><?= $uni_sub['sub_id'] ?></option>
	                        <? endforeach ?>
	                    </select>
	                </div>
	            </div>
	            
	            <div class="col-xs-3">
	                <div class="form-group">
	                    <label for="edit_inits" class="control-label">Initials</label>
	                    <select id="edit_inits" name="edit_inits" class="form-control">
	                        <?php foreach ($uni_subs as $uni_sub):?>
	                            <option value="<?= $uni_sub['sub_id'] ?>"><?= $uni_sub['initials'] ?></option>
	                        <? endforeach ?>
	                     </select>
	                 </div>
	             </div>

	            <div class="col-xs-6">
	                <div class="form-group">
	                    <label for="edit_comp" class="control-label">Timepoint &#124; Component</label>
	                    <select id="edit_comp" name="edit_comp" class="form-control">
	                        <?php foreach ($comps as $comp): ?>
	                            <option value="<?= $comp['comp_id'] ?>"><?= $comp['point_name'] ?> | <?= $comp['component'] ?></option>
	                        <? endforeach ?>
	                    </select>
	                </div>
	            </div>
            </div>

            <div class="row">
	            <div class="col-xs-4">
			        <div class="form-group">
			            <label for="edit_date" class="control-label">Date</label>
			            <div class="datepicker_wrapper">
			                <input type="text" name="edit_date" id="edit_date" class="form-control datepick">
			            </div>
			        </div>
		        </div>
	        	<div class="col-xs-4">            	
			        <div class="form-group">
			            <label for="edit_start" class="control-label">Start Time</label>
			            <input type="time" name="edit_start" id="edit_start" class="form-control">
			        </div>
		        </div>

		        <div class="col-xs-4">
			        <div class="form-group">
			            <label for="edit_end" class="control-label">End Time</label>
			            <input type="time" name="edit_end" id="edit_end" class="form-control">
			        </div>
		        </div>
            </div>

            <div class="row">
		        <div class="col-xs-4">
			        <div class="form-group">
			            <label for="edit_s" class="control-label">Staff</label>
			            <select name="edit_s" id="edit_s" class="form-control">
			                <?php foreach ($staff as $s):?>
			                    <option value="<?= $s['resource_id'] ?>"><?= $s['name'] ?></option>  
			                <? endforeach ?>
			            </select>
			        </div>
		        </div>

		        <div class="col-xs-4">
			        <div class="form-group">
			            <label for="edit_s" class="control-label">Location</label>
			            <select name="edit_l" id="edit_l" class="form-control">
			                <?php foreach ($locations as $l):?>
			                    <option value="<?= $l['resource_id'] ?>"><?= $l['name'] ?></option>  
			                <? endforeach ?>
			            </select>   
			        </div>
		        </div>

		        <div class="col-xs-4">
			        <div class="form-group">
			            <label for="edit_m" class="control-label">Materials</label>
			            <select name="edit_m" id="edit_m" class="form-control">
			                <?php foreach ($materials as $m):?>
			                    <option value="<?= $m['resource_id'] ?>"><?= $m['name'] ?></option>  
			                <? endforeach ?>
			            </select> 
			        </div>
		        </div>
        	</div>
           
        <button type="submit" name="submit" value="edit" class="btn btn-info pull-right">Edit Appointment</button>        
        </div>

    </div>
</div>
<!-- end edit appt panel -->

                <!-- start cancel appt panel -->
                <div class="col-lg-6">
                    <div class="panel panel-danger" id="cancel">
                        <div class="panel-heading">
                            <strong>Cancel Appointment</strong>
                        </div>
                        <div class="panel-body">
                            All cancellations are final. Cancel Appointment?
                            <button type="submit" name="submit" value="cancel" class="btn btn-danger pull-right">Cancel Appointment</button>
                        </div>
                    </div>  

                    <div class="form-group">
                        <button type="submit" name="submit" value="book" class="btn btn-success pull-right" id="book">Book Appointment</button>
                    </div>  
                </div>
                <!-- end cancel appt panel -->


            </div>

        </fieldset> 
</form>
</div>
<!-- javascript -->
<script>
  $(document).ready(function(){

  		// first hide the book, edit, and cancel sections
        $('#book, #edit, #cancel').hide();

        // function for populating edit form
        function populateForm(values)
        {
			$('#edit_id option').filter(function()
			{
				return this.text == $.trim(values[1]);
			}).attr('selected', true);

			$('#edit_inits option').filter(function()
			{
				return this.text == values[2];
			}).attr('selected', true);
	
			var $comp = values[3] + " | " + values[4];

			$('#edit_comp option').filter(function()
			{
				return this.text == $comp;
			}).attr('selected', true);

			$('#edit_date').datepicker("setDate", values[5]);
			$('#edit_start').val(values[6]);
			$('#edit_end').val(values[7]);
			
			$('#edit_s option').filter(function()
			{
				return this.text == values[8];
			}).attr('selected', true);

			$('#edit_l option').filter(function()
			{
				return this.text == values[9];
			}).attr('selected', true);

			$('#edit_m option').filter(function()
			{
				return this.text == values[10];
			}).attr('selected', true);
		}

        // when a selection is made, create component variable
        $('input:radio[name=appt]').click(function() 
        {

            var $appt = $('input:radio[name=appt]:checked').val();
            $('.appt').text($appt);

            // show  edit and cancel boxes when an existing appt is selected
            if($appt != 'new_appt')
            {                    
                $('#new_appt_row').removeClass('success');  

                values = [];
			  	$('input:radio[name=appt]:checked').closest('tr').children().each(function(){
				    //add contents to the value array.
				    values.push($(this).html())
				  });

				  //fill in the form values
				  populateForm(values);

                $('#edit, #cancel').show();
                $('#book').hide();


            } 

            // highlight new appointment row when it's selected 
            else
            {
                $('#new_appt_row').addClass('success');
                $('#edit, #cancel').hide();
                $('#book').show();
            }

        }); 

        // when user goes straight for new appt, make selection for user and show "new appt" row
        $('#book_id, #book_inits, #book_comp, #book_date, #book_start, #book_end, #book_m, #book_l, #book_s').focus(function() 
        {
            $('#new_appt_row').addClass('success');
            $('#edit, #cancel').hide();
            $('#book').show();

            // select new resoure radio
            $('input:radio[name=appt]').filter('[value="new_appt"]').attr('checked',true);
        });

        // synchronize dropdrowns for adding subject id and initials
        $('#book_id').change(function()
        {     
            $('#book_inits').val(this.value);
        });

         $('#book_inits').change(function()
        {     
            $('#book_id').val(this.value);
        });

        // synchronize dropdrowns for editing subject id and initials
        $('#edit_id').change(function()
        {     
            $('#edit_inits').val(this.value);
        });

         $('#edit_inits').change(function()
        {     
            $('#edit_id').val(this.value);
        });

         // allow user to filter appointment table by row with keyword
        $('#filter').keyup(function()
        {
            var keyword = $(this).val();

            if(keyword != "")
            {
                $("#appt_body>tr").hide();
                $("td").filter(function() {
                    return $(this).text().toLowerCase().indexOf(keyword) > -1;
                }).parent("tr").show();
            }
            else
            {
                $("#appt_body>tr").show();
            }
        });
  });
</script>