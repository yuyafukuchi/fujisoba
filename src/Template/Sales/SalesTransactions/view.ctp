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
    <table cellpadding="0" cellspacing="0">
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
            <?php while($day <= strtotime('last day of this month', $date)) : ?>
                <tr>
                    <td><?=date('d',$day); ?></td>
                    <td><?=$week_name[date('w',$day)]; ?></td>
                    <?php for($i=0;$i<11;$i++): ?>
                        <td></td>
                    <?php endfor; ?>
                </tr>
                <?php $day = strtotime('+1 day', $day); ?>
            <?php endwhile; ?>
        </tbody>
    </table>
    </div>
</div>
