<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="upper-block">
<p class="name">
<?php
echo $store_name;
?>
</p>
<?php
echo $this->Html->link('ログアウト', ['controller'=>'/../Users', 'action'=>'logout'], ['class' => 'logout']);
echo nl2br("\n");
?>
</div>
<div class="login_form">
<?php 

echo $this->Form->create('Employees') ;
echo $this -> Form -> input ( "code", [ "type" => "text",
                                           "size" => 10,
                                           "label" => "従業員コード",
                                           "default" => "" ]  );
echo $this -> Form -> submit ( "ログイン", [ 'class' => 'login-button' ] );
echo $this -> Form -> submit ( "勤怠データ確認", [
    'class' => 'confirm-attendance'
] );
echo $this -> Form -> submit ( "別店舗応援", [ 'class' => 'support-another' ] );
echo $this -> Form -> end ();
?>
</div>
