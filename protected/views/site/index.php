<?php if($user != array()){?>
<table>
    <tr>
        <td>
           Имя: 
        </td>
        <td>
           <?php echo $user->name;?>
        </td>
    </tr>
    
    <tr>
        <td>
           Изображение: 
        </td>
        <td>
           <?php echo CHtml::image($user->profile_image_url);?>
        </td>
    </tr>
    
    <tr>
        <td>
           ID: 
        </td>
        <td>
           <?php echo $user->id_str;?>
        </td>
    </tr>
    
    <tr>
        <td>
           Username: 
        </td>
        <td>
           <?php echo $user->screen_name;?>
        </td>
    </tr>
    
    <tr>
        <td>
           Место нахождения: 
        </td>
        <td>
           <?php echo $user->location;?>
        </td>
    </tr>
    
    <tr>
        <td>
           Описание: 
        </td>
        <td>
           <?php echo $user->description;?>
        </td>
    </tr>
    
    <tr>
        <td>
           Количество фолловеров: 
        </td>
        <td>
           <?php echo $user->followers_count;?>
        </td>
    </tr>
    
    <tr>
        <td>
           Количество друзей: 
        </td>
        <td>
           <?php echo $user->friends_count;?>
        </td>
    </tr>
    
    <tr>
        <td>
           Количество упоменаний: 
        </td>
        <td>
           <?php echo $user->listed_count;?>
        </td>
    </tr>
    
    <tr>
        <td>
           Зарегистрирован: 
        </td>
        <td>
           <?php echo $user->created_at;?>
        </td>
    </tr>
    
</table>
<?php } ?>

