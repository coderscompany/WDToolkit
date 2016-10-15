<?php
session_name('wdtoolkit');
session_start();

require_once('src' . DIRECTORY_SEPARATOR . 'autoloader.php');

$NAV = src\html\Navigation::show();
$CONTENT = array();

if (!isset($_GET['do'])) $_GET['do'] = '-';
switch ($_GET['do']) {

    case 'main':
        if (!isset($_GET['action'])) {
            $CONTENT = src\html\Encoder::getEncoder();
        }
        else {
            switch ($_GET['action']) {
                case 'encode':
                    $encoder = new src\model\Encoder();
                    echo $encoder -> encode($_POST['decoded'], $_POST['algorithm'], $_POST['compress'], $_POST['strength']);
                    exit();
                    break;

                case 'decode':
                    $decoder = new src\model\Encoder();
                    echo $decoder -> decode($_POST['encoded'], $_POST['algorithm'], $_POST['compress']);
                    exit();
                    break;

                case 'strreplace':
                    if (isset($_POST['string']) && isset($_POST['replacement']) && isset($_POST['decoded'])) {
                        $foo = str_replace($_POST['string'], $_POST['replacement'], $_POST['decoded']);
                        echo $foo;
                        exit();
                    }
                    break;
            }
        }
        break;

    case 'encoderAj':
        echo implode(PHP_EOL, src\html\Encoder::getEncoder());
        exit();
        break;

    case 'hasher':
        if (isset($_GET['action'])) {
            switch ($_GET['action']) {
                case 'hash':
                    if ($_POST['plain'] != null && $_POST['plain'] != '') {
                        $hasher = new src\model\Hasher($_POST['plain'], $_POST['algo']);
                        if ($_POST['salt'] == null || $_POST['salt'] == '') {
                            $hash = $hasher->getHash();
                        } else {
                            $hash = $hasher->getHash($_POST['salt']);
                        }
                        $_SESSION['hashes'][$hash] = array('plain' => $_POST['plain'], 'algo' => $_POST['algo'], 'salt' => $_POST['salt']);
                        echo implode(PHP_EOL, src\html\Hasher::getHasher($hash));
                        exit();
                    }
                    break;

                case 'hashf';
                    $filename = basename('_tmp' . DIRECTORY_SEPARATOR . $_FILES['hashfile']['name']);
                    if (move_uploaded_file($_FILES['hashfile']['tmp_name'], '_tmp' . DIRECTORY_SEPARATOR . $filename)) {
                        $hasher = new src\model\Hasher(null, $_POST['algof'], '_tmp' . DIRECTORY_SEPARATOR . $filename);
                        $hash = $hasher->getHash();
                        $_SESSION['hashedfiles'][date('H:i:s')] = array('algo' => $_POST['algof'], 'hash' => $hash, 'file' => $filename, 'size' => $_FILES['hashfile']['size']);
                        echo implode(PHP_EOL, src\html\Hasher::getHasher($hash));
                        exit();
                    }
                    else {
                        echo implode(PHP_EOL, src\html\Hasher::getHasher());
                        exit();
                    }



                    break;

                case 'deleteallhashes':
                    session_name('wdtoolkit');
                    unset($_SESSION['hashes']);
                    echo implode(PHP_EOL, src\html\Hasher::getHasher());
                    exit();
                    break;

                case 'rehash':
                    if (isset($_GET['hash'])) {
                        if (isset($_SESSION['hashes'][$_GET['hash']]['salt'])) {
                            echo json_encode(array('plain' => $_SESSION['hashes'][$_GET['hash']]['plain'], 'salt' => $_SESSION['hashes'][$_GET['hash']]['salt'], 'hash' => $_GET['hash']));
                            exit();
                        } else {
                            echo json_encode(array('plain' => $_SESSION['hashes'][$_GET['hash']]['plain'], 'salt' => '', 'hash' => $_GET['hash']));
                            exit();
                        }
                    }
                    break;

                default:
                    echo implode(PHP_EOL, src\html\Hasher::getHasher());
                    exit();
                    break;
            }
        } else {
            echo implode(PHP_EOL, src\html\Hasher::getHasher());
            exit();
        }
        break;

    case 'deletehash':
        if (isset($_GET['file']) && isset($_GET['time'])) {
            foreach ($_SESSION['hashedfiles'] as $key => $value) {
                if ($value['file'] == $_GET['file'] && $key == $_GET['time']) {
                    unset($_SESSION['hashedfiles'][$key]);
                    echo implode(PHP_EOL, src\html\Hasher::getHasher());
                    exit();
                }
            }
        }
        elseif (isset($_GET['hash'])) {
            unset($_SESSION['hashes'][$_GET['hash']]);
            echo implode(PHP_EOL, src\html\Hasher::getHasher());
            exit();
        }
        else {
            echo implode(PHP_EOL, src\html\Hasher::getHasher());
            exit();
        }
        break;

    case 'colors':
        if (isset($_GET['action'])) {
            switch($_GET['action']) {
                case 'rgb2hex':
                    if (isset($_POST['color'])) {
                        $rgb = src\model\Colors::hex2grb($_POST['color']);
                        $rgbc = $rgb['r'] . ' ' . $rgb['g'] . ' ' . $rgb['b'];
                        $_SESSION['colors'][$_POST['color']] = $rgbc;
                    }
                    echo implode(PHP_EOL, src\html\Colors::getColors() );
                    exit();
                    break;

                case 'delete':
                    if (isset($_GET['col'])) {
                        unset($_SESSION['colors'][$_GET['col']]);
                    }
                    echo implode(PHP_EOL, src\html\Colors::getColors() );
                    exit();
                    break;

                case 'deleteall':
                    unset($_SESSION['colors']);
                    echo implode(PHP_EOL, src\html\Colors::getColors() );
                    exit();
                    break;

                default:
                    $CONTENT = src\html\Colors::getColors();
                    echo implode(PHP_EOL, src\html\Colors::getColors() );
                    exit();
                    break;
            }
        }
        else {
            echo implode(PHP_EOL, src\html\Colors::getColors() );
            exit();
        }

        break;

    case 'strreplace':
        if (isset($_GET['action'])) {
            if (isset($_POST['search']) && isset($_POST['replace']) && isset($_POST['before'])) {
                switch ($_GET['action']) {
                    case 'replaceall':
                        echo str_replace($_POST['search'], $_POST['replace'], $_POST['before']);
                        exit();
                        break;
                }
            }
        }
        echo implode(PHP_EOL, src\html\Strreplace::getStrreplace());
        exit();
        break;
		
    case 'bitoperator':
        if (!isset($_GET['action'])) {
            if (isset($_SESSION['first']) && isset($_SESSION['second'])) {
                echo implode(PHP_EOL, src\html\Bitoperator::getBitoperator($_SESSION['first'], $_SESSION['second']));
                unset($_SESSION['first']);
                unset($_SESSION['second']);
                exit();
            }
            elseif (isset($_SESSION['first']) && !isset($_SESSION['second'])) {
                echo implode(PHP_EOL, src\html\Bitoperator::getBitoperator($_SESSION['first']));
                unset($_SESSION['first']);
                exit();
            }
            elseif (!isset($_SESSION['first']) && isset($_SESSION['second'])) {
                echo implode(PHP_EOL, src\html\Bitoperator::getBitoperator(null, $_SESSION['second']));
                unset($_SESSION['second']);
                exit();
            } else {
                echo implode(PHP_EOL, src\html\Bitoperator::getBitoperator());
                exit();
            }
        } else {
            if (isset($_POST['first']) && isset($_POST['second'])) {
                $bitoperator = new src\model\Bitoperator($_POST['first'], $_POST['second']);
                echo $bitoperator->operate($_GET['action']);
                exit();
            }
        }
        break;

    case 'deletefilehashes':
        $_SESSION['hashedfiles'] = null;
        echo implode(PHP_EOL, src\html\Hasher::getHasher());
        exit();
        break;

    case 'storeinsession':
        $_SESSION[$_GET['var']] = $_GET['value'];
        break;

    default:
        header('Location: ?do=main');
        break;

}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>WDToolkit</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Sebastian Bitter">
        <meta name="application-name" content="WDToolkit">
        <meta name="application-version" content="1.0">
        <link rel="stylesheet" type="text/css" media="all" href="public/css/style.css">
        <script type="text/javascript" src="public/js/jquery-2.1.3.min.js"></script>
        <script type="text/javascript" src="public/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="public/js/bootstrap-switch.min.js"></script>
        <script type="text/javascript" src="public/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="public/js/jslib.js"></script>
    </head>
    <body>
        <header class="header">
            <?php echo implode(PHP_EOL, $NAV); ?>
        </header>
        <div class="content container">
            <?php echo implode(PHP_EOL, $CONTENT); ?>
        </div>
        <footer class="footer">
            <span>WDToolkit 1.0</span>
        </footer>
    </body>
</html>