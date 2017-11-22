<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesItem $salesItem
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $salesItem->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $salesItem->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Sales Items'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Sales Item Assign Histories'), ['controller' => 'SalesItemAssignHistories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sales Item Assign History'), ['controller' => 'SalesItemAssignHistories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sales Item Histories'), ['controller' => 'SalesItemHistories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sales Item History'), ['controller' => 'SalesItemHistories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sales Item Transactions'), ['controller' => 'SalesItemTransactions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sales Item Transaction'), ['controller' => 'SalesItemTransactions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="salesItems form large-9 medium-8 columns content">
    <?= $this->Form->create($salesItem) ?>
    <fieldset>
        <legend><?= __('Edit Sales Item') ?></legend>
        <?php
            echo $this->Form->control('sales_item_number');
            echo $this->Form->control('created_by');
            echo $this->Form->control('modified_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
