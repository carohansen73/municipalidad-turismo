<script src="https://cdn.tiny.cloud/1/89lzfakvpepatq8zq1jd5lq5iqwhpf9w9psebr387tbv3ogg/tinymce/5/tinymce.min.js"></script>
<script>
  var editor_config = {
      path_absolute : "/",
      selector: "textarea.my-editor",
      language_url : "{{ asset('js/vendor/tinymce/langs/es.js') }}",
      plugins: [
      "advlist autolink lists link charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons paste textcolor colorpicker textpattern"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link media",
      /* Hace responsives las tablas que se insertan */
      setup: function (editor) {
          editor.on('BeforeSetContent', function(e) {
              if (e.content.indexOf("<table") == 0) {
                  e.content = '<div class="table-responsive">' + e.content + '</div>';
              }
          });
      },
      relative_urls: false,
      file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
  
      var cmsURL = editor_config.path_absolute + 'gestor?field_name=' + field_name;
      if (type == 'image') {
          cmsURL = cmsURL + "&type=Images";
      } else {
          cmsURL = cmsURL + "&type=Files";
      }
  
      tinyMCE.activeEditor.windowManager.open({
          file : cmsURL,
          title : 'Gestor',
          width : x * 0.8,
          height : y * 0.8,
          resizable : "yes",
          close_previous : "no"
      });
      }
  };
  
  tinymce.init(editor_config);

</script>

{{--<script>
    var editor_config = {
        path_absolute : "/",
        selector: "textarea.my-editor",
        language_url : "{{ asset('js/vendor/tinymce/langs/es.js') }}",
        plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        /* Hace responsives las tablas que se insertan */
        setup: function (editor) {
            editor.on('BeforeSetContent', function(e) {
                if (e.content.indexOf("<table") == 0) {
                    e.content = '<div class="table-responsive">' + e.content + '</div>';
                }
            });
        },
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
    
        var cmsURL = editor_config.path_absolute + 'gestor?field_name=' + field_name;
        if (type == 'image') {
            cmsURL = cmsURL + "&type=Images";
        } else {
            cmsURL = cmsURL + "&type=Files";
        }
    
        tinyMCE.activeEditor.windowManager.open({
            file : cmsURL,
            title : 'Gestor',
            width : x * 0.8,
            height : y * 0.8,
            resizable : "yes",
            close_previous : "no"
        });
        }
    };
    
    tinymce.init(editor_config);
  
  </script>--}}