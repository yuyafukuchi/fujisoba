<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesTransaction[]|\Cake\Collection\CollectionInterface $salesTransactions
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Sales Transaction'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stores'), ['controller' => 'Stores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Store'), ['controller' => 'Stores', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Menus'), ['controller' => 'Menus', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Menu'), ['controller' => 'Menus', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sales Item Transactions'), ['controller' => 'SalesItemTransactions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sales Item Transaction'), ['controller' => 'SalesItemTransactions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="salesTransactions index large-9 medium-8 columns content">
    <h3><?= __('Sales Transactions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('store_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('transaction_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('menu_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('menu_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('menu_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('qty') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cash_sales_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pasmo_sales_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sales_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified_by') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($salesTransactions as $salesTransaction): ?>
            <tr>
                <td><?= $this->Number->format($salesTransaction->id) ?></td>
                <td><?= $salesTransaction->has('store') ? $this->Html->link($salesTransaction->store->name, ['controller' => 'Stores', 'action' => 'view', $salesTransaction->store->id]) : '' ?></td>
                <td><?= h($salesTransaction->transaction_date) ?></td>
                <td><?= $salesTransaction->has('menu') ? $this->Html->link($salesTransaction->menu->id, ['controller' => 'Menus', 'action' => 'view', $salesTransaction->menu->id]) : '' ?></td>
                <td><?= $this->Number->format($salesTransaction->menu_number) ?></td>
                <td><?= h($salesTransaction->menu_name) ?></td>
                <td><?= $this->Number->format($salesTransaction->qty) ?></td>
                <td><?= $this->Number->format($salesTransaction->cash_sales_amount) ?></td>
                <td><?= $this->Number->format($salesTransaction->pasmo_sales_amount) ?></td>
                <td><?= $this->Number->format($salesTransaction->sales_amount) ?></td>
                <td><?= h($salesTransaction->created) ?></td>
                <td><?= $this->Number->format($salesTransaction->created_by) ?></td>
                <td><?= h($salesTransaction->modified) ?></td>
                <td><?= $this->Number->format($salesTransaction->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $salesTransaction->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $salesTransaction->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $salesTransaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $salesTransaction->id)]) ?>
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
