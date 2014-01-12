<section class="middle">
    <div class="wrapper">
        <div class="middleMain">
            <form method="post" action="/studyboard/addProjectsToStudyBoard" id="form-add-project">

                <?php echo CHtml::dropDownList('studyboardId', null, $study_boards, array(
                    "empty" => "Select a Studyboard",
                    "id" => 'study-board-id')); ?>
                <div class="dashBoxMainCntr">
                    <div class="dashBoxMainLft">
                        <?php $ctr = 0; ?>
                        <?php foreach ($projects as $p) { ?>
                            <?php if ($ctr%3 == 0) { ?>
                                <div class="dashBoxContnr">
                            <?php } ?>

                            <?php $ctr++; ?>

                            <div class="dashBox">
                                <div class="dashBoxMain">
                                    <div class="dashBoxMainDiv dashBoxMain<?php if(($ctr%6) == 0){echo 6;}else{echo $ctr%6;} ?>">
                                        <h3>
                                            <input type="hidden" name="projects[]" value="<?php echo $p->id; ?>">
                                            <input class="select_project" type="checkbox" name="add_project[<?php echo $p->id; ?>]">
                                            <?php echo $p->title; ?>
                                        </h3>
                                    </div>
                                </div>
                            </div>

                            <?php if ($ctr%3 == 0) { ?>
                                </div>
                            <?php } ?>

                        <?php } ?>
                    </div>
                </div>
                <input type="submit" value="Add Projects" class="btn btn-primary">
            </form>
        </div>
    </div>
</section>
<script>
    jQuery(document).ready(function(){
        jQuery('#form-add-project').submit(function(event){
            if(jQuery('#study-board-id').val() == '' || jQuery('#study-board-id').val() < 0){
                alert('Please select study board');
                event.preventDefault();
            }

            var project_selected=false;
            jQuery('.select_project').each(function(){
                if (jQuery(this).is(':checked')){
                    project_selected = true;
                }
            });

            if(!project_selected){
                alert('Please select at least one project');
                event.preventDefault();
            }
        });
    });
</script>