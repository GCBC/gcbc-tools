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

<?= $content ?>

</body>

<html>
