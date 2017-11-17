<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesItem[]|\Cake\Collection\CollectionInterface $salesItems
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Sales Item'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sales Item Assign Histories'), ['controller' => 'SalesItemAssignHistories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sales Item Assign History'), ['controller' => 'SalesItemAssignHistories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sales Item Histories'), ['controller' => 'SalesItemHistories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sales Item History'), ['controller' => 'SalesItemHistories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sales Item Transactions'), ['controller' => 'SalesItemTransactions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sales Item Transaction'), ['controller' => 'SalesItemTransactions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="salesItems index large-9 medium-8 columns content">
    <h3><?= __('Sales Items') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sales_item_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified_by') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($salesItems as $salesItem): ?>
            <tr>
                <td><?= $this->Number->format($salesItem->id) ?></td>
                <td><?= $this->Number->format($salesItem->sales_item_number) ?></td>
                <td><?= h($salesItem->created) ?></td>
                <td><?= $this->Number->format($salesItem->created_by) ?></td>
                <td><?= h($salesItem->modified) ?></td>
                <td><?= $this->Number->format($salesItem->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $salesItem->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $salesItem->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $salesItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $salesItem->id)]) ?>
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
