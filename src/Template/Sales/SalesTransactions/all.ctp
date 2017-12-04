<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesTransaction $salesTransaction
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
    </ul>
</nav>
<?php $week_name = array("日", "月", "火", "水", "木", "金", "土");?>
<?php $lastDay = date('d', strtotime('last day of this month', $date)) ?>
<?php $day = strtotime('first day of this month',$date);?>
<div class="salesTransactions view large-9 medium-8 columns content">
    売上集計表
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
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th colspan='2'>稼働日数</th>
            </tr>
            <tr>
                <th colspan='2'>予算</th>
            </tr>
            <tr>
                <th colspan='2'>予算平均</th>
            </tr>
            <tr>
                <th>日</th>
                <th>曜</th>
                <th>総売上</th>
                <th>早番</th>
                <th>中番</th>
                <th>遅番</th>
                <?php foreach ($stores as $store): ?>
                    <th><?=h($store->name)?></th>
                <?php endforeach; ?>
                <th>合計</th>
            </tr>
        </thead>
        <tbody>
            <?php while($day <= strtotime('last day of this month', $date)) : ?>
                <tr>
                    <td><?=date('d',$day)?></td>
                    <td><?=$week_name[date('w',$day)]?></td>
                </tr>
                <?php $day = strtotime('+1 day', $day); ?>
            <?php endwhile; ?>
            <tr>
                <td>合計</td>
            </tr>
            <tr>
                <td>差異</td>
            </tr>
            <tr>
                <td>平均</td>
            </tr>
            <tr>
                <td>差異</td>
            </tr>
            <tr>
                <td>達成率%</td>
            </tr>
        </tbody>
    </table>
    </div>
</div>
