
<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom.min.js"></script>

<script type="text/javascript" src="js/bootstrap.min.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<a href="javascript:openCustomRoxy()"><img src="http://www.roxyfileman.com/fileman/Uploads/national-geographic-1.jpg" id="customRoxyImage" style="max-width:650px;"></a>
                            <div id="roxyCustomPanel" style="display: none;">
                                <iframe src="http://localhost/roxyfileman2/index.php?type=image&key=68" style="width:100%;height:100%" frameborder="0"></iframe>
                            </div>
                            <script>
                                function openCustomRoxy() {
                                    $('#roxyCustomPanel').dialog({modal: true, width: 875, height: 600});
                                }
                                function closeCustomRoxy() {
                                    $('#roxyCustomPanel').dialog('close');
                                }
								function FileSelected(file) {
            /**
             * file is an object containing following properties:
             * 
             * fullPath - path to the file - absolute from your site root
             * path - directory in which the file is located - absolute from your site root
             * size - size of the file in bytes
             * time - timestamo of last modification
             * name - file name
             * ext - file extension
             * width - if the file is image, this will be the width of the original image, 0 otherwise
             * height - if the file is image, this will be the height of the original image, 0 otherwise
             * 
             */
            $(window.parent.document).find('#customRoxyImage').attr('src', file.fullPath);
            window.parent.closeCustomRoxy();
        }
                            </script>
							
							