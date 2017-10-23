<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $employee->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $employee->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Employees'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Companies'), ['controller' => 'Companies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Company'), ['controller' => 'Companies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stores'), ['controller' => 'Stores', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Store'), ['controller' => 'Stores', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Time Cards'), ['controller' => 'TimeCards', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Time Card'), ['controller' => 'TimeCards', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="employees form large-9 medium-8 columns content">
    <?= $this->Form->create($employee) ?>
    <fieldset>
        <legend><?= __('Edit Employee') ?></legend>
        <?php
            echo $this->Form->input('code');
            echo $this->Form->input('name_last');
            echo $this->Form->input('name_first');
            echo $this->Form->input('name_last_kana');
            echo $this->Form->input('name_first_kana');
            echo $this->Form->input('company_id', ['options' => $companies]);
            echo $this->Form->input('store_id', ['options' => $stores]);
            echo $this->Form->input('contact_type');
            echo $this->Form->input('joined', ['empty' => true]);
            echo $this->Form->input('retired', ['empty' => true]);
            echo $this->Form->input('deleted');
            echo $this->Form->input('note');
            echo $this->Form->input('flag');
            echo $this->Form->input('regular_amount');
            echo $this->Form->input('midnight_amount');
            echo $this->Form->input('other1_amount');
            echo $this->Form->input('other2_amount');
            echo $this->Form->input('employee_shift');
            echo $this->Form->input('othershift_start');
            echo $this->Form->input('othershift_end');
            echo $this->Form->input('created_by');
            echo $this->Form->input('modified_by');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
