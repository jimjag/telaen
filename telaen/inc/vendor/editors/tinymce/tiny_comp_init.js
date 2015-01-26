// compressor init
tinyMCE_GZ.init({
    mode : "textareas",
    theme : "modern",
    language : "en",
    plugins : 'table,advlist,spellchecker,insertdatetime,preview,searchreplace,print,contextmenu,paste,directionality,fullscreen,emoticons',
    doctype: "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">",
    forced_root_block : "p",
    insertdatetime_dateformat : "%Y-%m-%d",
    insertdatetime_timeformat : "%H:%M:%S",
    invalid_elements : "script,applet,iframe",
    extended_valid_elements : "hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
    file_browser_callback : "fileBrowserCallBack",
    disk_cache : true,
    debug : false
});

