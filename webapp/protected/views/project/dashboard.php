 
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

<script type="text/javascript">
    function buttonPressed(id){
        jQuery("#projects").removeClass("active");
        jQuery("#study-boards").removeClass("active");

        jQuery(id).addClass("active");
    }

    function ajax_updater () {
        var biggest_id = 0 ;
        $.each($(".activity"), function(b, a){
            var num = parseInt($(a).attr("activity_id"));
            if(num > biggest_id)
                biggest_id = num;
        });
        $.ajax({
            url    : "project/updateactivity",
            data   : "last_id="+biggest_id,
            type   : "POST",
            success: function(result){
                if(result != ""){
                    $("#activity_stream").prepend(result);
                    $(".activity:first").hide().fadeIn(2000);
                }
                setTimeout(function(){ajax_updater();}, 2000);
            }
        });
    }
    $(document).ready(function() {
        ajax_updater ();

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
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">New Project</h4>
      </div>
      <form class="form-horizontal" action="project/create" method="post">
      <div class="modal-body">
        <fieldset>
            <!-- Text input-->
            <div class="form-group">
                <div class="col-md-11">
                    <input id="title" name="title" type="text" placeholder="Enter a title for this project" class="form-control input-md" required="">
                </div>
            </div>
        </fieldset>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-primary" value="Create">
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->  

<div class="black-popup">
<p class="links"><input type="checkbox" name=""/> Don't show this again</p>
<p><a href="#" class="links nxt">Next</a><a href="#" class="links can">Cancel</a></p>
</div>
<!-----------------------POP UP DIV1----------------->
<div class="black-popup-large" style="">
<div class="container-middle">
<div class="dashNewStdy">
    <div class="detailMainContentMainBtn">
        <a href="#" ><img src="/img/dashboard/arrow.png" alt="New Project" /><span>This is a demonstration project </span></a>
    </div>
    <div class="content-part">
    </div>
    <div class="lower-part">
            <p class="links"><input type="checkbox" name=""/> Don't show this again</p>
<p><a href="#" class="btn-popup next1">Next</a><a href="#" class="btn-popup">Cancel</a></p>

    </div>
</div>
</div>
</div>
<!----------------------------------------------->
<!------------------POP UP DIV2------------------->
<div class="black-popup-large-2" style="">
<div class="container-middle">
<div class="dashNewStdy">
    <div class="detailMainContentMainBtn">
        <a href="#" ><img src="/img/dashboard/activity.png" alt="This is the activity stream" /><span>This is the activity stream</span></a>
    </div>
    <div class="content-part">
    </div>
    <div class="lower-part">
            <p class="links"><input type="checkbox" name=""/> Don't show this again</p>
<p><a href="#" class="btn-popup next2">Next</a><a href="#" class="btn-popup">Cancel</a></p>

    </div>
</div>
</div>

</div>
<!----------------------------------------------->
<!------------------POP UP 3--------------------->
<div class="black-popup-large-3" style="">
<div class="container-middle">
<div class="dashNewStdy">
    <div class="detailMainContentMainBtn">
        <a href="#" ><img src="/img/dashboard/activity.png" alt="This is study board area" /><span>This is study board area</span></a>
    </div>
    <div class="content-part">
    </div>
    <div class="lower-part">
            <p class="links"><input type="checkbox" name=""/> Don't show this again</p>
<p><a href="#" class="btn-popup">Next</a><a href="#" class="btn-popup">Cancel</a></p>

    </div>
</div>
</div>

</div>
<!----------------------------------------------->
<script>
    $(document).ready(function(){
        $('.can').click(function(){
            $('.black-popup').fadeOut();
        });
        $('.nxt').click(function(){
            $(".black-popup-large").animate({right:'0'},1000,function(){
              //  $(".black-popup-large").fadeIn();
            });
        });
        $('.next1').click(function(){
            $(".black-popup-large").animate({right:'100%'},1000,function(){
               // $(".black-popup-large").fadeIn();
            });
            $(".black-popup-large-2").animate({right:'0'},1000,function(){
               // $(".black-popup-large").fadeIn();
            });
        });
       $('.next2').click(function(){
            $(".black-popup-large-2").animate({right:'100%'},1000,function(){
               // $(".black-popup-large").fadeIn();
            });
            $(".black-popup-large-3").animate({right:'0'},1000,function(){
               // $(".black-popup-large").fadeIn();
            });
        });
    });

</script>