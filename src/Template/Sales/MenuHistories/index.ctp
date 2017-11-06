<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InventoryItemHistory[]|\Cake\Collection\CollectionInterface $inventoryItemHistories
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Inventory Item History'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Inventory Items'), ['controller' => 'InventoryItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Inventory Item'), ['controller' => 'InventoryItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="inventoryItemHistories index large-9 medium-8 columns content">
    マスタ出庫アイテム設定
    <?=date('Y年m月d日',$date).'以降の設定'?>
    <?=$this->Form->create(null) ?>
    <?= $this->Form->control('date',['label' => '設定日','rows'=>1,'type'=>'text'])?>
    <?= $this->Form->submit("設定",['name'=>'button']) ?>
    <?=$this->Form->end() ?>
    <?=$this->Form->create(null) ?>
    <?= $this->Form->control('number',['label' => '出庫アイテム番号','rows'=>1,'type'=>'number'])?>
    <?= $this->Form->control('name',['label' => '出庫アイテム名','rows'=>1,'type'=>'text'])?>
    <?= $this->Form->submit("新規作成",['name'=>'button']) ?>
    <?=$this->Form->end() ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col">番号</th>
                <th scope="col">品名</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($menuHistories as $menuHistory): ?>
            <tr>
                <td><?= h($menuHistory->menu->menu_number) ?></td>
                <td><?= h($menuHistory->name) ?></td>
                <td><?= $this->Html->link(__('Edit'), ['action' => 'edit', $menuHistory->id]) ?></td>
                <td> <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $menuHistory->id]) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
