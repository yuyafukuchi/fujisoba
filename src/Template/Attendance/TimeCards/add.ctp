<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Time Cards'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stores'), ['controller' => 'Stores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Store'), ['controller' => 'Stores', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="timeCards form large-9 medium-8 columns content">
    <?= $this->Form->create($timeCard) ?>
    <fieldset>
        <legend><?= __('Add Time Card') ?></legend>
        <?php
            echo $this->Form->input('employee_id', ['options' => $employees]);
            echo $this->Form->input('store_id', ['options' => $stores]);
            echo $this->Form->input('date');
            echo $this->Form->input('in_time', ['empty' => true]);
            echo $this->Form->input('out_time', ['empty' => true]);
            echo $this->Form->input('in_time2', ['empty' => true]);
            echo $this->Form->input('out_time2', ['empty' => true]);
            echo $this->Form->input('schedules_in_time', ['empty' => true]);
            echo $this->Form->input('scheduled_out_time', ['empty' => true]);
            echo $this->Form->input('work_time');
            echo $this->Form->input('over_time');
            echo $this->Form->input('paid_vacation');
            echo $this->Form->input('paid_vacation_start_time');
            echo $this->Form->input('paid_vacation_end_time');
            echo $this->Form->input('note');
            echo $this->Form->input('attendance_store_id');
            echo $this->Form->input('created_by');
            echo $this->Form->input('modified_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
