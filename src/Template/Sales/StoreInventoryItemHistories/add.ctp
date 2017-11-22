<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StoreInventoryItemHistory $storeInventoryItemHistory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Store Inventory Item Histories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Inventory Items'), ['controller' => 'InventoryItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Inventory Item'), ['controller' => 'InventoryItems', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stores'), ['controller' => 'Stores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Store'), ['controller' => 'Stores', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="storeInventoryItemHistories form large-9 medium-8 columns content">
    <?= $this->Form->create($storeInventoryItemHistory) ?>
    <fieldset>
        <legend><?= __('Add Store Inventory Item History') ?></legend>
        <?php
            echo $this->Form->control('inventory_item_id', ['options' => $inventoryItems]);
            echo $this->Form->control('store_id', ['options' => $stores]);
            echo $this->Form->control('price');
            echo $this->Form->control('cost');
            echo $this->Form->control('start', ['empty' => true]);
            echo $this->Form->control('end', ['empty' => true]);
            echo $this->Form->control('deleted');
            echo $this->Form->control('created_by');
            echo $this->Form->control('modified_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
