<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Time Card'), ['action' => 'edit', $timeCard->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Time Card'), ['action' => 'delete', $timeCard->id], ['confirm' => __('Are you sure you want to delete # {0}?', $timeCard->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Time Cards'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Time Card'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Stores'), ['controller' => 'Stores', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Store'), ['controller' => 'Stores', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="timeCards view large-9 medium-8 columns content">
    <h3><?= h($timeCard->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Employee') ?></th>
            <td><?= $timeCard->has('employee') ? $this->Html->link($timeCard->employee->id, ['controller' => 'Employees', 'action' => 'view', $timeCard->employee->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Store') ?></th>
            <td><?= $timeCard->has('store') ? $this->Html->link($timeCard->store->name, ['controller' => 'Stores', 'action' => 'view', $timeCard->store->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($timeCard->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Work Time') ?></th>
            <td><?= $this->Number->format($timeCard->work_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Over Time') ?></th>
            <td><?= $this->Number->format($timeCard->over_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Paid Vacation') ?></th>
            <td><?= $this->Number->format($timeCard->paid_vacation) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Paid Vacation Start Time') ?></th>
            <td><?= $this->Number->format($timeCard->paid_vacation_start_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Paid Vacation End Time') ?></th>
            <td><?= $this->Number->format($timeCard->paid_vacation_end_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Attendance Store Id') ?></th>
            <td><?= $this->Number->format($timeCard->attendance_store_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($timeCard->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($timeCard->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($timeCard->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('In Time') ?></th>
            <td><?= h($timeCard->in_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Out Time') ?></th>
            <td><?= h($timeCard->out_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('In Time2') ?></th>
            <td><?= h($timeCard->in_time2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Out Time2') ?></th>
            <td><?= h($timeCard->out_time2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Schedules In Time') ?></th>
            <td><?= h($timeCard->schedules_in_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Scheduled Out Time') ?></th>
            <td><?= h($timeCard->scheduled_out_time) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($timeCard->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($timeCard->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Note') ?></h4>
        <?= $this->Text->autoParagraph(h($timeCard->note)); ?>
    </div>
</div>
