<?php
$this->append('heading', '<p>' . $storeName . ' / '.$user->name_first .' '. $user->name_last .' 様' . '</p>');
$breadcrumb = !empty($timeCard['support']) ? $timeCard['support'] : '勤怠入力';
$this->append('breadcrumbs', '<p>' . $breadcrumb . '</p>');
?>

<div class="vertical-center">
    <?= $this->Form->create(null) ?>
        <div class="row" style="zoom: 2;">
            <div class="col-md-3"></div>
            <div class="col-md-3 text-center">
                <?= $this->Form->input("", [
                    "type" => "text",
                    'label' => false,
                    'class' => 'input-lg',
                    'placeholder' => date('Y/m/d'),
                    'default' => date('Y/m/d'),
                    'style' => 'background-color: #f2dede !important;',
                ]) ?>
            </div>
            <div class="col-md-3 text-center">
                <?= $this->Form->input("", [
                    "type" => "text",
                    'label' => false,
                    'class' => 'input-lg',
                    'placeholder' => date('H:i:s'),
                    'default' => date('H:i:s'),
                    'style' => 'background-color: #f2dede !important;',
                ]) ?>
            </div>
        </div>
        <div class="row" style="zoom: 2;">
            <div class="col-md-3"></div>
            <div class="col-md-3 text-center text-primary">
                <?= $this->Form->submit("出勤", ['class' => 'btn btn-lg btn-blocka', 'name' => 'button'])?>

                <?php if (!empty($timeCard['in_time'])): ?>
                    <br><?= h($timeCard['in_time']->format('m/d H:i')) ?>
                <?php endif; ?>

                <?php if (!empty($timeCard['in_time2'])): ?>
                    <br><?= h($timeCard['in_time2']->format('m/d H:i')) ?>
                <?php endif; ?>
            </div>
            <div class="col-md-3 text-center text-primary">
                <?= $this->Form->submit("退勤", [
                    'class' => 'btn btn-lg btn-blocka',
                    'name' => 'button',
                    'disabled' => $timeCard['in_time']== null || ($timeCard['out_time']!= null && $timeCard['in_time2'] == null) || $timeCard['out_time2'] != null,
                ])?>

                <?php if (!empty($timeCard['out_time'])): ?>
                    <br><?= h($timeCard['out_time']->format('m/d H:i')) ?>
                <?php endif; ?>

                <?php if (!empty($timeCard['out_time2'])): ?>
                    <br><?= h($timeCard['out_time2']->format('m/d H:i')) ?>
                <?php endif; ?>
            </div>
        </div>
    <?= $this->Form->end() ?>
</div>
