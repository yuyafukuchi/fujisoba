<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Account[]|\Cake\Collection\CollectionInterface $accounts
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Account'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Store Account Infos'), ['controller' => 'StoreAccountInfos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Store Account Info'), ['controller' => 'StoreAccountInfos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="accounts index large-9 medium-8 columns content">
    <h3><?= __('Accounts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('debit_tax_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('debit_found_class') ?></th>
                <th scope="col"><?= $this->Paginator->sort('credit_tax_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('credit_found_class') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cash_account') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified_by') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($accounts as $account): ?>
            <tr>
                <td><?= $this->Number->format($account->id) ?></td>
                <td><?= h($account->code) ?></td>
                <td><?= h($account->name) ?></td>
                <td><?= h($account->debit_tax_code) ?></td>
                <td><?= h($account->debit_found_class) ?></td>
                <td><?= h($account->credit_tax_code) ?></td>
                <td><?= h($account->credit_found_class) ?></td>
                <td><?= h($account->cash_account) ?></td>
                <td><?= h($account->created) ?></td>
                <td><?= $this->Number->format($account->created_by) ?></td>
                <td><?= h($account->modified) ?></td>
                <td><?= $this->Number->format($account->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $account->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $account->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $account->id], ['confirm' => __('Are you sure you want to delete # {0}?', $account->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
