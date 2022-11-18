<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="row">
    <div class="col-sm-12 col-lg-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?php echo trans('bulk_post_upload'); ?></h3><br>
                    <small><?= trans("bulk_post_upload_exp"); ?></small>
                </div>
                <div class="right">
                    <a href="<?php echo admin_url(); ?>posts" class="btn btn-success btn-add-new">
                        <i class="fa fa-bars"></i>
                        <?php echo trans('posts'); ?>
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <label class="control-label"><?php echo trans('upload_csv_file'); ?></label>

                    <div class="dm-uploader-container">
                        <div id="drag-and-drop-zone" class="dm-uploader dm-uploader-csv text-center">
                            <p class="dm-upload-icon">
                                <i class="fa fa-cloud-upload"></i>
                            </p>
                            <p class="dm-upload-text"><?php echo trans("drag_drop_files_here"); ?></p>
                            <p class="text-center">
                                <button class="btn btn-default btn-browse-files"><?php echo trans('browse_files'); ?></button>
                            </p>

                            <a class='btn btn-md dm-btn-select-files'>
                                <input type="file" name="file" size="40" multiple="multiple">
                            </a>
                            <ul class="dm-uploaded-files" id="files-file"></ul>
                            <button type="button" id="btn_reset_upload" class="btn btn-reset-upload"><?php echo trans("reset"); ?></button>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div id="csv_upload_spinner" class="csv-upload-spinner">
                                <strong class="text-csv-importing"><?= trans("importing_posts"); ?></strong>
                                <strong class="text-csv-import-completed"><?= trans("completed"); ?>!</strong>
                                <div class="spinner">
                                    <div class="bounce1"></div>
                                    <div class="bounce2"></div>
                                    <div class="bounce3"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12">
                        <div class="row">
                            <div class="csv-uploaded-files-container">
                                <ul id="csv_uploaded_files" class="list-group csv-uploaded-files"></ul>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?php echo trans('help_documents'); ?></h3><br>
                    <small><?= trans("help_documents_exp"); ?></small>
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <?php echo form_open('post_controller/download_csv_files_post'); ?>
                    <button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#modalCategoryIds"><?= trans("category_ids_list"); ?></button>
                    <button class="btn btn-default btn-block" name="submit" value="csv_template"><?= trans("download_csv_template"); ?></button>
                    <button class="btn btn-default btn-block" name="submit" value="csv_example"><?= trans("download_csv_example"); ?></button>
                    <button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#modalDocumentation"><?= trans("documentation"); ?></button>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modalCategoryIds" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?= trans("category_ids_list"); ?></h4>
            </div>
            <div class="modal-body">
                <?php
                $lang_count = 0;
                foreach ($this->languages as $language): ?>
                    <strong style="display: block;border-bottom: 1px solid #eee;padding-bottom: 5px; margin-bottom: 10px; <?= $lang_count != 0 ? 'margin-top: 20px;' : ''; ?>"><?= trans("language") . ": " . $language->name . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . trans("id") . " = " . $language->id ?></strong>
                    <?php
                    $parent_categories = $this->category_model->get_parent_categories_by_lang($language->id);
                    if (!empty($parent_categories)):
                        foreach ($parent_categories as $parent_category):?>
                            <p><?= $parent_category->name . ": " . trans("id") . " = " . $parent_category->id ?></p>
                            <?php
                            $sub_categories = $this->category_model->get_subcategories_by_parent_id($parent_category->id);
                            if (!empty($sub_categories)):
                                foreach ($sub_categories as $sub_category):?>
                                    <p style="padding-left: 30px;"><?= $sub_category->name . ": " . trans("id") . " = " . $sub_category->id ?></p>
                                <?php endforeach;
                            endif;
                        endforeach;
                    endif;
                    $lang_count++;
                endforeach; ?>
            </div>
        </div>
    </div>
</div>

<div id="modalDocumentation" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: 0;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo trans('bulk_post_upload'); ?></h4>
            </div>
            <div class="modal-body">
                <table style="width:100%" class="table table-bordered">
                    <tr>
                        <th><?php echo trans('field'); ?></th>
                        <th><?php echo trans('description'); ?></th>
                    </tr>
                    <tr>
                        <td style="width: 180px;">lang_id</td>
                        <td><?= trans("data_type"); ?>: Integer <br><strong><?= trans("required"); ?></strong> <br><span style="color: #777;"><?= trans("example"); ?>: 1</span></td>
                    </tr>
                    <tr>
                        <td style="width: 180px;">title</td>
                        <td><?= trans("data_type"); ?>: String <br><strong><?= trans("required"); ?></strong><br><span style="color: #777;"><?= trans("example"); ?>: Test title</span></td>
                    </tr>
                    <tr>
                        <td style="width: 180px;">title_slug</td>
                        <td><?= trans("data_type"); ?>: String <br><strong><?= trans("optional"); ?></strong> <small>(<?= trans("slug_exp"); ?>)</small> <br> <span style="color: #777;"><?= trans("example"); ?>: test-title</span></td>
                    </tr>
                    <tr>
                        <td style="width: 180px;">keywords</td>
                        <td><?= trans("data_type"); ?>: String <br><strong><?= trans("optional"); ?></strong> <br> <span style="color: #777;"><?= trans("example"); ?>: test, post</span></td>
                    </tr>
                    <tr>
                        <td style="width: 180px;">summary</td>
                        <td><?= trans("data_type"); ?>: String <br><strong><?= trans("optional"); ?></strong><br> <span style="color: #777;"><?= trans("example"); ?>: This is summary</span></td>
                    </tr>
                    <tr>
                        <td style="width: 180px;">content</td>
                        <td><?= trans("data_type"); ?>: String <br><strong><?= trans("optional"); ?></strong><br> <span style="color: #777;"><?= trans("example"); ?>: This is content</span></td>
                    </tr>
                    <tr>
                        <td style="width: 180px;">category_id</td>
                        <td><?= trans("data_type"); ?>: Integer <br><strong><?= trans("required"); ?></strong><br> <span style="color: #777;"><?= trans("example"); ?>: 2</span></td>
                    </tr>
                    <tr>
                        <td style="width: 180px;">post_type</td>
                        <td><?= trans("data_type"); ?>: String <br><strong><?= trans("required"); ?></strong><br><span style="color: #333;"><b>article</b> <?= trans("or"); ?> <b>video</b></span></td>
                    </tr>
                    <tr>
                        <td style="width: 180px;">video_embed_code</td>
                        <td><?= trans("data_type"); ?>: String<br><strong><?= trans("optional"); ?></strong> <br> <span style="color: #777;"><?= trans("example"); ?>: https://www.youtube.com/embed/V9ypxcc0TpI</span></td>
                    </tr>
                    <tr>
                        <td style="width: 180px;">status</td>
                        <td><?= trans("data_type"); ?>: Boolean <br><strong><?= trans("required"); ?></strong><br> <span style="color: #333;"><b>1</b> <?= trans("or"); ?> <b>0</b></span></td>
                    </tr>
                    <tr>
                        <td style="width: 180px;">image_url</td>
                        <td><?= trans("data_type"); ?>: String <br><strong><?= trans("optional"); ?></strong><br> <span style="color: #777;"><?= trans("example"); ?>: https://upload.wikimedia.org/wikipedia/commons/7/70/Labrador-sea-paamiut.jpg</span></td>
                    </tr>
                    <tr>
                        <td style="width: 180px;">image_description</td>
                        <td><?= trans("data_type"); ?>: String <br><strong><?= trans("optional"); ?></strong><br> <span style="color: #777;"><?= trans("example"); ?>: Labrador sea</span></td>
                    </tr>
                    <tr>
                        <td style="width: 180px;">tags</td>
                        <td><?= trans("data_type"); ?>: String <br><strong><?= trans("optional"); ?></strong><br> <span style="color: #777;"><?= trans("example"); ?>: test, post</span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('#drag-and-drop-zone').dmUploader({
            url: '<?php echo base_url(); ?>post_controller/generate_csv_object_post',
            multiple: false,
            extFilter: ["csv"],
            extraData: function (id) {
                return {
                    "<?php echo $this->security->get_csrf_token_name(); ?>": $.cookie(csfr_cookie_name)
                };
            },
            onDragEnter: function () {
                this.addClass('active');
            },
            onDragLeave: function () {
                this.removeClass('active');
            },
            onNewFile: function (id, file) {
                $("#csv_upload_spinner").show();
                $("#csv_upload_spinner .spinner").show();
                $("#csv_upload_spinner .text-csv-importing").show();
                $("#csv_upload_spinner .text-csv-import-completed").hide();
                $("#csv_uploaded_files").empty();
            },
            onUploadSuccess: function (id, response) {
                var number_of_items = 0;
                var txt_file_name = "";
                try {
                    var obj = JSON.parse(response);
                    if (obj.result == 1) {
                        number_of_items = obj.number_of_items;
                        txt_file_name = obj.txt_file_name;
                        if (number_of_items > 0) {
                            add_csv_item(number_of_items, txt_file_name, 1);
                        } else {
                            $("#csv_upload_spinner").hide();
                        }
                    } else {
                        $("#csv_upload_spinner").hide();
                    }

                } catch (e) {
                    alert("Invalid CSV file! Make sure there are no double quotes in your content. Double quotes can brake the CSV structure.");
                }
            }
        });
    });

    function add_csv_item(number_of_items, txt_file_name, index) {
        if (index <= number_of_items) {
            var data = {
                "txt_file_name": txt_file_name,
                "index": index
            };
            data[csfr_token_name] = $.cookie(csfr_cookie_name);
            $.ajax({
                type: "POST",
                url: base_url + "post_controller/import_csv_item_post",
                data: data,
                success: function (response) {
                    var obj_sub = JSON.parse(response);
                    if (obj_sub.result == 1) {
                        $("#csv_uploaded_files").prepend('<li class="list-group-item list-group-item-success"><i class="fa fa-check"></i>&nbsp;' + obj_sub.index + '.&nbsp;' + obj_sub.title + '</li>');
                    } else {
                        $("#csv_uploaded_files").prepend('<li class="list-group-item list-group-item-danger"><i class="fa fa-times"></i>&nbsp;' + obj_sub.index + '.</li>');
                    }
                    if (obj_sub.index == number_of_items) {
                        $("#csv_upload_spinner .text-csv-importing").hide();
                        $("#csv_upload_spinner .spinner").hide();
                        $("#csv_upload_spinner .text-csv-import-completed").css('display', 'block');
                    }
                    index = index + 1;
                    add_csv_item(number_of_items, txt_file_name, index);
                }
            });
        }
    }
</script>