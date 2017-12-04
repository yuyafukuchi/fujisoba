<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Menu $menu
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Menu'), ['action' => 'edit', $menu->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Menu'), ['action' => 'delete', $menu->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menu->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Menus'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Menu'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sales Transactions'), ['controller' => 'SalesTransactions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sales Transaction'), ['controller' => 'SalesTransactions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="menus view large-9 medium-8 columns content">
    <h3><?= h($menu->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($menu->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Menu Number') ?></th>
            <td><?= $this->Number->format($menu->menu_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($menu->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($menu->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($menu->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($menu->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Sales Transactions') ?></h4>
        <?php if(!empty($menu->sales_transactions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Store Id') ?></th>
                <th scope="col"><?= __('Transaction Date') ?></th>
                <th scope="col"><?= __('Menu Id') ?></th>
                <th scope="col"><?= __('Menu Number') ?></th>
                <th scope="col"><?= __('Menu Name') ?></th>
                <th scope="col"><?= __('Qty') ?></th>
                <th scope="col"><?= __('Cash Sales Amount') ?></th>
                <th scope="col"><?= __('Pasmo Sales Amount') ?></th>
                <th scope="col"><?= __('Sales Amount') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Created By') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col"><?= __('Modified By') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($menu->sales_transactions as $salesTransactions): ?>
            <tr>
                <td><?= h($salesTransactions->id) ?></td>
                <td><?= h($salesTransactions->store_id) ?></td>
                <td><?= h($salesTransactions->transaction_date) ?></td>
                <td><?= h($salesTransactions->menu_id) ?></td>
                <td><?= h($salesTransactions->menu_number) ?></td>
                <td><?= h($salesTransactions->menu_name) ?></td>
                <td><?= h($salesTransactions->qty) ?></td>
                <td><?= h($salesTransactions->cash_sales_amount) ?></td>
                <td><?= h($salesTransactions->pasmo_sales_amount) ?></td>
                <td><?= h($salesTransactions->sales_amount) ?></td>
                <td><?= h($salesTransactions->created) ?></td>
                <td><?= h($salesTransactions->created_by) ?></td>
                <td><?= h($salesTransactions->modified) ?></td>
                <td><?= h($salesTransactions->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'SalesTransactions', 'action' => 'view', $salesTransactions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'SalesTransactions', 'action' => 'edit', $salesTransactions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'SalesTransactions', 'action' => 'delete', $salesTransactions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $salesTransactions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
