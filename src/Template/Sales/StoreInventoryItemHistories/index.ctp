<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StoreInventoryItemHistory[]|\Cake\Collection\CollectionInterface $storeInventoryItemHistories
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Store Inventory Item History'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Inventory Items'), ['controller' => 'InventoryItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Inventory Item'), ['controller' => 'InventoryItems', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stores'), ['controller' => 'Stores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Store'), ['controller' => 'Stores', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="storeInventoryItemHistories index large-9 medium-8 columns content">
    <h3><?= __('Store Inventory Item Histories') ?></h3>
    <?=date('Y年m月d日',$date).'以降の設定'?>
    <?=$this->Form->create(null) ?>
    <?= $this->Form->control('date',['label' => '設定日','rows'=>1,'type'=>'text'])?>
    <?= $this->Form->submit("設定",['name'=>'button']) ?>
    <?=$this->Form->end() ?>

    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col">品名</th>
                <!--<th scope="col"></th>-->
                <th scope="col">追加</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($inventoryItemHistories as $inventoryItemHistory): ?>
            <tr>
                <td><?= h($inventoryItemHistory->item_name) ?></td>
                <!--<td><?= $this->Form->postLink(__('Delete'), ['controller' => 'InventoryItemHistories','action' => 'delete', $inventoryItemHistory->id]) ?></td>-->
                <td><?= in_array($inventoryItemHistory->inventory_item_id,$idArray,true) ? h(''):
                $this->Form->postLink('>', ['action' => 'add', 'item' => $inventoryItemHistory->inventory_item_id, 'store' => $storeId]) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    店舗別在庫アイテム
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col">品名</th>
                <th scope="col">ロス</th>
                <th scope="col">価格</th>
                <th scope="col">原価</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; foreach ($storeInventoryItemHistories as $storeInventoryItemHistory): ?>
            <?=$this->Form->create('StoreInventoryItemHistories',['url' => ['action' => 'edit','store' => $storeId, 'inventory_item_id' => intval($storeInventoryItemHistory->inventory_item_id), $storeInventoryItemHistory->id]]) ?>
            <tr>
                <td><?= h($storeInventoryItemHistory->inventory_item_history->item_name) ?></td>
                <!--<td><?= $this->Form->control('loss_price'.$storeInventoryItemHistory->id,['label' => '','rows'=>1,'type'=>'number', 'default' => intval($storeInventoryItemHistory->loss_price)])?></td>-->
                <!--<td><?= $this->Form->control('price'.$storeInventoryItemHistory->id,['label' => '','rows'=>1,'type'=>'number', 'default' => intval($storeInventoryItemHistory->price)])?></td>-->
                <!--<td><?= $this->Form->control('cost'.$storeInventoryItemHistory->id,['label' => '','rows'=>1,'type'=>'number', 'step'=>0.1, 'default' => intval($storeInventoryItemHistory->cost)])?></td>-->
                <td><?= $this->Form->control('loss_price',['label' => '','rows'=>1,'type'=>'number', 'default' => intval($storeInventoryItemHistory->loss_price)])?></td>
                <td><?= $this->Form->control('price',['label' => '','rows'=>1,'type'=>'number', 'default' => intval($storeInventoryItemHistory->price)])?></td>
                <td><?= $this->Form->control('cost',['label' => '','rows'=>1,'type'=>'number', 'step'=>0.1, 'default' => intval($storeInventoryItemHistory->cost)])?></td>
                <td><?= $this->Form->submit("変更",['name'=>'button']) ?></td>
                <?=$this->Form->end() ?>
                <td><?= $this->Form->postLink('削除', ['action' => 'delete',
                                                        $storeInventoryItemHistory->id,
                                                        'store' => $storeId,
                                                        'inventory_item_id' => intval($storeInventoryItemHistory->inventory_item_id)],
                                                    ['confirm' => '削除しますか？']) ?></td>
                <td> </td>
            </tr>
            <?php $i ++ ; endforeach; ?>
        </tbody>
    </table>


</div>
