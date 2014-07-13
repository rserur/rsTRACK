<form class="form" action="mystudy.php" method="post">
    <fieldset>  
    <div class="row">
        <div class="col-md-12">
        <h2>General <small><span class="text-info">Rename</span> your study. <span class="text-success">Add</span> a timepoint or component.</small></h2>
        </div>
    </div>
    <div class="row">
        <!-- start study name panel -->
        <div class="col-md-4">
            <div class="panel panel-default">    

                <div class="panel-heading">
                    <h4>Rename "The <?php print($study_name[0]['study']) ?> Study"</h4>
                </div>

                <div class="panel-body">

                    <div class="form-group">  
                        <label for="new_name">Rename</label><br>     
                        "The <input type="text" id="name" name="new_name" placeholder="New Name"> Study"
                    </div>

                    <div class="form-group">
                        <button type="submit" name="submit" value="rename" class="btn btn-warning">Rename Study</button>
                    </div>
                    
                </div>

            </div>
        </div>
        <!-- end study name panel -->

        <!-- start add timepoint panel -->
        <div class="col-md-4">
            <div class="panel panel-default">    

                <div class="panel-heading">
                    <h4>Add Study Timepoint</h4>
                </div>

                <div class="panel-body">

                    <div class="form-group">   
                        <label for="new_num ">Timepoint Number</label>    
                        <input type="text" name="new_num" class="form-control" placeholder="Enter #">
                    </div>

                    <div class="form-group">       
                        <label for="new_timepoint">Timepoint Name</label>
                        <input type="text" name="new_timepoint" class="form-control" placeholder="(e.g. Baseline)">
                    </div>

                    <div class="form-group">
                        <button type="submit" name="submit" value="add_point" class="btn btn-warning">Add Timepoint</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- end add timepoint panel -->

        <!-- start add component panel -->
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Add Component</h4>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="new_comp" class="control-label">Component Name</label>
                        <input type="text" name="new_comp" class="form-control" placeholder="(e.g. Interview)">
                    </div>  
                    <div class="form-group">
                        <label for="new_comp_point" class="control-label">Add to Timepoint</label>
                        <select name="new_comp_point" class="form-control">
                            <?php foreach ($point_positions as $point_position): ?>
                            <option value="<?= $point_position['point_num'] ?>">#<?= $point_position['point_num'] ?>: <?= $point_position['point_name'] ?></option>
                            <? endforeach ?> 
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" value="add_comp" class="btn btn-warning">Add Component</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end add component panel-->
    </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Timepoints <small><span class="text-info">Rename</span> timepoints. Select a component to <span class="text-info">edit</span> or <span class="text-danger">delete</span> it.</h2>
            </div>
        </div>

        <div class="row" id="edit_comp">
            <!-- start rename component panel -->
            <div class="col-lg-6">
                <div class="form-group panel panel-success" id="rename_comp">

                    <div class="panel-heading">
                        <h4>Rename Component #<span class="comp_id"></span></h4>
                    </div>
                    
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <input type="text" name="edit_comp" class="form-control input-sm" placeholder="New Name">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" name="submit" value="rename_comp" class="btn btn-sm btn-success pull-right">Rename Component</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end rename component panel -->

            <!--start delete component panel -->
            <div class="col-md-6">
                <div class="form-group panel panel-danger" id="del_comp">
                    <div class="panel-heading">
                        <h4>Delete Component #<span class="comp_id"></span></h4>
                    </div>
                    
                    <div class="panel-body">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <h5>All deletions are final. Delete Component #<span class="comp_id"></span>?</h5>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" name="submit" value="del_comp" class="btn btn-sm btn-danger pull-right">Delete Component</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end edit resource panel -->
        </div>
        

        <div class="row">
                <!-- start timepoint interation -->
                <?php foreach ($point_positions as $point_position): ?>

                <div class="col-md-4, col-lg-6">
                    <!-- start timepoint panel -->
                        <div class="panel panel-default">

                            <div class="panel-heading">
                                <h4>Timepoint #<?= $point_position['point_num'] ?>: <?= $point_position['point_name'] ?></h4>
                            </div>

                            <div class="panel-body">   

                                <!-- start rename timepoint -->
                                <div class="form-group">
                                    <label for="point_name" class="control-label">Rename Timepoint #<?= $point_position['point_num'] ?>
                                    <input type="text" name="repoint_name" id="point_name" class="form-control" placeholder="New Name">
                                    <input type="hidden" name="repoint_num" value="<?php echo $point_position['point_num'] ?>">
                                </div>
                                <!-- end rename timepoint -->

                                <div class="form-group">
                                    <button type="submit" name="submit" value="re_point" class="btn btn-warning">Rename Timepoint</button>
                                </div>

                                <br>

                                <!-- start component table for timepoint -->
                                <table class="table table-bordered table-striped table-responsive">

                                    <thead>
                                        <tr>
                                            <th>Select</th> 
                                            <th>Component ID</th>
                                            <th>Component</th>
                                        </tr>
                                    </thead>

                                    <?php foreach ($comp_positions as $comp_position):
                                        
                                        if ($comp_position['point_num'] == $point_position['point_num'])
                                        {  ?>
                                                <tr>
                                                    <td><input type="radio" name="component" value="<?= $comp_position['comp_id'] ?>"></td>
                                                    <td><?= $comp_position['comp_id'] ?></td>
                                                    <td><?= $comp_position['component'] ?></td>
                                                </tr>                                            
                                        <? }

                                     endforeach ?>
                                </table>   
                                <!-- end component table for timepoint -->

                            </div>

                        </div>
                
                    <!-- end timepoint panel -->
                </div>
                <? endforeach ?>  
            <!-- end timepoint iteration -->   
           
        </div>
    </fieldset> 
</form>

<!-- javascript -->
<script>
  $(document).ready(function(){

    $('#edit_comp').hide();

    // when a selection is made, create comp variable
    $('input:radio[name=component]').click(function() 
    {
        var $comp = $('input:radio[name=component]:checked').val();
        $('.comp_id').text($comp);

        // show edit row
        $('#edit_comp').show();
    }); 
                
  });
</script>