<?php
/**
  * @var \App\View\AppView $this
  */
?>
<div class="login_form">
<?php 
echo $this->Form->create('Employees') ;
echo $this -> Form -> input ( "code", [ "type" => "text",
                                           "size" => 10,
                                           "label" => "従業員コード",
                                           "default" => "" ]  );
echo $this -> Form -> submit ( "ログイン", [
    'class' => 'login-button'
] );
echo $this -> Form -> submit ( "勤怠データ確認");
echo $this -> Form -> submit ( "別店舗応援");
echo $this -> Form -> end ();
?>
</div>
