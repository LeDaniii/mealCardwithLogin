<?php

    // Form Input
    function inputElement($icon, $placeholder, $name, $value, $display){
        $ele = "
        <div class=\"input-group\" style=\"display: $display \">
        <div class=\"input-group-prepend\">
        <div class=\"input-group-text bg-warning\">$icon</div>
        </div>
        <input type=\"text\" name='$name' value='$value' autocomplete=\"off\" placeholder='$placeholder' class=\"form-control\"
        id=\"inlineFormInputGroupUsername\" placeholder=\"Username\">
        </div>
        ";
        echo $ele;
    }

    // Buttons
    function buttonElement($btnid, $styleclass, $text, $name, $attr) {
        $btn = "
        <button name = '$name' '$attr' class='$styleclass' id='$btnid'>$text</button>";
        echo $btn;
    }

    // Table Row
    function tableRowElement($img, $name, $ingrediants, $allergenes, $price, $id){
        $tableRow = "  <tr>
        <td class=\"align-middle\" data-id=\" $id \" style=\"display: none;\"> $id </td>
        <td class=\"align-middle\" data-id=\" $id \" ><img src=\" $img \" alt=\"\"></td>
        <td class=\"align-middle\" data-id=\" $id \" >$name</td>
        <td class=\"align-middle\" data-id=\" $id \" >$ingrediants</td>
        <td class=\"align-middle\" data-id=\" $id \" >$allergenes</td>
        <td class=\"align-middle\" data-id=\" $id \" >$price</td>
        <td class=\"align-middle\" ><i class=\"fas fa-edit btnedit\" id=\"$id\" data-id=\" $id \"></i></td>
        </tr> ";

        echo $tableRow;
    }
    