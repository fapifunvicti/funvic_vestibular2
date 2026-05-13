<?php
require_once "bootstrap.php";
include "layout/header.php";
include "layout/menu.php";

$cursosPresenciais = [
    ["nome"=>"Administração","link"=>"https://www.unifunvic.edu.br/administra%C3%A7%C3%A3o","disponibilidade"=>"Inscrições Abertas","area"=>"Humanas","periodo"=>"Noturno","ativo"=>false],
    ["nome"=>"Biomedicina","link"=>"https://www.unifunvic.edu.br/biomedicina","disponibilidade"=>"Inscrições Abertas","area"=>"Biológicas","periodo"=>"Matutino","ativo"=>true],
    ["nome"=>"Biomedicina","link"=>"https://www.unifunvic.edu.br/biomedicina","disponibilidade"=>"Inscrições Abertas","area"=>"Biológicas","periodo"=>"Noturno","ativo"=>true],
    ["nome"=>"Educação Física (Licenciatura)","link"=>"https://www.unifunvic.edu.br/educa%C3%A7%C3%A3o-f%C3%ADsica-licenciatura","disponibilidade"=>"Inscrições Abertas","area"=>"Biológicas","periodo"=>"Matutino","ativo"=>false],
    ["nome"=>"Educação Física (Licenciatura)","link"=>"https://www.unifunvic.edu.br/educa%C3%A7%C3%A3o-f%C3%ADsica-licenciatura","disponibilidade"=>"Inscrições Abertas","area"=>"Biológicas","periodo"=>"Noturno","ativo"=>true],
    ["nome"=>"Educação Física (Bacharelado)","link"=>"https://www.unifunvic.edu.br/educa%C3%A7%C3%A3o-f%C3%ADsica-bacharelado","disponibilidade"=>"Inscrições Abertas","area"=>"Biológicas","periodo"=>"Matutino","ativo"=>false],
    ["nome"=>"Educação Física (Bacharelado)","link"=>"https://www.unifunvic.edu.br/educa%C3%A7%C3%A3o-f%C3%ADsica-bacharelado","disponibilidade"=>"Inscrições Abertas","area"=>"Biológicas","periodo"=>"Noturno","ativo"=>false],
    ["nome"=>"Enfermagem","link"=>"https://www.unifunvic.edu.br/enfermagem","disponibilidade"=>"Inscrições Abertas","area"=>"Biológicas","periodo"=>"Noturno","ativo"=>false],
    ["nome"=>"Enfermagem","link"=>"https://www.unifunvic.edu.br/enfermagem","disponibilidade"=>"Inscrições Abertas","area"=>"Biológicas","periodo"=>"Matutino","ativo"=>false],
    ["nome"=>"Engenharia da Computação","link"=>"https://www.unifunvic.edu.br/engenharia-de-computa%C3%A7%C3%A3o","disponibilidade"=>"Inscrições Abertas","area"=>"Exatas","periodo"=>"Noturno","ativo"=>true],
    ["nome"=>"Engenharia de Controle e Automação","link"=>"https://www.unifunvic.edu.br/engenharia-de-controle-e-automa%C3%A7%C3%A3o","disponibilidade"=>"Inscrições Abertas","area"=>"Exatas","periodo"=>"Noturno","ativo"=>false],
    ["nome"=>"Engenharia de Produção","link"=>"https://www.unifunvic.edu.br/engenharia-de-produ%C3%A7%C3%A3o","disponibilidade"=>"Inscrições Abertas","area"=>"Exatas","periodo"=>"Noturno","ativo"=>false],
    ["nome"=>"Farmácia","link"=>"https://www.unifunvic.edu.br/f%C3%A1rmacia","disponibilidade"=>"Inscrições Abertas","area"=>"Biológicas","periodo"=>"Matutino","ativo"=>true],
    ["nome"=>"Farmácia","link"=>"https://www.unifunvic.edu.br/f%C3%A1rmacia","disponibilidade"=>"Inscrições Abertas","area"=>"Biológicas","periodo"=>"Noturno","ativo"=>true],
    ["nome"=>"Fisioterapia","link"=>"https://www.unifunvic.edu.br/fisioterapia","disponibilidade"=>"Inscrições Abertas","area"=>"Biológicas","periodo"=>"Matutino","ativo"=>true],
    ["nome"=>"Fisioterapia","link"=>"https://www.unifunvic.edu.br/fisioterapia","disponibilidade"=>"Inscrições Abertas","area"=>"Biológicas","periodo"=>"Noturno","ativo"=>true],
    ["nome"=>"Nutrição","link"=>"https://www.unifunvic.edu.br/nutri%C3%A7%C3%A3o","disponibilidade"=>"Inscrições Abertas","area"=>"Biológicas","periodo"=>"Matutino","ativo"=>false],
    ["nome"=>"Nutrição","link"=>"https://www.unifunvic.edu.br/nutri%C3%A7%C3%A3o","disponibilidade"=>"Inscrições Abertas","area"=>"Biológicas","periodo"=>"Noturno","ativo"=>false],
    ["nome"=>"Odontologia","link"=>"https://www.unifunvic.edu.br/odontologia","disponibilidade"=>"Inscrições Abertas","area"=>"Biológicas","periodo"=>"Matutino","ativo"=>true],
	["nome"=>"Odontologia","link"=>"https://www.unifunvic.edu.br/odontologia","disponibilidade"=>"Inscrições Abertas","area"=>"Biológicas","periodo"=>"Noturno","ativo"=>false],
    ["nome"=>"Pedagogia","link"=>"https://www.unifunvic.edu.br/pedagogia-licenciatura","disponibilidade"=>"Inscrições Abertas","area"=>"Humanas","periodo"=>"Noturno","ativo"=>true],
    ["nome"=>"Teologia","link"=>"https://www.unifunvic.edu.br/teologia","disponibilidade"=>"Inscrições Abertas","area"=>"Humanas","periodo"=>"Noturno","ativo"=>false],
    ["nome"=>"Medicina","link"=>"https://www.unifunvic.edu.br/medicina","disponibilidade"=>"Inscrições Abertas","area"=>"Biológicas","periodo"=>"Matutino","ativo"=>false],
];

$cursosSemipresenciais = [
    ["nome"=>"Administração","link"=>"https://www.unifunvic.edu.br/pinda/administra%C3%A7%C3%A3o","disponibilidade"=>"Inscrições Abertas","area"=>"Humanas","modalidade"=>"Semipresencial","ativo"=>true],
    ["nome"=>"Administração","link"=>"https://www.unifunvic.edu.br/pinda/administra%C3%A7%C3%A3o","disponibilidade"=>"Inscrições Abertas","area"=>"Humanas","modalidade"=>"Semipresencial Híbrido","ativo"=>false],
    ["nome"=>"Gestão de Recursos Humanos (Tecnólogo)","link"=>"https://www.unifunvic.edu.br/pinda/gest%C3%A3o-de-recursos-humanos-tecn%C3%B3logo","disponibilidade"=>"Inscrições Abertas","area"=>"Humanas","modalidade"=>"Semipresencial","ativo"=>false],
    ["nome"=>"Gestão Financeira (Tecnólogo)","link"=>"https://www.unifunvic.edu.br/pinda/gest%C3%A3o-financeira-tecn%C3%B3logo","disponibilidade"=>"-","area"=>"Humanas","modalidade"=>"Semipresencial","ativo"=>false],
    ["nome"=>"Gestão Pública (Tecnólogo)","link"=>"https://www.unifunvic.edu.br/pinda/gest%C3%A3o-p%C3%BAblica-tecn%C3%B3logo","disponibilidade"=>"Inscrições Abertas","area"=>"Humanas","modalidade"=>"Semipresencial","ativo"=>false],
    ["nome"=>"Pedagogia","link"=>"https://www.unifunvic.edu.br/pinda/pedagogia-licenciatura","disponibilidade"=>"Inscrições Abertas","area"=>"Humanas","modalidade"=>"Semipresencial","ativo"=> true],
    ["nome"=>"Teologia","link"=>"https://www.unifunvic.edu.br/pinda/teologia-bacharelado","disponibilidade"=>"Inscrições Abertas","area"=>"Humanas","modalidade"=>"Semipresencial","ativo"=> false],
    ["nome"=>"Análises e Desenvolvimento de Sistemas (Tecnólogo)","link"=>"https://www.unifunvic.edu.br/pinda/an%C3%A1lises-e-desenvolvimento-de-sistemas-tecn%C3%B3logo","disponibilidade"=>"-","area"=>"Exatas","modalidade"=>"Semipresencial","ativo"=>false],
    ["nome"=>"Automação Industrial (Tecnólogo)","link"=>"https://www.unifunvic.edu.br/pinda/automa%C3%A7%C3%A3o-industrial-tecn%C3%B3logo","disponibilidade"=>"Inscrições Abertas","area"=>"Exatas","modalidade"=>"Semipresencial","ativo"=>false],
    ["nome"=>"Engenharia da Computação","link"=>"https://www.unifunvic.edu.br/pinda/engenharia-de-computa%C3%A7%C3%A3o","disponibilidade"=>"Inscrições Abertas","area"=>"Exatas","modalidade"=>"Semipresencial","ativo"=>false],
    ["nome"=>"Engenharia da Computação","link"=>"https://www.unifunvic.edu.br/pinda/engenharia-de-computa%C3%A7%C3%A3o","disponibilidade"=>"Inscrições Abertas","area"=>"Exatas","modalidade"=>"Semipresencial Híbrido","ativo"=>false],
    ["nome"=>"Engenharia de Controle e Automação","link"=>"https://www.unifunvic.edu.br/pinda/engenharia-de-controle-e-automa%C3%A7%C3%A3o","disponibilidade"=>"Inscrições Abertas","area"=>"Exatas","modalidade"=>"Semipresencial","ativo"=>false],
    ["nome"=>"Engenharia de Produção","link"=>"https://www.unifunvic.edu.br/pinda/engenharia-producao-2021","disponibilidade"=>"Inscrições Abertas","area"=>"Exatas","modalidade"=>"Semipresencial","ativo"=>false],
    ["nome"=>"Biomedicina","link"=>"https://www.unifunvic.edu.br/pinda/biomedicina-2021","disponibilidade"=>"Inscrições Abertas","area"=>"Biológicas","modalidade"=>"Híbrido","ativo"=>false],
    ["nome"=>"Educação Física (Bacharel)","link"=>"https://www.unifunvic.edu.br/pinda/educa%C3%A7%C3%A3o-f%C3%ADsica-bacharel","disponibilidade"=>"Inscrições Abertas","area"=>"Biológicas","modalidade"=>"Híbrido","ativo"=>false],
    ["nome"=>"Educação Física (Licenciatura)","link"=>"https://www.unifunvic.edu.br/pinda/educa%C3%A7%C3%A3o-f%C3%ADsica-licenciatura","disponibilidade"=>"Inscrições Abertas","area"=>"Biológicas","modalidade"=>"Híbrido","ativo"=>false],
    ["nome"=>"Farmácia","link"=>"https://www.unifunvic.edu.br/pinda/farm%C3%A1cia","disponibilidade"=>"Inscrições Abertas","area"=>"Biológicas","modalidade"=>"Híbrido","ativo"=>false],
    ["nome"=>"Nutrição","link"=>"https://www.unifunvic.edu.br/pinda/nutri%C3%A7%C3%A3o","disponibilidade"=>"Inscrições Abertas","area"=>"Biológicas","modalidade"=>"Híbrido","ativo"=>false],
];


$cursosSemipresenciaisMococa = [
    ["nome"=>"Administração","link"=>"https://www.unifunvic.edu.br/pinda/administra%C3%A7%C3%A3o","disponibilidade"=>"Inscrições Abertas","area"=>"Humanas","modalidade"=>"Semipresencial","ativo"=>false],
    ["nome"=>"Administração","link"=>"https://www.unifunvic.edu.br/pinda/administra%C3%A7%C3%A3o","disponibilidade"=>"Inscrições Abertas","area"=>"Humanas","modalidade"=>"Semipresencial Híbrido","ativo"=>false],
    ["nome"=>"Gestão de Recursos Humanos (Tecnólogo)","link"=>"https://www.unifunvic.edu.br/pinda/gest%C3%A3o-de-recursos-humanos-tecn%C3%B3logo","disponibilidade"=>"Inscrições Abertas","area"=>"Humanas","modalidade"=>"Semipresencial","ativo"=>false],
    ["nome"=>"Gestão Financeira (Tecnólogo)","link"=>"https://www.unifunvic.edu.br/pinda/gest%C3%A3o-financeira-tecn%C3%B3logo","disponibilidade"=>"-","area"=>"Humanas","modalidade"=>"Semipresencial","ativo"=>false],
    ["nome"=>"Gestão Pública (Tecnólogo)","link"=>"https://www.unifunvic.edu.br/pinda/gest%C3%A3o-p%C3%BAblica-tecn%C3%B3logo","disponibilidade"=>"Inscrições Abertas","area"=>"Humanas","modalidade"=>"Semipresencial","ativo"=>false],
    ["nome"=>"Pedagogia","link"=>"https://www.unifunvic.edu.br/pinda/pedagogia-licenciatura","disponibilidade"=>"Inscrições Abertas","area"=>"Humanas","modalidade"=>"Semipresencial","ativo"=> true],
    ["nome"=>"Teologia","link"=>"https://www.unifunvic.edu.br/pinda/teologia-bacharelado","disponibilidade"=>"Inscrições Abertas","area"=>"Humanas","modalidade"=>"Semipresencial","ativo"=> false],
    ["nome"=>"Análises e Desenvolvimento de Sistemas (Tecnólogo)","link"=>"https://www.unifunvic.edu.br/pinda/an%C3%A1lises-e-desenvolvimento-de-sistemas-tecn%C3%B3logo","disponibilidade"=>"-","area"=>"Exatas","modalidade"=>"Semipresencial","ativo"=>false],
    ["nome"=>"Automação Industrial (Tecnólogo)","link"=>"https://www.unifunvic.edu.br/pinda/automa%C3%A7%C3%A3o-industrial-tecn%C3%B3logo","disponibilidade"=>"Inscrições Abertas","area"=>"Exatas","modalidade"=>"Semipresencial","ativo"=>false],
    ["nome"=>"Engenharia da Computação","link"=>"https://www.unifunvic.edu.br/pinda/engenharia-de-computa%C3%A7%C3%A3o","disponibilidade"=>"Inscrições Abertas","area"=>"Exatas","modalidade"=>"Semipresencial","ativo"=>false],
    ["nome"=>"Engenharia da Computação","link"=>"https://www.unifunvic.edu.br/pinda/engenharia-de-computa%C3%A7%C3%A3o","disponibilidade"=>"Inscrições Abertas","area"=>"Exatas","modalidade"=>"Semipresencial Híbrido","ativo"=>false],
    ["nome"=>"Engenharia de Controle e Automação","link"=>"https://www.unifunvic.edu.br/pinda/engenharia-de-controle-e-automa%C3%A7%C3%A3o","disponibilidade"=>"Inscrições Abertas","area"=>"Exatas","modalidade"=>"Semipresencial","ativo"=>false],
    ["nome"=>"Engenharia de Produção","link"=>"https://www.unifunvic.edu.br/pinda/engenharia-producao-2021","disponibilidade"=>"Inscrições Abertas","area"=>"Exatas","modalidade"=>"Semipresencial","ativo"=>false],
    ["nome"=>"Biomedicina","link"=>"https://www.unifunvic.edu.br/pinda/biomedicina-2021","disponibilidade"=>"Inscrições Abertas","area"=>"Biológicas","modalidade"=>"Híbrido","ativo"=>false],
    ["nome"=>"Educação Física (Bacharel)","link"=>"https://www.unifunvic.edu.br/pinda/educa%C3%A7%C3%A3o-f%C3%ADsica-bacharel","disponibilidade"=>"Inscrições Abertas","area"=>"Biológicas","modalidade"=>"Híbrido","ativo"=>false],
    ["nome"=>"Educação Física (Licenciatura)","link"=>"https://www.unifunvic.edu.br/pinda/educa%C3%A7%C3%A3o-f%C3%ADsica-licenciatura","disponibilidade"=>"Inscrições Abertas","area"=>"Biológicas","modalidade"=>"Híbrido","ativo"=>false],
    ["nome"=>"Farmácia","link"=>"https://www.unifunvic.edu.br/pinda/farm%C3%A1cia","disponibilidade"=>"Inscrições Abertas","area"=>"Biológicas","modalidade"=>"Híbrido","ativo"=>false],
    ["nome"=>"Nutrição","link"=>"https://www.unifunvic.edu.br/pinda/nutri%C3%A7%C3%A3o","disponibilidade"=>"Inscrições Abertas","area"=>"Biológicas","modalidade"=>"Híbrido","ativo"=>false],
];

?>

<main role="main" class="container" style="margin-top: 100px;">

    <div class="text-left mt-5 pt-5" style="border-bottom: 5px solid #e5e5e5; margin-bottom: 20px; padding-bottom: 20px; margin-top: 50px;">
        <h1 style="font-size: 50px;"><b>CURSOS</b></h1>
        <p class="sub-titulo">Para o <?php echo $nome_vestibular; ?></p>
    </div>
    <br>

    <h2><b>CURSOS PRESENCIAIS</b></h2>
    
    <br>

    <div class="row">
        <div class="col">
            <h4>Centro Universitário FUNVIC (Pindamonhangaba)</h4>
            <hr>
            <div style="height: 300px; overflow: auto;">
                <table class="table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Curso</th>
                            <th>Disponibilidade</th>
                            <th>Área</th>
                            <th>Período</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php sort($cursosPresenciais); ?>
                        <?php foreach ($cursosPresenciais as $curso): ?>
                            <?php if ($curso["ativo"]): ?>
                                <tr>
                                    <td><a href="<?= $curso["link"] ?>" target="_blank"><?= $curso["nome"] ?></a></td>
                                    <td><?= $curso["disponibilidade"] ?></td>
                                    <td><?= $curso["area"] ?></td>
                                    <td><?= $curso["periodo"] ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <br><br><br>

    <h2><b>CURSOS SEMIPRESENCIAIS</b></h2>

    <br>

    <div class="row">
        <div class="col">
            <h4>Polo Pindamonhangaba</h4>
            <hr>
            <div style="height: 300px; overflow: auto;">
                <table class="table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Curso</th>
                            <th>Disponibilidade</th>
                            <th>Área</th>
                            <th>Modalidade</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php  sort($cursosSemipresenciais); ?>
                        <?php foreach ($cursosSemipresenciais as $curso): ?>
                            <?php if ($curso["ativo"]): ?>
                                <tr>
                                    <td><a href="<?= $curso["link"] ?>" target="_blank"><?= $curso["nome"] ?></a></td>
                                    <td><?= $curso["disponibilidade"] ?></td>
                                    <td><?= $curso["area"] ?></td>
                                    <td><?= $curso["modalidade"] ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
		
        <div class="col">
            <h4>Polo Mococa</h4>
            <hr>
            <div style="height: 300px; overflow: auto;">
                <table class="table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Curso</th>
                            <th>Disponibilidade</th>
                            <th>Área</th>
                            <th>Modalidade</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php  sort($cursosSemipresenciaisMococa);
						?>
                        <?php foreach ($cursosSemipresenciaisMococa as $curso): ?>
                            <?php if ($curso["ativo"]): ?>
							
                                <tr>
                                    <td><a href="<?= $curso["link"] ?>" target="_blank"><?= $curso["nome"] ?></a></td>
                                    <td><?= $curso["disponibilidade"] ?></td>
                                    <td><?= $curso["area"] ?></td>
                                    <td><?= $curso["modalidade"] ?></td>
                                </tr>
								

                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
	
	
</main>

<?php include "layout/footer.php" ?>
