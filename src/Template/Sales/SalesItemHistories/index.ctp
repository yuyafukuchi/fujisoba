<header class="row">
    <div class="col-sm-8">
        <h2><?= $data['name']?>　マスタ出庫アイテム設定　<span class="text-red"><?= date('Y年m月d日',$date) ?>以降の設定</span></h2>
    </div>
    <div class="col-sm-4">
        <?= $this->Form->create(null, ['class' => 'form-inline pull-right'])?>
        <?= $this->Form->input('date', ['label' => '設定日: ', 'type'=>'text', 'class' => 'datepicker', 'default' => date('Y-m-d', $date)])?>
        <div style="display: inline-block;"><?= $this->Form->submit('設定', ['name' => 'button']) ?></div>
        <?= $this->Form->end()?>
    </div>
</header>

<div style="margin: 30px 0;">
    <?=$this->Form->create(null, ['class' => 'form-inline']) ?>
        <?= $this->Form->control('number',['label' => '出庫アイテム番号','rows'=>1,'type'=>'number'])?>
        <?= $this->Form->control('name',['label' => '出庫アイテム名','rows'=>1,'type'=>'text'])?>
        <div style="display: inline-block;"><?= $this->Form->submit("新規作成",['name'=>'button']) ?></div>
    <?=$this->Form->end() ?>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">番号</th>
            <th scope="col">品名</th>
            <th scope="col" style="width: 1em;"></th>
            <th scope="col" style="width: 1em;"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($salesItemHistories as $key => $salesItemHistory): ?>
        <tr>
            <td><?= h($key + 1) ?></td>
            <td><?= h($salesItemHistory->sales_item_name) ?></td>
            <td><?= $this->Html->link('変更', ['action' => 'edit', $salesItemHistory->id], ['class' => 'btn btn-default']) ?></td>
            <td><?= $this->Form->postLink('削除', ['action' => 'delete', $salesItemHistory->id], ['class' => 'btn btn-default']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
