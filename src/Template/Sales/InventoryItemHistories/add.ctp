<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InventoryItemHistory $inventoryItemHistory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Inventory Item Histories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Inventory Items'), ['controller' => 'InventoryItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Inventory Item'), ['controller' => 'InventoryItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="inventoryItemHistories form large-9 medium-8 columns content">
    <?= $this->Form->create($inventoryItemHistory) ?>
    <fieldset>
        <legend><?= __('Add Inventory Item History') ?></legend>
        <?php
            echo $this->Form->control('inventory_item_id', ['options' => $inventoryItems]);
            echo $this->Form->control('item_name');
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
