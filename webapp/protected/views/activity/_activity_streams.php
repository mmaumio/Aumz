<ul>
<?php foreach ($activities as $activity) {?>
	<li>
  	<img src="http://placehold.it/150x150" alt="Sample Image" />
      <div class="listRt">
        <?php if ($activity->type == "comment") { ?>
          <h6><?= $activity->user->firstName ?></h6>
          <p>added a new coment "<?= $activity->content ?>" to <?= $activity->project->title ?></p>
        <?php }else if ($activity->type == "user_added"){?>
          <h6><?= $activity->inviter_user->firstName ?></h6>
          <p> added <?=$activity->user->firstName?> to "<?= $activity->project->title ?>"</p>
        <?php }else if ($activity->type == "file_added"){?>
          <h6><?= $activity->user->firstName ?></h6>
          <p> uploaded a file "<?= $activity->project->title ?>"</p>
        <?php } ?>
        <div class="listRtTime"><?= GeneralFunctions::getPrettyTime($activity->created);?></div>
      </div>	
  </li>
<?php }?>
</ul>