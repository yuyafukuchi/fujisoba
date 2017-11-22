<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MenuHistory $menuHistory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Menu History'), ['action' => 'edit', $menuHistory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Menu History'), ['action' => 'delete', $menuHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menuHistory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Menu Histories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Menu History'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="menuHistories view large-9 medium-8 columns content">
    <h3><?= h($menuHistory->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($menuHistory->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($menuHistory->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Menu Item Id') ?></th>
            <td><?= $this->Number->format($menuHistory->menu_item_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($menuHistory->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($menuHistory->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start') ?></th>
            <td><?= h($menuHistory->start) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End') ?></th>
            <td><?= h($menuHistory->end) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($menuHistory->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($menuHistory->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Deleted') ?></th>
            <td><?= $menuHistory->deleted ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
