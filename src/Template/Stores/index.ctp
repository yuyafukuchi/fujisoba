<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Store'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cash Account Trans'), ['controller' => 'CashAccountTrans', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cash Account Tran'), ['controller' => 'CashAccountTrans', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Inventory Purchase Transactions'), ['controller' => 'InventoryPurchaseTransactions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Inventory Purchase Transaction'), ['controller' => 'InventoryPurchaseTransactions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sales Transactions'), ['controller' => 'SalesTransactions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sales Transaction'), ['controller' => 'SalesTransactions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Store Account Infos'), ['controller' => 'StoreAccountInfos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Store Account Info'), ['controller' => 'StoreAccountInfos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Store Inventory Item Histories'), ['controller' => 'StoreInventoryItemHistories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Store Inventory Item History'), ['controller' => 'StoreInventoryItemHistories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Time Cards'), ['controller' => 'TimeCards', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Time Card'), ['controller' => 'TimeCards', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="stores index large-9 medium-8 columns content">
    <h3><?= __('Stores') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pay_department_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fin_department_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('start_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('end_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('regular_start_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('regular_end_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('midnight_start_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('midnight_end_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('other1_start_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('other1_end_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('other2_start_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('other2_end_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('early_start_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('early_end_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('middle_start_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('middle_end_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('late_start_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('late_end_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified_by') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($stores as $store): ?>
            <tr>
                <td><?= $this->Number->format($store->id) ?></td>
                <td><?= h($store->code) ?></td>
                <td><?= h($store->name) ?></td>
                <td><?= $store->has('company') ? $this->Html->link($store->company->name, ['controller' => 'Companies', 'action' => 'view', $store->company->id]) : '' ?></td>
                <td><?= h($store->pay_department_code) ?></td>
                <td><?= h($store->fin_department_code) ?></td>
                <td><?= h($store->start_date) ?></td>
                <td><?= h($store->end_date) ?></td>
                <td><?= $this->Number->format($store->regular_start_time) ?></td>
                <td><?= $this->Number->format($store->regular_end_time) ?></td>
                <td><?= $this->Number->format($store->midnight_start_time) ?></td>
                <td><?= $this->Number->format($store->midnight_end_time) ?></td>
                <td><?= $this->Number->format($store->other1_start_time) ?></td>
                <td><?= $this->Number->format($store->other1_end_time) ?></td>
                <td><?= $this->Number->format($store->other2_start_time) ?></td>
                <td><?= $this->Number->format($store->other2_end_time) ?></td>
                <td><?= $this->Number->format($store->early_start_time) ?></td>
                <td><?= $this->Number->format($store->early_end_time) ?></td>
                <td><?= $this->Number->format($store->middle_start_time) ?></td>
                <td><?= $this->Number->format($store->middle_end_time) ?></td>
                <td><?= $this->Number->format($store->late_start_time) ?></td>
                <td><?= $this->Number->format($store->late_end_time) ?></td>
                <td><?= h($store->created) ?></td>
                <td><?= $this->Number->format($store->created_by) ?></td>
                <td><?= h($store->modified) ?></td>
                <td><?= $this->Number->format($store->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $store->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $store->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $store->id], ['confirm' => __('Are you sure you want to delete # {0}?', $store->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
