<?php
/**
  * @var \App\View\AppView $this
  */
?>
<?php 
echo $this->Html->link('ログアウト', ['controller'=>'Users', 'action'=>'logout']);
?> <br> <?php
if($data['type'] === 'H')
{
    echo $this->Html->link('売上管理', ['controller'=>'Users', 'action'=>'login']);
    ?> <br> <?php
    echo $this->Html->link('勤怠管理', ['controller'=>'Attendance/employees', 'action'=>'index']);
}
if($data['type'] === 'M')
{
    echo $this->Html->link('売上管理', ['controller'=>'Users', 'action'=>'login']);
    ?> <br> <?php
    echo $this->Html->link('勤怠管理', ['controller'=>'Attendance/employees', 'action'=>'index']);
}
if($data['type'] === 'G')
{
    
}
?>
</div>
