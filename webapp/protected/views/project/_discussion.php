<div class="detailMainContentList">
	<div class="detailMainContentList1">
		<p>
			<b><?= $activity->user->firstName . " " . $activity->user->lastName;?></b><br/>
		</p>
	</div>
  <div class="detailMainContentList2">
  	<p><?= $activity->content;?></p>
  </div>
  <div class="detailMainContentList3">
  	<!-- <div class="listRtTime" title="<?= $activity->created;?>"><?= $activity->created;?></div> -->
  	<a href="/project/delete_comment/<?= $activity->id;?>" onclick="return confirm('Are you sure?')">Delete</a>
	</div>
</div>