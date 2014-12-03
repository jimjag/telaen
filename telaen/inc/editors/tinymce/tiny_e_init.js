
// this init the editor
tinyMCE.init({
	mode : "textareas",
	theme : "modern",
	language : "en",
	theme_advanced_buttons1 : "fontselect,fontsizeselect,bold,italic,underline,separator,undo,redo,separator,outdent,indent,blockquote,strikethrough",
	theme_advanced_buttons2 : "justifyleft,justifycenter,justifyright,justifyfull,bullist,numlist,separator,forecolor,backcolor,separator,emotions,hr,code",
	theme_advanced_buttons3 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_disable : "styleselect",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_path : false,
	cleanup : true,
	fix_content_duplication : true,
});
