<?php
$this->append('heading', '<p>' . $data['name'] . '</p>');
$this->append('breadcrumbs', '<p>トップ＞勤怠データ検索・一覧</p>');
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
                        "minYear" => date("Y" ) - 70,
                        "maxYear" => date("Y" ) - 18,
                        "default" => date("Y-m" ),
                        "empty" => true
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
            <span class="inline-block">
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
                    <?php if ($data['type']==='M'): ?>
                        <?= $this->Form->input('company_id', ['options' => $companies, "label" => false]) ?>
                    <?php else: ?>
                        <?= $this->Form->input('company_id', ['options' => $companies,'empty' => true, "label" => false]) ?>
                    <?php endif; ?>
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
            <?= $this->Form->submit("検索", ['type' => 'submit', 'class' => 'btn btn-default btn-lg']) ?>
        </div>
    </div>
<?= $this->Form->end() ?>

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
            <?php $i = 1; foreach ($monthlyTimeCards as $monthlyTimeCard): ?>
            <tr>
                <td><?= h($i) ?></td>
                <td><?= $monthlyTimeCard->has('employee') ? h($monthlyTimeCard->employee->code) : '' ?></td>
                <td><?= $monthlyTimeCard->has('employee') ? $this->Html->link(h($monthlyTimeCard->employee->name_last.' '.$monthlyTimeCard->employee->name_first), ['action' => 'view', $i]) : ''?></td>
                <td><?= $monthlyTimeCard->has('employee') ? h($monthlyTimeCard->employee->company->name): '' ?></td>
                <td><?= $monthlyTimeCard->has('employee') ? h($monthlyTimeCard->employee->store->name): '' ?></td>
                <td><?= $monthlyTimeCard->has('employee') ? h($monthlyTimeCard->employee->contact_type.$monthlyTimeCard->employee->retired): '' ?></td>
                <td><?=($monthlyTimeCard->printed ? '印刷':'').' '.($monthlyTimeCard->approved ? '承認' : '').' '.($monthlyTimeCard->csv_exported ? 'CSV' : '') ?></td>
                <td><?= '' ?></td>
            </tr>
            <?php $i++; endforeach; ?>
        </tbody>
    </table>
</div>

<div class="row" style="margin: 0;">
    <div class="col-xs-12">
        <p class="pull-right">
        <?= $this->Html->link('一括印刷', ['controller'=>'Employees', 'action'=>'add'], ['class' => 'btn btn-default btn-md add-link disabled', 'style' => 'margin-right: 15px;']) ?>
        <?= $this->Html->link('CSV', ['controller'=>'Employees', 'action'=>'add'], ['class' => 'btn btn-default btn-md add-link disabled', 'style' => 'margin-right: 15px;']) ?>
        <?= $this->Html->link('戻る', ['controller'=>'Users', 'action'=>'attendance', 'prefix' => false], ['class' => 'btn btn-default btn-md return-link']) ?>
        </p>

        <p>
            <span class="inline-block">並び順は店舗カナ名、従業員コード順</span>
            <span class="inline-block text-primary">検索結果は<?= count($monthlyTimeCards) ?>件です</span>
            <span class="inline-block"><?= $this->Html->link('人件費計算', ['controller'=>'Employees', 'action'=>'add'], ['class' => 'btn btn-default btn-md disabled']) ?></span>
            <span class="inline-block text-primary">予定: <?= '1,500,000' ?>円</span>
            <span class="inline-block text-primary">実績: <?= '1,580,000' ?>円</span>
        </p>
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
