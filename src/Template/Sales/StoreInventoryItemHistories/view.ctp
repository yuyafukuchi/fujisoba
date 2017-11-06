<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StoreInventoryItemHistory $storeInventoryItemHistory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Store Inventory Item History'), ['action' => 'edit', $storeInventoryItemHistory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Store Inventory Item History'), ['action' => 'delete', $storeInventoryItemHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $storeInventoryItemHistory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Store Inventory Item Histories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Store Inventory Item History'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Inventory Items'), ['controller' => 'InventoryItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Inventory Item'), ['controller' => 'InventoryItems', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Stores'), ['controller' => 'Stores', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Store'), ['controller' => 'Stores', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="storeInventoryItemHistories view large-9 medium-8 columns content">
    <h3><?= h($storeInventoryItemHistory->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Inventory Item') ?></th>
            <td><?= $storeInventoryItemHistory->has('inventory_item') ? $this->Html->link($storeInventoryItemHistory->inventory_item->id, ['controller' => 'InventoryItems', 'action' => 'view', $storeInventoryItemHistory->inventory_item->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Store') ?></th>
            <td><?= $storeInventoryItemHistory->has('store') ? $this->Html->link($storeInventoryItemHistory->store->name, ['controller' => 'Stores', 'action' => 'view', $storeInventoryItemHistory->store->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($storeInventoryItemHistory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($storeInventoryItemHistory->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cost') ?></th>
            <td><?= $this->Number->format($storeInventoryItemHistory->cost) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($storeInventoryItemHistory->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($storeInventoryItemHistory->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start') ?></th>
            <td><?= h($storeInventoryItemHistory->start) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End') ?></th>
            <td><?= h($storeInventoryItemHistory->end) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($storeInventoryItemHistory->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($storeInventoryItemHistory->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= $storeInventoryItemHistory->deleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
