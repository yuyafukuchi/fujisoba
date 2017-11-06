<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MenuHistory $menuHistory
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Menu Histories'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="menuHistories form large-9 medium-8 columns content">
    <?= $this->Form->create($menuHistory) ?>
    <fieldset>
        <legend><?= __('Add Menu History') ?></legend>
        <?php
            echo $this->Form->control('menu_item_id');
            echo $this->Form->control('name');
            echo $this->Form->control('start', ['empty' => true]);
            echo $this->Form->control('end', ['empty' => true]);
            echo $this->Form->control('deleted');
            echo $this->Form->control('created_by');
            echo $this->Form->control('modified_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
