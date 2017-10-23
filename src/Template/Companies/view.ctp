<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Company'), ['action' => 'edit', $company->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Company'), ['action' => 'delete', $company->id], ['confirm' => __('Are you sure you want to delete # {0}?', $company->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Companies'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Company'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Stores'), ['controller' => 'Stores', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Store'), ['controller' => 'Stores', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="companies view large-9 medium-8 columns content">
    <h3><?= h($company->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Code') ?></th>
            <td><?= h($company->code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($company->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($company->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($company->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($company->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start Date') ?></th>
            <td><?= h($company->start_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End Date') ?></th>
            <td><?= h($company->end_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($company->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($company->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Employees') ?></h4>
        <?php if (!empty($company->employees)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Code') ?></th>
                <th scope="col"><?= __('Name Last') ?></th>
                <th scope="col"><?= __('Name First') ?></th>
                <th scope="col"><?= __('Name Last Kana') ?></th>
                <th scope="col"><?= __('Name First Kana') ?></th>
                <th scope="col"><?= __('Company Id') ?></th>
                <th scope="col"><?= __('Store Id') ?></th>
                <th scope="col"><?= __('Contact Type') ?></th>
                <th scope="col"><?= __('Joined') ?></th>
                <th scope="col"><?= __('Retired') ?></th>
                <th scope="col"><?= __('Deleted') ?></th>
                <th scope="col"><?= __('Note') ?></th>
                <th scope="col"><?= __('Flag') ?></th>
                <th scope="col"><?= __('Regular Amount') ?></th>
                <th scope="col"><?= __('Midnight Amount') ?></th>
                <th scope="col"><?= __('Other1 Amount') ?></th>
                <th scope="col"><?= __('Other2 Amount') ?></th>
                <th scope="col"><?= __('Employee Shift') ?></th>
                <th scope="col"><?= __('Othershift Start') ?></th>
                <th scope="col"><?= __('Othershift End') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($company->employees as $employees): ?>
            <tr>
                <td><?= h($employees->id) ?></td>
                <td><?= h($employees->code) ?></td>
                <td><?= h($employees->name_last) ?></td>
                <td><?= h($employees->name_first) ?></td>
                <td><?= h($employees->name_last_kana) ?></td>
                <td><?= h($employees->name_first_kana) ?></td>
                <td><?= h($employees->company_id) ?></td>
                <td><?= h($employees->store_id) ?></td>
                <td><?= h($employees->contact_type) ?></td>
                <td><?= h($employees->joined) ?></td>
                <td><?= h($employees->retired) ?></td>
                <td><?= h($employees->deleted) ?></td>
                <td><?= h($employees->note) ?></td>
                <td><?= h($employees->flag) ?></td>
                <td><?= h($employees->regular_amount) ?></td>
                <td><?= h($employees->midnight_amount) ?></td>
                <td><?= h($employees->other1_amount) ?></td>
                <td><?= h($employees->other2_amount) ?></td>
                <td><?= h($employees->employee_shift) ?></td>
                <td><?= h($employees->othershift_start) ?></td>
                <td><?= h($employees->othershift_end) ?></td>
                <td><?= h($employees->created) ?></td>
                <td><?= h($employees->created_by) ?></td>
                <td><?= h($employees->modified) ?></td>
                <td><?= h($employees->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Employees', 'action' => 'view', $employees->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Employees', 'action' => 'edit', $employees->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Employees', 'action' => 'delete', $employees->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employees->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Stores') ?></h4>
        <?php if (!empty($company->stores)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Code') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Company Id') ?></th>
                <th scope="col"><?= __('Pay Department Code') ?></th>
                <th scope="col"><?= __('Fin Department Code') ?></th>
                <th scope="col"><?= __('Start Date') ?></th>
                <th scope="col"><?= __('End Date') ?></th>
                <th scope="col"><?= __('Regular Start Time') ?></th>
                <th scope="col"><?= __('Regular End Time') ?></th>
                <th scope="col"><?= __('Midnight Start Time') ?></th>
                <th scope="col"><?= __('Midnight End Time') ?></th>
                <th scope="col"><?= __('Other1 Start Time') ?></th>
                <th scope="col"><?= __('Other1 End Time') ?></th>
                <th scope="col"><?= __('Other2 Start Time') ?></th>
                <th scope="col"><?= __('Other2 End Time') ?></th>
                <th scope="col"><?= __('Early Start Time') ?></th>
                <th scope="col"><?= __('Early End Time') ?></th>
                <th scope="col"><?= __('Middle Start Time') ?></th>
                <th scope="col"><?= __('Middle End Time') ?></th>
                <th scope="col"><?= __('Late Start Time') ?></th>
                <th scope="col"><?= __('Late End Time') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($company->stores as $stores): ?>
            <tr>
                <td><?= h($stores->id) ?></td>
                <td><?= h($stores->code) ?></td>
                <td><?= h($stores->name) ?></td>
                <td><?= h($stores->company_id) ?></td>
                <td><?= h($stores->pay_department_code) ?></td>
                <td><?= h($stores->fin_department_code) ?></td>
                <td><?= h($stores->start_date) ?></td>
                <td><?= h($stores->end_date) ?></td>
                <td><?= h($stores->regular_start_time) ?></td>
                <td><?= h($stores->regular_end_time) ?></td>
                <td><?= h($stores->midnight_start_time) ?></td>
                <td><?= h($stores->midnight_end_time) ?></td>
                <td><?= h($stores->other1_start_time) ?></td>
                <td><?= h($stores->other1_end_time) ?></td>
                <td><?= h($stores->other2_start_time) ?></td>
                <td><?= h($stores->other2_end_time) ?></td>
                <td><?= h($stores->early_start_time) ?></td>
                <td><?= h($stores->early_end_time) ?></td>
                <td><?= h($stores->middle_start_time) ?></td>
                <td><?= h($stores->middle_end_time) ?></td>
                <td><?= h($stores->late_start_time) ?></td>
                <td><?= h($stores->late_end_time) ?></td>
                <td><?= h($stores->created) ?></td>
                <td><?= h($stores->created_by) ?></td>
                <td><?= h($stores->modified) ?></td>
                <td><?= h($stores->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Stores', 'action' => 'view', $stores->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Stores', 'action' => 'edit', $stores->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Stores', 'action' => 'delete', $stores->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stores->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Users') ?></h4>
        <?php if (!empty($company->users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Code') ?></th>
                <th scope="col"><?= __('Company Id') ?></th>
                <th scope="col"><?= __('Store Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Password') ?></th>
                <th scope="col"><?= __('Type') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($company->users as $users): ?>
            <tr>
                <td><?= h($users->id) ?></td>
                <td><?= h($users->code) ?></td>
                <td><?= h($users->company_id) ?></td>
                <td><?= h($users->store_id) ?></td>
                <td><?= h($users->name) ?></td>
                <td><?= h($users->password) ?></td>
                <td><?= h($users->type) ?></td>
                <td><?= h($users->created) ?></td>
                <td><?= h($users->created_by) ?></td>
                <td><?= h($users->modified) ?></td>
                <td><?= h($users->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
