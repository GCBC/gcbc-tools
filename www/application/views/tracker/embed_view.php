<?php

$first2000_width = "883";
$last12_width = "44";

if( $total <= 2000000 ) {
    $boundary = floor(($first2000_width * ($total/$target)));
}else{
//    $boundary = min(floor($width * ($total/$target)),$width);
    $boundary = $first2000_width + min(floor(($last12_width * ($total-2000000)/($target-2000000))),$last12_width);
}


?>

<script type="text/javascript">

setTimeout("location.href = location.href", 300*1000);

</script>

<div style="position: absolute; width: 940px; font-size: 12px;">

    <img src="<?= base_url('images/tracker/blades-distance-926.png') ?>" style="position: absolute; width: 940px; height: 740px;">
    <img src="<?= base_url('images/tracker/cover.png') ?>" style="position: absolute; z-index: 1; left: <?= $boundary+6 ?>px; width: <?= $first2000_width+$last12_width-$boundary ?>px; height: 565px;">
    
    <img src="<?= base_url('images/tracker/arrow.png') ?>" style="position: absolute; z-index: 2; left: <?= $boundary-14 ?>px; top: 535px; width: 40px; height: 40px;">    

    <div style="position: absolute; z-index: 2; top: 20px; right: 170px; width: 200px; border: 1px solid black; padding-left: 20px; padding-right: 20px; background-color: #fff">

        <p><strong>GCBC 2012km Erg Challenge</strong></p>

        <p>Distance travelled so far: <strong><?= floor($total/1000) ?>km!</strong></p>

        <p>GCBC is undertaking the challenge of rowing 2012km in 24 hours to raise money for new equipment; new womens blades and a mens scull.</p>

        <p>The challenge kicks off at 12:00 on Monday 16/01 until 12:00 on Tuesday 17/01.</p>

    </div>

    <div style="position: absolute; z-index: 2; top: 20px; right: 0px;">

        <object align="middle" allowscriptaccess="always" data="http://www.justgiving.com/widgets/jgwidget.swf" flashvars="EggId=3632220&amp;IsMS=0" height="230" type="application/x-shockwave-flash" width="150"><param name="movie" value="http://www.justgiving.com/widgets/jgwidget.swf" /><param name="allowScriptAccess" value="always" /><param name="allowNetworking" value="all" /><param name="quality" value="high" /><param name="wmode" value="transparent" /><param name="flashvars" value="EggId=3632220&amp;IsMS=0" /></object>

    </div>
    
</div>
