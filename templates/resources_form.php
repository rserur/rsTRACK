<form action="resources.php" method="post">
    <fieldset>
        <h2>Resources <small>Select an existing row to <span class="text-info">edit</span> or 
            <span class="text-danger">delete</span>. Add a row to <span class="text-success">create</span> one.</small></h2>
        <!-- start resource table in panel -->
        <div class="panel panel-default">
            <table class="table table-hover table-striped table-responsive">
                <thead>
                    <tr>
                        <th>Select</th> 
                        <th>Resource ID</th>
                        <th>Type</th>
                        <th>Name</th>
                    </tr>
                </thead>
                
                <tbody>        

                    <div class="form-group">
                        <?php foreach ($positions as $position): ?>
                        <tr class="text-left">
                            <td><input type="radio" name="selection" value="<?= $position['resource_id'] ?>">
                            <td><?= $position["resource_id"] ?></td>
                            <td><?= $position["type"] ?></td>
                            <td><?= $position["name"] ?></td>
                        </tr>
                        <? endforeach ?>
                    </div>         

                    <tr class="text-left" id="new_resource_row">
                        <td><input type="radio" name="selection" value="new_resource"></td>
                        <td><em><span class="text-muted">(autogenerates)</span></em></td>
                        <td>
                            <select name="new_type" class="form-control">
                                <option value="staff">staff</option>
                                <option value="location">location</option>
                                <option value="materials">materials</option>
                            </select>
                        </td>
                        <td><input type="text" id="new_name" name="new_name" class="form-control" placeholder="New Resource"></td>       
                    </tr>

                    </div>

                </tbody>     
            </table>
        </div>
        <!-- end resource table in panel -->

        <div class="row">
                <!-- start edit resource panel-->
                <div class="col-md-6">
                    <div class="form-group panel panel-success" id="edit">

                        <div class="panel-heading">
                            <strong>Edit Resource #<span class="resource_name"></span></strong>
                        </div>
                        
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="edit_type">Change Type:</label>
                                <select name="edit_type" class="form-control">
                                    <option value="staff">staff</option>
                                    <option value="location">location</option>
                                    <option value="materials">materials</option>
                                </select>
                            </div>
                            <p><small>and/or</small></p>
                            <div class="form-group">
                                <label for="edit_name">Change Name:</label>
                                <input type="text" name="edit_name" class="form-control" placeholder="Change Resource Name">         
                            </div>
                            <p><button type="submit" name="submit" value="edit" class="btn btn-success pull-right">Edit Resource</button></p>   
                        </div>

                    </div>
                </div>
                <!-- end edit resource panel -->

                <!-- start delete resource panel -->
                <div class="col-md-6">
                    <div class="panel panel-danger" id="delete">
                        <div class="panel-heading">
                            <strong>Delete Resource #<span class="resource_name"></span></strong>
                        </div>
                        <div class="panel-body">
                            All deletions are final. Delete resource?
                            <button type="submit" name="submit" value="delete" class="btn btn-danger pull-right">Delete Resource</button>
                        </div>
                    </div>  

                    <div class="form-group">
                        <button type="submit" name="submit" value="add" class="btn btn-success pull-right" id="add">Add Resource</button>
                    </div>  
                </div>
                <!-- end delete resource panel -->
        </div>
    </fieldset>
</form>

<!-- javascript -->
<script>
  $(document).ready(function(){

        $('#add, #edit, #delete').hide();

        // when a selection is made, create resource variable
        $('input:radio[name=selection]').click(function() 
        {
            var $resource = $('input:radio[name=selection]:checked').val();
            $('.resource_name').text($resource);

            // show "edit resource" box when an existing resource is selected
            if($resource != 'new_resource')
            {                    
                $('#new_resource_row').removeClass('success');  
                $('#edit, #delete').show();
                $('#add').hide();
            } 

            // show "new resource" row as it's selected
            else
            {
                $('#new_resource_row').addClass('success');
                $('#edit, #delete').hide();
                $('#add').show();
            }
        }); 

        // when user goes straight for new resource text box, make selection for user and show "new resource" row
        $('#new_name').focus(function() 
        {
            $('#new_resource_row').addClass('success');
            $('#edit, #delete').hide();
            $('#add').show();

            // select new resoure radio
            $('input:radio[name=selection]').filter('[value="new_resource"]').attr('checked',true);
        });
                
  });
</script>