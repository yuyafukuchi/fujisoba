<header class="row">
    <div class="col-sm-8">
        <h2>マスタメニュー設定　<span class="text-red"><?= date('Y年m月d日',$date) ?>以降の設定</span></h2>
    </div>
    <div class="col-sm-4">
        <?= $this->Form->create(null, ['class' => 'form-inline pull-right'])?>
        <?= $this->Form->input('date', ['label' => '適用日: ', 'type'=>'text', 'class' => 'datepicker', 'default' => date('Y-m-d', $date)])?>
        <div style="display: inline-block;"><?= $this->Form->submit('設定', ['name' => 'button']) ?></div>
        <?= $this->Form->end()?>
    </div>
</header>

<?= $this->Form->create(null, ['class' => 'form-inline form-bordered']) ?>
    <?= $this->Form->control('menu_number',['label' => 'メニュー番号','rows'=>1,'type'=>'number'])?>
    <?= $this->Form->control('menu_name',['label' => 'メニュー名','rows'=>1,'type'=>'text'])?>
    <?= $this->Form->control('item_number',['label' => '出庫アイテム番号','rows'=>1,'type'=>'number'])?>
    <?= $this->Form->control('item_name',['label' => '出庫アイテム名','rows'=>1,'type'=>'text'])?>
    <div style="display: inline-block;"><?= $this->Form->submit('新規登録', ['name'=>'button']) ?></div>
<?= $this->Form->end() ?>

<table class="table table-bordered form-inline">
    <thead>
        <tr>
            <th scope="col">メニュー番号</th>
            <th scope="col">メニュー名</th>
            <th scope="col">出庫アイテム番号</th>
            <th scope="col">出庫アイテム名</th>
            <th scope="col">期間</th>
            <th scope="col" style="width: 1em;"></th>
            <th scope="col" style="width: 1em;"></th>
            <th scope="col" style="width: 1em;"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($menuHistories as $menuHistory): ?>
        <tr>
            <td><?= h($menuHistory['Menus']['menu_number']) ?></td>
            <td><?= h($menuHistory->name) ?></td>
            <td><?= h($menuHistory['SalesItems']['sales_item_number'])?></td>
            <td><?= h($menuHistory['SalesItemHistories']['sales_item_name'])?></td>
            <td><?= h($menuHistory->start->i18nFormat('yyyy/MM/dd~')) ?> </td>
            <td><?= $this->Html->link('編集', ['action' => 'edit', $menuHistory->id], ['class' => 'btn btn-default btn-xs']) ?></td>
            <td> <?= $this->Form->postLink('削除', ['action' => 'delete', $menuHistory->id], ['class' => 'btn btn-default btn-xs']) ?></td>
            <td> <?= $this->Html->link('割付', ['controller' => 'SalesItemAssignHistories','action' => 'index'], ['class' => 'btn btn-default btn-xs']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
