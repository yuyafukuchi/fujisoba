<header class="row">
    <div class="col-sm-8">
        <h2><?=$storeName ?>　在庫日計表　<?= date('Y年m月度', $date) ?></h2>
    </div>
    <div class="col-sm-4">
        <?= $this->Form->create(null, ['class' => 'form-inline pull-right'])?>
        <?= $this->Form->input("date", [
            "label" => false,
            "type" => "datetime",
            "dateformat" => "YM",
            "monthNames" => false,
            "separator" => "/",
            "templates" => [ "dateWidget" => '{{year}} 年 {{month}} 月' ],
            "minYear" => date("Y" ) - 70,
            "maxYear" => date("Y"),
            "default" => date("Y-m", $date),
        ])?>
        <div style="display: inline-block;"><?= $this->Form->submit('設定', ['name' => 'button']) ?></div>
        <?= $this->Form->end()?>
    </div>
</header>

<div style="margin: 30px 0;">
    <?= $this->Form->create(null, ['url' => ['action' => 'monthly', 'store' => $this->request->query('store')], 'class' => 'form-inline']) ?>
        <?= $this->Form->control('queryName',['label' => false, 'style' => 'min-width: 30em;'])?>
        <div style="display: inline-block;"><?= $this->Form->submit("検索",['name'=>'button']) ?></div>
    <?=$this->Form->end() ?>
</div>

<?php $storeInventoryItemHistories = $storeInventoryItemHistories->toArray(); ?>
<?php $arraySize = count($storeInventoryItemHistories) ; ?>
<?php $lastDay = date('d', strtotime('last day of this month', $date)) ?>

<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('　　前　　') ?>
        <?= $this->Paginator->next('　　次　　') ?>
    </ul>
    <ul class="pagination">
        <?= $this->Paginator->numbers() ?>
    </ul>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <?php $itemPrice = array(); ?>
            <?php for($i = 0 ; $i < $arraySize ; $i ++) : ?>
            <th colspan="6"><?= date('Y年m月度',$date)?>
                            <?=$storeInventoryItemHistories[$i]['inventory_item_history']['item_name'] ?>
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
        <?php $itemPriceIndex = array(0,0); ?>

        <?php $priceSum = array(array(0,0,0,0,0),array(0,0,0,0,0)) ; ?>

        <?php $recordSize = array(0,0); ?>
        <?php for($i = 1 ; $i <= $lastDay ;  $i++) : ?>
            <tr>
               <?php for($j = 0 ; $j < $arraySize ; $j ++) :?>
                    <td><?= $i?></td>
                    <?php if (!empty($index[$j]) &&
                        !empty($inventoryPurchaseTransactions[$j][$index[$j]]['transaction_date']) &&
                        $index[$j] < count($inventoryPurchaseTransactions[$j]) &&
                        $inventoryPurchaseTransactions[$j][$index[$j]]['transaction_date']->i18nFormat('dd') == $i ): ?>
                        <td><?php $lastDayQty =
                                $index[$j] === 0 ?
                                    ($lastMonthInventoryPurchaseTransactions[$j] == null ?
                                        h(0)
                                        : h($lastMonthInventoryPurchaseTransactions[$j]['count_qty']))
                                    : h($inventoryPurchaseTransactions[$j][$index[$j]-1]['count_qty'])
                            ?>
                            <?= $lastDayQty ?></td>
                            <?php $priceSum[$j][0] += $lastDayQty ; ?>
                        <td><?= h($inventoryPurchaseTransactions[$j][$index[$j]]['purchase_qty']) ?></td>
                            <?php $priceSum[$j][1] += $inventoryPurchaseTransactions[$j][$index[$j]]['purchase_qty']; ?>
                        <td><?= h($inventoryPurchaseTransactions[$j][$index[$j]]['loss_qty']) ?></td>
                            <?php $priceSum[$j][2] += $inventoryPurchaseTransactions[$j][$index[$j]]['loss_qty']; ?>
                        <?php $sum = $lastDayQty
                           + $inventoryPurchaseTransactions[$j][$index[$j]]['purchase_qty']
                           - $inventoryPurchaseTransactions[$j][$index[$j]]['loss_qty']
                           - $inventoryPurchaseTransactions[$j][$index[$j]]['count_qty'];
                           $priceSum[$j][3] += $sum?>
                       <td><?= h($sum) ?></td>
                        <td>
                            <?php  if (!($itemPriceHistories[$j][$itemPriceIndex[$j]]['start']->i18nFormat('Y-MM-dd') <= date('Y-m-',$date) . sprintf('%02d', $i) &&
                                        ($itemPriceHistories[$j][$itemPriceIndex[$j]]['end'] == null ||
                                            $itemPriceHistories[$j][$itemPriceIndex[$j]]['end']->i18nFormat('Y-MM-dd') > date('Y-m-',$date) . sprintf('%02d', $i) ))): ?>
                                    <?php $itemPriceIndex[$j] ++; $itemPrice[$j] = $itemPriceHistories[$j][$itemPriceIndex[$j]]['price']; ?>
                            <?php endif; ?>
                           <?= number_format(h($itemPrice[$j] * $sum)) ?> </td>
                       <?php $priceSum[$j][4] += $itemPrice[$j] * $sum ; ?>
                       <?php $index[$j] ++ ;?>
                       <?php $recordSize[$j] ++ ;?>

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
        <tr class="pink">
            <?php for($j = 0 ; $j < $arraySize ; $j ++) : ?>
                <td>合計</td>
                <?php for($k = 0 ; $k < 5 ; $k ++ ): ?>
                    <td><?= !empty($priceSum[$j][$k]) ? number_format(h($priceSum[$j][$k])) : null ?></td>
                <?php endfor; ?>
            <?php endfor; ?>
        </tr>
        <tr>
            <?php for($j = 0 ; $j < $arraySize ; $j ++) : ?>
                <td>平均</td>
                <?php for($k = 0 ; $k < 5 ; $k ++ ): ?>
                    <!--<td><?= number_format(h($recordSize[$j]) != 0 ? round($priceSum[$j][$k]/$recordSize[$j]) : 0) ?></td>-->
                    <td><?= !empty($recordSize[$j]) ? $priceSum[$j][$k]/$recordSize[$j] : 0 ?></td>
                <?php endfor; ?>
            <?php endfor; ?>
       </tr>
    </tbody>
</table>
