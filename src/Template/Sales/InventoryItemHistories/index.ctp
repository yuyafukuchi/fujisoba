<header class="row">
    <div class="col-sm-8">
        <h2><?= $data['name']?>　マスタ在庫アイテム　<span class="text-red"><?= date('Y年m月d日',$date) ?>以降の設定</span></h2>
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
        <?= $this->Form->control('name',['label' => false, 'style' => 'min-width: 30em;'])?>
        <div style="display: inline-block;"><?= $this->Form->submit("新規作成",['name'=>'button']) ?></div>
    <?=$this->Form->end() ?>
</div>

<table class="table table-bordered">
    <caption>マスタ在庫アイテム</caption>
    <thead>
        <tr>
            <th scope="col">品名</th>
            <th scope="col" style="width: 1em;"></th>
            <th scope="col" style="width: 1em;"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($inventoryItemHistories as $inventoryItemHistory): ?>
        <tr>
            <td><?= h($inventoryItemHistory->item_name) ?></td>
            <td><?= $this->Html->link(__('編集'), ['action' => 'edit', $inventoryItemHistory->id], ['class' => 'btn btn-default']) ?></td>
            <td> <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $inventoryItemHistory->id], ['class' => 'btn btn-default']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
