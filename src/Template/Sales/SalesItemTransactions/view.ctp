<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesItemTransaction $salesItemTransaction
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Sales Item Transaction'), ['action' => 'edit', $salesItemTransaction->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Sales Item Transaction'), ['action' => 'delete', $salesItemTransaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $salesItemTransaction->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sales Item Transactions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sales Item Transaction'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sales Transactions'), ['controller' => 'SalesTransactions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sales Transaction'), ['controller' => 'SalesTransactions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sales Items'), ['controller' => 'SalesItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sales Item'), ['controller' => 'SalesItems', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="salesItemTransactions view large-9 medium-8 columns content">
    <h3><?= h($salesItemTransaction->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Sales Transaction') ?></th>
            <td><?= $salesItemTransaction->has('sales_transaction') ? $this->Html->link($salesItemTransaction->sales_transaction->id, ['controller' => 'SalesTransactions', 'action' => 'view', $salesItemTransaction->sales_transaction->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sales Item') ?></th>
            <td><?= $salesItemTransaction->has('sales_item') ? $this->Html->link($salesItemTransaction->sales_item->id, ['controller' => 'SalesItems', 'action' => 'view', $salesItemTransaction->sales_item->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($salesItemTransaction->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Qty') ?></th>
            <td><?= $this->Number->format($salesItemTransaction->qty) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sales Item Price') ?></th>
            <td><?= $this->Number->format($salesItemTransaction->sales_item_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sales Item Cost') ?></th>
            <td><?= $this->Number->format($salesItemTransaction->sales_item_cost) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($salesItemTransaction->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($salesItemTransaction->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($salesItemTransaction->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($salesItemTransaction->modified) ?></td>
        </tr>
    </table>
</div>
