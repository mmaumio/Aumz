<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link rel="stylesheet" type="text/css" href="/css/layout.css">
    <link href='http://fonts.googleapis.com/css?family=Exo+2:400,300' rel='stylesheet' type='text/css'>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        <?php 
                $controller = Yii::app()->getController();
                $isHome = $controller->getId() === 'site' && $controller->getAction()->getId() === 'index' || $controller->getAction()->getId() === 'newsletter';
                if($isHome){
        ?>
        <link rel="stylesheet" type="text/css" href="/css/home/stylesheet.css">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
        <?php }else{ ?>
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
    
        <link rel="stylesheet" type="text/css" href="/css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="/css/stylesheet.css">
        <link rel="stylesheet" type="text/css" href="/css/select2.css">
        <?php } ?>

        <script type="text/javascript" src="/css/select2.min.js"></script>
        <script type="text/javascript" src="/css/jquery.textcomplete.min.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">

	<script type="text/javascript">  
            function downloadFile(path)
                  {
                    //alert(path);

                    var a = $("<a>").attr("href", path).attr("download", "").appendTo("body");
                    a[0].click();
                    a.remove();
                   
                   }
            
        </script>
        	
<script type="text/javascript">(function(e,b){if(!b.__SV){var a,f,i,g;window.mixpanel=b;a=e.createElement("script");a.type="text/javascript";a.async=!0;a.src=("https:"===e.location.protocol?"https:":"http:")+'//cdn.mxpnl.com/libs/mixpanel-2.2.min.js';f=e.getElementsByTagName("script")[0];f.parentNode.insertBefore(a,f);b._i=[];b.init=function(a,e,d){function f(b,h){var a=h.split(".");2==a.length&&(b=b[a[0]],h=a[1]);b[h]=function(){b.push([h].concat(Array.prototype.slice.call(arguments,0)))}}var c=b;"undefined"!==
typeof d?c=b[d]=[]:d="mixpanel";c.people=c.people||[];c.toString=function(b){var a="mixpanel";"mixpanel"!==d&&(a+="."+d);b||(a+=" (stub)");return a};c.people.toString=function(){return c.toString(1)+".people (stub)"};i="disable track track_pageview track_links track_forms register register_once alias unregister identify name_tag set_config people.set people.set_once people.increment people.append people.track_charge people.clear_charges people.delete_user".split(" ");for(g=0;g<i.length;g++)f(c,i[g]);
b._i.push([a,e,d])};b.__SV=1.2}})(document,window.mixpanel||[]);
mixpanel.init("d73cb76dfc76cd5e9e694a59afb99ab8");
<?php if(isset(Yii::app()->session['event']) && !empty(Yii::app()->session['event'])){
    foreach(Yii::app()->session['event'] as $data)
    {
    ?>
mixpanel.identify('<?php echo $data['initiator']; ?>');
mixpanel.people.set({
    $email: '<?php echo $data['initiator']; ?>',
    
    $name: '<?php echo $data['initiator']; ?>'
});    
mixpanel.track(
    '<?php echo $data['activity']; ?>',
    { 'Initiator': '<?php echo $data['initiator'];?>',
       'Description': '<?php echo $data['description']; ?>' 
     });
<?php }
Yii::app()->session['event']=array();
}

 ?>
</script>
</head> 
<body>

<?php $this->widget('ext.AnalyticsTrackingWidget');?>
<?php echo $content; ?>
<script type="text/javascript" src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>  
</body>
</html>
