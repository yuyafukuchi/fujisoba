<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CashAccountTran[]|\Cake\Collection\CollectionInterface $cashAccountTrans
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading">富士そば</li>
        <li class="heading"><?=h($data['name']) ?></li>
        <?php if($data['type'] === 'H') : ?> <!-- 本社管理者 -->
        <li class="heading">売上日計表</li>
            <?php foreach ($stores as $store) : ?>
            <li><?= $this->Html->link($store->name, ['controller' => 'Sales/SalesTransactions','action' => 'view', 'store' => $store->id]) ?></li>
            <?php endforeach; ?>



        <li class="heading">売上一覧表</li>
             <li><?= $this->Html->link('売上集計表', ['controller' => 'Sales/SalesTransactions', 'action' => 'all']) ?></li>
            <?php foreach ($stores as $store) : ?>
            <li><?= $this->Html->link($store->name, ['controller' => 'Sales/SalesTransactions', 'action' => 'view', 'store' => $store->id]) ?></li>
            <?php endforeach; ?>
        <li class="heading"> 在庫日計表一覧</li>
            <?php foreach ($stores as $store) : ?>
            <li><?= $this->Html->link($store->name, ['controller' => 'Sales/InventoryPurchaseTransactions','action' => 'monthly', 'store' => $store->id]) ?></li>
            <?php endforeach; ?>
        <li class="heading"> 出庫日計表一覧</li>
            <?php foreach ($stores as $store) : ?>
            <li><?= $this->Html->link($store->name, ['controller' => 'Sales/SalesItemTransactions','action' => 'index', 'store' => $store->id]) ?></li>
            <?php endforeach; ?>
        <li class="heading"> 現金出納表一覧</li>
            <?php foreach ($stores as $store) : ?>
            <li><?= $this->Html->link($store->name, ['controller' => 'Sales/CashAccountTrans', 'action' => 'index', 'store' => $store->id]) ?></li>
            <?php endforeach; ?>
        <li class="heading">マスタ設定</li>
        <li><?= $this->Html->link('マスタメニュー設定', ['controller' => 'Sales/MenuHistories','action' => 'index']) ?></li>
        <li><?= $this->Html->link('出庫アイテム割付', ['controller' => 'Sales/SalesItemAssignHistories','action' => 'index']) ?></li>
        <li><?= $this->Html->link('マスタ在庫アイテム設定', ['controller' => 'Sales/InventoryItemHistories','action' => 'index']) ?></li>
        <li><?= $this->Html->link('マスタ出庫アイテム設定', ['controller' => 'Sales/SalesItemHistories','action' => 'index']) ?></li>
        <li class="heading"><?='店舗別' ?></li>
        <?php foreach ($stores as $store) : ?>
        <li class="heading"><?=$store->name ?></li>
        <li><?= $this->Html->link('在庫計算アイテム設定', ['controller' => 'Sales/StoreInventoryItemHistories','action' => 'index', 'store' => $store->id]) ?></li>
        <li><?= $this->Html->link('店舗メニュー設定', ['controller' => 'Sales/StoreMenuHistories','action' => 'index', 'store' => $store->id]) ?></li>
        <?php endforeach; ?>
        <li></li>
        <li><?= $this->Html->link('ユーザパスワード設定', ['action' => 'list']) ?></li>

        <?php elseif($data['type'] === 'M') : ?> <!--店舗管理者 -->
        <li class="heading">店舗作業</li>
        <li><?= $this->Html->link('仕入在庫入力', ['controller' => 'Sales/InventoryPurchaseTransactions', 'action' => 'index', 'store' => $storeId]) ?></li>
        <li><?= $this->Html->link('現金出納入力', ['controller' => 'Sales/CashAccountTrans', 'action' => 'add', 'store' => $storeId]) ?></li>
        <li><?= $this->Html->link('在庫日計表', ['controller' => 'Sales/InventoryPurchaseTransactions', 'action' => 'monthly', 'store' => $storeId]) ?></li>
        <li><?= $this->Html->link('出庫日計表', ['controller' => 'Sales/SalesItemTransactions', 'action' => 'index', 'store' => $storeId]) ?></li>
        <li><?= $this->Html->link('現金出納表', ['controller' => 'Sales/CashAccountTrans', 'action' => 'index', 'store' => $storeId]) ?></li>
        <li><?= $this->Html->link('売上日計表', ['controller' => 'Sales/SalesTransactions', 'action' => 'view', 'store' => $storeId]) ?></li>
        <?php endif ; ?>
    </ul>
</nav>

</div>
