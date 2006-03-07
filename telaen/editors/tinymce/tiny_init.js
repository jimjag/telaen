tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "table,advhr,advimage,advlink,iespell,insertdatetime,preview,zoom,flash,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,-emotions, fullpage",
		//theme_advanced_buttons1_add_before : "save,newdocument,separator",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect,separator,forecolor,backcolor",
		theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview",
		theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",
		theme_advanced_buttons3_add_before : "tablecontrols,separator",
		theme_advanced_buttons3_add : "emotions,iespell,flash,advhr,separator,print,separator,ltr,rtl",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_disable : "styleselect",
		theme_advanced_path_location : "bottom",
		cleanup : "false", 
		content_css : "editors/tinymce/mycontent.css",
		plugin_insertdate_dateFormat : "%Y-%m-%d",
		plugin_insertdate_timeFormat : "%H:%M:%S",
		invalid_elements : "script,applet,iframe",
		extended_valid_elements : "hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
		external_link_list_url : "example_link_list.js",
		external_image_list_url : "example_image_list.js",
		flash_external_list_url : "example_flash_list.js",
		file_browser_callback : "fileBrowserCallBack",
		theme_advanced_resize_horizontal : true,
		theme_advanced_resizing : true,
		apply_source_formatting : false,
		fullpage_default_encoding : "iso-8859-1",
		fullpage_default_xml_pi : false,
		fullpage_default_title : ""		
});


function fileBrowserCallBack(field_name, url, type, win) {
		// This is where you insert your custom filebrowser logic
		alert("Example of filebrowser callback: field_name: " + field_name + ", url: " + url + ", type: " + type);

		// Insert new URL, this would normaly be done in a popup
		win.document.forms[0].elements[field_name].value = "someurl.htm";
}
