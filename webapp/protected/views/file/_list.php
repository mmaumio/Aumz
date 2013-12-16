<h2>Files</h2>

	<div class="span12 discussions pull-left" style="margin-left:0">
		<div class="experiments-add">

			<?php if (!empty($project->files)) { ?>
				<?php $ctr = 0; ?>
				<?php foreach ($project->files as $data) { ?>
					<?php 
						$projectCreated = new DateTime($data->created);
						$projectCreated->setTimeZone(new DateTimeZone('America/New_York'));
					?>
					
						<div class="experiment-item">
							<h3><?php echo CHtml::link($data->name, '/file/download/' . $data->id, array('objId' => $data->id, 'data-toggle' => 'modal')) ?> - <?php echo $data->mimetype ?></h3>
							<p><?php echo $projectCreated->format('M j, Y') ?> by <?php echo isset($data->user) ? CHtml::link($data->user->getName(), array('user/view', 'id' => $data->userId)) : '' ?></p>
						</div>
					
				<?php } ?>

			<?php } ?>
		</div>

		<div class="clear">&nbsp;</div>

		<input type="filepicker" 
		data-fp-apikey="<?php echo Yii::app()->params['filepickerioapikey'] ?>" 
		data-fp-mimetypes="*/*" 
		data-fp-container="modal"
		data-fp-multiple="true" 
		data-fp-services="COMPUTER,BOX,DROPBOX"
		data-fp-button-text="Add Files" 
		onchange="processFpResponse(event);"
		class="btn btn-success fpaddfiles" >
		
			
	</div>


<script>

var processFpResponse = function(event) {
	//console.log(event);

	// file uploaded successfully

	// save record to DB

	var data = {},
		length = event.fpfiles.length,
		attachments = [],
		file,
		i = -1;

	while (++i < length)
	{
		file = event.fpfiles[i];

		attachments.push({
			filename : file.filename,
			mimetype : file.mimetype,
			url : file.url,
			projectId : <?php echo $project->id ?>
		});
	}

	//console.log("attachments", attachments);

	data['attachments'] = attachments;

	//console.log(data);

	$.post('/file/ajaxCreate', data, function(data, textStatus, jqXHR) {
		// refresh page
		location.reload();
	});

}
</script>
		<style>

		.replyForm {
			display:none;
		}

		.discussions ul li ul.discussion-replies {
			margin:0 0 0 50px;
		}

		.discussions ul li ul.discussion-replies .message {
			margin:15px -10px 0 50px;
		}

		.experiments {
			height:350px;
		}
		.collaborators, .experiments-add{
		box-sizing: border-box;
		}
		.attachments, .tasks {
			float:right;
			background: white;
			padding: 1%;
			box-sizing: border-box;
			box-shadow: 1px 1px 1px gray;
			border-radius: 2px;
			-webkit-box-shadow: 0 1px 0 1px #e4e6eb;
			-moz-box-shadow: 0 1px 0 1px #e4e6eb;
			box-shadow: 0 1px 0 1px #e4e6eb;
			margin-bottom:3%;
		}
		.discussions a{
		color:#08c;
		}
		.discussions ul li {
		list-style: none;
		position:relative;
		-webkit-border-radius:2px;
		-moz-border-radius:2px;
		border-radius:2px;
		-webkit-box-shadow:0 1px 0 1px #e4e6eb;
		-moz-box-shadow:0 1px 0 1px #e4e6eb;
		box-shadow:0 1px 0 1px #e4e6eb;
		background:#fff;
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;
		box-sizing:border-box;
		margin-top:20px;
		margin-bottom:20px;
		/*margin-right:40px;*/
		padding:10px 0 10px 10px;
		}

		.discussions ul li:before {
		content:'';
		width:20px;
		height:20px;
		top:15px;
		left:-20px;
		position:absolute;
		}

		.discussions ul li .author {
		z-index:1;
		margin-right:1%;
		float:left;
		top:0;
		}

		.discussions ul li .author img {
		height:50px;
		-webkit-border-radius:50em;
		-moz-border-radius:50em;
		border-radius:50em;
		-webkit-box-shadow:0 1px 0 1px #e4e6eb;
		-moz-box-shadow:0 1px 0 1px #e4e6eb;
		box-shadow:0 1px 0 1px #e4e6eb;
		}

		.discussion ul li .actvity-content {
			margin-left:50px;
		}

		.discussions ul li .name {
		-webkit-border-radius:2px 0 0 2px;
		-moz-border-radius:2px 0 0 2px;
		border-radius:2px 0 0 2px;
		padding:0 10px;
		}

		.discussions ul li .date {
		position:absolute;
		top:10px;
		right:0;
		z-index:1;
		background:#f3f4f6;
		font-size:.7em;
		-webkit-border-radius:2px 0 0 2px;
		-moz-border-radius:2px 0 0 2px;
		border-radius:2px 0 0 2px;
		padding:5px 50px 5px 10px;
		}

		.discussions ul li .delete {
		position:absolute;
		-webkit-border-radius:0 2px 2px 0;
		-moz-border-radius:0 2px 2px 0;
		border-radius:0 2px 2px 0;
		background:#e4e6eb;
		top:10px;
		right:0;
		display:inline-block;
		cursor:pointer;
		padding:5px 10px;
		z-index:999;
		}

		.discussions ul li .message {
		margin:15px -10px 0 60px;
		padding:0px;
		}

		.discussions ul.children{
		padding-left:10px;
		}

		.discussions ul li ul {
		overflow:hidden;
		}

		.discussions ul li ul li{
		-webkit-box-shadow:none;
		-moz-box-shadow:none;
		box-shadow:none;
		border-bottom:1px solid #e4e6eb;
		margin:0;
		}
		.discussions ul.children li {
		//border-top:1px solid #e4e6eb;
		}

		.discussions ul li ul li .author {
		top:10px;
		left:10px;
		}

		.discussions ul li ul li .author img {
		height:40px;
		-webkit-border-radius:50em;
		-moz-border-radius:50em;
		border-radius:50em;
		-webkit-box-shadow:0 1px 0 1px #e4e6eb;
		-moz-box-shadow:0 1px 0 1px #e4e6eb;
		box-shadow:0 1px 0 1px #e4e6eb;
		}

		.discussions ul li ul li .name {
		left:70px;
		}

		/*
		.discussions ul li ul li .date {
		background:transparent;
		right:30px;
		}
		*/

		.discussions ul li ul li textarea {
		border:0;
		background:rgba(199, 203, 213, 0.15);
		-webkit-box-shadow:none;
		-moz-box-shadow:none;
		box-shadow:none;
		width:100%;
		padding:5px;
		}
		.discussions ul li ul li textarea::-webkit-input-placeholder {
		color:gray!important;
		font-size:.7em;
		}
		.discussions ul li ul li textarea:-moz-placeholder { /* Firefox 18- */
		color:gray!important;
		}

		.discussions ul li ul li textarea::-moz-placeholder {  /* Firefox 19+ */
		color:gray!important;  
		}

		.discussions ul li ul li textarea:-ms-input-placeholder {  
		color:gray!important;
		}
		.discussions .attachment{
		margin-top:10px;
		font-size:.85em;
		}
		.discussions ul{
		margin-left:0px;
		}
		.discussions .attachment li{
		border: none;
		padding: 0 10px;
		}
		.discussions .attachment i{
		margin-right:1%;
		}
		.discussions .attachment a{
		cursor: pointer;
		}
		.discussions .reply-footer a{
		float:right;
		}
	</style>
	<!-- start: JavaScript-->

	<script type="text/javascript" src="/js/custom.min.js"></script>	
	<!-- js usages -->
	<script type="text/javascript" src="/js/core.min.js"></script>	
	<script type="text/javascript" src="/js/jquery.transit.min.js"></script>	

	
	<!-- end: JavaScript-->

	
  	
	<!-- webengage feedback tab -->
	<script id="_webengage_script_tag" type="text/javascript">
	  var _weq = _weq || {};
	  _weq['webengage.licenseCode'] = "~99198d06";
	  _weq['webengage.widgetVersion'] = "4.0";
	  //_weq['webengage.feedback.alignment'] = 'left';
	  
	  (function(d){
	    var _we = d.createElement('script');
	    _we.type = 'text/javascript';
	    _we.async = true;
	    _we.src = (d.location.protocol == 'https:' ? "https://ssl.widgets.webengage.com" : "http://cdn.widgets.webengage.com") + "/js/widget/webengage-min-v-4.0.js";
	    var _sNode = d.getElementById('_webengage_script_tag');
	    _sNode.parentNode.insertBefore(_we, _sNode);
	  })(document);
	</script>

	<script type="text/javascript" src="/clickheat/js/clickheat.js"></script><noscript><p><a href="http://www.dugwood.com/index.html">Open Source Sofware</a></p></noscript><script type="text/javascript"><!--
	clickHeatSite = 'omni';clickHeatGroup = (document.title == '' ? '-none-' : encodeURIComponent(document.title));clickHeatServer = '/clickheat/click.php';initClickHeat(); //-->
	</script>

	<script type="text/javascript" src="//api.filepicker.io/v1/filepicker.js"></script>