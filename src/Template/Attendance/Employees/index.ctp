<?php
$this->append('heading', '<p>' . $data['name'] . '</p>');
$this->append('breadcrumbs', '<p>トップ＞従業員マスタ検索</p>');
?>

<div class="row" style="margin: 20px;">
    <?= $this->Form->create(null) ?>
        <div class="col-sm-5">
            <div class="row">
                <div class="col-md-4 control-label text-right">従業員コード</div>
                <div class="col-md-8">
                    <?= $this->Form->input("employees_code", [
                        "type" => "text",
                        "label" => false,
                        'class' => 'input-lg',
                    ]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 control-label text-right">従業員名</div>
                <div class="col-md-8">
                    <?= $this->Form->input("employees_name", [
                        "type" => "text",
                        "label" => false,
                        'class' => 'input-lg',
                    ]) ?>
                </div>
            </div>
        </div>

        <div class="col-sm-5">
            <?php if ($data['type']==='M'): ?>
                <div class="row">
                    <div class="col-md-4 control-label text-right">会社名</div>
                    <div class="col-md-8">
                        <?= $this->Form->input("company_id", [
                            'options' => $companies,
                            'empty' => true,
                            "label" => false,
                            'class' => 'input-lg',
                        ]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 control-label text-right">店舗名</div>
                    <div class="col-md-8">
                        <?= $this->Form->input("store_id", [
                            'options' => $stores,
                            'empty' => true,
                            "label" => false,
                            'class' => 'input-lg',
                        ]) ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <div class="col-md-4 control-label text-right">会社名</div>
                    <div class="col-md-8">
                        <?= $this->Form->input("company_id", [
                            'options' => $companies,
                            'empty' => true,
                            "label" => false,
                            'class' => 'input-lg',
                        ]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 control-label text-right">店舗名</div>
                    <div class="col-md-8">
                        <?= $this->Form->input("store_id", [
                            'options' => $stores,
                            'empty' => true,
                            "label" => false,
                            'class' => 'input-lg',
                        ]) ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="col-sm-2 text-left">
            <div style="zoom: 1.5;">
                <?= $this->Form->input("retired", ["type" => "checkbox", "value" => "1", "label" => "退職者も表示"]) ?>
            </div>
            <?= $this->Form->submit("検索", ['type' => 'submit', 'class' => 'btn btn-default btn-lg']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>

<table class="table table-bordered">
    <thead>
        <tr class="active">
            <th scope="col" class="number">NO</th>
            <th scope="col"><?= $this->Paginator->sort('コード') ?></th>
            <th scope="col"><?= $this->Paginator->sort('氏名') ?></th>
            <th scope="col"><?= $this->Paginator->sort('会社名') ?></th>
            <th scope="col"><?= $this->Paginator->sort('店舗名') ?></th>
            <th scope="col"><?= $this->Paginator->sort('種別') ?></th>
            <th scope="col"><?= $this->Paginator->sort('備考') ?></th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;
             foreach ($employees as $employee): ?>
        <tr>
            <td><?= h($i) ?></td>
            <td><?= h($employee->code) ?></td>
            <td><?= $this->Html->link(h($employee->name_last.' '.$employee->name_first), ['action' => 'edit', $employee->id])?></td>
            <td><?= $employee->has('company') ? h($employee->company->name) : '' ?></td>
            <td><?= $employee->has('store') ? h($employee->store->name) : '' ?></td>
            <td><?= h($employee->contact_type.$employee->retired) ?></td>
            <td><?= h($employee->note) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="row" style="margin: 0;">
    <div class="col-xs-12">
        <p class="pull-right">
        <?= $this->Html->link('新規', ['controller'=>'Employees', 'action'=>'add'], ['class' => 'btn btn-default btn-md add-link', 'style' => 'margin-right: 15px;']) ?>
        <?= $this->Html->link('戻る', ['controller'=>'Users', 'action'=>'attendance', 'prefix' => false], ['class' => 'btn btn-default btn-md return-link']) ?>
        </p>

        <p>並び順は店舗カナ名、従業員コード順</p>
    </div>
</div>
