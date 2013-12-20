<script type='text/javascript'>
    $(document).ready(function() {
        $('#LoginForm_password').val("");
        $('#login-form-ajaxcall').submit(function(e){
            if(parseInt("<?php if(isset(Yii::app()->request->cookies['user_trails'])){echo Yii::app()->request->cookies['user_trails']->value;}else{echo 0;} ?>") > parseInt("2")){
                 e.preventDefault();
                 alert("Would you like to reset your password?");
                 <?php if(isset(Yii::app()->request->cookies['user_trails']) && (Yii::app()->request->cookies['user_trails']->value > 2 )){unset(Yii::app()->request->cookies['user_trails']);} ?>
                location.reload();
            }
        })
    })
</script>
<!--Page 1 Start-->
<section class="homePage1">
  <div class="homePage1Main">
    <div class="wrapper">
      <!--Logo For Desktop-->
       <?php if(Yii::app()->user->isGuest){ ?>
      <div><a href="/" title="Stirlpate" class="logo" >&nbsp;</a></div>
       <?php }else{ ?>
       <div><a href="<?php echo $this->createUrl('dashboard') ?>" title="Stirlpate" class="logo" >&nbsp;</a></div>
       <?php } ?>
      
      <!--Logo For Responsive-->
      <div class="logoRespo"><a href="javasccript:void(0);" title="Stirplate"><img src="/img/home/logoHomeRespo.jpg" alt="Logo" /></a></div>
      
      <div class="homeRt">
        <div class="signIn">
          <h3>Sign In to Stirplate</h3>
          <div class="signInMain">
            <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'login-form-ajaxcall'
            )); ?>
                     <?php echo $form->error($model,'email'); ?>
                     <?php echo $form->error($model,'password'); ?>
                    <div class="control-group">
                        <div class="controls">
                            <?php echo $form->textField($model,'email',array('placeholder'=>'Email')); ?>
                        </div>
                    </div>
                    <div class="control-group">
                             <div class="controls">
                            <?php echo $form->passwordField($model,'password',array('placeholder'=>'Password')); ?>
                            </div>
                    </div>
                    <label class="floatRt">
                             <?php echo CHtml::link('Forgot your passssword?', 'site/ForgotPassword') ?>
                    </label>
                    <div class="control-group buttons">
                         <div class="controls">
                            <?php echo CHtml::submitButton('SIGN IN'); ?>
                              </div>
                    </div>
            <?php $this->endWidget(); ?>
          </div>
        </div>
        <div class="signUp">
          <h3>Stirplate Newsletter</h3>
          <h4 align ="center"> We are currently invite only. Sign up for updates</h4>
          <div class="signUpMain">
            <input type="text" value="" name="" placeholder="Email Address" />
            <input type="submit" value="SIGNUP" name="" />
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--Page 1 End--> 

<!--Page 2 Start-->
<section class="page2">
  <div class="wrapper">
    <div class="page2Main">
      <h1>Welcome to Stirplate </h1>
 <h3>Simplify your lab</h3>
       <img src="/img/home/textShadow.png" alt="Shadow" />
      <div class="homeBoxMain">
        <div class="homeBox"> <img src="/img/home/icon1.png" alt="Icon 1" />
          <h3>Data Management</h3>
          <p>Access your data anywhere at anytime </p>
        </div>
        <div class="homeBox"> <img src="/img/home/icon2.png" alt="Icon 2" />
          <h3>Simple collaboration</h3>
            <p>Share years of research data in seconds </p>
        </div>
        <div class="homeBox homeBoxLst"> <img src="/img/home/icon3.png" alt="Icon 3" />
          <h3>Centralized communication</h3>
          <p>Discuss, assign tasks, and view progress in one centralized area</p>
        </div>
      </div>
      <div class="homeBoxMain">
        <div class="homeBox"> <img src="/img/home/icon4.png" alt="Icon 4" />
          <h3>Automated data analysis</h3>
          <p>Go from excel to beautiful graphs in seconds, not hours</p>
        </div>
        <div class="homeBox"> <img src="/img/home/icon5.png" alt="Icon 5" />
          <h3>Experiment management</h3>
          <p>View your entire lab's progress, easily </p>
        </div>
        <div class="homeBox homeBoxLst"> <img src="/img/home/icon6.png" alt="Icon 6" />
          <h3>Safe and secure</h3>
          <p>Never worry about lost or corrupt files</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!--Page 2 End--> 

<!--Page 3 Start-->
<section class="page3">
  <div class="wrapper">
   <div class="page3Main">
                  <iframe src="//player.vimeo.com/video/75926086?title=0&amp;byline=0&amp;portrait=0" width="1020" height="640" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
  
   </div>
   </div>
</section>
<!--Page 3 End--> 

<!--Page 4 Start-->
<!--<section class="page4">
  <div class="wrapper">
    <div class="page4Main">
      <h2>About Us</h2>
      <div class="page4MainLft"> <img src="/img/home/aboutImg1.jpg" alt="About Us" />
        <h3>Keith Gonzales PhD</h3>
        <p>A former hacker turned neuroscientist, Keith has worked professionally in IT for 4 years and has been in science for over 8 years. Holding positions at Columbia University and Weill Cornell Medical College, Keith tends to like the finer things in life, such as powdered donuts.</p>
        <div class="aboutSmLft"> <a href="javascript:void(0);" title="Facebook"><img src="/img/home/iconFb.png" alt="Facebook" /></a> <a href="javascript:void(0);" title="Linkedin"><img src="/img/home/iconIn.png" alt="Linkedin" /></a> <a href="javascript:void(0);" title="Twitter"><img src="/img/home/iconTwt.png" alt="Twitter" /></a> </div>
      </div>
      <div class="page3MainRt">
        <div class="page3MainRtMain">
          <h1> Science is hard </h1>
          <ul> We don't believe it should be. Stirplate was founded as an answer to the following questions that I frequently asked myself in the lab: </ul>
            <br>
                <li> "Isn't there a faster way to do this?" 
                  <li> "Isn't there a better way to share files?" 
                      <li> "I can't open that file, I'm on a (Mac or PC)
                        <li> " I can't find that attachment!" </li>
          </ul>
        </br>
<h4>We've all been there and it's frustrating. The current tools to fix these problems tend to be difficult to use. So we made something that is easy, simple, and address the needs of scientists.</h4>
        </div>
    </div>                  
	<dsds></dsdsd>
  </div>
</section>-->
<!--Page 4 End--> 

<!--Page 5 Start-->
<section class="contact">
  <div class="wrapper">
    <div class="contactMain">
      <div class="contactMainHead">
        <div class="contactMainHeadBox">
          <!--<h2>Contact us</h2>-->
		  <p class="homelinks">
			<span><a href="site/aboutus">About us</a></span>
			<span><a href="site/privacy">Privacy and terms of service</a></span>
			<span><a href="site/faq">FAQ</a></span>
			<span><a href="mailto:info@stirplate.io">Contact us</a></span>
			<span><a href="site/blog">Blog</a></span>
			<span class=""><a href="#">Follow us :</a> 
			     <a target="_blank" href="https://www.Facebook.com/stirplate" class="middle-content"><i class="facebook-class"></i></a> 
				<a target="_blank;" href="https://www.twitter.com/stirplate" class="middle-content"><i class="twitter-class"></i></a>
			</span>
			
		<p>
<!--<h3>Want to know more about what we are up to? Send us a message </h3> -->       </div>
      </div>
      <!--<div class="contactForm">
        <div class="contactFormMain">
          <div class="contactFormMainLft">
            <input type="text" value="" name="" placeholder="NAME" />
            <input type="text" value="" name="" placeholder="COMPANY" />
            <input type="text" value="" name="" placeholder="EMAIL" />
          </div>
          <div class="contactFormMainRt">
            <textarea></textarea>
            <input type="submit" value="SEND" name="" />
          </div>
        </div>
      </div>-->
    </div>
  </div>
</section>

