<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/css/bootstrap-theme.min.css">
  <link rel="stylesheet" type="text/css" href="/css/stylesheet.css">
	<link rel="stylesheet" type="text/css" href="/css/layout.css">
	<script type="text/javascript">   
		(function(){if(!/*@cc_on!@*/0)return;var e = "abbr,article,aside,audio,bb,canvas,datagrid,datalist,details,dialog,eventsource,figure,footer,header,hgroup,mark,menu,meter,nav,output,progress,section,time,video".split(','),i=e.length;while(i--){document.createElement(e[i])}})()
	</script>
	<!--[if lt IE 9]>
  	<script src="js/html5.js"></script>
  	<![endif]-->
</head> 
<body> 
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
<?php echo $content; ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>  
</body>
</html>
