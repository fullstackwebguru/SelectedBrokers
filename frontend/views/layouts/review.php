<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <link href="data:image/x-icon;base64,AAABAAEAEBAAAAEAIABoBAAAFgAAACgAAAAQAAAAIAAAAAEAIAAAAAAAAAQAABILAAASCwAAAAAAAAAAAAAAAAAAlZifvJ6gqOIyQVriK0Rz4itFeeItP2Dij5Kc4qGjq+I0NTi+GxsbYQEBAQ8AAAAAAAAAAAAAAAAAAAAAAAAAANjb39bY29//ABQh/wAaN/8AIlX/ACRb/622xf/y9Pr/VldZ/k5OTv8nJyf0EhISpwQEBCkAAAAAAAAAAAAAAADY29/W3OHq/4uUn/+Fj5v/hY6b/4WOnP/L0d//5ejy/1tcXv5UVFT/R0dH/yQkJP8LCwtlAAAAAAAAAAAAAAAA2dzf1nmOr/9tk6X/P2uA/0KCm/9Jb4L/dJGj/5Wftf9gYWP+aWlp/2dvdP8sNTr/CwsLZQAAAAAAAAAAAAAAANze4NaeqLz/laOz/4udr/+MorT/jZ2u/42Xpv/CyNP/Zmdp/oeHh/+BhYb/WGp1/wsLC2UAAAAAAAAAAAAAAADb7vWl1O/4/87p8v/N6fL/z+rz/87q8v+00dr/uNbf/4ezyP17e3v/WVlZ/2R6hv8MDQ5lAAAAAAAAAAAAAAAA6f//DPf6/9Du7vj/6+v1/+3t9//s7Pb/4OHs/7/Ez//Y7f3/jKW8/llZWf9ndHr/IjtMZQAAAAAAAAAAAAAAAAAAAADx8f+C4ODh/8/P0f/Q0NH/0NDR/9DQ0v/R0dL/0tLT/+Dg7f9kZGX/S09Q/4m0yYEAAAAAAAAAAAAAAAAAAAAA8fH/hJ+fn/95s8r/n5+f/2uluP+OkZL/l3+K/3Vxcv/d3en/bGxt/0pKSv9xkqLP9f//AQAAAAAAAAAAAAAAAPLy/4S6urr/mdnm/8rKyv+Xlpv/srKy/6XP6f+mrbP/39/r/3Nzdf9SUlL/b4GKzWmw1SYAAAAAAAAAAAAAAADy8v+Enp6e/291qP+fn5//d3qm/5eXmv+Ekaz/iIiP/+Dg6/97e3z/Wlpa/zxCTos7TpWPAAAAAAAAAAAAAAAA8/P/hISOo/9YZnz/W2Z9/1xof/9cZ37/WWR7/1hje//c3ev/g4OE/2JiYv8dHT9/ExOwgwAAAAAAAAAAAAAAAPPz/4RIYI7/JFhz/zZsi/8+d5j/RXGR/ytceP8XPmf/0NXr/4mJiv9ra2v/KSkpZQAAAAAAAAAAAAAAAAAAAAD09P+ERVyL/xtLZ/8sXHz/L2aI/ydhgv8bUnD/Dj5u/9DV7f+Ojo//cnJy/y0tLWUAAAAAAAAAAAAAAAAAAAAA8vL/ecbN4fi4wdn8uMHZ/LjB2vy4wdr8uMHb/LjC3Pzc3e75n5+g/Xt7e/8yMjJlAAAAAAAAAAAAAAAAAAAAAP///wXY2+Emsre+daSqsbqlqrLApaqywKWqssClqrLAqa62vsXK0LDCw8SqTU1NSQAAAAAAAAAAgA8AAIADAACAAwAAgAMAAIADAACAAwAAgAMAAMADAADAAQAAwAEAAMABAADAAQAAwAMAAMADAADAAwAAwAMAAA==" rel="icon" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700%7CTitillium+Web" rel="stylesheet">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

    <?= $this->render(
        'header.php'
    ) ?>

    <?= Alert::widget() ?>

    <?= $content ?>

    <?= $this->render(
        'footer.php'
    ) ?>   
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script',' https://www.google-analytics.com/analytics.js','ga');

// ga('create', 'UA-87288532-1', 'auto');
ga('create', 'UA-90817129-1', 'auto');
ga('send', 'pageview');

</script>


<script>
/**
* Function that tracks a click on an outbound link in Analytics.
* This function takes a valid URL string as an argument, and uses that URL string
* as the event label. Setting the transport method to 'beacon' lets the hit be sent
* using 'navigator.sendBeacon' in browser that support it.
*/
var trackOutboundLink = function(casino, url, pos) {
   var label = pos ? (casino + ' : ' + pos)  : casino;
   ga('send', 'event', 'outbound', 'visit_broker', label, {
        'transport': 'beacon',
        'hitCallback': function(){
            window.open( url,  '_blank');
        }
   });
}
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
