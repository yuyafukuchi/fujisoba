<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\StoreMenuHistory[]|\Cake\Collection\CollectionInterface $storeMenuHistories
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Store Menu History'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stores'), ['controller' => 'Stores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Store'), ['controller' => 'Stores', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="storeMenuHistories index large-9 medium-8 columns content">
    <h3><?= __('Store Menu Histories') ?></h3>
    <?= $storeName ?> 店舗メニュー設定 <br>
    <?=date('Y年m月d日',$date).'以降の設定'?>
    <?=$this->Form->create(null) ?>
    <?= $this->Form->control('date',['label' => '設定日','rows'=>1,'type'=>'text'])?>
    <?= $this->Form->submit("設定",['name'=>'button']) ?>
    <?=$this->Form->end() ?>
    マスタメニュー
    <table cellpadding="0" cellspacing="0">
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
    店舗メニュー
    <table cellpadding="0" cellspacing="0">
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
            <tr>
                <td><?= h($storeMenuHistory->menu_history->name) ?></td>
                <td><?= $this->Number->format($storeMenuHistory->id) ?></td>
                <?=$this->Form->create('StoreMenuHistories'.$storeMenuHistory->id,['url' => ['action' => 'edit','store' => $storeId, $storeMenuHistory->id]]) ?>
                <td><?= $this->Form->control('store_menu_num',['label' => '','rows'=>1,'type'=>'number', 'step'=>0.1, 'default' => intval($storeMenuHistory->store_menu_number)])?></td>
                <td><?= $this->Form->control('price',['label' => '','rows'=>1,'type'=>'number', 'default' => intval($storeMenuHistory->price)])?></td>
                <td><?=  $this -> Form -> input ( "vm1", [ "type" => "checkbox","value" => "1","label" => "" ,'checked' => $storeMenuHistory->vending_mashine1, 'default' => 0 ]);?></td>
                <td><?=  $this -> Form -> input ( "vm2", [ "type" => "checkbox","value" => "1","label" => "" ,'checked' => $storeMenuHistory->vending_mashine2, 'default' => 0 ]);?></td>
                <td><?= h($storeMenuHistory->menu_history->sales_item_assign_history->sales_item->sales_item_number) ?></td>
                <td><?= h($storeMenuHistory->menu_history->sales_item_assign_history->sales_item->sales_item_histories[0]->sales_item_name) ?></td>
                <td><?= $this->Form->control('sales_item_price',['label' => '','rows'=>1,'type'=>'number', 'default' => intval($storeMenuHistory->sales_item_price)])?></td>
                <td><?= $this->Form->control('sales_item_cost',['label' => '','rows'=>1,'type'=>'number', 'default' => intval($storeMenuHistory->sales_item_cost)])?></td>
                <td><?= h($storeMenuHistory->modified->i18nFormat('YYYY/MM/dd')) ?></td>
                <td><?= $this->Form->submit("登録",['name'=>'button']) ?></td>
                <?=$this->Form->end() ?>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $storeMenuHistory->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $storeMenuHistory->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $storeMenuHistory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $storeMenuHistory->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
