<?php
/**
  * @var \App\View\AppView $this
  */
?>

<?php 
echo $storeName . ' / '.$user->name_first .' '. $user->name_last .' 様';
echo nl2br("\n");
echo $timeCard['support'];
echo $this -> Form -> create (
                "null", [ "type" => "post",
                          "url" => [ "controller" => "TimeCards",
                                     "action" => "emboss" ] ] );
echo $this -> Form -> input ( "", [ "type" => "text",
                                           "size" => 10,
                                           "default" => date('Y/m/d') ]  );
echo h($timeCard['in_time']);
echo nl2br("\n");
echo h($timeCard['in_time2']);
echo $this -> Form -> input ( "", [ "type" => "text",
                                           "size" => 10,
                                           "default" => date('H:i:s') ]  );
echo h($timeCard['out_time']);
echo nl2br("\n");
echo h($timeCard['out_time2']);
echo $this -> Form -> submit ( "出勤", array('name' => 'button'));
if( $timeCard['in_time']== null|| 
    ($timeCard['out_time']!= null && $timeCard['in_time2'] == null)||
     $timeCard['out_time2'] != null)
    {
       echo $this -> Form -> submit ( "退勤", array('name' => 'button','disabled' => 'true')); 
    } else {
        echo $this -> Form -> submit ( "退勤", array('name' => 'button'));
    }
echo $this -> Form -> end ();
?>
</div>
