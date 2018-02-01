<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesItemTransaction[]|\Cake\Collection\CollectionInterface $salesItemTransactions
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Sales Item Transaction'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sales Transactions'), ['controller' => 'SalesTransactions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sales Transaction'), ['controller' => 'SalesTransactions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sales Items'), ['controller' => 'SalesItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sales Item'), ['controller' => 'SalesItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<?php $week_name = array("日", "月", "火", "水", "木", "金", "土");?>
<?php $arraySize = count($salesItemHistories);?>
<?php $lastDay = date('d', strtotime('last day of this month', $date)) ?>
<?php $day = strtotime('first day of this month',$date);?>
<?php $sumArray = array(array(0,0), array(0,0), array(0,0), array(0,0)); ?>
<?php $index = array(0,0,0,0); ?>
<div class="salesItemTransactions index large-9 medium-8 columns content">
    <?php if($storeName == null){$storeName = 'ほげ';}?>
    <?=$storeName ?> 出庫日計表
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
    <h3><?= __('Sales Item Transactions') ?></h3>
    <table cellpadding="0" cellspacing="0">
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
                    <td><?=h(date('d',$day))?></td>
                    <td><?=h($week_name[date('w',$day)]) ?></td>
                    <?php for($i=0;$i<$arraySize;$i++) : ?>
                        <?php if(count($salesItemHistories[$i]) > $index[$i]
                        && $salesItemHistories[$i][$index[$i]]['sales_item_daliy_summary']['transaction_date']->i18nFormat('dd') == date('d',$day) ) : ?>
                            <td><?=$salesItemHistories[$i][$index[$i]]['sales_item_daliy_summary']['qty']?></td>
                            <td><?=number_format($salesItemHistories[$i][$index[$i]]['sales_item_daliy_summary']['sales_item_price_sum'])?></td>
                            <?php $sumArray[$i][0] += intval($salesItemHistories[$i][$index[$i]]['sales_item_daliy_summary']['qty']); ?>
                            <?php $sumArray[$i][1] += intval($salesItemHistories[$i][$index[$i]]['sales_item_daliy_summary']['sales_item_price_sum']); ?>
                            <?php $index[$i] ++; ?>
                        <?php else : ?>
                            <td></td>
                            <td></td>
                        <?php endif; ?>
                    <?php endfor; ?>
                </tr>
                <?php $day = strtotime('+1 day', $day); ?>
            <?php endwhile; ?>
            <tr>
                <td>合計</td>
                <td></td>
                <?php for($i=0;$i<$arraySize;$i++) : ?>
                    <td><?=number_format(h($sumArray[$i][0])) ?></td>
                    <td><?=number_format(h($sumArray[$i][1])) ?></td>
                <?php endfor; ?>
            </tr>
            <tr>
                <td>平均</td>
                <td></td>
                <?php for($i=0;$i<$arraySize;$i++) : ?>
                    <td><?= number_format(h(count($salesItemHistories[$i])) != 0 ? round($sumArray[$i][0]/count($salesItemHistories[$i])) : 0) ?></td>
                    <td><?= number_format(h(count($salesItemHistories[$i])) != 0 ? round($sumArray[$i][1]/count($salesItemHistories[$i])) : 0) ?></td>
                <?php endfor; ?>
            </tr>
        </tbody>
    </table>
</div>
