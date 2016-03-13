(function ($) {

    // Register plugin
    tinymce.PluginManager.add('tinymce_flickr', function (editor, url) {
        
        function showDialog() {
            var win = editor.windowManager.open({
                title: "Flickr",
                file: url + '/dialog.php',
                width: 600,
                height: 300,
                inline: 1,
                buttons: [{
                        text: "Close",
                        id: "close",
                        class: "close",
                        onclick: "close"
                }]
            }, {
                plugin_url: url,
                jquery: $
            });
        }

        editor.addButton('tinymce_flickr', {
            image: url + '/images/icon.png',
            tooltip: 'Flickr',
            onclick: showDialog
        });

    });

})(jQuery);
