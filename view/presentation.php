<form method="post" action="" id="presentationform" name="presentation" accept-charset="utf-8">
    <input type="hidden" name="tab" value="presentation">
    <br>
    <?php echo tr('tab_presentation_description','You can modify the categories of the browsing menu on your device. Choose categories to be visible, \'transparent\' or disabled.')?>
    <br>
    <br>

    <table width="100%">
        <tr>
            <?php foreach ($categories as $id=>$category) { ?>
            <td style="vertical-align:top">
                <table id="Presentation<?php echo $category[0]?>" name="Presentation<?php echo $category[0]?>">
                    <thead>
                        <tr>
                            <th><b><?php echo tr('tab_presentation_categories_table_category_name','Category Name')?></b></th>
                            <th><b><?php echo tr('tab_presentation_categories_table_category_visibility','Visibility')?></b></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><?php echo $category[0]?><input type="hidden" name="titles['<?php echo $id?>'][0]" value="<?php echo $category[0]?>"></td>
                            <td><select name="visibility['<?php echo $id?>'][0]">
                            <?php foreach ($categoryVisibilityTypes as $key=>$val) { ?>
                            <option value="<?php echo $key?>"<?php echo $key==$category[1]?" selected":""?>><?php echo $val?></option>
                            <?php } ?>
                            </select></td>
                        </tr>
                        <?php $ctr = 1;?>
                        <?php foreach ($category[2] as $subId=>$subCategory) { ?>
                        <tr <?php echo $ctr%2?'':'class="odd"'?>>
                            <td> &nbsp; &nbsp; &nbsp; - <?php echo $subCategory[0]?><input type="hidden" name="titles['<?php echo $id?>']['<?php echo $subId?>']" value="<?php echo $subCategory[0]?>"></td>
                            <td><select name="visibility['<?php echo $id?>']['<?php echo $subId?>']">
                            <?php foreach ($categoryVisibilityTypes as $key=>$val) { ?>
                            <option value="<?php echo $key?>"<?php echo $key==$subCategory[1]?" selected":""?>><?php echo $val?></option>
                            <?php } ?>
                            </select></td>
                        </tr>
                        <?php $ctr += 1;?>
                        <?php } ?>
                    </tbody>
                </table>
            </td>
            <?php } ?>
        </tr>
    </table>

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
        <span id="savingMsg" class="savingMsg"></span>
        <input type="submit" id="reset" name="reset" value="<?php echo tr('button_reset','Reset')?>" onclick="return confirm('Are you sure you want to reset changes?')">
        <input type="submit" id="submit" name="save" value="<?php echo tr('button_save','Save')?>" />
    </div>
</form>
