<header class="row">
    <div class="col-sm-8">
        <h2><?= $data['name']?>　現金出納入力　<?= date('Y年m月d日',$date) ?></h2>
    </div>
    <div class="col-sm-4">
        <?= $this->Form->create(null, ['class' => 'form-inline pull-right'])?>
        <?= $this->Form->input('datepicker', ['label' => '出納日: ', 'type'=>'text', 'class' => 'datepicker', 'default' => date('Y-m-d', $date)])?>
        <div style="display: inline-block;"><?= $this->Form->submit('設定', ['name' => 'button']) ?></div>
        <?= $this->Form->end()?>
    </div>
</header>

<?= $this->Form->create(null, ['class' => 'form-inline form-bordered']) ?>
    <?= $this->Form->control('cash_account_id', ['options' => $accounts,'label' => '科目:']) ?>
    <?= $this->Form->control('amount', ['label' => '出納額:','type'=>'number', 'required' => true]) ?>
    <?= $this->Form->control('note', ['label' => '内訳:','rows'=>1,'type'=>'text', 'required' => true, 'style' => 'min-width: 30em;']) ?>
    <?= $this->Form->hidden('store_id', ['value' => $this->request->query('store')]) ?>
    <div style="display: inline-block;"><?= $this->Form->submit('新規登録', ['name'=>'button']) ?></div>
<?= $this->Form->end() ?>

<hr style="margin: 30px 0;">

<?= $this->Form->create(null, ['class' => 'form-inline']) ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">明細NO</th>
                <th scope="col">科目名</th>
                <th scope="col">出納額</th>
                <th scope="col">内訳</th>
                <th scope="col">処理</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($cashAccountTranss)): ?>
                <?php $sum = 0; foreach ($cashAccountTranss as $key => $cashAccountTran): ?>
                <tr>
                    <td>
                        <?= $this->Form->hidden('cashAccountTrans['.$cashAccountTran->id.'][id]', [
                            'value' => $cashAccountTran->id,
                        ]) ?>
                        <?= h($key + 1) ?>
                    </td>
                    <td>
                        <?= $this->Form->control('cashAccountTrans['.$cashAccountTran->id.'][cash_account_id]', [
                            'label' => false,
                            'value' => $cashAccountTran->cash_account_id,
                            'options' => $accounts,
                        ]) ?>
                    </td>
                    <td>
                        <?= $this->Form->control('cashAccountTrans['.$cashAccountTran->id.'][amount]', [
                            'label' => false,
                            'type'=>'number',
                            'value' => $cashAccountTran->amount,
                            'required' => true,
                        ]) ?>
                    </td>
                    <td>
                        <?= $this->Form->control('cashAccountTrans['.$cashAccountTran->id.'][note]', [
                            'label' => false,
                            'value' => $cashAccountTran->note,
                            'required' => true,
                            'style' => 'min-width: 30em;',
                        ]) ?></td>
                    <td><?= $this->Html->link('削除', ['action' => 'delete', $cashAccountTran->id, $this->request->query('store')], ['onClick' => 'return confirm("削除してよろしいですか？")', 'class' => 'btn btn-default']) ?></td>

                </tr>
                <?php $sum += intVal($cashAccountTran['amount']); endforeach; ?>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td>出納合計：</td>
                <td><?= number_format(h($sum)) ?></td>
                <td colspan="2"></td>
            </tr>
        </tfoot>
    </table>

    <p><?= $this->Form->submit('登録', ['name' => 'button', 'class' => 'btn btn-default btn-lg pull-right']);?></p>
<?= $this->Form->end() ?>
