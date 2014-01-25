 
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
<!--------------------------------------------------->
<a id="btn-wel" href="#" data-toggle="modal" data-target="#myModal2" style="display:none;"><span>Start New Project</span></a>
   
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Welcome to Stirplate</h4>
      </div>
      <div class="modal-body">
          <h5>
          We are just going to point out a few features here
          </h5>
      </div>
      <div class="modal-footer">
       <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
                   
      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->  
<!--------------------------------------------------->
<?php if(isset($_GET['welcome'])){  ?>

<!--<div class="black-popup-large-4" style="right: 0;">


       <h3 class="welcome">
        Welcome to Strirplate, we are just going to point out a few features here...
       </h3>

</div>-->
<script>
 
 $(document).ready(function(){
    
    
     /*$('.black-popup-large-4').click(function(){
                $(this).animate({top:'-10%'},2000,function(){
                       
                });
          
        });*/
        $('#btn-wel').click();
 });
</script>
<?php } ?>
<?php if(!isset(Yii::app()->request->cookies['flash'])){  ?>
<div class="black-popup">
<p class="links"><input type="checkbox" name="" class="setflag"/> Don't show this again</p>
<p><a href="#" class="links nxt">Next</a><a href="#" class="links can">Cancel</a></p>
</div>
<!-----------------------POP UP DIV1----------------->
<div class="black-popup-large" style="">
<div class="container-middle container-middle2">
<div class="dashNewStdy">
    <div class="detailMainContentMainBtn">
        <a href="#" ><img src="/img/dashboard/arrow.png" alt="New Project" /><span>This is a demonstration project </span></a>
    </div>
    <div class="content-part">
    <img src="/img/dashboard/p1.png"/>
    </div>
    <div class="lower-part">
            <p class="links"><input type="checkbox" name="" class="setflag"/> Don't show this again</p>
<p><a href="#" class="btn-popup next1">Next</a><a href="#" class="btn-popup btn-can">Later</a></p>

    </div>
</div>
</div>
</div>
<!----------------------------------------------->
<!------------------POP UP DIV2------------------->
<div class="black-popup-large-2" style="">
<div class="container-middle container-middle2">
<div class="dashNewStdy">
    <div class="detailMainContentMainBtn">
        <a href="#" ><img src="/img/dashboard/activity.png" alt="This is the activity stream" /><span>This is the activity stream</span></a>
    </div>
    <div class="content-part">
    <img src="/img/dashboard/p3.png"/>
    </div>
    <div class="lower-part">
            <p class="links"><input type="checkbox" name="" class="setflag"/> Don't show this again</p>
<p><a href="#" class="btn-popup next2">Next</a><a href="#" class="btn-popup btn-can2">Later</a></p>

    </div>
</div>
</div>

</div>
<!----------------------------------------------->
<!------------------POP UP 3--------------------->
<div class="black-popup-large-3" style="">
<div class="container-middle container-middle2">
<div class="dashNewStdy">
    <div class="detailMainContentMainBtn">
        <a href="#" ><img src="/img/dashboard/calendar.png" alt="This is study board area" /><span>This is study board area</span></a>
    </div>
    <div class="content-part">
    <img src="/img/dashboard/p2.png"/>
    </div>
    <div class="lower-part">
            <p class="links"><input type="checkbox" name="" class="setflag" /> Don't show this again</p>
<p><a href="#" class="btn-popup nxt4">Next</a><a href="#" class="btn-popup btn-can3">Later</a></p>

    </div>
</div>
</div>

</div>
<!-------------------------------------------->
<div class="black-popup-large-5" style="">
<div class="container-middle container-middle2">
<div class="dashNewStdy">
    <div class="detailMainContentMainBtn">
        <a href="#" ><img src="/img/dashboard/admin.png" alt="This is study board area" /><span>This is the profile button</span></a>
    </div>
    <div class="content-part">
    <img src="/img/dashboard/p4.png"/>
    </div>
    <div class="lower-part">
            <p class="links"><input type="checkbox" name="" class="setflag" /> Don't show this again</p>
<p><a href="#" class="btn-popup btn-can5">Finish</a><a href="#" class="btn-popup btn-can5">Later</a> </p>

    </div>
</div>
</div>

</div>

<!----------------------------------------------->
<script>
    $(document).ready(function(){
        
        $.ajax({
                url:'<?php echo Yii::app()->createUrl('project/updatewelcomeflash');?>',
                type:'POST',
                success:function(){},
                complete:function(){},
            });
        
        
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
        $('.nxt4').click(function(){
            $(".black-popup-large-3").animate({right:'100%'},1000,function(){
               // $(".black-popup-large").fadeIn();
            });
            $(".black-popup-large-5").animate({right:'0'},1000,function(){
            // $(".black-popup-large").fadeIn();
            });                                
        });
        
        $('.setflag').click(function(){
            $.ajax({
                url:'<?php echo Yii::app()->createUrl('project/updateflash');?>',
                type:'POST',
                success:function(){},
                complete:function(){},
            });
        });
        
        $('.btn-can3').click(function(){
              $(".black-popup-large-3").animate({right:'100%'},1000,function(){
               // $(".black-popup-large").fadeIn();
            });
        });
        $('.btn-can5').click(function(){
              $(".black-popup-large-5").animate({right:'100%'},1000,function(){
               // $(".black-popup-large").fadeIn();
            });
        });
        
        $('.btn-can2').click(function(){
              $(".black-popup-large-2").animate({right:'100%'},1000,function(){
               // $(".black-popup-large").fadeIn();
            });
        });
         $('.btn-can').click(function(){
              $(".black-popup-large").animate({right:'100%'},1000,function(){
               // $(".black-popup-large").fadeIn();
            });
        });
        
    });

</script>
<?php } ?>