<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Permit Pcs'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="permitPcs form large-9 medium-8 columns content">
    <?= $this->Form->create($permitPc) ?>
    <fieldset>
        <legend><?= __('Add Permit Pc') ?></legend>
        <?php
            echo $this->Form->input('ip_address');
            echo $this->Form->input('created_by');
            echo $this->Form->input('modified_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
