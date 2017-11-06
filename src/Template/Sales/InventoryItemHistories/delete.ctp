<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\InventoryItemHistory[]|\Cake\Collection\CollectionInterface $inventoryItemHistories
 */
?>
<div class="inventoryItemHistories index large-9 medium-8 columns content">
    マスタ在庫アイテム削除<br>
    以下のマスタ在庫アイテムを
    <?=date('Y年m月d日',$date)?>
    以降削除しますが、よろしいですか？
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>品名</td>
                <td><?=h($inventoryItemHistory->item_name)?></td>
            </tr>
        </tbody>
    </table>
    <?=$this->Form->create(null) ?>
    <?= $this->Form->submit("キャンセル",['name'=>'button']) ?>
    <?= $this->Form->submit("削除",['name'=>'button']) ?>
    <?=$this->Form->end() ?>
</div>
