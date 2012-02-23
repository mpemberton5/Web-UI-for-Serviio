<form method="post" action="" id="transcodingform" name="transcoding">
    <input type="hidden" name="tab" value="transcoding">
    <br>
    <?php echo tr('tab_transcoding_general_description','When enabled, transcoding enables you to play media files that would not normally be playable by your device. Transcoding only works with a specific Renderer Profile (not the Generic DLNA profile).')?><br>
    <br>
    <input type="checkbox" name="transcoding" value="1"<?php echo $serviio->transcodingEnabled=="true"?" checked":""?>> <?php echo tr('tab_transcoding_enable_transcoding','Enable transcoding')?><br>
    <br>

    <ul id="generalsettingstab" class="shadetabs">
        <li><a href="#" rel="genset1" class="selected"><?php echo tr('tab_transcoding_general_settings','General settings')?></a></li>
    </ul>
    <div style="border:1px solid gray; width:98%; margin-bottom: 1em; padding: 10px">
        <div id="genset1" class="tabcontent">
            <table>
                <tr>
                    <td><?php echo tr('tab_transcoding_folder_location','Transcoded files location:')?></td>
                    <td><input type="text" name="location" size="40" value="<?php echo $serviio->transcodingFolderLocation?>"></td>
                    <td><input type="button" name="browse" value="<?php echo tr('tab_transcoding_select_folder','Browse...')?>" onclick="localPath='';return GB_showCenter('<?php echo tr('tab_transcoding_folder_location','Transcoded files location:')?>', '../../afb/index.php',500,500,addTransLocalPath);"></td>
                </tr>
                <tr>
                    <td><?php echo tr('tab_transcoding_threads','Number of CPU cores to use')?></td>
                    <td><select name="cores">
                    <?php for ($i=1;$i<=$serviio->numberOfCPUCores;$i++) { ?>
                    <option value="<?php echo $i?>"<?php echo $i==$serviio->threadsNumber?" selected":""?>><?php echo $i?></option>
                    <?php } ?>
                    </select></td><td>&nbsp;</td>
                </tr>
            </table>
        </div>
    </div>

    <br>

    <ul id="videosettingstab" class="shadetabs">
        <li><a href="#" rel="vidset1" class="selected"><?php echo tr('tab_transcoding_video_settings','Video settings')?></a></li>
    </ul>
    <div style="border:1px solid gray; width:98%; margin-bottom: 1em; padding: 10px">
        <div id="vidset1" class="tabcontent">
            <input type="checkbox" name="quality" value="1"<?php echo $serviio->bestVideoQuality=="true"?" checked":""?>> <?php echo tr('tab_transcoding_produce_best_quality','Produce the best video quality')?><br><br>
            <?php echo tr('tab_transcoding_audio_channels','Audio channels')?>
            <input type="radio" name="audio" value="original"<?php echo $serviio->audioDownmixing=="true"?"":" checked"?>> <?php echo tr('tab_transcoding_audio_channels_original','Keep original')?>
            <input type="radio" name="audio" value="downmix"<?php echo $serviio->audioDownmixing=="true"?" checked":""?>> <?php echo tr('tab_transcoding_audio_channels_stereo','Downmix to stereo')?>
        </div>
    </div>

    <div align="right">
        <span id="savingMsg" class="savingMsg"></span>
        <input type="submit" id="reset" name="reset" value="<?php echo tr('button_reset','Reset')?>" onclick="return confirm('Are you sure you want to reset changes?')">
        <input type="submit" id="submit" name="save" value="<?php echo tr('button_save','Save')?>" />
    </div>
</form>
