		<div class="detailMainContentMain">
    		<a id="discussion"></a>
         	<h3>Discussion</h3>
         	<div class="detailMainContentListBor">
		        <?php foreach ($activities as $activity) { ?>
		        	<?php $this->renderPartial('_discussion', array('activity' => $activity)); ?>
		    	<?php } ?>
         	</div>
	        <div class="detailMainContentMainBtn">
	        	<a href="#" data-toggle="modal" data-target="#discussionModal"><img src="/img/details/btnAdd.png" alt="New Discussion" /><span>New Discussion</span></a>
	        	<!--
	            <a href="javascript:void(0);"><img src="/img/details/btnMore.png" alt="More Discussions" /><span>More Discussions</span></a>
	        	-->
	        </div>
        </div>

        <!-- Modal -->
		<div class="modal fade" id="discussionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">New Discussion</h4>
		      </div>
			 <form action="/activity/create" id="newCommentForm" method="POST">
			<div class="modal-body">
		        <fieldset>
		            <div class="form-group">
		                <div class="col-md-11">
						<input type="hidden" name="activity[projectId]" value="<?php echo $project->id ?>">
				<input type="hidden" name="activity[type]" value="comment">
				<textarea id="newComment" name="activity[content]" class="diss-form" placeholder="Add comment here" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 40px;" required=""></textarea>
				<div class="clear"></div>
				<button class="btn btn-primary" type="submit" style="float:right" id="submitCommentBtn">Submit Comment</button>
		                   <!-- <textarea id="textarea" name="textarea">default text</textarea>-->
		                </div>
		            </div>
		        </fieldset>
		      </div>
			  </form>
		      <!--<div class="modal-footer">
		        <button type="button" class="btn btn-primary">Add</button>
		      </div>-->
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<!-- Modal -->
		<div class="modal fade" id="collaboratorsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        <h4 class="modal-title" id="myModalLabel">Add collaborators</h4>
		      </div>
			 <form action="/project/add_collaborators" id="newCommentForm" method="POST">
			<div class="modal-body">
		        <fieldset>
		            <div class="form-group">
		                <div class="col-md-11">
						<input type="hidden" name="projectId" value="<?php echo $project->id ?>">
				<textarea id="newComment" name="names" class="diss-form" placeholder="Enter users names" style="overflow: hidden; word-wrap: break-word; resize: horizontal; height: 40px;" required=""></textarea>
				<div class="clear"></div>
				<button class="btn btn-primary" type="submit" style="float:right" id="submitCommentBtn">Submit Comment</button>
		                   <!-- <textarea id="textarea" name="textarea">default text</textarea>-->
		                </div>
		            </div>
		        </fieldset>
		      </div>
			  </form>
		      <!--<div class="modal-footer">
		        <button type="button" class="btn btn-primary">Add</button>
		      </div>-->
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->