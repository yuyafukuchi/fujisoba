<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StoreMenuHistory[]|\Cake\Collection\CollectionInterface $storeMenuHistories
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Store Menu History'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stores'), ['controller' => 'Stores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Store'), ['controller' => 'Stores', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="storeMenuHistories index large-9 medium-8 columns content">
    <h3><?= __('Store Menu Histories') ?></h3>
    マスタメニュー<?php debug($storeId); ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col">番号</th>
                <th scope="col">品名</th>
                <th scope="col">追加</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($menuHistories as $menuHistory): ?>
            <tr>
                <td><?= h($menuHistory->menu->menu_number) ?></td>
                <td><?= h($menuHistory->name) ?></td>
                <td><?= in_array($menuHistory->menu_item_id,$idArray,true) ? h(''): 
                $this->Form->postLink('>', ['action' => 'add', 'item' => $menuHistory->menu_item_id, 'store' => $storeId]) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('menu_item_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('store_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('store_menu_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('vending_mashine1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('vending_mashine2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sales_item_price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sales_item_cost') ?></th>
                <th scope="col"><?= $this->Paginator->sort('start_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('end_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('deleted') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified_by') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($storeMenuHistories as $storeMenuHistory): ?>
            <tr>
                <td><?= $this->Number->format($storeMenuHistory->id) ?></td>
                <td><?= $this->Number->format($storeMenuHistory->menu_item_id) ?></td>
                <td><?= $storeMenuHistory->has('store') ? $this->Html->link($storeMenuHistory->store->name, ['controller' => 'Stores', 'action' => 'view', $storeMenuHistory->store->id]) : '' ?></td>
                <td><?= $this->Number->format($storeMenuHistory->store_menu_number) ?></td>
                <td><?= $this->Number->format($storeMenuHistory->price) ?></td>
                <td><?= h($storeMenuHistory->vending_mashine1) ?></td>
                <td><?= h($storeMenuHistory->vending_mashine2) ?></td>
                <td><?= $this->Number->format($storeMenuHistory->sales_item_price) ?></td>
                <td><?= $this->Number->format($storeMenuHistory->sales_item_cost) ?></td>
                <td><?= h($storeMenuHistory->start_date) ?></td>
                <td><?= h($storeMenuHistory->end_date) ?></td>
                <td><?= h($storeMenuHistory->deleted) ?></td>
                <td><?= h($storeMenuHistory->created) ?></td>
                <td><?= $this->Number->format($storeMenuHistory->created_by) ?></td>
                <td><?= h($storeMenuHistory->modified) ?></td>
                <td><?= $this->Number->format($storeMenuHistory->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $storeMenuHistory->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $storeMenuHistory->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $storeMenuHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $storeMenuHistory->id)]) ?>
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
