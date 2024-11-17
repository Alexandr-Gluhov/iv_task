<?php
include($_SERVER['DOCUMENT_ROOT'] . '/iv_task/templates/header.php');
require_once($_SERVER['DOCUMENT_ROOT'] .  '/iv_task/.core/index.php');

$error = UserActions::signIn();

if (isset($_SESSION['USER_ID'])) {
    header("Location: /iv_task/index.php");
    die();
}

?>

<div class="container mt-3">
    <?php if (isset($_GET['success']) && $_GET['success'] == 'y'): ?>
        <div class="alert alert-success">Вы успешно зарегистрированы</div>
    <?php endif ?>
    <?php if ($error !== '') : ?>
        <div class="alert alert-danger"><?=$error?></div>
    <?php endif; ?>
    <form method="post" action="/iv_task/authentication/login.php">
        <input value="signin" name="action" hidden>
        <input value="<?= !empty($_POST['email']) ? $_POST['email'] : ''; ?>" name="email" class="my-2 form-control" placeholder="Введите почту" type="email">
        <input class="form-control mb-2" type="password" name="password" placeholder="Введите пароль">
        <button type="submit" class="btn btn-primary w-100 my-3">Войти</button>
    </form>    
</div>

<?php
include($_SERVER['DOCUMENT_ROOT'] . '/iv_task/templates/footer.php');
?>