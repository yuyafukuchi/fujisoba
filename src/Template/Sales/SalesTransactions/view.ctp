<header class="row">
    <div class="col-sm-8">
        <h2> <?=$storeName ?>　売上日計表　<?= date('Y年m月度', $date) ?></h2>
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
        <div style="display: inline-block;"><?= $this->Form->submit('検索', ['name' => 'button']) ?></div>
        <?= $this->Form->end()?>
    </div>
</header>

<?php $week_name = array("日", "月", "火", "水", "木", "金", "土"); ?>
<?php $lastDay = date('d', strtotime('last day of this month', $date)); ?>
<?php $day = strtotime('first day of this month', $date); ?>
<?php $arraySize = count($salesDailySummary); ?>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>日</th>
            <th>曜</th>
            <th>+-</th>
            <th>総売上</th>
            <th>パスモ</th>
            <th>現金出納</th>
            <th>早番</th>
            <th>中番</th>
            <th>遅番</th>
            <th>預金高</th>
            <th>備考</th>
            <th>ロス額</th>
            <th>原価</th>
        </tr>
    </thead>
    <tbody>
        <!--現金出納をだす-->
        <?php $cashAccountTransCount =count($cashAccountTrans)?>
        <?php $sum_array = array() ?>
        <?php $cashAccountAmount = array() ?>
        <?php for($i = 1 ; $i <= $lastDay ; $i ++) : ?>
            <?php for($j = 0 ; $j < $cashAccountTransCount ; $j ++) :?>
                <?php $cashdate=$cashAccountTrans[$j]['transaction_date']->i18nFormat('dd') ?>
                <?php if($cashdate == $i): ?>
                    <?php array_push($sum_array,$cashAccountTrans[$j]['amount']);?>
                <?php endif; ?>
            <?php endfor; ?>
            <?php $cashAccountAmount[$i]=array_sum($sum_array)?>
            <?php $sum_array= array()?>
        <?php endfor; ?>


        <!--ロス額を出す-->
        <?php $sum_lossprice_array=array() ?>
        <?php $sum_lossprice=0 ?>
        <?php for($i = 1 ; $i <= $lastDay ; $i ++) : ?> <!--日で回す-->
            <?php if( empty($inventoryPurchaseTransactionsArray[$i])): ?>
                <?php $sum_lossprice_array[$i]=0 ?>
            <?php else :?>
                <?php for($j= 0 ;$j<count($inventoryPurchaseTransactionsArray[$i]) ; $j++): ?>
                    <?php $x=array_keys($inventoryPurchaseTransactionsArray[$i][$j]) ?> <!--investry_item_id-->
                    <?php for($h= 0 ;$h<count($storeInventoryItemHistoryArray[$i]) ; $h++): ?>
                        <?php if(array_keys($storeInventoryItemHistoryArray[$i][$h])[0]==array_keys($inventoryPurchaseTransactionsArray[$i][$j])[0]): ?>
                            <?php $sum_lossprice+=($storeInventoryItemHistoryArray[$i][$h][$x[0]])*(array_values($inventoryPurchaseTransactionsArray[$i][$j])[0])?>
                        <?php endif; ?>
                    <?php endfor; ?>
                <?php endfor; ?>
                <?php $sum_lossprice_array[$i]=$sum_lossprice ?>
                <?php $sum_lossprice=0 ?>
            <?php endif; ?>
        <?php endfor; ?>

        <!--表を埋めて行く-->
        <?php for($i = 1 ; $i <= $lastDay ; $i ++) : ?>
            <tr>
                <td><?=$i ?></td>
                <td><?=h($week_name[date('w',$day)]) ?></td>
                <?php $day = strtotime('+1 day', $day);?>
                <?php for($j = 0 ; $j < $arraySize ; $j ++) :?>
                    <?php if($salesDailySummary[$j]['transaction_date']->i18nFormat('dd') == $i ): ?>
                        <td></td>
                        <td></td>
                        <td><?= h($salesDailySummary[$j]['sales_amount_correct']) ?></td>
                        <!--0件目のデータのsales_amount_correcの値を取ってくる-->
                        <td><?= h($salesDailySummary[$j]['pasumo_sales_amount_correct']) ?></td>
                        <td><?= h($cashAccountAmount[$i]) ?></td>
                        <td><?= h($salesDailySummary[$j]['early_shift_amount_correct']) ?></td>
                        <td><?= h($salesDailySummary[$j]['middle_shift_amount_correct']) ?></td>
                        <td><?= h($salesDailySummary[$j]['late_shift_amount_correct']) ?></td>
                        <td><?= h($salesDailySummary[$j]['sales_amount_correct']-$salesDailySummary[$j]['pasumo_sales_amount_correct']-$cashAccountAmount[$i]) ?></td>
                        <td><?= h($salesDailySummary[$j]['note']) ?></td>
                        <td><?= h($sum_lossprice_array[$i]) ?></td>
                        <td></td>
                        <td></td>
                    <?php endif; ?>
                <?php endfor; ?>
            </tr>
        <?php endfor; ?>
    </tbody>
</table>
