<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<header>
  <div class="wrapper">
      <div class="logo"><a href="/" title="Stirplate"><img src="/img/nav/logo.png" alt="Stirplate" /></a></div>
      <div class="headerNav">
          <ul>
              <!--
              <li><a href="javascript:void(o);" title="" ><img src="/img/nav/iconNav1.png" alt="icon" /></a></li>
              <li><a href="javascript:void(o);" title="" ><img src="/img/nav/iconNav2.png" alt="icon" /></a></li>
              -->
              <li><a href="javascript:void(o);" title="" ><img src="/img/nav/iconNav3.png" alt="icon" /></a></li>
          </ul>
      </div>
  </div>
</header>
<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-5 last">
	<div id="sidebar">
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operations',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
	?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>