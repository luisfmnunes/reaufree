<?php


function getTable(){

    include_once "./languages/language.php";

    include getLanguages();

    //100 milhões em saldo
    if (getSaldoDisponivel(true) >= '100.000.000') {
      return json_decode('{"value_paid": 31000, "unidade": "'.$text['acronym_million'].'"}'); //mi
    } else

        //1 bilhão em Saldo
        if (getSaldoDisponivel(true) >= '1.000.000.000') {
            return json_decode('{"value_paid": 62000, "unidade": "bi"}');
        } else

        //10 bilhões em Saldo
        if (getSaldoDisponivel(true) >= '10.000.000.000') {
            return json_decode('{"value_paid": 125000, "unidade": "bi"}');
        } else

                //100 bilhões em Saldo
                if (getSaldoDisponivel(true) >= '100.000.000.000') {
                    return json_decode('{"value_paid": 250000, "unidade": "bi"}');
                } else

                    //1 trilhão em Saldo
                    if (getSaldoDisponivel(true) >= '1.000.000.000.000') {
                        return json_decode('{"value_paid": 500000, "unidade": "tri"}');
                    } else

                        //2 trilhões em Saldo
                        if (getSaldoDisponivel(true) >= '2.000.000.000.000') {
                            return json_decode('{"value_paid": 1000000, "unidade": "tri"}');
                        }
}

function getSaldo($formated){
    try {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://brasilbitcoin.com.br/api/get_balance',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                "Authentication: " . getenv('API_AUTHENTICATION')
            ),
        ));

        $response = curl_exec($curl);


        $resposta = json_decode($response);

        curl_close($curl);

        if ($formated) {
            return number_format($resposta->reau * 1000000, 0, ',', '.');
        } else {
            return doubleval($resposta->reau * 1000000);
        }
    } catch (\Throwable $th) {
        return 0;
    }
}

function paidValueToUser($balance_user, $wallet){
    include 'conexao/conexao.php';
    $sandbox = false;
    if ($sandbox) {
        return true;
    } else {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://brasilbitcoin.com.br/api/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('coin' => 'REAU', 'amount' => $balance_user, 'address' => $wallet, 'priority' => 'medium'),
            CURLOPT_HTTPHEADER => array(
                'Authentication: ' . getenv('API_AUTHENTICATION')
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $retorno = false;

        try {
            $resposta = json_decode($response);

            if (!$resposta == null) {
                $retorno = $resposta->success;
            }
        } catch (\Throwable $th) {
            $retorno = false;
        }

        return $retorno;
    }
}

function getFee($formated, $exchange = "NOPE"){
  if($exchange == "BRBTC"){
    return 0;
  }else{
    try {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://brasilbitcoin.com.br/api/estimate/sell/REAU/1',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authentication: ' . getenv('API_AUTHENTICATION')
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $resposta = json_decode($response);

        if ($formated) { //Retorna formatado
            return number_format((1000000 / $resposta->message), 0, ',', '.');
        } else { //Retorna sem formatação
            return (1000000 / $resposta->message);
        }
    } catch (\Throwable $th) {
        return 0;
    }
  }
}

function getMinimumWithdraw($fee, $formated){
    if ($formated) {
        return number_format(($fee + 1000000), 0, ',', '.');
    } else {
        return ($fee + 1000000);
    }
}

function getSaldoUser($wallet, $formated){
    include 'conexao/conexao.php';

    if ($wallet != null) {
        //Verifica saldo do Usuário
        $sql = "SELECT SUM(transfered_value) as 'saldo' FROM logs WHERE wallet = '$wallet' AND type_transaction = 'C' LIMIT 1;";
        $busca = mysqli_query($conexao, $sql);

        while ($dados = mysqli_fetch_array($busca)) {
            $saldo = $dados['saldo'];
        }

        if ($saldo != 0) {
            $sql = "SELECT SUM(transfered_value) as 'debito', SUM(fee) as 'taxa' FROM logs WHERE wallet = '$wallet' AND type_transaction = 'D' LIMIT 1;";
            $busca = mysqli_query($conexao, $sql);

            while ($dados = mysqli_fetch_array($busca)) {
                $debito = $dados['debito'];
                $taxa = $dados['taxa'];
            }

            if ($formated) {
                return number_format($saldo - ($debito + $taxa), 0, ',', '.');
            } else {
                return $saldo - ($debito + $taxa);
            }
        }
    }

    return 0;
}

function getSaldoLiquidoMasterWallet($formated){

    include 'conexao/conexao.php';

    $sql = "SELECT SUM(transfered_value) as 'saldo' FROM logs WHERE type_transaction = 'C' LIMIT 1;";
    $busca = mysqli_query($conexao, $sql);

    while ($dados = mysqli_fetch_array($busca)) {
        $saldo = $dados['saldo'];
    }

    if ($saldo != 0) {
        $sql = "SELECT SUM(transfered_value) as 'debito', SUM(fee) as 'taxa' FROM logs WHERE type_transaction = 'D' LIMIT 1;";
        $busca = mysqli_query($conexao, $sql);

        while ($dados = mysqli_fetch_array($busca)) {
            $debito = $dados['debito'];
            $taxa = $dados['taxa'];
        }

        if ($formated) {
            return number_format($saldo - ($debito + $taxa), 0, ',', '.');
        } else {
            return doubleval($saldo - ($debito + $taxa));
        }
    }

    return 0;
};

function getSaldoDisponivel($formated){
    if ($formated) {
        $saldoDisponivel = getSaldo(false) - getSaldoLiquidoMasterWallet(false);
        return number_format($saldoDisponivel, 0, ',', '.');
    } else {
        $saldoDisponivel = doubleval(getSaldo(false) - getSaldoLiquidoMasterWallet(false));
        return doubleval($saldoDisponivel);
    }
}

function formatValue($value){
    return number_format($value, 0, ',', '.');
}

function getTimeLastPay($wallet){

    date_default_timezone_set('America/Fortaleza');
    $today = date("Y-m-d H:i:s");

    include 'conexao/conexao.php';

    //Verifica se o usuário já fez algum saque
    $sql = "SELECT * FROM logs WHERE wallet = '$wallet' LIMIT 1;";
    $busca = mysqli_query($conexao, $sql);

    if ($dados = mysqli_fetch_array($busca) > 0) {
        $sql = "SELECT *, TIMEDIFF('00:15:00', TIMEDIFF(NOW(), created)) as timer FROM logs WHERE wallet = '$wallet' ORDER BY id DESC LIMIT 1;";

        $busca = mysqli_query($conexao, $sql);

        while ($dados = mysqli_fetch_array($busca)) {
            $id = $dados['id'];
            $wallet = $dados['wallet'];
            $transfered_value = $dados['transfered_value'];
            $created = $dados['created'];
            $timer = $dados['timer'];
        }

        if ($timer >= '00:00:00') {
            $t = explode(":", $timer);
            echo "<script>
    setTimeout(() => {
     countdown($t[1], $t[2])
    }, 1000);
    </script>";
        } else {
            echo "<script>
    setTimeout(() => {
     countdown(0, 0)
    }, 1000);
    </script>";
        }
    }
}
