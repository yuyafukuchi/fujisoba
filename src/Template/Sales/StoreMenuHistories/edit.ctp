<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StoreMenuHistory $storeMenuHistory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $storeMenuHistory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $storeMenuHistory->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Store Menu Histories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Stores'), ['controller' => 'Stores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Store'), ['controller' => 'Stores', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="storeMenuHistories form large-9 medium-8 columns content">
    <?= $this->Form->create($storeMenuHistory) ?>
    <fieldset>
        <legend><?= __('Edit Store Menu History') ?></legend>
        <?php
            echo $this->Form->control('menu_item_id');
            echo $this->Form->control('store_id', ['options' => $stores]);
            echo $this->Form->control('store_menu_number');
            echo $this->Form->control('price');
            echo $this->Form->control('vending_mashine1');
            echo $this->Form->control('vending_mashine2');
            echo $this->Form->control('sales_item_price');
            echo $this->Form->control('sales_item_cost');
            echo $this->Form->control('start_date', ['empty' => true]);
            echo $this->Form->control('end_date', ['empty' => true]);
            echo $this->Form->control('deleted');
            echo $this->Form->control('created_by');
            echo $this->Form->control('modified_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
