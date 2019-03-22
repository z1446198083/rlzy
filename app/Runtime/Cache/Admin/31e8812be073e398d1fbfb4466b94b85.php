<?php if (!defined('THINK_PATH')) exit();?><!--编辑广告-->
<div class="dialog_content">
<form id="info_form" action="<?php echo u('ad/edit');?>" method="post">
<table width="100%" cellpadding="2" cellspacing="1" class="table_form">
    <tr>
        <th width="80"><?php echo L('ad_name');?> :</th>
        <td><input type="text" name="name" id="name" class="input-text" size="40" value="<?php echo ($info["name"]); ?>"></td>
    </tr>
    <tr>
        <th><?php echo L('ad_url');?> :</th>
        <td><input type="text" name="url" class="input-text" size="40" value="<?php echo ($info["url"]); ?>"></td>
    </tr>
    <tr>
        <th><?php echo L('adboard');?> :</th>
        <td class="blue">
           <select name="board_id" id="board_id">
            <?php if(is_array($adboards)): $i = 0; $__LIST__ = $adboards;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><option value="<?php echo ($val["id"]); ?>" allowtype="<?php echo ($val["allow_type"]); ?>" <?php if($info['board_id'] == $val['id']): ?>selected="selected"<?php endif; ?>><?php echo ($val["name"]); ?>（<?php echo ($val["width"]); ?>*<?php echo ($val["height"]); ?>）</option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
    </tr>
    <tr>
        <th><?php echo L('ad_type');?> :</th>
        <td>
            <select name="type" id="type">
            <?php if(is_array($ad_type_arr)): $i = 0; $__LIST__ = $ad_type_arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if($info['type'] == $key): ?>selected="selected"<?php endif; ?>><?php echo ($val); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </td>
    </tr>
    <tr id="ad_image" class="bill_media">
        <th><?php echo L('ad_image');?> :</th>
        <td><input type="text" name="img" id="J_img" class="input-text fl mr10" size="30" value="<?php echo ($info["content"]); ?>">
          <div id="J_upload_img" class="upload_btn"><span><?php echo L('upload');?></span></div>
		<?php if($info["type"] == 'image'): if(!empty($info['content'])): ?><span class="attachment_icon J_attachment_icon" file-type="image" file-rel="<?php echo attach($info["content"],'banner');?>"><img src="/theme/admin//images/filetype/image_s.gif" /></span><?php endif; endif; ?>
		</td>
    </tr>
    <tr id="ad_code" class="bill_media" style="display:none;">
        <th><?php echo L('ad_code');?> :</th>
        <td><textarea rows="3" cols="50" name="code" id="code"><?php echo ($info["content"]); ?></textarea></td>
    </tr>
    <tr id="ad_flash" class="bill_media" style="display:none;">
        <th><?php echo L('ad_flash');?> :</th>
        <td>
            <input type="text" name="flash" id="J_flash" class="input-text fl mr10" size="30" value="<?php echo ($info["content"]); ?>">
            <div id="J_upload_flash" class="upload_btn"><span><?php echo L('upload');?></span></div>
        </td>
    </tr>
    <tr id="ad_text" class="bill_media" style="display:none;">
        <th><?php echo L('ad_text');?> :</th>
        <td><textarea rows="3" cols="50" name="text" id="text"><?php echo ($info["content"]); ?></textarea></td>
    </tr>
    <tr>
      <th><?php echo L('ad_ext_image');?> :</th>
      <td>
          <input type="text" name="extimg" id="J_extimg" class="input-text fl mr10" size="30" value="<?php echo ($info["extimg"]); ?>">
          <div id="J_upload_extimg" class="upload_btn"><span><?php echo L('upload');?></span></div>
      </td>
    </tr>
    <tr>
      <th><?php echo L('ad_ext_val');?> :</th>
      <td>
          <input type="text" name="extval" class="input-text fl mr10" value="<?php echo ($info["extval"]); ?>">
      </td>
    </tr>
    <tr>
      <th><?php echo L('ad_desc');?> :</th>
      <td><input type="text" name="desc" class="input-text fl mr10" size="30" value="<?php echo ($info["desc"]); ?>"></td>
    </tr>
    <tr>
        <th><?php echo L('ad_time');?> :</th>
        <td>
            <input type="text" name="start_time" id="start_time" class="date" size="12" value="<?php echo (date('Y-m-d',$info["start_time"])); ?>">
            <input type="text" name="end_time" id="end_time" class="date" size="12" value="<?php echo (date('Y-m-d',$info["end_time"])); ?>">
        </td>
    </tr>
    <tr>
        <th><?php echo L('enabled');?> :</th>
        <td>
            <label><input type="radio" <?php if($info['status'] == '1'): ?>checked="checked"<?php endif; ?> value="1" name="status"> <?php echo L('yes');?></label>&nbsp;&nbsp;
            <label><input type="radio" <?php if($info['status'] == '0'): ?>checked="checked"<?php endif; ?> value="0" name="status"> <?php echo L('no');?></label>
        </td>
    </tr>
</table>
<input type="hidden" name="id" id="id" value="<?php echo ($info["id"]); ?>" />
</form>
</div>
<script src="/theme/admin/js/fileuploader.js"></script>
<script type="text/javascript">
Calendar.setup({
    inputField : "start_time",
    ifFormat   : "%Y-%m-%d",
    showsTime  : false,
    timeFormat : "24"
});
Calendar.setup({
    inputField : "end_time",
    ifFormat   : "%Y-%m-%d",
    showsTime  : false,
    timeFormat : "24"
});

$(function(){
    $("#type").change(function(){
        $(".bill_media").hide();
        $("#ad_"+$(this).val()).show();
    });
    $("#type").change();

    $.formValidator.initConfig({formid:"info_form",autotip:true});
    $("#name").formValidator({onshow:"请填写广告名称",onfocus:"请填写广告名称"}).inputValidator({min:1,onerror:"请填写广告名称"}).defaultPassed();
    $('#info_form').ajaxForm({success:complate,dataType:'json'});
    function complate(result){
        if(result.status == 1){
            $.dialog.get(result.dialog).close();
            $.pinphp.tip({content:result.msg});
            window.location.reload();
        } else {
			$.pinphp.tip({content:result.msg, icon:'alert'});
        }
    }
	
	//上传图片
    var img_uploader = new qq.FileUploaderBasic({
        allowedExtensions: ['jpg','gif','jpeg','png','bmp','pdg'],
        button: document.getElementById('J_upload_img'),
        multiple: false,
        action: "<?php echo U('ad/ajax_upload_img');?>",
        inputName: 'img',
        forceMultipart: true, //用$_FILES
        messages: {
            typeError: lang.upload_type_error,
            sizeError: lang.upload_size_error,
            minSizeError: lang.upload_minsize_error,
            emptyError: lang.upload_empty_error,
            noFilesError: lang.upload_nofile_error,
            onLeave: lang.upload_onLeave
        },
        showMessage: function(message){
            $.pinphp.tip({content:message, icon:'error'});
        },
        onSubmit: function(id, fileName){
            $('#J_upload_img').addClass('btn_disabled').find('span').text(lang.uploading);
        },
        onComplete: function(id, fileName, result){
            $('#J_upload_img').removeClass('btn_disabled').find('span').text(lang.upload);
            if(result.status == '1'){
                $('#J_img').val(result.data);
            } else {
                $.pinphp.tip({content:result.msg, icon:'error'});
            }
        }
    });

    var extimg_uploader = new qq.FileUploaderBasic({
        allowedExtensions: ['jpg','gif','jpeg','png','bmp','pdg'],
        button: document.getElementById('J_upload_extimg'),
        multiple: false,
        action: "<?php echo U('ad/ajax_upload_img', array('type'=>'extimg'));?>",
        inputName: 'extimg',
        forceMultipart: true, //用$_FILES
        messages: {
            typeError: lang.upload_type_error,
            sizeError: lang.upload_size_error,
            minSizeError: lang.upload_minsize_error,
            emptyError: lang.upload_empty_error,
            noFilesError: lang.upload_nofile_error,
            onLeave: lang.upload_onLeave
        },
        showMessage: function(message){
            $.pinphp.tip({content:message, icon:'error'});
        },
        onSubmit: function(id, fileName){
            $('#J_upload_extimg').addClass('btn_disabled').find('span').text(lang.uploading);
        },
        onComplete: function(id, fileName, result){
            $('#J_upload_extimg').removeClass('btn_disabled').find('span').text(lang.upload);
            if(result.status == '1'){
                $('#J_extimg').val(result.data);
            } else {
                $.pinphp.tip({content:result.msg, icon:'error'});
            }
        }
    });

    var flash_uploader = new qq.FileUploaderBasic({
        allowedExtensions: ['swf'],
        button: document.getElementById('J_upload_flash'),
        multiple: false,
        action: "<?php echo U('ad/ajax_upload_img', array('type'=>'flash'));?>",
        inputName: 'flash',
        forceMultipart: true, //用$_FILES
        messages: {
            typeError: lang.upload_type_error,
            sizeError: lang.upload_size_error,
            minSizeError: lang.upload_minsize_error,
            emptyError: lang.upload_empty_error,
            noFilesError: lang.upload_nofile_error,
            onLeave: lang.upload_onLeave
        },
        showMessage: function(message){
            $.pinphp.tip({content:message, icon:'error'});
        },
        onSubmit: function(id, fileName){
            $('#J_upload_flash').addClass('btn_disabled').find('span').text(lang.uploading);
        },
        onComplete: function(id, fileName, result){
            $('#J_upload_flash').removeClass('btn_disabled').find('span').text(lang.upload);
            if(result.status == '1'){
                $('#J_flash').val(result.data);
            } else {
                $.pinphp.tip({content:result.msg, icon:'error'});
            }
        }
    });
})
</script>