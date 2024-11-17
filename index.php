<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/iv_task/logic.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/iv_task/templates/header.php');
?>

<div class="container mt-5">
    <?php if (!empty($action_error)): ?>
        <div class="alert alert-danger"><?=$action_error?></div>
    <?php endif ?>
    <form method="get" class="row">
        <div class="col">
            <select name="specialist" class="form-control">
                <option value="">Специалист</option>

                <?php foreach (SpecialistTable::getAll() as $specialist): ?>
                    <option value="<?= $specialist['id'] ?>" <?= isset($_GET['specialist']) && $_GET['specialist'] == $specialist['id'] ? 'selected' : '' ?>><?= $specialist['name'] ?></option>
                <?php endforeach ?>

            </select>
        </div>
        <div class="col">
            <select name="date" class="form-control">
                <option value="">Дата</option>

                <?php foreach (ReceptionHourTable::getAllDaysFromNow() as $day): ?>
                    <option <?= isset($_GET['date']) && $_GET['date'] == $day['date'] ? 'selected' : '' ?>><?= $day['date'] ?></option>
                <?php endforeach ?>

            </select>
        </div>
        <div class="col d-flex flex-row-reverse">
            <button type="submit" class="btn btn-primary">Показать варианты</button>
        </div>
    </form>
    <table class="table text-center">
        <thead>
            <tr>
                <th scope="col">Специалист</th>
                <th scope="col">ФИО</th>
                <th scope="col">Дата</th>
                <th scope="col">Время</th>
                <th scope="col">Запись</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($stmt as $row): ?>
                <?php $row = array_map(fn($value) => !is_null($value) ? htmlspecialchars($value) : '', $row); ?>
                <tr>
                    <th><?= $row['specialist'] ?></th>
                    <td><?= $row['doctor_name'] ?></td>
                    <td><?= $row['date'] ?></td>
                    <td><?= $row['time'] ?></td>
                    <td>
                        <?php if (!empty($row['user_id'])): ?>
                            <?php if ($_SESSION['USER_ID'] == $row['user_id']): ?>
                                <form method="post">
                                    <input value="<?= $row['appointment_id'] ?>" name="delete_appointment" hidden>
                                    <button type="submit" class="btn btn-danger w-50">
                                        Удалить
                                    </button>
                                </form>
                            <?php else : ?>
                                <span class="text-danger">Занято</span>
                            <?php endif ?>
                        <?php else : ?>
                            <form method="post">
                                <input value="<?= $row['appointment_id'] ?>" name="add_to_appointment" hidden>
                                <button class="btn btn-primary w-50">
                                    Записаться
                                </button>
                            </form>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>

        </tbody>
    </table>
</div>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/iv_task/templates/footer.php');
