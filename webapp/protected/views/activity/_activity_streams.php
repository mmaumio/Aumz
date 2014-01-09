<?php foreach ($activities as $activity) {?>
	<li activity_id="<?= $activity->id ?>" class="activity">
  <!-- <img src="http://placehold.it/150x150" alt="Sample Image" /> -->
  <a href="/project/index/<?= $activity->projectId?>">
    
    <div class="listRt" style="width: 95%;">
      <?php if ($activity->type == "comment") { 
        $more_comment = strlen($activity->content) > 70 ? "..." : "";
        ?>
        <h6><?= $activity->user->firstName ?></h6>
        <p>added a new coment "<?= substr($activity->content, 0, 70).$more_comment ?>" to <?= $activity->project->title ?></p>
      <?php }else if ($activity->type == "user_added"){?>
        <h6><?= $activity->inviter_user->firstName ?></h6>
        <p> added <?=$activity->user->firstName?> to "<?= $activity->project->title ?>"</p>
      <?php }else if ($activity->type == "file_added"){?>
        <h6><?= $activity->user->firstName ?></h6>
        <p> added file(s) to "<?= $activity->project->title ?>"</p>
      <?php } ?>
      <div class="listRtTime"><?= GeneralFunctions::getPrettyTime($activity->created);?></div>
    </div>  
  </a>
</li>
<?php }?>