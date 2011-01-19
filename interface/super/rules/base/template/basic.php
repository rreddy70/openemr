<html>
<head>
<?php html_header_show();?>
<link rel="stylesheet" href="<?= $GLOBALS['css_header'] ?>" type="text/css">
<script type="text/javascript" src="<?= $GLOBALS['webroot']; ?>/library/js/jquery.js"></script>

</head>

<body class='body_top'>
<?php
if ( file_exists($viewBean->_view_body) ) {
    require_once($viewBean->_view_body);
}
?>

</body>

</html>