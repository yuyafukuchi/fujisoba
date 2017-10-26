<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MonthlyTimeCard $monthlyTimeCard
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Monthly Time Cards'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="monthlyTimeCards form large-9 medium-8 columns content">
    <?= $this->Form->create($monthlyTimeCard) ?>
    <fieldset>
        <legend><?= __('Add Monthly Time Card') ?></legend>
        <?php
            echo $this->Form->control('employee_id', ['options' => $employees]);
            echo $this->Form->control('date');
            echo $this->Form->control('latest_emboss_day', ['empty' => true]);
            echo $this->Form->control('finished');
            echo $this->Form->control('printed');
            echo $this->Form->control('approved');
            echo $this->Form->control('csv_exported');
            echo $this->Form->control('created_by');
            echo $this->Form->control('modified_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
