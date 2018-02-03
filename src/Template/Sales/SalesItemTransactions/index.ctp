<header class="row">
    <div class="col-sm-8">
        <h2><?=$storeName ?>　出庫日計表　<?= date('Y年m月度', $date) ?></h2>
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
    <?= $this->Form->create(null, ['url' => ['action' => 'index', 'store' => $this->request->query('store')], 'class' => 'form-inline']) ?>
        <?= $this->Form->control('queryName',['label' => false, 'style' => 'min-width: 30em;'])?>
        <div style="display: inline-block;"><?= $this->Form->submit("検索",['name'=>'button']) ?></div>
    <?=$this->Form->end() ?>
</div>

<?php $week_name = array("日", "月", "火", "水", "木", "金", "土");?>
<?php $arraySize = count($salesItemHistories);?>
<?php $lastDay = date('d', strtotime('last day of this month', $date)) ?>
<?php $day = strtotime('first day of this month',$date);?>
<?php $sumArray = array(array(0,0), array(0,0), array(0,0), array(0,0)); ?>
<?php $index = array(0,0,0,0); ?>

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
            <th colspan="2"></th>
            <?php foreach ($salesItemHistories as $salesItemHistory) : ?>
                <th colspan="2"><?=$salesItemHistory[0]['sales_item_name']?><br>
                単価：<?= $salesItemHistory[0]['sales_item_daliy_summary']['sales_item_price_sum'] / $salesItemHistory[0]['sales_item_daliy_summary']['qty'] ?></th>
            <?php endforeach; ?>
            <th>合計金額</th>
        </tr>
        <tr>
            <th>日</th>
            <th>曜</th>
            <?php for($i=0;$i<$arraySize;$i++) : ?>
                <th>出庫数</th>
                <th>金額</th>
            <?php endfor; ?>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php while($day <= strtotime('last day of this month', $date)) : ?>
            <tr>
                <?php $tempTotal = 0; ?>
                <td><?=h(date('d',$day))?></td>
                <td><?=h($week_name[date('w',$day)]) ?></td>
                <?php for($i=0;$i<$arraySize;$i++) : ?>
                    <?php if(count($salesItemHistories[$i]) > $index[$i]
                    && $salesItemHistories[$i][$index[$i]]['sales_item_daliy_summary']['transaction_date']->i18nFormat('dd') == date('d',$day) ) : ?>
                        <td><?=$salesItemHistories[$i][$index[$i]]['sales_item_daliy_summary']['qty']?></td>
                        <td><?=number_format($salesItemHistories[$i][$index[$i]]['sales_item_daliy_summary']['sales_item_price_sum'])?></td>
                        <?php $tempTotal += (int)$salesItemHistories[$i][$index[$i]]['sales_item_daliy_summary']['sales_item_price_sum']; ?>
                        <?php $sumArray[$i][0] += intval($salesItemHistories[$i][$index[$i]]['sales_item_daliy_summary']['qty']); ?>
                        <?php $sumArray[$i][1] += intval($salesItemHistories[$i][$index[$i]]['sales_item_daliy_summary']['sales_item_price_sum']); ?>
                        <?php $index[$i] ++; ?>
                    <?php else : ?>
                        <td></td>
                        <td></td>
                    <?php endif; ?>
                <?php endfor; ?>
                <td><?= $this->Number->format($tempTotal) ?></td>
            </tr>
            <?php $day = strtotime('+1 day', $day); ?>
        <?php endwhile; ?>
        <tr class="pink">
            <td>合計</td>
            <td></td>
            <?php $tempTotal = 0; ?>
            <?php for($i=0;$i<$arraySize;$i++) : ?>
                <td><?=number_format(h($sumArray[$i][0])) ?></td>
                <td><?=number_format(h($sumArray[$i][1])) ?></td>
                <?php $tempTotal += (int)h($sumArray[$i][1]); ?>
            <?php endfor; ?>
            <td><?= $this->Number->format($tempTotal) ?></td>
        </tr>
        <tr>
            <td>平均</td>
            <td></td>
            <?php $tempTotal = 0; ?>
            <?php for($i=0;$i<$arraySize;$i++) : ?>
                <?php
                // 平均を計算
                $dayNum = (int)date('d', strtotime('last day of this month', $date));
                $avg = count($salesItemHistories[$i]) != 0 ? round($sumArray[$i][1] / count($salesItemHistories[$i])) : 0;

                ?>
                <?php $tempTotal += (int)$avg; ?>
                <td><?= number_format(count($salesItemHistories[$i]) != 0 ? round($sumArray[$i][0]/count($salesItemHistories[$i])) : 0) ?></td>
                <td><?= number_format($avg) ?></td>
            <?php endfor; ?>
            <td><?= $this->Number->format($tempTotal) ?></td>
        </tr>
    </tbody>
</table>
<?php debug(); ?>