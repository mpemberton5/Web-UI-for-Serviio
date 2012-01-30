<form method="post" action="" name="presentation">
<input type="hidden" name="tab" value="presentation">
<?php echo tr('tab_presentation_description','You can modify the categories of the browsing menu on your device. Choose categories to be visible, \'transparent\' or disabled.')?>
<br>
<br>

<table width="100%"><tr>
<?php foreach ($categories as $id=>$category) { ?>
<td style="vertical-align:top">
<table>
<tr>
    <td><b><?php echo tr('tab_presentation_categories_table_category_name','Category Name')?></b></td>
    <td><b><?php echo tr('tab_presentation_categories_table_category_visibility','Visibility')?></b></td>
</tr>
<tr>
    <td><?php echo $category[0]?><input type="hidden" name="titles['<?php echo $id?>'][0]" value="<?php echo $category[0]?>"></td>
    <td><select name="visibility['<?php echo $id?>'][0]">
    <?php foreach ($categoryVisibilityTypes as $key=>$val) { ?>
    <option value="<?php echo $key?>"<?php echo $key==$category[1]?" selected":""?>><?php echo $val?></option>
    <?php } ?>
    </select></td>
</tr>
    <?php foreach ($category[2] as $subId=>$subCategory) { ?>
<tr>
    <td> &nbsp; &nbsp; &nbsp; - <?php echo $subCategory[0]?><input type="hidden" name="titles['<?php echo $id?>']['<?php echo $subId?>']" value="<?php echo $subCategory[0]?>"></td>
    <td><select name="visibility['<?php echo $id?>']['<?php echo $subId?>']">
    <?php foreach ($categoryVisibilityTypes as $key=>$val) { ?>
    <option value="<?php echo $key?>"<?php echo $key==$subCategory[1]?" selected":""?>><?php echo $val?></option>
    <?php } ?>
    </select></td>
</tr>    
    <?php } ?>
</table>
</td>
<?php } ?>
</tr></table>
<input type="checkbox" name="showParentCategoryTitle" value="1"<?php echo $serviio->showParentCategoryTitle=="true"?" checked":""?>> 
<?php echo tr('tab_presentation_include_category_title_for_content_only_content','Include parents title for items in "Display content only" categories')?>
<br>
<br>
<?php echo tr('tab_presentation_languages_description','Select preferred language of the browsing menu.')?><br>
<select name="presentation_language">
<?php foreach ($browsingCategoriesLanguages as $key=>$val) { ?>
<option value="<?php echo $key?>"<?php echo $key==$serviio->presentationLanguage?" selected":""?>><?php echo $val?></option>
<?php } ?>
</select>
<br>
<div align="right">
<input type="submit" name="reset" value="<?php echo tr('button_reset','Reset')?>" onclick="return confirm('Are you sure you want to reset changes?')">
<input type="submit" name="save" value="<?php echo tr('button_save','Save')?>" />
</div>
</form>
