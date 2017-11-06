<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StoreMenuHistory $storeMenuHistory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Store Menu History'), ['action' => 'edit', $storeMenuHistory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Store Menu History'), ['action' => 'delete', $storeMenuHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $storeMenuHistory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Store Menu Histories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Store Menu History'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Stores'), ['controller' => 'Stores', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Store'), ['controller' => 'Stores', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="storeMenuHistories view large-9 medium-8 columns content">
    <h3><?= h($storeMenuHistory->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Store') ?></th>
            <td><?= $storeMenuHistory->has('store') ? $this->Html->link($storeMenuHistory->store->name, ['controller' => 'Stores', 'action' => 'view', $storeMenuHistory->store->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($storeMenuHistory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Menu Item Id') ?></th>
            <td><?= $this->Number->format($storeMenuHistory->menu_item_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Store Menu Number') ?></th>
            <td><?= $this->Number->format($storeMenuHistory->store_menu_number) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Price') ?></th>
            <td><?= $this->Number->format($storeMenuHistory->price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sales Item Price') ?></th>
            <td><?= $this->Number->format($storeMenuHistory->sales_item_price) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sales Item Cost') ?></th>
            <td><?= $this->Number->format($storeMenuHistory->sales_item_cost) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($storeMenuHistory->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($storeMenuHistory->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start Date') ?></th>
            <td><?= h($storeMenuHistory->start_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End Date') ?></th>
            <td><?= h($storeMenuHistory->end_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($storeMenuHistory->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($storeMenuHistory->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vending Mashine1') ?></th>
            <td><?= $storeMenuHistory->vending_mashine1 ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vending Mashine2') ?></th>
            <td><?= $storeMenuHistory->vending_mashine2 ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= $storeMenuHistory->deleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
