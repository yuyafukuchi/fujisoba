<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesDailySummary $salesDailySummary
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Sales Daily Summary'), ['action' => 'edit', $salesDailySummary->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Sales Daily Summary'), ['action' => 'delete', $salesDailySummary->id], ['confirm' => __('Are you sure you want to delete # {0}?', $salesDailySummary->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sales Daily Summaries'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Sales Daily Summary'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Stores'), ['controller' => 'Stores', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Store'), ['controller' => 'Stores', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="salesDailySummaries view large-9 medium-8 columns content">
<?php $week_name = array("日", "月", "火", "水", "木", "金", "土");?>
<?php $lastDay = date('d', strtotime('last day of this month', $date)) ?>
<?php $day = strtotime('first day of this month',$date);?>

    <?=$storeName ?> 売上日計表
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




    <h3><?= h($salesDailySummary->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Store') ?></th>
            <td><?= $salesDailySummary->has('store') ? $this->Html->link($salesDailySummary->store->name, ['controller' => 'Stores', 'action' => 'view', $salesDailySummary->store->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($salesDailySummary->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Cash Sales Amount') ?></th>
            <td><?= $this->Number->format($salesDailySummary->cash_sales_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sales Amount') ?></th>
            <td><?= $this->Number->format($salesDailySummary->sales_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pasumo Sales Amount') ?></th>
            <td><?= $this->Number->format($salesDailySummary->pasumo_sales_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Early Shift Amount') ?></th>
            <td><?= $this->Number->format($salesDailySummary->early_shift_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Middle Shift Amount') ?></th>
            <td><?= $this->Number->format($salesDailySummary->middle_shift_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Late Shift Amount') ?></th>
            <td><?= $this->Number->format($salesDailySummary->late_shift_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sales Amount Correct') ?></th>
            <td><?= $this->Number->format($salesDailySummary->sales_amount_correct) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Pasumo Sales Amount Correct') ?></th>
            <td><?= $this->Number->format($salesDailySummary->pasumo_sales_amount_correct) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Early Shift Amount Correct') ?></th>
            <td><?= $this->Number->format($salesDailySummary->early_shift_amount_correct) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Middle Shift Amount Correct') ?></th>
            <td><?= $this->Number->format($salesDailySummary->middle_shift_amount_correct) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Late Shift Amount Correct') ?></th>
            <td><?= $this->Number->format($salesDailySummary->late_shift_amount_correct) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vendor No1 Amount') ?></th>
            <td><?= $this->Number->format($salesDailySummary->vendor_no1_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vendor No2 Amount') ?></th>
            <td><?= $this->Number->format($salesDailySummary->vendor_no2_amount) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount 7to8') ?></th>
            <td><?= $this->Number->format($salesDailySummary->amount_7to8) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount 8to9') ?></th>
            <td><?= $this->Number->format($salesDailySummary->amount_8to9) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount 9to10') ?></th>
            <td><?= $this->Number->format($salesDailySummary->amount_9to10) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount 10to11') ?></th>
            <td><?= $this->Number->format($salesDailySummary->amount_10to11) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount 11to12') ?></th>
            <td><?= $this->Number->format($salesDailySummary->amount_11to12) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount 12to13') ?></th>
            <td><?= $this->Number->format($salesDailySummary->amount_12to13) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount 13to14') ?></th>
            <td><?= $this->Number->format($salesDailySummary->amount_13to14) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount 14to15') ?></th>
            <td><?= $this->Number->format($salesDailySummary->amount_14to15) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount 15to16') ?></th>
            <td><?= $this->Number->format($salesDailySummary->amount_15to16) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount 16to17') ?></th>
            <td><?= $this->Number->format($salesDailySummary->amount_16to17) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount 17to18') ?></th>
            <td><?= $this->Number->format($salesDailySummary->amount_17to18) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount 18to19') ?></th>
            <td><?= $this->Number->format($salesDailySummary->amount_18to19) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount 19to20') ?></th>
            <td><?= $this->Number->format($salesDailySummary->amount_19to20) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount 20to21') ?></th>
            <td><?= $this->Number->format($salesDailySummary->amount_20to21) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount 21to22') ?></th>
            <td><?= $this->Number->format($salesDailySummary->amount_21to22) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount 22to23') ?></th>
            <td><?= $this->Number->format($salesDailySummary->amount_22to23) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount 23to24') ?></th>
            <td><?= $this->Number->format($salesDailySummary->amount_23to24) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount 24to1') ?></th>
            <td><?= $this->Number->format($salesDailySummary->amount_24to1) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount 1to2') ?></th>
            <td><?= $this->Number->format($salesDailySummary->amount_1to2) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount 2to3') ?></th>
            <td><?= $this->Number->format($salesDailySummary->amount_2to3) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount 3to4') ?></th>
            <td><?= $this->Number->format($salesDailySummary->amount_3to4) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount 4to5') ?></th>
            <td><?= $this->Number->format($salesDailySummary->amount_4to5) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount 5to6') ?></th>
            <td><?= $this->Number->format($salesDailySummary->amount_5to6) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Amount 6to7') ?></th>
            <td><?= $this->Number->format($salesDailySummary->amount_6to7) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created By') ?></th>
            <td><?= $this->Number->format($salesDailySummary->created_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated By') ?></th>
            <td><?= $this->Number->format($salesDailySummary->updated_by) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Transaction Date') ?></th>
            <td><?= h($salesDailySummary->transaction_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created Date') ?></th>
            <td><?= h($salesDailySummary->created_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Updated Date') ?></th>
            <td><?= h($salesDailySummary->updated_date) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Note') ?></h4>
        <?= $this->Text->autoParagraph(h($salesDailySummary->note)); ?>
    </div>
</div>
