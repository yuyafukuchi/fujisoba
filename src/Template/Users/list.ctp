<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Cash Account Tran'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stores'), ['controller' => 'Stores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Store'), ['controller' => 'Stores', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Accounts'), ['controller' => 'Accounts', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Account'), ['controller' => 'Accounts', 'action' => 'add']) ?></li>
        <li class="heading"><?='マスタ設定' ?></li>
        <li><?= $this->Html->link('ユーザパスワード設定', ['action' => 'list']) ?></li>
    </ul>
</nav>
<div class="cashAccountTrans form large-9 medium-8 columns content">
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th>ユーザ</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
            <tr>
                <th><?=h($user->name) ?></th>
                <th><?=$this->Html->link('変更', ['action' => 'edit', $user->id]) ?></th>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>