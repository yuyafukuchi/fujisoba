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
        <?php if ($data['type'] === 'H') : ?> <!-- 本社管理者 -->
        <li class="heading">売上日計表</li>
        <li class="heading">売上一覧表</li>
        <li class="heading"><?='マスタ設定' ?></li>
        <li><?= $this->Html->link('マスタ在庫アイテム設定', ['controller' => 'Sales/InventoryItemHistories','action' => 'index']) ?></li>
        <li><?= $this->Html->link('在庫計算アイテム設定', ['controller' => 'Sales/StoreInventoryItemHistories','action' => 'index', 'store' => 1]) ?></li>
        <li><?= $this->Html->link('ユーザパスワード設定', ['action' => 'list']) ?></li>
        <?php elseif($data['type'] === 'M') : ?> <!--店舗管理者 -->
        <li class="heading">店舗作業</li>
        <li><?= $this->Html->link('仕入在庫入力', ['controller' => 'Sales/InventoryPurchaseTransactions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link('現金出納入力', ['controller' => 'Sales/CashAccountTrans', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link('在庫日計表', ['controller' => 'Sales/InventoryPurchaseTransactions', 'action' => 'monthly', 'store' => $storeId]) ?></li>
        <li><?= $this->Html->link('現金出納表', ['controller' => 'Sales/CashAccountTrans', 'action' => 'index']) ?></li>
        <?php endif ; ?>
        <li><?= $this->Html->link(__('New Cash Account Tran'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stores'), ['controller' => 'Stores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Store'), ['controller' => 'Stores', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Accounts'), ['controller' => 'Accounts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Account'), ['controller' => 'Accounts', 'action' => 'add']) ?></li>
    </ul>
</nav>

</div>
