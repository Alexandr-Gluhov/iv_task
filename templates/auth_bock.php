<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/iv_task/.core/index.php');
?>

<?php if (isset($_SESSION['user_id'])) :?>
                Вы вошли под именем
<?php else :?>
                Вы не вошли в систему
<?php endif?>