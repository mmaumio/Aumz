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
              <li><a href="<?php echo $this->createUrl('user/profile') ?>" title="" ><img src="/img/nav/iconNav3.png" alt="icon" /></a></li>
              <?php if(!Yii::app()->user->isGuest){ ?>
              <li class="logout-button"><a href="<?php echo $this->createUrl('auth/logout') ?>" title=""  class="btn btn-primary">Logout</a></li>
              <?php } ?>
          </ul>
      </div>
  </div>
</header>
	<?php echo $content; ?>
<?php $this->endContent(); ?>