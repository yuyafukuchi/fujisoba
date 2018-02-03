<header class="row">
    <div class="col-sm-8">
        <h2><?= $data['name']?>　売上日計表　<?= date('Y年m月d日', $date) ?></h2>
    </div>
    <div class="col-sm-4">
        <?= $this->Form->create(null, ['class' => 'form-inline pull-right'])?>
        <?= $this->Form->input('date', ['label' => '設定日: ', 'type'=>'text', 'class' => 'datepicker', 'default' => date('Y-m-d', $date)])?>
        <div style="display: inline-block;"><?= $this->Form->submit('設定', ['name' => 'button']) ?></div>
        <?= $this->Form->end()?>
    </div>
</header>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>店舗</th>
            <th>+-</th>
            <th>総売上</th>
            <th>パスモ</th>
            <th>現金出納</th>
            <th>早番</th>
            <th>中番</th>
            <th>遅番</th>
            <th>預金高</th>
            <th>備考</th>
            <th>ロス額</th>
            <th>原価</th>
            <th>1号機</th>
            <th>2号機</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($salesTransactions as $salesTransaction): ?>
        <tr>
            <td><?= $salesTransaction->has('store') ? $this->Html->link($salesTransaction->store->name, ['controller' => 'Stores', 'action' => 'view', $salesTransaction->store->id]) : '' ?></td>
            <td><?= h($salesTransaction->transaction_date) ?></td>
            <td><?= $salesTransaction->has('menu') ? $this->Html->link($salesTransaction->menu->id, ['controller' => 'Menus', 'action' => 'view', $salesTransaction->menu->id]) : '' ?></td>
            <td><?= $this->Number->format($salesTransaction->menu_number) ?></td>
            <td><?= h($salesTransaction->menu_name) ?></td>
            <td><?= $this->Number->format($salesTransaction->qty) ?></td>
            <td><?= $this->Number->format($salesTransaction->cash_sales_amount) ?></td>
            <td><?= $this->Number->format($salesTransaction->pasmo_sales_amount) ?></td>
            <td><?= $this->Number->format($salesTransaction->sales_amount) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
