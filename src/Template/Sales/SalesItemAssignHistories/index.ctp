<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\SalesItemAssignHistory[]|\Cake\Collection\CollectionInterface $salesItemAssignHistories
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Sales Item Assign History'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Menus'), ['controller' => 'Menus', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Menu'), ['controller' => 'Menus', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sales Items'), ['controller' => 'SalesItems', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Sales Item'), ['controller' => 'SalesItems', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="salesItemAssignHistories index large-9 medium-8 columns content">
    <h3><?= __('Sales Item Assign Histories') ?></h3>
    出庫アイテム割付<br>
    <?=date('Y年m月d日',$date).'以降の設定'?>
    <?=$this->Form->create(null) ?>
    <?= $this->Form->control('date',['label' => '設定日','rows'=>1,'type'=>'text'])?>
    <?= $this->Form->submit("設定",['name'=>'button']) ?>
    <?=$this->Form->end() ?>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col">メニュー品名・単価</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($menuHistories as $menuHistory): ?>
            <?=$this->Form->create('MenuHistories'.$menuHistory->id,['url' => ['action' => 'edit','menu_item_id' => intval($menuHistory->menu_item_id)]]) ?>
            <tr>
                <!--<td><?= h($menuHistory->menu_history->name . ' : ' . $menuHistory->price) ?><?= $this->Form->submit("登録",['name'=>'button']) ?></td>-->
                <td><?= h($menuHistory->name) ?><?= $this->Form->submit("登録",['name'=>'button']) ?></td>
            </tr>
            <tr>
                <td>
                    <?php foreach ($salesItemHistories as $salesItemHistory) : ?>
                        <?=  $this->Form->input('check-'.$menuHistory->id.'-'.$salesItemHistory->id,
                            [ "type" => "checkbox","value" => $salesItemHistory->sales_item_id,"label" => "" ,'hiddenField' => false,
                            'checked' => array_key_exists($menuHistory->menu_item_id, $assignArray) ? in_array($salesItemHistory->sales_item_id,$assignArray[$menuHistory->menu_item_id]) : false ]);?>
                         <?=$this->Form->label('check-'.$menuHistory->id.'-'.$salesItemHistory->id,  $salesItemHistory->sales_item->sales_item_number . ' : ' . $salesItemHistory->sales_item_name )?><br>
                    <?php endforeach; ?>
                </td>
            </tr>
            <?=$this->Form->end() ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>