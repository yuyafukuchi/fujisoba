<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InventoryItemHistory $inventoryItemHistory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Inventory Item History'), ['action' => 'edit', $inventoryItemHistory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Inventory Item History'), ['action' => 'delete', $inventoryItemHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $inventoryItemHistory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Inventory Item Histories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Inventory Item History'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Inventory Items'), ['controller' => 'InventoryItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Inventory Item'), ['controller' => 'InventoryItems', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="inventoryItemHistories view large-9 medium-8 columns content">
    <h3><?= h($inventoryItemHistory->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Inventory Item') ?></th>
            <td><?= $inventoryItemHistory->has('inventory_item') ? $this->Html->link($inventoryItemHistory->inventory_item->id, ['controller' => 'InventoryItems', 'action' => 'view', $inventoryItemHistory->inventory_item->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Item Name') ?></th>
            <td><?= h($inventoryItemHistory->item_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($inventoryItemHistory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($inventoryItemHistory->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($inventoryItemHistory->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start') ?></th>
            <td><?= h($inventoryItemHistory->start) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End') ?></th>
            <td><?= h($inventoryItemHistory->end) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($inventoryItemHistory->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($inventoryItemHistory->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= $inventoryItemHistory->deleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
