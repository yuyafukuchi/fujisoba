<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CashAccountTran $cashAccountTran
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $cashAccountTran->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $cashAccountTran->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Cash Account Trans'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Stores'), ['controller' => 'Stores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Store'), ['controller' => 'Stores', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Accounts'), ['controller' => 'Accounts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Account'), ['controller' => 'Accounts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cashAccountTrans form large-9 medium-8 columns content">
    <?= $this->Form->create($cashAccountTran) ?>
    <fieldset>
        <legend><?= __('Edit Cash Account Tran') ?></legend>
        <?php
            echo $this->Form->control('store_id', ['options' => $stores]);
            echo $this->Form->control('transaction_date', ['empty' => true]);
            echo $this->Form->control('cash_account_id', ['options' => $accounts]);
            echo $this->Form->control('amount');
            echo $this->Form->control('note');
            echo $this->Form->control('created_by');
            echo $this->Form->control('modified_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
