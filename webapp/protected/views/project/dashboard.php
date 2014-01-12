 
 <?php
      if(isset(Yii::app()->session['msg']) && !empty(Yii::app()->session['msg']))
      {
        ?>
        
 <div class="alert alert-danger alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong><p class="text-center"><?php echo Yii::app()->session['msg'];
        unset(Yii::app()->session['msg']);
        ?><p></strong> 
</div>

        
        <?php
      }
?>
<section class="middle">
	<div class="wrapper">
    	<div class="middleMain">

            <div class="btn-group">
                <?php echo CHtml::ajaxLink(
                    'Projects',
                    array('project/ajaxProjects'), // Yii URL
                    array('update' => '#tab-content'),                       // jQuery selector
                    array('class' => "btn btn-default", 'id' => "projects")

                    );
                ?>
                <?php echo CHtml::ajaxLink(
                    'Study Boards',
                    array('studyboard/ajaxStudyboards'), // Yii URL
                    array('update' => '#tab-content'),                       // jQuery selector
                    array('class' => "btn btn-default", 'id' => "study-boards")
                );
                ?>
            </div>
            <div id="tab-content"></div>
        </div>
    </div>
</section>
<script>
    function buttonPressed(id){
        jQuery("#projects").removeClass("active");
        jQuery("#study-boards").removeClass("active");

        jQuery(id).addClass("active");
    }
    jQuery(document).ready(function(){
        jQuery.ajax({
            url: "<?php echo Yii::app()->createAbsoluteUrl('project/ajaxProjects'); ?>",
        }).done(function(data){
            jQuery("#tab-content").html(data);
            buttonPressed("#projects");
        });

        jQuery("#projects").click(function(){
            buttonPressed("#projects");
        });

        jQuery("#study-boards").click(function(){
            buttonPressed("#study-boards");
        });

    });
</script>



   <!-------------------------Success / Failure Notification ----------------------------------------> 

   <!------------------------------------------------------------------------------------------------->