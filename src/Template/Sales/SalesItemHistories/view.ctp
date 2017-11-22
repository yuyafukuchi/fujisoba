<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesItemHistory $salesItemHistory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Sales Item History'), ['action' => 'edit', $salesItemHistory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Sales Item History'), ['action' => 'delete', $salesItemHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $salesItemHistory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sales Item Histories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sales Item History'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sales Items'), ['controller' => 'SalesItems', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sales Item'), ['controller' => 'SalesItems', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="salesItemHistories view large-9 medium-8 columns content">
    <h3><?= h($salesItemHistory->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Sales Item') ?></th>
            <td><?= $salesItemHistory->has('sales_item') ? $this->Html->link($salesItemHistory->sales_item->id, ['controller' => 'SalesItems', 'action' => 'view', $salesItemHistory->sales_item->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sales Item Name') ?></th>
            <td><?= h($salesItemHistory->sales_item_name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($salesItemHistory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($salesItemHistory->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($salesItemHistory->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start') ?></th>
            <td><?= h($salesItemHistory->start) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End') ?></th>
            <td><?= h($salesItemHistory->end) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($salesItemHistory->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($salesItemHistory->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= $salesItemHistory->deleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
