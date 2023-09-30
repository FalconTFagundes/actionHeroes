<?php
function listarRegistroDoisParametro($tabela, $campos, $idcampo, $idparametro, $idCampo2, $idparametro2, $ativo)
{
    $conn = conectar();
    try {
        if (is_numeric($idparametro)) {
            $conn->beginTransaction();
            $sqlLista = $conn->prepare("SELECT $campos "
                . "FROM $tabela "
                . "WHERE $idcampo = ? AND $idCampo2 = ? AND ativo = ?");
            $sqlLista->bindValue(1, $idparametro, PDO::PARAM_INT);
            $sqlLista->bindValue(2, $idparametro2, PDO::PARAM_STR);
            $sqlLista->bindValue(3, $ativo, PDO::PARAM_STR);
            $sqlLista->execute();
            if ($sqlLista->rowCount() > 0) {
                return $sqlLista->fetchAll(PDO::FETCH_OBJ);
            } else {
                return 'Vazio';
            }
        } else {
            return 'Variável não é aceita!';
        }
    } catch (PDOException $e) {
        echo 'Exception -> ';
        return $e->getMessage();
        $conn->rollback();
    } finally {
        $conn = null;
    }
}

function listarTodosRegistros($tabela, $campos, $ativo)
{
    $conn = conectar();
    try {
        $sqlLista = $conn->prepare("SELECT $campos FROM $tabela WHERE ativo = ?");
        $sqlLista->bindValue(1, $ativo, PDO::PARAM_STR);
        $sqlLista->execute();
        if ($sqlLista->rowCount() > 0) {
            return $sqlLista->fetchAll(PDO::FETCH_OBJ);
        } else {
            return 'Vazio';
        }
    } catch (PDOException $e) {
        echo 'Exception -> ';
        return $e->getMessage();
    } finally {
        $conn = null;
    }
}

function listarTodosRegistrosId($tabela, $campos, $ativo, $campoid, $id)
{
    $conn = conectar();
    try {
        $sqlLista = $conn->prepare("SELECT $campos FROM $tabela WHERE ativo = ? AND $campoid = ?");
        $sqlLista->bindValue(1, $ativo, PDO::PARAM_STR);
        $sqlLista->bindValue(2, $id, PDO::PARAM_INT);
        $sqlLista->execute();
        if ($sqlLista->rowCount() > 0) {
            return $sqlLista->fetchAll(PDO::FETCH_OBJ);
        } else {
            return 'Vazio';
        }
    } catch (PDOException $e) {
        echo 'Exception -> ';
        return $e->getMessage();
    } finally {
        $conn = null;
    }
}

function listarOutrasCategorias($campos, $tabela, $ativo, $campoid)
{
    $conn = conectar();
    try {
        $sqlLista = $conn->prepare("SELECT $campos FROM $tabela WHERE ativo = ? AND $campoid <> (SELECT MAX($campoid) FROM $tabela)");
        $sqlLista->bindValue(1, $ativo, PDO::PARAM_STR);
        $sqlLista->execute();
        if ($sqlLista->rowCount() > 0) {
            return $sqlLista->fetchAll(PDO::FETCH_OBJ);
        } else {
            return 'Vazio';
        }
    } catch (PDOException $e) {
        echo 'Exception -> ';
        return $e->getMessage();
    } finally {
        $conn = null;
    }
}

function cadastroReserva($nome, $email, $telefone, $data, $hora, $pessoas, $mensagem)
{
    $conn = conectar();
    try {
        $sqlLista = $conn->prepare("INSERT INTO reserva(nome, email, telefone, datareserva, hora, quantidade, mensagem) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $sqlLista->bindValue(1, $nome, PDO::PARAM_STR);
        $sqlLista->bindValue(2, $email, PDO::PARAM_STR);
        $sqlLista->bindValue(3, $telefone, PDO::PARAM_STR);
        $sqlLista->bindValue(4, $data, PDO::PARAM_STR);
        $sqlLista->bindValue(5, $hora, PDO::PARAM_STR);
        $sqlLista->bindValue(6, $pessoas, PDO::PARAM_INT);
        $sqlLista->bindValue(7, $mensagem, PDO::PARAM_STR);
        $sqlLista->execute();

        if ($sqlLista->rowCount() > 0) {
            return "Cadastrado";
        } else {
            return "Vazio!";
        }
    } catch (PDOException $e) {
        echo 'Exception -> ';
        return $e->getMessage();
    } finally {
        $conn = null;
    }
}

function cadastroContato($nome_contato, $email_contato, $assunto_contato, $mensagem_contato)
{
    $conn = conectar();
    try {
        $sqlLista = $conn->prepare("INSERT INTO contato(nome, email, assunto, mensagem) VALUES (?, ?, ?, ?)");
        $sqlLista->bindValue(1, $nome_contato, PDO::PARAM_STR);
        $sqlLista->bindValue(2, $email_contato, PDO::PARAM_STR);
        $sqlLista->bindValue(3, $assunto_contato, PDO::PARAM_STR);
        $sqlLista->bindValue(4, $mensagem_contato, PDO::PARAM_STR);
        $sqlLista->execute();

        if ($sqlLista->rowCount() > 0) {
            return "Cadastrado";
        } else {
            return "Vazio!";
        }
    } catch (PDOException $e) {
        echo 'Exception -> ';
        return $e->getMessage();
    } finally {
        $conn = null;
    }
}


/* dashboard 17/07/2023 */
function listarDashboard($campo, $tabela)
{
    $conn = conectar();
    $queryListar = $conn->prepare("SELECT $campo FROM $tabela");
    $queryListar->execute();
    if ($queryListar->rowCount() > 0) {
        return $queryListar->fetchAll(PDO::FETCH_OBJ);
    } else {
        return 'Vazio';
    }
}

/* EXCLUIR */

function excluirDashboardYummy($tabela, $campoid, $id)
{
    $conn = conectar();
    $queryListar = $conn->prepare("DELETE FROM $tabela WHERE $campoid = $id");
    $queryListar->execute();
    if ($queryListar->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}


/* INSERT */

function insertDois($tabela, $camposTabela, $valor1, $valor2)
{
   
    $conn = conectar();
    try {
        $sqlInsert = $conn->prepare("INSERT INTO $tabela($camposTabela) VALUES (?, ?)");
        $sqlInsert->bindValue(1, $valor1, PDO::PARAM_STR);
        $sqlInsert->bindValue(2, $valor2, PDO::PARAM_STR);
       
        $sqlInsert->execute();

        if ($sqlInsert->rowCount() > 0) {
            return "Cadastrado";
        } else {
            return "Vazio";
        }
    } catch (PDOException $e) {
        echo 'Exception -> ';
        return $e->getMessage();
    } finally {
        $conn = null;
    }
}
function insertTres($tabela, $camposTabela, $valor1, $valor2, $value3)
{
   
    $conn = conectar();
    try {
        $sqlInsert = $conn->prepare("INSERT INTO $tabela($camposTabela) VALUES (?, ?, ?)");
        $sqlInsert->bindValue(1, $valor1, PDO::PARAM_STR);
        $sqlInsert->bindValue(2, $valor2, PDO::PARAM_STR);
        $sqlInsert->bindValue(3, $value3, PDO::PARAM_STR);
       
        $sqlInsert->execute();

        if ($sqlInsert->rowCount() > 0) {
            return "Cadastrado";
        } else {
            return "Vazio";
        }
    } catch (PDOException $e) {
        echo 'Exception -> ';
        return $e->getMessage();
    } finally {
        $conn = null;
    }
}


/* UPDATE */