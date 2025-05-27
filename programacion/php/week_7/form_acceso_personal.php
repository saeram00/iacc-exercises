<!DOCTYPE html>
<html>

<head>
    <title>Acceso Personal</title>
    <script>
        var g = {
            root_url: "../formtools",
            error_colours: ["ffbfbf", "ffb5b5"],
            notify_colours: ["c6e2ff", "97c7ff"]
        };
    </script>
    <script src="../formtools/global/scripts/jquery.js"></script>
    <link href="../formtools/themes/default/css/smoothness/jquery-ui-1.8.6.custom.css" rel="stylesheet" type="text/css" />
    <script src="../formtools/themes/default/scripts/jquery-ui-1.8.6.custom.min.js"></script>
    <script src="../formtools/global/scripts/general.js"></script>
    <script src="../formtools/global/scripts/rsv.js"></script>
    <script src="../formtools/global/scripts/field_types.php"></script>
    <link rel="stylesheet" href="../formtools/global/css/field_types.php" type="text/css" />
    <script src="../formtools/global/codemirror/lib/codemirror.js"></script>
    <script src="../formtools/global/codemirror/mode/xml/xml.js"></script>
    <script src="../formtools/global/codemirror/mode/css/css.js"></script>
    <script src="../formtools/global/codemirror/mode/javascript/javascript.js"></script>
    <script src="../formtools/global/scripts/jquery-ui-timepicker-addon.js"></script>
    <link rel="stylesheet" href="../formtools/global/codemirror/lib/codemirror.css" type="text/css" />
    <script src="../formtools/global/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <link rel="stylesheet" href="../formtools/global/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
    <script src="../formtools/modules/field_type_file/scripts/standalone.js?v=2.2.3"></script>
    <script>
        if (typeof g.messages == 'undefined')
            g.messages = {};

        g.messages["confirm_delete_submission_file"] = "¿Seguro que quieres eliminar este archivo?";
        g.messages["confirm_delete_submission_files"] = "¿Estás seguro de que quieres eliminar estos archivos?";
        g.messages["phrase_please_confirm"] = "Por favor confirmar";
        g.messages["word_yes"] = "Sí";
        g.messages["word_no"] = "No";
    </script>
    <script src="../formtools/modules/field_type_tinymce/tinymce/tinymce.min.js"></script>
    <link type="text/css" rel="stylesheet" href="../formtools/modules/form_builder/form_resources/css.php?resource_id=1&nocache=1748299631&published_form_id=1">
</head>

<body>
    <div class="ts_page" style="width:900px">
        <div class="ts_content">
            <div class="ts_content_inner">

                <script>
                    function fb_validate(f, error_info) {
                        if (!error_info.length) {
                            return true;
                        }
                        var first_el = null;
                        var error_str = "<ul>";
                        for (var i = 0; i < error_info.length; i++) {
                            error_str += "<li>" + error_info[i][1] + "</li>";
                            if (first_el == null) {
                                first_el = error_info[i][0];
                            }
                        }
                        error_str += "</ul>";

                        ft.create_dialog({
                            title: "Error de validación",
                            popup_type: "error",
                            width: 450,
                            content: error_str,
                            buttons: [{
                                text: "Cerrar",
                                click: function() {
                                    $(this).dialog("close");
                                    $(first_el).focus().select();
                                }
                            }]
                        })

                        return false;
                    }
                    $(function() {
                        $("#ts_form_element_id").bind("submit", function() {
                            return rsv.validate(this, rules);
                        });
                        rsv.customErrorHandler = fb_validate;
                    });
                    var rules = [];
                    rules.push("required,username,Por favor, introduzca un valor para el <b> { $ campo} </ b>.");
                    rules.push("required,passwd,Por favor, introduzca un valor para el <b> { $ campo} </ b>.")
                </script>
                <ul id="css_nav" class="nav_1_pages">
                    <li class="css_nav_current_page">Acceso Personal</li>

                </ul>


                <h2>Acceso Personal</h2>




                <form action="acceso_personal.php" method="post" enctype="multipart/form-data"
                    id="ts_form_element_id" name="edit_submission_form">
                    <input type="hidden" id="form_tools_published_form_id" value="1" />

                    <a name="s4"></a>
                    <h3>Fields</h3>

                    <table class="table_1" cellpadding="1" cellspacing="1" border="0" width="798">

                        <tr>
                            <td width="180" valign="top">
                                Usuario
                                <span class="req">*</span>
                            </td>
                            <td class="answer" valign="top">
                                <div class="pad_left">
                                    <input type="text" name="username" value="" class="cf_size_medium" />

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="180" valign="top">
                                Contraseña
                                <span class="req">*</span>
                            </td>
                            <td class="answer" valign="top">
                                <div class="pad_left">
                                    <input type="password" name="passwd" value="" class="cf_password" />

                                </div>
                            </td>
                        </tr>


                    </table>



                    <div class="ts_continue_button">
                        <input type="submit" name="form_tools_continue" value="Continue" />
                    </div>


                </form>

            </div>
        </div>
    </div>

</body>

</html>