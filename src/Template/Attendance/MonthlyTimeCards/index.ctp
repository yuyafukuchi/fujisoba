<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MonthlyTimeCard[]|\Cake\Collection\CollectionInterface $monthlyTimeCards
 */
?>

<div class="monthlyTimeCards index large-9 medium-8 columns content">
<?=$data['name']?>
<?=$this->Html->link('ログアウト', ['controller'=>'/../Users', 'action'=>'logout'])?>
<?php 
echo $this -> Form -> create (null);
echo '該当年月';
echo $this -> Form -> input (
     "date", [ "label" => "",
                      "type" => "datetime",
                      "dateformat" => "YM",
                      "monthNames" => false,
                      "separator" => "/",
                      "templates" => [ "dateWidget" => '{{year}} 年 {{month}} 月' ],
                      "minYear" => date ( "Y" ) - 70,
                      "maxYear" => date ( "Y" ) - 18,
                      "default" => date ( "Y-m" ),
                      "empty" => [ "year" => "年", "month" => "月"] ] );

echo $this -> Form -> label ( "invalid", "勤務データ不備あり" );
echo $this -> Form -> checkbox ( "invalid", [ "id" => "invalid",
                                            "value" => "1" ] );
echo $this -> Form -> label ( "printed", "未印刷" );
echo $this -> Form -> checkbox ( "printed", [ "id" => "printed",
                                            "value" => "1" ] );
echo $this -> Form -> label ( "approved", "未承認" );
echo $this -> Form -> checkbox ( "approved", [ "id" => "approved",
                                            "value" => "1" ] );
echo $this -> Form -> label ( "csv_exported", "CSV未出力" );
echo $this -> Form -> checkbox ( "csv_exported", [ "id" => "csv_exported",
                                            "value" => "1" ] );
echo $this -> Form -> label ( "unmatch", "予定と実績が異なる" );
echo $this -> Form -> checkbox ( "unmatch", [ "id" => "unmatch",
                                            "value" => "1" ] );
echo $this -> Form -> input ( "code", [ "type" => "text",
                                           "size" => 10,
                                           "label" => "従業員コード",
                                           "default" => "" ]  );
echo $this -> Form -> input ( "name", [ "type" => "text",
                                           "size" => 10,
                                           "label" => "従業員名",
                                           "default" => "" ]  );          
if($data['type']==='M'){
                echo $this->Form->input('company_id', ['options' => $companies, "label" => '会社名']);
                echo $this->Form->input('store_id', ['options' => $stores,"label" => '店舗名']);
            }else{
                echo $this->Form->input('company_id', ['options' => $companies,'empty' => true, "label" => '会社名']);
                echo $this->Form->input('store_id', ['options' => $stores, 'empty' => true,"label" => '店舗名']);
            }
echo $this -> Form -> input ( "retired", [ "type" => "checkbox",
                                         "value" => "1",
                                         "label" => "退職者も表示" ] );
                                         
echo $this -> Form -> submit ( "検索",['type' => 'submit']);
echo $this -> Form -> end ();?>
    <h3><?= __('Monthly Time Cards') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
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
                <td><?= $monthlyTimeCard->has('employee') ? $this->Html->link(h($monthlyTimeCard->employee->name_last.' '.$monthlyTimeCard->employee->name_first), [ 'action' => 'view', $i]) : ''?></td>
                <td><?= $monthlyTimeCard->has('employee') ? h($monthlyTimeCard->employee->company->name): '' ?></td>
                <td><?= $monthlyTimeCard->has('employee') ? h($monthlyTimeCard->employee->store->name): '' ?></td>
                <td><?= $monthlyTimeCard->has('employee') ? h($monthlyTimeCard->employee->contact_type.$monthlyTimeCard->employee->retired): '' ?></td>
                <td><?= ($monthlyTimeCard->printed ? '印刷':'').' '.($monthlyTimeCard->approved ? '承認' : '').' '.($monthlyTimeCard->csv_exported ? 'CSV' : '') ?></td>
                <td><?= '' ?></td>
            </tr>
            <?php $i++; endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
