  function adddocument(id) {
                                           // alert(id);
                                            var chno = $('#lastid' + id).val();
                                            chno++;
                                            $('#lastid' + id).val(chno);
                                            var data1 = '<div class="row" id="deleteanswer' + chno + '"><div class="col-md-3 mb-3" > <label>Type</label>';
                                            data1 += ' <select class="form-control"  name="type[]" id="type'+chno+'">  <option value="2">Video</option> <option value="3">Audio</option> </select>';
                                            data1 += '</div>';
                                            data1 += '<div class="col-md-3 mb-3" style="margin-top: 30px;" id="test'+chno+'">  <input type="hidden" name="filepath[]" id="filepath'+chno+'" > <input type="file" class="form-control-file" name="upload['+chno+']" id="upload'+chno+'"  placeholder="Upload Document"   ><a  id="uploadfiles'+chno+'"  ></a> <div id="filelist'+chno+'" class="cb"> </div><div class="lds-ellipsis" id="loadingimg'+chno+'" style="display: none;"><div></div><div></div><div></div><div></div></div> <span id="tick'+chno+'" style="display: none;">&#10003;</span></div>';
                                            data1 += '<div class="col-md-3" style="margin-top: 30px;"><button class="btn btn-danger btn-sm rem-icon"  onclick="deleteanswer(' + chno + ');"><i class="fa fa-trash"></i></button></div>';
                                            data1 += '</div>';
                                            data1 += '</div>';
                                            
                                             $("#document_div" + id).append(data1);
                                             
                                              $(document).ready(function () {
                                                        plUploadFn(chno);
                                             });
                                        }
                                         function deleteanswer(id) {
                                            $('#deleteanswer' + id).remove();
                                        }
 
                              $(document).ready(function () {
 


                                        function deleteanswer(id) {
                                            $('#deleteanswer' + id).remove();
                                        }
                                       // $(document).ready(function () {
                                            $("#versionupdate").change(function () {
                                                var id = $("#versionupdate").val();
                                                if (id == 1) {
                                                    $('#update_version').hide();
                                                    location.reload();
                                                } else {
                                                    $('#update_version').show();
                                                    $('#docdetails').html('');
                                                    // var id=$('#id').val();
                                                    //var pageid=$('#page_id').val();
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: base_url+'Upload/getdocdata',
                                                        data: 'type=update',
                                                        success: function (data) {
                                                            $('#docdetails').html(data);
                                                            // alert(data);
                                                            // alert("Note Created Successfully ");

                                                        }
                                                    });
                                                }
                                            });
                                            $("#docdetails").change(function () {
                                                var docid = $("#docdetails").val();
                                                $.ajax({
                                                    type: 'POST',
                                                    url: base_url+'Upload/getinddocdata',
                                                    data: 'documentid=' + docid,
                                                    success: function (data) {
                                                        //$('#docdetails').html(data);
                                                        // alert(data);
                                                        var result = data.split('~');
                                                        // alert(result[0]);
                                                        $('#docid').val(result[0]);
                                                        $('#language_id').val(result[1]);
                                                        $('#title').val(result[2]);
                                                        $('#description').val(result[3]);
                                                        $('#keywords').val(result[4]);
                                                        //$('#keywords').val(result[4]);
                                                        // alert("Note Created Successfully ");
                                                    }
                                                });
                                            });
                                            $("#skill_id").change(function () {
                                                var skillid = $("#skill_id").val();
                                                $('#lesson_id').html('');
                                                $.ajax({
                                                    type: 'POST',
                                                    url: base_url+'Skill/getskilldata',
                                                    data: 'skillid=' + skillid,
                                                    success: function (result) {
                                                        $('#lesson_id').html(result);
                                                    }
                                                });
                                            });
                                     });