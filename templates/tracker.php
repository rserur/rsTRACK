<div class="row">   
    <form class="form" action="index.php" method="post">
        <fieldset>  
            <!-- start appt table -->
            <table class="table table-bordered table-striped table-responsive">

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

                <?php foreach ($appt_positions as $appt_position):?>
                    <tr>
                        <td><input type="radio" name="appt" value="<?= $appt_position['appt_id'] ?>"></td>
                        <td><?= $appt_position['sub_id'] ?></td>
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

            </table>   
            <!-- end appt table -->

        </fieldset> 
    </form>
</div>

<!-- javascript -->
<script>
  $(document).ready(function(){

        // when a selection is made, create component variable
        $('input:radio[name=component]').click(function() 
        {

            var $component = $('input:radio[name=component]:checked').val();
            $('.component').text($component);

            // show "edit component" box when an existing component is selected
            if($component != 'new_comp')
            {                    
                $('#new_sub_row').removeClass('success');  
                $('#edit, #delete').show();
                $('#add').hide();
            } 

            else
            {
                $('#new_comp_row').addClass('success');
                $('#edit, #delete').hide();
                $('#add').show();
            }

        }); 
                
  });
</script>