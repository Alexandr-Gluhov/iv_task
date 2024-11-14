<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/iv_task/logic.php');
include($_SERVER['DOCUMENT_ROOT'] . '/iv_task/templates/header.php');
?>
<div class="container mt-5">
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
                                <button class="btn btn-danger w-50">
                                    Удалить
                                </button>
                            <?php else : ?>
                                <span class="text-danger">Занято</span>
                            <?php endif ?>
                        <?php else : ?>
                            <button class="btn btn-primary w-50">
                                Записаться
                            </button>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<?php
include($_SERVER['DOCUMENT_ROOT'] . '/iv_task/templates/footer.php');
