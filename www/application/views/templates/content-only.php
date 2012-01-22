<!DOCTYPE html> 
<html>

<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 

    <title><?= $title ?></title>
    
    <?= link_tag('css/site.css') ?>
    <?= link_tag('css/content-only.css') ?>
    <?= $_styles ?>
    
    <script type="text/javascript" src="<?= base_url('js/site.js') ?>"></script>
    <?= $_scripts ?>

</head>

<body>

<div id="page-container">
    
    <div id="content">
        <h1><?= $title ?></h1>
        <?= $content ?>
    </div>

</div>

</body>

<html>
