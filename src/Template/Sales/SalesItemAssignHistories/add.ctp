<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesItemAssignHistory $salesItemAssignHistory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Sales Item Assign Histories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Menus'), ['controller' => 'Menus', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Menu'), ['controller' => 'Menus', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sales Items'), ['controller' => 'SalesItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sales Item'), ['controller' => 'SalesItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="salesItemAssignHistories form large-9 medium-8 columns content">
    <?= $this->Form->create($salesItemAssignHistory) ?>
    <fieldset>
        <legend><?= __('Add Sales Item Assign History') ?></legend>
        <?php
            echo $this->Form->control('menu_item_id', ['options' => $menus]);
            echo $this->Form->control('sales_item_id', ['options' => $salesItems, 'empty' => true]);
            echo $this->Form->control('start', ['empty' => true]);
            echo $this->Form->control('end', ['empty' => true]);
            echo $this->Form->control('created_by');
            echo $this->Form->control('modified_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
