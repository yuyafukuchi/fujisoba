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
    <?php $lastDay = date('d', strtotime('last day of this month', $date)) ?>
    <h3><?= __('Inventory Purchase Transactions') ?></h3>
    <?=$storeName ?> 在庫日計表 
    <?=date('Y年m月度',$date)?>
    <?=$this->Form->create(null) ?>
    <?= $this->Form->input(
     "date", ["label" => "",
                      "type" => "datetime",
                      "dateformat" => "YM",
                      "monthNames" => false,
                      "separator" => "/",
                      "templates" => [ "dateWidget" => '{{year}} 年 {{month}} 月' ],
                      "minYear" => date("Y" ) - 70,
                      "maxYear" => date("Y" ) - 18,
                      "default" => date("Y-m" ),
                      "empty" => [ "year" => "年", "month" => "月"]]) ?>
    <?= $this->Form->submit("設定",['name'=>'button']) ?>
    <?=$this->Form->end() ?>
    <?=$this->Form->create(null) ?>
    <?= $this->Form->control('queryName',['label' => '','rows'=>1,'type'=>'text'])?>
    <?= $this->Form->submit("検索",['name'=>'button']) ?>
    <?=$this->Form->end() ?>
    <table cellpadding="0" cellspac
    <?php $storeInventoryItemHistories = $storeInventoryItemHistories->toArray(); ?>
    <?php $arraySize = count($storeInventoryItemHistories) ; ?>
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
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <?php $itemPrice = array(); ?>
                <?php for($i = 0 ; $i < $arraySize ; $i ++) : ?>
                <th colspan="6"><?= date('Y年m月度',$date)?> 
                                <?=$storeInventoryItemHistories[$i]->inventory_item->inventory_item_histories[0]->item_name ?> 
                                <?php $itemPrice[$i] = $storeInventoryItemHistories[$i]->price; ?>
                                <?=$itemPrice[$i] ?></th>
                <?php endfor; ?>
            </tr>
            <tr>
                <?php for($i = 0 ; $i < $arraySize ; $i ++) : ?>
                    <th>日</th>
                    <th>前日在庫</th>
                    <th>仕入高</th>
                    <th>ロス数</th>
                    <th>出庫高</th>
                    <th>金額</th>
                <?php endfor; ?>
            </tr>
        </thead>
        <tbody>
            <?php $index = array(0,0); ?>
            <?php $priceSum = array(array(0,0,0,0,0),array(0,0,0,0,0)) ; ?>
            <?php $recordSize = array(0,0); ?>
            <?php for($i = 0 ; $i < $arraySize ; $i ++) : ?>
            <?php if(count($inventoryPurchaseTransactions[$i]) > 0) : ?>
                <?php $index[$i] = $inventoryPurchaseTransactions[$i][0]['transaction_date']->i18nFormat('YYYY-MM-dd') 
                        == date('Y-m-d',strtotime('last day of previous month', $date)) ? 1 : 0 ;?> 
                <?php $recordSize[$i] = count($inventoryPurchaseTransactions[$i]) - $index[$i]; ?>
                <?php endif; ?>
            <?php endfor; ?>
           <?php for($i = 1 ; $i <= $lastDay ;  $i++) : ?>
           <tr>
               <?php for($j = 0 ; $j < $arraySize ; $j ++) :?>
               <td><?= $i?></td>
               <?php if($index[$j] < count($inventoryPurchaseTransactions[$j]) &&
                       $inventoryPurchaseTransactions[$j][$index[$j]]['transaction_date']->i18nFormat('dd') == $i ): ?>
                   <td><?= $index[$j] === 0 ?  h(0) : h($inventoryPurchaseTransactions[$j][$index[$j]-1]['count_qty']) ?></td>
                   <?php $priceSum[$j][0] += $index[$j] === 0 ? 0 :  $inventoryPurchaseTransactions[$j][$index[$j]-1]['count_qty'] ; ?>
                   <td><?= h($inventoryPurchaseTransactions[$j][$index[$j]]['purchase_qty']) ?></td>
                   <?php $priceSum[$j][1] += $inventoryPurchaseTransactions[$j][$index[$j]]['purchase_qty']; ?>
                   <td><?= h($inventoryPurchaseTransactions[$j][$index[$j]]['loss_qty']) ?></td>
                   <?php $priceSum[$j][2] += $inventoryPurchaseTransactions[$j][$index[$j]]['loss_qty']; ?>
                   <?php $sum = ($index[$j] === 0 ? 0 : $inventoryPurchaseTransactions[$j][$index[$j]-1]['count_qty'])
                       + $inventoryPurchaseTransactions[$j][$index[$j]]['purchase_qty']
                       - $inventoryPurchaseTransactions[$j][$index[$j]]['loss_qty']
                       - $inventoryPurchaseTransactions[$j][$index[$j]]['count_qty']; 
                       $priceSum[$j][3] += $sum?>
                   <td><?= h($sum) ?></td>
                   <td><?= h($itemPrice[$j] * $sum) ?> </td>
                   <?php $priceSum[$j][4] += $itemPrice[$j] * $sum ; ?>
                   <?php $index[$j] ++ ;?>
               <?php else : ?>
                   <td></td>
                   <td></td>
                   <td></td>
                   <td></td>
                   <td></td>
               <?php endif; ?>
               <?php endfor; ?>
           </tr>
           <?php endfor; ?>
           <tr>
           <?php for($j = 0 ; $j < $arraySize ; $j ++) : ?>
            <td>合計</td>
            <?php for($k = 0 ; $k < 5 ; $k ++ ): ?>
                <td><?= h($priceSum[$j][$k]) ?></td>
            <?php endfor; ?>
           <?php endfor; ?>
           </tr>
           <tr>
           <?php for($j = 0 ; $j < $arraySize ; $j ++) : ?>
            <td>平均</td>
            <?php for($k = 0 ; $k < 5 ; $k ++ ): ?>
                <td><?= h(round($priceSum[$j][$k]/$recordSize[$j],2)) ?></td>
            <?php endfor; ?>
           <?php endfor; ?>
           </tr>
        </tbody>
    </table>
    <?= $this->Form->submit("登録",['name'=>'button']) ?>
            <?= $this->Form->end() ?>
</div>
