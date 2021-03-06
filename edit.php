<?php
// set page headers
$page_title = "Editando Atração";
include_once "header.php";

// read Atração button
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-info pull-right'>";
        echo "<span class='glyphicon glyphicon-list-alt'></span> Ver Atrações ";
    echo "</a>";
echo "</div>";

// isset() is a PHP function used to verify if ID is there or not
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR! ID not found!');

// include database and object Atração file
include_once 'classes/database.php';
include_once 'classes/atracao.php';
include_once 'initial.php';

// instantiate Atração object
$atracao = new Atracao($db);
$atracao->id = $id;
$atracao->getAtracao();

// check if the form is submitted
if($_POST)
{

    // set Atração property values
    $atracao->nome = htmlentities(trim($_POST['nome']));
    $atracao->localizacao = htmlentities(trim($_POST['localizacao']));
    $atracao->dataEvento = htmlentities(trim($_POST['dataEvento']));
    $atracao->valorIngresso = htmlentities(trim($_POST['valorIngresso']));
    $atracao->duracaoEvento = $_POST['duracaoEvento'];

    // Edit Atração
    if($atracao->update()){
        echo "<div class=\"alert alert-success alert-dismissable\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">
                        &times;
                  </button>";
            echo "Success! Informações da Atração foram atualizadas.";
        echo "</div>";
    }

    // if unable to edit Atração
    else{
        echo "<div class=\"alert alert-danger alert-dismissable\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">
                        &times;
                  </button>";
            echo "Error! Não foi possivel atualizar as informações.";
        echo "</div>";
    }
}
?>

    <!-- Bootstrap Form for updating a Atração -->
    <form action='edit.php?id=<?php echo $id; ?>' method='post'>

        <table class='table table-hover table-responsive table-bordered'>

        <tr>
            <td>Nome</td>
            <td><input type='text' name='nome' value='<?php echo $atracao->nome;?>'  class='form-control' placeholder="Enter First Name" required></td>
        </tr>

        <tr>
            <td>Local</td>
            <td><input type='text' name='localizacao' value='<?php echo $atracao->localizacao;?>' class='form-control' placeholder="Enter Last Name" required></td>
        </tr>

        <tr>
            <td>Data do Evento</td>
            
            
            <td><input type='date' name='dataEvento' value='<?php echo DateTime::createFromFormat("Y-m-d H:i:s", $atracao->dataEvento)->format("Y-m-d");?>'  class='form-control' placeholder="Enter Email Address " required></td>
        </tr>

        <tr>
            <td>Valor Ingresso</td>
            <td><input type='number' name='valorIngresso' value='<?php echo $atracao->valorIngresso;?>' class='form-control' placeholder="Enter Mobile Number" required></td>
        </tr>

        <tr>
            <td>Duração (min)</td>
            <td><input type='number' name='duracaoEvento' value='<?php echo $atracao->duracaoEvento;?>' class='form-control' placeholder="Enter Mobile Number" required></td>
        </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-success" >
                        <span class=""></span> Atualizar
                    </button>
                </td>
            </tr>

        </table>
    </form>

<?php
include_once "footer.php";
?>