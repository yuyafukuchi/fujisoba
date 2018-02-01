<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesDailySummary[]|\Cake\Collection\CollectionInterface $salesDailySummaries
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Sales Daily Summary'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stores'), ['controller' => 'Stores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Store'), ['controller' => 'Stores', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="salesDailySummaries index large-9 medium-8 columns content">
    <h3><?= __('Sales Daily Summaries') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('store_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('transaction_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('cash_sales_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sales_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pasumo_sales_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('early_shift_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('middle_shift_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('late_shift_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sales_amount_correct') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pasumo_sales_amount_correct') ?></th>
                <th scope="col"><?= $this->Paginator->sort('early_shift_amount_correct') ?></th>
                <th scope="col"><?= $this->Paginator->sort('middle_shift_amount_correct') ?></th>
                <th scope="col"><?= $this->Paginator->sort('late_shift_amount_correct') ?></th>
                <th scope="col"><?= $this->Paginator->sort('vendor_no1_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('vendor_no2_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_7to8') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_8to9') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_9to10') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_10to11') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_11to12') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_12to13') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_13to14') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_14to15') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_15to16') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_16to17') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_17to18') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_18to19') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_19to20') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_20to21') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_21to22') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_22to23') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_23to24') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_24to1') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_1to2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_2to3') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_3to4') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_4to5') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_5to6') ?></th>
                <th scope="col"><?= $this->Paginator->sort('amount_6to7') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('updated_date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($salesDailySummaries as $salesDailySummary): ?>
            <tr>
                <td><?= $this->Number->format($salesDailySummary->id) ?></td>
                <td><?= $salesDailySummary->has('store') ? $this->Html->link($salesDailySummary->store->name, ['controller' => 'Stores', 'action' => 'view', $salesDailySummary->store->id]) : '' ?></td>
                <td><?= h($salesDailySummary->transaction_date) ?></td>
                <td><?= $this->Number->format($salesDailySummary->cash_sales_amount) ?></td>
                <td><?= $this->Number->format($salesDailySummary->sales_amount) ?></td>
                <td><?= $this->Number->format($salesDailySummary->pasumo_sales_amount) ?></td>
                <td><?= $this->Number->format($salesDailySummary->early_shift_amount) ?></td>
                <td><?= $this->Number->format($salesDailySummary->middle_shift_amount) ?></td>
                <td><?= $this->Number->format($salesDailySummary->late_shift_amount) ?></td>
                <td><?= $this->Number->format($salesDailySummary->sales_amount_correct) ?></td>
                <td><?= $this->Number->format($salesDailySummary->pasumo_sales_amount_correct) ?></td>
                <td><?= $this->Number->format($salesDailySummary->early_shift_amount_correct) ?></td>
                <td><?= $this->Number->format($salesDailySummary->middle_shift_amount_correct) ?></td>
                <td><?= $this->Number->format($salesDailySummary->late_shift_amount_correct) ?></td>
                <td><?= $this->Number->format($salesDailySummary->vendor_no1_amount) ?></td>
                <td><?= $this->Number->format($salesDailySummary->vendor_no2_amount) ?></td>
                <td><?= $this->Number->format($salesDailySummary->amount_7to8) ?></td>
                <td><?= $this->Number->format($salesDailySummary->amount_8to9) ?></td>
                <td><?= $this->Number->format($salesDailySummary->amount_9to10) ?></td>
                <td><?= $this->Number->format($salesDailySummary->amount_10to11) ?></td>
                <td><?= $this->Number->format($salesDailySummary->amount_11to12) ?></td>
                <td><?= $this->Number->format($salesDailySummary->amount_12to13) ?></td>
                <td><?= $this->Number->format($salesDailySummary->amount_13to14) ?></td>
                <td><?= $this->Number->format($salesDailySummary->amount_14to15) ?></td>
                <td><?= $this->Number->format($salesDailySummary->amount_15to16) ?></td>
                <td><?= $this->Number->format($salesDailySummary->amount_16to17) ?></td>
                <td><?= $this->Number->format($salesDailySummary->amount_17to18) ?></td>
                <td><?= $this->Number->format($salesDailySummary->amount_18to19) ?></td>
                <td><?= $this->Number->format($salesDailySummary->amount_19to20) ?></td>
                <td><?= $this->Number->format($salesDailySummary->amount_20to21) ?></td>
                <td><?= $this->Number->format($salesDailySummary->amount_21to22) ?></td>
                <td><?= $this->Number->format($salesDailySummary->amount_22to23) ?></td>
                <td><?= $this->Number->format($salesDailySummary->amount_23to24) ?></td>
                <td><?= $this->Number->format($salesDailySummary->amount_24to1) ?></td>
                <td><?= $this->Number->format($salesDailySummary->amount_1to2) ?></td>
                <td><?= $this->Number->format($salesDailySummary->amount_2to3) ?></td>
                <td><?= $this->Number->format($salesDailySummary->amount_3to4) ?></td>
                <td><?= $this->Number->format($salesDailySummary->amount_4to5) ?></td>
                <td><?= $this->Number->format($salesDailySummary->amount_5to6) ?></td>
                <td><?= $this->Number->format($salesDailySummary->amount_6to7) ?></td>
                <td><?= $this->Number->format($salesDailySummary->created_by) ?></td>
                <td><?= h($salesDailySummary->created_date) ?></td>
                <td><?= $this->Number->format($salesDailySummary->updated_by) ?></td>
                <td><?= h($salesDailySummary->updated_date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $salesDailySummary->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $salesDailySummary->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $salesDailySummary->id], ['confirm' => __('Are you sure you want to delete # {0}?', $salesDailySummary->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
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
</div>
