<?php
require_once($_SERVER['DOCUMENT_ROOT'] .  '/iv_task/.core/index.php');

if (isset($_GET['success']) && $_GET['success'] == 'y') {
    header("Location: /iv_task/authentication/login.php");
    die();
}

include($_SERVER['DOCUMENT_ROOT'] . '/iv_task/templates/header.php');
?>

<div class="container mt-3">

    <?php foreach(UserActions::signUp() as $err): ?>
        <div class="alert alert-danger"><?=$err?></div>
    <?php endforeach; ?>
    <form method="post" action="">
        <input value="signup" name="action" hidden>
        <input <?= !empty($_POST['email']) ? 'value="' . $_POST['email']. '"' : ''; ?> name="email" class="my-2 form-control" placeholder="Введите почту" type="email">
        <input <?= !empty($_POST['name']) ? 'value="' . $_POST['name']. '"' : ''; ?> name="name" class="my-2 form-control" placeholder="Введите ФИО" type="text">
        <div class="group-form">
            <label>Введите дату рождения:</label>
            <input <?= !empty($_POST['birth_date']) ? 'value="' . $_POST['birth_date']. '"' : ''; ?> name="birth_date" class="my-2 form-control" type="date">
        </div>
        Выберите свой пол
        <input value="M" id="radio-male" class="my-2 form-check-input" type="radio" name="sex" <?= !isset($_POST['sex']) || $_POST['sex'] === 'M' ? "checked" : ''?>>
        <label for="radio-male">Мужской</label>
        <input value="F" id="radio-female" class="my-2 form-check-input" type="radio" name="sex" <?= isset($_POST['sex']) && $_POST['sex'] === 'F' ? "checked" : ''?>>
        <label for="radio-female">Женский</label><br>
        Выберите свою группу крови
        <select name="blood_type" class="my-2 form-control">
            <?php for($i = 1; $i <= 4; $i++): ?>
                <option <?= isset($_POST['blood_type']) && $_POST['blood_type'] === "$i" ? 'selected' : ''?>><?=$i?></option>
            <?php endfor ?>
        </select>
        Выберите свой резус-фактор
        <input value="+" id="radio-rhesus-positive" class="my-2 form-check-input" type="radio" name="factor" <?= !isset($_POST['factor']) || $_POST['factor'] === '+' ? "checked" : ''?>>
        <label for="radio-rhesus-positive">+</label>
        <input value="-" id="radio-rhesus-negative" class="my-2 form-check-input" type="radio" name="factor" <?= isset($_POST['factor']) && $_POST['factor'] === '-' ? "checked" : ''?>>
        <label for="radio-rhesus-negative">-</label>
        <div class="form-group">
            <input class="form-control mb-2" type="password" name="password" placeholder="Введите пароль">
            <input class="form-control" type="password" name="password_confirm" placeholder="Подтвердите пароль">
        </div>
        <button type="submit" class="btn btn-primary w-100 my-3">Зарегистрироваться</button>
    </form>

</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/iv_task/templates/footer.php');?>