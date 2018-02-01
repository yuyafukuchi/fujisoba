<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesDailySummary $salesDailySummary
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $salesDailySummary->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $salesDailySummary->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Sales Daily Summaries'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Stores'), ['controller' => 'Stores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Store'), ['controller' => 'Stores', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="salesDailySummaries form large-9 medium-8 columns content">
    <?= $this->Form->create($salesDailySummary) ?>
    <fieldset>
        <legend><?= __('Edit Sales Daily Summary') ?></legend>
        <?php
            echo $this->Form->control('store_id', ['options' => $stores, 'empty' => true]);
            echo $this->Form->control('transaction_date', ['empty' => true]);
            echo $this->Form->control('cash_sales_amount');
            echo $this->Form->control('sales_amount');
            echo $this->Form->control('pasumo_sales_amount');
            echo $this->Form->control('early_shift_amount');
            echo $this->Form->control('middle_shift_amount');
            echo $this->Form->control('late_shift_amount');
            echo $this->Form->control('sales_amount_correct');
            echo $this->Form->control('pasumo_sales_amount_correct');
            echo $this->Form->control('early_shift_amount_correct');
            echo $this->Form->control('middle_shift_amount_correct');
            echo $this->Form->control('late_shift_amount_correct');
            echo $this->Form->control('note');
            echo $this->Form->control('vendor_no1_amount');
            echo $this->Form->control('vendor_no2_amount');
            echo $this->Form->control('amount_7to8');
            echo $this->Form->control('amount_8to9');
            echo $this->Form->control('amount_9to10');
            echo $this->Form->control('amount_10to11');
            echo $this->Form->control('amount_11to12');
            echo $this->Form->control('amount_12to13');
            echo $this->Form->control('amount_13to14');
            echo $this->Form->control('amount_14to15');
            echo $this->Form->control('amount_15to16');
            echo $this->Form->control('amount_16to17');
            echo $this->Form->control('amount_17to18');
            echo $this->Form->control('amount_18to19');
            echo $this->Form->control('amount_19to20');
            echo $this->Form->control('amount_20to21');
            echo $this->Form->control('amount_21to22');
            echo $this->Form->control('amount_22to23');
            echo $this->Form->control('amount_23to24');
            echo $this->Form->control('amount_24to1');
            echo $this->Form->control('amount_1to2');
            echo $this->Form->control('amount_2to3');
            echo $this->Form->control('amount_3to4');
            echo $this->Form->control('amount_4to5');
            echo $this->Form->control('amount_5to6');
            echo $this->Form->control('amount_6to7');
            echo $this->Form->control('created_by');
            echo $this->Form->control('created_date', ['empty' => true]);
            echo $this->Form->control('updated_by');
            echo $this->Form->control('updated_date', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
