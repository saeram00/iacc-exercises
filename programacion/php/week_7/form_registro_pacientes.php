<!DOCTYPE html>
<html>

<head>
    <title>Registro Pacientes</title>
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
    <link type="text/css" rel="stylesheet" href="../formtools/modules/form_builder/form_resources/css.php?resource_id=1&nocache=1748301060&published_form_id=2">
</head>

<body>
    <div class="ts_page" style="width:900px">
        <div class="ts_header">
            <h1>Registro Pacientes</h1>
        </div>
        <div class="ts_content">
            <div class="ts_content_inner">

                <ul id="css_nav" class="nav_2_pages">
                    <li class="css_nav_current_page">Registro Pacientes</li>
                    <li>Review</li>

                </ul>


                <h2>Registro Pacientes</h2>




                <form action="registro_usuarios.php" method="post" enctype="multipart/form-data"
                    id="ts_form_element_id" name="edit_submission_form">
                    <input type="hidden" id="form_tools_published_form_id" value="2" />

                    <a name="s6"></a>
                    <h3>Fields</h3>

                    <table class="table_1" cellpadding="1" cellspacing="1" border="0" width="798">

                        <tr>
                            <td width="180" valign="top">
                                Nombre
                                <span class="req"></span>
                            </td>
                            <td class="answer" valign="top">
                                <div class="pad_left">
                                    <input type="text" name="nombre" value="" class="cf_size_medium" />

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="180" valign="top">
                                Apellido
                                <span class="req"></span>
                            </td>
                            <td class="answer" valign="top">
                                <div class="pad_left">
                                    <input type="text" name="apellido" value="" class="cf_size_medium" />

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="180" valign="top">
                                RUT
                                <span class="req"></span>
                            </td>
                            <td class="answer" valign="top">
                                <div class="pad_left">
                                    <input type="text" name="rut" value="" class="cf_size_medium" />

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="180" valign="top">
                                Sexo
                                <span class="req"></span>
                            </td>
                            <td class="answer" valign="top">
                                <div class="pad_left">

                                    <div class="cf_option_list_group_label">Sexo</div>

                                    <input type="radio" name="sexo" id="sexo_1" value="masculino" />
                                    <label for="sexo_1">Masculino</label>

                                    <input type="radio" name="sexo" id="sexo_2" value="femenino" />
                                    <label for="sexo_2">Femenino</label>

                                    <input type="radio" name="sexo" id="sexo_3" value="otro" />
                                    <label for="sexo_3">Otro</label>





                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="180" valign="top">
                                Dirección
                                <span class="req"></span>
                            </td>
                            <td class="answer" valign="top">
                                <div class="pad_left">


                                    <textarea name="direccion" id="direccion_id" class="cf_size_small"></textarea>



                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="180" valign="top">
                                Teléfono
                                <span class="req"></span>
                            </td>
                            <td class="answer" valign="top">
                                <div class="pad_left">
                                    (<input type="text" name="telefono_1" value="" size="3" maxlength="3" />) <input type="text" name="telefono_2" value="" size="3" maxlength="3" />-<input type="text" name="telefono_3" value="" size="4" maxlength="4" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="180" valign="top">
                                Correo
                                <span class="req"></span>
                            </td>
                            <td class="answer" valign="top">
                                <div class="pad_left">
                                    <input type="text" name="correo" value="" class="cf_size_medium" />

                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="180" valign="top">
                                Motivo de consulta
                                <span class="req"></span>
                            </td>
                            <td class="answer" valign="top">
                                <div class="pad_left">


                                    <textarea name="consulta" id="consulta_id" class="cf_size_small"></textarea>



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