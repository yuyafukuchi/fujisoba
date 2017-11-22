<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InventoryPurchaseTransaction $inventoryPurchaseTransaction
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Inventory Purchase Transaction'), ['action' => 'edit', $inventoryPurchaseTransaction->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Inventory Purchase Transaction'), ['action' => 'delete', $inventoryPurchaseTransaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $inventoryPurchaseTransaction->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Inventory Purchase Transactions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Inventory Purchase Transaction'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Inventory Items'), ['controller' => 'InventoryItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Inventory Item'), ['controller' => 'InventoryItems', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Stores'), ['controller' => 'Stores', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Store'), ['controller' => 'Stores', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="inventoryPurchaseTransactions view large-9 medium-8 columns content">
    <h3><?= h($inventoryPurchaseTransaction->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Inventory Item') ?></th>
            <td><?= $inventoryPurchaseTransaction->has('inventory_item') ? $this->Html->link($inventoryPurchaseTransaction->inventory_item->id, ['controller' => 'InventoryItems', 'action' => 'view', $inventoryPurchaseTransaction->inventory_item->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Store') ?></th>
            <td><?= $inventoryPurchaseTransaction->has('store') ? $this->Html->link($inventoryPurchaseTransaction->store->name, ['controller' => 'Stores', 'action' => 'view', $inventoryPurchaseTransaction->store->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($inventoryPurchaseTransaction->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Purchase Qty') ?></th>
            <td><?= $this->Number->format($inventoryPurchaseTransaction->purchase_qty) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Loss Qty') ?></th>
            <td><?= $this->Number->format($inventoryPurchaseTransaction->loss_qty) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Count Qty') ?></th>
            <td><?= $this->Number->format($inventoryPurchaseTransaction->count_qty) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($inventoryPurchaseTransaction->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($inventoryPurchaseTransaction->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Transaction Date') ?></th>
            <td><?= h($inventoryPurchaseTransaction->transaction_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($inventoryPurchaseTransaction->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($inventoryPurchaseTransaction->modified) ?></td>
        </tr>
    </table>
</div>
