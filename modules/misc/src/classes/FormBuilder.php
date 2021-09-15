<?php

namespace Misc\Classes;

use Poppy\Framework\Helper\StrHelper;

class FormBuilder extends \Poppy\System\Classes\FormBuilder
{

	/**
	 * 编辑器
	 * @param string $name    名字
	 * @param string $value   值
	 * @param array  $options 选项
	 * @return string
	 */
	public function simplemde($name, $value = null, $options = []): string
	{
		$pam       = $options['pam'] ?? '';
		$token     = $pam ? app('tymon.jwt.auth')->fromUser($pam) : '';
		$uploadUrl = route_url('system:api_v1.upload.image');
		$contentId = 'simplemde_' . StrHelper::random('5');
		$value     = (string) $this->getValueAttribute($name, $value);
		$data      = <<<Editor
	<textarea class="hidden" name="{$name}" id="{$contentId}">{$value}</textarea>
		<script>
		$(function () {
var simplemde = new SimpleMDE({
		element      : document.getElementById("{$contentId}"),
		spellChecker : false,
		forceSync    : true,
		toolbar      : [
			"bold", "italic", "heading", "|", "quote", "code", "table",
			"horizontal-rule", "unordered-list", "ordered-list", "|",
			"link", "image", "|", "side-by-side", 'fullscreen', "|",
			{
				name      : "guide",
				action    : function customFunction() {
					var win = window.open('https://github.com/riku/Markdown-Syntax-CN/blob/master/syntax.md', '_blank');
					if (win) {
						//Browser has allowed it to be opened
						win.focus();
					} else {
						//Browser has blocked it
						alert('Please allow popups for this website');
					}
				},
				className : "fa fa-info-circle",
				title     : "Markdown 语法！"
			},
			{
				name      : "publish",
				action    : function customFunction() {
					$('#{$contentId}').parents('form').submit();
				},
				className : "fa fa-paper-plane",
				title     : "发布文章"
			}
		]
	});

	inlineAttachment.editors.codemirror4.attach(simplemde.codemirror, {
		uploadUrl            : '{$uploadUrl}',
		uploadFieldName      : 'image',
		extraParams          : {
			'token' : '{$token}'
		},
		onFileUploadResponse : function(xhr) {
			var result = JSON.parse(xhr.responseText),
				filename;

			if (result.status === 0) {
				filename = result.data.url[0];
			}
			if (result && filename) {
				var newValue;
				if (typeof this.settings.urlText === 'function') {
					newValue = this.settings.urlText.call(this, filename, result);
				} else {
					newValue = this.settings.urlText.replace(this.filenameTag, filename);
				}
				var text = this.editor.getValue().replace(this.lastValue, newValue);
				this.editor.setValue(text);
				this.settings.onFileUploaded.call(this, filename);
			}
			return false;
		}
	});
		})
		</script>
Editor;
		return $data;
	}
}