<script language="javascript" src="<?php js_src('list.js') ?>"></script>
<script language="javascript" src="<?php js_src('jQuery.fn.sortElements.js') ?>"></script>

<script type="text/javascript">
    var list = new list_rules();
    list.init();
</script>

<table class="header">
  <tr>
        <td class="title"><?php out('Rules Configuration'); ?></td>
        <td>
            <a href="index.php?action=edit!summary" class="iframe_medium css_button"><span>Add new</span></a>
        </td>
  </tr>
</table>

<div class="rule_container text">
    <div class="rule_row header">
        <span class="rule_title header_title"><?php out('Name') ?></span>
        <span class="rule_type header_type"><?php out('Type') ?></span>
    </div>
</div>

<!-- template -->
<div class="rule_row data template">
    <span class="rule_title"><a href="index.php?action=detail!view"></a></span>
    <span class="rule_type"><a href="index.php?action=detail!view"></a></span>
</div>

