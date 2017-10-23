<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $store->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $store->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Stores'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cash Account Trans'), ['controller' => 'CashAccountTrans', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Cash Account Tran'), ['controller' => 'CashAccountTrans', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['controller' => 'Employees', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Employee'), ['controller' => 'Employees', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Inventory Purchase Transactions'), ['controller' => 'InventoryPurchaseTransactions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Inventory Purchase Transaction'), ['controller' => 'InventoryPurchaseTransactions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sales Transactions'), ['controller' => 'SalesTransactions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sales Transaction'), ['controller' => 'SalesTransactions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Store Account Infos'), ['controller' => 'StoreAccountInfos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Store Account Info'), ['controller' => 'StoreAccountInfos', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Store Inventory Item Histories'), ['controller' => 'StoreInventoryItemHistories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Store Inventory Item History'), ['controller' => 'StoreInventoryItemHistories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Time Cards'), ['controller' => 'TimeCards', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Time Card'), ['controller' => 'TimeCards', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="stores form large-9 medium-8 columns content">
    <?= $this->Form->create($store) ?>
    <fieldset>
        <legend><?= __('Edit Store') ?></legend>
        <?php
            echo $this->Form->input('code');
            echo $this->Form->input('name');
            echo $this->Form->input('company_id', ['options' => $companies]);
            echo $this->Form->input('pay_department_code');
            echo $this->Form->input('fin_department_code');
            echo $this->Form->input('start_date', ['empty' => true]);
            echo $this->Form->input('end_date', ['empty' => true]);
            echo $this->Form->input('regular_start_time');
            echo $this->Form->input('regular_end_time');
            echo $this->Form->input('midnight_start_time');
            echo $this->Form->input('midnight_end_time');
            echo $this->Form->input('other1_start_time');
            echo $this->Form->input('other1_end_time');
            echo $this->Form->input('other2_start_time');
            echo $this->Form->input('other2_end_time');
            echo $this->Form->input('early_start_time');
            echo $this->Form->input('early_end_time');
            echo $this->Form->input('middle_start_time');
            echo $this->Form->input('middle_end_time');
            echo $this->Form->input('late_start_time');
            echo $this->Form->input('late_end_time');
            echo $this->Form->input('created_by');
            echo $this->Form->input('modified_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
