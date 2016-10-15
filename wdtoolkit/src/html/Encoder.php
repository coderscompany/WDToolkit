<?php

namespace src\html;

class Encoder {

    /**
     * @return array
     */
    static function getEncoder() {
        $c[] = '<div class="row">';
        $c[] = '    <div class="panel panel-primary">';
        $c[] = '        <div class="panel-heading">';
        $c[] = '            <span>Encoder / Decoder</span>';
        $c[] = '        </div>';
        $c[] = '        <div class="panel-body">';
        $c[] = '            <form class="form-horizontal" role="form" id="decodedarea" method="post" action="?do=main">';
        $c[] = '                <div class="col-md-6">';
        $c[] = '                    <div class="form-group">';
        $c[] = '                        <label class="control-label col-md-2" for="decoded">Decoded</label>';
        $c[] = '                        <div class="col-md-10">';
        $c[] = '                            <textarea name="decoded" id="decoded" class="formcontrol"></textarea>';
        $c[] = '                        </div>';
        $c[] = '                    </div>';
        $c[] = '                </div>';
        $c[] = '                <div class="col-md-6">';
        $c[] = '                    <div class="form-group">';
        $c[] = '                        <label class="control-label col-md-2" for="encoded">Encoded</label>';
        $c[] = '                        <div class="col-md-10">';
        $c[] = '                            <textarea name="encoded" id="encoded" class="formcontrol"></textarea>';
        $c[] = '                        </div>';
        $c[] = '                    </div>';
        $c[] = '                </div>';
        $c[] = '                <div class="col-md-6">';
        $c[] = '                    <div class="form-group">';
        $c[] = '                        <label class="control-label col-md-2 " for="algorithm">Algorithm</label>';
        $c[] = '                        <div class="col-md-3">';
        $c[] = '                            <select class="form-control" name="algorithm" id="algorithm">';
        $c[] = '                                <option value="base64">Base64</option>';
        $c[] = '                                <option value="rot_13">rot_13</option>';
        $c[] = '                                <option value="url">Url</option>';
        $c[] = '                                <option value="json">Json</option>';
        $c[] = '                                <option value="hex">Hex</option>';
        $c[] = '                                <option value="bin">Binär</option>';
        $c[] = '                            </select>';
        $c[] = '                        </div>';
        $c[] = '                        <label for="compress" id="comp" class="col-md-2 control-label">Compress</label>';
        $c[] = '                        <div class="col-md-2 compressbox">';
        $c[] = '                            <input type="checkbox" id="compress" name="compress" data-on-text="On" data-off-text="Off" class="form-control">';
        $c[] = '                        </div>';
        $c[] = '                        <label for="strength" id="str" class="col-md-1 control-label">Strength</label>';
        $c[] = '                        <div class="col-md-2">';
        $c[] = '                            <select id="strength" name="strength" class="form-control">';
        for ($i = 1; $i <= 9; $i++) {
           $c[] = '                             <option value="'.$i.'">'.$i.'</option>';
        }
        $c[] = '                            </select>';
        $c[] = '                        </div>';
        $c[] = '                    </div>';
        $c[] = '                </div>';
        $c[] = '                <div class="col-md-6">';
        $c[] = '                    <div class="form-group">';
        $c[] = '                        <div class="col-md-5 col-md-offset-2">';
        $c[] = '                            <button type="submit" class="btn btn-primary col-md-12" id="encode">Encode</botton>';
        $c[] = '                        </div>';
        $c[] = '                        <div class="col-md-5">';
        $c[] = '                            <button type="submit" class="btn btn-primary col-md-12" id="decode">Decode</botton>';
        $c[] = '                        </div>';
        $c[] = '                    </div>';
        $c[] = '                </div>';
        $c[] = '                <div class="col-md-6 col-md-offset-6 sendtocreate">';
        $c[] = '                    <div class="form-group">';
        $c[] = '                        <div class="col-md-5 col-md-offset-2">';
        $c[] = '                            <button type="submit" class="btn btn-primary col-md-12" id="sendtofirst">Send to Bit Operator >> First</botton>';
        $c[] = '                        </div>';
        $c[] = '                        <div class="col-md-5">';
        $c[] = '                            <button type="submit" class="btn btn-primary col-md-12" id="sendtosecond">Send to Bit Operator >> Second</botton>';
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