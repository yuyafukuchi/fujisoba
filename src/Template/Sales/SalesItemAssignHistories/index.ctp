<header class="row">
    <div class="col-sm-12">
        <h2><?= $data['name']?>　出庫アイテム割付　<span class="text-red"><?= date('Y年m月d日',$date) ?>以降の設定</span></h2>
    </div>
</header>

<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">メニュー品名・単価</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($menuHistories as $menuHistory): ?>
            <?=$this->Form->create('MenuHistories'.$menuHistory->id, ['url' => ['action' => 'edit', 'menu_item_id' => intval($menuHistory->menu_item_id)]]) ?>
            <tr>
                <!--<td><?= h($menuHistory->menu_history->name . ' : ' . $menuHistory->price) ?><?= $this->Form->submit('登録',['name'=>'button']) ?></td>-->
                <th>
                    <?= h($menuHistory->name) ?>
                    <?= $this->Form->submit('登録', ['name'=>'button']) ?>
                </th>
            </tr>
            <tr>
                <td>
                    <?php foreach ($salesItemHistories as $salesItemHistory) : ?>
                        <?=  $this->Form->input('check-'.$menuHistory->id.'-'.$salesItemHistory->id, [
                            'type' => 'checkbox',
                            'value' => $salesItemHistory->sales_item_id,
                            'label' => $salesItemHistory->sales_item->sales_item_number . ' : ' . $salesItemHistory->sales_item_name,
                            'hiddenField' => false,
                            'checked' => array_key_exists($menuHistory->menu_item_id, $assignArray) ? in_array($salesItemHistory->sales_item_id,$assignArray[$menuHistory->menu_item_id]) : false
                        ]); ?>
                    <?php endforeach; ?>
                </td>
            </tr>
            <?=$this->Form->end() ?>
        <?php endforeach; ?>
    </tbody>
</table>
