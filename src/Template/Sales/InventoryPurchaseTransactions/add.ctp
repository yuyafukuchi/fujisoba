<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InventoryPurchaseTransaction $inventoryPurchaseTransaction
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Inventory Purchase Transactions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Inventory Items'), ['controller' => 'InventoryItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Inventory Item'), ['controller' => 'InventoryItems', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stores'), ['controller' => 'Stores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Store'), ['controller' => 'Stores', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="inventoryPurchaseTransactions form large-9 medium-8 columns content">
    <?= $this->Form->create($inventoryPurchaseTransaction) ?>
    <fieldset>
        <legend><?= __('Add Inventory Purchase Transaction') ?></legend>
        <?php
            echo $this->Form->control('inventory_item_id', ['options' => $inventoryItems]);
            echo $this->Form->control('store_id', ['options' => $stores]);
            echo $this->Form->control('transaction_date', ['empty' => true]);
            echo $this->Form->control('purchase_qty');
            echo $this->Form->control('loss_qty');
            echo $this->Form->control('count_qty');
            echo $this->Form->control('created_by');
            echo $this->Form->control('modified_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
