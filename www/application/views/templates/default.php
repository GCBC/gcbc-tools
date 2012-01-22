<!DOCTYPE html> 
<html>

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 

    <title><?= $title ?></title>
    
    <?= link_tag('css/site.css') ?>
    <?= $_styles ?>
    
    <script type="text/javascript" src="<?= base_url('js/site.js') ?>"></script>
    <?= $_scripts ?>

</head>

<body>

<div id="page-container">

    <div id="header">
        <div>
            <h1>GCBC Tools</h1>
            <ul class="menu">
                <li><?= anchor('itemised_bill_emailer', 'Itemised Bill Emailer'); ?></li>
                <li><?= anchor('tracker', 'Tracker'); ?></li>
                <li><?= anchor('user/logout', 'Logout'); ?></li>
            </ul>
        </div>
        <div>
            <h2><?= $title ?></h2>
        </div>
    </div>
    
    <div id="content"><?= $content ?></div>

</div>

</body>

<html>
