<?php
$this->append('heading', '<p>' . $data['name'] . '</p>');
$this->append('breadcrumbs', '<p>トップ：管理者メニュー</p>');
?>

<div class="vertical-center">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3" style="zoom: 2;">
            <?php if ($data['type'] === 'H'): ?>
                <?= $this->Html->link(
                    '従業員マスタ保守',
                    ['controller'=>'Attendance/Employees'],
                    ['class' => 'btn btn-default btn-lg btn-block']
                ) ?>
                <?= $this->Html->link(
                    '勤怠データ検索',
                    ['controller'=>'Attendance/monthly-time-cards'],
                    ['class' => 'btn btn-default btn-lg btn-block', 'style' => 'margin-top: 30px;']
                ) ?>
            <?php endif; ?>

            <?php if ($data['type'] === 'M'): ?>
                <?= $this->Html->link(
                    '従業員マスタ保守',
                    ['controller'=>'Attendance/Employees'],
                    ['class' => 'btn btn-default btn-lg btn-block']
                ) ?>
                <?= $this->Html->link(
                    '勤怠データ検索',
                    ['controller'=>'Attendance/monthly-time-cards'],
                    ['class' => 'btn btn-default btn-lg btn-block', 'style' => 'margin-top: 30px;']
                ) ?>
            <?php endif; ?>

            <?php if ($data['type'] === 'G'): ?>
                エラー：このページにはアクセスできません。
            <?php endif; ?>
        </div>
    </div>
</div>

