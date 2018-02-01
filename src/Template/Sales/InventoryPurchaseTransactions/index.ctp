<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InventoryPurchaseTransaction[]|\Cake\Collection\CollectionInterface $inventoryPurchaseTransactions
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Inventory Purchase Transaction'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Inventory Items'), ['controller' => 'InventoryItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Inventory Item'), ['controller' => 'InventoryItems', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stores'), ['controller' => 'Stores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Store'), ['controller' => 'Stores', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="inventoryPurchaseTransactions index large-9 medium-8 columns content">
    <h3><?= __('Inventory Purchase Transactions') ?></h3>
    仕入在庫入力 計算日(仕入・残取した日)
    <?=date('Y年m月d日',$date)?>
    <?=$this->Form->create(null) ?>
    <?= $this->Form->control('date',['label' => '設定日','rows'=>1,'type'=>'text'])?>
    <?= $this->Form->submit("設定",['name'=>'button']) ?>
    <?=$this->Form->end() ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>品名</th>
                <th>前日残高</th>
                <th>仕入数</th>
                <th>ロス数</th>
                <th>残取数</th>
                <th>売上高</th>
                <th>金額</th>
                <th>合計</th>
            </tr>
        </thead>
        <tbody>
            <?= $this->Form->create('InventoryPurchaseTransactions',['url' => ['action' => 'register']]); ?>
            <?php $i = 0;$salesSum = 0; foreach ($storeInventoryItemHistories as $storeInventoryItemHistory): ?>
            <tr>
                <td><?=h($i + 1)?></td>
                <td><?=h($storeInventoryItemHistory->inventory_item->inventory_item_histories[0]->item_name)?></td>
                <?php $previousDayCount = intval($previousDayCountArray[$storeInventoryItemHistory->inventory_item_id]); ?>
                <td><?= h($previousDayCount)?></td>
                <?php if(array_key_exists($storeInventoryItemHistory->inventory_item_id,$idArray)): ?> <!--edit-->
                    <?=$this->Form->hidden( 'edit['.$i.'][inventory_item_id]' ,['value' => $storeInventoryItemHistory->inventory_item_id]) ?>
                    <?=$this->Form->hidden( 'edit['.$i.'][store_id]' ,['value' => $storeId]) ?>
                    <?=$this->Form->hidden( 'edit['.$i.'][transaction_date]' ,['value' => date('Y-m-d 00:00:00', $date)]) ?>
                    <?php $inventoryPurchaseTransaction = $inventoryPurchaseTransactions->skip($idArray[$storeInventoryItemHistory->inventory_item_id])->first(); ?>
                    <?=$this->Form->hidden( 'edit['.$i.'][id]' ,['value' => $inventoryPurchaseTransaction->id]) ?>
                    <td><?= $this->Form->control('edit['.$i.'][purchase_qty]',
                        ['label' => '','rows'=>1,'type'=>'number','default' => $inventoryPurchaseTransaction->purchase_qty ])?></td>
                    <td><?= $this->Form->control('edit['.$i.'][loss_qty]',
                        ['label' => '','rows'=>1,'type'=>'number', 'default' => $inventoryPurchaseTransaction->loss_qty])?></td>
                    <td><?= $this->Form->control('edit['.$i.'][count_qty]',
                        ['label' => '','rows'=>1,'type'=>'number', 'default' => $inventoryPurchaseTransaction->count_qty])?></td>
                    <?php $salesCountSum = $previousDayCount + intval($inventoryPurchaseTransaction->hoge); ?>
                    <td><?= h($salesCountSum) ?></td>
                    <?php $price = intval($storeInventoryItemHistory->price); ?>
                    <td><?= $price ?></td>
                    <td><?php echo h($salesCountSum * $price) ;$salesSum +=($salesCountSum * $price); ?></td>
                <?php else : ?>                                                                        <!-- add -->
                    <?=$this->Form->hidden( 'add['.$i.'][inventory_item_id]' ,['value' => $storeInventoryItemHistory->inventory_item_id]) ?>
                    <?=$this->Form->hidden( 'add['.$i.'][store_id]' ,['value' => $storeId]) ?>
                    <?=$this->Form->hidden( 'add['.$i.'][transaction_date]' ,['value' => date('Y-m-d 00:00:00', $date)]) ?>
                    <td><?= $this->Form->control('add['.$i.'][purchase_qty]',['label' => '','rows'=>1,'type'=>'number', ])?></td>
                    <td><?= $this->Form->control('add['.$i.'][loss_qty]',['label' => '','rows'=>1,'type'=>'number', ])?></td>
                    <td><?= $this->Form->control('add['.$i.'][count_qty]',['label' => '','rows'=>1,'type'=>'number', ])?></td>
                    <td></td>
                    <td><?= h($storeInventoryItemHistory->price) ?></td>
                    <td></td>
                <?php endif; ?>
            </tr>
            <?php $i ++; endforeach; ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>合計</td>
                <td><?=h($salesSum) ?></td>
            </tr>
        </tbody>
    </table>
    <?= $this->Form->submit("登録",['name'=>'button']) ?>
    <?= $this->Form->end() ?>
</div>
