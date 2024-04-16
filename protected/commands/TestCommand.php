<?php
class TestCommand extends CConsoleCommand
{
    public function run($args)
    {
        $table1=new table1;
 
        if($args[0] == 'date')
            $table1->date=date('Y-m-d');
        elseif($args[0] == 'datetime')
            $table1->date=date('Y-m-d H:i:s');
 
        $table1->save();
    }
}

?>