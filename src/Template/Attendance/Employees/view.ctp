<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Employee'), ['action' => 'edit', $employee->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Employee'), ['action' => 'delete', $employee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employee->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Stores'), ['controller' => 'Stores', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Store'), ['controller' => 'Stores', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Time Cards'), ['controller' => 'TimeCards', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Time Card'), ['controller' => 'TimeCards', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="employees view large-9 medium-8 columns content">
    <h3><?= h($employee->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Code') ?></th>
            <td><?= h($employee->code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name Last') ?></th>
            <td><?= h($employee->name_last) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name First') ?></th>
            <td><?= h($employee->name_first) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name Last Kana') ?></th>
            <td><?= h($employee->name_last_kana) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name First Kana') ?></th>
            <td><?= h($employee->name_first_kana) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Company') ?></th>
            <td><?= $employee->has('company') ? $this->Html->link($employee->company->name, ['controller' => 'Companies', 'action' => 'view', $employee->company->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Store') ?></th>
            <td><?= $employee->has('store') ? $this->Html->link($employee->store->name, ['controller' => 'Stores', 'action' => 'view', $employee->store->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Contact Type') ?></th>
            <td><?= h($employee->contact_type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Employee Shift') ?></th>
            <td><?= h($employee->employee_shift) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($employee->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Regular Amount') ?></th>
            <td><?= $this->Number->format($employee->regular_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Midnight Amount') ?></th>
            <td><?= $this->Number->format($employee->midnight_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other1 Amount') ?></th>
            <td><?= $this->Number->format($employee->other1_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Other2 Amount') ?></th>
            <td><?= $this->Number->format($employee->other2_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Othershift Start') ?></th>
            <td><?= $this->Number->format($employee->othershift_start) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Othershift End') ?></th>
            <td><?= $this->Number->format($employee->othershift_end) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($employee->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($employee->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Joined') ?></th>
            <td><?= h($employee->joined) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Retired') ?></th>
            <td><?= h($employee->retired) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($employee->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($employee->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= $employee->deleted ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Flag') ?></th>
            <td><?= $employee->flag ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Note') ?></h4>
        <?= $this->Text->autoParagraph(h($employee->note)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Time Cards') ?></h4>
        <?php if (!empty($employee->time_cards)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Employee Id') ?></th>
                <th scope="col"><?= __('Store Id') ?></th>
                <th scope="col"><?= __('Date') ?></th>
                <th scope="col"><?= __('In Time') ?></th>
                <th scope="col"><?= __('Out Time') ?></th>
                <th scope="col"><?= __('In Time2') ?></th>
                <th scope="col"><?= __('Out Time2') ?></th>
                <th scope="col"><?= __('Schedules In Time') ?></th>
                <th scope="col"><?= __('Scheduled Out Time') ?></th>
                <th scope="col"><?= __('Work Time') ?></th>
                <th scope="col"><?= __('Over Time') ?></th>
                <th scope="col"><?= __('Paid Vacation') ?></th>
                <th scope="col"><?= __('Paid Vacation Start Time') ?></th>
                <th scope="col"><?= __('Paid Vacation End Time') ?></th>
                <th scope="col"><?= __('Note') ?></th>
                <th scope="col"><?= __('Attendance Store Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($employee->time_cards as $timeCards): ?>
            <tr>
                <td><?= h($timeCards->id) ?></td>
                <td><?= h($timeCards->employee_id) ?></td>
                <td><?= h($timeCards->store_id) ?></td>
                <td><?= h($timeCards->date) ?></td>
                <td><?= h($timeCards->in_time) ?></td>
                <td><?= h($timeCards->out_time) ?></td>
                <td><?= h($timeCards->in_time2) ?></td>
                <td><?= h($timeCards->out_time2) ?></td>
                <td><?= h($timeCards->schedules_in_time) ?></td>
                <td><?= h($timeCards->scheduled_out_time) ?></td>
                <td><?= h($timeCards->work_time) ?></td>
                <td><?= h($timeCards->over_time) ?></td>
                <td><?= h($timeCards->paid_vacation) ?></td>
                <td><?= h($timeCards->paid_vacation_start_time) ?></td>
                <td><?= h($timeCards->paid_vacation_end_time) ?></td>
                <td><?= h($timeCards->note) ?></td>
                <td><?= h($timeCards->attendance_store_id) ?></td>
                <td><?= h($timeCards->created) ?></td>
                <td><?= h($timeCards->created_by) ?></td>
                <td><?= h($timeCards->modified) ?></td>
                <td><?= h($timeCards->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TimeCards', 'action' => 'view', $timeCards->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TimeCards', 'action' => 'edit', $timeCards->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TimeCards', 'action' => 'delete', $timeCards->id], ['confirm' => __('Are you sure you want to delete # {0}?', $timeCards->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
