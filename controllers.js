// <!-- controller e módulos -->
let pD = angular.module("phoneDirectory", ["ngMessages"]); //cria modulo
pD.controller("phoneDirectoryCtrl", function ($scope, $http){
    $scope.app = "Lista Telefônica"; //titulo h3
    $scope.contacts = []
    $scope.phoneCompany = []

    // requisição http
    // let loadContacts = function () {
    //     $http.get("https://guigoshow08.000webhostapp.com/contacts.json").then(function (response) {
    //     $scope.contacts = response.data;
    //     });
    // }

    $scope.loadContacts = function(){
        $http.get('https://guigoshow08.000webhostapp.com/contacts.json').then(function(response){
            $scope.contacts = response.data;
        });
    }

    $scope.loadPhoneCompany = function () {
        $http({
            url: "https://guigoshow08.000webhostapp.com/phoneCompany.json",
            method: 'POST'
        }).then(function(response){
            $scope.phoneCompany = response.data;
        });
    }

    // evento click de Adicionar Contato
    $scope.addContact = function (ctt){
        ctt.data = new Date();
        $http({
            url: "https://guigoshow08.000webhostapp.com/contacts.json",
            method: 'POST'}).then(function(){
            delete $scope.ctt; //zera os campos de nome e contato
            $scope.cttForm.$setPristine();
            $scope.contacts.push(angular.copy(ctt))
        })

    }

    // evento do click de Apagar
        $scope.deleteContact = function (contacts){
        $scope.contacts = contacts.filter(function (ctt){
            if(!ctt.selected) return ctt;
        })
    // reatribua para o array contacts todos os contatos
    // não selecionados
    // retorne ctt em contacs filtrando ps não selecionados
    // se estivem, não atribua (se nao atribui... ele sai)
    };

    $scope.isCttSelected = contacts => {
        return contacts.some (function (ctt) {
            return ctt.selected;
        });

    }
    // retorne algum ctt selecionado que estiver selecionado
    // caso não ouver, !isisCttSelected é true, então, não havendo ctt selected, o botao desabilita

    $scope.orderBy = function (field){
        $scope.orderField = field
        $scope.reverseOrderField = !$scope.reverseOrderField
    }

    $scope.loadContacts();
    $scope.loadPhoneCompany();


});
