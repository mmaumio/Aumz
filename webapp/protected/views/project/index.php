<section class="detailMain">
	<div class="wrapper">
        <div class="detailMainGreen">
            <h3 class="mainheader">
            <div class="toolpopup"><img src="/img/dashboard/file_edit2.png" style="margin:-3px 5px;">Click on title to edit</div>
            <img class="edit-img" src="/img/dashboard/file_edit.png" style="height:23px"/>
             <input value="<?php echo $project->title ?>" type="text" style="" class="project-header"/><img class="loadclass" src="/img/dashboard/loadimage.gif"/></h3>
            <div class="detailMainGreenImg">
            	<h3> Project members: </h3> 
                    
                <?php foreach ($project->users as $user) { ?>            		
            		<div class="name-block" style="width: -moz-max-content !important;">
					<span style="font-weight:bold"><?php echo $user->firstName  ?></span>
					<span class="delete-icon">
                    <a href="/project/remove_collaborator/<?php echo $project->id ?>?userId=<?php echo $user->id ?>">
					  <b>
					  x
					  </b>
					</a>                    
					</span>
					</div>
					
            	<?php } ?> 
                <script type="text/javascript">
                    var names_array = [ <?php foreach ($all_users as $user) {

                        echo "\"" . $user->firstName . " " . $user->lastName . "\" ,";

                    } ?> ]
                 
                $(document).ready(function() {
                    $(".delete-icon").hide();
                    $("#names").select2({tags:names_array, width: "400"});
                    $("#names").on("change", function(e) {
                      $("#mynames").val($("#names").select2("val").join(","));
                    });
					
                    $(".name-block").on("mouseover", function(){
                      $(this).children(".delete-icon").show();
                      $(this).children("border","1px solid grey");
                    });

                    $(".name-block").on("mouseout", function(){
                      $(this).children(".delete-icon").hide();
                      $(this).children("border","none");
                    });
                    
                    $(".menu-bar").hide();
                    $(".filename-block").on("mouseover", function(){
                      $(this).children(".menu-bar").show();
                      $(this).children("border","1px solid grey");
                    });
                    $(".filename-block").on("mouseout", function(){
                      $(this).children(".menu-bar").hide();
                      $(this).children("border","none");
                    });   




                });
            </script>
            <br><a href="javascript:void(0);" data-toggle="modal" data-target="#collaboratorsModal"> Add new project member  </a>
          
            </div>
        </div>
    </div>
</section>	
<section class="detailNav">
	<div class="wrapper">
    	<div class="detailNavMain">
        	<ul>
            	<li><a href="/dashboard"><img src="/img/details/dashNav1.png" alt="Dashboard"><span>Dashboard</span></a></li>
                <li><a href="#discussion"><img src="/img/details/dashNav2.png" alt="Discussion"><span>Discussion</span></a></li>
                <li><a href="#tasks"><img src="/img/details/dashNav3.png" alt="Tasks"><span>Tasks</span></a></li>
                <li><a href="#files"><img src="/img/details/dashNav4.png" alt="Files"><span>Files</span></a></li>
             <li class="dropdown " style="" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img height="40px" src="/img/details/dashNav5.png" alt="Files"><span>Settings</span> <b class="caret" style=""></b></a>
              <ul class="dropdown-menu " style="background: #FFFFFF;width: 116%;">
                <li style="background: none;" class="dropdownli"><a href="javascript:void(0);" rel="<?php echo $project->id;?>" id="del-btn"><img src="/img/dashboard/remove.png"  width="30px"/><b>Delete Project</b></a></li>
                <li style="background: none;" class="dropdownli"><a href="#"><img src="/img/dashboard/move.png"  width="25px"/> <b>Move Project to Study Board</b></a></li>
                
              </ul>
            </li>
            </ul>
        </div> 
    </div>
</section>
<section class="detailMainContent"> 
	<div class="wrapper"> 
    	<?php $this->renderPartial('_discussionList', array('activities' => $project->comments,'project'=>$project)); ?>
        
        <div class="detailMainContentMain detailMainContentMainLft">
         <a id="tasks"></a>
         <h3>My Tasks</h3>
         <div class="detailMainContentListBor">
            <?php 
                $this->renderPartial('_tasklist', array('user' => $modeluser,'tasks'=>$tasks)); ?>
         </div>   
         <div class="detailMainContentMainBtn">
            	<?php $this->renderPartial('_tasks', array('task' => $task)); ?>
       
            	<!--
                <a href="javascript:void(0);"><img src="/img/details/btnMore.png" alt="More Task" /><span>More Task</span></a>
            	-->
            </div>
        </div>
        
<!--        <div class="detailMainContentMain detailMainContentMainRt">
        <h3>Group Tasks</h3>
         <div class="detailMainContentListBor">
            <div class="detailMainContentList">
            	<div class="detailMainContentList1 detailMainContentList1Sm"><img src="images/sampleImg1.png" alt="Image" /><p><b>Albert E</b><br/>Job Title Scientist</p></div>
                <div class="detailMainContentList2">
                	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquet convallis libero, ut congue leo rutrum quis. </p>
                </div>
            </div>
            
            <div class="detailMainContentList">
            	<div class="detailMainContentList1 detailMainContentList1Sm"><img src="images/sampleImg1.png" alt="Image" /><p><b>Albert E</b><br/>Job Title Scientist</p></div>
                <div class="detailMainContentList2">
                	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquet convallis libero, ut congue leo rutrum quis. </p>
                </div>
            </div>
            
            <div class="detailMainContentList">
            	<div class="detailMainContentList1 detailMainContentList1Sm"><img src="images/sampleImg1.png" alt="Image" /><p><b>Albert E</b><br/>Job Title Scientist</p></div>
                <div class="detailMainContentList2">
                	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquet convallis libero, ut congue leo rutrum quis. </p>
                </div>
            </div>
            
            <div class="detailMainContentList">
            	<div class="detailMainContentList1 detailMainContentList1Sm"><img src="images/sampleImg1.png" alt="Image" /><p><b>Albert E</b><br/>Job Title Scientist</p></div>
                <div class="detailMainContentList2">
                	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquet convallis libero, ut congue leo rutrum quis. </p>
                </div>
            </div>
            
         </div>
        </div>-->
        
        <!--  File List    -->
        <?php $this->renderPartial('//file/_list', array('project' => $project)); ?>				
            
    </div>
</section>

<div class="prmodal" id="deleteblock" style="display: none;">
<div class="prmodal-header" style=""><h3 class="alert alert-warning">Confirm delete project ? </h3></div>
<div class="prmodal-body">This project, files and discussions will be deleted. Are you sure?</div>
<div class="prmodal-footer">
        <button class="btn cl">Cancel</button>
        <button class="btn btn-primary delitem" id="">OK</button>
</div>
</div>
<div class="modal-backdrop fade in" id="hiddenel" ></div>
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
        <a href="#" ><img src="/img/dashboard/discussion.png" alt="New Project" /><span> This is a the discussion area </span></a>
    </div>
    <div class="content-part">
    <img src="/img/dashboard/p5.png"/>
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
        <a href="#" ><img src="/img/dashboard/documents_512.png" alt="This is the activity stream" /><span>This is the files area</span></a>
    </div>
    <div class="content-part">
    <img src="/img/dashboard/p6.png"/>
    </div>
    <div class="lower-part">
            <p class="links"><input type="checkbox" name="" class="setflag"/> Don't show this again</p>
<p><a href="#" class="btn-popup next2">Next</a><a href="#" class="btn-popup btn-can2">Later</a></p>

    </div>
</div>
</div>
</div>
<!----------------------------------------------->
<!------------------POP UP 3------------------->
<!--<div class="black-popup-large-3" style="">
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

</div>  -->


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
      /* $('.next2').click(function(){
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
        }); */
        
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
     <script>
    $(document).ready(function(){
        
        $('.edit-img').mouseover(function(){
            
            $('.toolpopup').show();
        });
	
         $('.edit-img').mouseout(function(){
            
            $('.toolpopup').hide();
        });
        $('#hiddenel').hide();
        $('.project-header').attr('readonly','readonly');
        
        $('#del-btn').click(function()
        {
            
            $('#hiddenel').show();
            $('#deleteblock').show(1000);
            $('#deleteblock').animate({dispay:"block",top: "20%"}, 500,function(){
                
               
            });
            
           /* var node=$(this).prop("rel");
            $('.ui-dialog-titlebar-close').text("x");
            $( "#dialog-confirm" ).dialog({
            resizable: true,
            modal: true,
            buttons: {
                        "Delete all items": function()
                         {
                         window.location.href="/project/delete_project/node/"+node;
                         $( this ).dialog( "close" );
                     },
            Cancel: function() 
                     {
                     $( this ).dialog( "close" );
                     }
             }
            });*/
        });
        
        $('.delitem').click(function(){
            node="<?php echo $project->id;?>";
            window.location.href="/project/delete_project/node/"+node;
        });
        $('.cl').click(function(){
            $('#hiddenel').hide();
            $('#deleteblock').hide(1000);
            $('#deleteblock').animate({dispay:"none",top: "-20%"}, 500,function(){
             
        });
        });
        $('.edit-img').click(function(){
             $('.project-header').click();
        });
        $('.project-header').click(function()
        {
            
            $(this).addClass("edit-project-header");
            $(this).removeAttr("readonly");
           $('.edit-img').hide();
            
        });
                                                                            
      /* $('.project-header').mouseover(function(){
            
              $('.toolpopup').css('display','block');
        });
       /* $('.project-header').mousedown(function(){
            
              $('.toolpopup').css('display','none');
        });*/
        $('.project-header').blur(function()
        {
            
           $('.toolpopup').removeClass('hiddenalert');
           var node="<?php echo $project->id;?>"
           var title=$(this).val();
            $(this).removeClass("edit-project-header");
            $(this).attr('readonly','readonly');
            $('.edit-img').show();
            if(title=="")
            {
                title="Untitled Project";
            }
            
            $.ajax({
                data:"node="+node+"&title="+title,
                url:'/project/update_title',
                type:'POST',
                beforeSend:function(){
                    $('.loadclass').css('display','block');
                },
                success:function(){},
                complete:function()
                {
                          $('.loadclass').css('display','none');
                },
            });
            
            
        });
        
      
            
       
    var mentions = [<?php foreach ($project->users as $user) { echo '"' . $user->firstName . '" ,';}?>];
                $('#newComment').textcomplete([
                    { // html
                        match: /\B@(\w*)$/,
                        search: function (term, callback) {
                            callback($.map(mentions, function (mention) {
                                return mention.toLowerCase().indexOf(term.toLowerCase()) === 0 ? mention : null;
                            }));
                        },
                        index: 1,
                        replace: function (mention) {
                            return '@' + mention + ' ';
                        }
                    }
                ]).overlay([{match: /\B@\w+/g,css: {'background-color': '#d8dfea'}}]);        
    });
</script>


