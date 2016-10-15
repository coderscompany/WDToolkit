<?php

namespace src\html;

class Hasher {

    /**
     * @param null $filehash
     * @param null $filename
     * @param null $hashvalue
     * @return array
     */
    static function getHasher($filehash = null, $filename = null, $hashvalue = null) {
        $c[] = '<div class="row">';
        $c[] = '    <div class="panel panel-primary">';
        $c[] = '        <div class="panel-heading">';
        $c[] = '            <span>Hash Factory</span>';
        $c[] = '        </div>';
        $c[] = '        <div class="panel-body">';
        $c[] = '            <div id="tabs">';
	    $c[] = '                <ul>';
	    $c[] = '                    <li><a href="#tabs-1">String Hasher</a></li>';
	    $c[] = '                    <li><a href="#tabs-2">File Hasher</a></li>';
	    $c[] = '                </ul>';
	    $c[] = '                <div id="tabs-1">';
        $c[] = '                    <div class="col-md-12">';
        $c[] = '                        <form class="form-horizontal" role="form" id="stringhasher" method="post" action="?do=hasher&action=hash">';
        $c[] = '                            <div class="col-md-6">';
        $c[] = '                                <div class="form-group">';
        $c[] = '                                    <label for="plain" class="control-label col-md-2">String</label>';
        $c[] = '                                    <div class="col-md-10">';
        $c[] = '                                        <input type="text" class="form-control" name="plain" id="plain">';
        $c[] = '							        </div>';
        $c[] = '                                </div>';
        $c[] = '                                <div class="form-group">';
        $c[] = '                                    <label for="algo" class="control-label col-md-2">Algorithm</label>';
        $c[] = '                                    <div class="col-md-10">';
        $c[] = '                                        <select class="form-control" name="algo" id="algo">';
        foreach (hash_algos() as $algo) {
            $c[] = '                                        <option value="'.$algo.'">'. $algo . '</option>';
        }
        $c[] = '                                        </select>';
        $c[] = '                                    </div>';
        $c[] = '                                </div>';
        $c[] = '                                <div class="form-group">';
        $c[] = '                                    <label for="salt" class="col-md-2 control-label">Salt</label>';
        $c[] = '                                    <div class="col-md-10">';
        $c[] = '                                        <input type="text" id="salt" name="salt" class="form-control">';
        $c[] = '                                    </div>';
        $c[] = '                                </div>';
        $c[] = '                            </div>';
        $c[] = '                            <div class="col-md-6">';
        $c[] = '                                <div class="form-group">';
        $c[] = '                                    <label for="hashvalue" class="col-md-2 control-label">Hashvalue</label>';
        $c[] = '                                    <div class="col-md-10">';
        $c[] = '                                       <input type="text" class="form-control" name="hashvalue" id="hashvalue" ' . ($hashvalue != null ? 'value="' . $hashvalue . '"' : "") . '>';
        $c[] = '                                    </div>';
        $c[] = '                                </div>';
        $c[] = '                                <div class="form-group">';
        $c[] = '                                    <div class="col-md-10 col-md-offset-2">';
        $c[] = '                                        <button id="hash" class="btn btn-primary col-md-12" type="submit">Hash</button>';
        $c[] = '                                    </div>';
        $c[] = '                                </div>';
        $c[] = '                            </div>';
        $c[] = '                        </form>';
        if (isset($_SESSION['hashes']) && $_SESSION['hashes'] != null) {
            $c[] = '                    <div class="col-md-12">';
            $c[] = '                        <hr>';
            $c[] = '                    </div>';
            $c[] = '                    <div class="col-md-12">';
            $c[] = '                        <table class="table table-striped">';
            $c[] = '                            <thead>';
            $c[] = '                                <th>String <span class="badge">' . sizeof($_SESSION['hashes']) . '</span></th>';
            $salts = array();
            foreach ($_SESSION['hashes'] as $key => $value) {
                $salts[] = $value['salt'];
            }
            $salts = array_unique($salts);
            $c[] = '                                <th>Salt <span class="badge">' . (sizeof($salts) == 1 && $salts[0] == '' ? 0 : sizeof($salts)) . '</span></th>';
            $algos = array();
            foreach ($_SESSION['hashes'] as $key => $value) {
                $algos[] = $value['algo'];
            }
            $algos = array_unique($algos);
            $c[] = '                                <th class="td-algo">Algo <span class="badge">' . sizeof($algos) . '</span></th>';
            $c[] = '                                <th class="td-hash">Hash <span class="badge">' . sizeof($_SESSION['hashes']) . '</span></th>';
            $c[] = '                                <th></th>';
            $c[] = '                            </thead>';
            $c[] = '                            <tbody class="hashbody">';
            foreach ($_SESSION['hashes'] as $key => $value) {
                $c[] = '                            <tr>';
                $c[] = '                                <td>' . htmlspecialchars($value['plain']) . '</td>';
                $c[] = '                                <td>' . htmlspecialchars($value['salt']) . '</td>';
                $c[] = '                                <td class="td-algo">' . htmlspecialchars($value['algo']) . '</td>';
                $c[] = '                                <td class="td-hash" id="hashedvalue">' . htmlspecialchars($key) . '</td>';
                $c[] = '                                <td><a title="Delete this hash" href="?do=deletehash&hash=' . $key . '" class="btn-delete-hash btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>&nbsp;<a title="Rehash" href="?do=hasher&action=rehash&hash=' . $key . '" class="btn-rehash-hash btn btn-warning" ><span class="glyphicon glyphicon-refresh"></span></a></td>';
                $c[] = '                            </tr>';
            }
            $c[] = '                            </tbody>';
            $c[] = '                        </table>';
            $c[] = '                    </div>';
            $c[] = '                    <div class="col-md-12">';
            $c[] = '                        <div class="form-group">';
            $c[] = '                            <a href="?do=hasher&action=deleteallhashes" class="btn btn-danger col-md-12" id="deleteallhashes" type="submit">Delete all</a>';
            $c[] = '                        </div>';
            $c[] = '                    </div>';
        }
        $c[] = '                    </div>';
        $c[] = '                </div>';
        $c[] = '                <div id="tabs-2">';
        /*-----------------------------------------------------------File Hasher----------------------------------------------------------------------*/
        $c[] = '                <div class="col-md-12">';
        $c[] = '                    <form class="form-horizontal" role="form" id="filehasher" method="post" action="?do=hasher&action=hashf" enctype="multipart/form-data">';
        $c[] = '                        <div class="col-md-6">';
        $c[] = '                            <div class="form-group">';
        $c[] = '                                <label for="hashfile" class="control-label col-md-2">File</label>';
        $c[] = '                                <div class="col-md-10">';
        $c[] = '                                    <input type="hidden" name="MAX_FILE_SIZE" value="3000000">';
        $c[] = '                                    <input type="file" classes="form-control" name="hashfile" id="hashfile" value="' . $filename . '">';
        $c[] = '                                </div>';
        $c[] = '                            </div>';
        $c[] = '                            <div class="form-group">';
        $c[] = '                                <label for="algof" class="control-label col-md-2">Algorithm</label>';
        $c[] = '                                <div class="col-md-10">';
        $c[] = '                                    <select class="form-control" name="algof" id="algof">';
        foreach (hash_algos() as $algo) {
            $c[] = '                                    <option value="'.$algo.'">'. $algo . '</option>';
        }
        $c[] = '                                    </select>';
        $c[] = '                                </div>';
        $c[] = '                            </div>';
        $c[] = '                        </div>';
        $c[] = '                        <div class="col-md-6">';
        $c[] = '                            <div class="form-group">';
        $c[] = '                                <label for="hashvaluef" class="col-md-2 control-label">Hashvalue</label>';
        $c[] = '                                <div class="col-md-10">';
        $c[] = '                                    <input type="text" class="form-control" name="hashvaluef" id="hashvaluef" value="' . $filehash . '">';
        $c[] = '                                </div>';
        $c[] = '                            </div>';
        $c[] = '                            <div class="form-group">';
        $c[] = '                                <div class="col-md-10 col-md-offset-2">';
        $c[] = '                                    <button id="hashf" class="btn btn-primary col-md-12" type="submit">Hash</button>';
        $c[] = '                                </div>';
        $c[] = '                            </div>';
        $c[] = '                        </div>';
        $c[] = '                    </form>';
        session_name('wdtoolkit');
        if (isset($_SESSION['hashedfiles']) && $_SESSION['hashedfiles'] != null) {
            $c[] = '                <div class="col-md-12">';
            $c[] = '                    <hr>';
            $c[] = '                </div>';
            $c[] = '                <div class="col-md-12">';
            $c[] = '                    <table class="table table-striped">';
            $c[] = '                        <thead>';
            $c[] = '                            <th>File</th>';
            $c[] = '                            <th>Hash</th>';
            $c[] = '                            <th>Algo</th>';
            $c[] = '                            <th>Size</th>';
            $c[] = '                            <th>Time</th>';
            $c[] = '                            <th></th>';
            $c[] = '                        </thead>';
            $c[] = '                        <tbody class="hashbody">';
            session_name('wdtoolkit');
            foreach ($_SESSION['hashedfiles'] as $key => $value) {
                $c[] = '                        <tr>';
                $c[] = '                            <td>' . htmlspecialchars($value['file']) . '</td>';
                $c[] = '                            <td>' . htmlspecialchars($value['hash']) . '</td>';
                $c[] = '                            <td>' . htmlspecialchars($value['algo']) . '</td>';
                $c[] = '                            <td>' . $value['size'] . '</td>';
                $c[] = '                            <td>' . htmlspecialchars($key) . '</td>';
                $c[] = '                            <td><a href="?do=deletehash&file=' . $value['file'] . '&time=' . $key . '" class="btn  btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>';
                $c[] = '                        </tr>';
            }
            $c[] = '                        </tbody>';
            $c[] = '                    </table>';
            $c[] = '                </div>';
            $c[] = '                <div class="col-md-12">';
            $c[] = '                    <div class="form-group">';
            $c[] = '                        <a href="?do=deletefilehashes" class="btn btn-danger col-md-12" id="deleteallfilehashes" type="submit">Delete all</a>';
            $c[] = '                    </div>';
            $c[] = '                </div>';
        }
        $c[] = '                </div>';
        $c[] = '            </div>';
        $c[] = '            <div class="clearfix"></div>';
        $c[] = '        </div>';
        $c[] = '    </div>';
        $c[] = '</div>';
        return $c;
    }
}