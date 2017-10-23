<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Permit Pc'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="permitPcs index large-9 medium-8 columns content">
    <h3><?= __('Permit Pcs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ip_address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified_by') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($permitPcs as $permitPc): ?>
            <tr>
                <td><?= $this->Number->format($permitPc->id) ?></td>
                <td><?= h($permitPc->ip_address) ?></td>
                <td><?= h($permitPc->created) ?></td>
                <td><?= $this->Number->format($permitPc->created_by) ?></td>
                <td><?= h($permitPc->modified) ?></td>
                <td><?= $this->Number->format($permitPc->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $permitPc->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $permitPc->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $permitPc->id], ['confirm' => __('Are you sure you want to delete # {0}?', $permitPc->id)]) ?>
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
