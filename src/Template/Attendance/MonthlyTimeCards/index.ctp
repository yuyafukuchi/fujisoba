<?php
$this->append('heading', '<p>' . $data['name'] . '</p>');
$this->append('breadcrumbs', sprintf('<p>%s＞勤怠データ検索・一覧</p>',
    $this->Html->link('トップ', ['controller' => 'Users', 'action' => 'attendance', 'prefix' => false])
));
?>

<?= $this->Form->create(null) ?>
    <div class="row" style="margin: 20px;">
        <div class="col-sm-5">
            <div class="row">
                <div class="col-md-4"><label>該当年月</label></div>
                <div class="col-md-8 form-inline">
                    <?= $this->Form->input("date", [
                        "label" => false,
                        "type" => "datetime",
                        "dateformat" => "YM",
                        "monthNames" => false,
                        "separator" => "/",
                        "templates" => [ "dateWidget" => '{{year}} 年 {{month}} 月' ],
                        "minYear" => date("Y") - 70,
                        "maxYear" => date("Y") - 18,
                        "default" => date("Y-m"),
                        "empty" => false,
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="col-sm-7">
            <span class="inline-block">
                <?= $this->Form->label("invalid", "勤務データ不備あり" ) ?>
                <?= $this->Form->checkbox("invalid", ["id" => "invalid", "value" => "1"]) ?>
            </span>
            <span class="inline-block">
                <?= $this->Form->label("printed", "未印刷" ) ?>
                <?= $this->Form->checkbox("printed", ["id" => "printed", "value" => "1"]) ?>
            </span>
            <span class="inline-block">
                <?= $this->Form->label("approved", "未承認" ) ?>
                <?= $this->Form->checkbox("approved", ["id" => "approved", "value" => "1"]) ?>
            </span>
            <span class="inline-block">
                <?= $this->Form->label("csv_exported", "CSV未出力", ['for' => 'csv_exported']) ?>
                <?= $this->Form->checkbox("csv_exported", ["id" => "csv_exported", "value" => "1"]) ?>
            </span>
            <span class="inline-block hidden">
                <?= $this->Form->label("unmatch", "予定と実績が異なる" ) ?>
                <?= $this->Form->checkbox("unmatch", ["id" => "unmatch", "value" => "1"]) ?>
            </span>
        </div>
    </div>
    <div class="row" style="margin: 20px;">
        <div class="col-sm-5">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-4"><label>従業員コード</label></div>
                <div class="col-md-8 form-inline">
                    <?= $this->Form->input("code", [
                        "type" => "text",
                        "label" => false,
                    ]) ?>
                </div>
            </div>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-4"><label>従業員名</label></div>
                <div class="col-md-8 form-inline">
                    <?= $this->Form->input("name", [
                        "type" => "text",
                        "label" => false,
                    ]) ?>
                </div>
            </div>
        </div>

        <div class="col-sm-5">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-4"><label>会社名</label></div>
                <div class="col-md-8 form-inline">
                        <?= $this->Form->input('company_id', [
                            'options' => $companies,
                            'empty' => true,
                            "label" => false,
                            'default' => !empty($currentUser['company_id']) ? $currentUser['company_id'] : null,
                        ]) ?>
                </div>
            </div>
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-4"><label>店舗名</label></div>
                <div class="col-md-8 form-inline">
                    <?php if ($data['type']==='M'): ?>
                        <?= $this->Form->input('store_id', ['options' => $stores,"label" => false]) ?>
                    <?php else: ?>
                        <?= $this->Form->input('store_id', ['options' => $stores, 'empty' => true, "label" => false]) ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-sm-2 text-left">
            <div>
                <?= $this->Form->input("retired", ["type" => "checkbox", "value" => "1", "label" => "退職者も表示"]) ?>
            </div>
            <?= $this->Form->hidden('is_search', ['value' => 1]) ?>
            <?= $this->Form->submit("検索", ['type' => 'submit', 'class' => 'btn btn-default btn-lg']) ?>
        </div>
    </div>
<?= $this->Form->end() ?>

<?php if ($isSearch): ?>
    <div class="row" style="margin: 20px;">
        <table class="table table-bordered">
            <thead>
                <tr class="active">
                    <th scope="col">NO</th>
                    <th scope="col">コード</th>
                    <th scope="col">氏名</th>
                    <th scope="col">会社名</th>
                    <th scope="col">店舗名</th>
                    <th scope="col">種別</th>
                    <th scope="col">ステータス</th>
                    <th scope="col">備考</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach ($employees as $employee): ?>
                    <?php
                    $retired = (!empty($employee->retired) && $employee->retired->format('Y-m-d') <= date('Y-m-d')) ? ' <span class="text-danger">(退職)</span>' : null;
                    ?>
                    <tr>
                        <td><?= h($i) ?></td>
                        <td><?= h($employee->code) ?></td>
                        <td><?= $this->Html->link(h($employee->name_last.' '.$employee->name_first) . $retired, ['action' => 'view', $i, 't' => $date], ['escape' => false]) ?></td>
                        <td><?= $employee->company->name ?></td>
                        <td><?= $employee->store->name ?></td>
                        <td><?php
                            switch ($employee->contact_type) {
                                case 'P': echo '正社員'; break;
                                case 'C': echo '契約社員'; break;
                                case 'A': echo 'アルバイト'; break;
                            }
                        ?></td>
                        <td><?= (!empty($employee->monthly_time_cards[0]->printed) ? '印刷':'').' '.(!empty($employee->monthly_time_cards[0]->approved) ? '承認' : '').' '.(!empty($employee->monthly_time_cards[0]->csv_exported) ? 'CSV' : '') ?></td>
                        <td><?= '' ?></td>
                    </tr>
                <?php $i++; endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<div class="row" style="margin: 0;">
    <div class="col-xs-12">
        <p class="pull-right">
            <?php if ($isSearch): ?>
                <?= $this->Html->link('一括印刷', ['controller'=>'Employees', 'action'=>'bulkPrint'], ['class' => 'btn btn-default btn-md add-link hidden', 'style' => 'margin-right: 15px;']) ?>
                <?= $this->Html->link('CSV', ['controller'=>'MonthlyTimeCards', 'action'=>'csv', '?' => $this->request->query], ['class' => 'btn btn-default btn-md add-link', 'style' => 'margin-right: 15px;']) ?>
            <?php endif; ?>
            <?= $this->Html->link('戻る', ['controller'=>'Users', 'action'=>'attendance', 'prefix' => false], ['class' => 'btn btn-default btn-md return-link hidden']) ?>
        </p>

        <?php if ($isSearch): ?>
            <p>
                <span class="inline-block">並び順は店舗カナ名、従業員コード順</span>
                <span class="inline-block text-primary">検索結果は<?= $employees->count() ?>件です</span>
                <span class="inline-block hidden"><?= $this->Html->link('人件費計算', ['controller'=>'Employees', 'action'=>'add'], ['class' => 'btn btn-default btn-md disabled']) ?></span>
                <span class="inline-block text-primary hidden">予定: <?= '1,500,000' ?>円</span>
                <span class="inline-block text-primary hidden">実績: <?= '1,580,000' ?>円</span>
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
