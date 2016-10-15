<?php
/**
 * Created by PhpStorm.
 * User: seppel
 * Date: 21.06.16
 * Time: 17:56
 */

namespace src\html;

class Bitoperator
{

    /**
     * @return array
     */
    static function getBitoperator($first = null, $second = null) {
        $c[] = '<div class="row">';
        $c[] = '    <div class="panel panel-primary">';
        $c[] = '        <div class="panel-heading">';
        $c[] = '            <span>Bit Operations</span>';
        $c[] = '        </div>';
        $c[] = '        <div class="panel-body">';
        $c[] = '            <form class="form-horizontal" role="form" id="strreplaceform" method="post" action="?do=main">';
        $c[] = '                <div class="col-md-6">';
        $c[] = '                    <div class="form-group">';
        $c[] = '                        <label class="control-label col-md-2" for="first">First</label>';
        $c[] = '                        <div class="col-md-10">';
        $c[] = '                            <textarea name="first" id="first" class="form-control" placeholder="Paste binary string in here... 0100101101110" required>'.($first != null ? $first : '').'</textarea>';
        $c[] = '                        </div>';
        $c[] = '                    </div>';
        $c[] = '                    <div class="form-group">';
        $c[] = '                        <label class="control-label col-md-2" for="first">Second</label>';
        $c[] = '                        <div class="col-md-10">';
        $c[] = '                            <textarea name="second" id="second" class="form-control" placeholder="Paste binary string in here... 0100101101110" required>'.($second != null ? $second : '').'</textarea>';
        $c[] = '                        </div>';
        $c[] = '                    </div>';
        $c[] = '                </div>';
        $c[] = '                <div class="col-md-6">';
        $c[] = '                    <div class="form-group">';
        $c[] = '                        <label class="control-label col-md-2" for="after">Result</label>';
        $c[] = '                        <div class="col-md-10">';
        $c[] = '                            <textarea name="binaryresult" id="binaryresult" class="form-control" placeholder="Result will appear in here..."></textarea>';
        $c[] = '                        </div>';
        $c[] = '                    </div>';
        $c[] = '                </div>';
        $c[] = '                <div class="col-md-6">';
        $c[] = '                </div>';
        $c[] = '                <div class="col-md-6">';
        $c[] = '                    <div class="form-group">';
        $c[] = '                        <div class="col-md-3 col-md-offset-2">';
        $c[] = '                            <button type="submit" class="btn btn-primary col-md-12" id="and">AND</botton>';
        $c[] = '                        </div>';
        $c[] = '                        <div class="col-md-3">';
        $c[] = '                            <button type="submit" class="btn btn-primary col-md-12" id="or">OR</botton>';
        $c[] = '                        </div>';
        $c[] = '                        <div class="col-md-3">';
        $c[] = '                            <button type="submit" class="btn btn-primary col-md-12" id="xor">XOR</botton>';
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