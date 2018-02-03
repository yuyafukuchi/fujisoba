<header class="row">
    <div class="col-sm-8">
        <h2><?= $data['name']?>　在庫計算アイテム　<span class="text-red"><?= date('Y年m月d日',$date) ?>以降の設定</span></h2>
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

<div class="row">
    <div class="col-sm-4">
        <table class="table table-bordered">
            <caption>マスタ在庫アイテム</caption>
            <thead>
                <tr>
                    <th scope="col">品名</th>
                    <th scope="col" style="width: 1em;"></th>
                    <th scope="col" style="width: 1em;">追加</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inventoryItemHistories as $inventoryItemHistory): ?>
                <tr>
                    <td><?= h($inventoryItemHistory->item_name) ?></td>
                    <td><?= $this->Form->postLink('削除', ['controller' => 'InventoryItemHistories','action' => 'delete', $inventoryItemHistory->id], ['class' => 'btn btn-default btn-xs']) ?></td>
                    <td><?= in_array($inventoryItemHistory->inventory_item_id,$idArray,true) ? h(''):
                    $this->Form->postLink(' > ', ['action' => 'add', 'item' => $inventoryItemHistory->inventory_item_id, 'store' => $storeId], ['class' => 'btn', 'style' => 'width: 3em;']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="col-sm-8">
        <table class="table table-bordered">
            <caption>店舗別在庫アイテム</caption>
            <thead>
                <tr>
                    <th scope="col">品名</th>
                    <th scope="col">ロス</th>
                    <th scope="col">価格</th>
                    <th scope="col">原価</th>
                    <th scope="col" style="width: 1em;"></th>
                    <th scope="col" style="width: 1em;"></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; foreach ($storeInventoryItemHistories as $storeInventoryItemHistory): ?>
                <tr class="form-inline">
                    <?=$this->Form->create('StoreInventoryItemHistories',['url' => ['action' => 'edit','store' => $storeId, 'inventory_item_id' => intval($storeInventoryItemHistory->inventory_item_id), $storeInventoryItemHistory->id], 'class' => 'form-inline']) ?>
                    <td><?= h($storeInventoryItemHistory->inventory_item_history->item_name) ?></td>
                    <!--<td><?= $this->Form->control('loss_price'.$storeInventoryItemHistory->id,['label' => '','rows'=>1,'type'=>'number', 'default' => intval($storeInventoryItemHistory->loss_price)])?></td>-->
                    <!--<td><?= $this->Form->control('price'.$storeInventoryItemHistory->id,['label' => '','rows'=>1,'type'=>'number', 'default' => intval($storeInventoryItemHistory->price)])?></td>-->
                    <!--<td><?= $this->Form->control('cost'.$storeInventoryItemHistory->id,['label' => '','rows'=>1,'type'=>'number', 'step'=>0.1, 'default' => intval($storeInventoryItemHistory->cost)])?></td>-->
                    <td><?= $this->Form->control('loss_price', ['label' => '','rows'=>1,'type'=>'number', 'default' => intval($storeInventoryItemHistory->loss_price)])?></td>
                    <td><?= $this->Form->control('price', ['label' => '','rows'=>1,'type'=>'number', 'default' => intval($storeInventoryItemHistory->price)])?></td>
                    <td><?= $this->Form->control('cost', ['label' => '','rows'=>1,'type'=>'number', 'step'=>0.1, 'default' => intval($storeInventoryItemHistory->cost)])?></td>
                    <td><?= $this->Form->submit("変更", ['name'=>'button']) ?></td>
                    <?=$this->Form->end() ?>
                    <td><?= $this->Form->postLink('削除',
                        [
                            'action' => 'delete',
                            $storeInventoryItemHistory->id,
                            'store' => $storeId,
                            'inventory_item_id' => intval($storeInventoryItemHistory->inventory_item_id)
                        ],
                        ['confirm' => '削除しますか？', 'class' => 'btn btn-default']
                    ) ?></td>
                </tr>
                <?php $i ++ ; endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
