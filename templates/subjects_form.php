<form action="subjects.php" method="post">
    <fieldset>
        <h2>Subjects <small>Select an existing row to <span class="text-info">edit</span> or 
            <span class="text-danger">delete</span>. <span class="text-success">Add</span> a row for a new subject.</small></h2>
        <!-- start subject table in panel -->
        <div class="panel panel-default">
            <table class="table table-hover table-striped table-responsive">
            
                <thead>
                    <tr>
                        <th>Select</th> 
                        <th>Subject ID #</th>
                        <th>Initials (4 Max)</th>
                    </tr>
                </thead>
                
                <tbody>        
                    <div class="form-group">

                        <!-- start subject rows -->
                        <?php foreach ($positions as $position): ?>
                            <tr class="text-left">
                                <td><input type="radio" name="selection" value="<?= $position['sub_id'] ?>">
                                <td><?= $position["sub_id"] ?></td>
                                <td><?= $position["initials"] ?></td>
                            </tr>
                        <? endforeach ?>
                        <!-- end subject rows -->

                        <!-- start new subject row -->
                        <tr class="text-left" id="new_sub_row">
                            <td><input type="radio" name="selection" value="new_sub"></td>
                            <td><input type="text" id="new_id" name="new_sub_id" class="form-control" placeholder="Add New Subject ID #"></td>
                            <td><input type="text" id="new_inits" name="new_initials" class="form-control" placeholder="Add New Subject Initials"></td>       
                        </tr>
                        <!-- end new subject row -->

                    </div>
                </tbody>     

            </table>
        </div>
        <!-- end subject table in panel -->

        <!-- start subject button (shows when new_sub radio selected) -->
        <div class="form-group">
            <button type="submit" name="submit" value="add" class="btn btn-success pull-right" id="add">Add Subject</button>
        </div>
        <!-- end subject botton -->

        <div class="row">

            <!-- start edit subject panel -->
            <div class="col-lg-6">
                <div class="form-group panel panel-success" id="edit">

                    <div class="panel-heading">
                        <strong>Edit Subject #<span class="sub_id"></span></strong>
                    </div>

                    <div class="panel-body">
                        <div class="form-group">
                            <label for="sub_id" class="control-label">Change ID:</label>
                            <input type="text" name="sub_id" class="form-control" placeholder="Change Subject ID#">
                        </div>
                        <small>and/or</small>
                        <div class="form-group">
                            <label for="initials" class="control-label">Change Initials</label>
                            <input type="text" name="initials" class="form-control" placeholder="Change Subject Initials">    
                        </div>
                        <div class="form-group">
                        <button type="submit" name="submit" value="edit" class="btn btn-success pull-right">Edit Subject</button>        
                        </div>
                    </div>

                </div>
            </div>
            <!-- end edit subject panel -->

            <!-- start delete subject panel -->
            <div class="col-lg-6">
            <div class="panel panel-danger" id="delete">

                <div class="panel-heading">
                    <strong>Delete Subject #<span class="sub_id"></span></strong>
                </div>

                <div class="panel-body">
                    All deletions are final. Delete subject?
                    <button type="submit" name="submit" value="delete" class="btn btn-danger pull-right">Delete Subject</button>
                </div>

            </div>  
            </dv
            <!-- end delete subject panel -->
        </div>
    </fieldset>
</form>


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

        // when user goes straight for new subject text box, make selection for user and show "new subject" row
        $('#new_inits, #new_id').focus(function() 
        {
            $('#new_sub_row').addClass('success');
            $('#edit, #delete').hide();
            $('#add').show();

            // select new resoure radio
            $('input:radio[name=selection]').filter('[value="new_sub"]').attr('checked',true);
        });
                
  });
</script>