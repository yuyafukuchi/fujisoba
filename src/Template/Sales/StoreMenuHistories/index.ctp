<header class="row">
    <div class="col-sm-8">
        <h2> <?=$storeName ?>　店舗メニュー設定　<span class="text-red"><?= date('Y年m月d日',$date) ?>以降の設定</span></h2>
    </div>
    <div class="col-sm-4">
        <?= $this->Form->create(null, ['class' => 'form-inline pull-right'])?>
        <?= $this->Form->input('date', ['label' => '設定日: ', 'type'=>'text', 'class' => 'datepicker', 'default' => date('Y-m-d', $date)])?>
        <div style="display: inline-block;"><?= $this->Form->submit('設定', ['name' => 'button']) ?></div>
        <?= $this->Form->end()?>
    </div>
</header>

<div class="row">
    <div class="col-sm-3">
        <table class="table table-bordered form-inline">
            <caption>マスタメニュー</caption>
            <thead>
                <tr>
                    <th scope="col">番号</th>
                    <th scope="col">品名</th>
                    <th scope="col">追加</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($menuHistories as $menuHistory): ?>
                <tr>
                    <td><?= h($menuHistory->menu->menu_number) ?></td>
                    <td><?= h($menuHistory->name) ?></td>
                    <td><?= in_array($menuHistory->menu_item_id,$idArray,true) ? h(''):
                    $this->Form->postLink('>', ['action' => 'add', 'item' => $menuHistory->menu_item_id, 'store' => $storeId, ]) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="col-sm-9">
        <table class="table table-bordered form-inline">
            <caption>店舗メニュー</caption>
            <thead>
                <tr>
                    <th scope="col">品名</th>
                    <th scope="col">マスタメニュー番号</th>
                    <th scope="col">店舗メニュー番号</th>
                    <th scope="col">価格</th>
                    <th scope="col">一号機</th>
                    <th scope="col">二号機</th>
                    <th scope="col">出庫アイテム番号</th>
                    <th scope="col">出庫アイテム名</th>
                    <th scope="col">出庫計算金額</th>
                    <th scope="col">原価</th>
                    <th scope="col">更新日</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($storeMenuHistories as $storeMenuHistory): ?>
                <?=$this->Form->create('StoreMenuHistories',['url' => ['action' => 'edit','store' => $storeId, 'menu_item_id' => intval($storeMenuHistory->menu_item_id), $storeMenuHistory->id]]) ?>
                <tr>
                    <td><?= h($storeMenuHistory->menu_history->name) ?></td>
                    <td><?= h($storeMenuHistory->menu->menu_number) ?></td>
                    <td class="green"><?= $this->Form->control('store_menu_number',['label' => false,'rows'=>1,'type'=>'number', 'step'=>0.1, 'default' => intval($storeMenuHistory->store_menu_number)])?></td>
                    <td class="green"><?= $this->Form->control('price',['label' => false,'rows'=>1,'type'=>'number', 'default' => intval($storeMenuHistory->price)])?></td>
                    <td class="green text-center"><?=  $this->Form->input("vm1", ["type" => "checkbox","value" => "1","label" => false ,'checked' => $storeMenuHistory->vending_mashine1, 'default' => 0 ]);?></td>
                    <td class="green text-center"><?=  $this->Form->input("vm2", ["type" => "checkbox","value" => "1","label" => false ,'checked' => $storeMenuHistory->vending_mashine2, 'default' => 0 ]);?></td>
                    <td><?= h($storeMenuHistory->menu_history->sales_item_assign_history->sales_item->sales_item_number) ?></td>
                    <td><?= h($storeMenuHistory->menu_history->sales_item_assign_history->sales_item->sales_item_histories[0]->sales_item_name) ?></td>
                    <td class="green"><?= $this->Form->control('sales_item_price',['label' => false,'rows'=>1,'type'=>'number', 'default' => intval($storeMenuHistory->sales_item_price)])?></td>
                    <td class="green"><?= $this->Form->control('sales_item_cost',['label' => false,'rows'=>1,'type'=>'number', 'default' => intval($storeMenuHistory->sales_item_cost)])?></td>
                    <td class="green"><?= h($storeMenuHistory->modified->i18nFormat('YYYY/MM/dd')) ?></td>
                    <td><?= $this->Form->submit("登録", ['name'=>'button', 'class' => 'btn btn-default btn-xs',]) ?></td>
                    <?=$this->Form->end() ?>
                    <td class="actions">
                        <?= $this->Html->link('削除',
                            [
                                'action' => 'delete',
                                $storeMenuHistory->id,
                                'store' => $storeId,
                                'menu_item_id' => intval($storeMenuHistory->menu_item_id)
                            ],
                            [
                                'class' => 'btn btn-default btn-xs',
                                'onClick' => 'return confirm("削除してよろしいですか？")',
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
