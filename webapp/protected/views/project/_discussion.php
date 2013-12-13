				<div class="detailMainContentList">
		        	<div class="detailMainContentList1"><img src="images/sampleImg1.png" alt="Image" /><p><b><?= $activity->user->firstName . " " . $activity->user->lastName;?></b><br/>Job Title <?=$activity->user->position?></p></div>
		            <div class="detailMainContentList2">
		            	<p><?= $activity->content;?></p>
		            </div>
		            <div class="detailMainContentList3"><div class="listRtTime" title="<?= $activity->created;?>"><?= $activity->created;?></div></div>
		        </div>