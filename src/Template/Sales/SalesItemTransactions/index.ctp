<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesItemTransaction[]|\Cake\Collection\CollectionInterface $salesItemTransactions
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Sales Item Transaction'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sales Transactions'), ['controller' => 'SalesTransactions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sales Transaction'), ['controller' => 'SalesTransactions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sales Items'), ['controller' => 'SalesItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sales Item'), ['controller' => 'SalesItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="salesItemTransactions index large-9 medium-8 columns content">
    <h3><?= __('Sales Item Transactions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sales_transaction_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sales_item_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('qty') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sales_item_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sales_item_cost') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified_by') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($salesItemTransactions as $salesItemTransaction): ?>
            <tr>
                <td><?= $this->Number->format($salesItemTransaction->id) ?></td>
                <td><?= $salesItemTransaction->has('sales_transaction') ? $this->Html->link($salesItemTransaction->sales_transaction->id, ['controller' => 'SalesTransactions', 'action' => 'view', $salesItemTransaction->sales_transaction->id]) : '' ?></td>
                <td><?= $salesItemTransaction->has('sales_item') ? $this->Html->link($salesItemTransaction->sales_item->id, ['controller' => 'SalesItems', 'action' => 'view', $salesItemTransaction->sales_item->id]) : '' ?></td>
                <td><?= $this->Number->format($salesItemTransaction->qty) ?></td>
                <td><?= $this->Number->format($salesItemTransaction->sales_item_price) ?></td>
                <td><?= $this->Number->format($salesItemTransaction->sales_item_cost) ?></td>
                <td><?= h($salesItemTransaction->created) ?></td>
                <td><?= $this->Number->format($salesItemTransaction->created_by) ?></td>
                <td><?= h($salesItemTransaction->modified) ?></td>
                <td><?= $this->Number->format($salesItemTransaction->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $salesItemTransaction->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $salesItemTransaction->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $salesItemTransaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $salesItemTransaction->id)]) ?>
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
