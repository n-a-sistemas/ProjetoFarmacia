<?php
    foreach($estados as $es){
        echo "<option value=" . $es->id . ">" . $es->nome . "</option>";
    }
?>