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
<div class="employees index large-9 medium-8 columns content">
    <h3><?= __('Employees') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name_last') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name_first') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name_last_kana') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name_first_kana') ?></th>
                <th scope="col"><?= $this->Paginator->sort('company_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('store_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('contact_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('joined') ?></th>
                <th scope="col"><?= $this->Paginator->sort('retired') ?></th>
                <th scope="col"><?= $this->Paginator->sort('deleted') ?></th>
                <th scope="col"><?= $this->Paginator->sort('flag') ?></th>
                <th scope="col"><?= $this->Paginator->sort('regular_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('midnight_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('other1_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('other2_amount') ?></th>
                <th scope="col"><?= $this->Paginator->sort('employee_shift') ?></th>
                <th scope="col"><?= $this->Paginator->sort('othershift_start') ?></th>
                <th scope="col"><?= $this->Paginator->sort('othershift_end') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created_by') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified_by') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $employee): ?>
            <tr>
                <td><?= $this->Number->format($employee->id) ?></td>
                <td><?= h($employee->code) ?></td>
                <td><?= h($employee->name_last) ?></td>
                <td><?= h($employee->name_first) ?></td>
                <td><?= h($employee->name_last_kana) ?></td>
                <td><?= h($employee->name_first_kana) ?></td>
                <td><?= $employee->has('company') ? $this->Html->link($employee->company->name, ['controller' => 'Companies', 'action' => 'view', $employee->company->id]) : '' ?></td>
                <td><?= $employee->has('store') ? $this->Html->link($employee->store->name, ['controller' => 'Stores', 'action' => 'view', $employee->store->id]) : '' ?></td>
                <td><?= h($employee->contact_type) ?></td>
                <td><?= h($employee->joined) ?></td>
                <td><?= h($employee->retired) ?></td>
                <td><?= h($employee->deleted) ?></td>
                <td><?= h($employee->flag) ?></td>
                <td><?= $this->Number->format($employee->regular_amount) ?></td>
                <td><?= $this->Number->format($employee->midnight_amount) ?></td>
                <td><?= $this->Number->format($employee->other1_amount) ?></td>
                <td><?= $this->Number->format($employee->other2_amount) ?></td>
                <td><?= h($employee->employee_shift) ?></td>
                <td><?= $this->Number->format($employee->othershift_start) ?></td>
                <td><?= $this->Number->format($employee->othershift_end) ?></td>
                <td><?= h($employee->created) ?></td>
                <td><?= $this->Number->format($employee->created_by) ?></td>
                <td><?= h($employee->modified) ?></td>
                <td><?= $this->Number->format($employee->modified_by) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $employee->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $employee->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $employee->id], ['confirm' => __('Are you sure you want to delete # {0}?', $employee->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php
    echo $this->Html->link('新規', ['controller'=>'Employees', 'action'=>'add']);
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
