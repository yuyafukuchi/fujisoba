<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Permit Pc'), ['action' => 'edit', $permitPc->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Permit Pc'), ['action' => 'delete', $permitPc->id], ['confirm' => __('Are you sure you want to delete # {0}?', $permitPc->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Permit Pcs'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Permit Pc'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="permitPcs view large-9 medium-8 columns content">
    <h3><?= h($permitPc->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Ip Address') ?></th>
            <td><?= h($permitPc->ip_address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($permitPc->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($permitPc->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified By') ?></th>
            <td><?= $this->Number->format($permitPc->modified_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($permitPc->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($permitPc->modified) ?></td>
        </tr>
    </table>
</div>
