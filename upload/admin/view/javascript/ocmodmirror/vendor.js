var editor;
$(document).ready(function() {
    editor = CodeMirror.fromTextArea(document.getElementById('ocmodmirror'), {
        lineNumbers: true,
        mode: "xml",
        keyMap: "sublime",
        autoCloseBrackets: true,
        //matchBrackets: true,
        showCursorWhenSelecting: true,
        theme: "material",
        tabSize: 2,
    });

    $('#ocmodmirror-theme').val('material');
});

var ocmodmirror = {
    theme: function() {
        let theme = $('#ocmodmirror-theme').val();
        editor.setOption("theme", theme);
    }
};