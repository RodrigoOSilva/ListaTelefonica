<?php header("Access-Control-Allow-Origin: *");?>
<!DOCTYPE html>
<html ng-app="phoneDirectory">
    <head>

        <title>Lista Telefonica</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="bootstrap-4.3.1-dist/css/bootstrap.css">
        <link rel="icon" type="image/png" href="icon.png"/>

        <!-- css -->
        <style>
                .jumbotron {
                    width: 600px;
                    text-align: center;
                    margin: 0 auto;
                    margin-top: 20px;
                }
                .table {
                    margin-top: 20px;
                }

                .selected {
                    background-color: yellow;
                }

        </style>
        <!-- css -->

        <!-- angular -->

        <script src="angular/angular.js"></script>
        <script src="angular/angular-locale_pt-br.js"></script>
        <script src="angular/angular-messages.js"></script>
        <script src="controllers.js"></script>


    </head>

    <!-- view -->
    <body ng-controller="phoneDirectoryCtrl">
       <div class="jumbotron">

           <h3>{{app}}</h3>
           <input class="form-control" type="text" ng-model="search" placeholder="digite sua busca">

           <!-- cabeçalho da tabela -->
           <table class="table" ng-show="contacts.length > 0">
               <tr>
                   <th></th>
                   <th><a href="" ng-click="orderBy('name')">Nome</a></th>
                   <th><a href="" ng-click="orderBy('phone')">Contato</a></th>
                   <th><a href="" ng-click="orderBy('company.name')">Operadora</a></th>
                   <th>Data</th>
               </tr>

               <!-- linhas da tabela -->
               <tr ng-class="{selected: ctt.selected}" ng-repeat="ctt in contacts | filter: search | orderBy:orderField:reverseOrderField track by $index">
                   <td><input type="checkbox" ng-model="ctt.selected"/></td>
                    <td>{{ctt.name}}</td>
                    <td>{{ctt.phone}}</td>
                    <td>{{ctt.company.name}}</td>
                    <td>{{ctt.date | date:'dd/MM/yyyy HH:mm'}}</td>
               </tr>
           </table>

           <!-- campos de digitação | formulário-->
        <div class="field">
            <form name="cttForm">
                <input class="form-control mt-1" name="name" type="text" ng-model="ctt.name" placeholder="nome" ng-required="true"/>
                <input class="form-control mt-1" name="phone" type="text" ng-model="ctt.phone" placeholder="Contato (00 0000-0000)" ng-required="true" ng-pattern="/\d{9}$/"/>

                <select class="form-control mt-1" ng-model="ctt.company" ng-options="company.name + ' (' + (company.price | currency) + ' ' + 'por minuto' + ')' for company in phoneCompany | orderBy:'name'">
                    <option value="">Selecione uma operadora</option>
                </select>
            </form>

            <!-- mensagens de erro -->
            <div ng-messages="cttForm.name.$error">
                <div ng-message="required" class="mt-3 alert alert-success">
                    Por favor, preencha o nome
                </div>
                <div ng-show="cttForm.phone.$invalid && cttForm.phone.$dirty" class="alert alert-danger">
                    Por favor, preencha o telefone
                </div>
            </div>

            <!-- botões -->
            <button class="mt-3 btn btn-primary btn-block" ng-click="addContact(ctt)" ng-disabled="cttForm.$invalid">Adicionar Contato</button>
            <button class="mt-3 btn btn-danger btn-block" ng-click="deleteContact(contacts)" ng-show="isCttSelected(contacts)">Apagar</button>

        </div>

       </div>

<!--
ctt = contato
contacts = contatos
name = nome
phone = telefone
phoneCompany = operadoras
company = operadora
isCttSelected = isContatoSelecionado



buttton click = chame a função addContact passando o valor name e phone na var ctt; o valor digitado vai ser adicionado no array
no ng-model eu crio o contato e adiciono nome e telefone; a referencia ctt foi dada para o botão, que
passou ela para a função, que deu a referencia para o array.
DO array, por causa do ngRepeat (ctt in contacts), a referencia entra no array contacts, e então é
deletada, depois de ser addicionada


let x = angular.module("phoneDirectory", [])= cria módulo
x.controller("nomeController, function ($scope){scope.metodo...}") = usar modulo no controller
ng-bind = pega algo do escopo e cola na view
ng-model="var.nome_array ou, caso tenha dois arryas e queira imprimir os dados dos dois arrays na mesma linha
usar ng-model="var_array1.var_array2"" = pega da view e leva para o scope (inputs, selects, text-areas)
ng-click =reage ao evento ao click
ng-double click...etc
ng-desabled = desabilita algo de forma dinâmica
ng-option="varX.atributo_arrayY for varX in nomeArray" (sempre filho de ng-model para ser add ao scope)
ng-Show/Hide/If = exibe um elemento condicionalmente
igInclude
ngRequired
$pristine/dirty indicam se um campo já foi utiilzado alguma vez
ngPattern = define padrões de validação para os campos
filter = filtra com base em um critério
$http requisição backend

criar o módulo
criar o controller
criar a view html
adicionar o array com os dados no controller
adicionar as diretivas angularjs nos componentes necessários
fazer o evento do click, com a função push no controller
desabilitar botao !nome e phone
array operadora
select na view com ngmodel e ngoption
add categoria na operadora
arrumar ngoptions
    caso tiver mais de uma categoria sobre o mesmo produto (telefonia do tipo 1.movel e 2.fixo)
        no ng-options usar varX.atributodoarrayY group by varX.atributocategoriadoarrayY for varX in arrayY

adicionar ngstyle e ng class para mudar os estilos dinamicamente
    (trocar a cor da linha quando a checkbox for acionada)
    com ng-class na tr mãe do td
    a classe é add no css
    ng-class="{nomeDaClass: var.nomeDaClass}"
    e por um novo td, com input type checkbox e ng-model="var.nomeDaClass"

botão delete:
adicionar na view com ng-click
fazer a função no $scope.nomedafncao = function (nomedoarray){
    $scope.nomedoarray = nomedoarray.filter(function (nomedavar){
        if(!var.selected*) return var
    })
    * selected é o checkbox de clas selected que mostra quando
    algum objeto está selecionado
}
habilitar/desabilitar botão delete com ng-desabled/show passando uma função
no $scope
    $scope.nomedometodo = function (nomedoArray){
        return nomedoArray.some(function(var){
            return var.selected*
        })
    }

mostrar botão delete apenas quando tiver usuario selecionado
nao msotrar titulos da tabela se todos os usuarios estiverem apagados
ng-show="nomedoArray.length > 0

filtros de dados do nome e do contato
add angular-messages.js
fazer campo de busca + filter na expressão ('ctt in contacts | filter: ng-modelDoCampodebusca')
orderBy: ("ctt in contacts | filter: ng-modelDoCampodebusca | orderBy: 'nomedocampo'") +nome = order a-z -nome = ordem z-a
-->
    <div style="text-align: center">
        Criado por Rodrigo Oliveira da Silva
    </div>


<!-- FIREBASE -->
<script src="firebaseCode.js"></script>
<!-- FIREBASE -->

    </body>
</html>
