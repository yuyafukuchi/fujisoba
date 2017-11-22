<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesItemTransaction $salesItemTransaction
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $salesItemTransaction->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $salesItemTransaction->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Sales Item Transactions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Sales Transactions'), ['controller' => 'SalesTransactions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sales Transaction'), ['controller' => 'SalesTransactions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sales Items'), ['controller' => 'SalesItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sales Item'), ['controller' => 'SalesItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="salesItemTransactions form large-9 medium-8 columns content">
    <?= $this->Form->create($salesItemTransaction) ?>
    <fieldset>
        <legend><?= __('Edit Sales Item Transaction') ?></legend>
        <?php
            echo $this->Form->control('sales_transaction_id', ['options' => $salesTransactions]);
            echo $this->Form->control('sales_item_id', ['options' => $salesItems]);
            echo $this->Form->control('qty');
            echo $this->Form->control('sales_item_price');
            echo $this->Form->control('sales_item_cost');
            echo $this->Form->control('created_by');
            echo $this->Form->control('modified_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
