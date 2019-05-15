// database companhia telefonica (phoneCompany)
var firebaseConfig = {
    apiKey: "AIzaSyBuxz_RnZiGjuVM3TKywt2qM1SV5VGx-dE",
    authDomain: "lista-telefonica-109ba.firebaseapp.com",
    databaseURL: "https://lista-telefonica-109ba.firebaseio.com",
    projectId: "lista-telefonica-109ba",
    storageBucket: "lista-telefonica-109ba.appspot.com",
    messagingSenderId: "57271555896",
    appId: "1:57271555896:web:81eedd4e81bb1cef"
  };
  // database companhia telefonica (phoneCompany)


  // database contatos
  var firebaseConfig = {
      apiKey: "AIzaSyAnxSBcrsvRtoZ79rL-SH6f7pW0UY8gAo4",
      authDomain: "lista-telefonica-913be.firebaseapp.com",
      databaseURL: "https://lista-telefonica-913be.firebaseio.com",
      projectId: "lista-telefonica-913be",
      storageBucket: "lista-telefonica-913be.appspot.com",
      messagingSenderId: "451995043644",
      appId: "1:451995043644:web:3bed7ce9e2028b50"
    };
  // database contatos


  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);



// <!-- controller e módulos -->
let pD = angular.module("phoneDirectory", ["firebase", "ngRoute", "ngMessages"]); //cria modulo
pD.controller("phoneDirectoryCtrl", function ($firebase, $scope, $http){
    $scope.app = "Lista Telefônica"; //titulo h3
    $scope.contacts = []
    $scope.phoneCompany = []

    // requisição http
    // let loadContacts = function () {
    //     $http.get("https://guigoshow08.000webhostapp.com/contacts.json").then(function (response) {
    //     $scope.contacts = response.data;
    //     });
    // }

    // carregar contatos
    $scope.loadContacts = function(){
        $http.get('https://lista-telefonica-913be.firebaseio.com/.json').then(function(response){
            $scope.contacts = response.data;
        });
    }
    // carregar companhias de telefonia
    $scope.loadPhoneCompany = function () {
        $http.get("https://lista-telefonica-109ba.firebaseio.com/.json").then(function(response){
            $scope.phoneCompany = response.data;
        });
    }

    // evento click de Adicionar Contato
    // $scope.addContact = function (ctt){
        // ctt.data = new Date();
        // $http({
        //     url: 'https://lista-telefonica-913be.firebaseio.com/.json',
        //     method: 'POST'}).then(function(){
        //     delete $scope.ctt; //zera os campos de nome e contato
        //     $scope.cttForm.$setPristine();
        //     $scope.contacts.push(angular.copy(ctt))
        // })

        $scope.addContact = function (ctt){
            $http.post('https://lista-telefonica-913be.firebaseio.com/.json')
            .then(function(){
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
