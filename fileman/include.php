<script type="text/javascript" src="js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<button class="btn btn-default" id="addupload" onclick='galleryforms()'>Add Gallery</button>
<input type="hidden" id="max_num_gallery" value=''>

<div class="row" id='uploadarea_gallery' >
<br>
</div>
<button class="btn btn-default" id="addupload" onclick='coverforms()'>Add cover</button>
<input type="hidden" id="max_num_cover" value=''>
<input type="hidden" id="selected_form_cover" value=''>
<div class="row" id='uploadarea_cover' >
<br>
</div>
<input type="hidden" id="selected_form_type" value=''>
<input type="hidden" id="selected_form_number" value=''>
</div>
</div>
</div>							
<div class="modal fade" tabindex="-1" role="dialog" id="uploadmodal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <iframe src="http://localhost/roxyfileman2/index.php?type=image&key=68" style="width:100%;height:100%" frameborder="0"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
							
							
                            <script>
							function galleryforms(){
								var number = $(".img_upload_gallery").length;								
								var id = 'image_gallery_area_' + number ;								
								$("#uploadarea_gallery").append(
								"<div class='col-md-3' id='form_gallery_"+number+"'><div class='panel panel-default'>"+
								"<input type='hidden' id='img_gallery_old_"+number+"' name='img_gallery_old_"+number+"' value=''>"+
								"<input type='hidden' id='img_gallery_"+number+"' name='img_gallery_"+number+"' value=''>"+
								"<img src='http://vignette3.wikia.nocookie.net/lego/images/a/ac/No-Image-Basic.png/revision/latest?cb=20130819001030' id="+id+"  class='img panel-body img_upload_gallery' style='width:70%; height:auto;' ><div class='panel-footer'>"+
								"<a href='javascript:opengalleryform("+number+")' class='btn btn-default btn-block'>Select Image</a>"+
								"<a href='javascript:removegalleryforms("+number+")' class='btn btn-default btn-block'>Remove</a></div>");
								$("#max_num_gallery").val(number);
								
							}
														
							function removegalleryforms(num){							
								$("#form_gallery_"+num).remove();							
							}
                                function opengalleryform(number) {
                                    $('#uploadmodal').modal('show');
									$("#selected_form_type").val('gallery');												
									$("#selected_form_number").val(number);												
                                }
								function selected_number(){
										var no = $("#selected_form_number").val();																		
										return no;																		
								}
                                

									
                            
							function coverforms(){
								var number = $(".img_upload_cover").length;								
								var id = 'image_cover_area_' + number ;								
								$("#uploadarea_cover").append(
								"<div class='col-md-3' id='form_cover_"+number+"'><div class='panel panel-default'>"+
								"<input type='hidden' id='img_cover_old_"+number+"' name='img_cover_old_"+number+"' value=''>"+
								"<input type='hidden' id='img_cover_"+number+"' name='img_cover_"+number+"' value=''>"+
								"<img src='http://vignette3.wikia.nocookie.net/lego/images/a/ac/No-Image-Basic.png/revision/latest?cb=20130819001030' id="+id+"  class='img panel-body img_upload_cover' style='width:70%; height:auto;' ><div class='panel-footer'>"+
								"<a href='javascript:opencoverform("+number+")' class='btn btn-default btn-block'>Select Image</a>"+
								"<a href='javascript:removecoverforms("+number+")' class='btn btn-default btn-block'>Remove</a></div>");
								$("#max_num_cover").val(number);
								
							}
														
							function removecoverforms(num){							
								$("#form_cover_"+num).remove();							
							}
                                function opencoverform(number) {
                                    $('#uploadmodal').modal('show');
									$("#selected_form_type").val('cover');												
									$("#selected_form_number").val(number);											
                                }
								function selected_number(){
										var no = $("#selected_form_number").val();																		
										return no;																		
								}
								function selected_type(){
										var no = $("#selected_form_type").val();																		
										return no;																		
								}
                               
								function closeModal() {
                                    $('#uploadmodal').modal('hide');									
                                }
									
                            </script>
							