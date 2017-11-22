<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesTransaction $salesTransaction
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $salesTransaction->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $salesTransaction->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Sales Transactions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Stores'), ['controller' => 'Stores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Store'), ['controller' => 'Stores', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Menus'), ['controller' => 'Menus', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Menu'), ['controller' => 'Menus', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sales Item Transactions'), ['controller' => 'SalesItemTransactions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sales Item Transaction'), ['controller' => 'SalesItemTransactions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="salesTransactions form large-9 medium-8 columns content">
    <?= $this->Form->create($salesTransaction) ?>
    <fieldset>
        <legend><?= __('Edit Sales Transaction') ?></legend>
        <?php
            echo $this->Form->control('store_id', ['options' => $stores]);
            echo $this->Form->control('transaction_date');
            echo $this->Form->control('menu_id', ['options' => $menus, 'empty' => true]);
            echo $this->Form->control('menu_number');
            echo $this->Form->control('menu_name');
            echo $this->Form->control('qty');
            echo $this->Form->control('cash_sales_amount');
            echo $this->Form->control('pasmo_sales_amount');
            echo $this->Form->control('sales_amount');
            echo $this->Form->control('created_by');
            echo $this->Form->control('modified_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
