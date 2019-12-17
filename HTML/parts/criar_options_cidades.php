<?php
    foreach($cidade as $cid){
        echo "<option value=" . $cid->id . " class='cidade'>" . $cid->nome . "</option>";
    }
?>