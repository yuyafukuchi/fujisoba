<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CashAccountTran $cashAccountTran
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Cash Account Trans'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Stores'), ['controller' => 'Stores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Store'), ['controller' => 'Stores', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Accounts'), ['controller' => 'Accounts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Account'), ['controller' => 'Accounts', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="cashAccountTrans form large-9 medium-8 columns content">
    <?= $data['name'].' 現金出納入力 '?>
    <?= count($date) == 3 ? $date[0].'年'.$date[1].'月'.$date[2].'日' : ''?>
    <?= $this->Form->create(null)?>
    <?= $this->Form->control('date',['label' => '出納日','rows'=>1,'type'=>'text'])?>
    <?= $this->Form->submit("設定",['name'=>'button']) ?>
    <?= $this->Form->end()?>
    <?= $this->Form->create($cashAccountTran) ?>
    <fieldset>
        <legend><?= __('Add Cash Account Tran') ?></legend>
        <?php
        /*
            echo $this->Form->control('store_id', ['options' => $stores]);
            echo $this->Form->control('transaction_date', ['empty' => true]);
            */
            echo $this->Form->control('cash_account_id', ['options' => $accounts,'label' => '科目']);
            echo $this->Form->control('amount',['label' => '出納額','type'=>'number']);
            echo $this->Form->control('note',['label' => '内訳','rows'=>1,'type'=>'text']);
        ?>
    </fieldset>
    <?= $this->Form->submit("送信",['name'=>'button']) ?>
    <?= $this->Form->end() ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col">明細NO</th>
                <th scope="col">科目名</th>
                <th scope="col">出納額</th>
                <th scope="col">内訳</th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <!--
        <tbody>
            <?php $i = 1;$sum = 0; foreach ($cashAccountTrans as $cashAccountTran): ?>
            <tr>
                <td><?= h($i) ?></td>
                <td><?= h($cashAccountTran['amount']) ?></td>
                <td><?= h($cashAccountTran['note']) ?></td>
                <td><?= $this->Form->postLink('削除', ['action' => 'deleteCache', $i], ['confirm' => '削除してよろしいですか？']) ?></td>
                <td><?= h($cashAccountTran['cash_account_id']) ?></td>

                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $cashAccountTran->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cashAccountTran->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cashAccountTran->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cashAccountTran->id)]) ?>
                </td>

            </tr>
            <?php $sum += intVal($cashAccountTran['amount']); $i ++ ; endforeach; ?>
        </tbody>
        -->

        <tbody>
            <?php echo(count($cashAccountTrans)) ?>
            <?php $i = 1;$sum = 0; for ($j=0; $j<20; $j++): ?>
            <?php if(empty($cashAccountTrans[$j])){continue;}; ?>
            <tr>
                <td>$j = <?= h($j) ?></td>
                <td><?= h($i) ?></td>
                <td><?= number_format(h($cashAccountTrans[$j]['amount'])) ?></td>
                <td><?= h($cashAccountTrans[$j]['note']) ?></td>
                <td><?= $this->Form->postLink('削除', ['action' => 'deleteCache', $j+1], ['confirm' => '削除してよろしいですか？']) ?></td>
            </tr>
            <?php $sum += intVal($cashAccountTran['amount']); $i ++ ; endfor; ?>
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td>'出納合計：</td>
                <td><?= number_format(h($sum)) ?></td>
                <td></td>
                <td><?= $this->Html->link('登録', ['action'=>'addConfirm']);?></td>
            </tr>
        </tfoot>
    </table>
</div>
