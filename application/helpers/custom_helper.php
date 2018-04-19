<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('back')) {

    function back() {
        redirect($_SERVER['HTTP_REFERER']);
    }

}
if (!function_exists('checkAdmin')) {

    function checkAdmin() {
        if (empty($_SESSION['admin']))
            redirect('../Auth');
    }

}
if (!function_exists('seo_title')) {

    function seo_title($input, $replace = '-', $remove_words = true, $words_array = array()) {
        $tr = array('ş', 'Ş', 'ı', 'İ', 'ğ', 'Ğ', 'ü', 'Ü', 'ö', 'Ö', 'Ç', 'ç');
        $eng = array('s', 's', 'i', 'i', 'g', 'g', 'u', 'u', 'o', 'o', 'c', 'c');
        $input = str_replace($tr, $eng, $input);
        //make it lowercase, remove punctuation, remove multiple/leading/ending spaces
        $return = trim(preg_replace('/ +/', ' ', preg_replace('/[^a-zA-Z\p{Arabic}0-9\s]/u', '', mb_strtolower($input, 'UTF-8'))));

        //remove words, if not helpful to seo
        //i like my defaults list in remove_words(), so I wont pass that array
        if ($remove_words) {
            $return = remove_words($return, $replace, $words_array);
        }

        //convert the spaces to whatever the user wants
        //usually a dash or underscore..
        //...then return the value.
        return str_replace(' ', $replace, $return);
        return $return;
    }

}

if (!function_exists('remove_words')) {
    /* takes an input, scrubs unnecessary words */

    function remove_words($input, $replace, $words_array = array(), $unique_words = true) {
        //separate all words based on spaces
        $input_array = explode(' ', $input);

        //create the return array
        $return = array();

        //loops through words, remove bad words, keep good ones
        foreach ($input_array as $word) {
            //if it's a word we should add...
            if (!in_array($word, $words_array) && ($unique_words ? !in_array($word, $return) : true)) {
                $return[] = $word;
            }
        }

        //return good words separated by dashes
        return implode($replace, $return);
    }

}
if (!function_exists('fileImage')) {

    function fileImage($filename, $size = '') {
        $mime = get_mime_by_extension($filename);
        switch ($mime) {
            case 'application/pdf':
                $file_image = '<i class="fa fa-file-pdf-o ' . $size . '"></i>';
                break;
            case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                $file_image = '<i class="fa fa-file-word-o ' . $size . '" ></i>';
                break;
            case 'application/msword':
                $file_image = '<i class="fa fa-file-word-o ' . $size . '" ></i>';
                break;
            case 'text/plain':
                $file_image = '<i class="fa fa-file-text-o ' . $size . '" ></i>';
                break;
            case 'application/powerpoint':
                $file_image = '<i class="fa fa-file-powerpoint-o ' . $size . '" ></i>';
                break;
            case 'application/excel':
                $file_image = '<i class="fa fa-file-excel-o ' . $size . '" ></i>';
                break;
            case 'application/vnd.ms-excel':
                $file_image = '<i class="fa fa-file-excel-o ' . $size . '" ></i>';
                break;

            default :
                $file_image = '<i class="fa fa-file ' . $size . '" ></i>';
                break;
        }

        return $file_image;
    }

}

if (!function_exists('getThumb')) {

    function getThumb($image, $size) {
        if ($image != '') {
            $thumb = explode('.', $image);
            $thumb = $thumb[0] . '_' . $size . '.' . $thumb[1];
            return $thumb;
        } else {
            return '';
        }
    }

}
if (!function_exists('getMeta')) {

    function getMeta($id, $key, $lang = "All") {
        $CI = & get_instance();
        $meta = $CI->ContentsMeta->getValue($id, $key, $lang);
        return $meta;
    }

}
if (!function_exists('get_subs')) {

    function get_subs($content_type, $parent_id = 0,$x = '') {
        $CI = & get_instance();
        $csrf = array(
            'name' => $CI->security->get_csrf_token_name(),
            'hash' => $CI->security->get_csrf_hash()
        );
        $total = $CI->Contents->total($parent_id);
        if ($total > 0) {
            $contents = $CI->Contents->getByContentParentType($content_type['type'] . '_cat', $parent_id);
            $x = $parent_id == 0 ? '' : $x .='-';
            foreach ($contents as $content) {
                
                ?>
                <tr>
                    <td><input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" /><input class="form-control form-white"  name="rank[<?= $content->content_id ?>]" value="<?= $content->rank ?>"><span class="hidden"><?= $content->rank ?></span></td>
                <?php if ($content_type['thumb_show'] == true) { ?>
                    <td><img width="50" src="public/images/content/<?= getThumb($content->image) ?>" /></td>
                <?php } ?>
                <td><?= $x.' '.$content->title; ?></td>
                <td><a href="admin/Content/edit/<?= $content_type['type'] . '/' . $content->content_id ?>/category" class="btn btn-square btn-warning"><span class="glyphicon glyphicon-edit"></span> <?= lang('edit') ?></a></td>
                <td><button data-toggle="modal" data-target="#delete<?= $content->content_id ?>" class="btn btn-square btn-danger"><span class="glyphicon glyphicon-trash"></span> <?= lang('delete') ?></button>
                <div class="modal fade" id="delete<?= $content->content_id ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="lineModalLabel"><?= lang('warning') ?></h4>
                            </div>
                            <div class="modal-body">
                                <?= str_replace('*', $content->title, lang('confirm_delete')) ?>
                            </div>
                            <div class="modal-footer">
                                <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-default" data-dismiss="modal" role="button">
                                            <?= lang('close') ?>
                                        </button>
                                    </div>
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-danger btn-hover-green" href="admin/Content/delete/<?= $content->content_id ?>">
                                            <?= lang('delete') ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </td>
                </tr>
                <?php
                get_subs($content_type, $content->content_id,$x);
            }
        } else {
            return false;
        }
    }

}