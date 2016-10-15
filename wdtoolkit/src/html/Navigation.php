<?php

namespace src\html;

class Navigation {

    /**
     * @return array
     */
     static function show() {
        $HTML[] = '<nav class="navbar navbar-static-top navbar-inverse" role="navigation">';
        $HTML[] = '    <div class="navbar-header">';
        $HTML[] = '        <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-collapse">';
        $HTML[] = '            <span class="sr-only">Toggle Navigation</span>';
        $HTML[] = '            <span class="icon-bar"></span>';
        $HTML[] = '            <span class="icon-bar"></span>';
        $HTML[] = '            <span class="icon-bar"></span>';
        $HTML[] = '        </button>';
        $HTML[] = '    </div>';
        $HTML[] = '    <div class="collapse navbar-collapse" id="nav-collapse">';
        $HTML[] = '        <ul class="nav navbar-nav">';
        $HTML[] = '            <li><a data-title="Encoder" id="encoder" href="?do=encoderAj" class="menuitem"><span class="glyphicon  glyphicon-transfer" aria-hidden="true"></span>&nbsp;Encoder</a></li>';
        $HTML[] = '            <li><a data-title="Hasher" href="?do=hasher" id="hashform" class="menuitem"><span class="glyphicon glyphicon-barcode" aria-hidden="true"></span>&nbsp;Hash factory</a></li>';
        $HTML[] = '            <li><a data-title="String Replace" id="stringreplace" class="menuitem" href="?do=strreplace"><span class="glyphicon glyphicon-random" aria-hidden="true"></span>&nbsp;Strreplace</a></li>';
        $HTML[] = '            <li><a data-title="Bit Operations" id="bitoperator" class="menuitem" href="?do=bitoperator"><span class="glyphicon glyphicon-adjust" aria-hidden="true"></span>&nbsp;Bit Operator</a></li>';
        $HTML[] = '            <li><a data-title="Colors" id="colors" href="?do=colors" class="menuitem"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>&nbsp;Colors</a></li>';
        $HTML[] = '        </ul>';
        $HTML[] = '    </div>';
        $HTML[] = '</nav>';

        return $HTML;
    }
}