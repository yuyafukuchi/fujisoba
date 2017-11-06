<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CashAccountTran $cashAccountTran
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Cash Account Tran'), ['action' => 'edit', $cashAccountTran->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cash Account Tran'), ['action' => 'delete', $cashAccountTran->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cashAccountTran->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cash Account Trans'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cash Account Tran'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Stores'), ['controller' => 'Stores', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Store'), ['controller' => 'Stores', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Accounts'), ['controller' => 'Accounts', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Account'), ['controller' => 'Accounts', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="cashAccountTrans view large-9 medium-8 columns content">
    <h3><?= h($cashAccountTran->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Store') ?></th>
            <td><?= $cashAccountTran->has('store') ? $this->Html->link($cashAccountTran->store->name, ['controller' => 'Stores', 'action' => 'view', $cashAccountTran->store->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Account') ?></th>
            <td><?= $cashAccountTran->has('account') ? $this->Html->link($cashAccountTran->account->name, ['controller' => 'Accounts', 'action' => 'view', $cashAccountTran->account->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($cashAccountTran->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount') ?></th>
            <td><?= $this->Number->format($cashAccountTran->amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($cashAccountTran->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($cashAccountTran->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Transaction Date') ?></th>
            <td><?= h($cashAccountTran->transaction_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($cashAccountTran->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($cashAccountTran->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Note') ?></h4>
        <?= $this->Text->autoParagraph(h($cashAccountTran->note)); ?>
    </div>
</div>
