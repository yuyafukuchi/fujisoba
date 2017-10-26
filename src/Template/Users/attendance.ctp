<?php
/**
  * @var \App\View\AppView $this
  */
?>
<?php 
echo $data['name'];
echo nl2br("\n");
echo $this->Html->link('ログアウト', ['controller'=>'Users', 'action'=>'logout']);
?> <br> <?php
if($data['type'] === 'H')
{
    echo $this->Html->link('従業員マスタ保守', ['controller'=>'Attendance/Employees', 'action'=>'index']);
    ?> <br> <?php
    echo $this->Html->link('勤怠データ検索', ['controller'=>'Attendance/monthly-time-cards', 'action'=>'index']);
}
if($data['type'] === 'M')
{
    echo $this->Html->link('従業員マスタ保守', ['controller'=>'Attendance/Employees', 'action'=>'index']);
    ?> <br> <?php
    echo $this->Html->link('勤怠データ検索', ['controller'=>'Attendance/monthly-time-cards', 'action'=>'index']);
}
if($data['type'] === 'G')
{
    echo 'エラー：このページにはアクセスできません。';
}
?>
</div>
