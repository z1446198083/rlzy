<?php if (!defined('THINK_PATH')) exit();?><!--添加栏目-->
<div class="dialog_content">
	<form id="info_form" action="<?php echo u('ArticleCate/add');?>" method="post">
		<table width="100%" class="table_form">
			<tr>
				<th width="120"><?php echo L('article_cate_parent');?> :</th>
				<td>
					<select class="J_cate_select mr10" data-pid="0" data-uri="<?php echo U('ArticleCate/ajax_getchilds');?>" data-selected="<?php echo ($spid); ?>"></select>
					<input type="hidden" name="pid" id="J_cate_id" />
				</td>
			</tr>
			<tr>
				<th><?php echo L('article_cate_name');?> :</th>
				<td><input type="text" name="name" id="name" class="input-text" size="30"></td>
			</tr>
			<tr>
				<th>别名 :</th>
				<td><input type="text" name="alias" id="alias" class="input-text" size="30"></td>
			</tr>
			<tr>
				<th>摘要 :</th>
				<td><textarea name="abst" style="width:300px; height:50px;"></textarea></td>
			</tr>
			<tr>
				<th>跳转  :</th>
				<td><input type="text" name="url" id="url" class="input-text" size="40" value="<?php echo ($info["url"]); ?>"></td>
			</tr>
			<tr>
				<th><?php echo L('article_cate_type');?> :</th>
				<td>
					<label><input type="radio" name="type" value="0" checked> <?php echo L('article_cate_type_0');?></label>&nbsp;&nbsp;
					<label><input type="radio" name="type" value="1"> <?php echo L('article_cate_type_1');?></label>
				</td>
			</tr>
			<tr>
				<th><?php echo L('article_cate_img');?> :</th>
				<td>
					<input type="text" name="img" id="J_img" class="input-text fl mr10" size="30">
					<div id="J_upload_img" class="upload_btn"><span><?php echo L('upload');?></span></div>
				</td>
			</tr>
			<!--<tr>-->
				<!--<th><?php echo L('article_cate_imgs');?> :</th>-->
				<!--<td>-->
					<!--<input type="text" name="imgs" id="J_imgs" class="input-text fl mr10" size="30">-->
					<!--<div id="J_upload_imgs" class="upload_btn"><span><?php echo L('upload');?></span></div>-->
				<!--</td>-->
			<!--</tr>-->
			<tr>
				<th><?php echo L('enabled');?> :</th>
				<td>
					<label><input type="radio" name="status" value="1" checked> <?php echo L('yes');?></label>&nbsp;&nbsp;
					<label><input type="radio" name="status" value="0"> <?php echo L('no');?></label>
				</td>
			</tr>
			<tr>
				<th><?php echo L('seo_title');?> :</th>
				<td><input type="text" name="seo_title" id="seo_title" class="input-text" style="width:300px;"></td>
			</tr>
			<tr>
				<th><?php echo L('seo_keys');?> :</th>
				<td><input type="text" name="seo_keys" id="seo_keys" class="input-text" style="width:300px;"></td>
			</tr>
			<tr>
				<th><?php echo L('seo_desc');?> :</th>
				<td><textarea name="seo_desc" style="width:300px; height:50px;"></textarea></td>
			</tr>
			<!--<tr>
				<th>频道首页模板 :</th>
				<td><input type="text" name="index_templet" id="index_templet" class="input-text" value="<?php echo ($info["index_templet"]); ?>" size="30"></td>
			</tr>
			<tr>
				<th>列表页模板 :</th>
				<td><input type="text" name="category_templet" id="category_templet" class="input-text" value="<?php echo ($info["category_templet"]); ?>" size="30"></td>
			</tr>
			<tr>
				<th>详情页模板 :</th>
				<td><input type="text" name="detail_templet" id="detail_templet" class="input-text" value="<?php echo ($info["detail_templet"]); ?>" size="30"></td>
			</tr>-->
		</table>
	</form>
</div>
<script src="/theme/admin/js/fileuploader.js"></script>
<script>
    $(function(){
        $.formValidator.initConfig({formid:"info_form",autotip:true});
        $("#name").formValidator({onshow:lang.please_input+lang.article_cate_name,onfocus:lang.please_input+lang.article_cate_name}).inputValidator({min:1,onerror:lang.please_input+lang.article_cate_name});

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
        $('.J_cate_select').cate_select();

        //上传图片
        var uploader = new qq.FileUploaderBasic({
            allowedExtensions: ['jpg','gif','jpeg','png','bmp','pdg'],
            button: document.getElementById('J_upload_img'),
            multiple: false,
            action: "<?php echo U('ArticleCate/ajax_upload_img');?>",
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
        //上传图片
        var uploader = new qq.FileUploaderBasic({
            allowedExtensions: ['jpg','gif','jpeg','png','bmp','pdg'],
            button: document.getElementById('J_upload_imgs'),
            multiple: false,
            action: "<?php echo U('ArticleCate/ajax_upload_imgs');?>",
            inputName: 'imgs',
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
                $('#J_upload_imgs').addClass('btn_disabled').find('span').text(lang.uploading);
            },
            onComplete: function(id, fileName, result){
                $('#J_upload_imgs').removeClass('btn_disabled').find('span').text(lang.upload);
                if(result.status == '1'){
                    $('#J_imgs').val(result.data);
                } else {
                    $.pinphp.tip({content:result.msg, icon:'error'});
                }
            }
        });
    });
</script>