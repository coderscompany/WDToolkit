<?php

namespace src\html;

class Strreplace {

    /**
     * @return array
     */
    static function getStrreplace() {
        $c[] = '<div class="row">';
        $c[] = '    <div class="panel panel-primary">';
        $c[] = '        <div class="panel-heading">';
        $c[] = '            <span>String replace</span>';
        $c[] = '        </div>';
        $c[] = '        <div class="panel-body">';
        $c[] = '            <form class="form-horizontal" role="form" id="strreplaceform" method="post" action="?do=main">';
        $c[] = '                <div class="col-md-6">';
        $c[] = '                    <div class="form-group">';
        $c[] = '                        <label class="control-label col-md-2" for="bevor">Before</label>';
        $c[] = '                        <div class="col-md-10">';
        $c[] = '                            <textarea name="before" id="before" class="formcontrol" placeholder="Paste text in here..."></textarea>';
        $c[] = '                        </div>';
        $c[] = '                    </div>';
        $c[] = '                </div>';
        $c[] = '                <div class="col-md-6">';
        $c[] = '                    <div class="form-group">';
        $c[] = '                        <label class="control-label col-md-2" for="after">After</label>';
        $c[] = '                        <div class="col-md-10">';
        $c[] = '                            <textarea name="after" id="after" class="form-control" placeholder="Result will appear in here..."></textarea>';
        $c[] = '                        </div>';
        $c[] = '                    </div>';
        $c[] = '                </div>';
        $c[] = '                <div class="col-md-6">';
        $c[] = '                    <div class="form-group">';
        $c[] = '                        <label for="search" class="col-md-2 control-label">Search</label>';
        $c[] = '                        <div class="col-md-4">';
        $c[] = '                            <input type="text" class="form-control" id="search" name="search">';
        $c[] = '                        </div>';
        $c[] = '                        <label for="replace" class="col-md-2 control-label">Replace</label>';
        $c[] = '                        <div class="col-md-4">';
        $c[] = '                            <input type="text" class="form-control" id="replace" name="replace">';
        $c[] = '                        </div>';
        $c[] = '                    </div>';
        $c[] = '                </div>';
        $c[] = '                <div class="col-md-6">';
        $c[] = '                    <div class="form-group">';
        $c[] = '                        <div class="col-md-10 col-md-offset-2">';
        $c[] = '                            <button type="submit" class="btn btn-primary col-md-12" id="replaceall">Replace</botton>';
        $c[] = '                        </div>';
        $c[] = '                    </div>';
        $c[] = '                    <div class="form-group toencoder-group">';
        $c[] = '                        <div class="col-md-5 col-md-offset-2">';
        $c[] = '                            <button type="submit" class="btn btn-primary col-md-12" id="sendtobefore">Send to before</botton>';
        $c[] = '                        </div>';
        $c[] = '                        <div class="col-md-5">';
        $c[] = '                            <button type="submit" class="btn btn-primary col-md-12" id="sendtoencoder">Send to encoder</botton>';
        $c[] = '                        </div>';
        $c[] = '                    </div>';
        $c[] = '                </div>';
        $c[] = '            </form>';
        $c[] = '        </div>';
        $c[] = '    </div>';
        $c[] = '</div>';
        return $c;
    }
}