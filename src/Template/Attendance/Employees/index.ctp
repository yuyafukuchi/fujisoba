<?php
$this->append('heading', '<p>' . $data['name'] . '</p>');
$this->append('breadcrumbs', sprintf('<p>%s＞従業員マスタ検索</p>',
    $this->Html->link('トップ', ['controller' => 'Users', 'action' => 'attendance', 'prefix' => false])
));
?>

<div class="row" style="margin: 20px;">
    <?= $this->Form->create() ?>
        <div class="col-sm-5">
            <div class="row">
                <div class="col-md-4 control-label text-right">従業員コード</div>
                <div class="col-md-8">
                    <?= $this->Form->input("code", [
                        "type" => "text",
                        "label" => false,
                        'class' => 'input-lg',
                    ]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 control-label text-right">従業員名</div>
                <div class="col-md-8">
                    <?= $this->Form->input("name", [
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
                            'default' => !empty($currentUser['company_id']) ? $currentUser['company_id'] : null,
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
                            'default' => !empty($currentUser['store_id']) ? $currentUser['store_id'] : null,
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
                            'default' => !empty($currentUser['company_id']) ? $currentUser['company_id'] : null,
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
            <?= $this->Form->hidden('is_search', ['value' => 1]) ?>
            <?= $this->Form->submit("検索", ['type' => 'submit', 'class' => 'btn btn-default btn-lg']) ?>
        </div>
    <?= $this->Form->end() ?>
</div>

<?php if ($isSearch): ?>
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
                 foreach ($employees as $key => $employee): ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td><?= h($employee->code) ?></td>
                <td>
                    <?= $this->Html->link(h($employee->name_last.' '.$employee->name_first), ['action' => 'edit', $employee->id])?>
                    <?php if (!empty($employee->retired) && time() >= strtotime($employee->retired->format('Y-m-d'))): ?>
                        <span class="text-danger">(退職)</span>
                    <?php endif; ?>
                </td>
                <td><?= $employee->has('company') ? h($employee->company->name) : '' ?></td>
                <td><?= $employee->has('store') ? h($employee->store->name) : '' ?></td>
                <td><?= h($employee->contact_type) ?></td>
                <td><?= h($employee->note) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<div class="row" style="margin: 0;">
    <div class="col-xs-12">
        <p class="pull-right">
            <?= $this->Html->link('新規', ['controller'=>'Employees', 'action'=>'add'], ['class' => 'btn btn-default btn-md add-link', 'style' => 'margin-right: 15px;']) ?>
            <?= $this->Html->link('戻る', ['controller'=>'Users', 'action'=>'attendance', 'prefix' => false], ['class' => 'btn btn-default btn-md return-link hidden']) ?>
        </p>

        <?php if ($isSearch): ?>
            <p>
                <span class="inline-block">並び順は店舗カナ名、従業員コード順</span>
                <span class="inline-block text-primary">検索結果は<?= count($employees) ?>件です</span>
            </p>
        <?php endif; ?>
    </div>
</div>

<style>
    .inline-block {
        display: inline-block;
        margin-right: 15px;
    }
    .inline-block label {
        font-weight: normal !important;
    }
</style>
