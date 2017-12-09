<?php
$this->append('menu', '<li><a href="/users/sales">売上管理</a></li>');
$this->append('menu', '<li><a href="/users/attendance">勤怠管理</a></li>');
?>

<div class="page-users-index">
    <?php if ($data['type'] === 'H'): ?>
        <?= $this->Html->link('売上管理', ['controller'=>'Users', 'action'=>'sales'], ['class' => 'btn-30pct']) ?>
        <?= $this->Html->link('勤怠管理', ['controller'=>'Users', 'action'=>'attendance'], ['class' => 'btn-30pct bg-blue']) ?>
    <?php endif; ?>

    <?php if ($data['type'] === 'M'): ?>
        <?= $this->Html->link('売上管理', ['controller'=>'Users', 'action'=>'sales'], ['class' => 'btn-30pct']) ?>
        <?= $this->Html->link('勤怠管理', ['controller'=>'Users', 'action'=>'attendance'], ['class' => 'btn-30pct bg-blue']) ?>
    <?php endif; ?>

    <?php if ($data['type'] === 'G'): ?>
        エラー：このページにはアクセスできません。
    <?php endif; ?>
</div>
