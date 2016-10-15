<?php

namespace src\html;

class Colors {

    /**
     * @return array
     */
    static function getColors() {
        $c[] = '<div class="row">';
        $c[] = '       <div class="panel panel-primary">';
        $c[] = '           <div class="panel-heading">';
        $c[] = '               <span>Colors</span>';
        $c[] = '           </div>';
        $c[] = '           <div class="panel-body">';
		session_name('wdtoolkit');
        if (isset($_SESSION['colors']) && $_SESSION['colors'] != null && sizeof($_SESSION['colors']) > 0) {
            $c[] = '           <table class="table table-striped">';
            $c[] = '               <thead>';
            $c[] = '                   <tr>';
            $c[] = '                       <th>Color</th>';
            $c[] = '                       <th>Hex</th>';
            $c[] = '                       <th>RGB</th>';
            $c[] = '                       <th></th>';
            $c[] = '                   </tr>';
            $c[] = '               </thead>';
            $c[] = '               <tbody>';
			session_name('wdtoolkit');
            foreach ($_SESSION['colors'] as $key => $value) {
                $c[] = '               <tr>';
                $c[] = '                   <td bgcolor="' . $key .'" classes="bgcolor"></td>';
                $c[] = '                   <td class="1">' . $key . '</td>';
                $c[] = '                   <td class="rgb">' . $value . '</td>';
                $c[] = '                   <td><a href="?do=colors&action=delete&col=' . urlencode($key) . '" class="btn-delete-color"><span class="glyphicon glyphicon-trash"></span></a></td>';
                $c[] = '               </tr>';
            }
            $c[] = '               </tbody>';
            $c[] = '           </table>';
        }
        $c[] = '               <div class="form-group">';
        $c[] = '                   <label for="color" class="control-label col-md2">Add color&nbsp;</label>';
        $c[] = '                   <input name="color" type="color" id="color" class="colorpicker">';
        $c[] = '               </div>';
		session_name('wdtoolkit');
        if (isset($_SESSION['colors']) && $_SESSION['colors'] != null && sizeof($_SESSION['colors']) > 0) {
            $c[] = '           <div class="form-group">';
            $c[] = '               <a href="?do=colors&action=deleteall" id="deleteall" class="btn btn-danger ">Delete all</a>';
            $c[] = '           </div>';
        }
        $c[] = '           </div>';
        $c[] = '       </div>';
        $c[] = '</div>';
        return $c;
    }

}