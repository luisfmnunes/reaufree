<?php
//include "utils/recaptchalib.php";

include "api/api.php";
require_once __DIR__ . '/vendor/autoload.php';

$repository = Dotenv\Repository\RepositoryBuilder::createWithNoAdapters()
    ->addAdapter(Dotenv\Repository\Adapter\EnvConstAdapter::class)
    ->addWriter(Dotenv\Repository\Adapter\PutenvAdapter::class)
    ->immutable()
    ->make();
$dotenv = Dotenv\Dotenv::create($repository, __DIR__);
$dotenv->load();


if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];

    switch ($lang) {
        case 'en':
            include_once 'languages/en.php';
            break; //Inglês
        case 'pt-br':
            include_once 'languages/pt_br.php';
            break; //Português Brasil
        case 'es':
            include_once 'languages/es.php';
            break; //Espanhol
        case 'cn':
            include_once 'language/cn.php';
            break; //Chinês
        default:
            include_once 'languages/pt_br.php';
            $lang = "pt-br";
            break;
    }
} else {
    $lang = "pt-br";
    include_once 'languages/pt_br.php';
}

if (isset($_REQUEST['w'])) {
    $wallet = $_REQUEST['w'];
} else {
    $wallet = "";
}

$myWallet = getenv("MY_WALLET");
//$sandbox = true;

function redirectionTo($path)
{
    echo "<script> window.location.href = '$path'; </script>";
}

?>

<!doctype html>
<html lang="<?= $lang ?>">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script data-ad-client="ca-pub-5075442842176820" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <link rel="shortcut icon" href="./img/favicon.png" />
    <link rel="stylesheet" href="./utils/main.css" />

    <!-- Meta SEO -->
    <meta name="description" content="Free $REAU. Our proposal is to allow anyone to have access to this new crypto coin, allowing the growth of the community even more!">
    <meta name="keywords" content="REAU,$REAU,Free $REAU,ganhe reau,como ganhar reau,earn reau,how to earn reau,reau vira lata finance,cómo ganar dinero reau,ganar reau,reau faucet,reau free faucet">

    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="https://www.google.com/recaptcha/api.js?hl=pt-BR"></script>
    <script src="utils/countdown.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script data-ad-client="ca-pub-5075442842176820" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <title><?= $text['title_page'] ?></title>

    <!--Lottie files-->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <!--Google ads-->
    <script data-ad-client="ca-pub-5075442842176820" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

</head>

<body>

    <!--Pra colocar o icone do mundo é esse código abaixo.-->
    <!--<p>&#127757;</p>-->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">$REAUfree</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $text['language'] ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="./?lang=pt-br&w=<?= $wallet ?>"><i class="flag flag-brazil"></i> Português Brasil</a></li>
                            <li><a class="dropdown-item" href="./?lang=en&w=<?= $wallet ?>"><i class="flag flag-united-states"></i> English</a></li>
                            <li><a class="dropdown-item" href="./?lang=es&w=<?= $wallet ?>"><i class="flag flag-spain"></i> Spanish</a></li>
                            <!-- <li><a class="dropdown-item" href="./?lang=cn&w=<?= $wallet ?>"><i class="flag flag-china"></i> Chinese</a></li> -->
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#faq"><?= $text['faq'] ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php

    if (isset($_GET['k'])) {
        if ($_GET['k'] == '58') {
            echo "<div class=\"alert alert-success d-flex justify-content-center\" role=\"alert\">
        $text[success_withdraw]
      </div>";
            echo "<script>
      setTimeout(() => {
        window.location.href = './?lang=$lang&w=$wallet';
      }, 3000);
      </script>";
        } else if ($_GET['k'] == '95') {
            echo "<div class=\"alert alert-danger d-flex justify-content-center\" role=\"alert\">
        $text[you_got_screwed]
      </div>";
        } else {
            echo "<div class=\"alert alert-danger d-flex justify-content-center\" role=\"alert\">
        $text[error_withdraw]
      </div>";
        }
    }

    ?>

    <div class="mt-4 text-center p-3">
        <img class="d-block mx-auto mb-4" src="./img/logo.png" alt="" width="90" height="90">
        <h1 class="display-5 fw-bold"><?= $text['title'] ?></h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4"><?= $text['description1'] ?> <b><br><?= $text['description2'] ?> <?php echo number_format(getTable()->value_paid, 0, ',', '.');  ?> <?= $text['description3'] ?></b><br> <br><?= $text['warning1'] ?> <?= "<b>" . getMinimumWithdraw(getFee(false), true) ?> <?= $text['warning2'] ?> <?= "<b>" . getFee(true) ?> <?= $text['warning3'] ?> </p>
            <small class="text-muted"><?= $text['warning4'] ?></small>
            <form method="POST" autocomplete="on">
                <div class="input-group mb-3 mt-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-wallet"></i></span>
                    <input type="text" class="form-control" value="<?php if ($wallet != null) {
                                                                        echo $wallet;
                                                                    } else {
                                                                        echo "";
                                                                    } ?>" id="wallet" name="wallet" required placeholder="<?= $text['you_wallet_here'] ?>" aria-label="wallter" aria-describedby="basic-addon1">
                </div>

                <div id="timer-div" class="d-flex justify-content-center d-none" hidden>
                    <div class="d-flex align-items-end">
                        <lottie-player src="https://assets3.lottiefiles.com/packages/lf20_IVj0pN.json" background="transparent" speed="0.5" style="width: 300px;" loop autoplay>
                        </lottie-player>
                        <span id="timer" name="timer" class="lead mb-4 fs-1 timer">
                            <?php if ($wallet != null) {
                                echo getTimeLastPay($wallet);
                            } ?>
                        </span>
                    </div>
                </div>

                <div id="captcha" class="g-recaptcha d-grid gap-2 d-sm-flex justify-content-sm-center mb-4" data-sitekey="6LcB3ZkaAAAAAN3r2rMwrLSDQMhKqZl9FHhPhv5Q"></div>

                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <button id="receber" type="submit" name="receber" class="btn btn-primary btn-lg px-4"><?= $text['receive_my_reau'] ?></button>
                    <button type="button" class="btn btn-warning btn-lg px-4"><?= $text['my_balance'] . "" . getSaldoUser($wallet, true) ?></button>
                    <button id="sacar" type="submit" <?php if (getSaldoUser($wallet, false) >= (getFee(false) + 1000000)) {
                                                            echo "";
                                                        } else {
                                                            echo "hidden";
                                                        } ?> name="sacar" class="btn btn-success btn-lg px-4"><?= $text['withdraw'] ?></button>
                </div>


                <div class="text-align" <?php if (getSaldoUser($wallet, false) >= (getFee(false) + 1000000)) {
                                            echo "";
                                        } else {
                                            echo "hidden";
                                        } ?>>
                    <br>
                    <div class="alert alert-success d-flex justify-content-center" role="alert">
                        <?= $text['balance_available']; ?> <?php if (getSaldoUser($wallet, false) >= (getFee(false) + 1000000)) {
                                                                echo number_format(doubleval(getSaldoUser($wallet, false)) - doubleval(getFee(false)), 0, ',', '.');
                                                            }  ?>
                    </div>
                </div>

                <br>
                <h5><?= $text['balance_master_wallet'] ?></h5>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mt-2">
                    <button type="button" class="btn btn-success btn-lg px-4"><?php echo "\$REAU " . getSaldoDisponivel(true) . " " . getTable()->unidade ?></button>
                </div>

                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mt-2">
                    <button type="button" class="btn btn-primary btn-lg px-4 text-white" data-bs-toggle="modal" data-bs-target="#walletmodal"><?= $text['i_wanna_help'] ?></button>
                </div>

            </form>
            <audio id="timer_zero">
                <source src="assets/cachorro_latindo.mp3" type="audio/mpeg">
            </audio>

            <?php

            $secret = "6LcB3ZkaAAAAAEEFfLdgboFkkRNpZG7qGavDM2mX";

            if (isset($_POST['g-recaptcha-response'])) {
                $recaptcha = new \ReCaptcha\ReCaptcha($secret);
                $response = $recaptcha->setExpectedHostname($_SERVER['SERVER_NAME'])
                    ->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

                if ($response != null && $response->isSuccess()) {

                    $wallet = $_POST['wallet'];

                    include 'conexao/conexao.php';

                    //Verifica se o usuário já tem cadastro
                    $sql = "SELECT * FROM users WHERE wallet = '$wallet' LIMIT 1;";
                    $busca = mysqli_query($conexao, $sql);

                    if ($dados = mysqli_fetch_array($busca) > 0) { //Atualiza no Banco de Dados
                        $sql = "UPDATE users SET updated = NOW() WHERE wallet = '$wallet';";
                        $update = mysqli_query($conexao, $sql);
                    } else { //Insere no Banco de Dados
                        $sql = "REPLACE INTO users (wallet, updated) values ('$wallet', NOW());";
                        $inserir = mysqli_query($conexao, $sql);
                    }

                    //Faz a validação do tempo
                    $sql = "SELECT TIMEDIFF('00:15:00', TIMEDIFF(NOW(), created)) as timer FROM logs WHERE wallet = '$wallet' AND type_transaction = 'C' ORDER BY id DESC LIMIT 1;";
                    $busca = mysqli_query($conexao, $sql);

                    while ($dados = mysqli_fetch_array($busca)) {
                        $timer = $dados['timer'];
                    }

                    //Caso esteja tentando sacar antes da hora, vai ser punido
                    if ($timer >= '00:00:00') {

                        redirectionTo("./?lang=$lang&w=$wallet&k=95");

                        $sql = "UPDATE logs SET created = ADDTIME(created, '00:15:00') WHERE wallet = '$wallet' AND type_transaction = 'C' ORDER BY id DESC LIMIT 1";
                        $update = mysqli_query($conexao, $sql);
                    } else {
                        //Adicionar CRÉDITO ao saldo do Usuário
                        if (isset($_POST['receber'])) {
                            //Insere no log
                            include 'conexao/conexao.php';
                            $newValuePaid = getTable()->value_paid;
                            $sql = "INSERT INTO logs(wallet, my_wallet, transfered_value, type_transaction) VALUES('$wallet','$myWallet', $newValuePaid,'C')";
                            $inserir = mysqli_query($conexao, $sql);
                            $affected_rows = mysqli_affected_rows($conexao);
                            if ($affected_rows == 1) {
                                //Ao redirecionar, inicia o timer.
                                //var_dump("./?lang=$lang&w=$wallet&k=58");
                                //header("Location: ./?lang=$lang&w=$wallet&k=58");
                                redirectionTo("./?lang=$lang&w=$wallet&k=58");
                            } else {
                                redirectionTo("./?lang=$lang&w=$wallet&k=2");
                            }
                        }
                    }


                    $balance_user_formated = doubleval(getSaldoUser($wallet, true)) - doubleval(getFee(true));

                    //O usuário deseja sacar o valor - DÉBITO
                    if (isset($_POST['sacar'])) {
                        //Caso o tempo já tenha acabado, vai ser adicionado um novo valor no saldo.
                        if (paidValueToUser($balance_user_formated, $wallet)) {
                            //Insere no log
                            $getFee = getFee(false);
                            $paid_value = doubleval(getSaldoUser($wallet, false)) - doubleval(getFee(false));

                            $sql = "INSERT INTO logs(wallet, my_wallet, transfered_value, type_transaction, fee) VALUES('$wallet','$myWallet', $paid_value,'D', $getFee)";
                            $inserir = mysqli_query($conexao, $sql);
                            $affected_rows = mysqli_affected_rows($conexao);

                            if ($affected_rows == 1) {
                                //Ao redirecionar, inicia o timer.
                                redirectionTo("./?lang=$lang&w=$wallet&k=58");
                            }
                        } else {
                            redirectionTo("./?lang=$lang&w=$wallet&k=2");
                        }
                    }
                } else {
                    $errors = $response->getErrorCodes();
                }
            }

            ?>


            <?php
            include_once 'faq.php';
            include_once "modal_info.php";
            //Tem que deixar o modal aqui embaixo senão dá erro.
            ?>

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
</body>

</html>