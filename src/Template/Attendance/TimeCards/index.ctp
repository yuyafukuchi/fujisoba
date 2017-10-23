<?php
/**
  * @var \App\View\AppView $this
  */
?>
<?php 
echo $this -> Form -> create (
                "null", [ "type" => "post",
                          "url" => [ "controller" => "filename",
                                     "action" => "index" ] ] );
echo $this -> Form -> input ( "user", [ "type" => "text",
                                           "size" => 10,
                                           "label" => "従業員コード",
                                           "default" => "" ]  );
echo $this -> Form -> input ( "user", [ "type" => "text",
                                           "size" => 10,
                                           "label" => "従業員名",
                                           "default" => "" ]  );  
echo $this -> Form -> input ( "check", [ "type" => "checkbox",
                                         "value" => "check2",
                                         "label" => "勤怠データ不備あり" ] );
echo $this -> Form -> input ( "check", [ "type" => "checkbox",
                                         "value" => "check2",
                                         "label" => "未印刷" ] );
echo $this -> Form -> input ( "check", [ "type" => "checkbox",
                                         "value" => "check2",
                                         "label" => "未承認" ] );
echo $this -> Form -> input ( "check", [ "type" => "checkbox",
                                         "value" => "check2",
                                         "label" => "csv未出力" ] );
echo $this -> Form -> input ( "check", [ "type" => "checkbox",
                                         "value" => "check2",
                                         "label" => "予定と実績が異なる" ] );
echo $this -> Form -> input  ( "select3",
                                 [ "type" => "select",
                                   "options" => [ "one" => "ダイタン企画株式会社" ], 
                                   "label" => '会社名'] );
echo $this -> Form -> input  ( "select3",
                                 [ "type" => "select",
                                   "options" => [ "one" => "" ], 
                                   "label" => '店舗名'] );
echo $this -> Form -> input ( "check", [ "type" => "checkbox",
                                         "value" => "check2",
                                         "label" => "退職者も表示" ] );
echo $this -> Form -> submit ( "検索");
echo $this -> Form -> end ();
?>
<div class="timeCards index large-9 medium-8 columns content">
    <h3><?= __('Time Cards') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('employee_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('store_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('in_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('out_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('in_time2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('out_time2') ?></th>
                <th scope="col"><?= $this->Paginator->sort('schedules_in_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('scheduled_out_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('work_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('over_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('paid_vacation') ?></th>
                <th scope="col"><?= $this->Paginator->sort('paid_vacation_start_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('paid_vacation_end_time') ?></th>
                <th scope="col"><?= $this->Paginator->sort('attendance_store_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified_by') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($timeCards as $timeCard): ?>
            <tr>
                <td><?= $this->Number->format($timeCard->id) ?></td>
                <td><?= $timeCard->has('employee') ? $this->Html->link($timeCard->employee->id, ['controller' => 'Employees', 'action' => 'view', $timeCard->employee->id]) : '' ?></td>
                <td><?= $timeCard->has('store') ? $this->Html->link($timeCard->store->name, ['controller' => 'Stores', 'action' => 'view', $timeCard->store->id]) : '' ?></td>
                <td><?= h($timeCard->date) ?></td>
                <td><?= h($timeCard->in_time) ?></td>
                <td><?= h($timeCard->out_time) ?></td>
                <td><?= h($timeCard->in_time2) ?></td>
                <td><?= h($timeCard->out_time2) ?></td>
                <td><?= h($timeCard->schedules_in_time) ?></td>
                <td><?= h($timeCard->scheduled_out_time) ?></td>
                <td><?= $this->Number->format($timeCard->work_time) ?></td>
                <td><?= $this->Number->format($timeCard->over_time) ?></td>
                <td><?= $this->Number->format($timeCard->paid_vacation) ?></td>
                <td><?= $this->Number->format($timeCard->paid_vacation_start_time) ?></td>
                <td><?= $this->Number->format($timeCard->paid_vacation_end_time) ?></td>
                <td><?= $this->Number->format($timeCard->attendance_store_id) ?></td>
                <td><?= h($timeCard->created) ?></td>
                <td><?= $this->Number->format($timeCard->created_by) ?></td>
                <td><?= h($timeCard->modified) ?></td>
                <td><?= $this->Number->format($timeCard->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $timeCard->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $timeCard->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $timeCard->id], ['confirm' => __('Are you sure you want to delete # {0}?', $timeCard->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php
        echo $this->Html->link('一括印刷', ['controller'=>'Users', 'action'=>'login']);
        ?> <br> <?php
        echo $this->Html->link('CSV', ['controller'=>'Users', 'action'=>'attendance']);
        ?> <br> <?php
        echo $this->Html->link('戻る', ['controller'=>'Users', 'action'=>'attendance']);
    ?>
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
