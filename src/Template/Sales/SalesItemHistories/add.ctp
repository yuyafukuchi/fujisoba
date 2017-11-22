<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesItemHistory $salesItemHistory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Sales Item Histories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Sales Items'), ['controller' => 'SalesItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sales Item'), ['controller' => 'SalesItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="salesItemHistories form large-9 medium-8 columns content">
    <?= $this->Form->create($salesItemHistory) ?>
    <fieldset>
        <legend><?= __('Add Sales Item History') ?></legend>
        <?php
            echo $this->Form->control('sales_item_id', ['options' => $salesItems]);
            echo $this->Form->control('sales_item_name');
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
