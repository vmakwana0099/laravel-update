"use strict";
var MediaManager = function() {
    return {
        open: function(id, recordId = false) {
            if (id != null) {
                $('#data_id').val(id);
                $('#recordId').val(recordId);
                MediaManager.init();
            } else {
                alert('Missing 1 parameter');
                return false;
            }
        },
        openVideoManager: function(id, recordId = false) {
            if (id != null) {
                $('#data_id').val(id);
                $('#videoRecordId').val(recordId);
            } else {
                openAlertDialogForVideo('Missing 1 parameter');
            }
        },
        openDocumentManager: function(id) {
            if (id != null) {
                $('#control_id').val(id);
            } else {
                openAlertDialogForDocument('Missing 1 parameter');
            }
        },
        setImageUploadTab: function() {
            $('.file_upload').show();
            $('.user_uploaded').hide();
            $('.image_html').hide();
            $('.trashed_images').hide();
            $('.recent_uploads').hide();
            $('.insert_from_url').hide();
            $('input[name="imageName"]').addClass('hide');
            $.ajax({
                type: "POST",
                cache: true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: site_url + '/powerpanel/media/set_image_html',
                dataType: "html",
                success: function(data) {
                    $('.file_upload').html(data);
                    MediaManager.imageUploadEngine();
                },
                error: function(xhr, ajaxOptions, thrownError) {},
                async: true
            });
        },
        imageUploadEngine: function() {
            var maxfilesexceeded = false;
            var image_id = false;
            var success = false;
            $("#my-dropzone").dropzone({
                acceptedFiles: "image/*",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: site_url + '/powerpanel/media/upload_image',
                maxFiles: 15, // Number of files at a time
                maxFilesize: 10, //in MB
                clickable: true,
                maxfilesexceeded: function(file) 
                {  
                    maxfilesexceeded = true;
                    return false;
                },
                success: function(response) {
                    //App.initSlimScroll('.scroller');
                    image_id = response.xhr.response;
                    if (response.status == "success") {
                        success = true;
                    }
                },
                queuecomplete: function(file) 
                {
                    if (success) {
                        if (maxfilesexceeded) 
                        {
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "positionClass": "toast-top-right",
                                "onclick": null,
                                "showDuration": "1000",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                            toastr.error("Only 15 images are uploaded others are not uploaded");

                        } else {
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "positionClass": "toast-top-right",
                                "onclick": null,
                                "showDuration": "1000",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                            toastr.success("Images are successfully uploaded.");
                            MediaManager.setMyUploadTab(window.user_id, image_id);
                        }
                    }
                },
                removedfile: function(file) {
                    var _ref; // Remove file on clicking the 'Remove file' button
                    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                },
            });
        },
        setInsertImageFromUrlTab: function() {
            $('.file_upload').hide();
            $('.image_html').hide();
            $('.user_uploaded').hide();
            $('.trashed_images').hide();
            $('.recent_uploads').hide();
            var html = '<div class="title_section"><h2>Insert from Url</h2></div>\n\
													<div class="portlet light">\n\
													<div class="row">\n\
																					<div class="col-md-12">\n\
																					<div class="form-group form-md-line-input form-md-floating-label has-info">\n\
																													<input type="text" class="form-control input-lg image_url" id="form_control_1">\n\
																													<span class="help-block thrownError" style="color:red"></span>\n\
																													<label for="form_control_1">Enter Image URL</label>\n\
																					 </div>\n\
																													<a href="javascript:void(0);" onclick="MediaManager.insertImageFromUrl()" class="btn btn-green-drake">Upload Image</a>\n\
													</div>\n\
													<br/>\n\
													<div class="uploaded_image"></div>\n\
													</div>\n\
													</div>\n\
													</div>';
            $('.insert_from_url').show();
            $('.insert_from_url').html(html);
        },
        setMyUploadTab: function(userid, image_id = false) {
            $('.tab_6_3 ul li a').removeClass('active');
            $('#user_uploaded_image').addClass('active');
            $('.loader').show();
            $.ajax({
                type: "POST",
                cache: true,
                url: site_url + '/powerpanel/media/user_uploaded_image',
                dataType: "json",
                data: {
                    'userid': userid
                },
                success: function(data) {
                    $('.loader').hide();
                    var lastPopedPopover;
                    $('.popovers').popover();
                    // close last displayed popover
                    $(document).on('click.bs.popover.data-api', function(e) {
                        if (lastPopedPopover) {
                            lastPopedPopover.popover('hide');
                        }
                    });
                    $('.file_upload').hide();
                    $('.image_html').hide();
                    $('.insert_from_url').hide();
                    $('.trashed_images').hide();
                    $('.recent_uploads').hide();
                    $('.tab_6_4').show();
                    $('.user_uploaded').show();
                    $('.user_uploaded').html(data.Image_html);
                    var multiple_selection = $('.multiple-selection').data('multiple');
                    if (multiple_selection == false || multiple_selection == undefined) {
                        $('#note').text('Please select the image and click on "Insert Media" button to proceed. You can insert only one image.');
                    } else {
                        $('#note').text('Please select the image and click on "Insert Media" button to proceed.');
                    }
                    if (image_id != false) {
                        var imgIDs = image_id;
                    } else {
                        var imgIDs = $('input[name="img_id"]').val();
                    }
                    MediaManager.selectImage(imgIDs);
                    $('input[name="imageName"]').removeClass('hide')
                    $('input[name="imageName"]').keyup(function() {
                        if( ($(this).val().length % 3) == 0){
                        var imageName = $(this).val();
                        MediaManager.searchByImageName(imageName);
                      }
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {},
                async: true
            });
        },
        getMoreImages: function(user_id) {
            var track_page = parseInt($('#page').val()) + 1;
            $('.loader').show();
            $.ajax({
                type: "POST",
                cache: true,
                url: site_url + '/powerpanel/media/load_more_images/' + user_id,
                dataType: "json",
                data: {
                    'page': track_page,
                },
                success: function(data) {
                    $('.loader').hide();
                    var response = data;
                    $('#append_user_image').append(response.image_box);
                    $('#page').val(track_page);
                    if (response.image_box == "") {
                        $('#load_more_images').css('display', 'none');
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "positionClass": "toast-top-right",
                            "onclick": null,
                            "showDuration": "1000",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        toastr.error("No More Images are available.");
                    }
                    var imgIDs = $('input[name="img_id"]').val();
                    MediaManager.selectImage(imgIDs);
                },
                error: function(xhr, ajaxOptions, thrownError) {},
                async: true
            });
        },
        searchByImageName: function(imageName = false, image_id = false) {
            $('.loader').show();
            $.ajax({
                type: "POST",
                cache: true,
                url: site_url + '/powerpanel/media/user_uploaded_image',
                dataType: "JSON",
                data: {
                    'userid': window.user_id,
                    'imageName': imageName
                },
                success: function(data) {
                    //  alert(data.Image_html);
                    $('.loader').hide();
                    var lastPopedPopover;
                    $('.popovers').popover();
                    // close last displayed popover
                    $(document).on('click.bs.popover.data-api', function(e) {
                        if (lastPopedPopover) {
                            lastPopedPopover.popover('hide');
                        }
                    });
                    $('.file_upload').hide();
                    $('.image_html').hide();
                    $('.insert_from_url').hide();
                    $('.trashed_images').hide();
                    $('.recent_uploads').hide();
                    $('.tab_6_4').show();
                    $('.user_uploaded').show();                    
                    $('.user_uploaded').html(data.Image_html);
                    var multiple_selection = $('.multiple-selection').data('multiple');
                    if (multiple_selection == false || multiple_selection == undefined) {
                        $('#note').text('Please select the image and click on "Insert Media" button to proceed. You can insert only one image.');
                    } else {
                        $('#note').text('Please select the image and click on "Insert Media" button to proceed.');
                    }
                    if (image_id != false) {
                        var imgIDs = image_id;
                    } else {
                        var imgIDs = $('input[name="img_id"]').val();
                    }
                    MediaManager.selectImage(imgIDs);
                },
                error: function(xhr, ajaxOptions, thrownError) {},
                async: true
            });
        },
        searchByDocName: function(docName = false, doc_id = false) {
            $('.loader').show();
            $.ajax({
                type: "POST",
                cache: true,
                url: site_url + '/powerpanel/media/user_uploaded_docs',
                dataType: "HTML",
                data: {
                    'userid': window.user_id,
                    'docName': docName
                },
                success: function(data) {
                    $('.loader').hide();
                    var lastPopedPopover;
                    $('.popovers').popover();
                    // close last displayed popover
                    $(document).on('click.bs.popover.data-api', function(e) {
                        if (lastPopedPopover) {
                            lastPopedPopover.popover('hide');
                        }
                    });
                    $('.docs_upload').hide();
                    $('.docs_html').hide();
                    $('.trashed_docs').hide();
                    $('.tab_6_4').show();
                    $('.user_uploaded_docs').show();
                    $('.user_uploaded_docs').html(data);
                    var multiple_selection = $('.multiple-selection').data('multiple');
                    if (multiple_selection == false || multiple_selection == undefined) {
                        $('#note').text('Please select the document and click on "Insert Media" button to proceed. You can insert only one document.');
                    } else {
                        $('#note').text('Please select the document(s) and click on "Insert Media" button to proceed.');
                    }
                    if (doc_id != false) {
                        var docIDs = doc_id;
                    } else {
                        var docIDs = $('input[name="doc_id"]').val();
                    }
                    MediaManager.selectDocument(docIDs);
                },
                error: function(xhr, ajaxOptions, thrownError) {},
                async: true
            });
        },
        selectImage: function(image_id) {
            if (image_id != null && image_id != '' && image_id != false) {
                var imgIDArr = [];
                imgIDArr = image_id.toString().split(',');
                //alert(imgIDArr);
                if (imgIDArr.length > 1) {
                    //alert(imgIDArr.length);
                    var multiple_selection = $('.multiple-selection').data('multiple');
                    if (multiple_selection == true) {
                        $.each(imgIDArr, function(index, value) {
                            $('#media_' + value).addClass('img-box-active');
                            $('#media_' + value + ' a i').addClass('icon-check icons');
                            var selected_image_count = $('.img-box-active').length;
                            var multiple_selection = $('.multiple-selection').data('multiple');
                            if (selected_image_count > 1 && (multiple_selection == false || multiple_selection == undefined)) {
                                $('#insert_image').hide();
                            } else {
                                $('#insert_image').show();
                            }
                        });
                    }
                } else {
                    if ($('#media_' + image_id + '').hasClass('img-box-active')) {
                        $('#media_' + image_id).removeClass('img-box-active');
                        $('#media_' + image_id + ' a i').removeClass('icon-check icons');
                    } else {
                        $('#media_' + image_id).addClass('img-box-active');
                        $('#media_' + image_id + ' a i').addClass('icon-check icons');
                    }
                    var selected_image_count = $('.img-box-active').length;
                    var multiple_selection = $('.multiple-selection').data('multiple');
                    if (selected_image_count > 1 && (multiple_selection == undefined || multiple_selection == false)) {
                        $('#insert_image').hide();
                    } else {
                        $('#insert_image').show();
                    }
                }
            }
        },
        selectVideo: function(video_id) {
            if (video_id != null && video_id != '' && video_id != false) {
                var vidIDArr = [];
                vidIDArr = video_id.toString().split(',');
                if (vidIDArr.length > 1) {
                    var multiple_selection = $('.multiple-selection').data('multiple');
                    if (multiple_selection == true) {
                        $.each(vidIDArr, function(index, value) {
                            $('#video_' + value).addClass('active_video');
                            $('#video_' + value + ' a i').addClass('icon-check icons');
                            var selected_video_count = $('.active_video').length;
                            var multiple_selection = $('.multiple-selection').data('multiple');
                            if (selected_video_count > 1 && (multiple_selection == false || multiple_selection == undefined)) {
                                $('#insert_video').hide();
                            } else {
                                $('#insert_video').show();
                            }
                        });
                    }
                } else {
                    if ($('#video_' + video_id + '').hasClass('active_video')) {
                        $('#video_' + video_id).removeClass('active_video');
                        $('#video_' + video_id + ' a i').removeClass('icon-check icons');
                    } else {
                        $('#video_' + video_id).addClass('active_video');
                        $('#video_' + video_id + ' a i').addClass('icon-check icons');
                    }
                    var selected_video_count = $('.img-box-active').length;
                    var multiple_selection = $('.multiple-selection').data('multiple');
                    if (selected_video_count > 1 && (multiple_selection == undefined || multiple_selection == false)) {
                        $('#insert_video').hide();
                    } else {
                        $('#insert_video').show();
                    }
                    // var selected_video_count = $('.active_video').length;
                    // if (selected_video_count > 1) {
                    //          $('.user_uploaded_video #insert_video').hide();
                    // } else {
                    //          $('.user_uploaded_video #insert_video').show();
                    // }
                }
            }
        },
        selectRecentUploadImage: function(image_id = false) {
            if (image_id != null) {
                var imgIDArr = image_id.toString().split(',');
                if (imgIDArr.length > 1) {
                    var multiple_selection = $('.multiple-selection').data('multiple');
                    if (multiple_selection == true) {
                        $.each(imgIDArr, function(index, value) {
                            $('#recent_upload_images #media_' + value).addClass('img-box-active');
                            $('#recent_upload_images #media_' + value + ' a i').addClass('icon-check icons');
                            var selected_image_count = $('#recent_upload_images .img-box-active').length;
                            var multiple_selection = $('.multiple-selection').data('multiple');
                            if (selected_image_count > 1 && (multiple_selection == false || multiple_selection == undefined)) {
                                $('.recent_uploads #insert_image').hide();
                            } else {
                                $('.recent_uploads #insert_image').show();
                            }
                        });
                    }
                } else {
                    if ($('#recent_upload_images #media_' + image_id + '').hasClass('img-box-active')) {
                        $('#recent_upload_images #media_' + image_id).removeClass('img-box-active');
                        $('#recent_upload_images #media_' + image_id + ' a i').removeClass('icon-check icons');
                    } else {
                        $('#recent_upload_images #media_' + image_id).addClass('img-box-active');
                        $('#recent_upload_images #media_' + image_id + ' a i').addClass('icon-check icons');
                    }
                    var selected_image_count = $('#recent_upload_images .img-box-active').length;
                    var multiple_selection = $('.multiple-selection').data('multiple');
                    if (selected_image_count > 1 && (multiple_selection == false || multiple_selection == undefined)) {
                        $('.recent_uploads #insert_image').hide();
                    } else {
                        $('.recent_uploads #insert_image').show();
                    }
                }
            }
        },
        selectDocument: function(doc_id) {
            if (doc_id != null && doc_id != '' && doc_id != false) {
                var docIDArr = [];
                docIDArr = doc_id.toString().split(',');
                if (docIDArr.length > 1) {
                    var multiple_selection = $('.multiple-selection').data('multiple');
                    if (multiple_selection == true) {
                        $.each(docIDArr, function(index, value) {
                            $('#document_' + value).addClass('document-box-active');
                            $('#document_' + value + ' a i').addClass('icon-check icons');
                            var selected_image_count = $('.document-box-active').length;
                            var multiple_selection = $('.multiple-selection').data('multiple');
                            if (selected_image_count > 1 && (multiple_selection == false || multiple_selection == undefined)) {
                                $('#insert_document').hide();
                            } else {
                                $('#insert_document').show();
                            }
                        });
                    }
                } else {
                    if ($('#document_' + doc_id + '').hasClass('document-box-active')) {
                        $('#document_' + doc_id).removeClass('document-box-active');
                        $('#document_' + doc_id + ' a i').removeClass('icon-check icons');
                    } else {
                        $('#document_' + doc_id).addClass('document-box-active');
                        $('#document_' + doc_id + ' a i').addClass('icon-check icons');
                    }
                    var selected_image_count = $('.document-box-active').length;
                    var multiple_selection = $('.multiple-selection').data('multiple');
                    if (selected_image_count > 1 && (multiple_selection == undefined || multiple_selection == false)) {
                        $('#insert_document').hide();
                    } else {
                        $('#insert_document').show();
                    }
                }
            }
        },
        removeImage: function(image_id) {
            $('.loader').show();
            var response = confirm("Are you sure you want to delete this image?");
            if (response) {
                $.ajax({
                    type: "POST",
                    cache: true,
                    url: site_url + '/powerpanel/media/remove_image',
                    data: {
                        'image_id': image_id
                    },
                    success: function(data) {
                        $('.loader').hide();
                        if (data) {
                            $('#media_' + image_id).remove();
                        }
                        var imgIDs = $('input[name="img_id"]').val();
                        MediaManager.selectImage(imgIDs);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(thrownError);
                    },
                    async: true
                });
            } else {
                return false;
            }
        },
        insertMedia: function() {
            if ($('.contains_thumb').hasClass('img-box-active')) {
                var multiple_selection = $('.multiple-selection').data('multiple');
                if (multiple_selection == true) {
                    var imgIds = [];
                    var imgSRC = '';
                    imgSRC += '<div class="multi_image_list"><ul>';
                    $('.img-box-active').each(function(index) {
                        var image_id = $(this).attr('id');
                        var id = image_id.split('_');
                        var imageURL = $(this).find('img').attr('src');
                        imgIds.push(id[1]);
                        imgSRC += '<li id="' + id[1] + '">\n\
																																																																				<span>\n\
																																																																								<img src="' + imageURL + '" />\n\
																																																																								<a href="javascript:;" onclick="MediaManager.removeImageFromGallery(' + id[1] + ');" class="delect_image" data-dismiss="fileinput"><i class="fa fa-times"></i></a>\n\
																																																																				</span>\n\
																																																																</li>';
                        $('#image_url').val(imageURL);
                    });
                    imgSRC += '<ul></div>';
                    var data_id = $('#data_id').val();
                    $('#' + data_id).val(imgIds.join(','));
                    $('#' + data_id + '_img').html(imgSRC);
                } else {
                    var image_id = $('.img-box-active').attr('id');
                    var image = $('.img-box-active img').attr('src');
                    var id = image_id.split('_');
                    var data_id = $('#data_id').val();
                    var recordID = $('#recordId').val();
                    $('#' + data_id).val(id[1]);
                    $('.' + data_id + '_img').html('<img src="' + image + '" />');
                    /* for photo-gallery module  */
                    var image_source = $(".img-box-active #media_image_" + id[1]).data('image_big_source');
                    var image_name = $(".img-box-active #media_image_" + id[1]).data('image_title');
                    $('.image_' + recordID).val(id[1]);
                    $('.photo_gallery_' + recordID).html('<img src="' + image + '" />');
                    $('.image_iframe_' + recordID).attr('href', image_source);
                    $('.image_iframe_' + recordID).attr('title', image_name);
                    $('.image_gallery_change_' + recordID).attr('title', image_name);
                    /* for photo-gallery module */
                    $('#image_url').val(image);
                }
                /* for close portlet */
                var portlet = $('#gallary_component').closest(".portlet");
                if ($('body').hasClass('page-portlet-fullscreen')) {
                    $('body').removeClass('page-portlet-fullscreen');
                }
                if (portlet.hasClass('portlet-fullscreen')) {
                    portlet.removeClass('portlet-fullscreen');
                }
                portlet.find('.portlet-title .fullscreen').tooltip('destroy');
                portlet.find('.portlet-title > .tools > .reload').tooltip('destroy');
                portlet.find('.portlet-title > .tools > .remove').tooltip('destroy');
                portlet.find('.portlet-title > .tools > .config').tooltip('destroy');
                portlet.find('.portlet-title > .tools > .collapse, .portlet > .portlet-title > .tools > .expand').tooltip('destroy');
                portlet.hide();
                $('.removeimg').show();
                $('.image_thumb .overflow_layer').css('display', 'block');
            } else {
                openAlertDialogForImage('Please select the image and click on "Insert Media" button to proceed.');
            }
        },
        insertVideo: function() {
            if ($('.contains_thumb').hasClass('active_video')) {
                var multiple_selection = $('.multiple-selection').data('multiple');
                if (multiple_selection == true) {
                    // Multiplease video code
                    var imgIds = [];
                    var vidSRC = '';
                    vidSRC += '<div class="multi_image_list"><ul>';
                    $('.active_video').each(function(index) {
                        var video_id = $(this).attr('id');
                        var video_type = $('.active_video').data('video_type');
                        var video_source = $('.active_video').data('video_source');
                        var id = video_id.split('_');
                        var imageURL = $(this).find('img').attr('src');
                        //var video_thumb = $('.active_video img').attr('src');
                        var video_name = $('#' + video_id).data('video_name');
                        imgIds.push(id[1]);
                        vidSRC += '<li id="' + id[1] + '">\n\
																																																																<span>\n\
																																																																				<img src="' + imageURL + '" />\n\
																																																																				<a href="javascript:;" onclick="MediaManager.removeVideoFromVideoManager(' + id[1] + ');" class="delect_image" data-dismiss="fileinput"><i class="fa fa-times"></i></a>\n\
																																																																</span>\n\
																																																												</li>';
                        $('#video_url').val(imageURL);
                    });
                    vidSRC += '<ul></div>';
                    var data_id = $('#data_id').val();
                    $('#' + data_id).val(imgIds.join(','));
                    $('#' + data_id + '_vid').html(vidSRC);
                } else {
                    var video_id = $('.active_video').attr('id');
                    var video_type = $('.active_video').data('video_type');
                    var video_source = $('.active_video').data('video_source');
                    var id = video_id.split('_');
                    var data_id = $('#data_id').val();
                    var recordID = $('#videoRecordId').val();
                    $('#' + data_id).val(id[1]);
                    var video_name = $('#' + video_id).data('video_name');
                    $('#video_name').show();
                    $('#video_name').val(video_name);
                    /* for video-gallery module  */
                    var video_thumb = $('.active_video img').attr('src');
                    $('.video_' + recordID).val(id[1]);
                    $('.video_gallery_' + recordID).html('<img src="' + video_thumb + '" />');
                    if (video_type == 'youtube') {
                        var youtubeLink = 'http://www.youtube.com/embed/' + video_source + '?autoplay=1';
                        $('.video_iframe_' + recordID).attr('href', youtubeLink);
                    } else {
                        $('.video_iframe_' + recordID).attr('href', video_source);
                    }
                    $('.video_iframe_' + recordID).attr('title', video_name);
                    $('.video_gallery_change_' + recordID).attr('title', video_name);
                }
                /* for video-gallery module */
                /* for close portlet */
                var portlet = $('#video_component').closest(".portlet");
                if ($('body').hasClass('page-portlet-fullscreen')) {
                    $('body').removeClass('page-portlet-fullscreen');
                }
                if (portlet.hasClass('portlet-fullscreen')) {
                    portlet.removeClass('portlet-fullscreen');
                }
                portlet.find('.portlet-title .fullscreen').tooltip('destroy');
                portlet.find('.portlet-title > .tools > .reload').tooltip('destroy');
                portlet.find('.portlet-title > .tools > .remove').tooltip('destroy');
                portlet.find('.portlet-title > .tools > .config').tooltip('destroy');
                portlet.find('.portlet-title > .tools > .collapse, .portlet > .portlet-title > .tools > .expand').tooltip('destroy');
                portlet.hide();
            } else {
                openAlertDialogForVideo('Please select video');
            }
        },
        insertDocument: function() {
            if ($('.contains_thumb').hasClass('document-box-active')) {
                var multiple_selection = $('.multiple-selection').data('multiple');
                if (multiple_selection == true) {
                    var docsIds = [];
                    var docSRC = '';
                    docSRC += '<div class="multi_image_list" id="multi_document_list"><ul>';
                    $('.document-box-active').each(function() {
                        var doc_id = $(this).attr('id');
                        var id = doc_id.split('_');
                        var documentURL = $(this).find('img').attr('src');
                        docsIds.push(id[1]);
                        docSRC += '<li id="doc_' + id[1] + '">\n\
																																																																				<span>\n\
																																																																								<img src="' + documentURL + '" />\n\
																																																																								<a href="javascript:;" onclick="MediaManager.removeDocumentFromGallery(' + id[1] + ');" class="delect_image" data-dismiss="fileinput"><i class="fa fa-times"></i></a>\n\
																																																																				</span>\n\
																																																																</li>';
                    });
                    docSRC += '<ul></div>';
                    var data_id = $('#control_id').val();
                    $('#' + data_id).val(docsIds.join(','));
                    $('#' + data_id + '_documents').html(docSRC);
                } else {
                    var doc_id = $('.document-box-active').attr('id');
                    var image = $('.document-box-active img').attr('src');
                    var id = doc_id.split('_');
                    var data_id = $('#control_id').val();
                    $('#' + data_id).val(id[1]);
                    $('.' + data_id + '_documents').html('<img src="' + image + '" />');
                }
                /* for close portlet */
                var portlet = $('#document_component').closest(".portlet");
                if ($('body').hasClass('page-portlet-fullscreen')) {
                    $('body').removeClass('page-portlet-fullscreen');
                }
                if (portlet.hasClass('portlet-fullscreen')) {
                    portlet.removeClass('portlet-fullscreen');
                }
                portlet.find('.portlet-title .fullscreen').tooltip('destroy');
                portlet.find('.portlet-title > .tools > .reload').tooltip('destroy');
                portlet.find('.portlet-title > .tools > .remove').tooltip('destroy');
                portlet.find('.portlet-title > .tools > .config').tooltip('destroy');
                portlet.find('.portlet-title > .tools > .collapse, .portlet > .portlet-title > .tools > .expand').tooltip('destroy');
                portlet.hide();
            } else {
                openAlertDialogForDocument('Please select the image and click on "Insert Media" button to proceed.');
            }
        },
        setRecentUploadTab: function(userid) {
            $('.loader').show();
            $.ajax({
                type: "POST",
                cache: true,
                url: site_url + '/powerpanel/media/get_recent_uploaded_images',
                data: {
                    'user_id': userid
                },
                success: function(data) {
                    $('.loader').hide();
                    $('.file_upload').hide();
                    $('.image_html').hide();
                    $('.insert_from_url').hide();
                    $('.user_uploaded').hide();
                    $('.trashed_images').hide();
                    $('.recent_uploads').show();
                    $('input[name="imageName"]').addClass('hide');
                    $('.recent_uploads').html(data);
                    var multiple_selection = $('.multiple-selection').data('multiple');
                    if (multiple_selection == false || multiple_selection == undefined) {
                        $('#note').text('Please select the image and click on "Insert Media" button to proceed. You can insert only one image.');
                    } else {
                        $('#note').text('Please select the image and click on "Insert Media" button to proceed.');
                    }
                    var imgIDs = $('input[name="img_id"]').val();
                    MediaManager.selectRecentUploadImage(imgIDs);
                },
                error: function(xhr, ajaxOptions, thrownError) {},
                async: true
            });
        },
        setTrashedImageTab: function(userid) {
            $('.loader').show();
            $.ajax({
                type: "POST",
                cache: true,
                url: site_url + '/powerpanel/media/get_trash_images',
                data: {
                    'user_id': userid
                },
                success: function(data) {
                    $('.loader').hide();
                    $('.file_upload').hide();
                    $('.image_html').hide();
                    $('.insert_from_url').hide();
                    $('.user_uploaded').hide();
                    $('.recent_uploads').hide();
                    $('.trashed_images').show();
                    $('input[name="imageName"]').addClass('hide');
                    $('.trashed_images').html(data);
                },
                error: function(xhr, ajaxOptions, thrownError) {},
                async: true
            });
        },
        setTrashedVideoTab: function(userid) {
            $('.loader').show();
            $.ajax({
                type: "POST",
                cache: true,
                url: site_url + '/powerpanel/media/get_trash_videos',
                data: {
                    'user_id': userid
                },
                success: function(data) {
                    $('.loader').hide();
                    $('.video_upload').hide();
                    $('.image_html').hide();
                    $('.insert_video_from_url').hide();
                    $('.user_uploaded_video').hide();
                    $('.video_upload').hide();
                    $('.trashed_videos').show();
                    $('.trashed_videos').html(data);
                },
                error: function(xhr, ajaxOptions, thrownError) {},
                async: true
            });
        },
        setTrashedDocumentTab: function(userid) {
            $('.loader').show();
            $.ajax({
                type: "POST",
                cache: true,
                url: site_url + '/powerpanel/media/get_trash_documents',
                data: {
                    'user_id': userid
                },
                success: function(data) {
                    $('.loader').hide();
                    $('.docs_upload').hide();
                    $('.user_uploaded_docs').hide();
                    $('.docs_html').hide();
                    $('.trashed_docs').show();
                    $('input[name="docName"]').addClass('hide');
                    $('.trashed_docs').html(data);
                },
                error: function(xhr, ajaxOptions, thrownError) {},
                async: true
            });
        },
        insertImageFromUrl: function() {
            $('.loader').show();
            var image_url = $('.image_url').val();
            setTimeout(function() {
                $('.thrownError').text('');
            }, 5000);
            if (image_url.length > 0) {
                $.ajax({
                    type: "POST",
                    cache: true,
                    url: site_url + '/powerpanel/media/insert_image_by_url',
                    data: {
                        'url': image_url
                    },
                    success: function(data) {
                        $('.loader').hide();
                        var response = $.parseJSON(data);
                        if (response.error) {
                            $('.loader').hide();
                            $('.uploaded_image').html('');
                            $('.thrownError').text(response.error);
                        } else {
                            $('.thrownError').text('');
                            MediaManager.setMyUploadTab(window.user_id, response.image_id);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $('.loader').hide();
                    },
                    async: true
                });
            } else {
                $('.loader').hide();
                $('.thrownError').text('Please enter url');
                return false;
            }
        },
        removeMultipleImages: function(identity = false, ignore = false) {
            if ($('.contains_thumb').hasClass('img-box-active')) {
                $('.loader').show();
                if (identity == 'recent') {
                    var IDs = [];
                    $('#recent_upload_images .img-box-active').each(function() {
                        var class_with_id = $(this).attr('id').split('_');
                        IDs.push(class_with_id[1]);
                    });
                } else {
                    var IDs = [];
                    $('#append_user_image .img-box-active').each(function() {
                        var class_with_id = $(this).attr('id').split('_');
                        IDs.push(class_with_id[1]);
                    });
                }
                if ($('#append_image .img-box-active').length > 0) {
                    var IDs = [];
                    $('#append_image .img-box-active').each(function() {
                        var class_with_id = $(this).attr('id').split('_');
                        IDs.push(class_with_id[1]);
                    });
                }
                if (IDs) {
                    $.ajax({
                        type: "POST",
                        cache: true,
                        url: site_url + '/powerpanel/media/remove_multiple_image',
                        data: {
                            'idArr': IDs,
                            'identity': identity
                        },
                        success: function(data) {
                            $('.loader').hide();
                            if (identity == "recent") {
                                MediaManager.setRecentUploadTab(window.user_id);
                            } else {
                                MediaManager.setMyUploadTab(window.user_id);
                            }
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "positionClass": "toast-top-right",
                                "onclick": null,
                                "showDuration": "1000",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                            toastr.success("Images are removed successfully.");
                        },
                        error: function(xhr, ajaxOptions, thrownError) {},
                        async: true
                    });
                }
            }
        },
        checkImageInuse: function(type = false) {
            if (type == 'recent') {
                $('#deleteMediaImage .remove_multiple_images').val('recent');
                var IDs = [];
                $('#recent_upload_images .img-box-active').each(function() {
                    var class_with_id = $(this).attr('id').split('_');
                    IDs.push(class_with_id[1]);
                });
            } else {
                $('#deleteMediaImage .remove_multiple_images').val(null);
                var IDs = [];
                $('#append_user_image .img-box-active').each(function() {
                    var class_with_id = $(this).attr('id').split('_');
                    IDs.push(class_with_id[1]);
                });
            }
            if (IDs) {
                $.ajax({
                    type: "POST",
                    cache: true,
                    url: site_url + '/powerpanel/media/check-img-inuse',
                    data: {
                        'idArr': IDs
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.message) {
                            // $('#imgInUse').modal('show');
                            // $('#imgInUse #imgInUseMessage').text(data.message);
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "positionClass": "toast-top-right",
                                "onclick": null,
                                "showDuration": "1000",
                                "hideDuration": "2000",
                                "timeOut": "6000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                            toastr.warning(data.message);
                            var ignoreArr = [];
                            if (type == 'recent') {
                                $.each(data.usedImg, function(i, item) {
                                    $('#recent_upload_images #media_' + item.intFkImgId).addClass('img_assigned');
                                    var flag = $('<span class="flag_assigned">Assigned</span>');
                                    $('#recent_upload_images #media_' + item.intFkImgId + ' .flag_assigned').remove();
                                    $('#recent_upload_images #media_' + item.intFkImgId + ' .thumbnail').append(flag);
                                    ignoreArr.push(item.intFkImgId);
                                });
                            } else {
                                $.each(data.usedImg, function(i, item) {
                                    $('#append_user_image #media_' + item.intFkImgId).addClass('img_assigned');
                                    var flag = $('<span class="flag_assigned">Assigned</span>');
                                    $('#append_user_image #media_' + item.intFkImgId + ' .flag_assigned').remove();
                                    $('#append_user_image #media_' + item.intFkImgId + ' .thumbnail').append(flag);
                                    ignoreArr.push(item.intFkImgId);
                                });
                            }
                            // MediaManager.removeMultipleImages(false, ignoreArr);
                        } else {
                            $('#deleteMediaImage').modal('show');
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {},
                    async: true
                });
            }
        },
        checkDocumentInuse: function(type = false) {
            if (type == 'recent') {
                $('#deleteMediaDocument .remove_multiple_document').val('recent');
                var IDs = [];
                $('#recent_upload_images .document-box-active').each(function() {
                    var class_with_id = $(this).attr('id').split('_');
                    IDs.push(class_with_id[1]);
                });
            } else {
                $('#deleteMediaDocument .remove_multiple_document').val(null);
                var IDs = [];
                $('#append_user_image .document-box-active').each(function() {
                    var class_with_id = $(this).attr('id').split('_');
                    IDs.push(class_with_id[1]);
                });
            }
            if (IDs) {
                $.ajax({
                    type: "POST",
                    cache: true,
                    url: site_url + '/powerpanel/media/check-document-inuse',
                    data: {
                        'idArr': IDs
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.message) {
                            // $('#documentInUse').modal('show');
                            // $('#documentInUse #documentInUseMessage').text(data.message);
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "positionClass": "toast-top-right",
                                "onclick": null,
                                "showDuration": "1000",
                                "hideDuration": "2000",
                                "timeOut": "6000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                            toastr.warning(data.message);
                            var ignoreArr = [];
                            if (type == 'recent') {
                                $.each(data.usedDocument, function(i, item) {
                                    $('#append_user_image #document_' + item.intFkDocumentId).addClass('img_assigned');
                                    var flag = $('<span class="flag_assigned">Assigned</span>');
                                    $('#append_user_image #document_' + item.intFkDocumentId + ' .flag_assigned').remove();
                                    $('#append_user_image #document_' + item.intFkDocumentId + ' .thumbnail').append(flag);
                                    ignoreArr.push(item.intFkDocumentId);
                                });
                            } else {
                                $.each(data.usedDocument, function(i, item) {
                                    $('#append_user_image #document_' + item.intFkDocumentId).addClass('img_assigned');
                                    var flag = $('<span class="flag_assigned">Assigned</span>');
                                    $('#append_user_image #document_' + item.intFkDocumentId + ' .flag_assigned').remove();
                                    $('#append_user_image #document_' + item.intFkDocumentId + ' .thumbnail').append(flag);
                                    ignoreArr.push(item.intFkDocumentId);
                                });
                            }
                            // MediaManager.removeMultipleImages(false, ignoreArr);
                        } else {
                            $('#deleteMediaDocument').modal('show');
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {},
                    async: true
                });
            }
        },
        checkVideoInuse: function(type = false) {
            if (type == 'recent') {
                $('#permanentDeleteMediaVideo .remove_multiple_videos_permanently').val('recent');
                var IDs = [];
                $('#recent_upload_images .active_video').each(function() {
                    var class_with_id = $(this).attr('id').split('_');
                    IDs.push(class_with_id[1]);
                });
            } else {
                $('#permanentDeleteMediaVideo .remove_multiple_videos_permanently').val(null);
                var IDs = [];
                $('#append_user_image .active_video').each(function() {
                    var class_with_id = $(this).attr('id').split('_');
                    IDs.push(class_with_id[1]);
                });
            }
            if (IDs) {
                $.ajax({
                    type: "POST",
                    cache: true,
                    url: site_url + '/powerpanel/media/check-video-inuse',
                    data: {
                        'idArr': IDs
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.message) {
                            // $('#imgInUse').modal('show');
                            // $('#imgInUse #imgInUseMessage').text(data.message);
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "positionClass": "toast-top-right",
                                "onclick": null,
                                "showDuration": "1000",
                                "hideDuration": "2000",
                                "timeOut": "6000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                            toastr.warning(data.message);
                            var ignoreArr = [];
                            if (type == 'recent') {
                                $.each(data.usedVideo, function(i, item) {
                                    $('#recent_upload_images #video_' + item.intFkVideoId).addClass('img_assigned');
                                    var flag = $('<span class="flag_assigned">Assigned</span>');
                                    $('#recent_upload_images #video_' + item.intFkVideoId + ' .flag_assigned').remove();
                                    $('#recent_upload_images #video_' + item.intFkVideoId + ' .thumbnail').append(flag);
                                    ignoreArr.push(item.intFkVideoId);
                                });
                            } else {
                                $.each(data.usedVideo, function(i, item) {
                                    $('#append_user_image #video_' + item.intFkVideoId).addClass('img_assigned');
                                    var flag = $('<span class="flag_assigned">Assigned</span>');
                                    $('#append_user_image #video_' + item.intFkVideoId + ' .flag_assigned').remove();
                                    $('#append_user_image #video_' + item.intFkVideoId + ' .thumbnail').append(flag);
                                    ignoreArr.push(item.intFkVideoId);
                                });
                            }
                            // MediaManager.removeMultipleImages(false, ignoreArr);
                        } else {
                            $('#deleteMediaVideo').modal('show');
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {},
                    async: true
                });
            }
        },
        removeMultipleDocuments: function(identity = false) {
            if ($('.contains_thumb').hasClass('document-box-active')) {
                $('.loader').show();
                var IDs = [];
                $('.document-box-active').each(function() {
                    var class_with_id = $(this).attr('id').split('_');
                    $('#document_' + class_with_id[1]).remove();
                    IDs.push(class_with_id[1]);
                });
                if (IDs) {
                    $.ajax({
                        type: "POST",
                        cache: true,
                        url: site_url + '/powerpanel/media/remove_multiple_documents',
                        data: {
                            'idArr': IDs,
                            'identity': identity
                        },
                        success: function(data) {
                            $('.loader').hide();
                            if (identity == "recent") {
                                //recent_uploads(window.user_id);
                            } else {
                                MediaManager.setDocumentListTab(window.user_id);
                            }
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "positionClass": "toast-top-right",
                                "onclick": null,
                                "showDuration": "1000",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                            toastr.success("Document(s) are removed successfully.");
                        },
                        error: function(xhr, ajaxOptions, thrownError) {},
                        async: true
                    });
                }
            }
        },
        setMyUploadVideoTab: function() {
            $.ajax({
                type: "POST",
                cache: true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: site_url + '/powerpanel/media/set_video_html',
                dataType: "html",
                success: function(data) {
                    $('.tab_6_3 ul li a').removeClass('active');
                    $('#upload_video').addClass('active');
                    $('.insert_video_from_url').hide();
                    $('.video_upload').show();
                    $('.video_upload').html(data);
                    var maxfilesexceeded = false;
                    var image_id = false;
                    var success = false;
                    $("#my-dropzone-video").dropzone({
                        acceptedFiles: "video/*",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: site_url + '/powerpanel/media/upload_video',
                        maxFiles: 15, // Number of files at a time
                        maxFilesize: 10, //in MB
                        clickable: true,
                        maxfilesexceeded: function(file) {
                            maxfilesexceeded = true;
                        },
                        success: function(response) {
                            image_id = response.xhr.response;
                            if (response.status == "success") {
                                success = true;
                            }
                        },
                        queuecomplete: function(file) {
                            if (success) {
                                if (maxfilesexceeded) {
                                    toastr.options = {
                                        "closeButton": true,
                                        "debug": false,
                                        "positionClass": "toast-top-right",
                                        "onclick": null,
                                        "showDuration": "1000",
                                        "hideDuration": "1000",
                                        "timeOut": "5000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                    }
                                    toastr.error("Only 15 videos are uploaded others are not uploaded");
                                } else {
                                    toastr.options = {
                                        "closeButton": true,
                                        "debug": false,
                                        "positionClass": "toast-top-right",
                                        "onclick": null,
                                        "showDuration": "1000",
                                        "hideDuration": "1000",
                                        "timeOut": "5000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                    }
                                    toastr.success("Videos are successfully uploaded.");
                                    MediaManager.setMyVideosTab(window.user_id);
                                }
                            }
                        },
                        removedfile: function(file) {
                            var _ref; // Remove file on clicking the 'Remove file' button
                            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                        },
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {},
                async: true
            });
        },
        setMyVideosTab: function(userid, video_id = false) {
            $('.tab_6_3 ul li a').removeClass('active');
            $('#user_uploaded_video').addClass('active');
            $('.loader').show();
            $.ajax({
                type: "POST",
                cache: true,
                url: site_url + '/powerpanel/media/user_uploaded_video',
                dataType: "html",
                data: {
                    'userid': userid
                },
                success: function(data) {
                    $('.loader').hide();
                    var lastPopedPopover;
                    $('.popovers').popover();
                    // close last displayed popover
                    $(document).on('click.bs.popover.data-api', function(e) {
                        if (lastPopedPopover) {
                            lastPopedPopover.popover('hide');
                        }
                    });
                    $('.video_upload').hide();
                    $('.insert_video_from_url').hide();
                    $('.user_uploaded_video').show();
                    $('.user_uploaded_video').html(data);
                    $(document).ready(function() {
                        $('.fancybox').fancybox({
                            openEffect: 'fade',
                            closeEffect: 'fade',
                            prevEffect: 'fade',
                            nextEffect: 'fade',
                            closebtn: true,
                            autoWidth: true,
                            autoHeight: true,
                            autoResize: true,
                            resize: 'Auto',
                            autoCenter: true,
                            autoScale: true,
                            helpers: {
                                overlay: {
                                    locked: false,
                                    closeClick: false
                                }
                            }
                        });
                    });
                    var multiple_selection = $('.multiple-selection').data('multiple');
                    if (multiple_selection == false || multiple_selection == undefined) {
                        $('#note').text('Please select the video and click on "Insert Media" button to proceed. You can insert only one image.');
                    } else {
                        $('#note').text('Please select the video and click on "Insert Media" button to proceed.');
                    }
                    if (video_id != false) {
                        var videoIDs = video_id;
                    } else {
                        var videoIDs = $('input[name="video_id"]').val();
                    }
                    MediaManager.selectVideo(videoIDs);
                    // $('input[name="imageName"]').removeClass('hide')
                    // $('input[name="imageName"]').keyup(function() {
                    //          var imageName = $(this).val();
                    //          MediaManager.searchByImageName(imageName);
                    // });
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    $('.loader').hide();
                },
                async: true
            });
        },
        setVideoFromUrlTab: function() {
            $('.video_upload').hide();
            $('.user_uploaded_video').hide();
            var html = '<div class="title_section"><h2>Insert video from youtube url</h2></div>\n\
						<div class="portlet light">\n\
						<div class="row">\n\
														<div class="col-md-12">\n\
														<div class="form-group form-md-line-input form-md-floating-label has-info">\n\
																						<input type="text" class="form-control input-lg video_url" id="form_control_1">\n\
																						<label for="form_control_1">Enter youtube video url</label>\n\
																						<span class="thrownError" style="color:red"></span>\n\
														 </div>\n\
																						<a href="javascript:void(0);" onclick="MediaManager.insertVideoFromUrl()" class="btn btn-green-drake">Upload Video</a>\n\
																						<a href="javascript:void(0);" onclick="MediaManager.setMyVideosTab(' + window.user_id + ')" class="btn btn-green-drake">Go to Video Gallery</a><br/>\n\
																						<p></p>\n\
						</div>\n\
														<div class="row">\n\
														<div class="col-md-12">\n\
																						<div class="uploaded_image"></div>\n\
														</div>\n\
						</div>\n\
						</div>\n\
						</div>\n\
						</div>';
            $('.insert_video_from_url').show();
            $('.insert_video_from_url').html(html);
        },
        insertVideoFromUrl: function() {
            $('.loader').show();
            var video_url = $('.video_url').val();
            setTimeout(function() {
                $('.thrownError').text('');
            }, 5000);
            if (video_url.length > 0) {
                $.ajax({
                    type: "POST",
                    cache: true,
                    url: site_url + '/powerpanel/media/insert_video_by_url',
                    data: {
                        'url': video_url
                    },
                    success: function(data) {
                        $('.loader').hide();
                        var response = $.parseJSON(data);
                        if (response.error) {
                            $('.loader').hide();
                            $('.uploaded_image').html('');
                            $('.thrownError').text(response.error);
                        } else {
                            $('.thrownError').text('');
                            $('.uploaded_image').html(response.html);
                            $(document).ready(function() {
                                $('.fancybox').fancybox({
                                    openEffect: 'fade',
                                    closeEffect: 'fade',
                                    prevEffect: 'fade',
                                    nextEffect: 'fade',
                                    closebtn: true,
                                    autoWidth: true,
                                    autoHeight: true,
                                    autoResize: true,
                                    resize: 'Auto',
                                    autoCenter: true,
                                    autoScale: true,
                                    helpers: {
                                        overlay: {
                                            locked: false,
                                            closeClick: false
                                        }
                                    }
                                });
                            });
                            MediaManager.setMyVideosTab(window.user_id, response.video_id);
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $('.loader').hide();
                    },
                    async: true
                });
            } else {
                $('.loader').hide();
                $('.thrownError').text('Please enter url');
                return false;
            }
        },
        removeMultipleVideos: function(identity = false) {
            if ($('.contains_thumb').hasClass('active_video')) {
                $('.loader').show();
                var IDs = [];
                $('.active_video').each(function() {
                    var class_with_id = $(this).attr('id').split('_');
                    $('#video_' + class_with_id[1]).remove();
                    IDs.push(class_with_id[1]);
                });
                if (IDs) {
                    $.ajax({
                        type: "POST",
                        cache: true,
                        url: site_url + '/powerpanel/media/remove_multiple_videos',
                        data: {
                            'idArr': IDs,
                            'identity': identity
                        },
                        success: function(data) {
                            $('.loader').hide();
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "positionClass": "toast-top-right",
                                "onclick": null,
                                "showDuration": "1000",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                            toastr.success("Videos are removed successfully.");
                            MediaManager.setMyVideosTab(window.user_id);
                        },
                        error: function(xhr, ajaxOptions, thrownError) {},
                        async: true
                    });
                }
            }
        },
        restoreMultipleImages: function() {
            if ($('.contains_thumb').hasClass('img-box-active')) {
                $('.loader').show();
                var IDs = [];
                $('.img-box-active').each(function() {
                    var class_with_id = $(this).attr('id').split('_');
                    IDs.push(class_with_id[1]);
                });
                if (IDs) {
                    $.ajax({
                        type: "POST",
                        cache: true,
                        url: site_url + '/powerpanel/media/restore_multiple_image',
                        data: {
                            'idArr': IDs
                        },
                        success: function(data) {
                            $('.loader').hide();
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "positionClass": "toast-top-right",
                                "onclick": null,
                                "showDuration": "1000",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                            MediaManager.setTrashedImageTab(window.user_id);
                            toastr.success("Images are restored successfully.");
                        },
                        error: function(xhr, ajaxOptions, thrownError) {},
                        async: true
                    });
                }
            }
        },
        restoreMultipleVideos: function() {
            if ($('.contains_thumb').hasClass('active_video')) {
                $('.loader').show();
                var IDs = [];
                $('#append_user_image .active_video').each(function() {
                    var class_with_id = $(this).attr('id').split('_');
                    IDs.push(class_with_id[1]);
                });
                if (IDs) {
                    $.ajax({
                        type: "POST",
                        cache: true,
                        url: site_url + '/powerpanel/media/restore-multiple-videos',
                        data: {
                            'idArr': IDs
                        },
                        success: function(data) {
                            $('.loader').hide();
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "positionClass": "toast-top-right",
                                "onclick": null,
                                "showDuration": "1000",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                            MediaManager.setTrashedVideoTab(window.user_id);
                            toastr.success("Videos are restored successfully.");
                        },
                        error: function(xhr, ajaxOptions, thrownError) {},
                        async: true
                    });
                }
            }
        },
        restoreMultipleDocument: function() {
            if ($('.contains_thumb').hasClass('document-box-active')) {
                $('.loader').show();
                var IDs = [];
                $('.document-box-active').each(function() {
                    var class_with_id = $(this).attr('id').split('_');
                    IDs.push(class_with_id[1]);
                });
                if (IDs) {
                    $.ajax({
                        type: "POST",
                        cache: true,
                        url: site_url + '/powerpanel/media/restore-multiple-document',
                        data: {
                            'idArr': IDs
                        },
                        success: function(data) {
                            $('.loader').hide();
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "positionClass": "toast-top-right",
                                "onclick": null,
                                "showDuration": "1000",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }
                            MediaManager.setTrashedDocumentTab(window.user_id);
                            toastr.success("Documents are restored successfully.");
                        },
                        error: function(xhr, ajaxOptions, thrownError) {},
                        async: true
                    });
                }
            }
        },
        openRestoreConfirmBox: function(mediaType = 'Image') {
            if (mediaType == 'Image') {
                if ($('.contains_thumb').hasClass('img-box-active')) {
                    $('#restoreConfirmBox').modal('show');
                } else {
                    openAlertDialogForImage('Please select at least one image to proceed.');
                    return false;
                }
            }
            if (mediaType == 'Video') {
                if ($('.contains_thumb').hasClass('active_video')) {
                    $('#restoreVideoConfirmBox').modal('show');
                } else {
                    openAlertDialogForImage('Please select at least one video to proceed.');
                    return false;
                }
            }
            if (mediaType == 'Document') {
                if ($('.contains_thumb').hasClass('document-box-active')) {
                    $('#restoreDocumentConfirmBox').modal('show');
                } else {
                    openAlertDialogForImage('Please select at least one document to proceed.');
                    return false;
                }
            }
        },
        openConfirmBox: function(mediaType = 'Image', permanentlyDelete = false, type = false) {
            if (mediaType == 'video') {
                if ($('.contains_thumb').hasClass('active_video')) {
                    if (permanentlyDelete) {
                        $('#permanentDeleteMediaVideo').modal('show');
                    } else {
                        MediaManager.checkVideoInuse(type);
                    }
                } else {
                    openAlertDialogForVideo('Please select at least one video to proceed.');
                    return false;
                }
            } else if (mediaType == 'document') {
                if ($('.contains_thumb').hasClass('document-box-active')) {
                    if (permanentlyDelete) {
                        $('#permanentDeleteMediaDocument').modal('show');
                    } else {
                        MediaManager.checkDocumentInuse(type);
                    }
                } else {
                    openAlertDialogForDocument('Please select at least one document to proceed.');
                    return false;
                }
            } else {
                if ($('.contains_thumb').hasClass('img-box-active')) {
                    if (permanentlyDelete) {
                        $('#permanentDeleteMediaImage').modal('show');
                    } else {
                        MediaManager.checkImageInuse(type);
                    }
                } else {
                    openAlertDialogForImage('Please select at least one image to proceed.');
                    return false;
                }
            }
        },
        removeImageFromGallery: function(imageIds = false) {
            var imgIDs = $('input[name="img_id"]').val().split(',');
            var filterdValue = $.grep(imgIDs, function(value) {
                return value != imageIds;
            });
            $('input[name="img_id"]').val(filterdValue.toString());
            $('#' + imageIds).remove();
            if ($('.multi_image_list ul li').length <= 0) {
                $('.multi_image_list').remove();
            }
        },
        removeVideoFromVideoManager: function(videoIds = false) {
            var vidIDs = $('input[name="video_id"]').val().split(',');
            var filterdValue = $.grep(vidIDs, function(value) {
                return value != videoIds;
            });
            $('input[name="video_id"]').val(filterdValue.toString());
            $('.video_list').find('#' + videoIds).remove();
            if ($('.video_list .multi_image_list ul li').length <= 0) {
                $('.video_list .multi_image_list').remove();
            }
        },
        removeDocumentFromGallery: function(docsId = false) {
            var docIDs = $('input[name="doc_id"]').val().split(',');
            var filterdValue = $.grep(docIDs, function(value) {
                return value != docsId;
            });
            $('input[name="doc_id"]').val(filterdValue.toString());
            $('#doc_' + docsId).remove();
            if ($('#multi_document_list ul li').length <= 0) {
                $('#multi_document_list').remove();
            }
        },
        setDocumentUploadTab: function() {
            $('.docs_upload').show();
            $('.user_uploaded_docs').hide();
            $('.docs_html').hide();
            $('.trashed_docs').hide();
            $('.recent_uploads_docs').hide();
            $('input[name="docName"]').addClass('hide');
            $.ajax({
                type: "POST",
                cache: true,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: site_url + '/powerpanel/media/set_document_uploader',
                dataType: "html",
                success: function(data) {
                    $('.docs_upload').html(data);
                    var maxfilesexceeded = false;
                    var docs_id = false;
                    var success = false;
                    $("#my-dropzone-document").dropzone({
                        acceptedFiles: "application/pdf,.doc,.docx,.ppt,.xls,.txt",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: site_url + '/powerpanel/media/upload_documents',
                        maxFiles: 15, // Number of files at a time
                        maxFilesize: 10, //in MB
                        clickable: true,
                        maxfilesexceeded: function(file) {
                            maxfilesexceeded = true;
                        },
                        success: function(response) {
                            docs_id = response.xhr.response;
                            if (response.status == "success") {
                                success = true;
                            }
                        },
                        queuecomplete: function(file) {
                            if (success) {
                                if (maxfilesexceeded) {
                                    toastr.options = {
                                        "closeButton": true,
                                        "debug": false,
                                        "positionClass": "toast-top-right",
                                        "onclick": null,
                                        "showDuration": "1000",
                                        "hideDuration": "1000",
                                        "timeOut": "5000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                    }
                                    toastr.error("Only 15 document(s) are uploaded others are not uploaded");
                                } else {
                                    toastr.options = {
                                        "closeButton": true,
                                        "debug": false,
                                        "positionClass": "toast-top-right",
                                        "onclick": null,
                                        "showDuration": "1000",
                                        "hideDuration": "1000",
                                        "timeOut": "5000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                    }
                                    toastr.success("Document(s) are successfully uploaded.");
                                    MediaManager.setDocumentListTab(window.user_id, docs_id);
                                }
                            }
                        },
                        removedfile: function(file) {
                            var _ref; // Remove file on clicking the 'Remove file' button
                            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                        },
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {},
                async: true
            });
        },
        setDocumentListTab: function(userid, doc_id = false) {
            $('.tab_6_3 ul li a').removeClass('active');
            $('#user_uploaded_docs').addClass('active');
            $('.loader').show();
            $.ajax({
                type: "POST",
                cache: true,
                url: site_url + '/powerpanel/media/user_uploaded_docs',
                dataType: "html",
                data: {
                    'userid': userid
                },
                success: function(data) {
                    $('.loader').hide();
                    var lastPopedPopover;
                    $('.popovers').popover();
                    // close last displayed popover
                    $(document).on('click.bs.popover.data-api', function(e) {
                        if (lastPopedPopover) {
                            lastPopedPopover.popover('hide');
                        }
                    });
                    $('.docs_upload').hide();
                    $('.docs_html').hide();
                    $('.trashed_docs').hide();
                    $('.tab_6_4').show();
                    $('.user_uploaded_docs').show();
                    $('.user_uploaded_docs').html(data);
                    var multiple_selection = $('.multiple-selection').data('multiple');
                    if (multiple_selection == false || multiple_selection == undefined) {
                        $('#note').text('Please select the document and click on "Insert Media" button to proceed. You can insert only one document.');
                    } else {
                        $('#note').text('Please select the document(s) and click on "Insert Media" button to proceed.');
                    }
                    if (doc_id != false) {
                        var docIDs = doc_id;
                    } else {
                        var docIDs = $('input[name="doc_id"]').val();
                    }
                    MediaManager.selectDocument(docIDs);
                    $('input[name="docName"]').removeClass('hide');
                    $('input[name="docName"]').keyup(function() {
                       if( ($(this).val().length % 3) == 0){
                        var docName = $(this).val();
                        MediaManager.searchByDocName(docName);
                       }
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) {},
                async: true
            });
        },
        emptyTrash: function(mediaType = false) {
            var trashTabs = {
                "Image": "MediaManager.setTrashedImageTab(window.user_id);",
                "Video": "MediaManager.setTrashedVideoTab(window.user_id);",
                "Document": "MediaManager.setDocumentListTab(window.user_id);"
            };
            $('#emptyTrashMedia' + mediaType).modal('show');
            $(".empty_trash_" + mediaType).off('click').click(function() {
                if (mediaType) {
                    $('.loader').show();
                    $.ajax({
                        type: "POST",
                        cache: true,
                        url: site_url + '/powerpanel/media/empty_trash_' + mediaType,
                        data: {
                            'mediaType': mediaType
                        },
                        success: function(data) {
                            $('.loader').hide();
                            eval(trashTabs[mediaType]);
                        },
                        complete: function(data) {},
                        error: function(xhr, ajaxOptions, thrownError) {},
                        async: true
                    }).done(function() {
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "positionClass": "toast-top-right",
                            "onclick": null,
                            "showDuration": "1000",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        toastr.success(mediaType + "s are removed successfully.");
                    });
                }
                $('#emptyTrashMedia' + mediaType).modal("hide");
            });
        },
        init: function() {
            var selectedVideo = $('#video_name').val();
            if (selectedVideo == '' || selectedVideo == undefined || selectedVideo == null) {
                $('#video_name').hide();
            }
        }
    };
}();
$(document).on('click', '.dz-complete a', function() {
    $('#my-dropzone file').trigger('change');
});
$(document).ready(function() {
    MediaManager.init();
    $('.tab_6_3 ul.nav li a').click(function() {
        $('.tab_6_3 ul.nav li a').removeClass('active');
        var menu_id = $(this).attr('id');
        $('#' + menu_id).addClass('active');
    });
    $('.remove_multiple_images').click(function() {
        MediaManager.removeMultipleImages($(this).val());
    });
    $('.remove_multiple_videos').click(function() {
        MediaManager.removeMultipleVideos($(this).val());
    });
    $('.remove_multiple_document').click(function() {
        MediaManager.removeMultipleDocuments($(this).val());
    });

    $('.restore_multiple_images').click(function() {
        MediaManager.restoreMultipleImages();
    });
    $('.restore_multiple_videos').click(function() {
        MediaManager.restoreMultipleVideos();
    });
    $('.restore_multiple_documents').click(function() {
        MediaManager.restoreMultipleDocument();
    });


    $('.remove_multiple_document_permanently').click(function() {
        MediaManager.removeMultipleDocuments('trash');
    });
    $('.remove_multiple_images_permanently').click(function() {
        MediaManager.removeMultipleImages('trash');
    });
    $('.remove_multiple_videos_permanently').click(function() {
        MediaManager.removeMultipleVideos('trash');
    });
});

function openAlertDialogForImage(message = null) {
    if (message) {
        $("#alertModalForImage .alert_msg").html(message);
        $('#alertModalForImage').modal('show');
    }
}

function openAlertDialogForVideo(message = null) {
    if (message) {
        $("#alertModalForVideo .alert_msg").html(message);
        $('#alertModalForVideo').modal('show');
    }
}

function openAlertDialogForDocument(message = null) {
    if (message) {
        $("#alertModalForDocument .alert_msg").html(message);
        $('#alertModalForDocument').modal('show');
    }
}