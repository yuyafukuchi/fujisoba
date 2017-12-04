<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Account $account
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Account'), ['action' => 'edit', $account->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Account'), ['action' => 'delete', $account->id], ['confirm' => __('Are you sure you want to delete # {0}?', $account->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Accounts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Account'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Store Account Infos'), ['controller' => 'StoreAccountInfos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Store Account Info'), ['controller' => 'StoreAccountInfos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="accounts view large-9 medium-8 columns content">
    <h3><?= h($account->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Code') ?></th>
            <td><?= h($account->code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($account->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Debit Tax Code') ?></th>
            <td><?= h($account->debit_tax_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Debit Found Class') ?></th>
            <td><?= h($account->debit_found_class) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Credit Tax Code') ?></th>
            <td><?= h($account->credit_tax_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Credit Found Class') ?></th>
            <td><?= h($account->credit_found_class) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($account->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($account->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($account->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($account->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($account->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cash Account') ?></th>
            <td><?= $account->cash_account ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Store Account Infos') ?></h4>
        <?php if(!empty($account->store_account_infos)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Account Id') ?></th>
                <th scope="col"><?= __('Store Id') ?></th>
                <th scope="col"><?= __('Need Debit Department Code') ?></th>
                <th scope="col"><?= __('Need Credit Department Code') ?></th>
                <th scope="col"><?= __('Debit Category Id') ?></th>
                <th scope="col"><?= __('Credit Category Id') ?></th>
                <th scope="col"><?= __('Note') ?></th>
                <th scope="col"><?= __('Note Monthly') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($account->store_account_infos as $storeAccountInfos): ?>
            <tr>
                <td><?= h($storeAccountInfos->id) ?></td>
                <td><?= h($storeAccountInfos->account_id) ?></td>
                <td><?= h($storeAccountInfos->store_id) ?></td>
                <td><?= h($storeAccountInfos->need_debit_department_code) ?></td>
                <td><?= h($storeAccountInfos->need_credit_department_code) ?></td>
                <td><?= h($storeAccountInfos->debit_category_id) ?></td>
                <td><?= h($storeAccountInfos->credit_category_id) ?></td>
                <td><?= h($storeAccountInfos->note) ?></td>
                <td><?= h($storeAccountInfos->note_monthly) ?></td>
                <td><?= h($storeAccountInfos->created) ?></td>
                <td><?= h($storeAccountInfos->created_by) ?></td>
                <td><?= h($storeAccountInfos->modified) ?></td>
                <td><?= h($storeAccountInfos->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'StoreAccountInfos', 'action' => 'view', $storeAccountInfos->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'StoreAccountInfos', 'action' => 'edit', $storeAccountInfos->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'StoreAccountInfos', 'action' => 'delete', $storeAccountInfos->id], ['confirm' => __('Are you sure you want to delete # {0}?', $storeAccountInfos->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
