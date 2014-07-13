<div class="row">
    <form action="index.php" method="post">
        <fieldset>
        <h2>Subject #<?= $sub_id ?> <small>"<?= $initials ?>"</small></h2>
        <div class="row">
     
            <!-- start study name panel -->
            <div class="col-md-12">

            <!-- start appt table -->
            <table class="table table-bordered table-striped table-responsive">

                <thead>
                    <tr>
                        <th>Edit Appt</th>
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

               <?php foreach ($appt_positions as $appt_position):?>
                    <tr>
                        <td>
                            <input type="radio" name="appt" value="<?= $appt_position['appt_id'] ?>">
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

            </table>   
            <button class="btn btn-info"><a href="index.php">Back</a></button>
                    
            </div>
            <!-- end study name panel -->
        
        </div>
            
        </fieldset>
    </form>
</div>

<!-- javascript -->
<script>
  $(document).ready(function(){

        $('#add, #edit, #delete').hide();

        // when a selection is made, create selection variable
        $('input:radio[name=selection]').click(function() 
        {

            var $selection = $('input:radio[name=selection]:checked').val();
            $('.sub_id').text($selection);

            // show "edit subject" box when an existing subject is selected
            if($selection != 'new_sub')
            {                    
                $('#new_sub_row').removeClass('success');  
                $('#edit, #delete').show();
                $('#add').hide();
            } 

            else
            {
                $('#new_sub_row').addClass('success');
                $('#edit, #delete').hide();
                $('#add').show();
            }

        }); 
                
  });
</script>