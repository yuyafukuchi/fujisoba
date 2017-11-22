<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesItemAssignHistory $salesItemAssignHistory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Sales Item Assign History'), ['action' => 'edit', $salesItemAssignHistory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Sales Item Assign History'), ['action' => 'delete', $salesItemAssignHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $salesItemAssignHistory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sales Item Assign Histories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sales Item Assign History'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Menus'), ['controller' => 'Menus', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Menu'), ['controller' => 'Menus', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sales Items'), ['controller' => 'SalesItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sales Item'), ['controller' => 'SalesItems', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="salesItemAssignHistories view large-9 medium-8 columns content">
    <h3><?= h($salesItemAssignHistory->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Menu') ?></th>
            <td><?= $salesItemAssignHistory->has('menu') ? $this->Html->link($salesItemAssignHistory->menu->id, ['controller' => 'Menus', 'action' => 'view', $salesItemAssignHistory->menu->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sales Item') ?></th>
            <td><?= $salesItemAssignHistory->has('sales_item') ? $this->Html->link($salesItemAssignHistory->sales_item->id, ['controller' => 'SalesItems', 'action' => 'view', $salesItemAssignHistory->sales_item->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($salesItemAssignHistory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($salesItemAssignHistory->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($salesItemAssignHistory->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start') ?></th>
            <td><?= h($salesItemAssignHistory->start) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End') ?></th>
            <td><?= h($salesItemAssignHistory->end) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($salesItemAssignHistory->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($salesItemAssignHistory->modified) ?></td>
        </tr>
    </table>
</div>
