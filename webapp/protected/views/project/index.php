<section class="detailMain">
	<div class="wrapper">
        <div class="detailMainGreen">
         
            <h3 class="mainheader">
            <div class="toolpopup">Click on title to edit</div>
               <input value="<?php echo $project->title ?>" type="text" style="" class="project-header"/><img class="loadclass" src="/img/dashboard/loadimage.gif"/></h3>
            <div class="detailMainGreenImg">
            	<h3> Project members: </h3> 
                    
                <?php foreach ($project->users as $user) { ?>            		
            		<h3><?php echo $user->firstName  ?>
                    <a href="/project/remove_collaborator/<?php echo $project->id ?>?userId=<?php echo $user->id ?>">x</a>
                    <br />
            	<?php } ?> </h3>
                <script type="text/javascript">
                    var names_array = [ <?php foreach ($all_users as $user) {

                        echo "\"" . $user->firstName . " " . $user->lastName . "\" ,";

                    } ?> ]
                 
                $(document).ready(function() {
                    $("#names").select2({tags:names_array, width: "400"});
                    $("#names").on("change", function(e) {
                      $("#mynames").val($("#names").select2("val").join(","));
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
             <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img height="40px" src="/img/details/dashNav5.png" alt="Files"><span>Settings</span> <b class="caret" style=""></b></a>
              <ul class="dropdown-menu" style="background: #FFFFFF;">
                <li style="background: none;"><a href="javascript:void(0);" rel="<?php echo $project->id;?>" id="del-btn">Delete Study</a></li>
                <li style="background: none;"><a href="#">Move Project to Study Board</a></li>
                
              </ul>
            </li>
            </ul>
        </div> 
    </div>
</section>
<section class="detailMainContent"> 
	<div class="wrapper"> 
    	<?php $this->renderPartial('_discussionList', array('activities' => $project->activities,'project'=>$project)); ?>
        
        <div class="detailMainContentMain detailMainContentMainLft">
         <a id="tasks"></a>
         <h3>My Tasks</h3>
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
         <div class="detailMainContentMainBtn">
            	<a href="javascript:void(0);"><img src="/img/details/btnAdd.png" alt="New Task" /><span>New Task</span></a>
            	<!--
                <a href="javascript:void(0);"><img src="/img/details/btnMore.png" alt="More Task" /><span>More Task</span></a>
            	-->
            </div>
        </div>
        
        <div class="detailMainContentMain detailMainContentMainRt">
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
        </div>
        
        
        <!--<div class="detailMainContentMain">
         <a id="files"></a>
         <h3>
         	Files
         	
         	<span class="floatRt">
	         	<input type="text" value="" name="" placeholder="Filter File Type" class="inputFilter" />
	         	<input type="text" value="" name="" placeholder="Search File" class="inputSearch" /> 
         	</span>
         	
     	</h3>
         <div class="detailMainContentListBor">
            
            <div class="detailMainContentList">
            	<div class="detailMainContentList1"><img src="images/sampleImg1.png" alt="Image" /><p><b>Albert E</b><br/>Job Title Scientist</p></div>
                <div class="detailMainContentList2">
                	<p>
                    	<span><img src="/img/details/greenIcon1.png" alt="Icon" />10 Documents</span>
                        <span><img src="/img/details/greenIcon2.png" alt="Icon" />24 Pictures</span>
                        <span><img src="/img/details/greenIcon3.png" alt="Icon" />14 Audio</span>
                        <span><img src="/img/details/greenIcon4.png" alt="Icon" />14 Videos</span>
                    </p>
                </div>
                <div class="detailMainContentList3"><div class="listRtTime">5 minutes ago</div></div>
            </div>
            
            <div class="detailMainContentList">
            	<div class="detailMainContentList1"><img src="images/sampleImg1.png" alt="Image" /><p><b>Albert E</b><br/>Job Title Scientist</p></div>
                <div class="detailMainContentList2">
                	<p>
                    	<span><img src="/img/details/greenIcon1.png" alt="Icon" />10 Documents</span>
                        <span><img src="/img/details/greenIcon2.png" alt="Icon" />24 Pictures</span>
                        <span><img src="/img/details/greenIcon3.png" alt="Icon" />14 Audio</span>
                        <span><img src="/img/details/greenIcon4.png" alt="Icon" />14 Videos</span>
                    </p>
                </div>
                <div class="detailMainContentList3"><div class="listRtTime">5 minutes ago</div></div>
            </div>
            
            <div class="detailMainContentList">
            	<div class="detailMainContentList1"><img src="images/sampleImg1.png" alt="Image" /><p><b>Albert E</b><br/>Job Title Scientist</p></div>
                <div class="detailMainContentList2">
                	<p>
                    	<span><img src="/img/details/greenIcon1.png" alt="Icon" />10 Documents</span>
                        <span><img src="/img/details/greenIcon2.png" alt="Icon" />24 Pictures</span>
                        <span><img src="/img/details/greenIcon3.png" alt="Icon" />14 Audio</span>
                        <span><img src="/img/details/greenIcon4.png" alt="Icon" />14 Videos</span>
                    </p>
                </div>
                <div class="detailMainContentList3"><div class="listRtTime">5 minutes ago</div></div>
            </div>
            
            <div class="detailMainContentList">
            	<div class="detailMainContentList1"><img src="images/sampleImg1.png" alt="Image" /><p><b>Albert E</b><br/>Job Title Scientist</p></div>
                <div class="detailMainContentList2">
                	<p>
                    	<span><img src="/img/details/greenIcon1.png" alt="Icon" />10 Documents</span>
                        <span><img src="/img/details/greenIcon2.png" alt="Icon" />24 Pictures</span>
                        <span><img src="/img/details/greenIcon3.png" alt="Icon" />14 Audio</span>
                        <span><img src="/img/details/greenIcon4.png" alt="Icon" />14 Videos</span>
                    </p>
                </div>
                <div class="detailMainContentList3"><div class="listRtTime">5 minutes ago</div></div>
            </div>
         </div>-->
            <!--<div class="detailMainContentMainBtn">
            	<a href="#addAttachmentModal" role="button" data-toggle="modal"><img src="/img/details/btnAdd.png" alt="Add Files" /><span>Add Files</span></a>
				

				
				<?php // $this->renderPartial('//attachment/_list', array('project'=>$project)); ?> 
            	<!--
                <a href="javascript:void(0);"><img src="/img/details/btnMore.png" alt="More Files" /><span>More Files</span></a>
            	
            </div>-->
			<?php $this->renderPartial('//file/_list', array('project' => $project)); ?>				
        </div>
    </div>
</section>
<div id="dialog-confirm" title="Delete Project ?" style="display:none;">
<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>These items will be permanently deleted and cannot be recovered. Are you sure?</p>
</div>

       <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
 
 <script>
    $(document).ready(function(){
        $('.project-header').attr('readonly','readonly');
        $('#del-btn').click(function()
        {
            var node=$(this).prop("rel");
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
            });
        });
        
        $('.project-header').click(function()
        {
            
            $(this).addClass("edit-project-header");
            $(this).removeAttr("readonly");
            $('.toolpopup').addClass('hiddenalert');
            
        });
        $('.project-header').focus(function()
        {
            
            $('.toolpopup').addClass('hiddenalert');
            
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
        
      
            
       
            
    });
</script>
