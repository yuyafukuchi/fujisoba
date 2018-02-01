<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CashAccountTran[]|\Cake\Collection\CollectionInterface $cashAccountTrans
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Cash Account Tran'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stores'), ['controller' => 'Stores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Store'), ['controller' => 'Stores', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Accounts'), ['controller' => 'Accounts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Account'), ['controller' => 'Accounts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cashAccountTrans index large-9 medium-8 columns content">
    <h3><?= __('Cash Account Trans') ?></h3>
    <?= $data['name'].' 現金出納表 '?>
    <?= count($date) == 2 ? $date[0].'年'.$date[1].'月' : ''?>
    <?= $this->Form->create(null)?>
     <?= $this->Form->input(
     "transaction_month", ["label" => '',
                    "type" => "datetime",
                    "dateformat" => "YM",
                    "monthNames" => false,
                    "separator" => "/",
                    "templates" => [ "dateWidget" => '{{year}} 年 {{month}} 月' ],
                    "minYear" => date("Y" ) - 70,
                    "maxYear" => date("Y" ) - 18,
                    "default" => date("Y-m" ),] )?>
    <?= $this->Form->submit("検索",['name'=>'button']) ?>
    <?= $this->Form->end()?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th>日付</th>
                <?php $key_array = array_keys($accounts->toArray());?>
                <?php foreach ($accounts as $account) : ?>
                <th><?=h($account)?></th>
                <?php endforeach ; ?>
            </tr>
        </thead>

        <tbody>
            <?php $array_sum = array_fill(0,count($key_array),0); $day_cache = 0;?>
            <?php $midPrinted = false; foreach ($cashAccountTrans as $cashAccountTran): ?>
            <?php if(intval($cashAccountTran->transaction_date->i18nFormat('dd')) >= 16 && !$midPrinted) : ?>
                <tr>
                    <th>中間計</th>
                    <?php for($j = 0 ; $j < count($key_array) ; $j++) :?>
                            <th><?=number_format($array_sum[$j])?></th>
                    <?php endfor;  ?>
                </tr>
            <?php $midPrinted = true ; endif; ?>
            <tr>
                <?php if($day_cache == intval($cashAccountTran->transaction_date->i18nFormat('dd'))) : ?>
                    <th></th>
                <?php else : ?>
                    <th><?= $cashAccountTran->transaction_date->i18nFormat('dd') ?></th>
                    <?php $day_cache = intval($cashAccountTran->transaction_date->i18nFormat('dd')); ?>
                <?php endif; ?>
                <?php $account_id = $cashAccountTran->cash_account_id; ?>
                    <?php for($i = 0 ; $i < count($key_array) ; $i++) :?>
                        <?php if($key_array[$i] == $account_id) :?>
                            <?php $array_sum[$i] += strval($cashAccountTran->amount); ?>
                            <th><?=h(number_format($cashAccountTran->amount))?></th>
                        <?php else : ?>
                            <th></th>
                        <?php endif; ?>
                    <?php endfor;  ?>
            </tr>
            <tr>
                <th></th>
                <?php $account_id = $cashAccountTran->cash_account_id; ?>
                    <?php for($i = 0 ; $i < count($key_array) ; $i++) :?>
                        <?php if($key_array[$i] == $account_id) :?>
                            <th><?=h($cashAccountTran->note)?></th>
                        <?php else : ?>
                            <th></th>
                        <?php endif; ?>
                    <?php endfor;  ?>
            </tr>
            <?php endforeach; ?>
            <tr>
                <th>合計</th>
                <?php for($j = 0 ; $j < count($key_array) ; $j++) :?>
                        <th><?=number_format($array_sum[$j])?></th>

                <?php endfor;  ?>
            </tr>
        </tbody>
    </table>
</div>
